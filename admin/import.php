<?php
// Load the database configuration file
include'../config/db.inc.php';

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            //fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $product_id=$line[0];
                $product_name   = $line[1];
                $category_id  = $line[2];
                $description  = $line[4];
                $price = $line[5];
                $image=$line[6];
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT product_name FROM product WHERE product_id = '".$line[0]."'";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $db->query("UPDATE product SET product_name = '".$product_name."', category_id= '".$category_id."', description = '".$description."', price = '".$price."', image= '".$image."' WHERE product_id = '".$product_id."'");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT INTO product(product_name,category_id,description,price,image) 
          VALUES('$product_name','$category_id','$description','$price','$image')");
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: import_export.php".$qstring);