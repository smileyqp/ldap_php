<?php
namespace app;

class LDAPConnection
{
    private static $connection;
    
    public function connection()
    {
        $params = parse_ini_file(dirname(__DIR__) . DIRECTORY_SEPARATOR . "config/ldap.ini");
        
        if($params === false){
            throw new \Exception("Erro ao ler o arquivo de configuração");
        }

        $ldap = ldap_connect($params['host'], $params['port']);
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_bind($ldap, $params['bind'], $params['password']);
        
        return $ldap;
    }
    
    public static function getConnection()
    {
        if(null === static::$connection){
            static::$connection = new static();
        }
        
        return static::$connection;
    }
}

