
<?php

/**
 * @eric
 */
class User
{
	private $con,$tel,$sqlData;
	function __construct($con,$tel)
	{
		$this->con=$con;
		$this->tel=$tel;

        $query = $this->con->prepare("SELECT * FROM members WHERE phone = :un AND active='yes'");
        $query->bindParam(":un", $tel);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
      
	}
 public function isUserValid()
 {
     if (empty($this->sqlData)) {
         return "This User Do not Exist or may be deleted!";
     }
     
 }

    public function getId()
    {
        return $this->sqlData["id"];
    }
    public function getFname()
    {
    	return $this->sqlData["fname"];
    }
	    
    public function getLname() {
        return $this->sqlData["lname"];
    }

    public function getNames() {
        return $this->sqlData["fname"] . " " . $this->sqlData["lname"];
    }

    public function getFirstName() {
        return $this->sqlData["firstName"];
    }

    public function getLastName() {
        return $this->sqlData["phone"];
    }
    function getSexGraph(){
        $sql1 = "SELECT sex FROM members WHERE active='yes'";
        $q1=$this->con->query($sql1);
         return $q1;
    }
    public function getEmail() {
        return $this->sqlData["email"];
    }

    public function getProfilePic() {
        return $this->sqlData["profilepic"];
    }

    public function getCreatedDate() {
        return $this->sqlData["created_date"];
    }
    public function getProvince() {
        return $this->translateRegion($this->sqlData["province"],'province');
    }
    public function getDistrict() {
        return $this->translateRegion($this->sqlData["district"],'district');
    }
    public function getSector() {
        return $this->translateRegion($this->sqlData["sector"],'sector');
    }
    public function getCell() {
        return $this->translateRegion($this->sqlData["cell"],'cell');
    }
    public function getVillage() {
        return $this->translateRegion($this->sqlData["village"],'village');
    }
    public function getSex() {
        return $this->sqlData["sex"];
    }
    public function getMeritalStatus() {
        return $this->sqlData["sex"];
    }
    public function getDob() {
        return $this->sqlData["dob"];
    }
    public function getAccountNumber() {
        return $this->sqlData["accountnumber"];
    }
     public function getBankName() {
        return $this->sqlData["accountname"];
    }
    public function translateRegion($id,$to){
        $field="";
        if ($to=="province") {
         $field="prov_id";
        }
        if ($to=="district") {
         $field="dist_id";
        }
        if ($to=="sector") {
         $field="sect_id";
        }
        if ($to=="cell") {
         $field="cell_id";
        }
        if ($to=="village") {
         $field="vill_id";
        }
       $query = $this->con->prepare("SELECT $to FROM regions WHERE  $field = :un");
        $query->bindParam(":un", $id);
        $query->execute();

        return  $query->fetch(PDO::FETCH_ASSOC)[$to];
    }
    public function getAllUser()
                {
            $sql = "SELECT COUNT(id) FROM members WHERE active='yes'";
            $rows = $this->con->query($sql)->fetchColumn();
       return $rows;
    }
    public function getChangingPasswordCount()

                {
                  $tel=  $this->tel;
            $sql = "SELECT COUNT(id) FROM credential WHERE username='$tel'";
            $rows = $this->con->query($sql)->fetchColumn();
       return $rows;
    }
        public function getSavingMounthy($y)
    {
        $totalMountSave=0;
        $dataArray=array();
        for ($i=1; $i <= 12; $i++) { 
            if ($i<10) {
                $i="0".$i;

            }
            $end="";
            if ($i==1) {
                $end="31";
            }
            if ($i==2) {
                $end="28";
            }
            if ($i==3) {
                $end="31";
            }
            if ($i==4) {
                $end="30";
            }
            if ($i==5) {
                $end="31";
            }
            if ($i==6) {
                $end="30";
            }
            if ($i==7) {
                $end="31";
            }
            if ($i==8) {
                $end="31";
            }
            if ($i==9) {
                $end="30";
            }
            if ($i==10) {
                $end="31";
            }
            if ($i==11) {
                $end="30";
            }
            if ($i==12) {
                $end="31";
            }
            $from=$y.'-'.$i.'-01';
            $to=$y.'-'.$i.'-'.$end;
            $sql1 = "SELECT * FROM transactions WHERE tr_id='1' AND  done_on >='$from' AND done_on <='$to'";
            $q1=$this->con->query($sql1);

            foreach ($q1 as $row) {
                $totalMountSave+=(int)$row['amount'];
              }

   array_push($dataArray, $totalMountSave);
   $totalMountSave=0;
 }
        return $dataArray;    
    }
       
}


 ?>