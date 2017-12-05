<!-- Content Header (Page header) -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>
<script src="<?php echo $this->webroot; ?>datepicker/jquery.simple-dtpicker.js"></script> 
<link href="<?php echo $this->webroot; ?>datepicker/jquery.simple-dtpicker.css" rel="stylesheet"> 

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
                    <h3 class="box-title">Patients</h3>
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

    <table style="font-size:12px;" id="example" class="table table-bordered table-hover examplees" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th><?php echo $this->Paginator->sort('id');?></th>
        <th><?php echo $this->Paginator->sort('name');?></th>
        <th><?php echo $this->Paginator->sort('trackingid');?></th>
        <th><?php echo $this->Paginator->sort('address');?></th>
        <th><?php echo $this->Paginator->sort('D O B');?></th>
        <th><?php echo $this->Paginator->sort('doctor name');?></th>
        <th><?php echo $this->Paginator->sort('agency name');?></th>
        <th><?php echo $this->Paginator->sort('test');?></th>
        <th><?php echo $this->Paginator->sort('request date');?></th>
        <th class="actions">Actions</th>
    </tr>
    </thead>
    <tbody>
<?php $i = 1; 
    foreach ($patients_lists as $patients_list): ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo h($patients_list['Patient']['firstname']); ?></td>
        <td><?php echo h($patients_list['Patient']['trackingid']); ?></td>
        <td><?php echo h($patients_list['Patient']['address']); ?></td>
        <td><?php echo h($patients_list['Patient']['dob']); ?></td>
        <td><?php echo h($patients_list['Patient']['doctorname']); ?></td>
        <td><?php echo h($patients_list['User']['agencyname']); ?></td>
        <td><?php echo h($patients_list['Test']['test']); ?></td>
        <td><?php echo h($patients_list['PatientTest']['request_date']); ?></td>
        <td class="actions">
            <?php echo $this->Html->link('', array('action' => 'view', $patients_list['Patient']['id']), array('class' => 'fa fa-eye btn btn-warning view1', 'title' => 'View')); ?>

            <?php echo $this->Html->link('', array('action' => 'accept', $patients_list['PatientTest']['id']), array('class' => 'fa fa-check btn btn-primary view1', 'title' => 'Accept','name' => 'accept', 'id' => 'date', 'data-toggle' =>'modal', 'data-target' => "#myModal$i")); ?>

            <?php echo $this->Html->link('', array('action' => 'decline', $patients_list['PatientTest']['id']), array('class' => 'fa fa-times btn btn-success view1', 'title' => 'Decline','name' => 'decline', 'id' => 'reason', 'data-toggle' =>'modal', 'data-target' => "#myModalreason$i")); ?>
            
        </td>
    </tr>

    <!-- Modal -->

<div id="myModal<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Accept Test</h4>
      </div>
      <div class="modal-body" style="width:100%;">
        <div class="form-group">
            <form action="" method="post">
                    <input type='hidden' class="form-control" name="postid" value="<?php echo $patients_list['PatientTest']['id'];?>"/>
                <div class='input-group date' id="datetimepicker<?php echo $i; ?>">
                    <input type='text' class="form-control date_fooo" id="date_foo" placeholder="Please Select Date" name="dateselect" required/>
                   
                </div>
                <input type="submit" name="submit" value="Submit">
            </form>
            </div>
      </div>
    
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>


<!--decline-->

<div id="myModalreason<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Decline Test</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <form action="" method="post">
                <input type='hidden' class="form-control" name="postid" value="<?php echo $patients_list['PatientTest']['id'];?>"/>
                <div class='input-group date'>
                    <textarea name="reason" rows="6" cols="80" required></textarea>
                </div>
                <input type="submit" name="submit" value="Submit">
            </form>
            </div>
      </div>
    
      <div class="modal-footer">
<!--       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>
<!--end-->
<script>
$('.date_fooo').appendDtpicker({
    "autodateOnStart": false
});
</script>


    <?php $i++;
    endforeach; ?>
    </tbody>
</table>
</div>
</div>
</div></div>
</section>
<!-- Date Picker Here -->
<!-- Trigger the modal with a button -->

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#examplees').DataTable();
    } );

</script>