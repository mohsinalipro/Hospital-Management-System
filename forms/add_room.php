<?php
if(isset($_POST['add_room_submit'])):



$db->query("INSERT INTO room (type) VALUES ('{$db->cleanString($_POST['room_type'])}')", true);
    echo '<div class="alert alert-success">Room added successfully</div><a href="rooms.php" class="btn btn-default">Go Back</a>';

else:
    $new_room_no = $db->query('SELECT room_id FROM room ORDER BY room_id DESC LIMIT 1')[0]['room_id']+1;
?>

<form action="rooms.php?action=add" method="post"> 
    <div class="formdiv2">
        <label>New Room No: </label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-minus"></i></span>
        <input type="text" class="form-control" name="room_type" value="<?php echo $new_room_no; ?>" disabled>
      </div>
        <br>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-minus"></i></span>
        <input type="text" class="form-control" name="room_type" placeholder="Room Type" required>
      </div>

       <div class="formdiv2">
        <button type="submit" class="btn btn-default" name="add_room_submit">Add Room</button>
      </div>
    </div>
</form>

<?php 
endif;
?>