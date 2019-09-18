<?php
include "includes/header.php";
include "includes/dbconnect.php";
require_once("includes/classes/Constants.php"); 
require_once("includes/classes/FormSanitizer.php"); 
require_once("includes/classes/Account.php");


$account = new Account($con);
if (isset($_POST['login'])) {
   
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    $wasSuccessful = $account->login($username, $password);
      
    if($wasSuccessful=="0") {
       $_SESSION["user"] = $username;
       $_SESSION["role"] = $wasSuccessful;
     header("Location: users/");
     exit();
    }
    if($wasSuccessful=="1") {
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $wasSuccessful;
      header("Location: imari/");
      exit();
     }
     if($wasSuccessful=="2") {
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $wasSuccessful;
      header("Location: loan_provider/");
      exit();
     }
     if($wasSuccessful=="3") {
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $wasSuccessful;
      header("Location: nyobozi/");
      exit();
     }
     if($wasSuccessful=="4") {
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $wasSuccessful;
      header("Location: loan_corrector/");
      exit();
     }
     if($wasSuccessful=="5") {
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $wasSuccessful;
      header("Location: superadmin/");
      exit();
     }

}

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>
<div class="wrapper">
        <div class="row all">
        <div class="head">
            <h3>Welcome to ikimina-maranata </h3>
        </div>
            <div class="col-md-5 use">
           
                <form action="index.php" method="POST">
                    <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
                    </div>
                    <div class="form-group">
                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <input type="text" name="username" class="form-control form-control-user" placeholder="Username" value="<?php getInputValue('username'); ?>"  required>
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block" > Login </button>
                    <hr>
                </form>
            </div>
        </div>
</div>
</div>
<style>
.signInMessage {
    font-size: 14px;
    font-weight: 400;
    color: #212529;
}

.errorMessage {
    color: #f00;
    font-size: 14px;
    font-weight: 400;
    text-align: center;
}
.use{

  margin-bottom: 16.1vh;
  margin-left:23vw;
  margin-right: 22.5vw;
  box-shadow: 8px 4px 8px #ccc;
  border: 1px solid #111;
}
.use form{
  margin-top: 5vh;
  margin-bottom: 5vh;
  margin-left:3vw;
  margin-right:3vw;
}
.head{
    margin-bottom: 5vh;
    margin-left:28vw; 
    margin-right: 22.5vw;
   
}
.all{
    margin-top:22vh;
}
</style>
<?php
include "includes/footer.php";
?>
