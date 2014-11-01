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
        <div id="filters" class="col-sm-3">                               
                <h3>Food type</h4>
            
                <ul class="list-group">
                    <li class="list-group-item checkbox-label">
                    <input class="checkbox-main" type="checkbox" />
                        <label>Canned food</label>
                    </li>
                    
                    <li class="list-group-item checkbox-label">
                    <input class="checkbox-main" type="checkbox" />
                        <label>Packaged food</label>
                    </li>
                    
                    <li class="list-group-item checkbox-label">
                    <input class="checkbox-main" type="checkbox" />
                        <label>Canned food</label>
                    </li>
                    
                    <li class="list-group-item checkbox-label">
                    <input class="checkbox-main" type="checkbox" />
                        <label>Confectionery</label>
                    </li>
                    
                    <li class="list-group-item checkbox-label">
                    <input class="checkbox-main" type="checkbox" />
                        <label>Soft drinks</label>
                    </li>
                    
                    <li class="list-group-item checkbox-label">
                    <input class="checkbox-main" type="checkbox" />
                        <label>Fresh food</label>
                    </li>
                    
                    <li class="list-group-item checkbox-label">
                    <input class="checkbox-main" type="checkbox" />
                        <label>Frozen food</label>
                    </li>
                    
                    <li class="list-group-item checkbox-label">
                    <input class="checkbox-main" type="checkbox" />
                        <label>Basic ingredients</label>
                    </li>
                </ul>
            
                <h3>Collection</h5>
                
                 <ul class="list-group">
                    <li class="list-group-item checkbox-label">
                    <input class="checkbox-main" type="checkbox" />
                        <label>Delivery</label>
                    </li>
                    
                    <li class="list-group-item checkbox-label">
                    <input class="checkbox-main" type="checkbox" />
                        <label>Collection in person</label>
                    </li>
            </ul>
                
        </div>
        
        <div id="listings-section" class="col-sm-9">
            <div class="row">
                <h3 class="text-center">Active listings</h3>
            </div>
            
            <div class="row">
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <h4>Leftover sandwiches from hackaton <span style="font-size:12px;" class="help-block listing-tags">Packaged food, Drinks</span></h4>
                    </div>
                  <div class="panel-body">
                    <div class="col-sm-8 listing-info">
                        <p class="listing-location"><span>London, WC1E 7HU</span></p>
                        <p class="listing-company"><span>MLHacks</span></p>
                        <p class="listing-descr"><span>We have some leftover sandwiches from our Student Hack event last weekend! Additionally, there's 20 packs of Red Bull that Mark wasn't able to finish due to passing out after his 46th drink.</span></p>
                        <p class="listing-posted collapse"><span>Date posted: 2nd November 2014</span></p>                        
                        <p class="listing-expiry"><span>Expires: 5th November 2014</span></p>  
                        <p class="text-danger listing-expand pointer-cursor"><span class="fa fa-angle-double-down"></span> More information</p>
                    </div>
                      
                    <div class="col-sm-4 thumbnail listing-thumbnail">
                        <img src="http://i1.kym-cdn.com/photos/images/facebook/000/581/296/c09.jpg" />
                    </div>
                  </div>
                  <div class="panel-footer">
                      <p class="listing-user-status text-info"><span>You've expressed your interest.</span></p>
                  </div>                
            </div>
        </div>                
    </div>
        </div>
    </div>
        
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">            
                        
            $('.listing-thumbnail img').height($('.thumbnail').siblings('.col-sm-8').height()*0.9);
            $('.listing-thumbnail').width($('img').width());
            
            $('.listing-expand').click(function(e) {
                var datePosted = $(this).siblings('.listing-posted');
                var expander = $(this);
                if($(datePosted).hasClass('collapse')) {
                    $(datePosted).removeClass('collapse');
                    $(expander).html('<span class="fa fa-angle-double-up"></span> Less information');
                   } else {
                        $(datePosted).addClass('collapse');
                        $(expander).html('<span class="fa fa-angle-double-down"></span> More information');                                                    }                  
            });
		</script>
    </body>
</html>