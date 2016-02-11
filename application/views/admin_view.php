<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard Admin View</title>
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
		th, td {
			text-align: center;
		}
	</style>
</head>
<body>
<?php
	if ($this->session->userdata['user_info']['level']==9 AND $this->session->userdata['login'])
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
			        <li><a href="logoff_act"><span class="glyphicon glyphicon-log-out"></span> Log Off</a></li>
			    </ul>
			</div>
		</div>
	</nav>
	<div class='container-fluid'>		
		<div class='row'>
			<div class='col-sm-10'>
				<h2>Manage Users</h2>
			</div>
			<div class='col-sm-2'>
				<a href="/users/addnew_view" class='btn btn-primary btn-large'>Add New</a>
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

		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>email</th>
					<th>Created at</th>
					<th>User Level</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
<?php
				foreach ($this->session->userdata('all_users_info') as $all_users_info)
				{
					$time_stamp = strtotime($all_users_info['created_at']);

					if ($all_users_info['level']==9)
					{
						$user_level = 'Admin';
					}
					elseif ($all_users_info['level']==1)
					{
						$user_level = 'Normal';
					}


?>
				<tr>
					<td><?= $all_users_info['id']  ?></td>
					<td><a href='/messages/show_by_email/<?= $all_users_info['email']  ?>'><?= $all_users_info['first_name'].' '.$all_users_info['last_name'] ?></a></td>
					<td><?= $all_users_info['email']  ?></td>
					<td><?=  date('D d M Y, g:i:s A',$time_stamp) ?></td>
					<td><?= $user_level  ?></td>
					<td><a href="admin_edit_view/<?= $all_users_info['email']  ?>">edit</a>&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp<a href="remove_act/<?= $all_users_info['email']  ?>">remove</a></td>
				</tr>
<?php
				}
?>
			</tbody>
		</table>		
	</div>
<?php
	}
	else
	{
?>
	
	<div class='container-fluid'>
		<div class='panel panel-default'>
			<div class='panel-body'>
				<p>
					<h3 class='error_msg'>You are not an admin-leveled user. Only users with admin level can view this page.</h3>
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