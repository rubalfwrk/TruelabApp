<section class="content">
	<div class="row">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div class="box form_sec">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Agency Password</h3>
				</div>
				<div class="main-content">
					<div class="box-body" style="padding: 0px;"> 
						<label>Agency Email : <?php echo $this->Form->value('Agency.agencyemail'); ?></label>   
						<?php echo $this->Form->create('Agency');?>
						<?php echo $this->Form->input('id', array('class' => 'form-control')); ?>
						<?php echo $this->Form->input('password', array('class' => 'form-control', 'value' => '')); ?>
						<?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary btn-info'));?>
						<?php echo $this->Form->end();?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>