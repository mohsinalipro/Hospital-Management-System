<?php 
session_start();
?>
  <?php require_once 'header.php'; ?>
     <?php require_once 'sidebar.php'; ?>    

     

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">


<!--Find show all visit records-->

                <?php if(isset($_GET['action']) && $_GET['action']=='single'):?>
                
                <div class="col-md-12">  

                <?php
                 $q="select patient_id, fname,lname,mobileno from patient where patient_id={$_POST['searchVal']}";
                  $patientArr=$db->query($q);
                  $no=0;
                  $no=count($patientArr);
                  if($no==0):
                ?>
                <h3>No Result Found</h3>
                <?php else:
                 $q="select visit_rec_id,time_in,time_out from visit_record where patient_id={$_POST['searchVal']} order by visit_rec_id desc";
                  $visitArr=$db->query($q);
                  $no=0;
                  $no=count($visitArr); 
                  $i=0;
                  $x=$no-1;

                 ?>
                

                  <h1>Medical Record</h1>
                        <div class="row statsboxes">
                            <div class="stats_title clearfix"><span class="pull-left">Patient Stats:</span><span class="pull-right">Total No Of Visits: <?php echo "{$no}" ?> </span></div>
                             <div class="col-md-3 statsbox">
                                <h3>Patient Id:</h3>
                                <div class="stats_content">
                                    <?php echo "{$_POST['searchVal']}" ?>
                                </div>
                            </div>
                            <div class="col-md-3 statsbox statsbox_doc">
                                <h3>Name:</h3>
                                <div class="stats_content">
                                    <?php echo "{$patientArr[$i]['fname']} {$patientArr[$i]['lname']}" ?>
                                </div>
                            </div>
                            <div class="col-md-3 statsbox">
                                <h3>Medical Record No:</h3>
                                <div class="stats_content">
                                    10
                                </div>
                            </div>
                            <div class="col-md-3 statsbox">
                                <h3>Mobile No:</h3>
                                <div class="stats_content">
                                    <?php echo "{$patientArr[$i]['mobileno']}" ?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
  <?php
  while($i<$no){ ?>

<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="col-md-12">
                <div class="row statsboxes">
                <div class="stats_title clearfix"><span class="pull-left">Visit Record <?php echo $x+1 ?>:</span><button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">View Prescription</button></div>
                <div id="myModal<?php echo $i; ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                <?php
               
               $q="select remarks,disease from precription_rec where visit_rec_id={$visitArr[$i]['visit_rec_id']}";
                $presc=$db->query($q);
                
                $q="select med.med_name,pm.recommendation,pr.presc_id from precription_rec pr,presc_med pm,medicine med where (pr.presc_id=pm.presc_id) and (pm.med_id=med.med_id) and pr.visit_rec_id={$visitArr[$i]['visit_rec_id']}";
                $med=$db->query($q);
                $c=0;
                $c=count($med); 
                $j=0;

               ?>
                  <!-- Modal content-->
                  <div class="modal-content">
                  <div class="modal-header" style="background-color:#292f3b;color:white;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Prescription:</h4>
                    </div>
                    <div class="modal-body">
                    <h4><b><strong>Remarks:</strong></b></h4>
                      <p><?php echo (count($presc) > 0) ?  '<b>' . $presc[0]['remarks'] . '</b>'  : '<div class="alert alert-warning">Not entered</div>'; ?></p>
                      <h4><b><strong>Disease:</strong></b></h4>
                      <p><?php echo (count($presc) > 0) ? '<b>' . $presc[0]['disease'] . '</b>' : '<div class="alert alert-warning">Not mentioned</div>'; ?></p>
                    <h4><b><strong>Medicines:</strong></b></h4>
                    <?php 
                    if(count($med) > 0){
                        while($j<$c){ ?>
                          <p><b><?php echo $j+1 ?><?php echo ". {$med[$j]['med_name']}        {$med[$j]['recommendation']}" ?></b></p>
                          <?php 
                        $j++;         
                        }
                    } else {
                        echo '<div class="alert alert-warning">No medicine entered</div>';
                    }
                        ?>
                    </div>
                    <div class="modal-footer">
                     <a href="patient-history.php?action=edit&id=<?php echo $visitArr[$i]['visit_rec_id'] ?>" class="btn btn-lg btn-success">Edit</a>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>
                  <div class="col-md-6 statsbox">
                  <h3>Date In:</h3>
                  <div class="stats_content">
                      <?php echo "{$visitArr[$i]['time_in']}" ?>
                  </div>
              </div>
              <div class="col-md-6 statsbox">
                  <h3>Time In:</h3>
                  <div class="stats_content">
                      <?php echo "{$visitArr[$i]['time_in']}" ?>
                  </div>
              </div>
              <div class="col-md-6 statsbox">
                  <h3>Date Out:</h3>
                  <div class="stats_content">
                      <?php echo "{$visitArr[$i]['time_out']}" ?>
                  </div>
              </div>
              <div class="col-md-6 statsbox">
                  <h3>Time Out:</h3>
                  <div class="stats_content">
                      <?php echo "{$visitArr[$i]['time_in']}" ?>
                  </div>
                </div>
                                            
             </div>
        </div>
    </div>
</div>
         <?php
         $x--;
        $i++;
         } ?>
            
            
            

        <?php endif; ?>




