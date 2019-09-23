<?php
if (isset($_REQUEST['entry'])) {
	# code...

 $entry= $_REQUEST['entry'];
 $pn=$_REQUEST['pn'];

require_once("../includes/dbconnect.php");
//select customer
//This first query is just to get the total count of rows
$sql = "SELECT COUNT(id) FROM members WHERE active='yes'";
$rows = $con->query($sql)->fetchColumn();
$page_rows = $entry;

$last = ceil($rows/$page_rows);
if($last < 1){
  $last = 1;
}
$pagenum = $pn;
// if(isset($_GET['pn'])){
//   $pagenum = preg_replace('#[^0-9]#', '', $pn);
// }
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}
$a=($pagenum - 1) * $page_rows ;

$sql1 = "SELECT * FROM members  WHERE active='yes' LIMIT $page_rows OFFSET $a";
$q1=$con->query($sql1);
$textline1 = "(<b>$rows</b>)";
$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
$paginationCtrls = '';
if($last != 1){
  if ($pagenum > 1) {
        $previous = $pagenum - 1;
    $paginationCtrls .= '<option value="'.$previous.'" onclick="populatePage(this.value);fromPagenation()">Previous</option> &nbsp; &nbsp; ';
    for($i = $pagenum-4; $i < $pagenum; $i++){
      if($i > 0){
            $paginationCtrls .= '<option value="'.$i.'" onclick="populatePage(this.value);fromPagenation()">'.$i.'</option> &nbsp; ';
      }
      }
    }
  $paginationCtrls .= ''.$pagenum.' &nbsp; ';
  for($i = $pagenum+1; $i <= $last; $i++){
    $paginationCtrls .= '<option value="'.$i.'" onclick="populatePage(this.value);fromPagenation()">'.$i.'</option> &nbsp; ';
    if($i >= $pagenum+4){
      break;
    }
  }    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <option value="'.$next.'" onclick="populatePage(this.value);fromPagenation(this.value)">Next</option> ';
    }
}
//$list = '';
$out="";
$i=1;
foreach ($q1 as $row) {
    # code...
    $out.='<tr> <td>'.$i++.'</td>
    <td>'.$row['fname'].'</td><td>'.$row['lname'].'</td><td>'.$row['phone']."</td><td>view</td></tr>";
  }

}

echo $out;

?>