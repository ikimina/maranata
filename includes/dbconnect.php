<?php
try {
	$con=new PDO("pgsql:host=localhost;dbname=maranata","postgres","root");
	
	
} catch (PDOException $e) {

	echo $e->getMessage();
	
}

 ?>