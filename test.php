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
// echo $_SERVER['PHP_SELF']
// echo var_dump(array_merge_recursive(array("1_"=>"Deb"),array("3_"=>"okay")));
// require 'vendor/autoload.php';
//     use \Ds\Set;
// $all_data=json_decode(file_get_contents("data/boards.json"),true);
// $set10=new Set();
// $set12=new Set();
// foreach ($all_data as $key => $value) {
//     if(isset($value['10th']) || isset($value['12th'])){
//         $set10->add(array_pop($value['10th']));
//         $set12->add(array_pop($value['12th']));
//     }
//     else{
//         foreach ($value as $key => $value_in) {
//             $set10->add(array_pop($value_in['10th']));
//             $set12->add(array_pop($value_in['12th']));
//         }
//     }
// }
// $arr10=$set10->toArray();
// $arr12=$set12->toArray();
// sort($arr10);
// sort($arr12);
// $saving_data=array(
//     "10th"=>$arr10,
//     "12th"=>$arr12
// );
// file_put_contents("data/IndianSchoolBoards.json",json_encode($saving_data));
// echo var_dump($saving_data);
?>