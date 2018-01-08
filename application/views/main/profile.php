
<title>My Profile</title>

<form method="POST" action="<?= base_url(); ?>index.php/Profile" enctype="multipart/form-data">

<?php if(isset($errorList) AND count($errorList) > 0) { ?>

<div class="row">
	<div class="col-xs-8 col-centered">
		<ul class="alert alert-danger fade in" style="padding: 20px 20px 20px 40px;">
		
		<?php if(isset($errorList)) { ?>
		
			<?php foreach($errorList as $error) { ?>
			
			<li><strong><?= $error; ?></strong></li>
			
			<?php } ?>
			
		<?php } ?>
		
		</ul>								
	</div>
</div>

<?php } ?>

	<?php if(isset($success)) { ?>
	<div class="row">
		<div class="col-xs-8 col-centered">
			<ul class="alert alert-success fade in" style="padding: 20px 20px 20px 40px;">
				<li><strong><?= $success ?></strong></li>
			</ul>
		</div>
	</div>
	<?php } ?>

	<div class="row">
		<div class="col-sm-6 col-md-4">
			<span class="h3">Account Information</span>

			<br>
			<br>
					
			<div class="form-group">
				<label for="register-email">Email</label>
				<p><?php echo $this->userauthor->GetEmail();?></p>
				<input type="email" class="form-control" id="update-email" name="update-email" placeholder="Change Email" value="<?php if(isset($email)) echo $email; ?>"/>
			</div>

<div class="form-group">
				<label for="first-name">First Name</label>
				<input type="text" class="form-control" id="first-name" name="first-name" placeholder="Change First Name" value="<?php if(isset($first_name)) echo $first_name; ?>" />
			</div>
						
			<div class="form-group">
				<label for="last-name">Last Name</label>
				<input type="text" class="form-control" id="last-name" name="last-name" placeholder="Change Last Name" value="<?php if(isset($last_name)) echo $last_name; ?>" />
			</div>

			<div class="form-group">
				<label for="picture">Profile Picture</label>
				<img class="thumbnail" style="width: 100%;" src="<?= assetUrl(); ?>img/no_image.png" id="update-preview-image" />
				<input class="form-control" type="file" id="update-picture" name="update-picture" />
			</div>
				 
			<br>
		</div>
	
	<br>
</div>	

	<div class="row">
		<div class="col-sm-6">
			<button type="submit" class="btn btn-success">Save Profile Details</button>
		</div>
	</div>	
	</form>
	<br />
	<a href="<?= base_url(); ?>index.php/Reset">Reset Password</a>
