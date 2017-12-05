
<section class="content">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
                    <h3 class="box-title">Patient</h3>

  <strong><?php echo $this->Session->flash(); ?></strong>
                </div>


<table style="background: #fff;width: 97%;margin: 0 auto;" class="table-striped table-bordered table-condensed table-hover table">
    <tr>
        <td>Id</td>
        <td><?php echo h($patient['Patient']['id']); ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo h($patient['Patient']['firstname'] . ' ' . $patient['Patient']['lastname']); ?></td>
    </tr>
    <tr>
        <td>Tracking Id</td>
        <td><?php echo h($patient['Patient']['trackingid']); ?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?php echo h($patient['Patient']['address']); ?></td>
    </tr>
    <tr>
        <td>Address2</td>
        <td><?php echo h($patient['Patient']['address2']); ?></td>
    </tr>
	<tr>
        <td>City</td>
        <td><?php echo h($patient['Patient']['city']); ?></td>
    </tr>
	<tr>
        <td>State</td>
        <td><?php echo h($patient['Patient']['state']); ?></td>
    </tr>
	<tr>
        <td>Zipcode</td>
        <td><?php echo h($patient['Patient']['zipcode']); ?></td>
    </tr>
	<tr>
        <td>Phone Number</td>
        <td><?php echo h($patient['Patient']['phonenumber']); ?></td>
    </tr>
	<tr>
        <td>Date Of Birth</td>
        <td><?php echo h($patient['Patient']['dob']); ?></td>
    </tr>
    <tr>
    	<td>Age</td>
        <td><?php echo $patage; ?></td>
    </tr>
    <tr>
        <td>Sex</td>
        <?php if($patient['Patient']['sex'] == 'male') { ?>
        <td><?php echo 'Male'; ?></td>
        <?php }else{ ?>
        <td><?php echo 'Female'; ?></td>
        <?php } ?>
    </tr>
	<tr>
        <td>Insurance Name</td>
        <td><?php echo h($patient['Patient']['insurancename']); ?></td>
    </tr>

	<tr>
        <td>Insurance Number</td>
        <td><?php echo h($patient['Patient']['insurancenumber']); ?></td>
    </tr>

	<tr>
        <td>Doctor Name</td>
        <td><?php echo h($patient['Patient']['doctorname']); ?></td>
    </tr>
	<tr>
        <td>Doctor Number</td>
        <td><?php echo h($patient['Patient']['doctornumber']); ?></td>
    </tr>
	<tr>
        <td>Doctor Fax Number</td>
        <td><?php echo h($patient['Patient']['doctorfaxnumber']); ?></td>
    </tr>
	<tr>
        <td>Doctor Npi Number</td>
        <td><?php echo h($patient['Patient']['doctornpi']); ?></td>
    </tr>
    <tr>
        <td>Patient Detail</td>
        <td><?php echo h($patient['Patient']['diagnosis']); ?></td>
    </tr>

<!--	<tr>
        <td>Created Date</td>
        <td><?php echo h(date("Y-m-d", strtotime($patient['Patient']['created']))); ?></td>
    </tr>
--></table>

<div class="container">
<div class="col-sm-12 padding">
<?php if($loggedUserRole != 'user') { ?>
<div class="form_sec mg10">
<h3>Actions</h3>
<?php echo $this->Html->link('View Tests', array('action' => 'test', $patient['Patient']['id']), array('class' => 'btn btn-warning view1')); ?>
<?php echo $this->Form->postLink('Delete Patient', array('action' => 'delete', $patient['Patient']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $patient['Patient']['id'])); ?>

</div>
<?php } ?>
</div>
</div>

</div>
</div>
</div>
</section>

<style>
.btn.btn-success{
	margin-left:15px;
	}
	.content-wrapper{
		min-height:423px !important;
	}
        .view1{margin-right:10px;}
</style>


<script type="text/javascript">
    $(document).ready(function(){
        $(".slide-toggle").click(function(e){
            e.preventDefault();
            //console.log($(this).text());
            if($(this).text()=='Show'){
                $(this).text('Hide');
            }
            else{
                $(this).text('Show');
            }
            $(".passwordshow").animate({
                width: "toggle"
            });
        });
    });
</script>