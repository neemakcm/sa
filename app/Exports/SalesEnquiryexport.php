<?php

namespace App\Exports;
use Modules\SalesEnquiry\Entities\SalesEnquiry;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

class SalesEnquiryexport extends DefaultValueBinder implements FromCollection,WithMapping,ShouldAutoSize,WithHeadings
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
            $value->first_name.' '.$value->last_name,
            $value->mobile,
            $value->email,
            $value->address_1,
            $value->address_2,
            $value->district,
            $value->states->name,
            $value->pincode,
            $value->enquiry_type,
            $value->message,
            storage_url().'/'.$value->invoice
        ];
    }

    public  function Collection()
    {
        
        $request = SalesEnquiry::with('states');
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
            'Name',
            'Mobile',
            'Email',
            'Address 1',
            'Address 2',
            'District/City/Town',
            'State',
            'Pincode',
            'Enquiry Type',
            'Message',
            'Invoice / Warranty Card'
        ];
    }
}
