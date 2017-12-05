<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box form_sec">
                <div class="box-header">
                </div>
                <div class="main-content">
                    <?php $x = $this->Session->flash(); ?>
                    <?php if ($x) { ?>
                    <div class="alert success">
                        <span class="icon"></span>
                        <strong></strong><?php echo $x; ?>
                    </div>
                    <?php }  
                    if($datapatienttest['PatientTest']['reporttime'] != NULL){ ?>
                    <h2>Edit Report</h2>
                    <?php } else{ ?>
                    <h2>Upload Report</h2>
                    <?php } ?>
                    <div class="container"><h2><?php echo $test['Test']['test']; ?> Tests Report</h2></div>
                    <form method="post" action="<?php echo $this->webroot ?>admin/patients/reportadminupload/<?php echo $testid.'/'.$patienttestid.'/'.$patid ?>" class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Patient Name:</label>
                            <div class="col-sm-10">
                              <input type="test" class="form-control" id="patname" name= "data[PatientTest][pname]" value="<?php echo $patientdata['Patient']['firstname'] . ' ' . $patientdata['Patient']['lastname']; ?>" readonly>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Test:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="test" name="data[PatientTest][test]" value="<?php echo $test['Test']['test']; ?>" readonly>
                            </div>
                          </div>
                          <?php if($test['Test']['test'] == 'PT/INR'){ 
                            $ptinr = explode("/", $test['Test']['units']);
                            $ptinrref = explode("/", $test['Test']['referencerange']);
                          ?>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Report PT:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="testreport" name= "data[PatientTest][report]" value=""><?php echo $ptinr['0']; ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Refrence Range PT:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="refrange" name="data[PatientTest][refrange]" value="<?php echo $ptinrref['0']; ?>" readonly>
                            </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-sm-2" for="sel1">Flag PT</label>
                           <div class="col-sm-10">
                          <select class="form-control" id="sel1" name="data[PatientTest][flag]">
                           <option value="">--Select Flag--</option>
                            <option value="high">HIGH</option>
                            <option value="normal">NORMAL</option>
                            <option value="low">LOW</option>
                          </select>
                          </div>
                        </div> 

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Report INR:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="testreport" name= "data[PatientTest][report1]" value=""><?php echo $ptinr['1']; ?>
                            </div>
                          </div>
                           
                           <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Refrence Range INR:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="refrange" name="data[PatientTest][refrange]" value="<?php echo $ptinrref['1']; ?>" readonly>
                            </div>
                          </div>

                          

                        <div class="form-group">
                          <label class="control-label col-sm-2" for="sel1">Flag INR</label>
                           <div class="col-sm-10">
                          <select class="form-control" id="sel1" name="data[PatientTest][flag1]">
                           <option value="">--Select Flag--</option>
                            <option value="high">HIGH</option>
                            <option value="normal">NORMAL</option>
                            <option value="low">LOW</option>
                          </select>
                          </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Conclusion:</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" name="data[PatientTest][conclu]" id="conclu"></textarea>
                            </div>
                          </div>

                          <?php }else{ ?>
                           <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Report:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="testreport" name= "data[PatientTest][report]" value=""><?php echo $test['Test']['units']; ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Refrence Range:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="refrange" name="data[PatientTest][refrange]" value="<?php echo $test['Test']['referencerange']; ?>" readonly>
                            </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-sm-2" for="sel1">Flag</label>
                           <div class="col-sm-10">
                          <select class="form-control" id="sel1" name="data[PatientTest][flag]">
                           <option value="">--Select Flag--</option>
                            <option value="high">HIGH</option>
                            <option value="normal">NORMAL</option>
                            <option value="low">LOW</option>
                          </select>
                          </div>
                        </div> 

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Conclusion:</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" name="data[PatientTest][conclu]" id="conclu"></textarea>
                            </div>
                          </div>
                        <?php } ?>
                  
                          
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-default">Upload Report</button>
                            </div>
                          </div>   
                   </form>
				</div>
			</div>
		</div>
	</div>
</section>
<style>
#sel1{width:50%;}
</style>