<!-- Edit Prescription -->

               <?php elseif(isset($_GET['action']) && $_GET['action']=='edit'):?>
                <div class="col-md-12">
                <?php
                   $q="select remarks,disease from precription_rec where visit_rec_id={$_GET['id']}";
                  $presc=$db->query($q);

                 $q="select med.med_name,pm.med_id,pm.recommendation,pr.presc_id from precription_rec pr,presc_med pm,medicine med where (pr.presc_id=pm.presc_id) and (pm.med_id=med.med_id) and pr.visit_rec_id={$_GET['id']}";
                  $med=$db->query($q);
                  $c=0;
                  $c=count($med); 
                  $i=0; 

                   $q="select med_id,med_name from medicine";
                   $all_med=$db->query($q);
                   $t=0;
                   $t=count($all_med); 
                  $countMeds=0;
                ?>
                    
                         <h3 class="formdiv2">Edit Prescription for Patient ID <?php echo $db->cleanString($_GET['id']); ?>:</h3>
                      <form id="myform" action="patient-history.php?action=edit&id=<?php echo $_GET['id']; ?>"  method="post">

                      <p class="formdiv2"><b>Disease:</b></p>
                        <div class="formdiv2 input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span>
                          <input id="text" type="text" class="form-control" name="disease" placeholder="Disease" value="<?php echo (count($presc) > 0) ? $presc[0]['disease'] : ''; ?>" required>
                        </div>

                         <p class="formdiv2"><b>Remarks:</b></p>
                         <div class="formdiv2 input-group" >
                          <span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span>
                          <input id="text rem" type="text" class="form-control" name="remarks" placeholder="Remarks" value="<?php echo (count($presc) > 0) ? $presc[0]['remarks'] : ''; ?>">
                        </div>


                          <?php
                          while($i<$c)
                          { 
                          $countMeds++;
                          ?>
                          <div class="formdiv2 input-group">
                          <label for="sel1" style="margin-left:5px">Medicine <?php echo $i+1 ?>:</label>
                          <select class="form-control" id="sel1" name="med<?php echo $countMeds ?>" required>
                          
                          <?php
                          $j=0;
                          while($j<$t){
                            $selected=$med[$i]['med_id'] ==$all_med[$j]['med_id'] ? 'selected': '';
                          ?>
                            <option value="<?php echo $all_med[$j]['med_id'] ?>" <?php echo $selected ?>><?php echo $all_med[$j]['med_name'] ?></option>
                           <?php 
                           $j++; } ?> 
                          </select>
                          </div>
                          <div class="formdiv2 input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span>
                          <input id="text" type="text" class="form-control" name="rec<?php echo $countMeds ?>" placeholder="Recommendation" value="<?php echo $med[0]['recommendation']; ?>" required>
                        </div>
                          <?php 
                          $i++;
                          }
                          ?>



                           <div id="room_fileds" >
                          </div>
                        
                        <div class="formdiv2 input-group">
                        <button  class="btn btn-default" type="button" id="more_fields" onclick="add_fields();" value="" ><i class="glyphicon glyphicon-plus"></i> Add Medicine</button>
                        </div>
                        <br>
                        <div class="formdiv2 input-group">
                        <button  class="btn btn-warning btn-lg" type="submit" onclick="setAction()" name="update_presc">Update</button>
                        </div>


                      </form>





        </div>
      </div>
        

<!--Update Prescription Data-->
                <?php elseif(isset($_POST['update_presc'])):
                $q="select presc_id from precription_rec where visit_rec_id={$_GET['id']}";
                  $presc=$db->query($q);
var_dump( $presc);
         $q="update precription_rec set remarks='{$_POST['disease']}',disease='{$_POST['remarks']}' where visit_rec_id={$_GET['id']}";
         $db->query($q,true);
                if(count($presc) > 0) {
                 $q="delete from presc_med where presc_id={$presc[0]['presc_id']}";
                  $db->query($q,true);
                 $i=1;
                $count=$_GET['meds'];
                  while($i<=$count)
                  {
                    $q="insert into presc_med (presc_id,recommendation,med_id) value ('{$presc[0]['presc_id']}'','{$_POST['rec'.$i]}',{$_POST['med'.$i]})";
                    $db->query($q,true);
                    $i++;
                  }
                }
                  echo '<div class="alert alert-success">Prescription Updated Successfully</div>';

                ?>

<?php else: require_once 'forms/search_patient.php'; ?>
<?php endif; ?>

        <?php require_once 'footer.php'; ?>


        <script>
var med = <?php echo $i ?>;
var n= <?php echo $countMeds ?>;
function add_fields() {
    med++;
    n++;
    var objTo = document.getElementById('room_fileds')
    var divtest = document.createElement("div");
    divtest.innerHTML = '<div class="formdiv2 input-group"><label for="sel1" style="margin-left:5px">Medicine ' +med+ ':</label><select class="form-control" id="sel1" name="med'+n+'" required><option selected></opton><?php $j=0; while($j<$t){ ?> <option value="<?php echo $all_med[$j]['med_id'] ?>"><?php echo $all_med[$j]['med_name'] ?></option> <?php  $j++; } ?> </select></div><div class="formdiv2 input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span><input id="text" type="text" class="form-control" name="rec'+n+'" placeholder="Recommendation" value="" required></div>';
    objTo.appendChild(divtest)
}
function setAction(){
document.getElementById('myform').action= 'patient-history.php?action=update&id=<?php echo $_GET['id'] ?>&meds='+med+'';
}
</script>

                        