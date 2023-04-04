<?php
//     $data = array(
//         "image_name"=>"6a17ef39209d943a2518d81680182e4393d4861531020581ca722c1496dcba5f.png",
//     );
     
//     $json = json_encode($data);
// $url = "http://".gethostname()."/placement_cell/profile_images/_file_fetcher.php";
// $ch = curl_init($url);
 
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
// curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     'Content-Type: application/json',
//     'Content-Length: ' . strlen($json)
// ));
// $image_base64 = curl_exec($ch);
// curl_close($ch);
// echo '<img src="data:image/png;base64,'.$image_base64.'" />';
echo $_SERVER['PHP_SELF']
?>