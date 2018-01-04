							
							<title>Register</title>
							
							<form method="POST" action="<?= base_url(); ?>index.php/Register" enctype="multipart/form-data">
							
							<? if(isset($errorList) AND count($errorList) > 0) { ?>
							
							<div class="row">
								<div class="col-xs-8 col-centered">
									<ul class="alert alert-danger fade in" style="padding: 20px 20px 20px 40px;">
									
									<? if(isset($errorList)) { ?>
									
										<? foreach($errorList as $error) { ?>
										
										<li><strong><?= $error; ?></strong></li>
										
										<? } ?>
										
									<? } ?>
									
									</ul>								
								</div>
							</div>
							
							<? } ?>
								
								<? if(isset($success)) { ?>
								<div class="row">
									<div class="col-xs-8 col-centered">
										<ul class="alert alert-success fade in" style="padding: 20px 20px 20px 40px;">
											<li><strong><?= $success ?></strong></li>
										</ul>
									</div>
								</div>
								<? } ?>
							
								<div class="row">
									<div class="col-sm-6 col-md-4">
										<span class="h3">Account Information</span>

										<br>
										<br>
												
										<div class="form-group">
											<label for="register-email">Email</label>
											<input type="email" class="form-control" id="register-email" name="register-email" placeholder="Email" value="<? if(isset($email)) echo $email; ?>" required />
										</div>
													
										<div class="form-group">
											<label for="confirm-email">Confirm Email</label>
											<input type="email" class="form-control" id="confirm-email" name="confirm-email" placeholder="Re-enter Email" value="<? if(isset($confirm_email)) echo $confirm_email; ?>" required />
										</div>
												
										<div class="form-group">
											<label for="register-password">Password</label>
											<input type="password" class="form-control" id="register-password" name="register-password" placeholder="Password" value="<? if(isset($password)) echo $password; ?>" required />
										</div>
													
										<div class="form-group">
											<label for="confirm-password">Confirm Password</label>
											<input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Re-enter Password" value="<? if(isset($confirm_password)) echo $confirm_password; ?>" required />
										</div>

										<div class="form-group">
											<label for="picture">Profile Picture</label>
											<img class="thumbnail" style="width: 100%;" src="<?= assetUrl(); ?>img/no_image.png" id="register-preview-image" />
											<input class="form-control" type="file" id="register-picture" name="register-picture" />
										</div>
											
										<br>
									</div>
												
									<div class="col-sm-6 col-md-4">
										<span class="h3 personal">Personal Information</span>

										<br>
										<br>

										<div class="form-group">
											<label for="first-name">First Name</label>
											<input type="text" class="form-control" id="first-name" name="first-name" placeholder="First Name" value="<? if(isset($first_name)) echo $first_name; ?>" />
										</div>
													
										<div class="form-group">
											<label for="last-name">Last Name</label>
											<input type="text" class="form-control" id="last-name" name="last-name" placeholder="Last Name" value="<? if(isset($last_name)) echo $last_name; ?>" />
										</div>
										
										<br>
									</div>
									
									<div class="col-sm-6 col-md-4">
										<span class="h3">Password Reset Information</span>

										<br>
										<br>
										
										<div class="form-group">
											<label for="security-question">Security Question</label>
											<select class="form-control" id="security-question" name="security-question" required>
											
												<? foreach($security_Questions as $question) { ?>
												<option value="<?= $question["security_question_id"]; ?>"><?= $question["question"]; ?></option>
												<? } ?>
											</select>
										</div>
													
										<div class="form-group">
											<label for="answer">* Answer</label>
											<input class="form-control" type="password" id="answer" name="answer" value="<? if(isset($answer)) echo $answer; ?>" required />
										</div>
									</div>
								</div>
								
								<br>

								<div class="row">
									<div class="col-xs-1 col-centered">
										<button type="submit" class="btn btn-success">Register</button>
									</div>
								</div>					
							</form>