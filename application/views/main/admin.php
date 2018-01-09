
<title>Administration</title>
              
<div class="x_panel">

<?php if(isset($Error)) { ?>

<div class="alert alert-danger fade in">
<?php if(isset($Error)) echo $Error; ?>
</div>

<?php } ?>

<div class="x_title">
  <h2>User Management</h2>
</div>

<?php if (isset($update)) { ?>
<?php echo form_open(base_url() . 'index.php/Admin/updateentry/' . $entry['user_id'], array("class" => "form-horizontal")) ?>
<fieldset style = "display: inline-block;">
  <!-- Text input-->
  <div class="form-group updateForm adminpage">
  <label class="col-sm-4 control-label" for="textinput">Email</label>
  <div class="col-sm-4">
    <input type="email" placeholder="Email" class="form-control" id = "emailAdmin" name = "email" value = "<?=$entry['email']; ?>">
  </div>
  </div>
  
    <!-- Text input-->
  <div class="form-group updateForm adminpage">
  <label class="col-sm-4 control-label" for="textinput">First Name</label>
  <div class="col-sm-4">
    <input type="text" maxlength = "35" placeholder="First Name" class="form-control" name = "firstName" value = "<?=$entry['first_name']; ?>">
  </div>
  </div>
  
    <!-- Text input-->
  <div class="form-group updateForm adminpage">
  <label class="col-sm-4 control-label" for="textinput">Last Name</label>
  <div class="col-sm-4">
    <input type="text" maxlength = "35" placeholder="Last Name" class="form-control" name = "lastName" value = "<?=$entry['last_name']; ?>">
  </div>
  </div>

  <!-- Text input-->
  <div class="form-group updateForm adminpage">
  <label class="col-sm-4 control-label" for="accessLevelUpdate">Access Level</label>
  <div class="col-sm-4">
    
    <select id="accessLevelUpdate" name="accessLevel" class="form-control">
    
    <?php foreach($AccessLevels as $level) { ?>
    
    <option <?php if($entry["access_level_id"] == $level["access_level_id"]) echo "selected"; ?> value="<?= $level["access_level_id"]; ?>"><?= $level["name"]; ?></option>
    
    <?php } ?>
    
  </select>
    
  </div>
  </div>

  <input type="submit" id ='submitAdmin' class="btn btn-primary" value="Update User">
</fieldset>
<?php echo form_close() ?>
<?php } ?>

<?php if (isset($updateColor)) { ?>
<?php echo form_open(base_url() . 'index.php/Admin/updateentryColor/' . $entryColor['color_id'], array("class" => "form-horizontal")) ?>
<fieldset style = "display: inline-block;">

    <!-- Text input-->
  <div class="form-group updateForm adminpage">
  <label class="col-sm-4 control-label" for="textinput">Color Name</label>
  <div class="col-sm-4">
    <input type="text" maxlength = "35" placeholder="Color" class="form-control" name = "colorName" value = "<?=$entryColor['name']; ?>">
  </div>
  </div>

  <input type="submit" id ='submitAdmin' class="btn btn-primary" value="Update Color">
</fieldset>
<?php echo form_close() ?>
<?php } ?>

