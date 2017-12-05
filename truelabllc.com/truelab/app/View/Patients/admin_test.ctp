<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>-->
<!-- Content Header (Page header) -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
                    <h3 style="margin:0px !important;" class="box-title">Patients Tests Status</h3>
                </div>
                <div class="main-content">
                    <?php $x = $this->Session->flash(); ?>
                    <?php if ($x) { ?>
                    <div class="alert success">
                        <span class="icon"></span>
                        <strong></strong><?php echo $x; ?>
                    </div>
                    <?php }  
 ?>

<div id="exTab2">	
	<ul class="nav nav-tabs">
		<li class="active">
       		<a  href="#1" data-toggle="tab">Unschedule</a>
		</li>
		<li>
         <a href="#2" data-toggle="tab">Schedule</a><div class="right_number"><?php if($count_schedule > 0){ echo $count_schedule;  } ?></div>
		</li>
		<li>
         	<a href="#3" data-toggle="tab">Accepted</a><div class="right_number"><?php if($count_accept > 0){ echo $count_accept; } ?></div>
		</li>
        
        <li>
        <a href="#4" data-toggle="tab">Decline</a><div class="right_number"><?php if($count_decline > 0){ echo $count_decline; } ?></div>
		</li>

        <li>
        	<a href="#5" data-toggle="tab">Cancel</a><div class="right_number"><?php if($canceltestscount > 0){ echo $canceltestscount; } ?></div>
		</li> 
		</ul>
			<div class="tab-content ">
				<div class="tab-pane active" id="1">
    <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>

        <th><?php echo 'Test name'; ?></th>
        <th><?php echo 'Request Date'; ?></th>
        <th><?php echo 'Fasting'; ?></th>
        <th><?php echo 'Patient name'; ?></th>
        <?php if($loggedUserRole=='admin') { ?>
        <th><?php echo 'Phlebotomists'; ?></th>
        <?php } ?>
        <th><?php echo 'Doctor'; ?></th>
        <th><?php echo 'Phlebotomist Declined reason'; ?></th>
        <th><?php echo 'Action'; ?></th>
    </tr>
    </thead>
    <tbody>
  <?php  
     foreach ($tests as $test): 
	 	if($test['PatientTest']['status'] == 0){
                if($test['PatientTest']['fasting'] == 1){ 
                    $fasting = 'Yes'; 
                }else{ 
                    $fasting = 'No';
                } 
                if($userrole != 'admin'){
                    $notchange = 'disabled';
                    $display = 'display:none';
                }else{
                 $notchange = ' ';
                 //$display = 'display:block';
                }
	 ?>
    <tr>
	<?php 
  //print_r($tests); die;
  echo $this->Form->create('PatientTest'); ?>
    	<?php echo $this->Form->input('patient_row_id', array('type' => 'hidden', 'value' => $test['PatientTest']['id'])); ?>
        <?php echo $this->Form->input('patient_id', array('type' => 'hidden', 'value' => $test['PatientTest']['patientid'])); ?>
        <td><?php echo $this->Form->input('test', array('type' => 'checkbox', 'value' => $test['Test']['id'], 'label' => array('class' => 'testchck', 'text'=>$test['Test']['test']))); ?></td>
        <td><?php echo $test['PatientTest']['request_date']; ?></td>

        <td><?php echo $this->Form->input('fasting', array('label' => '', 'disabled' => 'disabled', 'type' => 'text', 'value' => $fasting)); ?></td>
         <td><?php echo $patientname['Patient']['firstname'] . ' ' . $patientname['Patient']['lastname']; ?></td>
         <?php if($loggedUserRole=='admin') { ?>

        <td><?php echo $this->Form->input('users', array('type' => 'select', 'options' => $usersel, 'class' => "form-control", 'label' => '', 'empty'=>'-Select Phlebotomists-', 'required' => true)); ?></td>
       <?php } ?>
        <td><?php echo $patientname['Patient']['doctorname']; ?></td>
        <td><?php echo $test['PatientTest']['userreason']; ?></td>
        
        <td>
        <?php if($loggedUserRole!='client') { ?>
        <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary my-btn-primary')); ?>
        <?php } ?>
        <?php echo $this->Html->link('Cancel', array('action' => 'cancel', $test['PatientTest']['id'],$test['PatientTest']['patientid'],$test['PatientTest']['testid']), array('class' => 'btn  btn-xs btn-info btn-edit my-btn-primary1')); ?>
        <?php //echo $this->Html->link('Cancel', array('action' => 'deleterequest', $test['PatientTest']['id'],$test['PatientTest']['patientid']), array('class' => 'btn  btn-xs btn-info btn-edit')); ?></td>
        </form>
   </tr> 
  <?php
  	}
     endforeach; ?>
    </tbody>
