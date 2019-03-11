
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>一清创新科技</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css" media="screen">
  * {
    margin: 0px 0px 0px 0px;
    padding: 0px 0px 0px 0px;
  }

  body, html {
    padding: 0px;
    margin:0px;
    /* background-color: #D8DBE2; */
    font-family: Verdana, sans-serif;
    font-size: 11pt;
    text-align: center;
  }
  .formClass{
      width:20%;
      margin:auto;
  }
    </style>

  </head>


  <body>
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
        <li><a href="login.php">一清创新科技</a></li>
        </ul>
    </div>
    </nav>
    </br></br>
    <form class="form-signin formClass" method="post"action='confirm.php'>
        <img class="mb-4" src="./yq.png" alt="" width="82" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="Username" class="sr-only">Username</label>   
        <input name='username'type="text" id="username" class="form-control" placeholder="Username" required autofocus></br>
        
        <label for="inputPassword" class="sr-only">Password</label>        
        <input name='password'type="password" id="password" class="form-control" placeholder="Password" required>
        <div class="checkbox mb-3">
            <label>
                <input name='manager'type="checkbox" value="manager"> 我是管理员
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" >Sign in</button></br></br>
        <p class="mt-5 mb-3 text-muted">&copy; 一清创新科技2019</p>
    </form>




    

  </body>
</html>

