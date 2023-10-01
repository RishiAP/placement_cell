window.resumeViewTime=1;
window.academicViewTime=1;
all_side_nav_options=Array.from(document.querySelector('.nav-pills').querySelectorAll('a'));
document.querySelector("#ten_2").addEventListener('input',function () {
    if(this.checked){
        document.getElementById('intermediate_board').setAttribute('required','true');
        document.getElementById('intermediate_board').removeAttribute('disabled');
    }
})
document.querySelector("#ten_3").addEventListener('input',function () {
    if(this.checked){
        document.getElementById('intermediate_board').setAttribute('disabled','true');
        document.getElementById('intermediate_board').removeAttribute('required');
    }
})
function activateSection() {
    if(!this.classList.contains('active')){
        active_element=this.parentNode.parentNode.querySelector('.active');
        active_element.classList.remove('active');
        active_element.classList.add('link-body-emphasis');
        this.classList.add('active');
        document.querySelector('main').querySelector('#'+active_element.getAttribute('data-option-type')).style.display="none";
        document.querySelector('main').querySelector('#'+this.getAttribute('data-option-type')).style.display="";
    }
    document.querySelector('.offcanvas').querySelector('.btn-close').click();
    if(this.getAttribute('data-option-type')==="resume"){
        document.getElementById('resume_delete_button').style.visibility="visible";
        if(window.resumeViewTime==1){
            const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_get_resume.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    if(this.responseText==="banned"){
        window.location.href="/placement_cell/login/student_login.php";
    }
      else if(this.responseText!=false){
        var adobeDCView = new AdobeDC.View({clientId: AdobeDC_Key, divId: "pdf_viewer"});
        adobeDCView.previewFile(
       {
        content:{ promise: Promise.resolve(_base64ToArrayBuffer(this.responseText)) },
          metaData: {fileName: "Resume.pdf"}
       });
       document.getElementById('pdf_viewer').style.display="block";
       document.getElementById('resume_delete_button').style.display="block";
      }
  }
      xhr2.send();
      window.resumeViewTime++;
        }
    }
    else{
        document.getElementById('resume_delete_button').style.visibility="hidden";
        document.querySelector('main').style.overflow="";
    }
    if(this.getAttribute('data-option-type')==="academics"){
        if(window.academicViewTime==1){
            const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_get_academic_docs.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    if(this.responseText==="banned"){
        window.location.href="/placement_cell/login/student_login.php";
    }
     else if(this.responseText!=false){
          $data=JSON.parse(this.responseText);
        var adobeDCView = new AdobeDC.View({clientId: AdobeDC_Key, divId: "high-school-marksheet-preview"});
        adobeDCView.previewFile(
       {
        content:{ promise: Promise.resolve(_base64ToArrayBuffer($data.high_school_marksheet)) },
          metaData: {fileName: "Resume.pdf"}
       });
       document.getElementById('high-school-marksheet-preview').style.display="block";
        var adobeDCView = new AdobeDC.View({clientId: AdobeDC_Key, divId: "intermediate-marksheet-preview"});
        adobeDCView.previewFile(
       {
        content:{ promise: Promise.resolve(_base64ToArrayBuffer($data.intermediate_marksheet)) },
          metaData: {fileName: "Resume.pdf"}
       });
       document.getElementById('intermediate-marksheet-preview').style.display="block";
      }
  }
      xhr2.send();
      window.academicViewTime++;
        }
    }
}
all_side_nav_options.forEach(option => {
    option.addEventListener('click',activateSection);
});
function _base64ToArrayBuffer(base64) {
    var binary_string = window.atob(base64);
    var len = binary_string.length;
    var bytes = new Uint8Array(len);
    for (var i = 0; i < len; i++) {
        bytes[i] = binary_string.charCodeAt(i);
    }
    return bytes.buffer;
}
reader=new FileReader();
document.getElementById('resume_doc').addEventListener('input',() =>{
    reader.onload=function (event){
        var adobeDCView = new AdobeDC.View({clientId: AdobeDC_Key, divId: "pdf_viewer"});
        adobeDCView.previewFile(
       {
        content:{ promise: Promise.resolve(_base64ToArrayBuffer(reader.result.split(',')[1])) },
          metaData: {fileName: "Resume Preview.pdf"}
       });
       document.getElementById('pdf_viewer').style.display="";
       window.resume_data=reader.result;
    }
    reader.readAsDataURL(document.getElementById('resume_doc').files[0]);
})
document.getElementById('resume_doc_btn').addEventListener('click',()=> {
    const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_resume_saver.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
      if(this.responseText==="banned"){
        window.location.href="/placement_cell/login/student_login.php";
      }
      else if(this.responseText==true){
          document.getElementById("resume_message").innerHTML=`<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> Your resume is uploaded successfully.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
        document.getElementById('resume_delete_button').style.display="block";
        if(document.getElementById('pdf_viewer').innerHTML==''){
            var adobeDCView = new AdobeDC.View({clientId: AdobeDC_Key, divId: "pdf_viewer"});
        adobeDCView.previewFile(
       {
        content:{ promise: Promise.resolve(_base64ToArrayBuffer(window.resume_data.split(',')[1])) },
          metaData: {fileName: "Resume Preview.pdf"}
       });
        }
    }
    else{
        document.getElementById("resume_message").innerHTML=`<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong> Something went wrong.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
    }
  }
  params2=`{"doc_data":"`+window.resume_data+`"}`;
      xhr2.send(params2);
});
document.getElementById('state').addEventListener('change',function (){
    const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_get_districts.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
      districts=JSON.parse(this.responseText);
      document.getElementById('district').innerHTML=`<option value="">Select District</option>`;
    districts.forEach(district => {
        option=document.createElement('option');
        option.setAttribute('value',district);
        option.innerHTML=district;
        document.getElementById('district').appendChild(option);
    });
    document.getElementById('district').removeAttribute('disabled');
  }
  params2=`{"state":"`+this.value+`"}`;
      xhr2.send(params2);
})
function add_high_school_row() {
    elem=document.getElementById('academics').querySelector('#high-school-performance').querySelector('tbody').querySelector('tr:last-child');
    newSubject=elem.cloneNode(true);
    newSubject.querySelector('th').innerHTML=parseInt(elem.querySelector('th').innerHTML)+1;
    Array.from(newSubject.querySelectorAll('td')).forEach(inp=> {
        inp.innerText="";
    })
    document.getElementById('academics').querySelector('#high-school-performance').querySelector('tbody').appendChild(newSubject);
    elem.querySelector('td:last-child').innerHTML=`<i class="bi bi-x-circle-fill remove_high_school_subject_btn" onclick="remove_high_school_row(this)"></i>`;
    newSubject.querySelector('td:last-child').innerHTML=`<i class="bi bi-plus-circle-fill" id="add_high_school_subject_btn" onclick="add_high_school_row()"></i>`;
}
function add_intermediate_row() {
    elem=document.getElementById('academics').querySelector('#intermediate-performance').querySelector('tbody').querySelector('tr:last-child');
    newSubject=elem.cloneNode(true);
    newSubject.querySelector('th').innerHTML=parseInt(elem.querySelector('th').innerHTML)+1;
    Array.from(newSubject.querySelectorAll('td')).forEach(inp=> {
        inp.innerText="";
    })
    document.getElementById('academics').querySelector('#intermediate-performance').querySelector('tbody').appendChild(newSubject);
    elem.querySelector('td:last-child').innerHTML=`<i class="bi bi-x-circle-fill remove_intermediate_subject_btn" onclick="remove_intermediate_row(this)"></i>`;
    newSubject.querySelector('td:last-child').innerHTML=`<i class="bi bi-plus-circle-fill" id="add_intermediate_subject_btn" onclick="add_intermediate_row()"></i>`;
}
function remove_intermediate_row(e) {
    tr=e.parentNode.parentNode;
    tbody=tr.parentNode;
    all_tr=tbody.querySelectorAll('tr');
    number_of_ele=0;
    for(i=0;i<all_tr.length;i++){
        if(all_tr.item(i)===tr){
            number_of_ele=i+1;
            break;
        }
    }
    tr.remove();
    for(i=number_of_ele;i<all_tr.length;i++){
        document.getElementById('intermediate-performance').querySelector('tbody').querySelector('tr:nth-child('+i+')').querySelector('th').innerHTML=i;
    }
    calc_inter_marks();
}
function remove_high_school_row(e) {
    tr=e.parentNode.parentNode;
    tbody=tr.parentNode;
    all_tr=tbody.querySelectorAll('tr');
    number_of_ele=0;
    for(i=0;i<all_tr.length;i++){
        if(all_tr.item(i)===tr){
            number_of_ele=i+1;
            break;
        }
    }
    tr.remove();
    for(i=number_of_ele;i<all_tr.length;i++){
        document.getElementById('high-school-performance').querySelector('tbody').querySelector('tr:nth-child('+i+')').querySelector('th').innerHTML=i;
    }
    calc_high_marks();
}
function calc_high_marks() {
    totalMarksObtained=0;
    totalMaxMarks=0;
    all_sub=Array.from(document.getElementById('high-school-performance').querySelector('tbody').querySelectorAll('tr'));
    all_sub.forEach(sub=>{
        totalMarksObtained+=parseFloat(sub.querySelector('td:nth-child(3)').innerText);
        totalMaxMarks+=parseFloat(sub.querySelector('td:nth-child(4)').innerText);
    })
    document.getElementById('high-school-total').querySelector('th:nth-child(3)').innerText=totalMarksObtained;
    document.getElementById('high-school-total').querySelector('th:nth-child(4)').innerText=totalMaxMarks;
    document.getElementById('percentage-high-school').value=totalMarksObtained/totalMaxMarks*100;
}
document.getElementById('high-school-performance').querySelector('table').addEventListener('keyup',calc_high_marks);
function calc_inter_marks() {
    totalMarksObtained=0;
    totalMaxMarks=0;
    all_sub=Array.from(document.getElementById('intermediate-performance').querySelector('tbody').querySelectorAll('tr'));
    all_sub.forEach(sub=>{
        totalMarksObtained+=parseFloat(sub.querySelector('td:nth-child(3)').innerText);
        totalMaxMarks+=parseFloat(sub.querySelector('td:nth-child(4)').innerText);
    })
    document.getElementById('intermediate-total').querySelector('th:nth-child(3)').innerText=totalMarksObtained;
    document.getElementById('intermediate-total').querySelector('th:nth-child(4)').innerText=totalMaxMarks;
    document.getElementById('percentage-intermediate').value=totalMarksObtained/totalMaxMarks*100;
}
document.getElementById('intermediate-performance').querySelector('table').addEventListener('keyup',calc_inter_marks);
document.getElementById('biodata-update-btn').addEventListener('click',function () {
    all_invalids=Array.from(this.parentNode.querySelectorAll(':invalid'));
    if(all_invalids.length>0){
        this.parentNode.classList.add('was-validated');
    }
    else{
        const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_save_biodata.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    if(this.responseText==="banned"){
        window.location.href="/placement_cell/login/student_login.php";
    }
     else if(this.responseText==true){
        document.getElementById("biodata_message").innerHTML=`<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> Biodata updated successfully.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
    }
    else{
        document.getElementById("biodata_message").innerHTML=`<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong>Something went wrong.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
      }
  }
  params2=`{"f_name":"`+document.getElementById('first_name').value+`","l_name":"`+document.getElementById('last_name').value+`","c_email":"`+document.getElementById('contact_email').value+`","phone_no":"`+document.getElementById('phone_no').value+`","DOB":"`+document.getElementById('DOB').value+`","gender":"`+document.getElementById('gender').value+`","graduation_institute":"`+document.getElementById('graduation_institute').value+`","course_name":"`+document.getElementById('course_name').value+`","graduation_status":"`+document.getElementById('graduation_status').value+`","address":"`+document.getElementById('address').value+`","state":"`+document.getElementById('state').value+`","district":"`+document.getElementById('district').value+`","city":"`+document.getElementById('city').value+`","pin_code":`+document.getElementById('PIN_Code').value+`,"aadhar_no":`+document.getElementById('aadhar_no').value+`}`;
      xhr2.send(params2);
    }
})
document.getElementById('district').addEventListener('change',function () {
    const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_get_pin_codes.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
      pinCodes=JSON.parse(this.responseText);
      document.getElementById('pinCodes').innerHTML=``;
      for (const key in pinCodes) {
        op=document.createElement('option');
        op.value=pinCodes[key];
        op.innerText=key;
        document.getElementById('pinCodes').appendChild(op);
      }
    document.getElementById('PIN_Code').removeAttribute('disabled');
  }
  params2=`{"state":"`+document.getElementById('state').value+`","district":"`+this.value+`"}`;
      xhr2.send(params2);
})
window.high_school_marksheet="";
window.intermediate_marksheet="";
document.getElementById('high-school-marksheet').addEventListener('input',function (){
    if(document.getElementById('high-school-marksheet').files.length>0){
        this.classList.remove('is-invalid');
    reader=new FileReader();
    reader.onload=function (event){
        window.high_school_marksheet=reader.result;
        var adobeDCView = new AdobeDC.View({clientId: AdobeDC_Key, divId: "high-school-marksheet-preview"});
        adobeDCView.previewFile(
            {
                content:{ promise: Promise.resolve(_base64ToArrayBuffer(reader.result.split(',')[1])) },
                metaData: {fileName: "Hign School Marksheet.pdf"}
            });
            document.getElementById('high-school-marksheet-preview').style.display="block";
        }
        reader.readAsDataURL(document.getElementById('high-school-marksheet').files[0]);
    }
    else{
        document.getElementById('high-school-marksheet-preview').style.display="";
    }
})
document.getElementById('intermediate-marksheet').addEventListener('input',function (){
    if(document.getElementById('intermediate-marksheet').files.length>0){
        this.classList.remove('is-invalid');
        reader=new FileReader();
        reader.onload=function (event){
            window.intermediate_marksheet=reader.result;
            var adobeDCView = new AdobeDC.View({clientId: AdobeDC_Key, divId: "intermediate-marksheet-preview"});
        adobeDCView.previewFile(
       {
        content:{ promise: Promise.resolve(_base64ToArrayBuffer(reader.result.split(',')[1])) },
          metaData: {fileName: "Intermediate Marksheet.pdf"}
       });
       document.getElementById('intermediate-marksheet-preview').style.display="block";
    }
    reader.readAsDataURL(document.getElementById('intermediate-marksheet').files[0]);
    }
    else{
        document.getElementById('intermediate-marksheet-preview').style.display="";
    }
})
function get_marks(std) {
    table=document.getElementById(std+'-performance');
    all_rows=Array.from(table.querySelector('tbody').querySelectorAll('tr'));
    Str=`[`;
    counter=0;
    all_rows.forEach(element => {
        if(counter!=0){
            Str+=`,`;
        }
        Str+=`{"name":"`+element.querySelector(':nth-child(2)').innerText+`","obt":`+parseFloat(element.querySelector(':nth-child(3)').innerText)+`,"max":`+parseFloat(element.querySelector(':nth-child(4)').innerText)+'}';
        counter++;
    });
    return Str+`]`;
}
document.getElementById('academics-upload-btn').addEventListener('click',function () {
    all_contenteditable=Array.from(document.getElementById('academics').querySelectorAll('td[contenteditable=true]'));
    counter=0;
    all_contenteditable.forEach(element => {
        if(element.innerText==""){
            element.classList.add('is-invalid');
            counter++;
            document.getElementById("academics").classList.add("was-validated");
        }
    });
    if(document.getElementById('academics').querySelectorAll(":invalid").length>0){
        counter++;
        document.getElementById("academics").classList.add("was-validated");
    }
    if(counter==0){
        const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_save_academics.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    if(this.responseText==="banned"){
        window.location.href="/placement_cell/login/student_login.php";
    }
     else if(this.responseText==true){
        document.getElementById("academics_message").innerHTML=`<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> Academics uploaded successfully.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
    }
    else{
          document.getElementById("academics_message").innerHTML=`<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong> Something went wrong.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
      }
  }
  if(document.querySelector("input[name=type_of_10plus]:checked").id==="ten_2"){
    ten_plus_type="intermediate";
}
else{
      ten_plus_type="diploma";
  }
  intermediate_board=(ten_plus_type==="intermediate")?(`"`+document.getElementById('intermediate_board').value+`"`):null;
  params2=`{"high_school_marksheet":"`+window.high_school_marksheet+`","intermediate_marksheet":"`+window.intermediate_marksheet+`","high_school_performance":`+get_marks('high-school')+`,"intermediate_performance":`+get_marks('intermediate')+`,"high_school_board":"`+document.getElementById('high_school_board').value+`","high_school_name":"`+document.getElementById('high_school_name').value+`","intermediate_board":`+intermediate_board+`,"ten_plus_institute":"`+document.getElementById('ten_plus_institute').value+`","ten_plus_type":"`+ten_plus_type+`","study_field":"`+document.getElementById('study_field').value+`"}`;
      xhr2.send(params2);
    }
})
document.getElementById('resume_delete_button').addEventListener('click',function () {
    const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_delete_resume.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    if(this.responseText==true){
      document.getElementById('pdf_viewer').innerHTML=``;
      document.getElementById('resume_delete_button').style.display="none";
    }
    else if(this.responseText==="banned"){
        window.location.href="/placement_cell/login/student_login.php";
    }
  }
      xhr2.send();
})