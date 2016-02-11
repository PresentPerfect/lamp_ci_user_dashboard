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
/*    	.row {
    		margin-top: 10px;
    	}*/
    	.container-fluid {
    		padding: 0 5%;
    	}
    	th, td {
			text-align: center;
		}
		.error_msg {
			color: red;
		}
		.massage {
			vertical-align: right;
		}
		.comment{
			margin-left: 5%;
			vertical-align: right;
		}
		.form {
			margin-bottom: 100px;
		}
	</style>
</head>
<body>
<?php
	if ($this->session->userdata('login'))
	{
?>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
			    <a class="navbar-brand">Test App</a>
			</div>
			<div>
			    <ul class="nav navbar-nav">
			       	<li class="active"><a>Messaging Dashboard</a></li>
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
			<div class='pull-right'>
				<a href="/users/dashboard"><button class='btn btn-primary btn-large'>Back to Dashboard</button></a>
			</div>
		</div>


		<div class='row'>
<?php
			$user_info = $this->session->userdata['user_info'];
			$to_user = $this->session->userdata['to_user'];
			$time_stamp = strtotime($to_user['created_at']);
?>
			<h2><?= $to_user['first_name'].' '.$to_user['last_name']  ?></h2>
			<p>Registered at:  <?= date('D d M Y, g:i:s A',$time_stamp)  ?></p>
			<p>User Id: <?= $to_user['id']  ?></p>
			<p>Email Address:  <?= $to_user['email']  ?></p>
		</div>
		

		<div class='row'>
			<h3>Leave a message for <?= $to_user['first_name'] ?></h3>
			<div class='form'>
				<form role='form' action='messages/addmsg_act' method='post'>
					<div class='form-group'>
						<input type='hidden' name='from_user' value=<?= $user_info['id'] ?>>
						<input type='hidden' name='to_user' value=<?= $to_user['id']  ?>>
						<label for='message'>Message:</label>
						<textarea class='form-control' rows='5' name='message'></textarea>
					</div>
					<div class='pull-right'>
						<button class='btn btn-warning' type='submit' >Post Message</button>
					</div>
				</form>
			</div>
		</div>

<?php
		$all_msgs = $this->session->userdata('all_msgs');
		foreach($all_msgs AS $msg)
		{
			$time_stamp = strtotime($msg['created_at']);
?>
		<div class='message'>
			<div class='row'>			
				<a href="/messages/show_by_email/<?= $msg['from_user_email']  ?>"><?= $msg['from_user_name'] ?></a> wrote:			
				<div class='pull-right'>				
					<?=  date('D d M Y, g:i:s A',$time_stamp) ?>
				</div>
				<div class='panel panel-default'>
					<div class='panel-body'>
						<p><?= $msg['message'] ?></p>
					</div>
				</div>
			</div>


			<div class='comment'>
<?php
		if($this->session->userdata('all_comms'))
		{
			$all_comms = $this->session->userdata('all_comms');
			foreach($all_comms AS $comm)
			{
				if($comm['message_id']==$msg['message_id'])
				{
					$time_stamp = strtotime($comm['created_at']);
?>
				<div class='row'>
					<a href="/messages/show_by_email/<?= $comm['author_email']  ?>"><?= $comm['author_name']  ?></a> wrote:			
					<div class='pull-right'>				
						<?= date('D d M Y, g:i:s A',$time_stamp)  ?>
					</div>
					<div class='panel panel-default'>
						<div class='panel-body'>
							<p><?= $comm['comment']  ?></p>
						</div>
					</div>
				</div>
<?php
				}
			}
		}
?>

				<div class='row'>
					<div class='form'>
						<form role='form' action='/messages/add_comment_act' method='post'>
							<div class='form-group'>
								<input type='hidden' name='author_id' value=<?= $user_info['id'] ?>>
								<input type='hidden' name='message_id' value=<?= $msg['message_id']  ?>>

								<input type='hidden' name='profile_id' value=<?= $to_user['id'] ?>  >
								<input type='hidden' name='profile_email' value=<?= $to_user['email'] ?>  >
								<label for='comment'>Comment:</label>
								<textarea class='form-control' rows='5' name='comment'></textarea>
							</div>
							<div class='pull-right'>
								<button class='btn btn-warning' type='submit'>Post Comment</button>
							</div>
						</form>
					</div>
				</div>


			</div>

		</div>
<?php
		}
?>

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
						<h3 class='error_msg'>You must be logged in to view this page.</h3>
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