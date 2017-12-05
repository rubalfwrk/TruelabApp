<!-- Content Header (Page header) -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="http://truelabllc.com/truelab/css/bootstrap-datetimepicker.css" />
<script type="text/javascript" src="http://truelabllc.com/truelab/js/bootstrap-datetimepicker.min.js"></script>



<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
                    <h3 class="box-title">Cancel Tests</h3>
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

    <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th><?php echo $this->Paginator->sort('id');?></th>
        <th><?php echo $this->Paginator->sort('name');?></th>
        <th><?php echo $this->Paginator->sort('trackingid');?></th>
        <th><?php echo $this->Paginator->sort('address');?></th>
        <th><?php echo $this->Paginator->sort('D O B');?></th>
        <th><?php echo $this->Paginator->sort('doctor name');?></th>
        <th><?php echo $this->Paginator->sort('agency name');?></th>
        <th><?php echo $this->Paginator->sort('reason');?></th>
        <th><?php echo $this->Paginator->sort('test');?></th>
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
        <td><?php echo h($patients_list['StatusCancel']['admin_reason']); ?></td>
        <td><?php echo h($patients_list['Test']['test']); ?></td>
        <td class="actions">
            <?php echo $this->Html->link('', array('action' => 'view', $patients_list['Patient']['id']), array('class' => 'fa fa-eye btn btn-warning view1', 'title' => 'View')); ?>
            
        </td>
    </tr>


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
        $('#example').DataTable();
    } );
</script>