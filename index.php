<?php
include "includes/header.php";
?>
<div class="wrapper">
        <div class="row all">
        <div class="head">
            <h3>Welcome to Ikimina-Maranata </h3>
        </div>
            <div class="col-md-5 use">
           
                <form action="login.php" method="POST">
                    <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
                    </div>
                    <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-user" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary form-control"> Login </button>
                    <hr>
                </form>
            </div>
        </div>
</div>
</div>
<style>
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
