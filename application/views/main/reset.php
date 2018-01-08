
							<div class="row">
								<div class="col-xs-6 col-sm-5 col-md-5 col-lg-4 col-centered">
								
									<?php if(isset($Error)) { ?>
									
									<div class="alert alert-danger fade in" style="padding: 20px 20px 20px 40px;">
										<p><?= $Error; ?></p>
									</div>
									
									<?php } ?>
								
									<div class="row text-center">
										<span class="h2">Reset Password</span>				
									</div>
									
									<br>

									<div class="row text-center">
										<span class="h4">Step 1: Please enter your account email.</span>
									</div>

									<br>
									
									<form action="<?= base_url(); ?>index.php/Reset" method="POST">
										<div class="row form-group">
											<label for="email-reset">Email</label>
											<input required type="email" name="email-reset" id="email-reset" class="form-control" placeholder="Email" />
										</div>

										<div class="row form-group">				
											<div class="col-xs-4 pull-right">
												<input type="submit" class="form-control btn btn-success" value="Next">
											</div>
										</div>
									</form>
								</div>
							</div>