</table> 
</div>
<div class="tab-pane" id="2">
    <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>

        <th><?php echo 'Test name'; ?></th>
        <th><?php echo 'Fasting'; ?></th>
        <th><?php echo 'Assign Date'; ?></th>
        <th><?php echo 'Patient name'; ?></th>
       <?php if($loggedUserRole=='admin') { ?> 
       <th><?php echo 'Phlebotomists'; ?></th>
       <th><?php echo 'Admin Rescheduled reason'; ?></th>
        <?php } ?>
        <th><?php echo 'Actions'; ?></th>
    </tr>
    </thead>
    <tbody>
  <?php  
     foreach ($tests as $test): 
	 	if($test['PatientTest']['status'] == 1){
                if($test['PatientTest']['fasting'] == 1){ 
                    $fasting = 'Yes'; 
                }else{ 
                    $fasting = 'No';
                } 
	 ?>
    <tr>
    	<?php echo $this->Form->input('patient_row_id', array('type' => 'hidden', 'value' => $test['PatientTest']['id'])); ?>
        <?php echo $this->Form->input('patient_id', array('type' => 'hidden', 'value' => $test['PatientTest']['patientid'])); ?>
       <td><?php echo $this->Form->input('test', array('type' => 'checkbox', 'value' => $test['Test']['id'], 'label' => array('class' => 'testchck', 'text'=>$test['Test']['test']))); ?></td>
       <td><?php echo $this->Form->input('fasting', array('label' => '', 'disabled' => 'disabled', 'type' => 'text', 'value' => $fasting)); ?></td>
       <td><?php echo $this->Form->input('schdueleddate', array('label' => '', 'disabled' => 'disabled', 'type' => 'text', 'value' => $test['PatientTest']['schdueleddate'])); ?></td>
       <td><?php echo $patientname['Patient']['firstname'] . ' ' . $patientname['Patient']['lastname']; ?></td>
       <?php if($loggedUserRole=='admin') { ?>
        <td><?php echo $this->Form->input('users', array('label' => '', 'type' => 'select', 'options' => $usersel, 'default'=>$test['PatientTest']['userid'],  'class' => "form-control", "disabled" => "disabled")); ?></td>
        <td><?php echo $test['PatientTest']['userreason']; ?></td>
        <?php } ?>
        <td><?php echo $this->Html->link('Cancel', array('action' => 'cancel', $test['PatientTest']['id'],$test['PatientTest']['patientid'],$test['PatientTest']['testid']), array('class' => 'btn  btn-xs btn-info btn-edit')); ?></td>
   </tr> 
  <?php
  	}
     endforeach; ?>
    </tbody>
</table> 
				</div>
        		<div class="tab-pane" id="3">
    <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>

        <th><?php echo 'Test name'; ?></th>
         <th><?php echo 'Fasting'; ?></th>
         <th><?php echo 'Patient name'; ?></th>
        <?php if($loggedUserRole=='admin') { ?><th><?php echo 'Phlebotomists'; ?></th><?php } ?>
        <th><?php echo 'Phlebotomists Reason'; ?></th>
        <th><?php echo 'Patient Reason'; ?></th>

        <th><?php echo 'Date'; ?></th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
  <?php  
     foreach ($tests as $test): 
	 	if($test['PatientTest']['status'] == 2 && !empty($test) && $test['PatientTest']['reporttime'] == NULL){
                if($test['PatientTest']['fasting'] == 1){ 
                    $fasting = 'Yes'; 
                }else{ 
                    $fasting = 'No';
                }                 
	 ?>
    <tr>
    	<?php echo $this->Form->input('patient_row_id', array('type' => 'hidden', 'value' => $test['PatientTest']['id'])); ?>
       <td><?php echo $this->Form->input('test', array('type' => 'checkbox', 'value' => $test['Test']['id'], 'label' => array('class' => 'testchck', 'text'=>$test['Test']['test']))); ?></td>
       <td><?php echo $this->Form->input('fasting', array('label' => '', 'disabled' => 'disabled', 'type' => 'text', 'value' => $fasting)); ?></td>
       <td><?php echo $patientname['Patient']['firstname'] . ' ' . $patientname['Patient']['lastname']; ?></td>
       <?php if($loggedUserRole=='admin') { ?>
       <td><?php echo $this->Form->input('users', array('label' => '', 'type' => 'select', 'options' => $usersel, 'default'=>$test['PatientTest']['userid'], 'class' => "form-control", "disabled" => "disabled" )); ?></td>
       <?php } ?>
        <td><?php echo $test['PatientTest']['userreason']; ?></td>
        <td><?php echo $test['PatientTest']['patientreason']; ?></td>

       <td><?php echo $this->Form->input('date', array('label'=>'','disabled' => 'disabled', 'type' => 'text', 'value' => $test['PatientTest']['date'])); ?></td>
        <td>
        <?php echo $this->Html->link('Reschedule', array('action' => 'reschedule', $test['PatientTest']['id'],$test['PatientTest']['patientid'],$test['PatientTest']['testid']), array('class' => 'btn btn-primary btn-xs btn-view')); ?>
        <?php echo $this->Html->link('Cancel', array('action' => 'cancel', $test['PatientTest']['id'],$test['PatientTest']['patientid'],$test['PatientTest']['testid']), array('class' => 'btn  btn-xs btn-info btn-edit')); ?></td>
    </tr> 
  <?php
  	}
     endforeach; ?>
    </tbody>
