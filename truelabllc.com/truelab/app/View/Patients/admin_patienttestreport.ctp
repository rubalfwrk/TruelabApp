<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
<!--                    <h3 class="box-title">Patient Reports</h3>-->
                </div>
                <div class="main-content">
                    <?php $x = $this->Session->flash(); ?>
                    <?php if ($x) { ?>
                    <div class="alert success">
                        <span class="icon"></span>
                        <strong></strong><?php echo $x; ?>
                    </div>
                    <?php }  
 ?>
<div class="container"><h2>Patient Reports</h2></div>

    <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>

        <th><?php echo 'Test name'; ?></th>
        <?php if($loggedUserRole=='admin') { ?>
        <th><?php echo 'Phlebotomists'; ?></th>
        <?php } ?>
        <th><?php echo 'Fasting'; ?></th>
        <th><?php echo 'Test Date'; ?></th>
        <th><?php echo 'Report Date'; ?></th>
        <th><?php echo 'Download'; ?></th>
        <th><?php echo 'Requisition Form'; ?></th>
    </tr>
    </thead>
    <tbody>
  <?php foreach($finalreport as $report){ ?>
    <tr>
        <td><?php echo $report['testname'] ?></td>
        <?php if($loggedUserRole=='admin') { ?>

        <td><?php echo $report['phlebotomistname'] ?></td>
        <?php } ?>
        <td><?php echo $report['fasting'] ?></td>
        <td><?php echo $report['testdate'] ?></td>
        <td><?php echo $report['reportdate'] ?></td>
        <?php if($report['reportfilestatus'] == 1) { ?>
        <td style="<?php echo $report['reportdownloadstatus']; ?>"><a href='<?php echo $report['report']; ?>'  download><i class="fa fa-download" id="reportdownload" data-id="<?php echo $report['id']; ?>" aria-hidden="true"></i></a></td>
        <?php }else{ ?>
        <td><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></td>
        <?php } ?>
       <?php if($report['paidreportfilestatus'] == 1) { ?>
        <td style="<?php echo $report['paidreportdownloadstatus']; ?>"><a href='<?php echo $report['paidreport']; ?>' download><i class="fa fa-download" id="paidreportdownload" data-id="<?php echo $report['id']; ?>" aria-hidden="true"></i></a></td>
        <?php }else{ ?>
        <td><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></td>
        <?php } ?>

       
   </tr> 
  <?php } ?>
    </tbody>
</table> 

</div>
</div>
</div>
	

    </div>
</section>
<style>
.checkbox input[type=checkbox] { margin-left: 0px !important;margin-top:2px;}
.checkbox label{color:#000 !important;}
input, textarea{color:#000 !important;}
</style>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
<script type="text/javascript">
$(document).delegate("#reportdownload", 'click', function(){
	var id = $(this).data("id");
	var data = {
		id:id
	}
	$.ajax({
		url:'<?php echo $this->webroot; ?>admin/patients/ajaxupdatereportstatus',
		method:'post',
		data:data,
		success:function(success){
			location.reload();
		}
		
	});
});

$(document).delegate("#paidreportdownload", 'click', function(){

	var id = $(this).data("id");
	var data = {id:id}
	$.ajax({
		url:'<?php echo $this->webroot; ?>admin/patients/ajaxupdatepaidreportstatus',
		method:'post',
		data:data,
		success:function(success){
		location.reload();
		}
		
	});
});

</script>