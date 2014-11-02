<?php 
    define('SECURE', true);
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
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/site.css"/>
    </head>
    <body>
    <div class="container body-content">   
        <div class="row text-center"><img src ="img/logo.png" /></div>
        <div class="row">
        <div id="filters" class="col-sm-3">                               
                <h3>Food type</h4>
            
                <ul class="list-group">
                    <?php
                    $types = array();
                    $types['canfood'] = 'Canned Food';
                    $types['packfood'] = 'Packaged Food (Unopened)';
                    $types['confec'] = 'Confectionery';
                    $types['drinks'] = 'Bottled Soft Drinks';
                    $types['fresh'] = 'Fresh Food';
                    $types['frozen'] = 'Frozen Food';
                    $types['ingred'] = 'Basic Ingredients';
                    foreach ($types as $k => $v) {
                        echo('<li class="list-group-item checkbox-label"><input class="checkbox-main" type="checkbox" name="filter_food_type[]" value="'.$k.'" checked="checked" /> <label>'.$v.'</label></li>');
                    }
                    ?>
                </ul>
            
                <h3>Collection</h5>
                
                 <ul class="list-group">
                    <li class="list-group-item checkbox-label">
                    <input class="checkbox-main" type="checkbox" />
                        <label>Can be delivered</label>
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
            <?php
                $listings = db_getListings(array(), $USER['id']);
                foreach($listings as $l) {
                ?> 
                  <div class="row">
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <h4><?=$l['title'];?> <span style="font-size:12px;" class="help-block listing-tags"><?php
                        $contents = explode(',', $l['contents']);
                    foreach ($contents as $k => $c) $contents[$k] = $types[$c];
                    echo(implode(', ', $contents));
                          ?></span></h4>
                    </div>
                  <div class="panel-body">
                    <div class="col-sm-8 listing-info">
                        <p class="listing-location"><span><?=$l['address_1'];?>, <?=$l['postcode'];?></span></p>
                        <p class="listing-descr"><span><?=$l['description'];?></span></p>
                        <p class="listing-posted collapse">Posted: <span><?=date('j\<\s\u\p\>S\<\/\s\u\p\> M Y', strtotime($l['posted_on']));?></span></p>                        
                        <p class="listing-expiry">Expires: <span><?=date('j\<\s\u\p\>S\<\/\s\u\p\> M Y', strtotime($l['expires_on']));?></span></p>  
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
        </div> <?php
                }
            ?>               
    </div>
        </div>
    </div>
        
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">            
                        
            $('.listing-thumbnail img').height($('.thumbnail').siblings('.col-sm-8').height()*0.9);
            $('.listing-thumbnail').width($('.listing-thumbnail img').width());
            
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