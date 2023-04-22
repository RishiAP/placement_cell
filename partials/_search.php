<?php
    session_start();
    if($_SERVER['REQUEST_METHOD']==="POST" && (isset($_SESSION['admin_id']) || isset($_SESSION['company_id']) || isset($_SESSION['user_id']))){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        require "_db_student.php";
        $data_response=array(
            "company"=>array(),
            "student"=>array()
        );
        if($jsonArray['query']!=""){
        if($jsonArray['query_type']!="#" && !isset($_SESSION['user_id'])){
            $user_query=mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_name` LIKE '%{$jsonArray['query']}%'");
            while ($student=mysqli_fetch_assoc($user_query)) {
                $image_data="";
                if($student['profile_image_name']!=""){
                    $data = array(
                        "image_name"=>$student['profile_image_name'],
                    );
                     
                    $json = json_encode($data);
                $url = "http://".gethostname()."/placement_cell/profile_images/_file_fetcher.php";
                $ch = curl_init($url);
                 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($json)
                ));
                $image_base64 = curl_exec($ch);
                curl_close($ch);
                $ext = pathinfo($student['profile_image_name'], PATHINFO_EXTENSION);
                $image_data= 'data:image/'.$ext.';base64,'.$image_base64;
            }
                array_push($data_response['student'],array(
                    "name"=>$student['person_name'],
                    "username"=>$student['user_name'],
                    "image_data"=>$image_data
                ));
            }
        }
        if($jsonArray['query_type']!="@" && !isset($_SESSION['company_id'])){
            $user_query=mysqli_query($conn_stu,"SELECT * FROM `company` WHERE `company_name` LIKE '%{$jsonArray['query']}%'");
            while ($company=mysqli_fetch_assoc($user_query)) {            
                array_push($data_response['company'],array(
                    "name"=>$company['company_name'],
                    "image_data"=>$company['company_logo_url']
                ));
            }
        }
    }
        echo json_encode($data_response);
    }
?>