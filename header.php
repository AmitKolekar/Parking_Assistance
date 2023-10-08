 <?php
    error_reporting(0);
    session_start();
 ?>
 <header class="style-3">
     <div class="top-bar">
       <div class="container clearfix">
        <div class="slidedown">
        
         <div class="eight columns">
           <div class="phone-mail">
             <a><i class="icon-phone"></i> Phone : +91 1234567890</a>
             <a href="info@parkingportal.com"><i class="icon-envelope-alt"></i> Mail : info@parkingportal.com</a>
           </div><!-- End phone-mail -->
         </div>
         <div class="eight columns">
           <div class="social" style="margin-top: 7px;">
           <?php

                if($_SESSION['uid']!='')

                {

                    echo  "Welcome | ".$_SESSION['username']." <a href='logout.php'>Logout</a>";     

                }

               

           ?>
           </div>
          </div><!-- End social-icons -->
          
         </div><!-- End slidedown -->
       </div><!-- End Container -->
       
     </div><!-- End top-bar -->
     
     <div class="main-header">
       <div class="container clearfix">
         <a href="#" class="down-button"><i class="icon-angle-down"></i></a><!-- this appear on small devices -->
         <div class="eleven columns">
          <div class="logo">
          <a href="index.php">
            <h3>Online Parking Portal</h3>
          </a>
          </div>
         </div><!-- End Logo -->
         
         
       
       </div><!-- End Container -->
     </div><!-- End main-header -->
     
     <div class="down-header">
       <div class="container clearfix">
       
      <div class="sixteen columns">
       <nav id="menu" class="navigation" role="navigation">
          <a href="#">Show navigation</a><!-- this appear on small devices -->
          <ul id="nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <?php
            if($_SESSION['uid']!='')
            {
                ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <?php
            }
            else
            {
                ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
                <?php   
            } 
            ?>       
            
            <li><a href="contact.php">Contact</a></li>
          </ul>
         </nav>
         
          </div><!-- End Menu --> 
       
      </div><!-- End Container -->
     </div><!-- End down-header -->
     
   </header><!-- <<< End Header >>> --> 