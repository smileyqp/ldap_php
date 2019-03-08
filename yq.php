
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

//using ldap bind anonymously

// connect to ldap server
// $ldapconn = ldap_connect("ldap")
//     or die("Could not connect to LDAP server.");

// if ($ldapconn) {

//     // binding anonymously
//     $ldapbind = ldap_bind($ldapconn);

//     if ($ldapbind) {
//         echo "LDAP bind anonymous successful...";
//     } else {
//         echo "LDAP bind anonymous failed...";
//     }

// }

?>



<?php

// $ds=ldap_connect("localhost");
// //首先连接上服务器 
// if (ldap_bind($ds,"cn=yqp,ou=groups,dc=smileyqp,dc=com","yqp")){
// echo "验证通过";
// }else{
// echo "验证不通过";
// }
// ldap_unbind($ds);
// //取消绑定
// ldap_close($ds);


?>








<?php
    // $ldap_host = "localhost";
    // $ldap_port = "389";
    // //连接ldap服务器
    // $ds = ldap_connect($ldap_host, $ldap_port) or die("Can't connect to LDAP server");
    // //设置ldapv3
    // ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    // $ldap_user = "aaa";
    // $ldap_pwd = "aaa";
    // //用户名@域和密码验证绑定
    // ldap_bind($ds, $ldap_user, $ldap_pwd) or die("Can't bind to LDAP server");
    // //如果想匿名绑定ldap_bind($ds)即可
    // $dn = "cn= aaa,cn=users,dc=smileyqp,dc=com";//ldap dn
    // $filter = "sAMAccountName=pig";//选择器
    // $justthese = array('sn','objectsid');//选择要获取的用户属性
    // $sr=ldap_search($ds, $dn, $filter, $justthese);
    // //如果想去到所有属性$sr=ldap_search($ds, $dn, $filter)；即可
    // $info = ldap_get_entries($ds, $sr);
    // print_r($info);
    // echo "<br/>";
    // //用户某项属性取值
    // echo $info[0]["sn"][0];
    // echo "<br/>";
?>


<?php

// $ldapconfig['host'] = 'localhost';
// $ldapconfig['port'] = 389;
// $ldapconfig['basedn'] = 'dc=smileyqp,dc=com';
// $ldapconfig['authrealm'] = 'My Realm';

// function ldap_authenticate() {
//     global $ldapconfig;
//     global $PHP_AUTH_USER;
//     global $PHP_AUTH_PW;
    
//     if ($PHP_AUTH_USER != "" && $PHP_AUTH_PW != "") {
//         $ds=@ldap_connect($ldapconfig['host'],$ldapconfig['port']);
//         $r = @ldap_search( $ds, $ldapconfig['basedn'], 'uid=' . $PHP_AUTH_USER);
//         if ($r) {
//             $result = @ldap_get_entries( $ds, $r);
//             if ($result[0]) {
//                 if (@ldap_bind( $ds, $result[0]['dn'], $PHP_AUTH_PW) ) {
//                     return $result[0];
//                 }
//             }
//         }
//     }
//     header('WWW-Authenticate: Basic realm="'.$ldapconfig['authrealm'].'"');
//     header('HTTP/1.0 401 Unauthorized');
//     return NULL;
// }

// if (($result = ldap_authenticate()) == NULL) {
//     echo('Authorization Failed');
//     exit(0);
// }
// echo('Authorization success');
// print_r($result);

?>
<?php 
$host= 'localhost';
$port = '389';//一般都是389
$domain = 'domain';
$account = 'myAccount';
 
 
 
$user = 'cn=admin,dc=smileyqp,dc=com';//域用户名
$password = 'admin';//域用户密码
 
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
<?php
//    $ldapConnect=ldap_connect(LDAP_SERVER_IP , LDAP_SERVER_PORT );
//    //建立到ldap服务器的连接LDAP_SERVER_IP是ldap服务器ip，LDAP_SERVER_PORT是ldap服务器端口(默认389)
//       $bind= @ldap_bind($ldapConnect ,$user . '@corp.qihoo.net',$pass);
//   //验证帐号密码，ldap_bind第一个为绑定的连接，第二个为用户名(注意是否有后缀)，第三个为密码。
//       if($bind )
//       {//验证成功
//                 $SEARCH_DN= 'ou=XXX,ou=XXX,dc=XXXX,dc=XXXX,dc=XXXX';
//                 //搜索基本条件值(类似于数据库的库和表)
//                 $SEARCH_FIELDS= array('mail','displayName', 'cn');
//                 //需要的搜索结果
//                 $result= @ldap_search($ldapConnect,$SEARCH_DN,"cn=" . $user,$SEARCH_FIELDS);
//                 //第三个参数是限定搜索结果为用户名为$user(类似where后的搜索条件)          
//                 $retData = @ldap_get_entries($ldapConnect, $result);
//                 foreach($retData as $k => $v)
//                 {//筛选整理数据，返回
//                          return array(
//                                   'userName'=> $v['cn'][0],
//                                   'nickName'=> $v['displayname'][0],
//                                   'mail'=> $v['mail'][0]
//                          );  
//                }  
//       }
//       else
//       {//验证失败
//   }
//       ldap_close($ldapConnect); 




?>











    <?php
    phpinfo();
    ?>
  </body>
</html>

