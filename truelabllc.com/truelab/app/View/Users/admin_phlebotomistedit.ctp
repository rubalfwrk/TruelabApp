  <section class="content">
      <div class="row">
        <!-- left column -->
       <div class="col-md-6 col-sm-6 col-xs-12">
          <!-- general form elements -->
      
<!--            <div class="box-header with-border">
              <h2 style="margin:0 !important">Edit User Details</h2>
            </div>-->
 
    <div class="box box-primary form_sec">
            <div class="box-header with-border">
              <h3 class="box-title">Phlebotomist Edit</h3>
            </div>
          

   
        <?php echo $this->Form->create('User');?>
       <div class="box-body">    
        <?php echo $this->Form->input('id'); ?>
       
        <?php echo $this->Form->input('firstname', array('label' => 'First Name', 'class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('lastname', array('label' => 'Last Name', 'class' => 'form-control')); ?>
        <br/>
        <?php echo $this->Form->input('address', array('label' => 'Address', 'type' => 'text', 'class' => 'form-control')); ?>
        <br />
         <?php echo $this->Form->input('address2', array('label' => 'Address2', 'class' => 'form-control')); ?>
        <br />
         <?php echo $this->Form->input('city', array('label' => 'City', 'class' => 'form-control')); ?>
        <br />
         <?php echo $this->Form->input('state', array('label' => 'State',  'class' => 'form-control')); ?>
        <br />
         <?php echo $this->Form->input('zipcode', array('label' => 'Zip Code', 'class' => 'form-control')); ?>
        <br />
         <?php echo $this->Form->input('phonenumber', array('class' => 'form-control')); ?>
        
        <br />
        <?php echo $this->Form->input('email', array('class' => 'form-control','readOnly'=>'required')); ?>
        
        <br />
          <?php echo $this->Form->input('phlebotomistadddate', array('label' => 'Date Hired', 'type' => 'text', 'class' => 'form-control', 'id'=>"datepicker")); ?>

 <div class="box-footer">
   <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
</div>
</div>
    <?= $this->Form->end() ?>

    </div></div></div>
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
<script>
$(document).ready(function(){
	$( "#datepicker" ).datepicker({ format: 'yyyy-mm-dd' });
});
</script>