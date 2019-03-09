<?php 
// $username=$_POST['uername'];
// $password = $_POST['polishusername'];

$addusername=$_POST['addusername'];
$addpassword=$_POST['addpassword'];

// echo $addusername;
// echo $addpassword;
// echo $_COOKIE["user"];
// echo $_COOKIE["password"];



//LDAP服务器连接部分
$ldap_host = "localhost";//LDAP 服务器地址
$ldap_port = "389";//LDAP 服务器端口号

$ldap_user = "cn=".$_COOKIE["user"].",dc=smileyqp,dc=com";


//设定登录DN；这是管理员部分
$ldap_pwd = $_COOKIE["password"];//设定密码

$ldap_conn = ldap_connect($ldap_host, $ldap_port);//建立与 LDAP 服务器的连接

$set = ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);    //设置参数，这个目前还不了解

if(!$ldap_conn)
{
    //诊断连接错误
    die("Can't connect to LDAP server");
}
// echo $ldap_user;

$r = ldap_bind($ldap_conn, $ldap_user, $ldap_pwd) or die("You are not a uer of Unity-drive.");//与服务器绑定


if(ldap_errno($ldap_conn)!=0){
    echo "Can't log in! ".ldap_error($ldap_conn)."<br>";
}else{
    








    // //添加用户
    // $info["cn"] = $addusername;
    // // $info["password"] = $addpassword;
    // $info["objectclass"] = "inetOrgPerson";
    // $r = ldap_add($ldap_conn, "cn=".$addusername.", ou=users, dc=smileyqp,dc=com", $info);
    // echo $r;
    // echo 'success';


     //添加用户
    $info["cn"] = $addusername;
    $info["sn"] = $addusername;
    $info["userPassword"][0] = "{MD5}".base64_encode(pack("H*",md5($addpassword)));
    $info["objectclass"] = "inetOrgPerson";
    $r = ldap_add($ldap_conn, "cn=".$addusername.", ou=users, dc=smileyqp,dc=com", $info);
    echo '您已经成功添加用户'.$addusername.'！';


}
ldap_unbind($ldap_conn) or die("Can't unbind from LDAP server."); //与服务器断开连接




















?>