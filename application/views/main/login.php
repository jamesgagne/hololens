							<title>Login</title>

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
							
							<div class="row">
								<div class="col-xs-5 col-lg-3 col-centered">
									<div class="text-center">
										<span class="h2">Log In</span>				
									</div>
									
									<form action="<?= base_url(); ?>index.php/Login" method="POST">
										<div class="form-group">
											<label for="login-email">Email</label>
											<input type="text" name="login-email" id="login-email" tabindex="1" class="form-control" placeholder="Username" value="" autocomplete="off">
										</div>

										<div class="form-group">
											<label for="password">Password</label>
											<input type="password" name="login-password" id="login-password" tabindex="2" class="form-control" placeholder="Password" autocomplete="off">
										</div>

										<div class="form-group">
											<div class="row">												
												<div class="col-xs-6 col-centered">
													<input type="submit" name="login-submit" id="login-submit" tabindex="3" class="form-control btn btn-success" value="Log In">
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-lg-12">
													<div class="text-center">
														<a href="<?= base_url(); ?>index.php/Reset" tabindex="4">Forgot Password?</a>
													</div>
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-lg-12">
													<div class="text-center">
														<a href="<?= base_url(); ?>index.php/Register" tabindex="5">Create Account?</a>
													</div>
												</div>
											</div>
										</div>

									</form>
								</div>
							</div>
