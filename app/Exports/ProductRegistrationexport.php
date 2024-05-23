<?php

namespace App\Exports;
use Modules\Products\Entities\ProductRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;
class ProductRegistrationexport extends DefaultValueBinder implements FromCollection,WithMapping,ShouldAutoSize,WithHeadings
{
   
    use Exportable;
    public function __construct( $start_date = null, $end_date = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function map($value): array
    {
      
        return [
            $value->products == null?'---':$value->products->sku,
            $value->serial_number,
            $value->first_name.' '.$value->last_name,
            $value->mobile,
            $value->email,
            $value->address_1,
            $value->address_2,
            $value->district,
            $value->state,
            $value->pincode,
            $value->purchased_date,
            $value->purchased_from,
            storage_url().'/'.$value->document
        ];
    }

    public  function Collection()
    {
        $products = ProductRegistration::select('*',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%Y-%c-%d") as change_date'))->with('products');
        
        // $products = ProductRegistration::with('product.category')->has('product');
        if($this->start_date)
        {
            $products->where(function($a){
                $a->whereDate('created_at','>=',$this->start_date)->whereDate('created_at','<=',$this->end_date);
            });
        }
         $products=$products->get();
        //  dd($products);
         return $products;
    }
    public function headings(): array
    {
        return [
            'Model Number',
            'Serial Number',
            'Name',
            'Mobile',
            'Email',
            'Address 1',
            'Address 2',
            'District/City/Town',
            'State',
            'Pin Code',
            'Purchase Date',
            'Purchased From',
            'Attached Document'
        ];
    }
}
