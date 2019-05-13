<!DOCTYPE html>
<html lang="en">
<head>
<script>
var med = 1;
function add_fields() {
    med++;
    var objTo = document.getElementById('room_fileds')
    var divtest = document.createElement("div");
    divtest.innerHTML = '<div><label style="padding:10px" for="sel1">Medicine '+med+' :</label><select class="form-control" id="sel1"><option>Panadol</option><option>Paracitamol</option><option>Disprine</option><option>IDK</option></select></div>';

    objTo.appendChild(divtest)
}
</script>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Medical Record</title>
	
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="form.css" rel="stylesheet">
	
</head>
<body>


<form>



<div class="formdiv2 input-group">
<div id="room_fileds">
     <label for="sel1" style="margin-left:5px">Medicine 1 :</label>
  <select class="form-control" id="sel1">
    <option>Panadol</option>
    <option>Paracitamol</option>
    <option>Disprine</option>
    <option>IDK</option>
  </select>
</div>
 <div>
<button  class="btn btn-default" type="button" id="more_fields" onclick="add_fields();" value="" ><i class="glyphicon glyphicon-plus"></i> Add More</button>
</div>
<div>

 <div class="formdiv2">
  <label class="radio-inline"><input type="radio" name="door" value="">In-Door</label>
<label class="radio-inline"><input type="radio" name="door" value="">Out-Door</label>
   </div>
   
    <div class="formdiv2">
  <button type="submit" class="btn btn-default">Submit</button>
  </div>
 
  
  
</form>

</body>
</html>