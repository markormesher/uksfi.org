<?php 
    define('SECURE', true);
    require_once 'secure.php';

if (isset($_POST) && isset($_POST['sent'])) {
      // collect variables
        $name = $_POST['listing-title'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $address3 = $_POST['address3'];
        $city = $_POST['city'];
        $postcode = $_POST['postcode'];
        $country = $_POST['country'];
        $description = $_POST['description'];
        $collection = $_POST['collection'];
    
        // check for errors
        $errorCodes = array();
        
        if(is_array($_POST['food-type'])) {
            $type = implode (',', $_POST['food-type']);
        } else {
            $errorCodes[] = 'food-type';
        }
    
        //display errors
        
        if (empty($errorCodes)) {
            require_once "connections/sql.php";
            require_once "db/master-list.php";
            $listingID = db_createNewListing(array(
                "donor_id" => $USER['id'],
                "title" => $name,
                "address_1" => $address1,
                "address_2" => $address2,
                "address_3" => $address3,
                "city" => $city,
                "postcode" => $postcode,
                "country" => $country,
                "description" => $description,
                "can_deliver" => $collection,
                "contents" => $type
            ));
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
        <title>UKSFI</title>

        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/cerulean-bootstrap.min.css"/>
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/site.css"/>
    </head>
    <body>
        
    <div class="container body-content">               
        <div class="row">            
            <div id="create-listing" class="col-sm-6 col-sm-offset-3">
                <h2 class="text-center" style="margin-bottom:20px;">Create your listing</h2>
                <form class="form-horizontal" action="create-listings.php" method="post">
                    <input type="hidden" name="sent" value="1" />
                  <fieldset>   
                  <legend class="text-left">Enter your details below</legend>
                    <div class="form-group">
                      <label for="listing-title" class="col-lg-3 control-label">Listing Title</label>
                      <div class="col-lg-7">
                        <input class="form-control" id="listing-title" placeholder="Listing title" type="text" name="listing-title">
                      </div>
                    </div>  
                    
                <div class="form-group">
                  <label for="address1" class="col-lg-3 control-label">Address 1</label>
                  <div class="col-lg-7">
                    <input class="form-control" id="address1" placeholder="Address" type="text" name="address1">   
                      <span id="address1-add" class="help-block text-right">Add another line of address</span>
                  </div>
                </div>  
                  
                <div id="address2-div" class="form-group collapse">
                  <label for="address2" class="col-lg-3 control-label">Address 2</label>
                  <div class="col-lg-7">
                    <input class="form-control" id="address2" placeholder="Address" type="text" name="address2">                                    
                      <span id="address2-add" class="help-block text-right">Add another line of address</span>
                  </div>
                    <div class="col-sm-2">
                        <span id="address2-remove" class="fa fa-minus control-label"></span>
                    </div>
                </div> 
                  
                <div id="address3-div" class="form-group collapse">
                  <label for="address3" class="col-lg-3 control-label">Address 3</label>
                  <div class="col-lg-7">
                    <input class="form-control" id="address3" placeholder="Address" type="text" name="address3">
                  </div>
                    <div class="col-sm-2">
                        <span id="address3-remove" class="fa fa-minus control-label"></span>
                    </div>
                </div>  
                  
                     <div class="form-group">
                      <label for="city" class="col-lg-3 control-label">City</label>
                      <div class="col-lg-7">
                        <input class="form-control" id="city" placeholder="City" type="text" name="city">                         
                      </div>
                     </div>
                      
                    <div class="form-group">
                         <label for="postcode" class="col-lg-3 control-label">Postcode</label>
                         <div class="col-lg-7">
                            <input class="form-control" id="postcode" placeholder="Postcode" type="text">                         
                        </div>
                    </div> 

                    <div class="form-group">
                      <label for="country" class="col-lg-3 control-label">Country</label>
                      <div class="col-lg-7">
                        <input class="form-control" id="country" placeholder="Country" type="text" name="country">                         
                      </div>
                    </div>  

                      <div class="form-group">
                      <label for="description" class="col-lg-3 control-label">Description</label>
                      <div class="col-lg-7">
                        <textarea class="form-control" rows="3" id="description" name="description" placeholder="Write a description of the food and drinks you offer. Make sure you mention things like expiry date etc." style="resize:none;"></textarea>                   
                      </div>
                    </div>
                      
                      <div class="form-group">
                      <label class="col-lg-3 control-label">Food type</label>
                          <div class="col-lg-6 col-lg-offset-1">
                        <div class="checkbox">
                            <input type="checkbox" value='canfood' name="food-type[]"> Canned Food
                        </div>
                          <div class="checkbox">
                            <input type="checkbox" value='packfood'  name="food-type[]"> Packaged food                          
                        </div>
                          <div class="checkbox">                          
                            <input type="checkbox" value='confec' name="food-type[]"> Confectionery    
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" value='drinks'  name="food-type[]"> Bottled Soft Drinks
                        </div>  
                          
                        <div class="checkbox">
                            <input type="checkbox" value='fresh' name="food-type[]"> Fresh food
                        </div>  
                        <div class="checkbox">
                            <input type="checkbox" value='frozen' name="food-type[]"> Frozen food
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" value='ingred' name="food-type[]"> Basic ingredients
                        </div>   
                        </div>      
                      </div>
                      
                      <div class="form-group">
                      <label class="col-lg-3 control-label">Collection</label>
                          <div class="col-lg-7">
                      <div class="radio-inline">
                          
                            <input type="radio" value="delivery" name='collection'> Delivery
                         
                        </div>
                        <div class="radio-inline">
                         
                            <input type="radio" value="in-person" name='collection'> Collection in person
                        </div>
                        </div>                            
                      </div>
                      
                    <button id="create-listing-btn" class="btn btn-primary pull-right">Submit</button>
                  </fieldset>
                </form> 
            </div>
                
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