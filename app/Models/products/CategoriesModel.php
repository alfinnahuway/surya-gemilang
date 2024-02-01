<?php

namespace App\Models\Products;

use CodeIgniter\Model;

class CategoriesModel extends Model
{
    protected $table            = 'categories';
    protected $allowedFields    = ['category'];
    // Dates
    protected $useTimestamps = true;
}
