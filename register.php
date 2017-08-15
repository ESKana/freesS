<?php
include('config/autoload.php');

if(isset($_POST['inscription']) AND isset($_POST['username']) AND isset($_POST['password'])){
	register($db, $_POST['username'], $_POST['password']);
	/*	
		ajouter l'upload de l'image possible, le choix du pseudo, la verification du password, le textarea pour la cle pgp, un capchat, 
	*/
}



if(isset($_SESSION['id'])){
	header('Location: home.php');
}

?>

<html>
	<header>
			<meta charset="utf-8">
			<link rel="stylesheet" href="./stylesheet/stylesheet.css" media="screen">
	</header>
	
<body>
  <div class="bs-docs-section clearfix">
        <div class="row">
				<div class="container">
					<div class="page-header">
					
					<a href="index.php"><h1>FreeSocial</h1></a>

						<div class="col-row-10">
						<div class="well bs-components">
							
							
							
							<form class="horizontal" action="register.php" method="post">
							  <fieldset>
								<legend><h2>Register</h2></legend>

								<div class="form-group">
								  <label for="inputEmail" class="col-lg-2 control-label">Login</label>
								  <div class="col-lg-4">
									<input class="form-control" id="Login" placeholder="Login" type="text">
								  </div><br><br>

								  <label for="inputEmail" class="col-lg-2 control-label">Username</label>
								  <div class="col-lg-4">
									<input class="form-control" id="username" placeholder="username" type="text">
								  </div><br><br>

								  
								  <label for="inputEmail" class="col-lg-2 control-label">password</label>
								  <div class="col-lg-4">
									<input class="form-control" id="password" placeholder="password" type="text">
								  </div><br><br>

								  
								  <label for="inputEmail" class="col-lg-2 control-label">re-password</label>
								  <div class="col-lg-4">
									<input class="form-control" id="password2" placeholder="re-password" type="text">
								  </div><br><br>

								  
								  <label for="textArea" class="col-lg-2 control-label">PGP</label>
								  <div class="col-lg-10">
									<textarea class="form-control" rows="10" id="textArea"></textarea>
									<span class="help-block">Enter your public pgp key</span>
								  </div><br><br>
								  
								      <div class="form-group">
									  <label for="select" class="col-lg-2 control-label">Competance</label>
									  <div class="col-lg-10">

										<select multiple="" class="form-control">
										  <option>1</option>
										  <option>2</option>
										  <option>3</option>
										  <option>4</option>
										  <option>5</option>
										</select>
									  </div>
									</div>
									
								<label for="textArea" class="col-lg-2 control-label">Tell about you</label>
								  <div class="col-lg-10">
									<textarea class="form-control" rows="10" id="textArea"></textarea>
									<span class="help-block">tell us about your motivations in the DW</span>
								  </div><br><br>
									
								
								
								<button type="submit" class="btn btn-primary">Submit</button>
								</fieldset>
							</form>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
	
	