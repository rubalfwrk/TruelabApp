<?php

    $conn = new mysqli('mysql1123.ixwebhosting.com','BBBn1tz_true','Rubal2017','BBBn1tz_truelabllc');
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    } 

    
    function workmain($conn) {

        $today =  strtotime(date('Y-m-d'));
        
        $dataas = "SELECT *  FROM `patient_tests` WHERE `report` IS NOT NULL AND `cronreportstatus` = '0'";

        $dataee = $conn->query($dataas);

        foreach($dataee as $datas){

        $dated = strtotime(date('Y-m-d',strtotime($datas['reportdate']))); 
        $days_between = ceil(abs($today - $dated) / 86400); 
        $doctorid = $datas['doctorid'];
        $patientid = $datas['patientid'];
        $userid = $datas['userid'];
        $testid = $datas['testid'];
        $status = $datas['status'];
        $date = $datas['date'];
        $report = $datas['report'];
        $reportdate = $datas['reportdate'];
        $pid = $datas['id'];
        
        if($report){
            
            $aa = "INSERT INTO `status_historys`(`doctorid`, `patientid`,`userid`, `testid`,`status`, `date`,`report`, `reportdate`) VALUES ($doctorid,$patientid,$userid,$testid,$status,'".$date."',$report,'".$reportdate."')";
            
            $conn->query($aa);

            $abc = "UPDATE `patient_tests` SET cronreportstatus = '1' WHERE id = $pid";

            $conn->query($abc);

            // $del = "DELETE FROM `patient_tests` WHERE `id` = $pid";
            // $conn->query($del);
            }  
         }

        // exit;
        }
       workmain($conn);


    function delpatientinfo($conn){
     
        $today = strtotime(date('Y-m-d'));
        
        $dataas = "SELECT patients.id,(SELECT count(*) FROM `patient_tests` where patientid = patients.id and (report is not null OR canceldate is not null)) as patient_count ,(SELECT count(*) FROM `patient_tests` where patientid = patients.id) as allcount, (SELECT patient_tests.appclientdownloadreport_date FROM `patient_tests` where patient_tests.patientid = patients.id and patient_tests.appclientdownloadreport = '1' order by patient_tests.reportdate DESC limit 1) as last_reportdate FROM `patients` having patient_count > 0 and allcount > 0 and  patient_count = allcount";

        $dataee = $conn->query($dataas);

            foreach($dataee as $datas){
                        
            $id = $datas['id'];  
            if($datas['last_reportdate'] != ""){
            $dated = strtotime(date('Y-m-d',strtotime($datas['last_reportdate']))); 
            
            $days_between = ceil(abs($today - $dated) / 86400); 
            
            if($days_between > 3){

                $f = "DELETE FROM `patients` WHERE `id` = $id";
                $conn->query($f);
                $a = "DELETE FROM `status_accepts` WHERE `patientid` = $id";
                $conn->query($a);
                $b = "DELETE FROM `status_cancels` WHERE `patientid` = $id";
                $conn->query($b);
                $c = "DELETE FROM `status_declines` WHERE `patientid` = $id";
                $conn->query($c);
                $d = "DELETE FROM `status_historys` WHERE `patientid` = $id";
                $conn->query($d);
                $e = "DELETE FROM `status_reschedules` WHERE `patientid` = $id";
                $conn->query($e);
                $k = "DELETE FROM `patient_tests` WHERE `patientid` = $id";
                $conn->query($k);
            }
        }   
        }

        }
    delpatientinfo($conn);

     function repdelpatientinfo($conn){
      
        $today = strtotime(date('Y-m-d'));
        
        $dataas = "SELECT patients.id,(SELECT count(*) FROM `patient_tests` where patientid = patients.id and (report is not null OR canceldate is not null)) as patient_count ,(SELECT count(*) FROM `patient_tests` where patientid = patients.id) as allcount, (SELECT patient_tests.reportdownloadstatus_date FROM `patient_tests` where patient_tests.patientid = patients.id and patient_tests.reportdownloadstatus = '1' order by patient_tests.reportdate DESC limit 1) as last_reportdate FROM `patients` having patient_count > 0 and allcount>0 and  patient_count = allcount";
       $dataee = $conn->query($dataas);
        foreach($dataee as $datas){
                      
        $id = $datas['id'];  
        if($datas['last_reportdate'] != ""){
        $dated = strtotime(date('Y-m-d',strtotime($datas['last_reportdate']))); 
        $days_between = ceil(abs($today - $dated) / 86400); 
        
        if($days_between > 3){
            
            $f = "DELETE FROM `patients` WHERE `id` = $id";
            $conn->query($f);
            $a = "DELETE FROM `status_accepts` WHERE `patientid` = $id";
            $conn->query($a);
            $b = "DELETE FROM `status_cancels` WHERE `patientid` = $id";
            $conn->query($b);
            $c = "DELETE FROM `status_declines` WHERE `patientid` = $id";
            $conn->query($c);
            $d = "DELETE FROM `status_historys` WHERE `patientid` = $id";
            $conn->query($d);
            $e = "DELETE FROM `status_reschedules` WHERE `patientid` = $id";
            $conn->query($e);
            $k = "DELETE FROM `patient_tests` WHERE `patientid` = $id";
            $conn->query($k);
        }
    }
    }
    }
    repdelpatientinfo($conn);


    $conn->close();
?>