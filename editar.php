<?php

use app\LDAPConnection;
use app\LDAPGateway;

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require 'bootstrap/autoload.php';
require 'app/utils/helpers.php';

if ($_GET['uid']) {

    $base_dn = "ou=Usuarios,dc=example,dc=com";
    $filter = "(uid={$_GET['uid']})";
    $attributes=array('givenName', 'sn', 'description', 'mail', 'st', 'l', 'uid', 'userPassword', 'telephoneNumber');
    
    try {
        
        $ldap = LDAPConnection::getConnection()->connection();
        
        $search = new LDAPGateway();
        $req = $search->read($ldap, $base_dn, $filter, $attributes);
        
        
    } catch (Exception $e) {
        
        echo $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Editar Usuário</title>


	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">

    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
    </ul>
  </div>
</nav>

	<div class="container">

		<h1>Editar Usuário</h1>

		<form class="form-horizontal" method="post" action="">

			<div class="form-group">
				<label class="control-label col-sm-2" for="giveName">Nome:</label>
				<div class="col-sm-4">
					<input type="text" name="giveName" class="form-control"
						id="giveName" value="<?= $req[0]['givenname'][0]; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="sn">Sobrenome:</label>
				<div class="col-sm-4">
					<input type="text" name="sn" class="form-control" id="sn" value="<?= $req[0]['sn'][0]; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="description">Departamento:</label>
				<div class="col-sm-4">
					<input type="text" name="description" class="form-control"
						id="description" value="<?= $req[0]['description'][0]; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="mail">E-mail:</label>
				<div class="col-sm-4">
					<input type="email" name="mail" class="form-control" id="mail" value="<?= $req[0]['mail'][0]; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="st">Estado:</label>
				<div class="col-sm-4">
					<input type="text" name="st" class="form-control" id="st" value="<?= $req[0]['st'][0]; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="l">Cidade:</label>
				<div class="col-sm-4">
					<input type="text" name="l" class="form-control" id="l" value="<?= $req[0]['l'][0]; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="uid">Login:</label>
				<div class="col-sm-4">
					<input type="text" name="uid" class="form-control" id="uid" value="<?= $req[0]['uid'][0]; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="userPassword">Senha:</label>
				<div class="col-sm-4">
					<input type="password" name="userPassword" class="form-control"
						id="userPassword" value="<?= $req[0]['userpassword'][0]; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="telephoneNumber">Ramal:</label>
				<div class="col-sm-4">
					<input type="text" name="telephoneNumber" class="form-control"
						id="telephoneNumber"value="<?= $req[0]['telephonenumber'][0]; ?>"  />
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-primary" value="Atualizar" />
				</div>
			</div>


		</form>
		
		<?php

if ($_POST) {
    
    /*[giveName] => Thamiris
    [sn] => Martins
    [description] => Jornalismo
    [mail] => thamiris.martins@example.com
    [st] => PA
    [l] => Itupiranga
    [uid] => thamiris.martins
    [userPassword] => 123456
    [telephoneNumber] => 9402*/
    
    
    $entry = array(
        'cn' => $_POST['giveName'] . " " . $_POST['sn'],
        'displayName' => $_POST['giveName'] . " " . $_POST['sn'],
        'givenName' => $_POST['giveName'],
        'sn' => $_POST['sn'],
        'description' => $_POST['description'],
        'mail' => $_POST['mail'],
        'st' => $_POST['st'],
        'l' => $_POST['l'],
        'uid' => $_POST['uid'],
        'userPassword' => $_POST['userPassword'],
        'telephoneNumber' => $_POST['telephoneNumber']
    );
    
    $dn = "cn={$entry['cn']},ou=Usuarios,dc=example,dc=com";
    
    try {
        
        $ldap = LDAPConnection::getConnection()->connection();
        
        $update = new LDAPGateway();
        $req = $update->update($ldap, $dn, $entry);
        
        if($req){
            header('Location: index.php');
            exit();
        }
        
    } catch (Exception $e) {
        
        echo $e->getMessage();
    }
}

?>

	</div>
	<!-- <div class="container"> -->

</body>
</html>