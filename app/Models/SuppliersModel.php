<?php

namespace App\Models;

use CodeIgniter\Model;

class SuppliersModel extends Model
{
    protected $table            = 'suppliers';
    protected $primaryKey       = 'id';
    protected $protectFields    = true;
    protected $allowedFields    = ['supplier_company', 'phone', 'address', 'description'];

    // Dates
    protected $useTimestamps = true;

    public function getSuppliers($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
