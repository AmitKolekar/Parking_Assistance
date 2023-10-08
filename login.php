<?php
    error_reporting(0);
?>

<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

  <!-- Basic Page Needs -->
  <meta charset="utf-8"/>
  <title>Online Parking Portal</title>
  <meta name="description" content=""/>
  <meta name="author" content=""/>

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

  <!-- Main Style -->
  <link rel="stylesheet" href="css/style.css"/> 
  
  <!-- Color Style -->
  <link rel="stylesheet" href="css/skins/colors/red.css" name="colors"/>
  
  <!-- Layout Style -->
  <link rel="stylesheet" href="css/layout/wide.css" name="layout"/>
  
  <!--[if lt IE 9]>
      <script src="js/html5.js"></script>
  <![endif]-->
  
  <script type="text/javascript">
function validate_form()
{
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    
    if(username=='')
    {
        alert("Please Enter User Name.");
        return false;
        
    }
    else if(password=='')
    {
        alert("Please Enter Password.");
        return false;
        
    }
}
</script>


  
  
   <?php
    require_once "parking_helper.php";
    //require_once "admin/check.php";
    $helper=new ParkingHelper();
    $msg='';
    if($_POST)
    {
        $msg=$helper->checkLogin();
    }
  ?>
</head>
<body>

  <div id="wrap" class="boxed">
  
    <?php
        require_once "header.php";
    ?>
  
    <div class="page-title">
     <div class="container clearfix">
       
       <div class="sixteen columns"> 
         <h1>Login</h1>
       </div>
       
     </div><!-- End Container -->
   </div>
   
   <div class="style-2 home s-2 bottom-3">
     <div class="container clearfix">
        
        <div class="eight columns bottom-3" >
       
       <?php
            if($msg!='')
            {
                ?>
                
                <div class="alert error hideit">
                <i class="icon-check"></i>
                <p><?php echo $msg; ?></p>
                <i class="icon-remove close"></i>
                </div>
                
                <?php
            }
       ?>
        
       
        
        <form class="form-elements" action="" method="post" onsubmit="return validate_form();">
         
        
         <fieldset>
          <span>User Name : </span>
          <input type="text" name="username" id="username"/>
          </fieldset>

          <fieldset>
          <span>Password : </span>
          <input type="password"  name="password" id="password"/>
          </fieldset>
                
          <div class="clear"></div>
          
          <fieldset>
          <span>&nbsp; </span>
           <input type="submit" class="button small color" value="Login"/>
         
          </fieldset>
         
          </form>

        
       </div>       
          
     </div><!-- End Container -->
   </div><!-- End services -->
   
 
   <?php
    require_once "footer.php";
   ?>
  
  </div><!-- End wrap -->
  
  <!-- Start JavaScript -->
  <script src="js/jquery-1.9.1.min.js"></script> <!-- jQuery library -->
  <script src="js/jquery.easing.1.3.min.js"></script> <!-- jQuery Easing --> 
  <script src="js/jquery-ui/jquery.ui.core.js"></script> <!-- jQuery Ui Core-->
  <script src="js/jquery-ui/jquery.ui.widget.js"></script> <!-- jQuery Ui Widget -->
  <script src="js/jquery-ui/jquery.ui.accordion.js"></script> <!-- jQuery Ui accordion--> 
  <script src="js/ddsmoothmenu.js"></script> <!-- Nav Menu ddsmoothmenu -->
  <script src="js/jquery.flexslider.js"></script> <!-- Flex Slider  -->
  <script src="js/colortip.js"></script> <!-- Colortip Tooltip Plugin  -->
  <script src="js/tytabs.js"></script> <!-- jQuery Plugin tytabs  -->
  <script src="js/jquery.ui.totop.js"></script> <!-- UItoTop plugin  -->
  <script src="js/carousel.js"></script> <!-- jQuery Carousel  -->
  <script src="js/jquery.isotope.min.js"></script> <!-- Isotope Filtering  -->
  <script src="js/doubletaptogo.js"></script> <!-- Touch-friendly Script  -->
  <script src="js/fancybox/jquery.fancybox.js"></script> <!-- jQuery FancyBox -->
  <script src="js/jquery.sticky.js"></script> <!-- jQuery Sticky -->
  <script src="js/custom.js"></script> <!-- Custom Js file for javascript in html -->
  <script type="text/javascript">
  function checkHOD(value)
  {
        if(value == "3")
        {
            jQuery("#div_dept").show();
        }
        else
        {
            jQuery("#div_dept").hide();
        }
  }
  </script>
  
  <!-- End JavaScript -->    
</body>
</html>