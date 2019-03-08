<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


use app\LDAPConnection;
use app\LDAPGateway;

require 'bootstrap/autoload.php';
require 'app/utils/helpers.php';

$basedn="ou=Usuarios,dc=example,dc=com";
$filter="(cn=*)";
$attributes=array('cn', 'mail', 'description', 'st', 'l', 'uid', 'telephoneNumber');


try {
    
    $ldap = LDAPConnection::getConnection()->connection();
    echo($ldap);
   
    // $select = new LDAPGateway();
    // $datas = $select->read($ldap, $basedn, $filter, $attributes);
    
} catch (Exception $e) {
    
    echo $e->getMessage();
    
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>一清密码管理</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">

    <ul class="nav navbar-nav">
      <li><a href="index.php">一清密码管理</a></li>
    </ul>
  </div>
</nav>

<div class="container">

<h1>OpenLDAP com PHP</h1>

<ul style="list-style-type: none;">
<li><a class="btn btn-primary" href="create.php">Novo Usuário</a></li>
</ul>

<table class="table table-bordered">
<thead>

<tr>
<th>Nome</th>
<th>E-mail</th>
<th>Departamento</th>
<th>Estado</th>
<th>Cidade</th>
<th>Ramal</th>
<th>Ação</th>
</tr>

</thead>

<tbody>


<?php foreach ($datas as $data):?>
<?php if(!$data['dn']) { continue;}?>

<tr>
<td><?= $data['cn'][0]; ?></td>
<td><?= $data['mail'][0]; ?></td>
<td><?= $data['description'][0]; ?></td>
<td><?= $data['st'][0]; ?></td>
<td><?= $data['l'][0]; ?></td>
<td><?= $data['telephonenumber'][0]; ?></td>

<td>
<a href="editar.php?uid=<?= $data['uid'][0]; ?>" class="btn btn-primary btn-xs" >
	<span class="glyphicon glyphicon-edit"></span>Editar
</a>
<a href="excluir.php?dn=<?= $data['dn']; ?>" class="btn btn-danger btn-xs">
	<span class="glyphicon glyphicon-trash"></span>Excluir
</a>
</td>

</tr>

<?php endforeach;?>

</tbody>

<tfoot>
<tr>
<th>Total de Registros</th>
<th><?= $select->getRows(); ?></th>
</tr>
</tfoot>
</table>

</div> <!-- <div class="container"> -->

</body>
</html>
