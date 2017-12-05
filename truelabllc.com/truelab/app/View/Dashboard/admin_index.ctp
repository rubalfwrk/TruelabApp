<style>
.easyPieChart {
    position: relative;
    text-align: center;
}

.easyPieChart canvas {
    position: absolute;
    top: 0;
    left: 0;
}
</style>
<!-- Content Header (Page header) -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      
    </section>


     <!-- Main content -->
    <section class="content">
       <!-- Info boxes -->
    <div class="row">
		
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user" aria-hidden="true"></i></span>
<!---->
            <div class="info-box-content">
              <span class="info-box-text">Total Phlebotomist</span>
              <span class="info-box-number"><?php  echo count($user); ?></span>
            </div>
           
          </div>
        
        </div>


        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user-md" aria-hidden="true"></i></span>
<!---->
            <div class="info-box-content">
                <span class="info-box-text">Total Doctors</span>
              <span class="info-box-number"><?php  echo count($client); ?></span>
              <!--<span class="info-box-text">Total Quantity - <strong><?php  echo $quantity ; ?></strong></span>-->
            </div>
           
          </div>
        
        </div>
        
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-user-plus" aria-hidden="true"></i></span>
<!---->
            <div class="info-box-content">
                <span class="info-box-text">Total Agencies</span>
              <span class="info-box-number"><?php  echo count($agencycount); ?></span>
              <!--<span class="info-box-text">Total Quantity - <strong><?php  echo $quantity ; ?></strong></span>-->
            </div>
           
          </div>
        
        </div>
        
        
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-dark-green"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Patients</span>
              <span class="info-box-number"><?php echo date('F'); ?> : <?php echo count($totalpatients); ?></span>
              <span class="info-box-number">Year : <?php echo count($totalpatientsyearly); ?></span>
            </div>
            
          </div>
          
        </div>


        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-flask" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Tests</span>
              <span class="info-box-number"><?php echo date('F'); ?> : <?php echo count($totaltest); ?></span>
              <span class="info-box-number">Year : <?php echo count($totaltestyearely); ?></span>
            </div>
            
          </div>
          
        </div>
        <!-- /.col -->
      </div>

      
<div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12">
          <div class="box dashscroll">

            <div class="box-header">
              <h3 class="box-title">Unschedule Task</h3>
            </div>
           
            <!-- box-header -->
            <div class="box-body table-responsive no-padding" style="overflow-y: scroll; height: 600px;">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Patient Name</th>
                  <th>Doctor Name</th>
                   <th>Agency Name</th>
                  <th>Status</th>
                </tr>
                <?php foreach($recents as $recent){ ?>
                <tr>
                  <td><?php echo $recent['Recent']['id']; ?></td>
                  <td><?php echo $this->Html->link($recent['Recent']['patientname'], array('controller' => 'patients', 'action' => 'view', $recent['Recent']['patientid'])); ?></td>
                  <td><?php echo $this->Html->link($recent['Recent']['doctorname'], array('controller' => 'users', 'action' => 'view', $recent['Recent']['doctorid'])); ?></td>
                  <td><?php echo $recent['Recent']['agencyname']; ?></td>
                  <td><?php echo $this->Html->link($this->Html->tag('span', $recent['Recent']['status'], array('class' => 'label label-warning')), array('controller' => 'patients', 'action' => 'test', $recent['Recent']['patientid']),array('escape' => false)); ?></td>
                </tr>
                <?php } ?>
                
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

 <div class="col-md-4 col-sm-4 col-xs-12">
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Schedule</span>
              <span class="info-box-number"><?php echo $count_schedule; ?></span>

            <!-- /.info-box-content -->
          </div>
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Accepted</span>
              <span class="info-box-number"><?php echo $count_accept; ?></span>

           
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Decline</span>
              <span class="info-box-number"><?php echo $count_decline; ?></span>

          
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-times"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Cancel</span>
              <span class="info-box-number"><?php echo $count_cancel; ?></span>

          
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->

          
          <!-- /.box -->
        </div>

      </div>


       
       
       <!------------------------------------------->
       
      
       
       <!-------------------------------------------->
     
      <div class="row">
      		
      	<div class="col-md-12">

      	<div id="piechart" style="width: 100%; height: 100px;"></div>
          

          </div>
          <!-- /.box -->
        </div>
      	

    </section>

     <style>
         .bg-green{background-color: #00a65a !important;}
		 .bg-dark-green{background-color: #00a670 !important;color:#fff;}
		 .dashscroll{height:500px; overflow:scroll;}
		 
     </style> 

<script src="https://rakesh.crystalbiltech.com/freedrink/dashboard/plugins/jquery.easy-pie-chart.js"></script>