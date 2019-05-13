<?php 
if(isset($_POST['add_medicine_submit'])): 

$error = NULL;

$already_exists = $db->query("SELECT med_name from medicine where med_name = '{$db->cleanString($_POST['name'])}'");

if(count($already_exists) > 0)
    $error = 'A medicine with provided name is already exists, please try again.';
if(!$error) {
    $add_medicine = $db->query("INSERT INTO medicine (med_name, description, price) VALUES ('{$db->cleanString($_POST['name'])}', '{$db->cleanString($_POST['description'])}', '{$db->cleanString($_POST['price'])}')",true);
}

if(!$error) {
    echo '<div class="alert alert-success">Medicine added successfully</div><a href="medicines.php" class="btn btn-default">Go Back</a>';
} else {
    echo '<div class="alert alert-danger">'. $error .'</div><a href="medicines.php?action=add" class="btn btn-default">Go Back</a>';
}



else:
?>
<form action="medicines.php?action=add" method="post">
  <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-minus"></i></span>
    <input id="text" type="text" class="form-control" name="name" placeholder="Medicine Name" required>
  </div>
  <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span>
    <input id="text" type="text" class="form-control" name="description" placeholder="Description" required>
  </div>
   <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
    <input id="text" type="number" class="form-control" name="price" placeholder="Price" required>
  </div>
  
   
   <div class="formdiv2">
  <button type="submit" class="btn btn-default" name="add_medicine_submit">Add Medicine</button>
  </div>
</form>
<?php 
endif;
?>