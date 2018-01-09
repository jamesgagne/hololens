							<title>Workspaces</title>	
							
							<input type="hidden" id="space_id" value="<?= $SpaceID; ?>" />
							
							<div class="row">
							
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="row">							
										<input type="hidden" id="base_url" value="<?= base_url(); ?>" />
										
										<form class="form-inline" method="GET" action="<?= base_url(); ?>index.php/Workspace">
											<label for="space">Current Workspace</label>
										
										<div class="row">
										
											<div class="col-xs-12">
										
											<select id="space" class="form-control" name="space_id" onchange="this.form.submit();">
												
												<?php foreach((array)$Workspaces as $workspace) { ?>
												
												<option <?php if($CurrentWorkspace == $workspace["space_id"]) echo "selected"; ?> value="<?= $workspace["space_id"]; ?>"><?= $workspace["name"]; ?></option>
												
												<?php } ?>
												
											</select>
											
											<br>
											
											<input style="margin-right: 10px;" type="button" class="btn btn-primary pull-right" value="Add Workspace" data-toggle="modal" data-target="#addWorkspaceModal" id="addWorkspaceButton" />	
											<input style="margin-right: 10px;" type="button" class="btn btn-primary pull-right" value="Delete Workspace" data-toggle="modal" data-target="#deleteWorkspaceModal" id="deleteWorkspaceButton" />
											
											</div>
											
											<br>
											<br>
											
										</div>
											
										<div class="row">
										
											<div class="col-xs-12">
										
												<input disabled style="margin-right: 10px;" type="button" class="btn btn-primary pull-left" value="Remove From Workspace" data-toggle="modal" data-target="#removeModal" id="removeButton" />
												<input disabled style="margin-right: 10px;" type="button" class="btn btn-primary pull-left" value="Download" id="downloadButton" />
										
											</div>
										
										</div>
										
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
							
							<!-- Remove Model Modal -->
							<div class="modal fade" id="removeModal">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<span class="h4">Remove Selected</span>
										</div>
									
										<div class="modal-body">
											<p>Are you sure you want to remove the <span id="removeFileCount"></span> selected model(s)?</p>
										</div>
										
										<div class="modal-footer">
											<input type="button" data-dismiss="modal" class="btn btn-success" value="OK" id="removeOK" />
											<input type="button" data-dismiss="modal" class="btn btn-danger" value="Cancel" />
										</div>
									</div>
								</div>
							</div>
							
							<!-- Add Workspace Modal -->
							<div class="modal fade" id="addWorkspaceModal">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<span class="h4">Add Workspace</span>
										</div>
										
										<form method="POST" action="<?= base_url(); ?>index.php/Workspace/AddWorkspace">
									
											<input type="hidden" name="workspace_id" value="<?= $CurrentWorkspace; ?>" />
									
											<div class="modal-body">
												<label for="workspace">Workspace Name:</label>
												<input id="workspace" max-length="50" required class="form-control" type="text" name="workspace" />
												
												<br>
												
												<label for="description">Workspace Description:</label>
												<textarea max-length="255" class="form-control" name="description" id="description" style="resize: none; width: 100%;" rows="4"></textarea>
											</div>
											
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" value="OK" id="addWorkspaceOK" />
												<input type="button" data-dismiss="modal" class="btn btn-danger" value="Cancel" />
											</div>
										
										</form>
									</div>
								</div>
							</div>
							
							<!-- Delete Workspace Modal -->
							<div class="modal fade" id="deleteWorkspaceModal">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<span class="h4">Delete Current Workspace</span>
										</div>
									
										<form method="POST" action="<?= base_url(); ?>index.php/Workspace/DeleteWorkspace">
										
											<input type="hidden" name="workspace_id" value="<?= $CurrentWorkspace; ?>" />
										
											<div class="modal-body">
												<p>Are you sure you want to delete the current workspace?</p>
											</div>
											
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" value="OK" id="deleteWorkspaceOK" />
												<input type="button" data-dismiss="modal" class="btn btn-danger" value="Cancel" />
											</div>
										</form>
									</div>
								</div>
							</div>