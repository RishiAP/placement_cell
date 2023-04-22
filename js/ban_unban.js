function ban_user() {
    const xhr2=new XMLHttpRequest();
    //Object the object
    // xhr.open('GET','rishi.txt',true);
    xhr2.open('POST','/placement_cell/partials/_student_ban.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    if(this.responseText==true){
        document.getElementById('page_main_message').innerHTML=`<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Done!</strong>@`+window.location.href.split('/')[5]+` has been banned.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`;
      document.getElementById('ban_unban_btn').innerHTML=`Unban Student <i class="bi bi-arrow-clockwise"></i>`;
      document.getElementById('ban_unban_btn').classList.remove('btn-outline-danger');
      document.getElementById('ban_unban_btn').classList.add('btn-outline-success');
      document.getElementById('ban_unban_btn').setAttribute('onclick',"unban_user()");
      document.getElementById('ban_badge').style.display="";
    }
}
xhr2.send(`{"username":"`+window.location.href.split('/')[5]+`"}`);
}
function unban_user() {
    const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_student_unban.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
}
//What to do when response is ready
xhr2.setRequestHeader("Content-type", "application/json");
xhr2.onload=function(){
    if(this.responseText==true){
        document.getElementById('page_main_message').innerHTML=`<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Done!</strong> @`+window.location.href.split('/')[5]+` has been unbanned.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`;
      document.getElementById('ban_unban_btn').innerHTML=`Ban Student <i class="bi bi-slash-circle"></i>`;
      document.getElementById('ban_unban_btn').setAttribute('onclick',"ban_user()");
      document.getElementById('ban_badge').style.display="none";
      document.getElementById('ban_unban_btn').classList.remove('btn-outline-success');
      document.getElementById('ban_unban_btn').classList.add('btn-outline-danger');
    }
  }
      xhr2.send(`{"username":"`+window.location.href.split('/')[5]+`"}`);
}