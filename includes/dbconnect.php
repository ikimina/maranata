<?php

try {
	$con=new PDO("pgsql:host=localhost; port=5432;dbname=maranata;user=postgres;password=Test123");
	
	
} catch (PDOException $e) {

	echo $e->getMessage();
	
}

 ?>