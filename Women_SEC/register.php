<?php

$name = $_POST['Full_name'];
$email  = $_POST['Email_address'];
$number = $_POST['Phone_number'];
$Women  = $_POST['Women_Alert_type'];
$password = $_POST['Create_password'];
$repeat = $_POST['Repeat_password'];




if (!empty($name) || !empty($email) || !empty($number) || !empty($Women) || !empty($password) || !empty($repeat) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "sign_up";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From signup Where email = ? Limit 1";
  $INSERT = "INSERT Into signup (Full_name , Email_address ,Phone_number, Women_Alert_type, Create_password,Repeat_password)values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssisss", $name,$email,$number,$Women,$password,$repeat);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>