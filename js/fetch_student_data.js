all_btn_links=Array.from(document.querySelector('.user-right-section').querySelectorAll('.btn-link'));
function _base64ToArrayBuffer(base64) {
    var binary_string = window.atob(base64);
    var len = binary_string.length;
    var bytes = new Uint8Array(len);
    for (var i = 0; i < len; i++) {
        bytes[i] = binary_string.charCodeAt(i);
    }
    return bytes.buffer;
}
function fetch_doc() {
    $data_to_input=this.getAttribute('data-bs-type');
    if($data_to_input==="doc_resume"){
        document.getElementById('student_docs_details_modalLabel').innerText='@'+document.location.href.split('/')[5]+" - Resume";
    }
    else if($data_to_input==="doc_high_school"){
        document.getElementById('student_docs_details_modalLabel').innerText='@'+document.location.href.split('/')[5]+" - High School Marksheet";
    }
    else if($data_to_input==="doc_intermediate"){
        document.getElementById('student_docs_details_modalLabel').innerText='@'+document.location.href.split('/')[5]+" - Intermediate Marksheet";
    }
    else if($data_to_input==="doc_diploma"){
        document.getElementById('student_docs_details_modalLabel').innerText='@'+document.location.href.split('/')[5]+" - Diploma Marksheet";
        $data_to_input="doc_intermediate"
    }
    if(document.getElementById($data_to_input).innerHTML==``){
        const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_fetch_student_docs.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    if(this.responseText==="banned"){
        window.location.href="/placement_cell/login/student_login.php";
    }
    else if(this.responseText==="student_banned"){
        document.getElementById('docs_show_modal_message').innerHTML=`<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong>The student is currently banned.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`;
      document.getElementById('docs_show_modal_message').style.display="block";
    }
    else{
    document.getElementById($data_to_input).style.display="block";
    all_other_docs=document.getElementById('student_docs_details_modal').querySelector('.modal-body').querySelectorAll('div:not(#'+$data_to_input+')');
    all_other_docs.forEach(doc => {
        doc.style.display="none";
    });
    var adobeDCView = new AdobeDC.View({clientId: "396cd659cc9c484bb88047702789074f", divId: $data_to_input});
        adobeDCView.previewFile(
       {
        content:{ promise: Promise.resolve(_base64ToArrayBuffer(this.responseText)) },
          metaData: {fileName: "Resume Preview.pdf"}
       });
    }
  }
  params=`{"doc_type":"`+$data_to_input+`","username":"`+document.location.href.split('/')[5]+`"}`;
      xhr2.send(params);
    }
    else{
        document.getElementById($data_to_input).style.display="block";
        all_other_docs=document.getElementById('student_docs_details_modal').querySelector('.modal-body').querySelectorAll('div:not(#'+$data_to_input+')');
        all_other_docs.forEach(doc => {
            doc.style.display="none";
        });
    }
}
all_btn_links.forEach(btn => {
    btn.addEventListener('click',fetch_doc);
});