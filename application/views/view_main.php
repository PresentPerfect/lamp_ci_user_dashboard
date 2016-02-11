<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Main Page View</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <style type="text/css">
    .navbar {
      margin-bottom: 20px;
    }
  </style>
<body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
            <p class='navbar-brand'>Test App</p>
        </div>
        <div>
          <ul class="nav navbar-nav">
            <li class='active'><a>Home</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="logoff_act"><span class="glyphicon glyphicon-lock"></span> Sign In/Register</a></li>
          </ul>
        </div>
      </div>
    </nav>

  <div class='container-fluid'>
    <div class="jumbotron">
        <h1>Welcome to the Test</h1>      
        <p>We're going to build a cool application using a MVC framework! This aaplication was built by Eyre Kungwankrai</p>
        <a class='btn btn-primary btn-large' href='logoff_act'>Start</a>
    </div>

    <div class='row'>
      <div class='col-sm-4'>
        <h3>Manage Users</h3>
        <p>
          Using this application, you'll learn how to add, remove, and edit users for the application
        </p>
      </div>
      <div class='col-sm-4'>
          <h3>Leave Messages</h3>
          <p>
            Users will be able to leave a message to another user using this application.
          </p>
      </div>
      <div class='col-sm-4'>
        <h3>Edit User Information</h3>
        <p>
          Admins will be able to edit another user's information (email address, first name, last name, etc.)
        </p>
      </div>
    </div>





  </div>




</body>
</html>