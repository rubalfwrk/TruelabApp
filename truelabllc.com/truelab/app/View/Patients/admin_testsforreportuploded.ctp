<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
                  <h3 class="box-title">Success Tests Report</h3>
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
<!--div class="container"><h2>Success Tests Report</h2></div-->

    <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>

        <th><?php echo 'Test name'; ?></th>
        <th><?php echo 'Phlebotomists'; ?></th>
        <th><?php echo 'Doctor'; ?></th>
        <th><?php echo 'Fasting'; ?></th>
        <th><?php echo 'Action'; ?></th>
    </tr>
    </thead>
    <tbody>
  <?php foreach($finalalltest as $finaltest){ ?>
    <tr>
        <td><?php echo $finaltest['testname'] ?></td>
        <td><?php echo $finaltest['phlebotomistname'] ?></td>
         <td><?php echo $finaltest['doctorname'] ?></td>
        <td><?php echo $finaltest['fasting'] ?></td>
        <?php if($finaltest['alreadytestreport'] == '') { ?>
        <!--<td><a href='<?php echo $report['report']; ?>' download>Download Report</a></td>-->
        <td><?php echo $this->Html->link('', array('action' => 'reportadminupload', $finaltest['testid'], $finaltest['id'], $finaltest['patientid']), array('class' => 'fa fa-upload btn btn-primary', 'title' => 'Upload Patient Reports')); ?></td>
        <?php }else{ ?>
        <td><?php echo $finaltest['alreadytestreport']; ?></td>
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