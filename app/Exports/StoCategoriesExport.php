<?php

namespace App\Exports;

use App\Models\Store\StoCategory;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class StoCategoriesExport   implements FromCollection, Responsable ,WithHeadings
{

    use Exportable;


    public function headings():array{
        return [
            'id',
            'title',
            'parent id',
            'level',
        ];
    }

    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'categories.xlsx';

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
        
        $categories = StoCategory::orderBy('parent_id','asc')
            ->select(
            'id',
            'title_en',
            'parent_id',
            'level')->get();

        return $categories;
    }
}
