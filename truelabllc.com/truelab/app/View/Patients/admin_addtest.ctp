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
        <div class="col-md-6">
          <!-- general form elements -->
    <div class="form_sec white">
      
            <div class="box-header with-border">
              <h3 style="margin:0px !important;" class="box-title">Add New Test</h3>
            </div>
 
    
  
    <div class="col-md-12 padding" style="padding:0px !important;>
        <?php echo $this->Form->create('Test');?>
       <div class="box-body">    
         <?php echo $this->Form->create('Test', array('type' => 'file', 'id' => 'addtest')); ?>
        
        <?php echo $this->Form->input('test', array('type' => 'text', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('units', array('type' => 'text', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('referencerange', array('type' => 'text', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('freetext', array('label' => 'Free Text', 'type' => 'text', 'class' => 'form-control')); ?>                

        
        <div class="box-footer">
           <?php echo $this->Form->button('Submit', array('class' => 'btn btn-info')); ?>

            <?php $this->Form->end() ?>
<?php echo $this->Html->link('List of Tests', array('action' => 'testindex'), array('class' => 'btn btn-primary')); ?>
        </div>
</div>
   
</div>
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