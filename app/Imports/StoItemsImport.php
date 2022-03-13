<?php

namespace App\Imports;

use App\Models\Store\StoItem;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class StoItemsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new StoItem([
            'title_en'        => $row['title_en'],
            'title_ar'        => $row['title_en'],
            'item_type'       => $row['item_type'],
            'cost'            => $row['cost'],
            'sale_price'      => $row['sale_price'],
            'alert_quantity'  => $row['alert_quantity'],
            'cat_id'          => $row['cat_id'],
            'unit_id'         => $row['unit_id'],
            'sale_unit_id'    => $row['unit_id'],
            'purchase_unit_id'=> $row['unit_id'],
            'code'            => $row['code'],
            'brand_id'        => $row['brand_id'],
            'description'     => $row['description'],
            'created_by'      => Auth::user()->id,
        ]);
    }
}
