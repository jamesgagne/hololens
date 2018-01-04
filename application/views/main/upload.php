
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
<script>
  var fileCount = 0;
function drag_drop(event) {
    event.preventDefault();
    jQuery.each(event.dataTransfer.files,function(element){ 
      $("#files").append("<fieldset id='"+fileCount+"'> <h2>"+event.dataTransfer.files[element].name+"</h2>Add a Description &nbsp;<input type='text' name='"+fileCount+"["+event.dataTransfer.files[element].name+"]description' /> <br />Select a thumbnail &nbsp;<input required type='file' name='"+fileCount+"["+event.dataTransfer.files[element].name+"]thumbFile' /></br></fieldset");
      fileCount ++;
    });    
}
function changedFileUpload(e){
  var control = document.getElementById("your-files");
   jQuery.each(control.files,function(element){ 
      $("#files").append("<fieldset id='"+fileCount+"'> <h2>"+control.files[element].name+"</h2>Add a Description &nbsp;<input type='text' name='"+fileCount+"["+control.files[element].name+"]description' /> <br />Select a thumbnail &nbsp;<input required type='file' name='"+fileCount+"["+control.files[element].name+"]thumbFile' /></br></fieldset");
      fileCount++;
    });
}
</script>
<div id="drop_zone" ondrop="drag_drop(event)" ondragover="return false"><div id="makeSelection">Drag And Drop or<br /><input style="border: 2px dashed #999;" type='file' multiple="true" onchange="changedFileUpload(event)" id="your-files" /></div></div>
<form id="files" enctype ='multipart/form-data' action="<?=base_url()?>index.php/Upload/newFile" method="post">
  <br />
  <button type="submit">Upload</button>
  <br />
    </div>
  </div>
  

