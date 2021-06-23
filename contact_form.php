<?php include('header.php');?>
<?php
if (isset($_POST['contact_us'])) {

	$get_contact_us_result=$customer->contactUs($_POST);
}
?>
<div class="container">
<div class="row">
<?php
if (isset($get_contact_us_result)) {

	echo $get_contact_us_result;
}
?>
</div>
<div class="row">
<form action="" method="POST">	
<table>

<tr>
<i  class="fa fa-comment" style="font-size: 40px;"> </i>	
<td colspan="3"><h3><strong>Contact Form</strong></h3></td> 
</tr>
<tr>

<tr><th>Email</th></tr>
<tr><th><i class="fa fa-envelope"></i></th></tr>
<tr> <td><input type="email"  name="email" placeholder="Enter your email"></td> </tr>

<tr><th>Subject</th></tr>
<tr><th><i class="fa fa-pencil"></i></th></tr>
<tr><td> <input type="text"  name="subject" placeholder="Subject.."></td> </tr>
<tr><th>Message</th></tr>
<tr><th><i class="fa fa-pencil-square"></i></th></tr>
<tr> <td> <textarea  name="message" placeholder="Write something.." style="height:1s00px"></textarea></td></tr>
<tr> <td><button class="btn btn-primary" type="submit" name="contact_us"><i class="fa fa-send"></i> Submit</button></td></tr>
 
    
  

</table>	
</form>
</div>	
  
</div>
<?php include('footer.php');?>