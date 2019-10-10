<?php

if (isset($_REQUEST['entry'])) {
	# code...

$rpp= $_POST['entry'];
 $pn=$_POST['pn'];
$last=$_POST['last'];
require_once("../includes/dbconnect.php");
 if ($pn < 1) { 
      $pn = 1; 
  } else if ($pn > $last) { 
      $pn = $last; 
  }
 
$a=($pn - 1) * $rpp;

$sql1 = "SELECT * FROM members  WHERE active='yes' LIMIT $rpp OFFSET $a";
$q1=$con->query($sql1);

 $dataString = "<table class='table table-stipped table-bordered'>
          <tr>
          <th>No</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Telephone</th>
          <th>Sector</th>
          <th>Cell</th>
          <th>Village</th>
          <th>Action</th></tr>
         <tr >";
$i=1;
foreach ($q1 as $row) {
    # code...
     $dataString .='<tr> <td>'.$i++.'</td>
    <td>'.$row['fname'].'</td><td>'.$row['lname'].'</td><td>'.$row['phone'].'</td><td>'.$row['sector'].'</td><td>'.$row['cell'].'</td><td>'.$row['village']."</td><td><a href='user_info_page.php?user=".$row['phone']."' class='btn btn-sm  mr-4' type='button' 
   style='color:#000 !important;'><i class='fas fa-eye'></i>View</a></td></tr>";
  }
   $dataString ." </table>";
 
echo  $dataString ;
}



?>
<?php

//fetch.php
// $con = new PDO("mysql:host=localhost;dbname=contact", "root", "");


// $column = array('CustomerName', 'Gender', 'Address', 'City', 'PostalCode', 'Country');
//include('database_connection.php');
//  require_once("../includes/dbconnect.php");
// $column = array('fname', 'lname', 'phone', 'sector','cell','village');

// $query = "SELECT * FROM members";

// if(isset($_POST['search']['value']))
// {
//  $query .= '
// WHERE fname LIKE "%'.$_POST['search']['value'].'%" 
//  OR lname LIKE "%'.$_POST['search']['value'].'%" 
//  OR phone LIKE "%'.$_POST['search']['value'].'%" 
//  OR sector LIKE "%'.$_POST['search']['value'].'%" 
//  OR cell LIKE "%'.$_POST['search']['value'].'%" 
//  OR village LIKE "%'.$_POST['search']['value'].'%" 
//  ';
 
//  // $query = '
//  // WHERE fname LIKE "%'.$_POST['search']['value'].'%" 
//  // OR lname LIKE "%'.$_POST['search']['value'].'%" 
//  // OR sex LIKE "%'.$_POST['search']['value'].'%" 
//  // OR village LIKE "%'.$_POST['search']['value'].'%" 
//  // OR cell LIKE "%'.$_POST['search']['value'].'%" 
//  // OR sector LIKE "%'.$_POST['search']['value'].'%" 
//  // OR dob LIKE "%'.$_POST['search']['value'].'%" 
//  // ';

// }

// // if(isset($_POST['order']))
// // {
// //  $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
// // }
// // else
// // {
// //  $query .= 'ORDER BY id DESC ';
// // }

// // $query1 = '';

// // if($_POST['length'] != -1)
// // {
// //  $query1 = 'LIMIT ' . $_POST['start'] . 'OFFSET ' . $_POST['length'];
// // }

// $statement = $con->prepare($query);

// $statement->execute();

// // $number_filter_row = $statement->rowCount();

// // $statement = $con->prepare($query . $query1);

// $statement->execute();

// $result = $statement->fetchAll();

// $data = array();

// foreach($result as $row)
// {
//  // $sub_array = array();
//  // $sub_array[] = $row['CustomerName'];
//  // $sub_array[] = $row['Gender'];
//  // $sub_array[] = $row['Address'];
//  // $sub_array[] = $row['City'];
//  // $sub_array[] = $row['PostalCode'];
//  // $sub_array[] = $row['Country'];
//   $sub_array = array();
//  $sub_array[] = $row['fname'];
//  $sub_array[] = $row['lname'];
//  $sub_array[] = $row['phone'];
//  $sub_array[] = $row['sector'];
//  $sub_array[] = $row['cell'];
//  $sub_array[] = $row['village'];
//  $data[] = $sub_array;
// }

// function count_all_data($con)
// {
//  $query = "SELECT * FROM tbl_customer";
//  $statement = $con->prepare($query);
//  $statement->execute();
//  return $statement->rowCount();
// }

// $output = array(
//  'draw'    => intval($_POST['draw']),
//  'recordsTotal'  => count_all_data($con),
//  'data'    => $data
// );

// echo json_encode($output);

?>