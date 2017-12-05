<!--<h2 style="margin-left: 15px;">User</h2>


  <strong><?php //echo $this->Session->flash(); ?></strong>-->

<section class="content">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
<div class="box form_sec">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">User Details</h3>
            </div>
<table style="background: #fff;width: 97%;margin: 0 auto; overflow-y: scroll; display: block;" class="table table-bordered table-hover dataTable">
    <tr>
        <td>Id</td>
        <td><?php echo h($user['User']['id']); ?></td>
    </tr>
    <tr>
        <td>Role</td>
        <td><?php echo h($user['User']['role']); ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo h($user['User']['firstname'] .' ' . $user['User']['lastname']); ?></td>
    </tr>
    <tr>
        <td>Active</td>
        <td><?php echo h($user['User']['active']); ?></td>
    </tr>
    
        <td>Address</td>
        <td><?php echo h($user['User']['address']); ?></td>
    </tr>
     </tr>
    
        <td>Address2</td>
        <td><?php echo h($user['User']['address2']); ?></td>
    </tr>
    </tr>
    
        <td>City</td>
        <td><?php echo h($user['User']['city']); ?></td>
    </tr>
    </tr>
    
        <td>State</td>
        <td><?php echo h($user['User']['state']); ?></td>
    </tr>
   </tr>
    
        <td>Zip Code</td>
        <td><?php echo h($user['User']['zipcode']); ?></td>
    </tr>
    <tr>
        <td>Phone Number</td>
        <td><?php echo h($user['User']['phonenumber']); ?></td>
    </tr>    
    <tr>
        <td>Email</td>
        <td><?php echo h($user['User']['email']); ?></td>
    </tr>    
    <tr>
        <td>Date Hired</td>
        <td><?php echo h($user['User']['phlebotomistadddate']); ?></td>
    </tr>
<!--    <tr>
        <td>Modified</td>
        <td><?php echo h($user['User']['modified']); ?></td>
    </tr>
--></table>
<br/>
<br/>

<div class="col-sm-12 padding">
    <div class="box form_sec">
<h3>Actions</h3>

<?php  echo $this->Html->link('Phlebotomist List', array('action' => 'phlebotomistindex', $user['User']['id']), array('class' => 'btn btn-success'));  ?> 


<?php //echo $this->Form->postLink('Reset Password ', array('action' => 'resetbyadmin', $user['User']['id'],$user['User']['email']), array('class' => 'btn btn-info')); ?>

<?php echo $this->Form->postLink('Delete User', array('action' => 'phlebotomistdelete', $user['User']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>

</div>
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