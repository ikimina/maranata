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
    public function register($firstName, $lastName, $phone, $idNo, $sex, $merital, $dob,$province,$district,$sector,$cell,$village,$type,$file,$email,$signature,$accountName,$accountNumber,$bankName) {
        
        $this->validateFirstName($firstName);
        $this->validateLastName($lastName);
        $this->validatePhone($phone);
        $this->validateId($idNo);
        $this->validateSex($sex);
        $this->validateMerital($merital);
        $this->validateEmails($email);
         if ($type!=null && empty($this->errorArray)) {
            $location= $this->uploadPicture($file);
            $this->validatePhoneAdmin($phone);
           
             return $this->insertStaffDetails($firstName, $lastName, $phone, $idNo, $sex, $merital, $dob,$province,$district,$sector,$cell,$village,$type,$location,$email);
          }
        
        if(empty($this->errorArray)) {
        $signatureLocation= $this->uploadSignaturePicture($signature);
        $location= $this->uploadPicture($file);
            return $this->insertUserDetails($firstName, $lastName, $phone, $idNo, $sex, $merital, $dob,$province,$district,$sector,$cell,$village,$location,$accountNumber,$accountName,$bankName,$signatureLocation);
        }
        else {
            return false;
        }
    }

    public function insertStaffDetails($firstName, $lastName, $phone, $idNo, $sex, $merital, $dob,$province,$district,$sector,$cell,$village,$type,$file,$email)
    {
      
     
        $query = $this->con->prepare("INSERT INTO staff (fname, lname, sex, district, sector, cell, village, province, dob, phone, role, email, active, picture,mstatus)
    VALUES (:fn, :ln, :sex, :district, :sector, :cell, :village, :province, :dob, :phone,:role,:email, :active,:picture,:mstatus)");
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
        $query->bindParam(":role", $type);
        $query->bindParam(":email", $email);
        $query->bindParam(":active", $active);

        $query->bindParam(":picture", $file);
         $query->bindParam(":mstatus", $merital);
         if ($query->execute()) {
          
        return $this->insertCredention($this->con->lastInsertId(),$phone,$type);
         }
         else{
            array_push($this->errorArray, Constants::$registerFailed);
            return false;
         }

    }
    public function insertUserDetails($firstName, $lastName, $phone, $idNo, $sex, $merital, $dob,$province,$district,$sector,$cell,$village,$location,$accountNumber,$accountName,$bankName,$signature) {

        $query = $this->con->prepare("INSERT INTO members (fname, lname, sex, district, sector, cell, village, province, dob, phone, active, profilepic, signature, bank, accountname, accountnumber)
    VALUES (:fn, :ln, :sex, :district, :sector, :cell, :village, :province, :dob, :phone, :active,:profilepic,:signature,:bank,:accountname,:accountnumber
  )");
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
        $query->bindParam(":profilepic", $location);
        $query->bindParam(":signature", $signature);
        $query->bindParam(":bank", $bankName);
        $query->bindParam(":accountname", $accountName);
        $query->bindParam(":accountnumber", $accountNumber);
         if ($query->execute()) {
           
        return $this->insertCredention($this->con->lastInsertId(),$phone,"6");;
         }
         else{
            array_push($this->errorArray, Constants::$registerFailed);
            return false;
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

    private function validatePhoneAdmin($un) {
        if(strlen($un) > 15 || strlen($un) < 10) {
            array_push($this->errorArray, Constants::$PhoneInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT phone FROM staff WHERE phone=:un");
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
    private function validateEmails($em) {
       if ($em==null) {
           return;
       }

        if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT email FROM staff WHERE email=:em");
        $query->bindParam(":em", $em);
        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }

    }

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
  public function insertCredention($uid,$username,$type)

  {    $password="00000";
       $query = $this->con->prepare("INSERT INTO credential(user_id, username, password,type)
                                    VALUES (:uid, :username, :password, :type)") ;          
      
        $query->bindParam(":uid", $uid);
        $query->bindParam(":username", $username);
        $query->bindParam(":password", $password);
         $query->bindParam(":type", $type);

        if ($query->execute()) {
            return true;
        }
        else{
        return false;
                }
        
  }
  public function uploadPicture($file)
  {
     $allowed=array('gif','jpg','jpeg','png');
     $fileName1=$file['name'];
     $fileExt1=explode('.', $fileName1);
     $fileActualExt1=strtolower(end($fileExt1));
     if (in_array($fileActualExt1, $allowed)) {
      $newname1 =$fileExt1[0].uniqid('',true).".".$fileActualExt1;
       $saveto='../images/staff/'.$newname1;
      if(move_uploaded_file( $file['tmp_name'],$saveto)){
          
        return  $saveto;
      } 
     }
       else{
         array_push($this->errorArray, Constants::$invaliImage);
         return;
       }
}

 public function uploadSignaturePicture($file)
  {
     $allowed=array('gif','jpg','jpeg','png');
     $fileName1=$file['name'];
     $fileExt1=explode('.', $fileName1);
     $fileActualExt1=strtolower(end($fileExt1));
     if (in_array($fileActualExt1, $allowed)) {
      $newname1 =$fileExt1[0].uniqid('',true).".".$fileActualExt1;
       $saveto='../images/signature/'.$newname1;
      if(move_uploaded_file( $file['tmp_name'],$saveto)){
          
        return  $saveto;
      } 
     }
       else{
         array_push($this->errorArray, Constants::$invaliImage);
         return;
       }
}








} ?>