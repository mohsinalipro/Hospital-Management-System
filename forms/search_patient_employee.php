<div class="col-md-12">   
    <h3>Find Patient:<h3>
    <form action="patients.php?action=view_all" method="post">
    <div class="searchBox input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
         <input id="text" type="text" class="inputBox form-control" name="patient_id_search" placeholder="Enter Patient Id" required="" <?php echo isset($_POST['patient_id_search']) ? "value=\"{$db->cleanString($_POST['patient_id_search'])}\"": '' ?> />
    </div>
    <div style="margin-top:10px">
        <button type="submit" name="search" class="btn btn-success">Search</button>
    </div>
    </form>   
</div>