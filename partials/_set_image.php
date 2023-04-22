<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        session_start();
        if(isset($_SESSION['user_id'],$_POST['image_data'])){
            require "_db_student.php";
            $user_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
            if($user_details['banned']){
                require "_logOut.php";
                echo "banned";
                exit(0);
            }
            $profile_image_name=$user_details['profile_image_name'];
            if($profile_image_name!=""){
                unlink("../profile_images/".$profile_image_name);
            }
            $data=explode(',',$_POST['image_data']);
            if(stripos($data[0],"image/x-icon")!==false)
                $ext="ico";
            else if(stripos($data[0],"image/")!==false) {
                $ext=explode('/',explode(";",$data[0])[0])[1];
            }
            $random_name=hash("sha256",time().uniqid()).".".$ext;
            $file_saved=file_put_contents("../profile_images/".$random_name,file_get_contents($_POST['image_data']));
            if($file_saved!==false){
                $result=mysqli_query($conn_stu,"UPDATE `student` SET `profile_image_name`='$random_name' WHERE `user_id`='{$_SESSION['user_id']}'");
                if($result){
                    $data = array(
                        "image_name"=>$random_name,
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
                $ext = pathinfo($random_name, PATHINFO_EXTENSION);
                echo 'data:image/'.$ext.';base64,'.$image_base64;
                }
            }
        }
    }
?>