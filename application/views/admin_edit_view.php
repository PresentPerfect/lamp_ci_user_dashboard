<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Edit Page</title>
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
			       	<li class="active"><a>Admin Edit Dashboard</a></li>
			       	<li><a>Profile</a></li>
			    </ul>
			    <ul class="nav navbar-nav navbar-right">
			        <li><a href="/users/logoff_act"><span class="glyphicon glyphicon-log-out"></span> Log Off</a></li>
			    </ul>
			</div>
		</div>
	</nav>
	<div class='container-fluid'>

		<div class='row'>
			<div class='col-sm-10'>
				<h2>Edit User #<?= $id ?></h2>
			</div>
			<div class='col-sm-2'>
				<a href="/users/dashboard" class='btn btn-primary btn-large'>Return to Dashboard</a>
			</div>
		</div>

<?php   	if ($this->session->flashdata('error_msg'))
			{
?>				<div class='error_msg'>
<?=   				$this->session->flashdata('error_msg');
?>								
				</div>
<?php		}
?>
		<div class='form'>
			<form role='form' action='/users/edit_user_act' method='post'>
				<input type='hidden' name='id' value=<?= $id ?>>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='email'>Email Address:  </label>
						<input class='form-control' type='email' name='email' value=<?= $email ?>>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='first_name'>First Name:  </label>
						<input class='form-control' type='text' name='first_name' value=<?= $first_name ?>>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='last_name'>Last Name:  </label>
						<input class='form-control' type='text' name='last_name' value=<?= $last_name ?>>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='level'>User Level</label>
						<select class='form-control' name='level'>
<?php                   if ($level==9)
						{
?>
							<option value='9'>Admin</option>
							<option value='1'>Normal</option>
<?php
						}
						else
						{
?>							<option value='1'>Normal</option>
							<option value='9'>Admin</option>
<?php
						}
?>
						</select>
					</div>
				</div>

				<div class='row'>
					<div class='col-sm-4'>
						<label for='password'>Password:  </label>
						<input class='form-control' type='password' name='password' value=<?= $password ?>>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='password_confirm'>Password Confirmation:  </label>
						<input class='form-control' type='password' name='password_confirm' value=<?= $password ?>>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>						
						<button class='btn btn-primary btn-large' type='submit'>Edit</button>
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