<!-- Content Header (Page header) -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

<style type="text/css">
    .datepicker-months table tbody tr td span.month{
      display: inline-block !important;
      padding: 7px !important;
      border: 1px solid #ddd !important;
      border-right: none !important;
    }
    .datepicker-months table tbody tr td span.month:last-child{
      border-right: 1px solid #ddd !important;
    }
    </style>
<!--  <section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>

</section> -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box form_sec">
          <!-- general form elements -->
      
            <div class="with-border">
                <?php echo $this->Session->flash(); ?>
              <h3 style="margin:0px !important;" class="box-title">Edit Patient Details</h3>
            </div>
 

        <?php echo $this->Form->create('Patient');?>
       <div>    
        <?php echo $this->Form->input('id'); ?>
        <?php // echo $this->Form->input('role', array('class' => 'form-control', 'options' => array('admin' => 'admin', 'customer' => 'customer','rest_admin'=>'Restaurant Admin'),'default'=> $this->request->data['User']['role'] )); ?>
        <br />
        <?php echo $this->Form->input('firstname', array('label' => 'First Name', 'class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('lastname', array('label' => 'Last Name', 'class' => 'form-control')); ?>
        <br />
         <?php echo $this->Form->input('address', array('label' => 'Address', 'class' => 'form-control','readOnly'=>'required')); ?>
        <br /> 
        <?php echo $this->Form->input('address2', array('type' => 'text', 'label' => 'Address2', 'class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('city', array('label' => 'City', 'class' => 'form-control','required')); ?>
        <br />
        <?php echo $this->Form->input('state', array('label' => 'State', 'class' => 'form-control','required')); ?>
        <br />
        <?php echo $this->Form->input('zipcode', array('label' => 'Zip Code', 'class' => 'form-control','required')); ?>
        <br />
        <?php echo $this->Form->input('phonenumber', array('label' => 'Phone Number', 'class' => 'form-control')); ?>
        <br /> 
        <?php //echo $this->Form->input('dob', array('label' => 'Date Of Birth','class' => 'form-control')); ?>
        <?php echo $this->Form->input('dob', array('label' => 'Date Of Birth', 'type' => 'text', 'id' => 'datepicker', 'class' => 'form-control','required')); ?>
        <br />
        <?php //echo $this->Form->input('sex', array('label' => 'Sex', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('sex', array('label' => 'Sex',  'type' => 'select', 'options' => array('male' => 'Male', 'female' => 'Female'), 'class' => "form-control")); ?>
        <br />
	<?php echo $this->Form->input('insurancename', array('label' => 'Insurance Name', 'class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('insurancenumber', array('label' => 'Insurance Number','class' => 'form-control')); ?>
        <br />
        <?php if($userrole == 'admin'){ ?>
       <?php echo $this->Form->input('doctorname', array('type' => 'hidden', 'class' => 'form-control', 'id' => 'adddoctorname')); ?>
        <?php echo $this->Form->input('doctorid', array('id' => 'seldoctor', 'type' => 'select', 'options' => $doctorsel, 'class' => "form-control", 'label' => 'Doctor Name')); ?>
        <br />
        <?php } else {  ?>
        <?php echo $this->Form->input('doctorname', array('type' => 'hidden', 'class' => 'form-control', 'id' => 'adddoctorname')); ?>
        <?php echo $this->Form->input('doctorid', array('id' => 'seldoctor', 'type' => 'select', 'options' => $doctorsel, 'class' => "form-control", 'label' => 'Doctor Name')); ?>
        <br />
        <?php } ?>
        <?php echo $this->Form->input('doctornumber', array('class' => 'form-control', 'label' => 'Doctor Number')); ?>
        <br />
        <?php echo $this->Form->input('doctorfaxnumber', array('class' => 'form-control', 'label' => 'Doctor Fax')); ?>
        <br />
        <?php echo $this->Form->input('doctornpi', array('label' => 'Doctor Npi Number', 'class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('diagnosis', array('label' => 'Patient Detail', 'class' => 'form-control', 'type' => 'textarea')); ?>
        
        <div>
           <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary btn-info')); ?>
        </div>
</div>
    <?php $this->Form->end() ?>


</div>
</div>
</div>
</section>

<style>
.prcheck > label {
    float: left;
    margin-left: 5px;
    width: auto;
}
.prcheck > input {
    float: left;
}
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change', '#seldoctor', function() {
             var selectdoctor = $("#seldoctor :selected").text();
            //alert(selectdoctor);
            $('#adddoctorname').val(" ");
            $('#adddoctorname').val(selectdoctor);
  
});
});

</script>
<script>
  $( function() {
     $("#datepicker" ).datepicker({ 
     format: 'yyyy-mm-dd',
            endDate: '+0d',
            autoclose: true
        });
  });
  </script>