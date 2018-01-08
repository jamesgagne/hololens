
							<div class="row">
								<div class="col-xs-6 col-sm-5 col-md-5 col-lg-4 col-centered">
								
									<?phpif(isset($Success)) { ?>
									
									<div class="alert alert-success fade in" style="padding: 20px 20px 20px 40px;">
										<p><?= $Success; ?></p>
									</div>
									
									<?php } ?>
								
									<? if(isset($Error)) { ?>
									
									<div class="alert alert-danger fade in" style="padding: 20px 20px 20px 40px;">
										<p><?= $Error; ?></p>
									</div>
									
									<?php } ?>
								
									<div class="row text-center">
										<span class="h2">Forgotten Password</span>				
									</div>
									
									<br>

									<div class="row text-center">
										<span class="h4">Step 3: Please enter your new password.</span>
									</div>

									<br>
									
									<form action="<?= base_url(); ?>index.php/Reset" method="POST">
										<input type="hidden" name="email-reset" value="<?= $Email; ?>" />
									
										<div class="row form-group">
											<label for="password-reset">New Password</label>
											<input required type="password" name="password-reset" id="password-reset" class="form-control" placeholder="Password" />
										</div>

										<div class="row form-group">
											<label for="confirm-password-reset">Confirm Password</label>
											<input required type="password" name="confirm-password-reset" id="password-reset-confirm" class="form-control" placeholder="Confirm Password" />
										</div>

										<div class="row form-group">				
											<input type="submit" class="form-control btn btn-success" value="Change Password">
										</div>
									</form>
								</div>
							</div>