
<section class="content">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
                    <h3 class="box-title"><?php echo h($agency['Agency']['agencyname']); ?></h3>

  <strong><?php echo $this->Session->flash(); ?></strong>
                </div>


<table style="background: #fff;width: 97%;margin: 0 auto; overflow-y: scroll; display: block;" class="table-striped table-bordered table-condensed table-hover table">
    <tr>
        <th>Id</th>
        <td><?php echo h($agency['Agency']['id']); ?></td>
    </tr>
    <tr>
        <th>Agency Name</th>
        <td><?php echo h($agency['Agency']['agencyname']); ?></td>
    </tr>
    <tr>
        <th>Agency Email</th>
        <td><?php echo h($agency['Agency']['agencyemail']); ?></td>
    </tr>
    <tr>
        <th>Agency Phone</th>
        <td><?php echo h($agency['Agency']['agencyphonenumber']); ?></td>
    </tr>    

    <tr>
        <th>Agency Fax</th>
        <td><?php echo h($agency['Agency']['agencyfax']); ?></td>
    </tr>    
    <tr>
        <th>Address</th>
        <td><?php echo h($agency['Agency']['address']); ?></td>
    </tr>    
    <tr>
        <th>Address2</th>
        <td><?php echo h($agency['Agency']['address2']); ?></td>
    </tr>   
    <tr>
    	<th>City</th>
    	<td><?php echo h($agency['Agency']['city']); ?></td>
	</tr>    
    <tr>
        <th>State</th>
        <td><?php echo h($agency['Agency']['state']); ?></td>
    </tr>    
    <tr>
        <th>Zipcode</th>
        <td><?php echo h($agency['Agency']['zipcode']); ?></td>
    </tr>    
</table>

<div class="col-sm-12 padding">
<div class="form_sec mg10">
<h3>Actions</h3>
<?php echo $this->Html->link('View Agencies', array('action' => 'index', ), array('class' => 'btn btn-warning view1')); ?>
<?php echo $this->Form->postLink('Delete Agency', array('action' => 'delete', $agency['Agency']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $agency['Agency']['id'])); ?>

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