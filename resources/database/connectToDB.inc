<?php
//Connects to database
function connectDB(){
	$conn = mysqli_connect('sql211.epizy.com', 'epiz_27196441' , '4zrHiPPMkS', 'epiz_27196441_regale'); #hostname, username, password, dbname
	if (mysqli_connect_errno()){
        echo 'Connection error: ' . mysqli_connect_error();
		die(mysqli_connect_error());
	}
	return $conn;
}


?>