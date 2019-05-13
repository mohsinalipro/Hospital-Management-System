<?php
if(isset($_POST['assign_nurse_submit'])):



$db->query("UPDATE room SET nurse_id = '{$db->cleanString($_POST['nurse_id'])}' WHERE room_id = '{$db->cleanString($_POST['room_id'])}'", true);

    echo '<div class="alert alert-success">Nurse has been assigned successfully to Room No. '. $db->cleanString($_POST['nurse_id']) . '</div><a href="rooms.php?action=assign_nurse" class="btn btn-default">Go Back</a>';

else:
    $free_rooms = $db->query('SELECT room_id,nurse_id FROM room where nurse_id is null ORDER BY room_id');
    $free_rooms_total = count($free_rooms);
    
    $free_nurses = $db->query('select employee_id, fname, lname from employee where employee_type_id = 3 and employee_id not in (select e.employee_id from employee e, room r where e.employee_id = r.nurse_id)'); // 3 is nurse type id
    
    $free_nurses_total = count($free_nurses);
?>

<form action="rooms.php?action=assign_nurse" method="post"> 
    
        <div class="formdiv2 input-group">
        <label for="emp_type">Select Room:</label>
        <select class="form-control" name="room_id" required>
            <?php 
            for($i = 0; $i < $free_rooms_total; $i++) {
               echo "<option value=\"{$free_rooms[$i]['room_id']}\">Room No. {$free_rooms[$i]['room_id']}</option>";
            }
            ?>
        </select>
        </div>
    
        <div class="formdiv2 input-group">
        <label for="emp_type">Select Nurse:</label>
        <select class="form-control" name="nurse_id" required>
            <?php 
            for($i = 0; $i < $free_nurses_total; $i++) {
               echo "<option value=\"{$free_nurses[$i]['employee_id']}\">{$free_nurses[$i]['employee_id']} | {$free_nurses[$i]['fname']} {$free_nurses[$i]['lname']}</option>";
            }
            ?>
        </select>
        </div>
    
       <div class="formdiv2">
        <button type="submit" class="btn btn-default" name="assign_nurse_submit">Assign Room</button>
      </div>
</form>

<?php 
endif;
?>