<?php 
    define('SECURE', false);
    require 'secure.php';
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
       <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">

              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Brand</a>
              </div>
              <div class="navbar-collapse collapse navbar-inverse-collapse">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Active</a></li>
                  <li><a href="#">Link</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li class="dropdown-header">Dropdown header</li>
                      <li><a href="#">Separated link</a></li>
                      <li><a href="#">One more separated link</a></li>
                    </ul>
                  </li>
                </ul>
                <form class="navbar-form navbar-left">
                  <input class="form-control col-lg-8" placeholder="Search" type="text">
                </form>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#">Link</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
       </div>
    </div>
        
    <div class="container body-content">               
        <div class="row">            
            <h3 class="text-center">What would you like to do?</h3>
            <br>
            <div class="col-sm-6">
                <div class="well text-center">
                    <h3>Give</h3>
                    <hr />
                    <p>Got spare food or drinks?</p>
                    <p>Got spare food or drinks?</p>
                    <p>Got spare food or drinks?</p>
                    <button type="button" id="give-register-btn" class="register-btn btn btn-primary">Register as a donor</button>
                    <div class="register-form collapse">
                        <form class="form-horizontal" action="register-donor.php" method="post">
                          <fieldset>   
                          <legend class="text-left">Enter your details below</legend>
                            <div class="form-group">
                              <label for="name-donor" class="col-lg-3 control-label">Full Name</label>
                              <div class="col-lg-6">
                                <input class="form-control" id="name-donor" placeholder="Name" type="text" name="full_name">
                              </div>
                            </div>  
                              
                            <div class="form-group">
                              <label for="email-donor" class="col-lg-3 control-label">Email</label>
                              <div class="col-lg-6">
                                <input class="form-control" id="email-donor" placeholder="Email" type="text" name="email">
                              </div>
                            </div>   
                            <button id="register-finish-btn" class="btn btn-warning pull-right">Go</button>
                          </fieldset>
                        </form> 
                    </div>
                </div>
            </div>
        
            <div class="col-sm-6">
                <div class="well text-center">
                    <h3>Receive</h3>
                    <hr />
                    <p>Got spare food or drinks?</p>
                    <p>Got spare food or drinks?</p>
                    <p>Got spare food or drinks?</p>
                    <button type="button" id="receive-register-btn" class="register-btn btn btn-primary">Register as a receiver</button>             
                    <div class="register-form collapse" >
                        <form class="form-horizontal" action="register-receiver.php" method="post">
                          <fieldset>   
                          <legend class="text-left">Enter your details below</legend>
                            <div class="form-group">
                              <label for="name-receiver" class="col-lg-3 control-label">Full Name</label>
                              <div class="col-lg-6">
                                <input class="form-control" id="name-receiver" placeholder="Name" type="text" name="full_name">
                              </div>
                            </div>  
                              
                            <div class="form-group">
                              <label for="email-receiver" class="col-lg-3 control-label">Email</label>
                              <div class="col-lg-6">
                                <input class="form-control" id="email-receiver" placeholder="Email" type="text" name="email">
                              </div>
                            </div>   
                              <button id="register-finish-btn" class="btn btn-warning pull-right">Go</button>
                          </fieldset>
                        </form> 
                    </div>
                </div>            
            </div>                    
        </div>
                
        <div class="row ">
            <form class="form-horizontal" action="login.php">
                <fieldset> 
                    <button type="submit" id="login-btn" class="btn btn-success btn-lg pull-right">Log in</button>
                </fieldset>
            </form> 
        </div>
                
        <!--<hr />
        <footer>
            <p>&copy; @DateTime.Now.Year - The Careers Group</p>
        </footer>-->
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