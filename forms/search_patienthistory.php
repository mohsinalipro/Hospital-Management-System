<div class="col-md-12">   
    <h3>Find Patient:<h3>
    <form action="patient-history.php?action=search" method="post">
    <div class="searchBox input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
         <input id="text" type="text" class="inputBox form-control" name="searchVal" placeholder="Enter Patient Id" required=""></input>
    </div>
    <div style="margin-top:10px">
        <button type="submit" name="search" class="btn btn-success">Search</button>
        <button type="reset" class="btn btn-default">Reset</button>
    </div>
    </form>   
</div>