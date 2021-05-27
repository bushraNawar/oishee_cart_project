<?php
$serverName='localhost';
$dbUserName='root';
$dbPassword='';
$dbName='cart_project';



$db = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);
if(!$db)
{
	die('Connection failed'.mysqli_connect_error());
}
