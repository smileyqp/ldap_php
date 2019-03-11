<?php 

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
    



    $results=ldap_search( $ldap_conn, "ou=users,dc=smileyqp,dc=com", "cn=*" ); //执行查询
    $entry= ldap_get_entries($ldap_conn, $results);//获得查询结果
    //print_r($entry);
    //echo $entry[0]['cn']['count'];
    //echo $entry[1][0];
    // $justthese = array("cn","userpassword"); 
    // $search = ldap_search($ldap_conn,'ou=users,dc=smileyqp,dc=com',$justthese);
    // print_r($search);
    for ($i=0; $i<=count($entry)-2; $i++)
    {
        $usernameid = 'username'.$i;
        $userpwd = 'userpwd'.$i;
        $userbtn = 'userbtn'.$i;
        $userlimit = 'userlimit'.$i;
        echo '
        <tr>
            <th scope="row" style="width:20%;"><input type="text" id='.$usernameid.'  value='.$entry[$i]['cn'][0].' style="border:none;width:60%;text-align:center;" readonly = "readonly"  ></th>
            <td><input type="text" name="polishPassword" id='.$userpwd.' class="form-control pwdInput" placeholder="Password" ></td>
            <td><button class="btn btn-sm btn-primary btn-block" type="button" value='.$i.' id ='.$userbtn.' onclick="adminchangePwd(this)">确认修改密码</button></td>
            <td ><button class="btn btn-sm btn-danger btn-block" type="button" id ='.$userlimit.'>点击禁用</button></td>
        </tr> 
           
        ';
   
    }
 
    
}
ldap_unbind($ldap_conn) or die("Can't unbind from LDAP server."); //与服务器断开连接



?>