<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<section class="content">
    <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
                    <!--<h3 class="box-title">Client Details</h3>-->
                 <h3 class="box-title">Payroll</h3>
                  
                  
                 Total Count:<?php echo $payrollcount; ?>
                 <input type="text" name="datefrom" id="datepickerfrom" placeholder="Date From"/>
                 <input type="text" name="dateto" id="datepickerto" placeholder="Date To"/>
                 <div class="gap11">
                 <button class="btn btn-info" type="button" id="apply">Apply</button>
				 <a href="" class="btn btn-danger">Reload All Data</a>
                 </div>
                
                </div>
                <div class="main-content">
                    <?php $x = $this->Session->flash(); ?>
                    <?php if ($x) { ?>
                    <div class="alert success">
                        <span class="icon"></span>
                        <strong><?php echo $x; ?></strong>
                    </div>
                    <?php }  ?>


<div id="exTab2">
    <ul class="nav nav-tabs">
        <li class="active">
        	<a  href="#1" data-toggle="tab">payroll</a>
        </li>
        <li>
        	<a href="#2" data-toggle="tab">Visit</a>
        </li>
    
    </ul>
    <div class="tab-content ">
        <div class="tab-pane active" id="1">
            <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><?php echo 'Id'; ?></th>
                        <th><?php echo 'Patient name'; ?></th>
                        <th><?php echo 'Doctor name'; ?></th>
                        <th><?php echo 'Agency name'; ?></th>
                        <th><?php echo 'Test name'; ?></th>
                        <th><?php echo 'Phlebotomist'; ?></th> 
                        <th><?php echo 'Date'; ?></th>
                        <th><?php echo 'Report Date'; ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php  
                foreach ($patients as $patient): 
                ?>	 	
                    <tr>
                        <td><?php echo $patient['details']['id']; ?></td>
                        <td><?php echo $patient['details']['patientname']; ?></td>
                        <td><?php echo $patient['details']['doctorname']; ?></td>
                        <td><?php echo $patient['details']['agencyname']; ?></td>
                        <td><?php echo $patient['details']['testname']; ?></td>
                        <td><?php echo $patient['details']['phelboname']; ?></td>
                        <td><?php echo $patient['details']['date']; ?></td>
                        <td><?php echo $patient['details']['report_date']; ?></td>
                    </tr> 
                <?php
                endforeach; ?>
                </tbody>
            </table> 
        </div>
        <div class="tab-pane" id="2">
<table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><?php echo 'Id'; ?></th>
                        <th><?php echo 'Patient name'; ?></th>
                        <th><?php echo 'Doctor name'; ?></th>
                        <th><?php echo 'Agency name'; ?></th>
                        <th><?php echo 'Test name'; ?></th>
                        <th><?php echo 'Phlebotomist'; ?></th> 
                        <th><?php echo 'Date'; ?></th>
                        <th><?php echo 'Report Date'; ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php  
                foreach ($patientsvisits as $patientvisit): 
                ?>	 	
                    <tr>
                        <td><?php echo $patientvisit['visit']['id']; ?></td>
                        <td><?php echo $patientvisit['visit']['patientname']; ?></td>
                        <td><?php echo $patientvisit['visit']['doctorname']; ?></td>
                        <td><?php echo $patientvisit['visit']['agencyname']; ?></td>
                        <td><?php echo $patientvisit['visit']['testname']; ?></td>
                        <td><?php echo $patientvisit['visit']['phelboname']; ?></td>
                        <td><?php echo $patientvisit['visit']['date']; ?></td>
                        <td><?php echo $patientvisit['visit']['report_date']; ?></td>
                    </tr> 
                <?php
                endforeach; ?>
                </tbody>
            </table>        </div>
    </div>
</div>


</div>
</div>
</div></div>
</section>
<style>
.checkbox input[type=checkbox] { margin-left: 0px !important;margin-top:2px;}
.checkbox label{color:#000 !important;}
input, textarea{color:#000 !important;}
</style>

<style>
.table{
margin-bottom:0px !important;
}
.select label {
    color: #000;
    float: left;
    margin-right: 10px;
    margin-bottom: 0;
    width: auto;
    margin: 10px 15px 10px 0;
}

.form-control {
    width: 60%;
    margin: 0;
}

.right_number {
    width: auto;
    float: left;
    position: absolute;
    right: -3px;
    top: 11px;
    background-color: green;
    border-radius: 50px;
    padding: 0px 6px;
    color: #fff;
}


</style>
<script>
$(document).ready(function(){
	$("#datepickerfrom").datepicker({format:"yyyy-mm-dd"});
	$("#datepickerto").datepicker({format:"yyyy-mm-dd"});
	$("#apply").click(function(){
		var datefrom = $("#datepickerfrom").val();
		var dateto = $("#datepickerto").val();
		
		if(dateto=="" || datefrom==""){
		    alert("Please select both Dates");
		    return false;
		}
		var adata = {
       	 datefrom:datefrom,
		 dateto:dateto
    	}
    	  $.ajax({
                type: 'POST',
                url:'<?php echo $this->webroot ?>users/ajaxsearchdate',
                data:adata,
                success: function(msg){
                	console.log(msg);
                	$('#example tbody').html(msg);
                	
                	console.log(msg.length);
                	return false;
                }
            }); 
            
            
	
	});
});
</script>
<style>
.checkbox input[type=checkbox] { margin-left: 0px !important;margin-top:2px;}
.checkbox label{color:#000 !important;}
input, textarea{color:#000 !important;}
table tr td {color:#000;}
</style>

<style>
#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab2 .nav-pills > li > a {
  border-radius: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab2 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab2 .tab-content {
  color : white;
  padding :10px 0;
}
.table{
margin-bottom:0px !important;
}
.select label {
    color: #000;
    float: left;
    margin-right: 10px;
    margin-bottom: 0;
    width: auto;
    margin: 10px 15px 10px 0;
}

.form-control {
    width: 60%;
    margin: 0;
}

.right_number {
    width: auto;
    float: left;
    position: absolute;
    right: -3px;
    top: 11px;
    background-color: green;
    border-radius: 50px;
    padding: 0px 6px;
    color: #fff;
}
#flashMessage{
  width: 305px;
}


</style>