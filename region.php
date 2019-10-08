<?php 
require_once ("includes/dbconnect.php");
         
        $r_id="";
        $r="";
       
        if (isset($_REQUEST['id'])) {
        	
        	if ($_REQUEST['sel']=="0") {
        		$r_id= "prov_id";
        		$r="province";
        	$query = $con->prepare("SELECT DISTINCT $r_id, $r FROM regions ");
        	 $query->execute();
           $res="<option ></option>";
            foreach ($query as $row) {
        	$res.="
            <option value=".$row['prov_id'].">".$row['province']."</option>";

        }
        	}
        	if ($_REQUEST['sel']=="1") {
        		$id=$_REQUEST['id'];
        		$r_id= "dist_id";
        		$r="district";
        		$query = $con->prepare("SELECT DISTINCT $r_id, $r FROM regions WHERE prov_id=$id");
        		 $query->execute();
               $res="<option ></option>";
                foreach ($query as $row) {
        	    $res.="
                <option value=".$row[$r_id].">".$row[$r]."</option>";

        }
        	}

        	if ($_REQUEST['sel']=="2") {
        		$id=$_REQUEST['id'];
        		$r_id= "sect_id";
        		$r="sector";
        		$query = $con->prepare("SELECT DISTINCT $r_id, $r FROM regions WHERE dist_id=$id");
        		 $query->execute();
               $res="<option ></option>";
                foreach ($query as $row) {
        	    $res.="
                <option value=".$row[$r_id].">".$row[$r]."</option>";

        }
        	}
        	if ($_REQUEST['sel']=="3") {
        		$id=$_REQUEST['id'];
        		$r_id= "cell_id";
        		$r="cell";
        		$query = $con->prepare("SELECT DISTINCT $r_id, $r FROM regions WHERE sect_id=$id");
        		 $query->execute();
               $res="<option ></option>";
                foreach ($query as $row) {
        	    $res.="
                <option value=".$row[$r_id].">".$row[$r]."</option>";

        }
        	}
           if ($_REQUEST['sel']=="4") {
        		$id=$_REQUEST['id'];
        		$r_id= "vill_id";
        		$r="village";
        		$query = $con->prepare("SELECT DISTINCT $r_id, $r FROM regions WHERE cell_id=$id");
        		 $query->execute();
               $res="<option ></option>";
                foreach ($query as $row) {
        	    $res.="
                <option value=".$row[$r_id].">".$row[$r]."</option>";

        }
        	}
         
       

    	echo $res;
        }
      

 ?>