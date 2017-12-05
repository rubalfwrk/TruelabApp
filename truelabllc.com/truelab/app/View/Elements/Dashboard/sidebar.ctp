<!-- Left side column. contains the logo and sidebar -->       
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
			<?php if($userimage){ ?>
                <img src="<?php echo $this->request->webroot ?>files/profile_pic/<?php echo $userimage ?>" class="img-circle" alt="User Image">
			<?php }else{?>
				 <img src="<?php echo $this->request->webroot ?>files/profile_pic/noimagefound.jpg<?php echo $userimage; ?>" class="img-circle" alt="User Image">
				
			<?php }?>
            </div>
            <div class="pull-left info">
                <p><br><?php echo $loggedusername; ?></p>
                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        
        <ul class="sidebar-menu">      
           
            <?php if($loggedUserRole=='admin'){ ?>
            <li class="treeview"><?php echo $this->Html->link('Dashboard', array('controller' => 'dashboard', 'action' => 'index', 'admin' => true), array('class' => 'fa fa-tachometer btn btn-lock orders_autorizemenu')); ?></li>
            <?php }else if($loggedUserRole=='client'){ ?>

            <li class="treeview"><?php echo $this->Html->link('Dashboard', array('controller' => 'dashboard', 'action' => 'clientdashindex', 'admin' => true), array('class' => 'orders_autorizemenu')); ?></li>
            <li class="active"><?php echo $this->Html->link('Doctors', array('controller' => 'users', 'action' => 'index', 'admin' => true), array('class' => 'users_autorizemenu')); ?></li>

            <?php }else{ ?>
                <li class="treeview"><?php echo $this->Html->link('Dashboard', array('controller' => 'dashboard', 'action' => 'phlebotomistdashindex', 'admin' => true), array('class' => 'orders_autorizemenu')); ?></li>
            <?php  } ?>

            <?php if($loggedUserRole=='admin'){ ?>  

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                     <li class="active"><?php echo $this->Html->link('Doctors', array('controller' => 'users', 'action' => 'index', 'admin' => true), array('class' => 'users_autorizemenu')); ?></li>
                     
                     <li><?php echo $this->Html->link('Agency Doctors', array('controller' => 'users', 'action' => 'indexagency', 'admin' => true), array('class' => 'users_autorizemenu')); ?></li>


                      <li><?php echo $this->Html->link('Phlebotomists', array('controller' => 'users', 'action' => 'phlebotomistindex', 'admin' => true), array('class' => 'users_autorizemenu')); ?></li>

                </ul>
            </li> 
            <?php } ?>


            <?php if($loggedUserRole=='admin' || $loggedUserRole=='client'){ ?> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Patients</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                 <li><?php echo $this->Html->link('Patients', array('controller' => 'patients', 'action' => 'admin_index', 'admin' => true), array('class' => '')); ?> </li>  
                 <li><?php echo $this->Html->link('Add Patient', array('controller' => 'patients', 'action' => 'addpatient', 'admin' => true), array('class' => '')); ?> </li>  

                </ul> 
            </li>  
            <?php } ?>

            <?php if($loggedUserRole=='admin'){ ?>  
           <li class="treeview">
                <a href="#">
                    <i class="fa fa-flask"></i> <span>Tests</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                <li><?php echo $this->Html->link('Test', array('controller' => 'patients', 'action' => 'admin_testindex', 'admin' => true), array('class' => '')); ?> </li>  
		        <li><?php echo $this->Html->link('Add Test', array('controller' => 'patients', 'action' => 'admin_addtest', 'admin' => true), array('class' => '')); ?> </li>  

                </ul> 
            </li>  
            <?php } ?> 
            <?php if($loggedUserRole=='user'){ ?>  
           <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Patient</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                <li><?php echo $this->Html->link('Unscheduled', array('controller' => 'patients', 'action' => 'admin_phlebotomistunscheduled', 'admin' => true), array('class' => '')); ?> </li>  
                <li><?php echo $this->Html->link('Scheduled', array('controller' => 'patients', 'action' => 'admin_phlebotomistscheduled', 'admin' => true), array('class' => '')); ?> </li>  
                <li><?php echo $this->Html->link('Cancelled', array('controller' => 'patients', 'action' => 'admin_phlebotomistcancel', 'admin' => true), array('class' => '')); ?> </li>  

                </ul> 
            </li>  
            <?php } ?>
            <?php
             if($loggedUserRole=='admin'){ ?>
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-plus"></i> <span>Agency</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                 
                <ul class="treeview-menu">
                 <li><?php echo $this->Html->link('Profile', array('controller' => 'agencies', 'action' => 'index', 'admin' => true), array('class' => '')); ?> </li>  
                 
            
		<li><?php echo $this->Html->link('Add Agency', array('controller' => 'agencies', 'action' => 'add', 'admin' => true), array('class' => '')); ?> </li>  

                </ul> 
 </li>
           <?php } ?>
       <?php
        if(($loggedUserRole=='client') && ($userlogagencyname != '')){ ?>
        <li class="treeview">
                <a href="#">
                    <i class="fa fa-flask"></i> <span>Agency</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                 
                <ul class="treeview-menu">
                 <li><?php echo $this->Html->link('Profile', array('controller' => 'agencies', 'action' => 'index', 'admin' => true), array('class' => '')); ?> </li>  
                 
            
		<!--<li><?php echo $this->Html->link('Add Agency', array('controller' => 'agencies', 'action' => 'add', 'admin' => true), array('class' => '')); ?> </li>-->  

                </ul> 
 </li>
       <?php } ?>   
 

