<?php
if(isset($_POST['unassign_nurse_submit'])):

$db->query("UPDATE room SET nurse_id =  NULL WHERE nurse_id = '{$db->cleanString($_POST['nurse_id'])}'", true);

    echo '<div class="alert alert-success">Nurse has been unassigned successfully</div><a href="rooms.php?action=unassign_nurse" class="btn btn-default">Go Back</a>';

else:
    $not_free_nurses = $db->query('select r.room_id, e.employee_id, e.fname, e.lname from employee e, room r where e.employee_id = r.nurse_id'); // 3 is nurse type id
    $not_free_nurses_total = count($not_free_nurses);
?>

<form action="rooms.php?action=unassign_nurse" method="post"> 
        <div class="formdiv2 input-group">
        <label>Select Nurse:</label>
        <select class="form-control" name="nurse_id" required>
            <?php 
            for($i = 0; $i < $not_free_nurses_total; $i++) {
               echo "<option value=\"{$not_free_nurses[$i]['employee_id']}\">{$not_free_nurses[$i]['employee_id']} | {$not_free_nurses[$i]['fname']} {$not_free_nurses[$i]['lname']}</option>";
            }
            ?>
        </select>
        </div>
    
       <div class="formdiv2">
        <button type="submit" class="btn btn-default" name="unassign_nurse_submit">Unassign Room</button>
      </div>
</form>

<?php 
endif;
?>