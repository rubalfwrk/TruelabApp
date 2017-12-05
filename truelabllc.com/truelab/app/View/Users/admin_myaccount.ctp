<section class="content">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box form_sec">
<div class="box-header with-border">
<h3 class="box-title">User</h3>
</div>
<div class="box-body">
<table class="table table-striped table-bordered table-condensed table-hover">
    <tr>
        <td>Id</td>
        <td><?php echo h($user['User']['id']); ?></td>
    </tr>
    <tr>
        <td>Role</td>
        <td><?php echo h($user['User']['role']); ?></td>
    </tr>
    <tr>
        <td>Username</td>
        <td><?php echo h($user['User']['username']); ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo h($user['User']['firstname']); ?></td>
    </tr>
    <tr>
        <td>E-mail</td>
        <td><?php echo h($user['User']['email']); ?></td>
    </tr>
    <tr>
        <td>Phonenumber</td>
        <td><?php echo h($user['User']['phonenumber']); ?></td>
    </tr>

    <tr>
        <td>Active</td>
        <td><?php echo h($user['User']['active']); ?></td>
    </tr>
    <tr>
        <td>Created</td>
        <td><?php echo h($user['User']['created']); ?></td>
    </tr>
    <tr>
    <?php if($user['User']['image'] != ''){ ?>
        <td>Image</td>
        <td><img src ="<?php echo '/truelab/files/profile_pic/' . $user['User']['image']; ?>"  style="width:100px; height:100px;"/></td>
    <?php }else{ ?>
    	<td><img src ="<?php echo '/truelab/files/profile_pic/noimagefound.jpg'; ?>"  /></td>
   <?php } ?>
    </tr>
</table>

	<div class="col-sm-12 padding">
		<div class="form_sec mg10">
			<h3>Actions</h3>
			<?php echo $this->Html->link('Change Password', array('action' => 'password/admin', $user['User']['id']), array('class' => 'btn btn-default btn-info')); ?> </li>
			<?php echo $this->Html->link('Edit', array('action' => 'myaccountedit', $user['User']['id']), array('class' => 'btn btn-default btn-danger')); ?> </li>
		</div>
	</div>







</div>
</div>
</div>
</section>

<style>

.table{width:100%;margin:15px 0 !important;  overflow-y: scroll; display: block;}
</style>