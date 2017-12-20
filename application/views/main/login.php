							
							<div class="row">
								<div class="col-xs-6 col-md-4 col-lg-4 col-centered">
									<ul>
									<? foreach($errorList as $error) { ?>
									
										<li><?= $error; ?></li>
									<? } ?>
									
									</ul>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-5 col-lg-3 col-centered">
									<div class="text-center">
										<span class="h2">Log In</span>				
									</div>
									
									<form action="<?= base_url(); ?>index.php/Login" method="POST">
										<div class="form-group">
											<label for="username">Username</label>
											<input type="text" name="login-username" id="login-username" tabindex="1" class="form-control" placeholder="Username" value="" autocomplete="off">
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
