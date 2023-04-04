passMatched=false;
function warn_usn_exist() {
    document.getElementById('username').classList.remove('is-valid');
    document.getElementById('username').classList.add('is-invalid');
}
function usn_dosent_exist() {
    document.getElementById('username').classList.remove('is-invalid');
    document.getElementById('username').classList.add('is-valid');
}
function warn_email_exist() {
    document.getElementById('email').classList.remove('is-valid');
    document.getElementById('email').classList.add('is-invalid');
}
function email_dosent_exist() {
    document.getElementById('email').classList.remove('is-invalid');
    document.getElementById('email').classList.add('is-valid');
}
document.getElementById('register-btn').addEventListener('click',function (){
    check_usn();
    check_email();
    if(document.querySelector('.is-invalid')!=null){
    document.querySelector('.is-invalid').parentNode.querySelector('.myInputTag').style.color="";
    document.querySelector('.is-invalid').classList.remove('is-invalid');
    }
    if(document.getElementById('person_name').value==""){
        document.getElementById('person_name').classList.add('is-invalid');
        document.getElementById('person_name').parentNode.querySelector('.myInputTag').style.color="var(--bs-danger)";
    }
    else if(document.getElementById('email').value==""){
        document.getElementById('email').classList.add('is-invalid');
        document.getElementById('email').parentNode.querySelector('.myInputTag').style.color="var(--bs-danger)";
    }
    else if(document.getElementById('username').value==""){
        document.getElementById('username').classList.add('is-invalid');
        document.getElementById('username').parentNode.querySelector('.myInputTag').style.color="var(--bs-danger)";
    }
    else if(document.getElementById('password').value==""){
        document.getElementById('password').classList.add('is-invalid');
        document.getElementById('password').parentNode.querySelector('.myInputTag').style.color="var(--bs-danger)";
    }
    else if(document.getElementById('cnf_password').value==""){
        document.getElementById('cnf_password').classList.add('is-invalid');
        document.getElementById('cnf_password').parentNode.querySelector('.myInputTag').style.color="var(--bs-danger)";
    }
    else if(passMatched && !window.check_usn_return && !window.check_email_return){
        const xhr=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr.open('POST','/placement_cell/partials/_register_student.php',true);
  //What to do on progress(optional)
  xhr.onprogress=function(){
  }
  //What to do when response is ready
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onload=function(){
    if(this.responseText==true){
        document.getElementById('stu_register_form').reset();
        document.getElementById('page_main_message').innerHTML=`<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>Your account has been created successfully. <a href="/placement_cell/login/student_login.php">Click here</a> to login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`;
    }
  }
  params=`{"username":"`+document.getElementById('username').value+`","person_name":"`+document.getElementById('person_name').value+`","password":"`+document.getElementById('password').value+`","cnf_pass":"`+document.getElementById('cnf_password').value+`","email":"`+document.getElementById('email').value+`"}`;
  xhr.send(params);
    }
    else if(window.check_email_return==true){
        warn_email_exist();
    }
    else if(window.check_usn_return==true){
        warn_usn_exist();
    }
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
function check_pass() {
    if(document.getElementById('password').value!="" && document.getElementById('cnf_password').value!=""){
        if(document.getElementById('password').value===document.getElementById('cnf_password').value){
            document.querySelector('.pass_message').querySelector('.alert').innerHTML=`Passwords Matched`;
            document.querySelector('.pass_message').querySelector('.alert').style.display="block";
            passMatched=true;
            document.getElementById('password').classList.remove('is-invalid');
            document.getElementById('password').classList.add('is-valid');
            document.getElementById('password').parentNode.querySelector('.myInputTag').style.color="var(--bs-success)";
            document.getElementById('cnf_password').classList.remove('is-invalid');
            document.getElementById('cnf_password').classList.add('is-valid');
            document.getElementById('cnf_password').parentNode.querySelector('.myInputTag').style.color="var(--bs-success)";
        }
        else{
            document.querySelector('.pass_message').querySelector('.alert').innerHTML=`Passwords Doesn't Matched`;
            document.getElementById('password').parentNode.querySelector('.myInputTag').style.color="var(--bs-danger)";
            document.getElementById('cnf_password').parentNode.querySelector('.myInputTag').style.color="var(--bs-danger)";
            document.querySelector('.pass_message').querySelector('.alert').style.display="block";
            passMatched=false;
            document.getElementById('password').classList.remove('is-valid');
            document.getElementById('password').classList.add('is-invalid');
            document.getElementById('cnf_password').classList.remove('is-valid');
            document.getElementById('cnf_password').classList.add('is-invalid');
        }
    }
    else{
        document.querySelector('.pass_message').querySelector('.alert').style.display="none";
        passMatched=false;
        document.getElementById('password').classList.remove('is-valid');
        document.getElementById('password').classList.remove('is-invalid');
        document.getElementById('cnf_password').classList.remove('is-valid');
        document.getElementById('cnf_password').classList.remove('is-invalid');
        document.getElementById('cnf_password').parentNode.querySelector('.myInputTag').style.color="";
        document.getElementById('cnf_password').parentNode.querySelector('.myInputTag').style.color="";
    }
}
inp_pass=Array.from(document.querySelectorAll('input[type=password]'));
inp_pass.forEach(element => {
    element.addEventListener('input',check_pass);
});
all_inp=Array.from(document.querySelectorAll('input:not([type=checkbox],[type=password])'));
all_inp.forEach(element => {
    element.addEventListener('input',check_valid);
});
document.getElementById('username').addEventListener('change',function () {
    check_usn();
})
document.getElementById('email').addEventListener('change',function () {
    check_email();
})
async function check_usn() {
    window.check_usn_return=null;
    const xhr1=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr1.open('POST','/placement_cell/partials/_check_usn.php',true);
  //What to do on progress(optional)
  xhr1.onprogress=function(){
  }
  //What to do when response is ready
  xhr1.setRequestHeader("Content-type", "application/json");
  xhr1.onload=function(){
    if(this.responseText==true){
        window.check_usn_return= true;
        warn_usn_exist();
    }
    else{
        window.check_usn_return= false;
        usn_dosent_exist();
    }
  }
  params1=`{"username":"`+document.getElementById('username').value+`"}`;
  if(document.getElementById('username').value!=""){
      xhr1.send(params1);
  }
  return 0;
}
async function check_email() {
    window.check_email_return=null;
    const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_check_email.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    if(this.responseText==true){
        window.check_email_return= true;
        warn_email_exist();
    }
    else{
        window.check_email_return= false;
        email_dosent_exist();
    }
  }
  params2=`{"email":"`+document.getElementById('email').value+`"}`;
  if(document.getElementById('email').value!=""){
      xhr2.send(params2);
  }
  return 0;
}
document.getElementById('show_password').addEventListener('change',function (){
    if(document.getElementById('password').type==="password"){
        document.getElementById('password').type="text";
    document.getElementById('cnf_password').type="text";
    }
    else{
        document.getElementById('password').type="password";
    document.getElementById('cnf_password').type="password";
    }
});
document.getElementById('stu_register_form').addEventListener('keydown',function (e){
    if(e.key==="Enter"){
        document.getElementById('register-btn').click();
    }
})