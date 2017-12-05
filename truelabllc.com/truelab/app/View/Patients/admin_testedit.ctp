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
          <!-- general form elements -->
      
    <div class="form_sec white">

            <div class="box-header with-border">
              <h3 style="margin:0px !important;" class="box-title">Edit Test Details</h3>
            </div>
 
    
          

    <div class="col-md-12 padding" style="padding:0px;">
        <?php echo $this->Form->create('Test');?>
       <div>    
        <?php echo $this->Form->input('id'); ?>
        <?php // echo $this->Form->input('role', array('class' => 'form-control', 'options' => array('admin' => 'admin', 'customer' => 'customer','rest_admin'=>'Restaurant Admin'),'default'=> $this->request->data['User']['role'] )); ?>
        <br />
        <?php echo $this->Form->input('test', array('type' => 'text', 'class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('units', array('type' => 'text', 'class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('referencerange', array('type' => 'text', 'class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('freetext', array('type' => 'text', 'class' => 'form-control')); ?>
        <br />
        
        <div class="box-footer">
           <?php echo $this->Form->button('Submit', array('class' => 'btn btn-info')); ?>
        </div>
</div>
    <?php $this->Form->end() ?>

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