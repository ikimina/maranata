<?php
try {
	$con=new PDO("pgsql:host=localhost;dbname=maranata","postgres","123");
	
	
} catch (PDOException $e) {

	echo $e->getMessage();
	
}

 ?>