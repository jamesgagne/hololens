
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
fieldset{
  border: 1px dashed black;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?= ini_get("upload_max_filesize");?>
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
        if (getType(event.dataTransfer.files[element].name)=="fbx"){

    var colorSelect = "Select a Color: <select class='select' name='colors' id='"+fileCount+"color' style='width:10%;'><option value='' disabled selected>Select</option>";
                
                <?php foreach ($colors as $key => $value) :?>
                colorSelect+="<option value='<?=$value['color_id']?>'> <?=$value['name']?></option>";
                <?php endforeach?>
    colorSelect+="</select><br />";

        var catSelect = "Select a Category: <select class='select' name='colors' id='"+fileCount+"category' style='width:10%;'><option value='' disabled selected>Select</option>";
                
                <?php foreach ($categories as $key => $value) :?>
                catSelect+="<option value='<?=$value['category_id']?>'> <?=$value['name']?></option>";
                <?php endforeach?>
        catSelect+="</select><br />";

      $("#files").append("<fieldset id='"+fileCount+"'> <h2>"+event.dataTransfer.files[element].name+"</h2>Add a Description &nbsp;<input type='text' name='"+event.dataTransfer.files[element].name+"[description]' id='"+fileCount+"description' /> <br /><br />Select a thumbnail &nbsp;<input required type='file' name='"+event.dataTransfer.files[element].name+"[thumbFile]' id='"+fileCount+"thumbFile' /><br />"+colorSelect+"<br />"+catSelect+"<br /></fieldset>");
      uploadedModels.push(event.dataTransfer.files[element]);
      console.log(event.dataTransfer.files[element].type);
      fileCount ++;
    }
    else{
      alert(event.dataTransfer.files[element].name+" is not of type fbx");
    }
    });
    console.log(uploadedModels);    
}
function changedFileUpload(e){
  var control = document.getElementById("your-files");
   jQuery.each(control.files,function(element){
    
    if (getType(control.files[element].name)=="fbx"){
   var colorSelect = "Select a Color: <select class='select' name='colors' id='"+fileCount+"color' style='width:10%;'><option value='' disabled selected>Select</option>"; 

   <?php foreach ($colors as $key => $value) :?>
                colorSelect+="<option value='<?=$value['color_id']?>'> <?=$value['name']?></option>";
        <?php endforeach?>
        colorSelect+="</select><br />";
  var catSelect = "Select a Category: <select class='select' name='colors' id='"+fileCount+"category' style='width:10%;'><option value='' disabled selected>Select</option>";
                
                <?php foreach ($categories as $key => $value) :?>
                catSelect+="<option value='<?=$value['category_id']?>'> <?=$value['name']?></option>";
                <?php endforeach?>
        catSelect+="</select><br />";
      $("#files").append("<fieldset id='"+fileCount+"'> <h2>"+control.files[element].name+"</h2>Add a Description &nbsp;<input type='text' name='"+control.files[element].name+"[description]' id='"+fileCount+"description' /> <br /><br />Select a thumbnail &nbsp;<input required type='file' name='"+control.files[element].name+"[thumbFile]' id='"+fileCount+"thumbFile' /><br />"+colorSelect+"</br>"+catSelect+"<br /></fieldset>");
      uploadedModels.push(control.files[element]);
      console.log(control.files[element].type);
      fileCount++;
    }
    else{
      alert(control.files[element].name+" is not type fbx");
    }
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
    form_data.append("color",$('#'+element+'color').val());
    form_data.append("category",$('#'+element+'category').val());
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
                  if ('newModelID' in arr){
                    var newID = arr.newModelID;
                    var form_data = new FormData();
                    file_data = $('#'+element+"thumbFile").prop('files')[0];
                    form_data.append('model_id', newID);
                    form_data.append("thumb",file_data);
                    $.ajax({
                        url: 'Upload/addThumb', // point to server-side PHP script 
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function (data)
                        {
                            console.log(data);
                        }
                      });

                  }
                  else{
                    alert("An error was encounter uploading file: "+uploadedModels[element].name+" please try this one again");
                  }
                }

    });
   });
       
});
function getType(str) {
    return str.split('.')[1];
}

</script>

