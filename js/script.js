all_input_tags=Array.from(document.querySelectorAll('input'));
function inpOnFocus(){
    if(this.parentNode.querySelector('.myInputTag')!=null){
        this.parentNode.querySelector('.myInputTag').style.display="block";
    }
    if(!this.classList.contains('is-invalid')){
        this.parentNode.querySelector('.myInputTag').style.color="";
    }
}
function inpOnBlur(){
    if(this.value=="" && this.parentNode.querySelector('.myInputTag')!=null){
    this.parentNode.querySelector('.myInputTag').style.display="none";
    }
    if(!this.classList.contains('is-invalid')){
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
        if(document.querySelector('.profile-image').src.includes("default_user_image")){
            all_default_images=Array.from(document.querySelectorAll('.profile-image'));
        all_default_images.forEach(function (img){
            img.src="/placement_cell/img/default_user_image_light.svg";
        })
        }
    }
    else{
        document.querySelector('html').setAttribute('data-bs-theme',"dark");
        if(document.querySelector('.profile-image').src.includes("default_user_image")){
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