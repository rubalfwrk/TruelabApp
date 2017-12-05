    <style type="text/css">
    .datepicker-months table tbody tr td span.month{
      display: inline-block !important;
      padding: 7px !important;
      border: 1px solid #ddd !important;
      border-right: none !important;
    }
    .datepicker-months table tbody tr td span.month:last-child{
      border-right: 1px solid #ddd !important;
    }
    </style>
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box form_sec">
            <div class="box-header with-border">
                <?php echo $this->Session->flash(); ?>
              <h3 class="box-title">Add Patient</h3>
            </div>
 
      <?php echo $this->Form->create('Patient', array("id" => "patientadd"));?>
      <div class="box-body">    
       
        <?php echo $this->Form->input('firstname', array('label' => 'First Name', 'class' => 'form-control','required')); ?>
        <br />
        <?php echo $this->Form->input('lastname', array('label' => 'Last Name', 'class' => 'form-control','required')); ?>
        <br />
         <?php echo $this->Form->input('address', array('type' => 'text', 'label' => 'Address', 'class' => 'form-control','required')); ?>
        <br />
         <?php echo $this->Form->input('address2', array('type' => 'text', 'label' => 'Address2', 'class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('city', array('label' => 'City', 'class' => 'form-control','required')); ?>
        <br />
        <?php echo $this->Form->input('state', array('label' => 'State', 'class' => 'form-control','required')); ?>
        <br />
        <?php echo $this->Form->input('zipcode', array('label' => 'Zip Code', 'class' => 'form-control','required')); ?>
        <br />
        
        <?php echo $this->Form->input('phonenumber', array('label' => 'Phone Number', 'type' => 'number', 'class' => 'form-control', 'required')); ?>
        <br />
         <?php echo $this->Form->input('sex', array('label' => 'Sex', 'type' => 'select', 'options' => array('male' => 'Male', 'female' => 'Female'), 'class' => "form-control")); ?>
        <br />
        <?php echo $this->Form->input('dob', array('label' => 'Date Of Birth', 'type' => 'text', 'id' => 'datepicker', 'class' => 'form-control','required')); ?>
        <br />
        <?php echo $this->Form->input('insurancename', array('label' => 'Insurance Name', 'class' => 'form-control','required')); ?>
        <br />
        <?php echo $this->Form->input('insurancenumber', array('label' => 'Insurance Number', 'class' => 'form-control')); ?>
        <br/>
        <?php if($userrole == 'admin'){ ?>
       <?php echo $this->Form->input('doctorname', array('type' => 'hidden', 'class' => 'form-control', 'id' => 'adddoctorname')); ?>
        <?php echo $this->Form->input('doctorid', array('id' => 'seldoctor', 'type' => 'select', 'options' => $doctorsel, 'class' => "form-control", 'label' => 'Doctor Name')); ?><span id="checkselect"></span>
        <br />
        <?php } else { ?>
        <?php echo $this->Form->input('doctorname', array('type' => 'hidden', 'class' => 'form-control', 'value' => $doctorname)); ?>
        <?php echo $this->Form->input('doctorid', array('id' => 'seldoctor', 'type' => 'select', 'options' => $doctorsel, 'class' => "form-control", 'label' => 'Doctor Name')); ?>
        <br />
        <?php } ?>
       
       <?php echo $this->Form->input('doctornumber', array('id' => 'doctornumber', 'class' => 'form-control','required', 'label' => 'Doctor Number','readonly' => 'readonly')); ?>
        <br />
        <?php echo $this->Form->input('doctorfaxnumber', array('id' => 'doctorfaxnumber', 'class' => 'form-control','required', 'label' => 'Doctor Fax','readonly' => 'readonly')); ?>
        <br />
        <?php echo $this->Form->input('doctornpi', array('id' => 'doctornpi', 'class' => 'form-control','required', 'label' => 'Doctor Npi','readonly' => 'readonly')); ?>
        <br />
         <?php echo $this->Form->input('diagnosis', array('type' => 'textarea', 'label' => 'Patient Detail', 'class' => 'form-control')); ?>
 <div class="box-footer">
   <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary btn-info')); ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div></div>
</section>

 <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change', '#seldoctor', function() {
             var selectdoctor = $("#seldoctor :selected").text();
			 var doctorid = $(this).val();
            //alert(doctorid);
            $('#adddoctorname').val(selectdoctor);
			data = {
				doctorid : doctorid
			}
			$.ajax({
				url: '<?php echo $this->webroot ?>admin/patients/ajaxagencyload',
				data: data,
				method: 'post',
				success: function(html){
					$("#checkselect").html(html);

					$.ajax({
						url: '<?php echo $this->webroot ?>admin/patients/autoloaddoctorinfo',
						data: data,
						dataType: 'json',
						method: 'post',
						success: function(obj){
							//console.log(obj.doctornumber);
							$("#doctornumber").val(obj.doctornumber);
							$("#doctorfaxnumber").val(obj.doctorfax);
							$("#doctornpi").val(obj.doctornpi);
						}		
					});
				}		
			});
  
		});
	});

</script>

  <script>
  $( function() {
     $("#datepicker" ).datepicker({ 
     format: 'yyyy-mm-dd',
            endDate: '+0d',
            autoclose: true
        });
  });
  </script>