<?php

namespace App\Models;

use CodeIgniter\Model;

class SecondDbModel extends Model
{
    protected $DBGroup = 'second_db'; // Specifies the second database group
    protected $table = 'fa_security_roles'; 
    public function getSecurityRolesAreas($roleId)
    {
        
        $query = $this->select('areas')
                      ->where('id', $roleId)
                      ->get('fa_security_roles');
echo "<pre>";print_r($query);exit;
        if ($query->num_rows() > 0) {
            return $query->getRow()->areas;
        } else {
            return false; // No matching role found
        }
    }
}
