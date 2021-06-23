    <?php
    include('header.php');
   include('config/config.php');
    include('config/db.inc.php');
    $type = "";

    if (isset($_POST["payNow"])) {
            $card_number = preg_replace('/\s+/', '', $_POST['card_number']);
            $card_exp_year=mysqli_real_escape_string($db,$_POST['card_exp_year']);
            $card_exp_month=mysqli_real_escape_string($db,$_POST['card_exp_month']);
            $card_exp_year_month = $card_exp_year.'-'.$card_exp_month;
            $card_cvc=mysqli_real_escape_string($db,$_POST['card_cvc']);
            $user_id=$_SESSION['customer_id'];
            $email=$_SESSION['customer_email'];
            $total_amount=$_SESSION['grandTotal'];
            if (empty($card_number)||empty($card_exp_month)||empty($card_exp_year)||empty($card_cvc)) {
               header('Location:payment.php');
               exit();
            }
        require_once 'includes/AuthorizeNetPayment.php';
        $authorizeNetPayment = new AuthorizeNetPayment();
        $response = $authorizeNetPayment->chargeCreditCard($card_number,$card_exp_year_month,$card_cvc,$email,$total_amount);
        
         if ($response != null) { 
            // Check to see if the API request was successfully received and acted upon 
            if ($response->getMessages()->getResultCode() == "Ok") { 
                // Since the API request was successful, look for a transaction response 
                // and parse it to display the results of authorizing the card 
                $tresponse = $response->getTransactionResponse(); 
     
                if ($tresponse != null && $tresponse->getMessages() != null) { 
                    // Transaction info 
                    $transaction_id = $tresponse->getTransId(); 
                    $payment_status = $response->getMessages()->getResultCode(); 
                    $payment_response = $tresponse->getResponseCode(); 
                    $auth_code = $tresponse->getAuthCode(); 
                    $message_code = $tresponse->getMessages()[0]->getCode(); 
                    $message_desc = $tresponse->getMessages()[0]->getDescription(); 
                    $statusMsg = "";
                    $responseArr = array(1 => 'Approved', 2 => 'Declined', 3 => 'Error', 4 => 'Held for Review');
                    // Include database connection file  
                    // include_once 'dbConnect.php'; 
                     
                    // Insert tansaction data into the database 

                    $query = "INSERT INTO payment(user_id,transection_id,card_number,card_exp_month,card_exp_year,payment_status,payment_response,email,total_amount,created,modified) 
                        VALUES('$user_id','$transaction_id','$card_number','$card_exp_month','$card_exp_year','$payment_status','$payment_response','$email','$total_amount',NOW(),NOW())";
                      $insert=mysqli_query($db, $query);
                     $paymentID = $db->insert_id;
                      

                  //  $insert_order_result=$cart->insertOrder($user_id);
                  // as data is ordered now cart item need to be deleted 
                    //$delete_cart=$cart->deleteCustomerCart();
                    if(!empty($paymentID))
                     $insert_order_result=$cart->insertOrder($user_id,$paymentID,$payment_response);
                  // // as data is ordered now cart item need to be deleted 
                  //   $delete_cart=$cart->deleteCustomerCart();
                   
           

                } else { 
                    $error = "Transaction Failed! \n"; 
                    if ($tresponse->getErrors() != null) { 
                        $error .= " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "<br/>"; 
                        $error .= " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "<br/>"; 
                    } 
                    $statusMsg = $error; 
                } 
                // Or, print errors if the API request wasn't successful 
            } else { 
                $error = "Transaction Failed! \n"; 
                $tresponse = $response->getTransactionResponse(); 
             
                if ($tresponse != null && $tresponse->getErrors() != null) { 
                    $error .= " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "<br/>"; 
                    $error .= " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "<br/>"; 
                } else { 
                    $error .= " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "<br/>"; 
                    $error .= " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "<br/>"; 
                } 
                $statusMsg = $error; 
            } 
        } else { 
            $statusMsg =  "Transaction Failed! No response returned"; 
        } 


    ?>


    <div class="status">
        <?php if(!empty($paymentID)){ 
            
            ?>
            <?php
            // payment response 1 or approved delete from cart
            if ($responseArr[$payment_response]==='Approved') {
             //as data is paid now cart item need to be deleted 
                          
                $delete_cart=$cart->deleteCustomerCart();
                 header('Location:order.php?payment_status=successful&paymentID='.$paymentID);
                exit(); 

            }
            elseif ($responseArr[$payment_response]==='Declined'||$responseArr[$payment_response]==='Declined'||$responseArr[$payment_response]==='Error'||$responseArr[$payment_response]==='Held for Review') {
                header('Location:order.php?payment_status='.$responseArr[$payment_response]);
                exit();
            }

            ?>

            <h1 <?php echo $statusMsg; ?>> </h1>
            
            <h4>Payment Information</h4>
            <p><b>Reference Number:</b> <?php echo $paymentID; ?></p>
            <p><b>Transaction ID:</b> <?php echo $transaction_id; ?></p>
            <p><b>Status:</b> <?php echo $responseArr[$payment_response]; ?></p>
             
            <h4>Product Information</h4>
           
        <?php }else{ ?>
            <?php
             header('Location:payment.php?failedPayment=failed');
             exit();
            ?>
            <!-- <h1 class="error">Your Payment has Failed</h1>
            <p class="error"><?php echo $statusMsg; ?></p> -->

        <?php } ?>
    </div>

    <?php

            }



        
