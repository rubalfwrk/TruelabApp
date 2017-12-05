    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-sm-12 col-xs-12">
          <!-- general form elements -->
      
<!--            <div class="box-header with-border">
              <h2 style="margin:0 !important">Edit User Details</h2>

            </div>-->
 
    <div class="box form_sec">
            <div class="box-header with-border">
              <h3 class="box-title">Client Edit</h3>
            </div>
          <div class="main-content">
            <?php echo $this->Form->create('User');?>
              <div class="box-body" style="padding: 0px;">    
                <?php echo $this->Form->input('id'); ?>
                <?php //echo $this->Form->input('role', array('class' => 'form-control', 'options' => array('admin' => 'admin', 'customer' => 'customer','rest_admin'=>'Restaurant Admin'),'default'=> $this->request->data['User']['role'] )); ?>
                <?php echo $this->Form->input('firstname', array('label' => 'Doctor Name', 'class' => 'form-control')); ?>
                <?php echo $this->Form->input('email', array('label' => 'Email', 'class' => 'form-control','readOnly'=>'required')); ?>
                <?php echo $this->Form->input('phonenumber', array('label' => 'Doctor Phone', 'class' => 'form-control')); ?> 
                 <?php echo $this->Form->input('fax', array('label' => 'Doctor fax', 'type' => 'text', 'class' => 'form-control')); ?> 
                 <?php echo $this->Form->input('npi', array('label' => 'Doctor Npi', 'type' => 'text', 'class' => 'form-control')); ?>
                <?php //echo $this->Form->input('lastname', array('label' => 'Last Name', 'class' => 'form-control')); ?>
                <?php if($this->request->data['User']['agencyname'] != NULL) { ?>
                <?php echo $this->Form->input('agencyname', array('label' => 'Agency Name', 'class' => 'form-control')); ?>
                <?php echo $this->Form->input('agencyphonenumber', array('label' => 'Agency Phone', 'class' => 'form-control')); ?> 
                 <?php echo $this->Form->input('agencyfax', array('label' => 'Agency fax', 'class' => 'form-control')); ?> 
                 <?php } ?>
                <?php echo $this->Form->input('address', array('label' => 'Address', 'type' => 'text', 'class' => 'form-control')); ?>
                <?php echo $this->Form->input('address2', array('label' => 'Address2', 'type' => 'text', 'class' => 'form-control')); ?>
                <div class="city_adjust1"><?php echo $this->Form->input('city', array('label' => 'City', 'type' => 'text', 'class' => 'form-control','required')); ?></div>
                <div class="city_adjust"><?php echo $this->Form->input('state', array('label' => 'State', 'type' => 'text', 'class' => 'form-control city_adjust','required')); ?></div>
                <div class="city_adjust"><?php echo $this->Form->input('zipcode', array('label' => 'Zip Code', 'type' => 'text', 'class' => 'form-control city_adjust','required')); ?></div>
                <?php echo $this->Form->button('Submit', array('class' => 'btn btn-info')); ?>
              </div>
            <?= $this->Form->end() ?>
          </div>
		

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