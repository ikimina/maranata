<?php
 header('Content-Type: application/json');


 $conn=mysqli_connect('localhost','root','','graph');

 if (!$conn) {
 	echo "Not connected";
 }

 $query="SELECT moth,rain FROM rain ORDER BY id ";

 $result=$conn->query($query);

 $data = array();
 while ($row = $result->fetch_assoc()) {
 	$data [] =$row;
 }

 $conn->close();

 print json_encode($data);
?>