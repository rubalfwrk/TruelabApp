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
              <h3 class="box-title">Cancel Test</h3>
            </div>


    <div class="col-md-12 padding" style="padding:0px;">
        <?php echo $this->Form->create('StatusCancel');?>
       <div class="box-body">    
        <?php echo $this->Form->input('admin_reason', array('type' => 'textarea', 'class' => 'form-control')); ?>
        <br />
        <?php //echo $this->Form->input('users', array('type' => 'select', 'options' => $usersel,  'class' => "form-control" )); ?>
         <?php //echo $this->Form->input('date', array('type' => 'datetime', 'class' => 'form-control')); ?>
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
select#StatusCancelDateMonth {
    width: 41%;
    float: left;
   visibility: visible;
}

select#StatusCancelDateDay {
    width: 24%;
    float: left;
    margin-left: 3px;
   visibility: visible;
}

select#StatusCancelDateYear {
    width: 32%;
    float: left;
    margin-left: 3px;
   visibility: visible;
   margin-top:-19px;
}

.input.datetime label {
    width: 100%;
    float: left;
     visibility: visible;
}

select#StatusCancelDateHour {
    width: auto;
    float: left;
    margin: 28px 0px;
   visibility: visible;
}

select#StatusCancelDateMin {
    width: auto;
    float: left;s
    margin: 28px 3px;
    visibility: visible;
    margin-top: 28px;
    margin-left: 3px;
}

select#StatusCancelDateMeridian {
    width: auto;
    float: left;
    margin: 28px 3px;
   visibility: visible;
}
.input.datetime {
    width: 100%;
    float: left;
    margin: 25px 0;
    visibility: hidden;
}
</style>
