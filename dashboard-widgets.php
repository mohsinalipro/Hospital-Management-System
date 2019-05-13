<?php 
require_once 'config.php';
require_once 'includes/functions.php';

/* employees count */
$employee_count = $db->query('SELECT et.typename, count(e.employee_id) as count from employee e, employee_type et  where e.employee_type_id = et.employee_type_id group by et.typename');

$employee_total = 0;
$emptypes_count = count($employee_count);
for($i = 0; $i < $emptypes_count; $i++) {
    $employee_total += $employee_count[$i]['count'];
}

/* patient count */
$patient_total = $db->query('SELECT count(*) as count from patient')[0]['count'];

/* rooms count */
$room_total_free = $db->query('SELECT count(*) as count from room where patient_id is null')[0]['count'];
$patient_total_in = $room_total_reserved = $db->query('SELECT count(*) as count from room where patient_id is not null')[0]['count'];
$room_total = $room_total_free + $room_total_reserved;
/* medicines count */
$medicine_total = $db->query('SELECT count(*) as count from medicine')[0]['count'];

?>
<?php 
 if(in_array($user['typename'],['Administrator'])) {
?>
    <div class="row statsboxes">
        <div class="stats_title clearfix">
            <span class="pull-left">Employees Stats</span> <span class="pull-right">Total Employees: <?php echo $employee_total; ?></span>
        </div>


        <?php

        for($i = 0; $i < $emptypes_count; $i++) {
            echo "
                <div class=\"col-md-6 statsbox statsbox_doc\">
                    <h3>{$employee_count[$i]['typename']}s</h3>
                    <div class=\"stats_content\">
                        Total {$employee_count[$i]['typename']}s: {$employee_count[$i]['count']}
                    </div>
                </div>
            ";
        }

        ?>
    </div>
<?php 
  } //endif 
?>
<br>
<?php
 if(in_array($user['typename'],['Administrator','Doctor','Pharmacist','Receptionist'])) {
?>
    <div class="row statsboxes">
        <div class="stats_title">General Stats</div>
        <?php 
         if(in_array($user['typename'],['Administrator','Doctor','Receptionist'])) { 
        ?>
            <div class="col-md-12 statsbox statsbox_pat">
                <h3>Patients</h3>
                <div class="stats_content">
                    Total Patients: <?php echo $patient_total; ?> | 
                    In-door Patients: <?php echo $patient_total_in; ?>
                </div>
            </div>
        <?php 
         } // endif
        ?>
        <?php 
         if(in_array($user['typename'],['Administrator','Receptionist'])) { 
        ?>
            <div class="col-md-12 statsbox statsbox_rm">
                <h3>Rooms</h3>
                <div class="stats_content">
                    Total Rooms: <?php echo $room_total; ?> | 
                    Reserved Rooms: <?php echo $room_total_reserved; ?> | 
                    Free Rooms: <?php echo $room_total_free; ?>
                </div>
            </div>
        <?php 
         } // endif
        ?>
        <?php 
         if(in_array($user['typename'],['Administrator','Pharmacist'])) { 
        ?>
            <div class="col-md-12 statsbox statsbox_med">
                <h3>Medicines</h3>
                <div class="stats_content">
                    Total Medicines: <?php echo $medicine_total; ?>
                </div>
            </div>
        <?php 
         } // endif
        ?>
    </div>

<?php
 } //endif
?>

<?php 
 if(in_array($user['typename'],['Nurse'])) { 
     $room_no = NULL;
    if( $q = $db->query("SELECT room_id from room where nurse_id = {$user['employee_id']} LIMIT 1")) {
        $room_no = $q[0]['room_id'];
    }
?>
   <div class="row statsboxes">
        <div class="stats_title clearfix">Duty Details</div>
        <div class="container">
            <h3><?php echo $room_no ? "Currently your duty is in Room No. {$room_no} " : 'Currently you have no assigned room.'?></h3>
            <p></p>
       </div>
    </div>
<?php 
 } // endif
?>