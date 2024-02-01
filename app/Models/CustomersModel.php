<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $protectFields    = true;
    protected $allowedFields    = ['full_name', 'phone', 'address'];

    // Dates
    protected $useTimestamps = true;

    public function getCustomers($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
