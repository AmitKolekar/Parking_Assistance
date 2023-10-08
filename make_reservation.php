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
  
  <link rel="stylesheet" href="css/jquery.datetimepicker.css"/>
  
  <!--[if lt IE 9]>
      <script src="js/html5.js"></script>
  <![endif]-->
  
    <script type="text/javascript">
    function validate_form()
    {
        var city    = document.getElementById("city").value;
        var address = document.getElementById("address").value;
        var from_date       = new Date(jQuery("#from_date").val());
        var to_date         = new Date(jQuery("#to_date").val());
        
        var items = new Array();
        jQuery('input[name="slots[]"]:checked').each( function(){
            items.push( $(this).val() );
        });
        
        if(Date.parse(to_date) < Date.parse(from_date)){
            alert("Please Select To Date Greater Than From Date.");
            jQuery("#res_btn").hide();
            return false;   
        }
        else if(city=='')
        {
            alert("Please Select City.");
            return false;
            
        }
        else if(address=='')
        {
            alert("Please Select Address.");
            return false;
        }
        else if(items.length==0)
        {
            alert("Please Select Slot.");
            return false;
        }
        else if(items.length > 0)
        {
            calculateAmount();
            jQuery("#res_btn").show();
        }
    }
    </script>
    
    <?php
        require_once "parking_helper.php";
        $helper=new ParkingHelper();
        $msg='';
        if($_POST)
        {
            $msg=$helper->reservation();
            if($msg)
            {
                $msg="Reservation successful";
            }
            else
            {
                $msg="Reservation not successful";
            }
        }
        
        $data = $helper->userinfo($_SESSION['uid']);
        
        if(!$data->id)
        {
            echo "<script>window.location='login.php';</script>";
        }    
    ?>
    <style>
    .form-elements label{margin-right: 35px;}
    #slots_area p {margin-left: 135px;float: left;margin-top: -22px;margin-bottom: 20px;}
    #slots_area p:last-child {margin-bottom: 0px;}
    .form-elements span {min-width: 135px;text-align: right;}
    .xdsoft_datetimepicker .xdsoft_label{color:#000;}
    </style>
</head>
<body>

  <div id="wrap" class="boxed">
  
    <?php
        require_once "header.php";
    ?>
  
    <div class="page-title">
     <div class="container clearfix">
       
       <div class="sixteen columns"> 
         <h1>Make Reservation</h1>
       </div>
       
     </div><!-- End Container -->
   </div>
   
   <div class="style-2 home s-2 bottom-3">
     <div class="container clearfix">
        <?php
            $helper->userinfobar();
        ?>
        <div class="ten columns bottom-3" >
       
        <?php
        if($msg!='')
        {
            ?>
            
            <div class="alert success hideit">
            <i class="icon-check"></i>
            <p><?php echo $msg; ?></p>
            <i class="icon-remove close"></i>
            </div>
            
            <?php
        }
        ?>
        
        <form class="form-elements" action="" method="post" onsubmit="return validate_form();" enctype="multipart/form-data">
         
            <fieldset>
                <span>From : </span>
                <input class="datetimepicker" type="text" name="from_date" id="from_date" value="" />
            </fieldset>
            
            <div class="clear"></div>
            
            <fieldset>
                <span>To : </span>
                <input class="datetimepicker" type="text" name="to_date" id="to_date" value="" />
            </fieldset>
            
            <div class="clear"></div>
            
            <fieldset>
                <span>City : </span>
                <select name="city" id="city">
                    <?php
                    echo $helper->getCities();
                    ?>
                </select>
            </fieldset>
          
            <fieldset>
                <span>Address : </span>
                <select name="address" id="address">
                    <option value="">Select Address</option>
                </select>
            </fieldset>
            
            <div id="slots_area">
                
            </div>
          
            <div class="clear"></div>
          
            <fieldset>
                <span>&nbsp;</span>
                <input type="hidden" name="parker_id" value="<?php echo $_SESSION['uid'];?>" />
                <input style="display: none;" id="res_btn" type="submit" class="button small color" value="Make Reservation"/>
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
  
  <script src="js/jquery.datetimepicker.js"></script> 
  <script type="text/javascript">
  jQuery(document).ready(function (){
      jQuery("#city").change(function (){
        var city = jQuery(this).val();
        
        if(city=='')
        {
            alert("Please Select City");
        }
        else
        {
            $.ajax({
                url: 'ajaxhelper.php?task=getAddressesByCity',
                data: {city: city},
                success: function(response)
                {
                    jQuery('#address').html(response);
                }
            });
        }
      });
      
      jQuery("#address").change(function (){
        
        var city        = jQuery("#city").val();
        var address     = jQuery(this).val();
        var from_date   = jQuery("#from_date").val();
        var to_date     = jQuery("#to_date").val();
        
        if(address=='')
        {
            alert("Please Select Address");
            jQuery('#slots_area').html('');
            jQuery("#res_btn").hide();
        }
        else
        {
            $.ajax({
                url: 'ajaxhelper.php?task=getSlotsByAddress',
                data: {from_date: from_date, to_date: to_date, city: city, address: address},
                success: function(response)
                {
                    jQuery('#slots_area').html(response);
                }
            });
        }
      });
      
      //jQuery("#city").change();
      jQuery('.datetimepicker').datetimepicker({
        /*format:'d/m/Y H:i',
    	formatDate:'Y/m/d H:i',*/
    	minDate:'+1970/01/02'
      });
  });
  function calculateAmount()
  {
    var slots_checked   = 0;
    var amount_per_hour = jQuery("#amount_per_hour").val();
    var from_date       = new Date(jQuery("#from_date").val());
    var to_date         = new Date(jQuery("#to_date").val());
    
    if(Date.parse(to_date) < Date.parse(from_date)){
        alert("Please Select To Date Greater Than From Date.");
         jQuery("#res_btn").hide();
        return false;   
    }
    
    var hours = Math.ceil(Math.abs(from_date - to_date) / 3600000);
    
    jQuery('input[name="slots[]"]:checked').each( function(){
        slots_checked++;
    });
    
    var amount_to_pay = amount_per_hour * slots_checked * hours;
    jQuery("#amount").val(amount_to_pay);
    jQuery("#no_of_slots").val(slots_checked);
    jQuery("#hours").val(hours);
    
    if(slots_checked>0)
    {
        jQuery("#res_btn").show();
    }
  }
  </script>
  
  <!-- End JavaScript -->    
</body>
</html>