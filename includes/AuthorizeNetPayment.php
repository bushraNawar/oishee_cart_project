<?php
 $file_path=realpath(dirname(__FILE__));
         require($file_path.'/../vendor/autoload.php');

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeNetPayment
{  


    public $db;
    private $APILoginId;
    private $APIKey;
    private $refId;
    private $merchantAuthentication;
    public $responseText;


    public function __construct()

    {
        //  $file_path=realpath(dirname(__FILE__));
        // include('../config/config.php');
        $this->APILoginId =ANET_API_LOGIN_ID;
        $this->APIKey = ANET_TRANSACTION_KEY;
        $this->refId = 'ref' . time();
        
        $this->merchantAuthentication = $this->setMerchantAuthentication();
        $this->responseText = array("1"=>"Approved", "2"=>"Declined", "3"=>"Error", "4"=>"Held for Review");
    }
  public function setMerchantAuthentication()
    {
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($this->APILoginId);
        $merchantAuthentication->setTransactionKey($this->APIKey);  
        
        return $merchantAuthentication;
    }

     public function setCreditCard($card_number,$card_exp_year_month,$card_cvc)
    {

        // Create the payment data for a credit card 
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($card_number);
        $creditCard->setExpirationDate( $card_exp_year_month);
        $creditCard->setCardCode($card_cvc);
        // Add the payment data to a paymentType object
        $paymentType = new AnetAPI\PaymentType();
        $paymentType->setCreditCard($creditCard);
    
        return $paymentType;
    }
    public function setTransactionRequestType($paymentType, $total_amount,$email)
    {
         // Create order information 
        $order = new AnetAPI\OrderType(); 
        $order->setDescription($email); 
         
        // Set the customer's identifying information 
        $customerData = new AnetAPI\CustomerDataType(); 
        $customerData->setType("individual"); 
        $customerData->setEmail($email); 
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($total_amount);
        $transactionRequestType->setPayment($paymentType);
        $transactionRequestType->setOrder($order); 
        $transactionRequestType->setCustomer($customerData); 
        
        return $transactionRequestType;
    }
     

    public function chargeCreditCard($card_number,$card_exp_year_month,$card_cvc,$email,$total_amount)

    {
        
        $paymentType = $this->setCreditCard($card_number,$card_exp_year_month,$card_cvc);
        $transactionRequestType = $this->setTransactionRequestType($paymentType,$total_amount,$email);
        
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($this->merchantAuthentication);
        $request->setRefId( $this->refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        
        return $response;
    }
}
