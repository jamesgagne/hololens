							<title>Workspaces</title>	

							<div class="row">
							
							</div>
							
							<div class="row">
							
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="row">							
										<input type="hidden" id="base_url" value="<?= base_url(); ?>" />
										
										<form class="form-inline" method="GET" action="<?= base_url(); ?>index.php/Workspace">
											<select class="form-control" name="space_id" onchange="this.form.submit();">
												
												<?php foreach((array)$Workspaces as $workspace) { ?>
												
												<option value="<?= $workspace["space_id"]; ?>"><?= $workspace["name"]; ?></option>
												
												<?php } ?>
												
											</select>	
										
																				
										<input disabled style="margin-right: 15px;" type="button" class="btn btn-primary pull-right" value="Add To Workspace" data-toggle="modal" data-target="#addModal" id="addButton" />	
										<input disabled style="margin-right: 15px;" type="button" class="btn btn-primary pull-right" value="Delete" data-toggle="modal" data-target="#deleteModal" id="deleteButton" />
										
										<input disabled style="margin-right: 15px;" type="button" class="btn btn-primary pull-right" value="Download" id="downloadButton" />
										
										</form>
									</div>
									
									<br>
								
									<div class="row" id="models">
									
										<?php foreach((array)$Models as $model) { ?>
									
										<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3" style="padding: 10px;">
											<label class="thumbnail file_tile">
												<input type="checkbox" class="pull-right model fileCheckBox" value="<?= $model["location"]; ?>,<?= $model["name"]; ?>,<?= $model["model_id"]; ?>" />
												<img style="width: 90%;" class="thumbnail-image" src="<?= $model["link"]; ?>">
												<h4 class="text-center"><?= $model["name"]; ?></h4>
											</label>
										</div>	
										
										<?php } ?>

									</div>
								</div>
							</div>