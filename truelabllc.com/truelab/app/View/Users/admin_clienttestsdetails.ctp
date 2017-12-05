<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
                    <!--<h3 class="box-title">Client Details</h3>-->
                     <h3 class="box-title">Test Status</h3>
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


<!--<div id="exTab2">	
    <ul class="nav nav-tabs">
	<li class="active">
            <a  href="#1" data-toggle="tab">Patients</a>    
	</li>
    </ul>
    <div class="tab-content ">
        <div class="tab-pane active" id="1">-->
            <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><?php echo 'Id'; ?></th>
                        <th><?php echo 'Patient name'; ?></th>
                        <th><?php echo 'Trackingid'; ?></th>
                        <th><?php echo 'Doctor name'; ?></th>
                        <th><?php echo 'Test name'; ?></th>
                        <th><?php echo 'Status'; ?></th> 
                        <th><?php echo 'Date'; ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php  
                foreach ($patients as $patient): 
                ?>	 	
                    <tr>
                        <td><?php echo $patient['details']['id']; ?></td>
                        <td><?php echo $patient['details']['patientname']; ?></td>
                        <td><?php echo $patient['details']['trackingid']; ?></td>
                        <td><?php echo $patient['details']['doctorname']; ?></td>
                        <td><?php echo $patient['details']['testname']; ?></td>
                        <td><?php echo $patient['details']['finalstatus']; ?></td>
                        <td><?php echo $patient['details']['date_staus']; ?></td>
                    </tr> 
                <?php
                endforeach; ?>
                </tbody>
            </table> 
<!--    </div>
    </div>
</div>-->



</div>
</div>
</div></div>
</section>
<style>
.checkbox input[type=checkbox] { margin-left: 0px !important;margin-top:2px;}
.checkbox label{color:#000 !important;}
input, textarea{color:#000 !important;}
</style>

<style>/*
    #exTab2 table tr td {
        color:#000;        
    }
#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

/

#exTab2 .nav-pills > li > a {
  border-radius: 0;
}



#exTab2 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab2 .tab-content {
  color : white;
  padding :10px 0;
}*/
.table{
margin-bottom:0px !important;
}
.select label {
    color: #000;
    float: left;
    margin-right: 10px;
    margin-bottom: 0;
    width: auto;
    margin: 10px 15px 10px 0;
}

.form-control {
    width: 60%;
    margin: 0;
}

.right_number {
    width: auto;
    float: left;
    position: absolute;
    right: -3px;
    top: 11px;
    background-color: green;
    border-radius: 50px;
    padding: 0px 6px;
    color: #fff;
}


</style>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>