<section class="content">
      <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12“>
          <div class="box form_sec">
            <div class="box-header">
              <h3 class="box-title">User Details</h3>
            </div>
            <div class="main-content">
                <table style="background: #fff;width: 100%;margin: 0 auto; overflow-y: scroll; display: block;" class="table table-bordered table-hover dataTable">
                    <tbody>                    
                        <tr>
                            <th>Id</th>
                            <td><?php echo h($user['User']['id']); ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><?php echo h($user['User']['role']); ?></td>
                        </tr>
                        
                        <tr>
                            <th>Doctor Name</th>
                            <td><?php echo h($user['User']['firstname']); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo h($user['User']['email']); ?></td>
                        </tr>

                        <tr>
                            <th>Doctor Phone</th>
                            <td><?php echo h($user['User']['phonenumber']); ?></td>
                        </tr>
                        <tr>
                            <th>Doctor fax</th>
                            <td><?php echo h($user['User']['fax']); ?></td>
                        </tr>
                       <tr>
                            <th>Doctor Npi Number</th>
                            <td><?php echo h($user['User']['npi']); ?></td>
                        </tr>

                   <?php if($user['User']['agencyname']){ ?>
					     <tr>
                            <th>Agency Name</th>
                            <td><?php echo h($user['User']['agencyname']); ?></td>
                        </tr>
                        <tr>
                            <th>Agency Fax</th>
                            <td><?php echo h($user['User']['agencyfax']); ?></td>
                        </tr>    
                        <tr>
                            <th>Agency Phone</th>
                            <td><?php echo h($user['User']['agencyphonenumber']); ?></td>
                        </tr> 
                        <?php } ?>   
  
                        <tr>
                            <th>Address1</th>
                            <td><?php echo h($user['User']['address']); ?></td>
                        </tr>
                        <tr>
                            <th>Address2</th>
                            <td><?php echo h($user['User']['address2']); ?></td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td><?php echo h($user['User']['city']); ?></td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td><?php echo h($user['User']['state']); ?></td>
                        </tr>
                        <tr>
                            <th>Zip Code</th>
                            <td><?php echo h($user['User']['zipcode']); ?></td>
                        </tr>
                        <tr>
                            <th>Created</th>
                            <td><?php echo h($user['User']['created']); ?></td>
                        </tr>
                        <tr>
                            <th>Modified</th>
                            <td><?php echo h($user['User']['modified']); ?></td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="col-sm-12 padding">
    <div class="box form_sec">
<h3>Actions</h3>

<?php  echo $this->Html->link('Client List', array('action' => 'index'), array('class' => 'btn btn-success', 'title' => 'Clients List')); ?> 



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