</table> 
				</div>
<div class="tab-pane" id="4">
    <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>

        <th><?php echo 'Test name'; ?></th>
        <th><?php echo 'Fasting'; ?></th>
        <th><?php echo 'Patient name'; ?></th>
       <?php if($loggedUserRole=='admin') { ?> <th><?php echo 'Phlebotomists'; ?></th><?php } ?>
        <th><?php echo 'Reason'; ?></th>
        <th><?php echo 'Action'; ?></th>
    </tr>
    </thead>
    <tbody>
  <?php  
     foreach ($tests as $test): 
	 	if($test['PatientTest']['status'] == 3){
                 if($test['PatientTest']['fasting'] == 1){ 
                    $fasting = 'Yes'; 
                }else{ 
                    $fasting = 'No';
                }                 
	 ?>
    <tr>
	<?php echo $this->Form->create('PatientTest'); ?>
        <?php echo $this->Form->input('patienttestid', array('type' => 'hidden', 'value' => $test['PatientTest']['id'])); ?>
       <td><?php echo $this->Form->input('test', array('type' => 'checkbox', 'value' => $test['Test']['id'], 'label' => array('class' => 'testchck', 'text'=>$test['Test']['test']))); ?></td>
       <td><?php echo $this->Form->input('fasting', array('label' => '', 'disabled' => 'disabled', 'type' => 'text', 'value' => $fasting)); ?></td>
        <td><?php echo $patientname['Patient']['firstname'] . ' ' . $patientname['Patient']['lastname']; ?></td>
        <?php if($loggedUserRole=='admin') { ?>
        <td><?php echo $this->Form->input('users', array('label' => '', 'type' => 'select', 'options' => $usersel, 'default'=>$test['PatientTest']['userid'], 'class' => "form-control",'disabled' => 'disabled' )); ?></td>
        <?php } ?>
         <td> <?php echo $this->Form->input('reason', array('label' => '', 'disabled' => 'disabled','type' => 'textarea', 'value' => $test['PatientTest']['reason'])); ?></td>
        <td><?php echo $this->Html->link('Reschedule', array('action' => 'reschedule', $test['PatientTest']['id'],$test['PatientTest']['patientid'],$test['PatientTest']['testid']), array('class' => 'btn btn-primary btn-xs btn-view')); ?>

       <?php echo $this->Html->link('Cancel', array('action' => 'cancel', $test['PatientTest']['id'],$test['PatientTest']['patientid'],$test['PatientTest']['testid']), array('class' => 'btn  btn-xs btn-info btn-edit')); ?></td>
        <!--<td><?php //echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?></td>-->
        </form>
   </tr> 
  <?php
  	}
     endforeach; ?>
    </tbody>
</table> 
</div>
                            
 <div class="tab-pane" id="5">
    <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>

        <th><?php echo 'Test name'; ?></th>
        <th><?php echo 'Patient name'; ?></th>
        <?php if($loggedUserRole=='admin') { ?><th><?php echo 'Phlebotomists'; ?></th><?php } ?>
        <th><?php echo 'Doctor Name'; ?></th>
        <th><?php echo 'Reason'; ?></th>
        <th><?php echo 'Cancel Date'; ?></th>
<!--        <th><?php echo 'Action'; ?></th>-->
    </tr>
    </thead>
    <tbody>
        <?php foreach($finalcancel as $cancel) { ?>
        <tr>
            <td><?php echo $cancel['testname']; ?></td>
            <td><?php echo $patientname['Patient']['firstname'] . ' ' . $patientname['Patient']['lastname']; ?></td>    
            <?php if($loggedUserRole=='admin') { ?><td><?php echo $cancel['phleboname']; ?></td><?php } ?>
            <td><?php echo $cancel['doctorname']; ?></td>
            <td><?php echo $cancel['reason']; ?></td>
            <td><?php echo $cancel['cancel_date']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
</div> 
                            
                            
</div>
</div>

<hr></hr>


</div>
</div>
</div></div>
</section>
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

td.actions a.btn {
    padding: 7px 13px;
    font-size: 16px;
    margin-bottom: 3px;
}
td a{
	margin-bottom:5px !important;
}
</style>
