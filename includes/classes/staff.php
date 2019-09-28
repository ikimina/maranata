
<?php

/**
 * @eric
 */
class Staff
{
	
	function __construct($con,$tel)
	{
		$this->con=$con;
		$this->tel=$tel;

        $query = $this->con->prepare("SELECT * FROM staff WHERE phone = :un AND active='yes'");
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

    public function getEmail() {
        return $this->sqlData["email"];
    }

    public function getProfilePic() {
        return $this->sqlData["profilePic"];
    }

    public function getCreatedDate() {
        return $this->sqlData["created_date"];
    }
    public function getProvince() {
        return $this->sqlData["province"];
    }
    public function getDistrict() {
        return $this->sqlData["district"];
    }
    public function getSector() {
        return $this->sqlData["sector"];
    }
    public function getCell() {
        return $this->sqlData["cell"];
    }
    public function getVillage() {
        return $this->sqlData["village"];
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
    public function getAccountNo() {
        return $this->sqlData["sex"];
    }

}


 ?>