<?php if (isset($updateCategory)) { ?>
<?php echo form_open(base_url() . 'index.php/Admin/updateentryCategory/' . $entryCategory['category_id'], array("class" => "form-horizontal")) ?>
<fieldset style = "display: inline-block;">

    <!-- Text input-->
  <div class="form-group updateForm adminpage">
  <label class="col-sm-4 control-label" for="textinput">Category Name</label>
  <div class="col-sm-4">
    <input type="text" maxlength = "35" placeholder="Category" class="form-control" name = "categoryName" value = "<?=$entryCategory['name']; ?>">
  </div>
  </div>

  <input type="submit" id ='submitAdmin' class="btn btn-primary" value="Update Category">
</fieldset>
<?php echo form_close() ?>
<?php } ?>

  <div class="x_content">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add User</button>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcolorModal">Add Color</button>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategory">Add Category</button>

    <br>
    <br>
    
    <table id = "room">
       <tr>  
       <th>ID</th>
       <th>Email</th>
       <th>First Name</th>
       <th>Last Name</th>
       <th>Access Level</th>
       <th></th>
       </tr>
      <?php foreach ($listing as $row) { ?>
       <tr>
       <td><?= $row['user_id']; ?></td>
       <td><?= $row['email']; ?></td>
       <td><?= $row['first_name']; ?></td>
       <td><?= $row['last_name']; ?></td>
       <td><?= $row['name']; ?></td>
       <td>
        <a href="<?= base_url() ?>index.php/Admin/delete/<?= $row['user_id']; ?>"><span class="pull-left glyphicon glyphicon-trash"></span></a>
        <a href="<?= base_url() ?>index.php/Admin/update/<?= $row['user_id']; ?>"><span class="pull-right glyphicon glyphicon-pencil"></span></a>
       </td>
       </tr>
      <?php } ?>
    </table>
    
    <div class="x_title">
      <h2>Color Management</h2>
    </div>
    
    <table id = "room">
       <tr>  
       <th>ID</th>
       <th style="padding-right: 420px;">Color</th>
       <th style="width: 115px;"></th>
       </tr>
      <?php foreach ($listingColor as $r) { ?>
       <tr>
       <td><?= $r['color_id']; ?></td>
       <td><?= $r['name']; ?></td>
       <td>
        <a href="<?= base_url() ?>index.php/Admin/deleteColor/<?= $r['color_id']; ?>"><span class="pull-left glyphicon glyphicon-trash"></span></a>
        <a href="<?= base_url() ?>index.php/Admin/updateColor/<?= $r['color_id']; ?>"><span class="pull-right glyphicon glyphicon-pencil"></span></a>
       </td>
       </tr>
      <?php } ?>
    </table>
    
    <div class="x_title">
      <h2>Category Management</h2>
    </div>
    
    <table id = "room">
       <tr>  
       <th>ID</th>
       <th style="padding-right: 420px;">Category</th>
       <th style="width: 115px;"></th>
       </tr>
      <?php foreach ($listingCategory as $r) { ?>
       <tr>
       <td><?= $r['category_id']; ?></td>
       <td><?= $r['name']; ?></td>
       <td>
        <a href="<?= base_url() ?>index.php/Admin/deleteCategory/<?= $r['category_id']; ?>"><span class="pull-left glyphicon glyphicon-trash"></span></a>
        <a href="<?= base_url() ?>index.php/Admin/updateCategory/<?= $r['category_id']; ?>"><span class="pull-right glyphicon glyphicon-pencil"></span></a>
       </td>
       </tr>
      <?php } ?>
    </table>
  </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add User</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(base_url() . 'index.php/Admin/add_user', array("class" => "form-horizontal")) ?>
      <fieldset>
      <!-- Text input-->
          <div class="form-group adminpage">
            <label class="col-sm-3 control-label" for="textinput">Email</label>
            <div class="col-sm-9">
              <input autocomplete="off" type="email" placeholder="Email" class="form-control" id = "emailModal" name = "emailModal" required>
            </div>
          </div>
    
          <!-- Text input-->
          <div class="form-group adminpage">
            <label class="col-sm-3 control-label" for="textinput">First Name</label>
            <div class="col-sm-9">
              <input autocomplete="off" type="text" maxlength = "35" placeholder="First Name" class="form-control" name = "firstName" required>
            </div>
          </div>
      
      <!-- Text input-->
          <div class="form-group adminpage">
            <label class="col-sm-3 control-label" for="textinput">Last Name</label>
            <div class="col-sm-9">
              <input autocomplete="off" type="text" maxlength = "35" placeholder="Last Name" class="form-control" name = "lastName" required>
            </div>
          </div>

           <!-- Text input-->
          <div class="form-group adminpage">
            <label class="col-sm-3 control-label" for="textinput">Password</label>
            <div class="col-sm-9">
              <input autocomplete="off" type="password" placeholder="Password" class="form-control" id = "passwordModal" name = "passwordModal" required>
            </div>
          </div>

      <!-- Select input-->
          <div class="form-group adminpage">
            <label class="col-sm-3 control-label" for="accessLevelAdd">Access Level</label>
            <div class="col-sm-9">
      <select name="accessLevel" id="accessLevelAdd" class="form-control">
    
      <?php foreach($AccessLevels as $level) { ?>
      
      <option <?php if($entry["access_level_id"] == $level["access_level_id"]) echo "selected"; ?> value="<?= $level["access_level_id"]; ?>"><?= $level["name"]; ?></option>
      
      <?php } ?>
      
      </select>
            </div>
          </div>

      </div>
        </fieldset>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Add User ">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addcolorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Color</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(base_url() . 'index.php/Admin/add_color', array("class" => "form-horizontal")) ?>
      <fieldset>
          <!-- Text input-->
          <div class="form-group adminpage">
            <label class="col-sm-2 control-label" for="textinput">Color</label>
            <div class="col-sm-10">
              <input type="text" maxlength = "30" placeholder="Color" class="form-control" name = "colorModal" id = "colorModal" required>
            </div>
          </div>
      </div>
        </fieldset>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Add Color ">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Category</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(base_url() . 'index.php/Admin/add_category', array("class" => "form-horizontal")) ?>
      <fieldset>
          <!-- Text input-->
          <div class="form-group adminpage">
            <label class="col-sm-2 control-label" for="textinput">Category</label>
            <div class="col-sm-10">
              <input type="text" maxlength = "30" placeholder="Category" class="form-control" name = "categoryModal" id = "categoryModal" required>
            </div>
          </div>
      </div>
        </fieldset>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Add Category ">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addSpace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Space</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(base_url() . 'index.php/Admin/add_space', array("class" => "form-horizontal")) ?>
      <fieldset>
    
      <select class="form-control" name="emailList" id="emailList" required>
            <?php 

            foreach($emails as $row)
            { 
              echo '<option value="'.$row['email'].'">'.$row['email'].'</option>';
            }
            ?>
          </select>
      
          <!-- Text input-->
          <div class="form-group adminpage">
            <label class="col-sm-2 control-label" for="textinput">Space Name</label>
            <div class="col-sm-10">
              <input type="text" maxlength = "35" placeholder="Name" class="form-control" name = "nameSpace" id = "nameSpace" required>
            </div>
          </div>
      
      <div class="form-group adminpage">
      <label class="col-sm-2 control-label" for="textinput">Description</label>
      <div class="col-sm-10">
        <textarea rows="4" cols="50" id="descriptionSpace" name="descriptionSpace"></textarea>
      </div>
      </div>
      </div>
        </fieldset>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Add Space ">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
