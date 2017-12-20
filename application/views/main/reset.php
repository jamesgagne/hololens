
							<div class="row">
								<div class="col-xs-6 col-sm-5 col-md-5 col-lg-4 col-centered">
									<? if(isset($Error)) { ?>
									<div class="row text-center" style="color: red;">
										<p><?= $Error; ?></p>
									</div>
									<? } ?>
								
									<div class="row text-center">
										<span class="h2">Reset Password</span>				
									</div>
									
									<br>

									<div class="row text-center">
										<span class="h4">Step 1: Please enter your account username.</span>
									</div>

									<br>
									
									<form action="<?= base_url(); ?>index.php/Reset" method="POST">
										<div class="row form-group">
											<label for="username-reset">Username</label>
											<input type="text" name="username-reset" id="username-reset" class="form-control" placeholder="Username" />
										</div>

										<div class="row form-group">				
											<div class="col-xs-4 pull-right">
												<input type="submit" class="form-control btn btn-success" value="Next">
											</div>
										</div>
										
										<? print_r($_POST); ?>
									</form>
								</div>
							</div>