
							<div class="row">
								<div class="col-xs-6 col-sm-5 col-md-5 col-lg-4 col-centered">
								
									<? if(isset($Error)) { ?>
									
									<div class="alert alert-danger fade in" style="padding: 20px 20px 20px 40px;">
										<p><?= $Error; ?></p>
									</div>
									
									<? } ?>
								
									<div class="row text-center">
										<span class="h2">Forgotten Password</span>				
									</div>
									
									<br>

									<div class="row text-center">
										<span class="h4">Step 2: Please answer your security question to continue.</span>
									</div>

									<br>
									
									<form action="<?= base_url(); ?>index.php/Reset" method="POST">
										<input type="hidden" name="email-reset" value="<?= $Email; ?>" />
										<input type="hidden" name="question" value="<?= $Question; ?>" />
									
										<div class="row form-group">
											<label>Question:</label>
											<p><?= $Question; ?></p>
										</div>
									
										<div class="row form-group">
											<label for="answer">Answer</label>
											<input required type="password" name="answer" id="answer" class="form-control" placeholder="Answer" />
										</div>

										<div class="row form-group">				
											<div class="col-xs-4 pull-right">
												<input type="submit" class="form-control btn btn-success" value="Next">
											</div>
										</div>
									</form>
								</div>
							</div>