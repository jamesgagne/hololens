<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Custom CSS -->
		<link rel="stylesheet" href="<?= assetUrl(); ?>css/main.css" />
			
		<!-- JQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		<style>
		</style>
		
		<script>
		</script>
	</head>
	
	<body>
		<nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				
				<!-- Navbar LEFT -->
				<div class="navbar-header navbar-left pull-left">
					<a href="<?= base_url(); ?>">
						<img class="navbar-brand" src="<?= assetUrl(); ?>img/icon-3.png" />
						<span class="navbar-brand">SoftwareEngineering</span>
					</a>
				</div>
				<!-- END Navbar LEFT -->
				
				<!-- Navbar RIGHT -->
				<div class="navbar-header navbar-right pull-right">
					<ul class="nav pull-left">
						<li class="pull-left">
							<form method="GET" action="<?= base_url(); ?>index.php/Search">
								<div class="input-group searchbar">
									<input type="text" placeholder="Search" class="form-control" name="query" value="<?= $query; ?>" />
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit">
											<span class="glyphicon glyphicon-search"></span>
										</button>
									</span>
								</div>
							</form>
						</li>
						
						<li class="dropdown pull-left login-menu">
							<a href="<?= base_url(); ?>index.php/Login" class="dropdown-toggle" data-toggle="dropdown">
							
								<? if ($UserLoggedIn) { ?>
							
								<span><?= $Username; ?></span>
								<? } ?>
								
								<? if($UserLoggedIn AND empty($ProfilePicture) == false) { ?>
								
								<img style="height: 25px; border-radius: 7px;" src="<?= $ProfilePicture; ?>" />
								<? } ?>
								
								<? if($UserLoggedIn AND empty($ProfilePicture)) { ?>
								
								<span class="glyphicon glyphicon-user"></span>
								<? } ?>
								
								<? if(!$UserLoggedIn) { ?>
								
								<span>Log In</span>
								<span class="glyphicon glyphicon-user"></span>
								<? } ?>	
								
								<span class="caret"></span>
							</a>
							
							<ul class="dropdown-menu" role="menu">
							<? if($UserLoggedIn) { ?>
							
								<div class="col-xs-5 col-xs-offset-1">
									<a href="<?= base_url(); ?>">
										<button class="btn btn-primary">My Profile</button>
									</a>
								</div>
								
								<div class="col-xs-6">
									<a href="<?= base_url(); ?>index.php/Logout">
										<button class="btn btn-primary">Logout</button>
									</a>
								</div>
							<? } ?>
							
							<? if(!$UserLoggedIn) { ?>
							
								<div class="col-xs-12">
									<div class="text-center">
										<h3><b>Log In</b></h3>				
									</div>
									
									<form action="<?= base_url(); ?>index.php/Login" method="POST">
										<div class="form-group">
											<label for="username">Username</label>
											<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" autocomplete="off">
										</div>

										<div class="form-group">
											<label for="password">Password</label>
											<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" autocomplete="off">
										</div>

										<div class="form-group">
											<div class="row">												
												<div class="col-xs-6 col-centered">
													<input type="submit" name="submit" id="submit" tabindex="3" class="form-control btn btn-success" value="Log In">
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-xs-12">
													<div class="text-center">
														<a href="<?= base_url(); ?>index.php/Reset" tabindex="4">Forgot Password?</a>
													</div>
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-xs-12">
													<div class="text-center">
														<a href="<?= base_url(); ?>index.php/Register" tabindex="5">Create Account?</a>
													</div>
												</div>
											</div>
										</div>

									</form>
								</div>
							<? } ?>
							
							</ul>
						</li>
					</ul>
							
					<button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- END Navbar RIGHT -->
			
				<div class="visible-xs-block clearfix"></div>			
				
				<div class="collapse navbar-collapse">
					<!-- Navbar LEFT Links -->
					<ul class="nav navbar-nav navbar-left">
						<li><a href="<?= base_url(); ?>">Catalog</a></li>
						<li><a href="<?= base_url() . "index.php/Upload"; ?>">Upload</a></li>
					</ul>
				</div>
			</div>
		</nav>
	
		<!-- Page Content -->
		<div class="container-fluid">
			<div class="row">		
				<div class="content">	
					<div class="col-lg-10 col-lg-offset-1">
						<section class="main">