
 <div class="row" >
  <div class="col-lg-12">     
 <style>

#drop_zone {
    background-color: #EEE; 
    border: #999 5px dashed;
    width:100%;
    margin: auto;
    height: 200px;
    padding: 8px;
    font-size: 18px;
}
#makeSelection{
  width:35%;
  margin: auto;
  text-align: center;
  margin-top: 5%
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div id="drop_zone" ondrop="drag_drop(event)" ondragover="return false"><div id="makeSelection">Drag And Drop or<br /><input style="border: 2px dashed #999;" type='file' multiple="true" onchange="changedFileUpload(event)" id="your-files" /></div></div>
<form id="files" enctype ='multipart/form-data' method="post">
  <br />
  <button id="formButton" type="submit">Upload</button>
  <br />
    </div>
  </div>
  <script>
  var fileCount = 0;
  var uploadedModels = [];
function drag_drop(event) {
    event.preventDefault();
    jQuery.each(event.dataTransfer.files,function(element){ 
      $("#files").append("<fieldset id='"+fileCount+"'> <h2>"+event.dataTransfer.files[element].name+"</h2>Add a Description &nbsp;<input type='text' name='"+event.dataTransfer.files[element].name+"[description]' id='"+fileCount+"description' /> <br />Select a thumbnail &nbsp;<input required type='file' name='"+event.dataTransfer.files[element].name+"[thumbFile]' id='"+fileCount+"thumbFile' /></br></fieldset");
      uploadedModels.push(event.dataTransfer.files[element]);
      fileCount ++;
    });
    console.log(uploadedModels);    
}
function changedFileUpload(e){
  var control = document.getElementById("your-files");
   jQuery.each(control.files,function(element){ 
      $("#files").append("<fieldset id='"+fileCount+"'> <h2>"+control.files[element].name+"</h2>Add a Description &nbsp;<input type='text' name='"+control.files[element].name+"[description]' id='"+fileCount+"description' /> <br />Select a thumbnail &nbsp;<input required type='file' name='"+control.files[element].name+"[thumbFile]' id='"+fileCount+"thumbFile' /></br></fieldset");
      uploadedModels.push(control.files[element]);
      fileCount++;
    });
   console.log(uploadedModels);
}

$("#formButton").click(function(event){
    event.preventDefault();
   jQuery.each(uploadedModels,function(element){
    var form_data = new FormData();
    form_data.append("model",uploadedModels[element]);
console.log($('#'+element+'description').val());
    //console.log($('#'+uploadedModels[element].name+'[description]').val());
    form_data.append("description",$('#'+element+'description').val());
    $.ajax({
                url: 'Upload/addnew', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function (data)
                {
                  console.log(data); 
                  var arr = JSON.parse(data);
                  if (arr.success){
                    var newID = arr.newModelID;


                  }
                }

    });
   });
   alert("thumbz not uploaded yet");
   location.reload();
       
});

    /*var file_data = $('#image').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    form_data.append('name', $('#name').val());
    form_data.append('description', $('#description').val());
    form_data.append('purchase_rate', $('#purchase_rate').val());
    form_data.append('selling_rate', $('#selling_rate').val());
    form_data.append('stock', $('#stock').val());
    form_data.append('upc', $('#upc').val());
    form_data.append('sku', $('#sku').val());
    form_data.append('mpn', $('#mpn').val());                        
    /*$.ajax({
                url: 'index.php/Products/addnew', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function (data)
  {
    console.log(data);
    var arr = JSON.parse(data);
    if (arr['validated'] && arr['sucess']){
      alert("Added Successfully");
      location.reload();
    }
    else if(arr['validated'] && arr['sucess']){
      alert(arr['error']);
    }
    else{
     $.each(arr['errors'], function( index, value ) {
      $("#error"+index).html(value);*/


</script>

