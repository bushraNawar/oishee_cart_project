<?php
$serverName='localhost';
$dbUserName='root';
$dbPwd='';
$dbName='cart_project';



$db = mysqli_connect($serverName, $dbUserName, $dbPwd, $dbName);
if(!$db)
{
	die('Connection failed'.mysqli_connect_error());
}
