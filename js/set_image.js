document.getElementById('changeProfilePhotoBtn').addEventListener('click',function (){
    document.getElementById('upload_image').click();
});
document.getElementById('upload_image').addEventListener('input',function (e) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(e.target.files[0]);
    fileReader.addEventListener("load", function () {
        const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_set_image.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    if(this.responseText==="banned"){
        window.location.href="/placement_cell/login/student_login.php";
    }
    else{
    $data=JSON.parse(this.responseText);
    if($data.status==200)
    document.getElementById('user_profile_photo').src="/placement_cell/profile_images/"+$data.image_name;
    document.getElementById('profileImageAlterChoiceModalCloseBtn').click();
    }
  }
  params2=`{"image_data":"`+this.result+`"}`;
      xhr2.send(params2);
      });    
})