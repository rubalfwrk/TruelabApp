<?php

// $headers = "From: noreply@truelabllc.com";
// mail('rubal@avainfotech.com','change password','hye',$headers); die;
    $conn = new mysqli('mysql1123.ixwebhosting.com','BBBn1tz_true','Rubal2017','BBBn1tz_truelabllc');
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    } 

    function sendNewnotificationPush($token) {


        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        $notification = array('title' => 'Please change your password', 'body' => 'Your password will expire in 7 days, your account will be deactivated. Please change your password');

        $arrayToSend = array('to' => $token, 'notification' => $notification);
        $json = json_encode($arrayToSend);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key= AIzaSyC85MK9anXJydJc0ol8eLUvXRUNWU1bHrc';


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        //echo '<pre>'; print_r($result); echo '</pre>'; die;   
        curl_close($ch);
        return "ok";
    }


    function sendNewnotificationPushdoctor($token) {


        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        $notification = array('title' => 'Please change your password', 'body' => 'Your password will expire in 7 days, your account will be deactivated. Please change your password');

        $arrayToSend = array('to' => $token, 'notification' => $notification);
        $json = json_encode($arrayToSend);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key= AIzaSyCbdKNXKWOXMWVjrRemkdIwQndN8Vbget8';


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        //echo '<pre>'; print_r($result); echo '</pre>'; die;   
        curl_close($ch);
        return "ok";
    }



    function changepass($conn){
     
        $today = strtotime(date('Y-m-d'));
        
        $dataas = "SELECT * FROM `users`";

        $dataee = $conn->query($dataas);

            foreach($dataee as $datas){
                    
            $id = $datas['id'];  
            if($datas['passworddate'] != NULL){
            $dated = strtotime(date('Y-m-d',strtotime($datas['passworddate']))); 
            
            $days_between = ceil(abs($today - $dated) / 86400); 
            
            if($days_between > 30 && $days_between < 32){
                
                $dat = date('Y-m-d');
                  
                  if($datas['tokenid'] != "" && $datas['role'] == "user"){
                    $token = $datas['tokenid'];
                    sendNewnotificationPush($token);
                  }else if($datas['tokenid'] != "" && $datas['role'] == "client"){
                    $token = $datas['tokenid'];
                    sendNewnotificationPushdoctor($token);
                  }

                  $mss = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="http://truelabllc.com/truelab/home/logo.png"/></td> </tr><tr><td colspan="2"> <h2>Welcome to Truelab</h2><h3></tr><tr>Your password will expire in 7 days, your account will be deactivated. Please change your password. Thank you. </tr><tr><td colspan="2"><h3>Thank you</h2> </td> </tr></table></body>'; 

                   $headers = "MIME-Version: 1.0" . "\r\n";
                   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    // More headers
                   $headers .= 'From: <noreply@truelabllc.com>' . "\r\n";
                    mail('notification@truelabllc.com','Change Password',$mss,$headers);
                    mail($datas['email'],'Change Password',$mss,$headers);
            }
        }   
        }

        }
    changepass($conn);


$conn->close();
?>