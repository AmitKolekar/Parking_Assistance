<?php
require_once "parking_helper.php";
$helper = new ParkingHelper();

$task   = $_REQUEST['task'];
if($task == 'getAddressesByCity')
{
    ob_clean();
    $city = $_REQUEST['city'];
    
    $db = new Database();
    $db->open();
    
    $sql = "SELECT address FROM `parking_spaces` WHERE `city` = '".$city."' ORDER BY id ASC"; 
    $result = $db->query($sql);
    
    $html = '<option value="">Select Address</option>';
    

    if($db->numOfRecords())
    {
        while($row = $db->fetcharray($result))
        {
            $html .= '<option value="'.$row['address'].'">'.$row['address'].'</option>';
        }
    }
    echo $html;die;
}
else if($task == 'getSlotsByAddress')
{
    ob_clean();
    
    $city       = $_REQUEST['city'];
    $address    = $_REQUEST['address'];
    $from_date  = $_REQUEST['from_date'];
    $to_date    = $_REQUEST['to_date'];
    
    $db = new Database();
    $db->open();
    
    $sql    = "SELECT no_of_slots, amount_per_hour FROM `parking_spaces` WHERE `address` = '".$address."' AND `city` = '".$city."' ORDER BY id ASC"; 
    $result = $db->query($sql);
    $row    = $db->fetchobject($result);
    
    $amount_per_hour = $row->amount_per_hour;
    $no_of_slots     = $row->no_of_slots;
    
    $sql    = "SELECT slots FROM `reservations` WHERE `address` = '".$address."' AND `city` = '".$city."' AND ((`from_date` BETWEEN '".$from_date."' AND '".$to_date."') OR (`to_date` BETWEEN '".$from_date."' AND '".$to_date."'))";
    //echo $sql;die; 
    $result = $db->query($sql);
    
    $slots  = array();
    if($db->numOfRecords())
    {
        while($row = $db->fetcharray($result))
        {
            $reserved_slots = explode(',', $row['slots']);
            
            foreach($reserved_slots as $reserved_slot)
            {
                $slots[] = $reserved_slot;
            }
        }
    }
    
    $html = '<fieldset><span>Slots : </span><p>';
                
    if($no_of_slots)
    {
        $j = 0;
        for($i=1;$i<=$no_of_slots;$i++)
        {
            if($i<10)
            {
                $i = "0".$i;
            }
            if(!in_array("P".$i, $slots))
            {
                if($j%4==0 && $j!=0)
                {
                    $html .='</p><p>';
                }
                
                $html .= '<input class="checkbox" id="slot_'.$i.'" name="slots[]" type="checkbox" value="P'.$i.'"/><label class="lbl_check" for="slot_'.$i.'">P'.$i.'</label>';
                $j++;
            }
        }
    }
    echo  $html.'</p>
          </fieldset>
          <div class="clear"></div>
          <fieldset>
            <span>Amount Per Hour : </span>
            <input type="text" name="amount_per_hour" id="amount_per_hour" value="'.round($amount_per_hour,0).'" readonly="" />
          </fieldset>
          <div class="clear"></div>
          <fieldset>
            <span>&nbsp;</span>
            <a class="button small color" href="javascript:void(0);" onclick="calculateAmount();">Calculate</a>
          </fieldset>
          <div class="clear"></div>
          <fieldset>
            <span>No. of Slots: </span>
            <input type="text" name="no_of_slots" id="no_of_slots" value="" readonly=""/>
          </fieldset>
          <div class="clear"></div>
          <fieldset>
            <span>Hours: </span>
            <input type="text" name="hours" id="hours" value="" readonly=""/>
          </fieldset>
          <div class="clear"></div>
          <fieldset>
            <span>Amount To Pay: </span>
            <input type="text" name="amount" id="amount" value="" readonly=""/>
            <input type="hidden" name="amount_per_hour" id="amount_per_hour" value="'.round($amount_per_hour,0).'" />
          </fieldset>';die;
}
?>