<?php

use app\LDAPConnection;
use app\LDAPGateway;

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require 'bootstrap/autoload.php';
require 'app/utils/helpers.php';

if ($_GET['dn']) {
    
    try {
        
        $ldap = LDAPConnection::getConnection()->connection();
        
        $delete = new LDAPGateway();
        $req = $delete->delete($ldap, $_GET['dn']);
        
        
        if($req){
            header('Location: index.php');
            exit();
        }
        
        
        
    } catch (Exception $e) {
        
        echo $e->getMessage();
    }
}