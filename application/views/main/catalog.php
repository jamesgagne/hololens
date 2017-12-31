							
							<title>Catalog</title>
														
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 text-center">
									<form method="GET" action="<?= base_url(); ?>index.php/Catalog">
										
										<? if(!empty($QueryString)) { ?>
										
										<input type="hidden" name="query" value="<?= $QueryString; ?>" />
										
										<? } ?>
										
										<div class="col-xs-6 col-sm-6 col-md-6 col-lg-12">
										
											<div class="row">
												<span class="h3">Filter by Category</span>
											</div>
											
											<? foreach($Categories as $category) { ?>
											
											<div class="row">
												<label class="checkbox">
													<input <? if(count($SelectedCategories) > 0 AND in_array($category["name"], $SelectedCategories)) echo "checked"; ?> type="checkbox" name="<?= $category["name"]; ?>" value="true" />
													<span><?= $category["name"]; ?></span>
												</label>
											</div>
											
											<? } ?>
											
										</div>
										
										<div class="col-xs-6 col-sm-6 col-md-6 col-lg-12">
											<div class="row">
												<span class="h3">Filter by Apperance</span>
											</div>
											
											<br>
											
											<div class="row">	
												<label class="select">
													<span>Color</span>
													<select name="color" class="form-control">
													
														<option value="All">All</option>
													
														<? foreach($Colors as $color) { ?>
													
														<option <? if($SelectedColor == $color["name"]) echo "selected"; ?> value="<?= $color["name"] ?>"><?= $color["name"]; ?></option>
														
														<? } ?>
														
													</select>
												</label>
											</div>
										</div>
										
										<div class="col-xs-12">
											<br>
											<input class="btn btn-success" type="submit" value="Update" />
											<hr />
										</div>
									</form>
								</div>
								
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
									<div class="row">
										<span class="h1">3D <small>Models</small></span>
										
										<input type="hidden" id="base_url" value="<?= base_url(); ?>" />
										
										<? if(true) { ?>
										
										<input disabled style="margin-right: 15px;" type="button" class="btn btn-primary pull-right" value="Add To List" data-toggle="modal" data-target="#addModal" id="addButton" />
										
										<? } ?>
										
										<? if(true) { ?>
										
										<input disabled style="margin-right: 15px;" type="button" class="btn btn-primary pull-right" value="Delete" data-toggle="modal" data-target="#deleteModal" id="deleteButton" />
										
										<? } ?>
										
										<input disabled style="margin-right: 15px;" type="button" class="btn btn-primary pull-right" value="Download" id="downloadButton" />
									</div>
									
									<br>
								
									<div class="row" id="models">
									
										<? foreach($Models as $model) { ?>
									
										<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3" style="padding: 10px;">
											<label class="thumbnail file_tile">
												<input type="checkbox" class="pull-right model fileCheckBox" value="<?= $model["location"]; ?>" />
												<img style="width: 90%;" class="thumbnail-image" src="<?= $model["link"]; ?>">
												<h4 class="text-center"><?= $model["name"]; ?></h4>
											</label>
										</div>	
										
										<? } ?>

									</div>
								</div>
							</div>
							
							<!-- Add Modal -->
							<div class="modal fade" id="addModal">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<span class="h4">Add To List</span>
										</div>
									
										<div class="modal-body">
											<p>Select the list to add the <span id="addFileCount"></span> selected model(s) to.</p>
										
											<label for="myListID">My List(s)</label>
											<select id="myListID" class="form-control">
												
												<? foreach($Lists as $list) { ?>
												
												<option></option>
												
												<? } ?>
												
											</select>
										</div>
										
										<div class="modal-footer">
											<input type="button" data-dismiss="modal" class="btn btn-success" value="OK" id="addOK" />
											<input type="button" data-dismiss="modal" class="btn btn-danger" value="Cancel" />
										</div>
									</div>
								</div>
							</div>
							
							<!-- Delete Modal -->
							<div class="modal fade" id="deleteModal">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<span class="h4">Delete Selected</span>
										</div>
									
										<div class="modal-body">
											<p>Are you sure you want to delete the <span id="deleteFileCount"></span> selected model(s)?</p>
										</div>
										
										<div class="modal-footer">
											<input type="button" data-dismiss="modal" class="btn btn-success" value="OK" id="deleteOK" />
											<input type="button" data-dismiss="modal" class="btn btn-danger" value="Cancel" />
										</div>
									</div>
								</div>
							</div>