<?php /*
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-object-group"></i> <span>Plans</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('All Plan', array('controller' => 'restaurants', 'action' => 'plans', 'admin' => true), array('class' => 'staticpages_autorizemenu')); ?></li>     
                   
                </ul>
            </li> 
			
			<li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i> <span>Plans History</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Plan History', array('controller' => 'restaurants', 'action' => 'planhist', 'admin' => true), array('class' => 'staticpages_autorizemenu')); ?></li>  

                      <li class="active"><?php echo $this->Html->link('Referral People', array('controller' => 'restaurants', 'action' => 'earned', 'admin' => true), array('class' => 'staticpages_autorizemenu')); ?></li>      
                   
                </ul>
            </li>
			
			<li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i> <span>Drink History</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Drink History', array('controller' => 'restaurants', 'action' => 'drinkhist', 'admin' => true), array('class' => 'staticpages_autorizemenu')); ?></li>     
                   
                </ul>
            </li>
            


            <?php if($loggedUserRole=='admin'){ ?>
                <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Page</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Static Page', array('controller' => 'staticpages', 'action' => 'index', 'admin' => true), array('class' => 'staticpages_autorizemenu')); ?></li>     
                   <!--  <li class="active"><?php echo $this->Html->link('Add Static Page', array('controller' => 'staticpages', 'action' => 'add', 'admin' => true), array('class' => 'staticpages_autorizemenu')); ?></li> -->
                </ul>
            </li> 

             <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>Setting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Change Background', array('controller' => 'staticpages', 'action' => 'background', 'admin' => true), array('class' => 'staticpages_autorizemenu')); ?></li>     
                 
                </ul>
            </li> 
            
            <?php } ?>


            <!--  <li class="treeview">
                <a href="#">
                    <i class="fa fa-object-group"></i> <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Dish Categories', array('controller' => 'dish_categories', 'action' => 'index', 'admin' => true), array('class' => 'dish_categories_autorizemenu')); ?></li>     
                    <li class="active"><?php echo $this->Html->link('Add Category', array('controller' => 'dish_categories', 'action' => 'add', 'admin' => true), array('class' => 'dish_categories_autorizemenu')); ?></li>
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-object-group"></i> <span>Sub Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"> <?php echo $this->Html->link('Dish Sub Categories', array('controller' => 'dish_subcats', 'action' => 'index', 'admin' => true), array('class' => 'dish_subcats_autorizemenu')); ?></li>     
                    <li class="active"> <?php echo $this->Html->link('Add Sub Category', array('controller' => 'dish_subcats', 'action' => 'add', 'admin' => true), array('class' => 'dish_subcats_autorizemenu')); ?></li>
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-sun-o"></i> <span>Associated Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Dish Associate Categories', array('controller' => 'dish_categories', 'action' => 'assoindex', 'admin' => true), array('class' => 'dish_categories_autorizemenu')); ?></li>     
                    <li class="active"><?php echo $this->Html->link('Add Associate Category', array('controller' => 'dish_categories', 'action' => 'assoadd', 'admin' => true), array('class' => 'dish_categories_autorizemenu')); ?></li>
                </ul>
            </li> 
 <li class="treeview">
                <a href="#">
                    <i class="fa fa-sun-o"></i> <span>Associated SubCategory</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                  <li class="active"> <?php echo $this->Html->link('Associated SubCategories', array('controller' => 'dish_subcats', 'action' => 'assoindex', 'admin' => true), array('class' => 'dish_subcats_autorizemenu')); ?> </li>   
                  <li class="active"> <?php echo $this->Html->link('Add Associated Category', array('controller' => 'dish_subcats', 'action' => 'assoadd', 'admin' => true), array('class' => 'dish_subcats_autorizemenu')); ?> </li>
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-inbox"></i> <span>Order</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Orders', array('controller' => 'orders', 'action' => 'index', 'admin' => true), array('class' => 'orders_autorizemenu')); ?></li>  
                    
                    <li class="active"><?php echo $this->Html->link('Table Reservation Orders', array('controller' => 'orders', 'action' => 'tableindex', 'admin' => true), array('class' => 'orders_autorizemenu')); ?></li>      
                </ul>
            </li>  
                  <li class="treeview">
                <a href="#">
                    <i class="fa fa-exclamation-circle"></i> <span>Store Timing</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Store Timing', array('controller' => 'times', 'action' => 'index', 'admin' => true), array('class' => 'times_autorizemenu')); ?></li>     
                    <li class="active"><?php echo $this->Html->link('Add Store Timing', array('controller' => 'times', 'action' => 'add', 'admin' => true), array('class' => 'times_autorizemenu')); ?></li>
                </ul>
            </li> 
            
           
<li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Review</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Review', array('controller' => 'reviews', 'action' => 'index', 'admin' => true), array('class' => 'times_autorizemenu')); ?></li> 
                       
                </ul>
                 
                
                
            </li> 
            <?php if($loggedUserRole=='admin'){ ?>
            
<li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Social</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Social Links', array('controller' => 'socials', 'action' => 'index', 'admin' => true), array('class' => 'socials_autorizemenu')); ?></li>
 <li class="active"><?php echo $this->Html->link('Add Social Links', array('controller' => 'socials', 'action' => 'add', 'admin' => true), array('class' => 'socials_autorizemenu')); ?></li>     
                </ul>
            </li> 
<li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Ads Image</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Ads Image', array('controller' => 'ads', 'action' => 'index', 'admin' => true), array('class' => 'socials_autorizemenu')); ?></li>
 <li class="active"><?php echo $this->Html->link('Add Ads Image', array('controller' => 'ads', 'action' => 'add', 'admin' => true), array('class' => 'socials_autorizemenu')); ?></li>     
                </ul>
            </li>
            
 
<li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Surcharge</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Surcharge', array('controller' => 'taxes', 'action' => 'editsurcharge', 'admin' => true), array('class' => 'socials_autorizemenu')); ?></li>
    
                </ul>
            </li>
            
 
<li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Refund Money</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><?php echo $this->Html->link('Refund Money', array('controller' => 'users', 'action' => 'refundmoney', 'admin' => true), array('class' => 'socials_autorizemenu')); ?></li>
    
                </ul>                                      
            </li>  
            
              <?php }?>  
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Cancel time</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a> 
                <ul class="treeview-menu">
                <?php if($loggedUserRole=='admin'){ ?>
                    <li class="active"><?php echo $this->Html->link('Cancel time', array('controller' => 'restaurants', 'action' => 'canceltime', 'admin' => true), array('class' => 'socials_autorizemenu')); ?></li>
                    <?php }
					 if($loggedUserRole=='rest_admin'){?>
                    <li class="active"><?php echo $this->Html->link('Cancel time', array('controller' => 'restaurants', 'action' => 'canceltimebyrest', 'admin' => true), array('class' => 'socials_autorizemenu')); ?></li>
     <?php }?>
                </ul>                                      
            </li> -->
          
  
        </ul>
		*/ ?>
    </section>
    <!-- /.sidebar -->
</aside>
<style>
.navbar .sidebar-toggle {display:none;}
</style>