<?php
error_reporting(0);
session_start();

require_once "inc/config.php";
require_once "inc/dbhelper.php";

class ParkingHelper
{
    function checkLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new Database();
        $db->open();

        $msg = '';

        $sql = "SELECT * FROM `parkers` WHERE  username='" . $username ."' AND password='" . $password . "' AND `published`=1";
        $result = $db->query($sql);

        $row = $db->fetchobject($result);


        if ($row) 
        {
            $_SESSION['uid'] = $row->id;
            $_SESSION['username'] = $row->username;

            echo "<script>window.location = 'dashboard.php';</script>";
        } 
        else 
        {
            $msg = "Invalid Details";
        }

        return $msg;
    }
    
    function regParker()
    {
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];

        $username = $_POST['username'];
        $password = $_POST['password'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $id = $_POST['id'];

        $db = new Database();
        $db->open();

        $msg = '';
        $sql = '';

        if($id) 
        {
            $sql = "UPDATE `parkers` SET `first_name`='" . $first_name . "', `middle_name`='" . $middle_name . "', `last_name`='" . $last_name ."', `username`='" . $username . "', 
            `password`='" . $password . "', `mobile`='" . $mobile . "', `email`='" . $email . "', `published` = '1' WHERE `id`=" . $id;
            $result = $db->query($sql);
            
            $msg="Info updated successfully";
            return $msg;
        } 
        else 
        {
            $sql    = "SELECT * FROM `parkers` WHERE `username` ='".$username."'";
            $result = $db->query($sql);
            
            if($db->numOfRecords())
            {
                $msg = 'Username already exists.';
                return $msg;
            }
            else
            {
                $sql = "INSERT INTO `parkers` (`id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `mobile`, `email`, `published`) VALUES (NULL, '" .$first_name . "', 
                '" . $middle_name . "', '" . $last_name . "', '" . $username . "', '" . $password . "', '" . $mobile . "', '" . $email . "', '1');";
                $result = $db->query($sql);
    
                $msg="Register successfully";
                return $msg;
            }
        }
    }

    function userinfo($id)
    {
        $db = new Database();
        $db->open();

        $sql = "SELECT * FROM `parkers` WHERE `id` ='$id'";
        $result = $db->query($sql);

        $row = $db->fetchobject($result);
        
        return $row;
    }

    public function userinfobar()
    {
        $helper = new ParkingHelper();
        
        ?>
        <div class="five columns sidebar bottom-3">
            <!-- Categories Widget -->
            <div class="widget categories">
                <ul class="arrow-list">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="edit_profile.php">Edit Profile</a></li>
                    <li><a href="make_reservation.php">Make Reservation</a></li>
                    <li><a href="view_reservations.php">View Reservations</a></li>
                </ul><!-- End arrow-list -->
            </div>
            <!-- End -->
        </div><!-- End Sidebar Widgets -->
        <?php
    }
    
    function getCities()
    {
        $db = new Database();

        $db->open();
        $sql = '';


        $sql = "SELECT DISTINCT city FROM `parking_spaces` ORDER BY id ASC"; 
        $result = $db->query($sql);
        
        $html = '<option value="">Select City</option>';
        
        if($db->numOfRecords())
        {
            while ($row = $db->fetcharray($result))
            {
                $html .= '<option value="'.$row['city'].'">'.$row['city'].'</option>';
                
            }
        }
        return $html;
    }
    
    function getAddresses()
    {
        $db = new Database();

        $db->open();
        $sql = '';


        $sql = "SELECT * FROM `parking_spaces` ORDER BY id ASC"; 
        $result = $db->query($sql);
        
        ?>
        <option value="">Select Address</option>
        <?php

        if($db->numOfRecords())
        {
            while ($row = $db->fetcharray($result))
            {
                ?>
                <option value="<?php echo $row['address'];?>"><?php echo $row['address'];?></option>
                <?php
            }
        }
    }

    function reservation()
    {
        $parker_id       = $_POST['parker_id'];
        $city            = $_POST['city'];
        $address         = $_POST['address'];
        $slots           = $_POST['slots'];
        $amount_per_hour = $_POST['amount_per_hour'];
        $amount          = $_POST['amount'];
        
        $from_date      = $_POST['from_date'];
        /*$from_date      = explode(" ", $from_date);
        $from_ddmmyy    = $from_date[0];
        $from_ddmmyy    = explode("/", $from_ddmmyy);
        $from_ddmmyy    = $from_ddmmyy[2]."-".$from_ddmmyy[1]."-".$from_ddmmyy[0];
        $from_time      = $from_date[1];
        $from_date      = $from_ddmmyy." ".$from_time.":00";*/
        
        $to_date        = $_POST['to_date'];
        /*$to_date        = explode(" ", $to_date);
        $to_ddmmyy      = $to_date[0];
        $to_ddmmyy      = explode("/", $to_ddmmyy);
        $to_ddmmyy      = $to_ddmmyy[2]."-".$to_ddmmyy[1]."-".$to_ddmmyy[0];
        $to_time        = $to_date[1];
        $to_date        = $to_ddmmyy." ".$to_time.":00";*/
        
        $no_of_slots    = $_POST['no_of_slots'];
        $hours          = $_POST['hours'];
        
        
        $db = new Database();

        $db->open();
        $sql = '';

        $sql = "INSERT INTO `reservations` (`id`, `parker_id`, `city`, `address`, `slots`, `amount_per_hour`, `amount`, `from_date`, `to_date`, `no_of_slots`, `hours`) 
                VALUES (NULL, '".$parker_id."', '".$city."', '".$address."', '".implode(',', $slots)."', '".$amount_per_hour."', '".$amount."', '".$from_date."', '".$to_date."', '".$no_of_slots."', '".$hours."');";
        //echo $sql;die;
        $result = $db->query($sql);
        
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function view_reservations()
    {
        $db = new Database();

        $db->open();
        $sql = '';


        $sql = "SELECT * FROM `reservations` WHERE `parker_id` = '".$_SESSION['uid']."'  ORDER BY id DESC"; 
        $result = $db->query($sql);

        if($db->numOfRecords())
        {
            ?>
            <table class="table table-bordered" align="left" cellpadding="5px" cellspacing="5px" border="1px">
                <tr>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Slot Names</th>
                    <th style="text-align: center;">No. of Slots</th>
                    <th style="text-align:center;">Hours</th>
                    <th style="text-align:center;">Amount Per Hour</th>
                    <th>Amount To Pay</th>
                </tr>    

                <?php
                while ($row = $db->fetcharray($result))
                {
                    ?>
                     <tr>

            	        <td><?php echo date('d/m/Y g:i a', strtotime($row['from_date']));?></td>
                        <td><?php echo date('d/m/Y g:i a', strtotime($row['to_date']));?></td>
            			<td><?php echo $row['city'];?></td>
            		    <td><?php echo $row['address'];?></td>
            			<td><?php echo $row['slots'];?></td>
                        <td style="text-align:center;"><?php echo $row['no_of_slots'];?></td>
                        <td style="text-align:center;"><?php echo $row['hours'];?></td>
                        <td style="text-align:center;"><?php echo $row['amount_per_hour'];?></td>
                        <td style="text-align:center;"><?php echo round($row['amount'], 0);?></td>
                   </tr> 
                    <?php
                }
                ?>
            </table>
            <?php

        } 
        else
        {
            ?>
            No Reservations found.
            <?php
        }
    }
}
?>