<?php 
    define('SECURE', false);
    require_once 'secure.php';

    if (isset($_POST) && isset($_POST['sent'])) {
        // collect variables
        $name = $_POST['full-name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];
        $companyName = $_POST['company-name'];
        $phone1 = $_POST['phone1'];
        $phone2 = $_POST['phone2'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $address3 = $_POST['address3'];
        $city = $_POST['city'];
        $postcode = $_POST['postcode'];
        $country = $_POST['country'];
        $description = $_POST['description'];
        
        // check for errors
        $errors = array();
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "That's not a valid email address.";
        }
        
        if($password != $confirmPassword) { 
            $errors[] = "Your passwords did not match.";
        }
        
        //display errors
        
        if (empty($errors)) {
            require_once "connections/sql.php";
            require_once "db/master-list.php";
            $userID = db_createNewUser(array(
                "name" => $name,
                "password" => $password,
                "email" => $email,
                "company_name" => $companyName,
                "phone_1" => $phone1,
                "phone_2" => $phone2,
                "address_1" => $address1,
                "address_2" => $address2,
                "address_3" => $address3,
                "city" => $city,
                "postcode" => $postcode,
                "country" => $country,
                "bio" => $description,
                "user_type" => "receiver"
            ));
            $_SESSION['userID'] = $userID;
            header("Location: home.php");
        } 
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>

        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/cerulean-bootstrap.min.css"/>
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
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
        <div class="col-sm-6 col-sm-offset-3 well">
            <?php 
                if(!empty($errors)) {
                    echo('<p> The following error(s) occurred: </p>');
                    echo('<ul>');
                    foreach($errors as $e) {
                        echo('<li>' . $e . '</li>');
                    }
                    echo('</ul>');                    
                    
                }
            ?>
            <form class="form-horizontal" action="register-receiver.php" method="post">
                <input type="hidden" name="sent" value="1" />
              <fieldset>   
              <legend class="text-left">Register as a receiver</legend>
                <div class="form-group">
                  <label for="name" class="col-lg-4 control-label">Full Name</label>
                  <div class="col-lg-6">
                    <input class="form-control" id="name" placeholder="Name" type="text" name="full-name" value="<?php if (isset($_POST) && isset($_POST['full_name'])) echo($_POST['full_name']); ?>">
                  </div>
                </div>  

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
                  
              <div class="form-group">
                  <label for="confirm-password" class="col-lg-4 control-label">Confirm Password</label>
                  <div class="col-lg-6">
                    <input class="form-control" id="confirm-password" placeholder="Confirm Password" type="password" name="confirm-password">
                  </div>
              </div>
                  
                <div class="form-group">
                  <label for="company-name" class="col-lg-4 control-label">Company Name</label>
                  <div class="col-lg-6">
                    <input class="form-control" id="company-name" placeholder="Company Name" type="text" name="company-name">
                  </div>
                </div> 
                  
                <div class="form-group">
                  <label for="phone1" class="col-lg-4 control-label">Phone Number 1</label>
                  <div class="col-lg-6">
                    <input class="form-control" id="phone1" placeholder="Phone Number" type="text" name="phone1">
                  </div>
                </div>
                  
                <div class="form-group">
                  <label for="phone2" class="col-lg-4 control-label">Phone Number 2</label>
                  <div class="col-lg-6">
                    <input class="form-control" id="phone2" placeholder="Phone Number" type="text" name="phone2">
                  </div>
                </div>
                  
                <div class="form-group">
                  <label for="address1" class="col-lg-4 control-label">Address 1</label>
                  <div class="col-lg-6">
                    <input class="form-control" id="address1" placeholder="Address" type="text" name="address1">   
                      <span id="address1-add" class="help-block text-right">Add another line of address</span>
                  </div>
                </div>  
                  
                <div id="address2-div" class="form-group collapse">
                  <label for="address2" class="col-lg-4 control-label">Address 2</label>
                  <div class="col-lg-6">
                    <input class="form-control" id="address2" placeholder="Address" type="text" name="address2">                                    
                      <span id="address2-add" class="help-block text-right">Add another line of address</span>
                  </div>
                    <div class="col-sm-2">
                        <span id="address2-remove" class="fa fa-minus control-label"></span>
                    </div>
                </div> 
                  
                <div id="address3-div" class="form-group collapse">
                  <label for="address3" class="col-lg-4 control-label">Address 3</label>
                  <div class="col-lg-6">
                    <input class="form-control" id="address3" placeholder="Address" type="text" name="address3">
                  </div>
                    <div class="col-sm-2">
                        <span id="address3-remove" class="fa fa-minus control-label"></span>
                    </div>
                </div>  
                  
                 <div class="form-group">
                  <label for="city" class="col-lg-2 control-label">City</label>
                  <div class="col-lg-3">
                    <input class="form-control" id="city" placeholder="City" type="text" name="city">                         
                  </div>
                 <label for="postcode" class="col-lg-2 control-label">Postcode</label>
                 <div class="col-lg-3">
                    <input class="form-control" id="postcode" placeholder="Postcode" type="text">                         
                  </div>
                </div> 
                  
                <div class="form-group">
                  <label for="country" class="col-lg-4 control-label">Country</label>
                  <div class="col-lg-6">
                    <input class="form-control" id="country" placeholder="Country" type="text" name="country">                         
                  </div>
                </div>  
                  
                  <div class="form-group">
                  <label for="description" class="col-lg-4 control-label">Description</label>
                  <div class="col-lg-6">
                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Write a small description of your company business." style="resize:none;"></textarea>                   
                  </div>
                </div>
                  
                  <button id="register-btn" class="btn btn-success pull-right">Register</button>
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
			$('#address1-add').click(function(e) {
               e.preventDefault(); 
                $('#address2-div').fadeIn();
                $(this).hide();
            });
            
            $('#address2-add').click(function(e) {
               e.preventDefault(); 
                $('#address3-div').fadeIn();
                $(this).hide();
            });
            
            $('#address2-remove').click(function(e) {
               e.preventDefault();                 
                $('#address2-div').hide();
                $('#address1-add').fadeIn();
            });
            
            $('#address3-remove').click(function(e) {
               e.preventDefault();                 
                $('#address3-div').hide();
                $('#address2-add').fadeIn();
            });
		</script>
    </body>
</html>