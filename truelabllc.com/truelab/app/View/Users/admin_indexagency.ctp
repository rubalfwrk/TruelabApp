<!-- Content Header (Page header) -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<!--  <section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>

</section> -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
                    <h3 class="box-title">Agencies Members</h3>
                </div>
                <div class="main-content">
                  <!-- <div class="top-btn">
                        <?php echo $this->Html->link('Add Agencies', array('action' => 'addagency'), array('class' => 'fa fa-plus btn btn-info pull-right')); ?>
                   </div>-->

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

       <th><?php echo $this->Paginator->sort('ID'); ?></th>
        <th><?php echo $this->Paginator->sort('doctor name');?></th>
        <th><?php echo $this->Paginator->sort('agency name');?></th>
        <th><?php echo $this->Paginator->sort('email');?></th>
        <!--<th><?php //echo $this->Paginator->sort('Member Status');?></th>-->
        <th><?php echo $this->Paginator->sort('agency phone ');?></th>
        <th class="actions">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php    $i = 1;
     foreach ($agencyusers as $user): ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo h($user['User']['firstname'] . ' ' . $user['User']['lastname']); ?></td>
        <td><?php echo h($user['User']['agencyname']); ?></td>
        <td><?php echo h($user['User']['email']); ?></td>
         <td><?php echo h($user['User']['agencyphonenumber']); ?></td>
        <td class="actions">
            <?php echo $this->Html->link('', array('action' => 'viewagencybydoctor', $user['User']['id']), array('class' => 'fa fa-eye btn btn-warning view1', 'title' => 'View')); ?>

            <?php echo $this->Html->link('', array('action' => 'editagencybydoctor', $user['User']['id']), array('class' => 'btn btn-primary fa fa-pencil', 'title' => 'Edit')); ?>

            <?php //echo $this->Html->link('', array('action' => 'password', 'agency', $user['User']['id']), array('class' => 'btn btn-success fa fa-lock', 'title' => 'Change Password')); ?>

            <?php echo $this->Form->postLink('', array('action' => 'delete', 'agency',$user['User']['id']), array('class' => 'btn btn-danger fa fa-trash', 'title' => 'Delete User'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>

           <?php echo $this->Html->link('', array('action' => 'clienttestsdetails', $user['User']['id']), array('class' => 'btn btn-info fa fa-info', 'title' => 'Test Details')); ?>

           <?php echo $this->Html->link('', array('action' => 'patientlist', $user['User']['id']), array('class' => 'btn btn-success fa fa-street-view', 'title' => 'View Patients')); ?>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
</div>
</div></div>
</section>



<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>