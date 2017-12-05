<?php echo $this->Session->flash() ?> 
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary form_sec">
            <div class="box-header with-border">
              <h3 class="box-title">Agency Registration</h3>
            </div>
 
      <?php echo $this->Form->create('User', array('role'=>'form', 'action' => 'admin_addagency')); ?>
      <div>    
       <?php //echo $this->Form->input('role', array('disabled' => 'disabled', 'class' => 'form-control', 'options' => array('client' => 'Client'))); ?>
       <?php echo $this->Form->input('role', array('type' => 'hidden', 'value' => 'client')); ?>
        <br />
        <?php echo $this->Form->input('email', array('class' => 'form-control','placeholder'=>'Email','label'=>'Email','required')); ?>
        <br />
        <?php echo $this->Form->input('password', array('class' => 'form-control','required')); ?>
        <br />
        <?php echo $this->Form->input('agencyphonenumber', array('label' => 'Agency Phone', 'type' => 'number', 'class' => 'form-control')); ?>
        <br />
		
        <?php echo $this->Form->input('agencyfax', array('id' => 'agencyfax', 'label' => 'Agency Fax', 'type' => 'text', 'class' => 'form-control')); ?>
        <br/>
        <?php /* echo $this->Form->input('firstname', array('label' => 'Doctor Name', 'class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('phonenumber', array('label' => 'Doctor Phone', 'type' => 'number', 'class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('fax', array('label' => 'Doctor Fax Number', 'type' => 'text', 'class' => 'form-control')); ?>
        <br/>
        <?php echo $this->Form->input('npi', array('label' => 'Doctor NPI Number', 'type' => 'text', 'class' => 'form-control')); */ ?>
        <br/>
         <?php echo $this->Form->input('address', array('id' => 'agencyaddress', 'label' => 'Address', 'type' => 'text', 'class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('address2', array('label' => 'Address2', 'type' => 'text', 'class' => 'form-control')); ?>
        <br />

        
        <div class="city_adjust1"><?php echo $this->Form->input('city', array('label' => 'City', 'type' => 'text', 'class' => 'form-control','required')); ?></div>
        <br />
          <div class="city_adjust"><?php echo $this->Form->input('state', array('label' => 'State', 'type' => 'text', 'class' => 'form-control city_adjust','required')); ?></div>
        <br />
         <div class="city_adjust"><?php echo $this->Form->input('zipcode', array('label' => 'Zip Code', 'type' => 'text', 'class' => 'form-control city_adjust','required')); ?></div>
        <br />
        
        
        <div>
   <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary btn-success btn-info', 'value' => 'addagency')); ?>
</div>
</div>
    <?= $this->Form->end() ?>

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
