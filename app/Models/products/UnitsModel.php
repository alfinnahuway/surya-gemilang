<?php

namespace App\Models\Products;

use CodeIgniter\Model;

class UnitsModel extends Model
{
    protected $table            = 'units';
    protected $allowedFields    = ['name'];
    // Dates
    protected $useTimestamps = false;
}
