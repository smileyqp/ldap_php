###  php连接ldap简化版

```shell
sudo apt-get update
sudo apt-get install slapd ldap-utils
sudo dpkg-reconfigure slapd
```

在这个过程中有很多新的问题需要回答。 我们将接受大部分违约。 我们来回答一下问题：</br>
省略了OpenLDAP服务器配置？ 没有</br>
DNS域名？此选项将确定目录路径的基本结构。 阅读消息以了解这将如何实现。 即使您不拥有实际的网域，您也可以选择所需的任何值。 但是，假设您具有适当的服务器域名，因此您应该使用它。 我将使用smileyqp.com 。 </br>
机构名称？你可以选择任何你觉得合适的东西。 </br>
管理员密码？ 输入两次安全密码</br>
数据库后端？ MDB</br>
清除slapd时删除数据库？ 没有</br>
移动旧数据库？ 是</br>
允许LDAPv2协议？ 没有 </br>
</br>
此时，您的LDAP服务器已配置并运行。 打开防火墙上的LDAP端口，以便外部客户端可以连接：</br>

```shell
sudo ufw allow ldap
```

我们来测试我们与ldapwhoami的LDAP连接，该连接应该返回我们连接的用户名：

```shell
ldapwhoami -H ldap:// -x 
anonymous
```

anonymous是我们anonymous的结果，因为我们运行ldapwhoami而不登录到LDAP服务器。 这意味着服务器正在运行并应答查询。 接下来，我们将设置一个Web界面来管理LDAP数据。 </br>
</br>
安装和配置phpLDAPadmin Web界面</br>
sudo apt-get install phpldapadmin</br>
首先在文本编辑器中打开具有root权限的主配置文件：

```shell
sudo nano /etc/phpldapadmin/config.php
```

寻找以$servers->setValue('server','name'开头的行，在nano您可以通过键入CTRL-W ，然后输入字符串然后ENTER来搜索字符串，您的光标将被放置在正确的线。</br>
</br>
该行是您的LDAP服务器的显示名称，Web界面用于有关服务器的标题和消息。 在这里选择适当的选择：

```shell
/etc/phpldapadmin/config.php

$servers->setValue('server','name','Example LDAP');
```

接下来，向下移动到$servers->setValue('server','base'行，该配置告诉phpLDAPadmin LDAP层次结构的根目录，这是基于我们在重新配置slapd包时输入的值。我们的示例我们选择了example.com ，我们需要将每个域组件（不是一个点）放入dc= notation中将其转换为LDAP语法：

```shell
/etc/phpldapadmin/config.php

$servers->setValue('server','base', array('dc=example,dc=com'));
```

现在找到登录bind_id配置行，并bind_id开头注释

```shell
/etc/phpldapadmin/config.php
```

```shell
$servers->setValue('login','bind_id','cn=admin,dc=example,dc=com');
```

此选项预先填充Web界面中的管理员登录详细信息。 这是我们不能共享的信息，如果我们的phpLDAPadmin页面是可公开访问的。
</br>
我们需要调整的最后一件事是控制一些phpLDAPadmin警告消息的可见性的设置。 默认情况下，应用程序将显示相当多的关于模板文件的警告消息。 这些对我们目前使用的软件没有影响。 我们可以通过搜索hide_template_warning参数来隐藏它们，取消注释包含它的行，并将其设置为true ：

```shell
/etc/phpldapadmin/config.php

$config->custom->appearance['hide_template_warning'] = true;
```

这是我们需要调整的最后一件事。 保存并关闭文件以完成。 我们不需要重新启动任何更改才能生效。</br>

接下来我们将登录到phpLDAPadmin。 </br>
http://localhost/phpldapadmin/</br>



先结算除了admin界面的修改密码以及禁用这两个功能之外其他的已经全部写好；
现阶段的困难是获得当行数据;
或者有一个方法是我直接将其一行存储起来要用的时候直接从存储的地方进行抽取；
另外一个方法是，将这个打上tag比如id等进行编号，然后再获取

![Image text](https://github.com/smileyqp/ldap_php/blob/master/README_PIC/1.png)

![Image text](https://github.com/smileyqp/ldap_php/blob/master/README_PIC/2.png)

![Image text](https://github.com/smileyqp/ldap_php/blob/master/README_PIC/3.png)