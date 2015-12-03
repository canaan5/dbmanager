
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this Page -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

        <div class="col-md-4 col-md-offset-4" id="login-form">

          <form class="form-horizontal" method="POST" action="/login">
            <fieldset>
              <legend>Mysql Login</legend>

              <div class="form-group">
                <label for="host" class="col-sm-2 control-label">Host</label>
                <div class="col-sm-10">
                  <input type="text" name="host" class="form-control" id="host" placeholder="Mysql Host">
                </div>
              </div>
              <div class="form-group">
                <label for="user" class="col-sm-2 control-label">User</label>
                <div class="col-sm-10">
                  <input type="text" name="user" class="form-control" id="user" placeholder="Mysql User">
                </div>
              </div>
              <div class="form-group">
                <label for="pass" class="col-sm-2 control-label">Pass</label>
                <div class="col-sm-10">
                  <input type="password" name="pass" class="form-control" id="pass" placeholder="Password">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> Remember me
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default btn-block">Login</button>
                </div>
              </div>

            </fieldset>
          </form>

        </div>

    </div> <!-- /container -->

  </body>
</html>
