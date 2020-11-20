<?php 
	//Admin for Website Page - see every user, story, and comment on website. Can update/delete any of them.

    include 'resources/database/connectToDB.inc';
	include 'resources/templates/session.php';

	//checks if the user has admin credentials
	if(!isset($_SESSION['username'])) {
		if($_SESSION['username']!='admin') {
			header('Location: login.php');
		}
	}
?>

<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="resources/css/master.css">
    <title>Admin Page</title>
</head>
    
<body>
	<?php include 'resources/templates/header.php'; ?>

	<div class="content">
		<?php
			//Displays all content in databases, checks to see if update or deletion form submitted
			if (isset($_POST['tableName1']) && isset($_POST['attributeName1']) && isset($_POST['attributeValue1'])) {
				deleteRecords();
				showAllData();
			} 
			else if (isset($_POST['tableName2']) && isset($_POST['attributeName2']) && isset($_POST['attributeValue2']) && isset($_POST['attributeName3']) && isset($_POST['attributeValue3'])) {
				updateRecords();
				showAllData();
			} 
			else {
				showAllData();
			}
		
		//Shows all content in the database
		function showAllData() {
			$dataBase = connectDB();

			//user table
			$query1  = 'SELECT * FROM users ORDER BY user_id';
			$result1 = mysqli_query($dataBase, $query1) or die('Query failed: '.mysqli_error($dataBase));
			echo "<br>All Users:<br>";
			echo "<table border='1'>";
			echo "<tr> <td>user_id</td> <td>username</td> <td>user_password</td> <td>email</td> <td>description</td> <td>date_joined</td></tr>";
			while ($line1 = mysqli_fetch_array($result1)) {
				extract($line1);
				echo "<tr> <td>$user_id</td> <td>$username</td> <td>$user_password</td> <td>$email</td> <td>$description</td> <td>$date_joined</td></tr>";
			}
			echo "</table>";

			//stories table
			$query2  = 'SELECT * FROM stories ORDER BY story_id';
			$result2 = mysqli_query($dataBase, $query2) or die('Query failed: '.mysqli_error($dataBase));
			echo "<br>All Stories:<br>";
			echo "<table border='1'>";
			echo "<tr> <td>story_id</td> <td>user_id</td> <td>title</td> <td>genre</td> <td>description</td> <td>content</td> <td>date_created</td> </tr>";
			while ($line2 = mysqli_fetch_array($result2)) {
				extract($line2);
				echo "<tr> <td>$story_id</td> <td>$user_id</td> <td>$title</td> <td>$genre</td> <td>$description</td> <td>$content</td> <td>$date_created</td> </tr>";
			}
			echo "</table>";
		
			//comments table
			$query4  = 'SELECT * FROM comments ORDER BY comment_id';
			$result4 = mysqli_query($dataBase, $query4) or die('Query failed: '.mysqli_error($dataBase));
			echo "<br>All Comments:<br>";
			echo "<table border='1'>";
			echo "<tr> <td>comment_id</td> <td>story_id</td> <td>username</td> <td>title</td> <td>content</td> </tr>";
			while ($line4 = mysqli_fetch_array($result4)) {
				extract($line4);
				echo "<tr> <td>$comment_id</td> <td>$story_id</td> <td>$username</td> <td>$title</td> <td>$content</td></tr>";
			}
			echo "</table>";

			mysqli_close($dataBase);

		}
		
		//Deletes record specified by delete form
		function deleteRecords() {
			$database = connectDB();
			$str1 = "DELETE FROM " . mysqli_real_escape_string($database, $_POST['tableName1']);
			$str2 = " WHERE " . mysqli_real_escape_string($database, $_POST['attributeName1']) . "=" .
			"'" . mysqli_real_escape_string($database, $_POST['attributeValue1']) . "'";
			$query = $str1 . $str2 . ";";
			echo $query;
			$result1 = mysqli_query($database, $query) or die('Query failed: ' . mysqli_error($database));
			mysql_close($database);
		}
		
		//Updates record specified by update form
		function updateRecords() {
			$database = connectDB();
			$str1 = "UPDATE " . mysqli_real_escape_string($database, $_POST['tableName2']);
			$str2 = " SET " . mysqli_real_escape_string($database, $_POST['attributeName2']) . "=" . "'" .
			mysqli_real_escape_string($database, $_POST['attributeValue2']) . "'";
			$str3 = " WHERE " . mysqli_real_escape_string($database, $_POST['attributeName3']) . "=" .
			"'" . mysqli_real_escape_string($database, $_POST['attributeValue3']) . "'";
			$query = $str1 . $str2 . $str3 . ";";
			echo $query;
			$result2 = mysqli_query($database, $query) or die('Query failed: ' . mysqli_error($database));
			mysql_close($database);
		}
		?>

		<!--Delete form-->
		<h2>Below you can DELETE records from the tables above</h2>
		<form action="<?php $_SERVER[PHP_SELF]; ?>" method="post">
			<p>DELETE FROM <input type="text" name="tableName1" value=""> </p>
			<p>WHERE <input type="text" name="attributeName1" value="">  = <input type="text" name="attributeValue1" value=""> </p>
			<input type='submit'>
		</form>

		<!--Update form-->
		<h2>Below you can UPDATE records in the tables above</h2>
		<form action="<?php $_SERVER[PHP_SELF]; ?>" method="post">
			<p>UPDATE <input type="text" name="tableName2" value=""> </p>
			<p>SET <input type="text" name="attributeName2" value=""> = <input type="text" name="attributeValue2" value=""> </p>
			<p>WHERE <input type="text" name="attributeName3" value=""> = <input type="text" name="attributeValue3" value=""> </p>
			<input type='submit'>
		</form>
    </div>
</body>
</html>