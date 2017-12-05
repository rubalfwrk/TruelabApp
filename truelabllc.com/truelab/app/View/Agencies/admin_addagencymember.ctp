<?php echo $this->Session->flash() ?> 
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-sm-12 col-xs-12">
          <!-- general form elements -->
          <div class="box box-primary form_sec">
            <div class="box-header with-border">
              <h3 class="box-title">Doctor Registration</h3>
            </div>
 
      <?php //echo $this->Form->create('Agency', array('role'=>'form', 'action' => 'admin_addagencymember')); ?>
      <form method="post" action="<?php echo $this->webroot ?>admin/agencies/addagencymember/<?php echo $agencyinfo['Agency']['id'] ?>">
      <div>    
       <?php echo $this->Form->input('role', array('type' => 'hidden', 'value' => 'client')); ?>
       
        <?php echo $this->Form->input('agencyid', array('value' => $agencyinfo['Agency']['id'], 'class' => 'form-control', 'type' => 'hidden')); ?>
        <br /><br />
        
        
        <?php echo $this->Form->input('agencyname', array('value' => $agencyinfo['Agency']['agencyname'], 'id' => 'agencyname', 'label' => 'Agency Name', 'type' => 'text', 'class' => 'form-control', 'readonly')); ?>
        
        <?php echo $this->Form->input('email', array('value' => $agencyinfo['Agency']['agencyemail'], 'class' => 'form-control','placeholder'=>'Email','label'=>'Email', 'readonly')); ?>
        <br />
        <?php echo $this->Form->input('password', array('value' => $agencyinfo['Agency']['password'], 'class' => 'form-control', 'readonly')); ?>
        <br />
        <?php echo $this->Form->input('agencyphonenumber', array('value' => $agencyinfo['Agency']['agencyphonenumber'], 'label' => 'Agency Phone', 'type' => 'number', 'class' => 'form-control', 'readonly')); ?>
        <br />
		<?php echo $this->Form->input('simpass', array('value' => $agencyinfo['Agency']['simpass'], 'class' => 'form-control', 'type' => 'hidden')); ?>
        <br /><br />
        <?php echo $this->Form->input('agencyfax', array('value' => $agencyinfo['Agency']['agencyfax'], 'id' => 'agencyfax', 'label' => 'Agency Fax', 'type' => 'text', 'class' => 'form-control', 'readonly')); ?>
        <br/>
                 <?php echo $this->Form->input('address', array('value' => $agencyinfo['Agency']['address'], 'id' => 'agencyaddress', 'label' => 'Address', 'type' => 'text', 'class' => 'form-control', 'readonly')); ?>
        <br />
        <?php echo $this->Form->input('address2', array('value' => $agencyinfo['Agency']['address2'], 'label' => 'Address2', 'type' => 'text', 'class' => 'form-control', 'readonly')); ?>
        <br />

        
        <div class="city_adjust1"><?php echo $this->Form->input('city', array('value' => $agencyinfo['Agency']['city'], 'label' => 'City', 'type' => 'text', 'class' => 'form-control', 'readonly')); ?></div>
        <br />
          <div class="city_adjust"><?php echo $this->Form->input('state', array('value' => $agencyinfo['Agency']['state'], 'label' => 'State', 'type' => 'text', 'class' => 'form-control city_adjust', 'readonly')); ?></div>
        <br />
         <div class="city_adjust"><?php echo $this->Form->input('zipcode', array('value' => $agencyinfo['Agency']['zipcode'], 'label' => 'Zip Code', 'type' => 'text', 'class' => 'form-control city_adjust', 'readonly')); ?></div>
        <br />

        <?php  echo $this->Form->input('firstname', array('label' => 'Doctor Name', 'class' => 'form-control', 'required')); ?>
        <br />
        <?php echo $this->Form->input('phonenumber', array('label' => 'Doctor Phone', 'type' => 'number', 'class' => 'form-control', 'required')); ?>
        <br />
        <?php echo $this->Form->input('fax', array('label' => 'Doctor Fax Number', 'type' => 'text', 'class' => 'form-control')); ?>
        <br/>
        <?php echo $this->Form->input('npi', array('label' => 'Doctor NPI Number', 'type' => 'text', 'class' => 'form-control'));  ?>
        <br/>
        <div>
   <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary btn-success btn-info')); ?>
</div>
</div>
</form>
    <?php //$this->Form->end() ?>

</div></div></div>
</section>
<style>
     .city_adjust1>.input {
    width: 32%;
    float: left;
    
}
    .city_adjust>.input {
    width: 32%;
    float: left;
    margin-left: 2%;
}
    </style>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change', '#agencyname', function() {
             var selectdoctor = $("#agencyname :selected").text();
            //alert(selectdoctor);
            $('#agencynameval').val(selectdoctor);
  
});
});

</script>
