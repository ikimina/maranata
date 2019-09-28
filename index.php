<?php
session_start();
include "includes/header.php";
include "includes/dbconnect.php";
require_once("includes/classes/Constants.php"); 
require_once("includes/classes/FormSanitizer.php"); 
require_once("includes/classes/Account.php");
//session_start();

$account = new Account($con);
if (isset($_POST['login'])) {
   
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    $wasSuccessful = $account->login($username, $password);
      switch ($wasSuccessful) {
        case '6':
       $_SESSION["user"] = $username;
       $_SESSION["role"] = $wasSuccessful;
       header("Location: users/");
          break;
        case '1':
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $wasSuccessful;
         header("Location: imari/");
          break;
        case '2':
         $_SESSION["user"] = $username;
        $_SESSION["role"] = $wasSuccessful;
        header("Location: loan_provider/");
          break;
        case '3':
         
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $wasSuccessful;
        header("Location: nyobozi/");
          break;
        case '4':
         
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $wasSuccessful;
        header("Location: loan_corrector/");
         break;
        case '5':
         
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $wasSuccessful;
        header("Location: superadmin/");
         
         break;
     
        default:
        session_destroy();
          break;
      }
  
    

}

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?><body>
<div class="containe" style="height: 300px; margin: 1px 1px 1px;">
  <img  src="images/logo.jpg" style="width: 100%; height:100%;z-index:-1;position:relative;">
</div>
<div class="container" style="margin-top: -200px;z-index:1000;position:relative;">
        <div class="row all">
        <div class="head"><div class="row">
          <div class="col-md-3"></div>
<div class="col-md-8">
 
            </div><div class="col-md-1"></div>
          </div>
        </div>
            <div class="col-md-5 use" style="background-color: white;">
           
                <form action="index.php" method="POST">
                    <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
                    </div>
                    <div class="form-group">
                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <input type="text" name="username" class="form-control form-control-user" placeholder="Telephone" value="<?php getInputValue('username'); ?>"  required>
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
</body>
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
    margin-top:17vh;
}
</style>
<?php
include "includes/footer.php";
?>
