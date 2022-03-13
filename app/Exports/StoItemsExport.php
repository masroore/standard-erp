<?php

namespace App\Exports;

use App\Models\Store\StoItem;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class StoItemsExport   implements FromCollection, Responsable ,WithHeadings
{

    use Exportable;


    public function headings():array{
        return [
            'title_en',
            'barcode',
            'item_type',
            'cost',
            'sale_price',
            'alert_quantity',
            'cat_id',
            'brand_id',
            'unit_id',
            'code',
            'description',
        ];
    }

    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'items.xlsx';

    /**
    * Optional Writer Type
    */
    private $writerType = Excel::XLSX;

    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //dd('collect');
         $items = StoItem::all(
            'title_en',
            'barcode',
            'item_type',
            'cost',
            'sale_price',
            'alert_quantity',
            'cat_id',
            'brand_id',
            'unit_id',
            'code',
            'description'
         );
        // dd($items);
        return $items;
    }
}
