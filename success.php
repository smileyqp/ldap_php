
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <!--
    Modified from the Debian original for Ubuntu
    Last updated: 2014-03-19
    See: https://launchpad.net/bugs/1288690
  -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>一清创新科技密码管理</title>
    <style type="text/css" media="screen">
  * {
    margin: 0px 0px 0px 0px;
    padding: 0px 0px 0px 0px;
  }

  body, html {
    padding: 3px 3px 3px 3px;

    background-color: #D8DBE2;

    font-family: Verdana, sans-serif;
    font-size: 11pt;
    text-align: center;
  }


    </style>
  </head>
  <body>

<?php 
$host= 'localhost';
$port = '389';//一般都是389


$user = 'cn=yqp,ou=groups,dc=smileyqp,dc=com';//域用户名
$password = 'yqp';//域用户密码
 
$conn = ldap_connect($host, $port);//不要写成ldap_connect($host.':'.$port)的形式
if ($conn) {
    //设置参数
    ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);//声明使用版本3
    ldap_set_option($conn, LDAP_OPT_REFERRALS, 0); // Binding to ldap server
    $bd = ldap_bind($conn, $user, $password);
    if ($bd) {
        echo 'LDAP 绑定成功';//相当于登录成功
    } else {
        echo 'LDAP 绑定失败';
    }
} else {
    echo '无法连接到AD域服务器';
}
ldap_close($conn);

?>




  </body>
</html>

