 <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div style="border-top:0px;" class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Social page</h3>
            </div>
<?php echo $this->Form->create('Social',array('enctype'=>'multipart/form-data')); ?>
<div class="box-body"> 
	<?php
		echo $this->Form->input('name',array('class'=>'form-control'));
		//echo $this->Form->input('icon',array('type'=>'file','class'=>'form-control'));
		echo $this->Form->input('link',array('class'=>'form-control'));
	?>

 <div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div>
</section>

