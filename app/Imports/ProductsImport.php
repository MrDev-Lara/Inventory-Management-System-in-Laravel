<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'product_name'=> $row[0],
            'cat_id'=> $row[1],
            'product_image'=> $row[2],
            'product_route'=> $row[3],
            'product_row'=> $row[4],
            'buying_price'=> $row[5],
            'selling_price'=> $row[6],
        ]);
    }
}
