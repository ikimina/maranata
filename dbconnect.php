<?php
try {
	$pod=new PDO("pgsql:host=localhost;dbname=maranata","postgres","123");
	 echo "done";
	
} catch (PDOException $e) {

	echo $e->getMessage();
	
}

 ?>