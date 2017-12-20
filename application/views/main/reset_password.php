
							<div class="row">
								<div class="col-xs-6 col-sm-5 col-md-5 col-lg-4 col-centered">
									<? if(isset($Error)) { ?>
									<div class="row text-center" style="color: green;">
										<p><?= $Success; ?></p>
									</div>
									<? } ?>
								
									<? if(isset($Error)) { ?>
									<div class="row text-center" style="color: red;">
										<p><?= $Error; ?></p>
									</div>
									<? } ?>
								
									<div class="row text-center">
										<span class="h2">Forgotten Password</span>				
									</div>
									
									<br>

									<div class="row text-center">
										<span class="h4">Step 3: Please enter your new password.</span>
									</div>

									<br>
									
									<form action="<?= base_url(); ?>index.php/Reset" method="POST">
										<div class="row form-group">
											<label for="password-reset">New Password</label>
											<input type="text" name="password-reset" id="password-reset" class="form-control" placeholder="Password" />
										</div>

										<div class="row form-group">
											<label for="confirm-password-reset">Confirm Password</label>
											<input type="text" name="confirm-password-reset" id="password-reset-confirm" class="form-control" placeholder="Confirm Password" />
										</div>

										<div class="row form-group">				
											<input type="submit" class="form-control btn btn-success" value="Change Password">
										</div>
									</form>
								</div>
							</div>