<?php

namespace App\Exports;
use Modules\Service\Entities\ServiceRequest;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

class ServiceRequestexport extends DefaultValueBinder implements FromCollection,WithMapping,ShouldAutoSize,WithHeadings
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
            $value->complaint_id,
            $value->reference_number,
            $value->complaint_number,
            $value->change_date,
            $value->service_type,
            $value->product->name,
            $value->model_number,
            $value->product->category == null?'---':$value->product->category->name,
            $value->serial_number,
            $value->purchased_date,
            $value->warranty_type,
            storage_url().'/'.$value->proof,
            $value->description,
            $value->first_name.' '.$value->last_name,
            $value->mobile,
            $value->email,
            $value->address_1,
            $value->address_2,
            $value->district,
            $value->state,
            $value->pincode
        ];
    }

    public  function Collection()
    {
        $request=  ServiceRequest::select('*',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%Y-%c-%d") as change_date'))->with('product.category','requestStatus')->has('product');
        if($this->start_date)
        {
            $request->where(function($a){
                $a->whereDate('created_at','>=',$this->start_date)->whereDate('created_at','<=',$this->end_date);
            });
        }
         $request=$request->get();
         return $request;
    }
    public function headings(): array
    {
        return [
            'Complaint ID',
            'Reference Number',
            'complaint Number',
            'Date',
            'Service Type',
            'Product Name',
            'Model Number',
            'Category',
            'Serial Number',
            'Purchase Date',
            'Warranty Type',
            'Upload Proof of Purchase',
            'Description',
            'Name',
            'Mobile',
            'Email',
            'Address 1',
            'Address 2',
            'District/City/Town',
            'State',
            'Pin Code'
        ];
    }
}
