<!-- Εισαγωγή χρήστη -->
<?php
include("config.php");
 
// Ελέγχω εάν υπάρχει ήδη καταχωρημένος χρήστης 

$username = $_POST['username'];
$query = "SELECT * FROM users WHERE username='$username'";
$result=mysqli_query($con, $query);
$num=mysqli_num_rows($result);


//Εάν δεν υπάρχει ήδη καταχωρημένος χρήστης με username
if ($num == 0){
	
//Εισαγωγή χρήστη
$insert_query="INSERT INTO `users` SET 
				user_id ='',
				email='".$_POST['email']."',
				username='".$_POST['username']."',
				password='".$_POST['password']."',
				role='".$_POST['role']."'
				";
$insert=mysqli_query($con, $insert_query) or die('Error,query failed !!!!');

//Ενημερωτικό μηνύμα εγγραφής του νέου χρήστη
echo'<script language="javascript">alert("Η εγγραφή του νέου χρήστη ήταν επιτυχής.")</script>';
echo'<script language="javascript"> document.location="login.html";</script>';
}

else{
	echo'<script language="javascript">alert("Το username υπάρχει ήδη")</script>';
	echo'<script language="javascript">document.location="register.html";</script>';	
}	 
?>