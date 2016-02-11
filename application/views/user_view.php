<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard User View</title>
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
    	th, td {
			text-align: center;
		}
		.error_msg {
			color: red;
		}
	</style>
</head>
<body>
<?php
	if ($this->session->userdata['user_info']['level']==1 AND $this->session->userdata('login'))
	{
?>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
			    <a class="navbar-brand">Test App</a>
			</div>
			<div>
			    <ul class="nav navbar-nav">
			       	<li class="active"><a>User Dashboard</a></li>
			       	<li><a>Profile</a></li>
			    </ul>
			    <ul class="nav navbar-nav navbar-right">
			        <li><a href="/users/logoff_act"><span class="glyphicon glyphicon-log-out"></span> Log Off</a></li>
			    </ul>
			</div>
		</div>
	</nav>
	<div class='container-fluid'>
		<h2>All Users</h2>
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
					<td><a href="/messages/show_by_email/<?= $all_users_info['email'] ?>"><?= $all_users_info['first_name'].' '.$all_users_info['last_name'] ?></a></td>
					<td><?= $all_users_info['email']  ?></td>
					<td><?=  date('D d M Y, g:i:s A',$time_stamp) ?></td>
					<td><?= $user_level  ?></td>
<?php
					if ($all_users_info['email'] == $this->session->userdata['user_info']['email'])
					{
?>
						<td><a href="user_edit_view/<?= $all_users_info['email']  ?>">edit</a></td>
<?php					
					}
					else
					{
?>
						<td>N/A</td>
<?php
					}
?>					
					
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
					<h3 class='error_msg'>You are accessing a normal user page without proper access level. Contact IT support for further assistance.</h3>
				</p>
			</div>
			<a href="logoff_act">Go back to Sign In page.</a>
		</div>
	</div>

<?php
	}
?>
</body>
</html>