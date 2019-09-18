<?php
include "includes/header.php";
?>
<div class="wrapper">
        <div class="row">
        <h3>Welcome to ikimina-maranata </h3>
            <div class="head"></div>
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
                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block"> Login </button>
                    <hr>
                </form>
            </div>
          
        </div>
</div>
</div>

<?php
include "includes/footer.php";
?>
