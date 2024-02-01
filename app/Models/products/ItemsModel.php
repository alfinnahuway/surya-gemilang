<?php

namespace App\Models\Products;

use CodeIgniter\Model;

class ItemsModel extends Model
{
    protected $table            = 'items';
    protected $primaryKey       = 'barcode';
    protected $useAutoIncrement = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['barcode', 'product', 'category_id', 'unit_id', 'supplier_id', 'stock', 'product_image', 'price', 'description'];

    // Dates
    protected $useTimestamps = true;

    // get item join category, unit and supplier
    public function getItem()
    {
        return $this->join('categories', 'categories.id = items.category_id')
            ->join('units', 'units.id = items.unit_id')
            ->join('suppliers', 'suppliers.id = items.supplier_id')
            ->select('items.*, categories.category , units.name as name, suppliers.supplier_company as supplier')
            ->findAll();
    }


    public function getBarcode($category)
    {
        $category = substr($category, 0, 3);
        $barcode = $category . rand(100, 999);
        $check = $this->where('barcode', $barcode)->first();
        if ($check) {
            $this->getBarcode($category);
        } else {
            return $barcode;
        }
    }

    public function sumQtyItems($category)
    {
        return $this->join('transaction_product', 'transaction_product.items_barcode = items.barcode')
            ->select('items.product, SUM(transaction_product.qty_product) as qty_product')
            ->where('items.category_id', $category['id'])
            ->groupBy('items.product')
            ->findAll();
    }
}
