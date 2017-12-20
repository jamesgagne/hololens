												
							<div class="row">
								<div class="col-lg-2 text-center">
									<div class="col-xs-6 col-sm-6 col-md-6 col-lg-12">
										<form method="GET" action="<?= base_url(); ?>index.php/Search">
										
											<div class="row">
												<span class="h3">Filter by Category</span>
											</div>

											<div class="row">
												<input type="hidden" name="query" value="<?= $query; ?>" />
												
												<label class="checkbox">
													<input type="checkbox" name="" />
													<span>Chair</span>
												</label>

												<input class="btn btn-success" type="submit" value="Update" />
											</div>
										</form>
										
										<br>
									</div>
									
									<div class="col-xs-6 col-sm-6 col-md-6 col-lg-12">
										
										<div class="row">
												<span class="h3">Filter by Apperance</span>
										</div>
										
										<div class="col-xs-5 col-centered">
											<select class="form-control">
												<option>Yellow</option>
											</select>
										</div>
									</div>
									
								</div>
								
								<div class="col-lg-10">					
									<span class="h1">Popular <small>Near you</small></span>
									
									<br>
									<br>
								
									<div class="row">
										<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
											<a href="#">
												<div class="thumbnail">
															<img class="thumbnail-image" src="<?= assetUrl(); ?>img/no_image.png">
															
													<div class="text-center">
																<h4>Thumbnail label</h4>
															</div>
													</div>
											</a>
										</div>
										
										<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
											<a href="#">
												<div class="thumbnail">
															<img class="thumbnail-image" src="<?= assetUrl(); ?>img/no_image.png">
															
													<div class="text-center">
																<h4>Thumbnail label</h4>
															</div>
													</div>
											</a>
										</div>
										
										<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
											<a href="#">
												<div class="thumbnail">
															<img class="thumbnail-image" src="<?= assetUrl(); ?>img/no_image.png">
															
													<div class="text-center">
																<h4>Thumbnail label</h4>
															</div>
													</div>
											</a>
										</div>
										
										<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
											<a href="#">
												<div class="thumbnail">
															<img class="thumbnail-image" src="<?= assetUrl(); ?>img/no_image.png">
															
													<div class="text-center">
																<h4>Thumbnail label</h4>
															</div>
													</div>
											</a>
										</div>
										
										<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
											<a href="#">
												<div class="thumbnail">
															<img class="thumbnail-image" src="<?= assetUrl(); ?>img/no_image.png">
															
													<div class="text-center">
																<h4>Thumbnail label</h4>
															</div>
													</div>
											</a>
										</div>
									</div>
								</div>
							</div>