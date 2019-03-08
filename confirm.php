
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <!--
    Modified from the Debian original for Ubuntu
    Last updated: 2014-03-19
    See: https://launchpad.net/bugs/1288690
  -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Just test</title>
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
        <li><a href="login.php">一清密码管理</a></li>
        </ul>
    </div>
    </nav>
    </br></br>
    

    <?php
    // 定义变量并默认设置为空值
    $username = $password = "";

    //接收登录界面传过来的值
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $manager = test_input($_POST["manager"]);
    echo $username;
    echo $manager;

    }
    function test_input($data)
    {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

    //LDAP服务器连接部分
    $ldap_host = "localhost";//LDAP 服务器地址
    $ldap_port = "389";//LDAP 服务器端口号
    if($manager =='manager'){
        $ldap_user = "cn=".$username.",dc=smileyqp,dc=com";
    }else{
        //设定登录DN;这是user部分
        $ldap_user = "cn=".$username.",ou=users,dc=smileyqp,dc=com";
    }
    //用户名密码 RDN登录
    
    //设定登录DN；这是管理员部分
    $ldap_pwd = $password;//设定密码
    echo('--------------------');
    echo($ldap_user);
    echo('--------------------');
    echo($ldap_pwd);
    $ldap_conn = ldap_connect($ldap_host, $ldap_port);//建立与 LDAP 服务器的连接

    $set = ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);    //设置参数，这个目前还不了解
   
    if(!$ldap_conn)
    {
        //诊断连接错误
        die("Can't connect to LDAP server");
    }
    $r = ldap_bind($ldap_conn, $ldap_user, $ldap_pwd) or die("Can't bind to LDAP server.");//与服务器绑定
    /*var_dump($ldap_conn);
    exit;*/

    //添加用户
    // $info["cn"] = "John";
    // $info["sn"] = "Jones";
    // $info["objectclass"] = "person";
    // $r = ldap_add($ldap_conn, "cn=John, ou=users, dc=smileyqp,dc=com", $info);
    


    //连接成功
    if(ldap_errno($ldap_conn)!=0)
    {
      echo "Can't log in! ".ldap_error($ldap_conn)."<br>";
    }
    else
    {
        if($manager =='manager'){
            echo "Welcome $ldap_user";
            echo 'you are a manager';
            
        }else{
            echo "Welcome $ldap_user";
            echo 'Not a manager';
            echo '
                <form class="form-signin formClass">
                <img class="mb-4" src="./yq.png" alt="" width="82" height="72">
                <h1 class="h3 mb-3 font-weight-normal">您好，'.$username.'请修改密码</h1>
                <label for="Username" class="sr-only">Username</label>   
                <input type="text" id="username" class="form-control" placeholder="Username" value='.$username.' disabled ></br>

                <label for="inputPassword" class="sr-only">Password</label>        
                <input type="password" id="password" class="form-control" placeholder="Password" required></br>

                <button class="btn btn-lg btn-primary btn-block" type="submit" >确认修改密码</button></br></br>
                <p class="mt-5 mb-3 text-muted">&copy; 一清创新科技2019</p>
                </form>';
        }
      
    }
    ldap_unbind($ldap_conn) or die("Can't unbind from LDAP server."); //与服务器断开连接
    ?>

   


    

  </body>
</html>

