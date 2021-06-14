<?php 
// Load the database configuration file 
include'../config/db.inc.php'; 
 
$filename = "product" . date('Y-m-d') . ".csv"; 
$delimiter = ","; 
 
// Create a file pointer 
$f = fopen('php://memory', 'w'); 
 
// Set column headers 
$fields = array('product_id', 'product_name','category_id', 'category_name', 'description', 'price', 'image'); 
fputcsv($f, $fields, $delimiter); 
 
// Get records from the database 
$result = $db->query("SELECT product.*,category.category_name
                      FROM product
                      INNER JOIN category
                      ON product.category_id=category.category_id
                       ORDER BY product.product_id DESC"); 
if($result->num_rows > 0){ 
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $result->fetch_assoc()){ 
        $lineData = array($row['product_id'], $row['product_name'],$row['category_id'],$row['category_name'], $row['description'], $row['price'], $row['image']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
} 
 
// Move back to beginning of file 
fseek($f, 0); 
 
// Set headers to download file rather than displayed 
header('Content-Type: text/csv'); 
header('Content-Disposition: attachment; filename="' . $filename . '";'); 
 
// Output all remaining data on a file pointer 
fpassthru($f); 
 
// Exit from file 
exit();