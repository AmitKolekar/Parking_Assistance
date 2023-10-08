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
        var first_name = document.getElementById("first_name").value;
        var middle_name = document.getElementById("middle_name").value;
        var last_name = document.getElementById("last_name").value;
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var mobile = document.getElementById("mobile").value;
        var email = document.getElementById("email").value;     
        
        var validchar = /^[A-Z a-z]+$/;
        
        if(first_name=='')
        {
            alert("Please Enter First Name.");
            return false;
            
        }
        else if(!validchar.test(first_name))
        {
            alert(" First Name should not be numeric.");
            return false;
        }
        else if(middle_name=='')
        {
            alert("Please Enter Middle Name.");
            return false;
        }
        else if(!validchar.test(middle_name))
        {
                alert(" Middle Name should not be numeric.");
                return false;
        }
        else if(last_name=='')
        {
            alert("Please Enter Last Name.");
            return false;
        }
        else if(!validchar.test(last_name))
        {
                alert(" Last Name should not be numeric.");
                return false;
        }
        else if(username=='')
        {
            alert("Please Enter User Name.");
            return false;   
        }
        else if(password=='')
        {
            alert("Please Enter Password.");
            return false;   
        } 
        else if(mobile=='')
        {
            alert("Please Enter Mobile Number.");
            return false;  
        }
        else if(isNaN(mobile))
        {
            alert("Mobile Number should be numeric.");
            return false;  
        }
        else if(checkInternationalPhone(mobile)==false)
        {
            alert("Please Enter a Valid Mobile Number");
    		return false;
        }       
        else if(email=='')
        {
            alert("Please Enter Email Address.");
            return false;
        }
        else if(validateEmail(email))
        {
            alert("Please Enter Valid Email Address.");
            return false;
        } 
    }

function validateEmail(email)
{
    var atpos  = email.indexOf("@");   // The indexOf() method returns the position of the first occurrence of a specified value in a string. // Default value of start is 0  
    //alert(atpos);
    var dotpos = email.lastIndexOf(".");  // The lastIndexOf() method returns the position of the last occurrence of a specified value in a string. // Default value of start is 0  
    //alert(dotpos);
    
    if((atpos<1) || (dotpos<(atpos+2)) || (dotpos+2>=email.length))  
    {
        return true;
    }
    else
    {
        return false;
    }
}

// Declaring required variables
var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 10;

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function trim(s)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not a whitespace, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (c != " ") returnString += c;
    }
    return returnString;
}

function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function checkInternationalPhone(strPhone){
    var bracket=3;
    strPhone=trim(strPhone);
    if(strPhone.indexOf("+")>1) return false;
    if(strPhone.indexOf("-")!=-1)bracket=bracket+1;
    if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false;
    var brchr=strPhone.indexOf("(");
    if(strPhone.indexOf("(")!=-1 && strPhone.charAt(brchr+2)!=")")return false;
    if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false;
    s=stripCharsInBag(strPhone,validWorldPhoneChars);
    return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
}

</script>

<?php
    require_once "parking_helper.php";
    $helper=new ParkingHelper();
    $msg='';
    if($_POST)
    {
        $msg=$helper->regParker();
        if($msg)
        {
            $msg="Updated successfully";
        }
        else
        {
            $msg="Update not successfully";
        }
    }
    
    $data = $helper->userinfo($_SESSION['uid']);
    if(!$data->id)
    {
        echo "<script>window.location='login.php';</script>";
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
         <h1>Edit Profile</h1>
       </div>
       
     </div><!-- End Container -->
   </div>
   
   <div class="style-2 home s-2 bottom-3">
     <div class="container clearfix">
        <?php
            $helper->userinfobar();
        ?>
        <div class="eight columns bottom-3" >
       
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
        
       
        
        <form class="form-elements" action="" method="post" onSubmit="return validate_form();" enctype="multipart/form-data">
         
         <fieldset>
          <span>First Name : </span>
          <input type="text" name="first_name" id="first_name" value="<?php echo $data->first_name; ?>"/>
          </fieldset>
          
          <fieldset>
          <span>Middle Name : </span>
          <input type="text" name="middle_name" id="middle_name" value="<?php echo $data->middle_name; ?>"/>
          </fieldset>
          
          <fieldset>
          <span>Last Name : </span>
          <input type="text" name="last_name" id="last_name" value="<?php echo $data->last_name; ?>"/>
          </fieldset>
         
         <fieldset>
          <span>User Name : </span>
          <input type="text" name="username" id="username" value="<?php echo $data->username; ?>"/>
          </fieldset>

          <fieldset>
          <span>Password : </span>
          <input type="password"  name="password" id="password" value="<?php echo $data->password; ?>"/>
          </fieldset>
          
           <fieldset>
          <span>Mobile : </span>
          <input type="text" name="mobile" id="mobile" value="<?php echo $data->mobile; ?>"/>
          </fieldset>
          <fieldset>
          <span>Email : </span>
          <input type="text" name="email" id="email" value="<?php echo $data->email; ?>"/>
          </fieldset>
                    
            <div class="clear"></div>
          
              <fieldset>
                <span>&nbsp; </span>
                <input type="hidden" name="id" value="<?php echo $_SESSION['uid'];?>" />
                <input type="submit" class="button small color" value="Update Profile"/>
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