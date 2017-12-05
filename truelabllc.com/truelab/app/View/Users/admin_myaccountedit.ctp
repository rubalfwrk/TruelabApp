    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-xs-12">
          <!-- general form elements -->
      
<!--            <div class="box-header with-border">
              <h2 style="margin:0 !important">Edit User Details</h2>

            </div>-->
 
    <div class="box form_sec">
            <div class="box-header with-border">
              <h3 class="box-title">Admin Edit</h3>
            </div>
          <div class="main-content">
            <?php echo $this->Form->create('User', array('type' => 'file'));?>
              <div class="box-body" style="padding: 0px;">    
                <?php echo $this->Form->input('firstname', array('label' => 'Name', 'class' => 'form-control')); ?>
                <?php echo $this->Form->input('username', array('label' => 'Username', 'class' => 'form-control')); ?>
                <?php echo $this->Form->input('phonenumber', array('label' => 'Phone number', 'class' => 'form-control')); ?> 
                <?php echo $this->Form->input('email', array('label' => 'Email', 'class' => 'form-control')); ?>
                <?php echo $this->Form->input('image', array('type' => 'file', 'label' => 'Image', 'class' => 'form-control')); ?>
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

#UserAdminMyaccounteditForm .input.file input{
    float: left;	
}
</style>