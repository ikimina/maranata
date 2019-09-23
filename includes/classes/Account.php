<?php
class Account {

    private $con;
    private $errorArray = array();

    public function __construct($con) {
        $this->con = $con;
    }

    public function login($un, $pw) {
        //$pw = hash("sha512", $pw);

        $query = $this->con->prepare("SELECT * FROM credential WHERE username=:un AND password=:pw");
        $query->bindParam(":un", $un);
        $query->bindParam(":pw", $pw);

        $query->execute();           
        if($query->rowCount() == 1) {
            $input = $query->fetch(PDO::FETCH_ASSOC);
          
            $type=$input['type'];
             
         return $type;
        }
        else {
            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }
    }
    public function register($firstName, $lastName, $phone, $idNo, $sex, $merital, $dob,$province,$district,$sector,$cell,$village) {
        $this->validateFirstName($firstName);
        $this->validateLastName($lastName);
        $this->validatePhone($phone);
        $this->validateId($idNo);
        $this->validateSex($sex);
        $this->validateMerital($merital);

        if(empty($this->errorArray)) {
            return $this->insertUserDetails($firstName, $lastName, $phone, $idNo, $sex, $merital, $dob,$province,$district,$sector,$cell,$village);
        }
        else {
            return false;
        }
    }

    public function insertUserDetails($firstName, $lastName, $phone, $idNo, $sex, $merital, $dob,$province,$district,$sector,$cell,$village) {

        $query = $this->con->prepare("INSERT INTO members (
   fname, lname, sex, district, sector, cell, village, province, dob, phone,  active)
    VALUES (:fn, :ln, :sex, :district, :sector, :cell, :village, :province, :dob, :phone, :active)");
                             $active="yes" ;          

        $query->bindParam(":fn", $firstName);
        $query->bindParam(":ln", $lastName);
        $query->bindParam(":sex", $sex);
        $query->bindParam(":phone", $phone);
        $query->bindParam(":district", $district);
        $query->bindParam(":sector", $sector);
        $query->bindParam(":cell", $cell);
        $query->bindParam(":village", $village);
        $query->bindParam(":province", $province);
        $query->bindParam(":dob", $dob);
        $query->bindParam(":active", $active);
         if ($query->execute()) {
           $credential=array();
            array_push($credential,$this->con->lastInsertId());
           array_push($credential, $phone);
            array_push($credential, "6");
        return $credential;
         }
         else{
            array_push($this->errorArray, Constants::$registerFailed);
            return 0;
         }
    }
    
    private function validateFirstName($fn) {
        if(strlen($fn) > 25 || strlen($fn) < 2) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }

    private function validateLastName($ln) {
        if(strlen($ln) > 25 || strlen($ln) < 2) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    private function validatePhone($un) {
        if(strlen($un) > 15 || strlen($un) < 10) {
            array_push($this->errorArray, Constants::$PhoneInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT phone FROM members WHERE phone=:un");
        $query->bindParam(":un", $un);
        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
        }

    }
 private function validateSex($sex)
  {
      if(empty($sex)) {
            array_push($this->errorArray, Constants::$SelectSex);
            return;
        }
  }
  private function validateMerital($merital)
  {
      if(empty($merital)) {
            array_push($this->errorArray, Constants::$SelectMeritalStatus);
            return;
        }
  }
    // private function validateEmails($em, $em2) {
    //     if($em != $em2) {
    //         array_push($this->errorArray, Constants::$emailsDoNotMatch);
    //         return;
    //     }

    //     if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
    //         array_push($this->errorArray, Constants::$emailInvalid);
    //         return;
    //     }

    //     $query = $this->con->prepare("SELECT email FROM users WHERE email=:em");
    //     $query->bindParam(":em", $em);
    //     $query->execute();

    //     if($query->rowCount() != 0) {
    //         array_push($this->errorArray, Constants::$emailTaken);
    //     }

    // }

    private function validateId($id) {
     
   if(strlen($id) != 16) {
            array_push($this->errorArray, Constants::$IdInvalid);
            return;
        }
        if(preg_match("/[^0-9]/", $id)) {
            array_push($this->errorArray, Constants::$IdNotAlphanumeric);
            return;
        }

        
    }
    
    public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }

}
?>