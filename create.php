<?php
use app\LDAPConnection;
use app\LDAPGateway;

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require 'bootstrap/autoload.php';
require 'app/utils/helpers.php';

if ($_POST) {
    
    $entry = array(
        'objectClass' => array(
            "top",
            "person",
            "organizationalPerson",
            "inetOrgPerson"
        ),
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
        
        $add = new LDAPGateway();
        $req = $add->create($ldap, $dn, $entry);
        
        if($req){
            header('Location: index.php');
            exit();
        }
        
    } catch (Exception $e) {
        
        echo $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cadastrar Usuário</title>

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

		<h1>Cadastrar Usuário</h1>

		<form class="form-horizontal" method="post" action="">

			<div class="form-group">
				<label class="control-label col-sm-2" for="giveName">Nome:</label>
				<div class="col-sm-4">
					<input type="text" name="giveName" class="form-control"
						id="giveName" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="sn">Sobrenome:</label>
				<div class="col-sm-4">
					<input type="text" name="sn" class="form-control" id="sn" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="description">Departamento:</label>
				<div class="col-sm-4">
					<input type="text" name="description" class="form-control"
						id="description" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="mail">E-mail:</label>
				<div class="col-sm-4">
					<input type="email" name="mail" class="form-control" id="mail" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="st">Estado:</label>
				<div class="col-sm-4">
					<input type="text" name="st" class="form-control" id="st" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="l">Cidade:</label>
				<div class="col-sm-4">
					<input type="text" name="l" class="form-control" id="l" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="uid">Login:</label>
				<div class="col-sm-4">
					<input type="text" name="uid" class="form-control" id="uid" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="userPassword">Senha:</label>
				<div class="col-sm-4">
					<input type="password" name="userPassword" class="form-control"
						id="userPassword" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="telephoneNumber">Ramal:</label>
				<div class="col-sm-4">
					<input type="text" name="telephoneNumber" class="form-control"
						id="telephoneNumber" />
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-primary" value="Cadastrar" />
				</div>
			</div>


		</form>

	</div>
	<!-- <div class="container"> -->

</body>
</html>