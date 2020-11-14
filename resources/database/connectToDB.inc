<?php

function connectDB(){
	$conn = mysqli_connect('localhost', 'ben' , 'ben', 'regale'); #hostname, username, password, dbname
	if (mysqli_connect_errno()){
        echo 'Connection error: ' . mysqli_connect_error();
		die(mysqli_connect_error());
	}
	return $conn;
}


?>