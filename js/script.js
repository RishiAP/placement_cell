all_input_tags=Array.from(document.querySelectorAll('input'));
function inpOnFocus(){
    if(this.parentNode.querySelector('.myInputTag')!=null){
        this.parentNode.querySelector('.myInputTag').style.display="block";
    }
    if(!this.classList.contains('is-invalid') && this.parentNode.querySelector('.myInputTag')!=null){
        this.parentNode.querySelector('.myInputTag').style.color="";
    }
}
function inpOnBlur(){
    if(this.value=="" && this.parentNode.querySelector('.myInputTag')!=null){
    this.parentNode.querySelector('.myInputTag').style.display="none";
    }
    if(!this.classList.contains('is-invalid') && this.parentNode.querySelector('.myInputTag')!=null){
        this.parentNode.querySelector('.myInputTag').style.color="var(--bs-body-color)";
    }
}
all_input_tags.forEach(element => {
    element.addEventListener('focus',inpOnFocus);
    element.addEventListener('blur',inpOnBlur);
});
document.getElementById("theme_change_btn").addEventListener('click',function () {
    if(document.querySelector('html').getAttribute('data-bs-theme')==="dark"){
        document.querySelector('html').setAttribute('data-bs-theme',"light");
        if(document.querySelector('.profile-image')!=null && document.querySelector('.profile-image').src.includes("default_user_image")){
            all_default_images=Array.from(document.querySelectorAll('.profile-image'));
        all_default_images.forEach(function (img){
            img.src="/placement_cell/img/default_user_image_light.svg";
        })
        }
    }
    else{
        document.querySelector('html').setAttribute('data-bs-theme',"dark");
        if(document.querySelector('.profile-image') && document.querySelector('.profile-image').src.includes("default_user_image")){
            all_default_images=Array.from(document.querySelectorAll('.profile-image'));
        all_default_images.forEach(function (img){
            img.src="/placement_cell/img/default_user_image_dark.svg";
        })
        }
    }
    const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_set_theme.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    
  }
  params2=`{"theme":"`+document.querySelector('html').getAttribute('data-bs-theme')+`"}`;
      xhr2.send(params2);
})
setTimeout(function fetch_notifications() {
    const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_placement_notifications.php',true);
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
    $data.forEach($each_data => {
        $new_noti=document.createElement('div');
        $new_noti.setAttribute('role','alert');
        $new_noti.setAttribute('aria-live','assertive');
        $new_noti.setAttribute('aria-atomic','true');
        $new_noti.setAttribute('class','toast fade show');
        $new_noti.innerHTML=`<div class="toast-header">
        <img style="margin-right:0.75rem;" width="20" src="`+$each_data.company_logo_url+`">
        <strong class="me-auto">`+$each_data.company_name+`</strong>
        <small class="text-body-secondary">just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">Offered you a placement of
      `+$each_data.amount+`
      </div><a href="/placement_cell/student/offers.php" class="stretched-link"></a>`;
      document.getElementById('notifications').appendChild($new_noti);
    });
}
  }
      xhr2.send();
},3000);
if(document.getElementById('main_search')!=null){
document.getElementById('main_search').addEventListener('input',function () {
    const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_search.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    document.getElementById('search_results').innerHTML=``;
    data=JSON.parse(this.responseText);
    document.getElementById('search_results').style.display="none";
    data.company.forEach(comp => {
        newResult=document.createElement('a');
        newResult.setAttribute('class',"list-group-item list-group-item-action");
        newResult.setAttribute('href',"/placement_cell/company_profile/"+comp.name);
        newResult.innerHTML=`<div><img src="`+comp.image_data+`" style="max-width:50px;">
        <h5 class="mb-1">`+comp.name+`</h5></div>`;
        document.getElementById('search_results').appendChild(newResult);
        document.getElementById('search_results').style.display="flex";
    });
    data.student.forEach(stu => {
        newResult=document.createElement('a');
        newResult.setAttribute('class',"list-group-item list-group-item-action");
        newResult.setAttribute('href',"/placement_cell/student_profile/"+stu.username);
        if(stu.image_data==""){
            $image=`<i class="bi bi-person-circle" style="font-size:50px;"></i>`;
        }
        else{
            $image=`<img src="`+stu.image_data+`" style="max-width:50px;">`;
        }
        newResult.innerHTML=`<div>`+$image+`
        <div class="d-flex flex-column"><h6 class="mb-1">`+stu.username+`</h6><p class="m-0">`+stu.name+`</p><div></div>`;
        document.getElementById('search_results').appendChild(newResult);
        document.getElementById('search_results').style.display="flex";
    });
  }
  first_letter=this.value.substring(0,1);
  if(first_letter==="@" || first_letter==="#"){
    query_type=first_letter;
    query=this.value.substring(1);
  }
  else{
    query=this.value;
    query_type="general";
  }
      xhr2.send(`{"query":"`+query+`","query_type":"`+query_type+`"}`);
})
}