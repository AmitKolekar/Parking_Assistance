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
  <link rel="stylesheet" href="css/custom.css"/> 
  
  <!-- Color Style -->
  <link rel="stylesheet" href="css/skins/colors/red.css" name="colors"/>
  
  <!-- Layout Style -->
  <link rel="stylesheet" href="css/layout/wide.css" name="layout"/>
  
  <!--[if lt IE 9]>
      <script src="js/html5.js"></script>
  <![endif]-->
  
</head>

 <?php
    require_once "parking_helper.php";
    //require_once "admin/check.php";
    $helper=new ParkingHelper();
    $msg='';
    
  ?>


<body>

  <div id="wrap" class="boxed">
  
    <?php
        require_once "header.php";
    ?>
  
   <div class="slider-1 clearfix">
   
     <div class="flex-container">
       <div class="flexslider loading">
        <ul class="slides">
           <li style="background:url(images/slider/parking-1.jpg) no-repeat; background-position:50% 0">
          
              <div class="container">
               <div class="sixteen columns contain">
                
               </div>
             </div><!-- End Container -->
              
         </li><!-- End item -->.
         <li style="background:url(images/slider/parking-2.jpg) no-repeat; background-position:50% 0">
          
              <div class="container">
               <div class="sixteen columns contain">
                
               </div>
             </div><!-- End Container -->
              
         </li><!-- End item -->.
          
         
        </ul>
       </div>
      </div>
     
   </div><!-- End slider -->
   
   <div class="services style-2 home s-2 bottom-3">
     <div class="container clearfix">
     
       <div class="one-third column">
         <div class="item bottom-4">
           <div class="circle float-left"><a href="#"><i class="icon-star"></i></a></div>
           <div class="data float-right">
           <h4><a href="#">User registration login </a></h4>
           <p>User registration and login for find the parking and reserve the parking</p>
           </div>
         </div>
       </div><!-- End item -->
       
       <div class="one-third column">
         <div class="item bottom-4">
           <div class="circle float-left"><a href="#"><i class="icon-star"></i></a></div>
           <div class="data float-right">
           <h4><a href="#">Find the parking slot</a></h4>
           <p>This module used for to find the parking slot to user as area offices wise.</p>
           </div>
         </div>
       </div><!-- End item -->
       
       <div class="one-third column">
         <div class="item bottom-4">
           <div class="circle float-left"><a href="#"><i class="icon-star"></i></a></div>
           <div class="data float-right">
           <h4><a href="#">Book the parking slot</a></h4>
           <p>This module use for the book the slot area office date and time wise. </p>
           </div>
         </div>
       </div><!-- End item -->
       
       
       
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
  <!-- End JavaScript -->    
</body>
</html>