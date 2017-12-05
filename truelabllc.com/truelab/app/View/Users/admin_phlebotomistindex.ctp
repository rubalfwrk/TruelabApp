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
                    <h3 class="box-title">Phlebotomists</h3>
                </div>
                <div class="main-content">
<div class="top-btn">
                       <?php echo $this->Html->link('Add Phlebotomist', array('action' => 'addphlebotomist'), array('class' => 'btn btn-info pull-right fa fa-plus')); ?>
                   </div>

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
        <th><?php echo $this->Paginator->sort('email');?></th>
         <th><?php echo $this->Paginator->sort('address');?></th>
          <th><?php echo $this->Paginator->sort('phone');?></th>
        <!--<th><?php //echo $this->Paginator->sort('Member Status');?></th>-->
       
        <th class="actions">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1;
    foreach ($phlebotomists as $user): ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo h($user['User']['firstname'] . ' ' . $user['User']['lastname']); ?></td>
        <td><?php echo h($user['User']['email']); ?></td>
        <td><?php echo h($user['User']['address']); ?></td>
        <td><?php echo h($user['User']['phonenumber']); ?></td>
       
        
        <td class="actions">
            <?php echo $this->Html->link('', array('action' => 'phlebotomistview', $user['User']['id']), array('class' => 'fa fa-eye btn btn-warning view1', 'title' => 'View')); ?>

            <?php echo $this->Html->link('', array('action' => 'phlebotomistedit', $user['User']['id']), array('class' => 'btn btn-primary fa fa-pencil', 'title' => 'Edit')); ?>

            <?php echo $this->Html->link('', array('action' => 'password','phlebotomist', $user['User']['id']), array('class' => 'btn btn-success fa fa-lock', 'title' => 'Change Password')); ?>

            <?php echo $this->Form->postLink('', array('action' => 'phlebotomistdelete', $user['User']['id']), array('class' => 'btn btn-danger fa fa-trash', 'title' => 'Delete User'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>

           <?php echo $this->Html->link('', array('action' => 'phlebotomisttestdetails', $user['User']['id']), array('class' => 'fa fa-eye btn btn-success view1', 'title' => 'View Patient Statics')); ?>
           <?php echo $this->Html->link('', array('action' => 'payroll', $user['User']['id']), array('class' => 'fa fa-money btn btn-success view1', 'title' => 'Payroll')); ?>
           <?php 
           if($user['User']['active'] == '0'){
            echo $this->Html->link('Activate', array('action' => 'activatephlebotomistuser', $user['User']['id']), array('class' => 'btn btn-primary ', 'title' => 'Activate', 'name' => 'Activate')); 
            }else{ echo $this->Html->link('Deactivate', array('action' => 'deactivatephlebotomistuser', $user['User']['id']), array('class' => 'btn btn-primary', 'title' => 'Deactivate', 'value' => 'Deactivate'));
            }
             ?>

           
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