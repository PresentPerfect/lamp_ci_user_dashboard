<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<style type="text/css">
		.navbar {
      		margin-bottom: 20px;
    	}
    	.row {
    		margin-top: 10px;
    	}
    	.container-fluid {
    		padding: 0 5%;
    	}
    	.error_msg {
			color: red;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
			    <a class="navbar-brand">Test App</a>
			</div>
			<div>
			    <ul class="nav navbar-nav">
			       	<li class="active"><a href="">Home</a></li>
			    </ul>
			    <ul class="nav navbar-nav navbar-right">
			        <li><a href="login_view"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
			    </ul>
			</div>
		</div>
	</nav>
	<div class='container-fluid'>
		<h2>Sign In</h2>
<?php   
		if ($this->session->flashdata('login_error_msg'))
		{
?>			<div class='error_msg'>
<?=   		$this->session->flashdata('login_error_msg');
?>								
			</div>
<?php	
		}
?>						
		<div class='form'>
			<form role='form' action="/users/login_act" method='post'>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='email'>Email Address:  </label>
						<input class='form-control' type='email' name='email'>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='password'>Password:  </label>
						<input class='form-control' type='password' name='password'>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>						
						<button class='btn btn-primary btn-large' type='submit'>Sign In</button>
					</div>
				</div>
			</form>
		</div>
		<p>
			<a href="regis_view">Don't have an account? Register.</a>
		</p>
	</div>


</body>
</html>