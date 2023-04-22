document.getElementById('changeProfilePhotoBtn').addEventListener('click',()=>{
    document.getElementById('profileImageAlterChoiceModalCloseBtn').click();
    document.getElementById('upload_image').click();
  });
  document.getElementById('removeProfilePhotoBtn').addEventListener('click',()=>{
    //Instant of xhr object
    const xhrRPP=new XMLHttpRequest();
    //Object the object
    // xhr.open('GET','rishi.txt',true);
    xhrRPP.open('POST','/placement_cell/partials/_remove_profile_photo.php',true);
    //What to do on progress(optional)
    xhrRPP.onprogress=function(){

    }
    //What to do when response is ready
    xhrRPP.setRequestHeader("Content-type", "application/json");
    xhrRPP.onload=function(){
      if(this.responseText==="banned"){
        window.location.href="/placement_cell/login/student_login.php";
      }
       else if(this.responseText==true)
        {
            document.getElementById('profileImageRemoveChoiceModalCloseBtn').click();
            setTimeout(() => {
              document.getElementById('profileImageAlterChoiceModalCloseBtn').click();
            }, 500);
            document.getElementById('askRemoveProfilePhotoBtn').style.display="none";
            document.getElementById('changeProfilePhotoBtn').innerText="Set Profile Photo";
            document.getElementById('user_profile_photo').src="/placement_cell/img/default_user_image_"+document.querySelector('html').getAttribute('data-bs-theme')+".svg";
            document.getElementById('menuProfileImage').src="/placement_cell/img/default_user_image_"+document.querySelector('html').getAttribute('data-bs-theme')+".svg";
        }
    }
    xhrRPP.send();
  });