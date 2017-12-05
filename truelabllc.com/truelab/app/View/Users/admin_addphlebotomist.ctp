<?php echo $this->Session->flash() ?> 
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box form_sec">
            <div class="box-header with-border">
              <h3 class="box-title">User Registration</h3>
            </div>
 
      <?php echo $this->Form->create('User', array('role'=>'form'));?>
      <div class="box-body">    
       <?php echo $this->Form->input('role', array('disabled' => 'disabled', 'class' => 'form-control', 'options' => array('user' => 'Phlebotomist'))); ?>
        <br />
        <?php echo $this->Form->input('role', array('type' => 'hidden', 'value' => 'user')); ?>
        <?php echo $this->Form->input('firstname', array('label' => 'First Name', 'class' => 'form-control','required')); ?>
        <br />
        
         <?php echo $this->Form->input('lastname', array('label' => 'Last Name', 'class' => 'form-control','required')); ?>
        <br />
      
        <?php echo $this->Form->input('password', array('class' => 'form-control','required')); ?>
        <br />
        <?php echo $this->Form->input('address', array('label' => 'Address', 'type' => 'text', 'class' => 'form-control','required')); ?>
        <br />
        <?php echo $this->Form->input('address2', array('label' => 'Address2', 'type' => 'text', 'class' => 'form-control')); ?>
        <br />
        <div class="city_adjust1"><?php echo $this->Form->input('city', array('label' => 'City', 'type' => 'text', 'class' => 'form-control','required')); ?></div>
        <br />
          <div class="city_adjust"><?php echo $this->Form->input('state', array('label' => 'State', 'type' => 'text', 'class' => 'form-control city_adjust','required')); ?></div>
        <br />
         <div class="city_adjust"><?php echo $this->Form->input('zipcode', array('label' => 'Zip Code', 'type' => 'text', 'class' => 'form-control city_adjust','required')); ?></div>
        <br />
        <?php echo $this->Form->input('phonenumber', array('label' => 'Phone Number', 'type' => 'number', 'class' => 'form-control','required')); ?>
        <br />
        <?php echo $this->Form->input('email', array('class' => 'form-control','placeholder'=>'Email','label'=>'Email','required')); ?>
        <br />
        <?php echo $this->Form->input('phlebotomistadddate', array('label' => 'Date Hired', 'type' => 'text', 'class' => 'form-control', 'id'=>"datepicker",'required')); ?>
        <div class="box-footer">
   <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary btn-info')); ?>
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
<script>
$(document).ready(function(){
	$( "#datepicker" ).datepicker({ format: 'yyyy-mm-dd' });
});
</script>