!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add New User Page</title>
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
		button {
			margin-right: 10%;
		}
	</style>
</head>
<body>
<?php
	if ($this->session->userdata['user_info']['level']==9 AND $this->session->userdata('login'))
	{
?>

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
			    <a class="navbar-brand">Test App</a>
			</div>
			<div>
			    <ul class="nav navbar-nav">
			       	<li class="active"><a>Admin Dashboard</a></li>
			       	<li><a>Profile</a></li>
			    </ul>
			    <ul class="nav navbar-nav navbar-right">
			        <li><a href="/users/logoff_act"><span class="glyphicon glyphicon-log-out"></span> Log Off</a></li>
			    </ul>
			</div>
		</div>
	</nav>
	<div class='container-fluid'>
		<h2>Add a new user</h2>
<?php   	
			// if ($this->session->flashdata('addnew_error_msg'))
			// {
?>				<div class='error_msg'>
<?=   				$this->session->flashdata('addnew_error_msg');
?>								
				</div>
<?php		
			// }
?>
		<div class='form'>
			<form role='form' action='/users/add_new_act' method='post'>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='email'>Email Address:  </label>
						<input class='form-control' type='email' name='email'>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='first_name'>First Name:  </label>
						<input class='form-control' type='text' name='first_name'>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='last_name'>Last Name:  </label>
						<input class='form-control' type='text' name='last_name'>
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
						<label for='password_confirm'>Password Confirmation:  </label>
						<input class='form-control' type='password' name='password_confirm'>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>						
						<button class='btn btn-primary btn-large' type='submit'>Create</button>
						<a href="/users/dashboard" class='btn btn-danger btn-large'>Cancel</a>
					</div>
				</div>
			</form>

		</div>
	</div>
<?php
	}
	else
	{
?>
	
	<div class='container-fluid'>
		<div class='panel panel-default'>
			<div class='panel-body'>
				<p class='error_msg'>
					<h3>You are not an admin-leveled user and/or not logged in. Only users with admin level can view this page.</h3>
				</p>
			</div>
			<a href="logoff_act">Click here to sign in again.</a>
		</div>
	</div>

<?php
	}
?>

</body>
</html>