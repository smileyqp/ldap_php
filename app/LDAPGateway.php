<?php
namespace app;

class LDAPGateway
{   
    
    private $rows;
    
    public function create($connection, string $dn, array $entry) :bool
    {
        return ldap_add($connection, $dn, $entry);
    }
    
    public function read($connection, string $base_dn, string $filter, array $attributes = [] ) :array
    {
        $result = ldap_search ($connection, $base_dn, $filter, $attributes);
        
        $this->rows = ldap_count_entries($connection, $result);
        
       return $this->getEntries($connection, $result);
        
    }
    
    public function readOne($connection, string $dn, string $filter, array $attributes = []) :array
    {
       $result = ldap_read($connection, $dn, $filter, $attributes);
       return $this->getEntries($connection, $result);
       
    }
    
    public function getEntries($connection, $result) :array
    {
        return ldap_get_entries($connection, $result);
        
    }
    
    public function update($connection, string $dn, array $entry) :bool
    {
        return ldap_modify($connection, $dn, $entry);
    }
    
    public function delete($connection, string $dn) :bool
    {
        return ldap_delete($connection, $dn);
    }
    
    public function getRows()
    {
        return $this->rows;
    }
}

