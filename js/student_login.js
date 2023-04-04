document.getElementById('login-btn').addEventListener('click',function (){
    if(document.getElementById('username').value==""){
        document.getElementById('username').classList.add('is-invalid');
        document.getElementById('username').parentNode.querySelector('.myInputTag').style.color="var(--bs-danger)";
    }
    else if(document.getElementById('password').value==""){
        document.getElementById('password').classList.add('is-invalid');
        document.getElementById('password').parentNode.querySelector('.myInputTag').style.color="var(--bs-danger)";
    }else{
        const xhr=new XMLHttpRequest();
        xhr.open('POST','/placement_cell/partials/_student_verification.php',true);
  //What to do on progress(optional)
  xhr.onprogress=function(){
  }
  //What to do when response is ready
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onload=function(){
    if(this.responseText==true){
        window.location.href="/placement_cell/student/";
    }
    else if(this.responseText==false){
        document.getElementById('password').classList.add('is-invalid');
        document.getElementById('password').parentNode.querySelector('.myInputTag').style.color="var(--bs-danger)";
        document.getElementById('username').classList.remove('is-invalid');
        document.getElementById('username').parentNode.querySelector('.myInputTag').style.color="";
    }
    else if(this.responseText==="falseUser"){
        document.getElementById('username').classList.add('is-invalid');
        document.getElementById('username').parentNode.querySelector('.myInputTag').style.color="var(--bs-danger)";
        document.getElementById('password').classList.remove('is-invalid');
        document.getElementById('password').parentNode.querySelector('.myInputTag').style.color="";
    }
  }
  params=`{"username":"`+document.getElementById('username').value+`","password":"`+document.getElementById('password').value+`"}`;
  xhr.send(params);
    }
})
all_inp=Array.from(document.querySelectorAll('input:not([type=checkbox])'));
all_inp.forEach(element => {
    element.addEventListener('input',check_valid);
});
function check_valid(){
    if(this.value==""){
        this.classList.add('is-invalid');
        this.parentNode.querySelector('.myInputTag').style.color="var(--bs-danger)";
    }
    else{
        this.classList.remove('is-invalid');
        this.parentNode.querySelector('.myInputTag').style.color="";
    }
}
document.querySelector('.eye').addEventListener('click',function (){
    if(this.querySelector('.bi-eye')!=null){
        this.querySelector('.bi-eye').classList.add('bi-eye-slash');
        this.querySelector('.bi-eye').classList.remove('bi-eye');
        document.getElementById('password').type="text";
    }
    else{
        this.querySelector('.bi-eye-slash').classList.add('bi-eye');
        this.querySelector('.bi-eye').classList.remove('bi-eye-slash');
        document.getElementById('password').type="password";
    }
})
document.getElementById('login_form').addEventListener('keydown',function (e){
    if(e.key==="Enter"){
        document.getElementById('login-btn').click();
    }
})