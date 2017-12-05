<!-- Content Header (Page header) -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>


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
              <h3 class="box-title"><?php echo $this->request->data['Agency']['agencyname']; ?></h3>
            </div>
 

        <?php echo $this->Form->create('Agency');?>
       <div>    
        <?php echo $this->Form->input('agencyname', array('label' => 'Agency Name', 'class' => 'form-control')); ?>
        <br />
       <?php echo $this->Form->input('agencyemail', array('label' => 'Agency Email', 'type' => 'text', 'class' => 'form-control')); ?>
       <br />
        <?php //echo $this->Form->input('password', array('label' => 'Password', 'type' => 'text', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('agencyphonenumber', array('label' => 'Agency Phone', 'class' => 'form-control')); ?> 
         <?php echo $this->Form->input('agencyfax', array('label' => 'Agency fax', 'class' => 'form-control')); ?> 

       <?php echo $this->Form->input('address', array('label' => 'Address', 'type' => 'text', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('address2', array('label' => 'Address2', 'type' => 'text', 'class' => 'form-control')); ?>
        <div class="city_adjust1"><?php echo $this->Form->input('city', array('label' => 'City', 'type' => 'text', 'class' => 'form-control','required')); ?></div>
        <div class="city_adjust"><?php echo $this->Form->input('state', array('label' => 'State', 'type' => 'text', 'class' => 'form-control city_adjust','required')); ?></div>
        <div class="city_adjust"><?php echo $this->Form->input('zipcode', array('label' => 'Zip Code', 'type' => 'text', 'class' => 'form-control city_adjust','required')); ?></div>

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
     format: 'mm-dd-yyyy',
            endDate: '+0d',
            autoclose: true
        });
  });
  </script>