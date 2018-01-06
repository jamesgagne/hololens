
<title>Administration</title>
							
<div class="x_panel">
<div class="x_title">
	<h2>Student Management</h2>
	<ul class="nav navbar-right panel_toolbox">
	  <li><a data-toggle="modal" href="#addModal"><i class="fa fa-plus"></i></a>
	  </li>
	</ul>
</div>
<?php if (isset($update)) { ?>
<?php echo form_open(base_url() . 'index.php/Admin/updateentry/' . $entry['user_id'], array("class" => "form-horizontal")) ?>
<fieldset style = "display: inline-block;">
  <!-- Text input-->
  <div class="form-group updateForm">
	<label class="col-sm-4 control-label" for="textinput">Name</label>
	<div class="col-sm-4">
	  <input type="text" maxlength = "35" placeholder="Name" class="form-control" name = "name" id = "name" value = "<?=$entry['name']?>">
	</div>
  </div>

  <!-- Text input-->
  <div class="form-group updateForm">
	<label class="col-sm-4 control-label" for="textinput">Email</label>
	<div class="col-sm-4">
	  <input type="email" placeholder="Email" class="form-control" id = "email" name = "email" value = "<?=$entry['email']?>">
	</div>
  </div>

  <!-- Text input-->
  <div class="form-group updateForm">
	<label class="col-sm-4 control-label" for="textinput">Role</label>
	<div class="col-sm-4">
	  <input type="number" max = "1" min = "0" class="form-control" id = "role" name = "role" value = "<?=$entry['access_level_id']?>">
	</div>
  </div>

  <input type="submit" id ='submit' class="btn btn-primary" value="Update User">
</fieldset>
<?php echo form_close() ?>
<?php } ?>
	<div class="x_content">
		<button style="float:right;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
		  Add User
		</button>
		<button style="float:right; margin-right: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSpace">
		  Add Space
		</button>

		<table id = "room">
		   <tr>  
			 <th>ID</th>
			 <th>Name</th>
			 <th>Email</th>
			 <th>Access Level</th>
			 <th>D</th>
			 <th>U</th>
		   </tr>
		  <?php foreach ($listing as $row) { ?>
		   <tr>
		   <td><?= $row['user_id']?></td>
		   <td><?= $row['name']?></td>
		   <td><?= $row['email']?></td>
		   <td><?= $row['access_level_id']?></td>
		   <td><a href="<?= base_url() ?>index.php/Admin/delete/<?= $row['user_id']?>">D</a></td>
		   <td><a href="<?= base_url() ?>index.php/Admin/update/<?= $row['user_id']?>">U</a></td>
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
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Name</label>
            <div class="col-sm-10">
              <input type="text" maxlength = "35" placeholder="Name" class="form-control" name = "nameModal" id = "nameModal">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Email</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Email" class="form-control" id = "emailModal" name = "emailModal">
            </div>
          </div>

           <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Password</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Password" class="form-control" id = "passwordModal" name = "passwordModal">
            </div>
          </div>

           <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Role</label>
            <div class="col-sm-10">
              <input type="number" placeholder="Role" max = "1" min = "0" class="form-control" id = "roleModal" name = "roleModal">
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
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Space Name</label>
            <div class="col-sm-10">
              <input type="text" maxlength = "35" placeholder="Name" class="form-control" name = "nameSpace" id = "nameSpace" required>
            </div>
          </div>
		  
		  <div class="form-group">
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