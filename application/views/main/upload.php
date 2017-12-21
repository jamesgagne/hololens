  
  <div class="col-lg-10">     
 <br />
    <h2>Upload Files</h2>
    <?php $attributes = array('enctype' => 'multipart/form-data'); ?>
      <?= form_open('Upload/newFile', $attributes) ?>
      <div class="form-group">

  <?= form_error('fbx'); ?>
<?= form_label('Click to upload:', 'fbx'); ?> 
<?= form_input(array('type'=>'file','name' => 'fbx',
 'id' => 'fbx', 'value'=> set_value('fbx'))); ?> 
 </div>
 <div class="form-group">
<?= form_submit(array('name'=>'submit', 'value'=>'Submit', 'class'=>"btn btn-success")); ?>
<?= form_close() ?>
    </div>
  </div>

<script type="text/javascript">
  $(document).ready(function(){
    <?php if ($uploadsuccess):?>
    alert("Upload Success");
    <?php endif ?>
  });

</script>