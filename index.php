<?php 
    define('SECURE', false);
    require_once 'secure.php';
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
        <div class="row">  
            <div class="row text-center"><img src ="img/logo.png" /></div>
            <h3 class="text-center">What would you like to do?</h3>
            <br>
            <div  id="donate-div"  class="col-sm-6">
                <div class="well text-center">
                    <h3>Donate</h3>
                    <hr />
                    <p><i>Got any spare food that you are about to throw away?</i></p>
                    <br />                    
                    <p>Many social events that provide food end up with a surplus of fresh meals and drinks. But why throw them away when you could give them to people who can't afford to eat?</p>
                    <p>The purpose of the <strong class="text-info">UK Spare Food Initiative</strong> is to prevent spare edible food going to waste. If you or your organisation would like to donate food to those in need then get started by clicking the register button before!</p>
                    <br />
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
        
            <div id="receive-div" class="col-sm-6">
                <div class="well text-center">
                    <h3>Receive</h3>
                    <hr />
                    <p><i>Looking to supply food to those in need?</i></p>
                    <br />
                    <p>If you are an individual or organisation that helps to provide food for people and charities who cannot provide it for themselves, then you have come to the right place.</p>
                    <p>We'll help connect you to a wide range of sources of surplus food, notifying you when food becomes available that matches your preferences and capabilities. Start by clicking the register button below!</p>
                    <br />
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
                
        <div class="row">
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
            
            console.log($('#receive-div'));
            console.log($('#donate-div'));
            $('#receive-div').height($('#donate-div').height());
            $(window).resize(function () {
               $('#receive-div').height($('#donate-div').height());
            });
		</script>
    </body>
</html>