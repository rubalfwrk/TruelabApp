<?php  if(isset($mytitle)){ ?>
<script src="<?php echo $this->webroot; ?>datepicker/jquery.simple-dtpicker.js"></script> 
<link href="<?php echo $this->webroot; ?>datepicker/jquery.simple-dtpicker.css" rel="stylesheet"> 
<?php }?>
<!-- <script src="<?php// echo $this->webroot; ?>datepicker/datepicker/js/jquery.datepick.js"></script>-->
<style type="text/css">
    footer{ font-size:14px;position:static;right:5px;bottom:5px; }
    a:link, a:visited  { color: #0000ee; }
    pre{ background-color: #eeeeee; margin-left: 1%; margin-right: 2%; padding: 2% 2% 2% 5%; }
    p { font-size: 0.9rem; }
    ul { font-size: 0.9rem; }
/*                .table{overflow-x: scroll;display: block;}*/
    hr { border: 2px solid #eeeeee; margin: 2% 0% 2% -3%; }
    h3 { border-bottom: 2px solid #eeeeee; margin: 2rem 0 2rem -1%; padding-left: 1%; padding-bottom: 0.1em; }
    h4 { border-bottom: 1px solid #eeeeee; margin-top: 2rem; margin-left: -1%; padding-left: 1%; padding-bottom: 0.1em; }
	strong a {
    color: #3c8dbc !important;
}

  </style>

<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box form_sec">
<?php echo $this->Form->create('PatientTest'); ?>
              <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Test</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tbody>
                
                <tr>
                  <th>Test</th>
                  <th>Order</th>
                  <th>Fasting</th>
                  <th>Diagnosis</th>
                  <th>Request Date</th>
                </tr>
                
               <?php foreach($alltest as $test){ ?>
                <tr class="options_list">
                  <td><?php echo $test['Test']['test']?></td>
                  <td>
                      <input type="checkbox" name="testid[]" value="<?php echo $test['Test']['id']?>" id="testids">
                  </td>
                  <td><input type="checkbox" name="fasting[]" value="<?php echo $test['Test']['id']?>"></td>
                  <td><input type="text" name="testdiagnosis[<?php echo $test['Test']['id'] ?>]" ></td>
                  <td><input type="text" class="popup" name="popupDatepicker[<?php echo $test['Test']['id'] ?>]"></td>
                </tr>
                <?php } ?>
              </tbody></table>
              </div>
              <input type="hidden" id="loadimg" name="clientsignature">
            <div id="signature-pad" class="m-signature-pad">
              <div class="m-signature-pad--body">
                <canvas></canvas>
              </div>
              <div class="m-signature-pad--footer">
                    <div class="description">Client Signature</div>
                        <div class="left">
                            <button type="button" class="button clear" data-action="clear">Clear</button>
                        </div>
                        <div class="right">
                            <button type="button" class="button save" data-action="save-png">Save as PNG</button>
                        </div>
                    </div>
              </div>
      </div>
          
            
          </div>
              
      
      <div class="box-body">    
          
           
 <div>
   <?php echo $this->Form->button('Submit', array('id' => 'addnewtest', 'class' => 'btn btn-primary btn-info')); ?>
</div>
</div>
</form>


</div></div>
</section>

 
  <script>
  $( function() {
     $("#datepicker" ).datepicker({ 
     format: 'mm-dd-yyyy',
            endDate: '+0d',
            autoclose: true
        });
  });
  </script>
<script type="text/javascript">
    $("#seldoctor").change(function(){
        var selectdoctor = $("#seldoctor :selected").text();
        $('#adddoctorname').val(selectdoctor);
    });
    
    
</script>

<style>
    .heading_list {
    width: 100%;
    float: left;
    border-bottom: 1px solid #aaa;
    margin-top: 10px;

}

.heading_list ul {
    width: 100%;
    float: left;
    margin-top: 13px;
}

.heading_list li {
    list-style: none;
    display: inline-block;
    margin-left: 7%;
    padding: 5px 31px;
    width: auto;
    text-align: center;
    float: left;
    font-weight: bold;
    font-size: 16px;

}
</style>

   <link rel="stylesheet" href="<?php echo $this->webroot; ?>signature_pad-master/css/signature-pad.css">

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
//check signature field not empty
$("#addnewtest").click(function(event){
  event.preventDefault();
  var tests = $('[name="testid[]"]:checked').length
  if(tests <= 0){
    alert("Please select atleast one test");
    return true;
  }
  var signval = $("#loadimg").val();
  if(!signval) {
    alert("Please Provide signature on pad first and save  as PNG");
    return false;
  }
        var return_true=1;
   $( ".options_list" ).each(function( index ) {
//console.log($(this).find('[name="testid[]"]:checked').val())
var id=$(this).find('[name="testid[]"]:checked').val()
//console.log($(this).find('[name="testdiagnosis['+id+']"]').val())
//console.log($(this).find('[name="popupDatepicker['+id+']"]').val())
var d_val=$(this).find('[name="testdiagnosis['+id+']"]').val();
var date_val=$(this).find('[name="popupDatepicker['+id+']"]').val();
if(id != undefined){
    if(d_val=="" || date_val==""){  
      alert("Please select all corresponding values.");
    return_true=0;
    event.preventDefault();
    return false;
    }else{
        return_true=1;
    }
}

});
 if(return_true==1){
   $(this).parents('form').submit();    
   }     

});
$(function(){
 
$('[class="popup"]').appendDtpicker({
"autodateOnStart": false
          });
        });
</script>