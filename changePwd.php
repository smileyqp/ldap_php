<?php 
// $username=$_POST['uername'];
// $password = $_POST['polishusername'];

$polishusername=$_POST['polishusername'];
$polishpassword=$_POST['polishpassword'];

// echo $username;
// echo $password;
// echo $polishusername;
// echo $polishpassword;
// echo '</br>';
// echo $_COOKIE["user"];
// echo $_COOKIE["password"];



//LDAP服务器连接部分
$ldap_host = "localhost";//LDAP 服务器地址
$ldap_port = "389";//LDAP 服务器端口号
if($_COOKIE["manager"] =='manager'){
    $ldap_user = "cn=".$_COOKIE["user"].",dc=smileyqp,dc=com";
}else{
    //设定登录DN;这是user部分
    $ldap_user = "cn=".$_COOKIE["user"].",ou=users,dc=smileyqp,dc=com";
}
//用户名密码 RDN登录

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
    



    if($_COOKIE["manager"]=='manager'){

    }else{
        //普通用户修改密码部分
        $values["userPassword"][0] = "{MD5}".base64_encode(pack("H*",md5($polishpassword)));
        $rs = ldap_mod_replace($ldap_conn,$ldap_user,$values); 
        echo '您好'.$_COOKIE["user"].',您的密码修改已经成功！请用新密码登录！';

    }
    









}
ldap_unbind($ldap_conn) or die("Can't unbind from LDAP server."); //与服务器断开连接


?>