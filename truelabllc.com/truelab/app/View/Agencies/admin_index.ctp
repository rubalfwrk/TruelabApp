<!-- Content Header (Page header) -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
                    <h3 class="box-title">Profile</h3>
                </div>
                <div class="main-content">
                    <?php $x = $this->Session->flash(); ?>
                    <?php if ($x) { ?>
                    <div class="alert success">
                        <span class="icon"></span>
                        <strong></strong><?php echo $x; ?>
                    </div>
                    <?php }  ?>

    <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th><?php echo $this->Paginator->sort('id');?></th>
        <th><?php echo $this->Paginator->sort('agency Name');?></th>
         <th><?php echo $this->Paginator->sort('agency Email');?></th>
          <th><?php echo $this->Paginator->sort('agency Phone Number');?></th>
        <th class="actions">Actions</th>
    </tr>
    </thead>
    <tbody>
<?php $i = 1; 

    foreach ($agencies as $agency): ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo h($agency['Agency']['agencyname']); ?></td>
        <td><?php echo h($agency['Agency']['agencyemail']); ?></td>
        <td><?php echo h($agency['Agency']['agencyphonenumber']); ?></td>
        <td class="actions">
            <?php echo $this->Html->link('', array('action' => 'view', $agency['Agency']['id']), array('class' => 'fa fa-eye btn btn-warning view1', 'title' => 'View')); ?>

            <?php echo $this->Html->link('', array('action' => 'edit', $agency['Agency']['id']), array('class' => 'btn btn-info fa fa-pencil', 'title' => 'Edit')); ?>
            <?php echo $this->Html->link('', array('action' => 'agencypassword', $agency['Agency']['id']), array('class' => 'btn btn-success fa fa-lock', 'title' => 'Change Password')); ?>
            
		<?php echo $this->Html->link('', array('action' => 'addagencymember', $agency['Agency']['id']), array('class' => 'btn btn-primary fa fa-plus', 'title' => 'Add Doctor')); ?>
<?php /* if($userlogagencyname != '') { ?>
            <?php echo $this->Form->postLink('', array('action' => 'delete', $agency['Agency']['id']), array('class' => 'btn btn-danger fa fa-trash', 'title' => 'Delete Agency'), __('Are you sure you want to delete # %s?', $agency['Agency']['id'])); ?>
<?php } */ ?>

<?php if($loggedUserRole == 'admin') { ?>
            <?php echo $this->Form->postLink('', array('action' => 'delete', $agency['Agency']['id']), array('class' => 'btn btn-danger fa fa-trash', 'title' => 'Delete Agency'), __('Are you sure you want to delete # %s?', $agency['Agency']['id'])); ?>
             <?php 
           if($agency['Agency']['active'] == '0'){
            
            echo $this->Html->link('Activate', array('action' => 'activateuser', $agency['Agency']['id']), array('class' => 'btn btn-primary ', 'title' => 'Activate', 'name' => 'Activate')); 
            }else{ 
                
                echo $this->Html->link('Deactivate', array('action' => 'deactivateuser', $agency['Agency']['id']), array('class' => 'btn btn-primary', 'title' => 'Deactivate', 'value' => 'Deactivate'));
            }
             ?>
<?php } ?>
           
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



<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>