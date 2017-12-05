<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>-->
<!-- Content Header (Page header) -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>
 <link rel="stylesheet" href="<?php echo $this->webroot; ?>signature_pad-master/css/signature-pad.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
                    <h3 style="margin:0px !important;" class="box-title">Patients Signature</h3>
<!-- <div class="container"><h2>Patients Tests Status</h2></div> -->
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

<div id="exTab2">   
    <ul class="nav nav-tabs">
        <li class="active">
            <a  href="#1" data-toggle="tab">Patient Signature</a>
        </li>
        <li>
         <a href="#2" data-toggle="tab">Upload Patient Signature Image</a><div class="right_number"></div>
        </li>
        
        </ul>
            <div class="tab-content ">
                <div class="tab-pane active" id="1">
    <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <form action="" method="post">
        <input type="hidden" id="loadimg" name="clientsignature">
            <div id="signature-pad" class="m-signature-pad">
                <div class="m-signature-pad--body">
                    <canvas></canvas>
                </div>
            <div class="m-signature-pad--footer" style="width: 100%; float: left;  background: #f7f7f7;
position: absolute;  left: 0;  top: 66%;  display: block;  height: 103px !important;">
            <div class="description">Client Signature</div>
                <div class="left" style="width: 50%; float: left;">
                    <button type="button" class="button clear mybtnclr" data-action="clear">Clear</button>
                </div>
                <div class="right" style="width: 50%; float: right;">
                    <button type="button" class="button save mybtnsve" data-action="save-png">Save as PNG</button>
                </div>
            </div>
        </div>
        </br>
        <input type="submit" value="Submit" name="submit">
    </form>
</table> 
</div>
<div class="tab-pane" id="2">
    <table style="font-size:12px;" id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <form action="" method="post" enctype="multipart/form-data">
    Upload the signature:
    <input type="file" name="signature" id="signature">
    <input type="submit" value="Upload Image" name="submit">
</form>
</table> 
 </div>


                            
                    
                            
</div>
</div>

<hr></hr>


</div>
</div>
</div></div>
</section>
<style>
.checkbox input[type=checkbox] { margin-left: 0px !important;margin-top:2px;}
.checkbox label{color:#000 !important;}
input, textarea{color:#000 !important;}
table tr td {color:#000;}
</style>

<style>
#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab2 .nav-pills > li > a {
  border-radius: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab2 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab2 .tab-content {
  color : white;
  padding :10px 0;
}
.table{
margin-bottom:0px !important;
}
.select label {
    color: #000;
    float: left;
    margin-right: 10px;
    margin-bottom: 0;
    width: auto;
    
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
#flashMessage{
  width: 305px;
}

td.actions a.btn {
    padding: 7px 13px;
    font-size: 16px;
    margin-bottom: 3px;
}
td a{
    margin-bottom:5px !important;
}
</style>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-39365077-1']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>
  <script src="<?php echo $this->webroot; ?>signature_pad-master/js/signature_pad.js"></script>
  <script src="<?php echo $this->webroot; ?>signature_pad-master/js/app.js"></script>
<script>
$(".save").click(function(){
    var loadimg = $("#loadimg").val();
    var fields = loadimg.split('base64,');
    var data = fields[0];
    var name = fields[1];
    $("#loadimg").val(name);
});
</script>