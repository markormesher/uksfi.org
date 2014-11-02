<?php 
    define('SECURE', false);
    require_once 'secure.php';

    $failedLogin = false;
    if (isset($_POST) && isset($_POST['sent'])) {
        // collect variables
        $password = $_POST['password'];
        $email = $_POST['email'];
        
        require_once 'connections/sql.php';
        require_once 'db/master-list.php';
        
        $check = db_checkLogin($email, $password);
        if ($check !== false) {
            $_SESSION['userID'] = $check['id'];
            header('Location: home.php');
        }  else {
            $failedLogin = true;   
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UKSFI</title>

        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/cerulean-bootstrap.min.css"/>
        <link rel="stylesheet" href="css/site.css"/>
    </head>
    <body>
        
    <div class="container body-content"> 
        <div class="row text-center"><img src ="img/logo.png" /></div>
        <div class="col-sm-6 col-sm-offset-3">
            <?php if($failedLogin) { ?>
                <p>Login failed, sorry bro.</p>
            <?php } ?>
            <form class="form-horizontal" action="login.php" method="post" style="margin-top:20px;">
                <input type="hidden" name="sent" value="1" />
              <fieldset>   
              <legend class="text-left">Enter your details below to log in</legend>
                <div class="form-group">
                  <label for="email" class="col-lg-4 control-label">Email</label>
                  <div class="col-lg-6">
                    <input class="form-control" id="email" placeholder="Email" type="text" name="email" value="<?php if (isset($_POST) && isset($_POST['email'])) echo($_POST['email']); ?>">
                  </div>
                </div>                   
              
              <div class="form-group">
                  <label for="password" class="col-lg-4 control-label">Password</label>
                  <div class="col-lg-6">
                    <input class="form-control" id="password" placeholder="Password" type="password" name="password">
                  </div>
              </div>                 
                <button id="register-finish-btn" class="btn btn-success btn-lg pull-right">Log in</button>
              </fieldset>
            </form> 
            <span class="text-primary pointer-cursor">Forgot password?</span>
        </div>
    </div>
        
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$('.register-btn').click(function(e) {
                e.preventDefault();
                $(this).siblings('.register-form').slideDown('slow',function() {
                  $(this).toggleClass('collapse');
                });
            });
		</script>
    </body>
</html>