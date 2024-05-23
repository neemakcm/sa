<?php

namespace App\Exports;
use Modules\Products\Entities\ProductFeedback;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\Exportable;
class ProductFeedbackexport extends DefaultValueBinder implements FromCollection,WithMapping,ShouldAutoSize,WithHeadings
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
            $value->product->category->name,
            $value->product->name,
            $value->product_model,
            $value->serial_number,
            date('Y-m-d',strtotime($value->created_at)),
            $value->first_name.' '.$value->last_name,
            $value->mobile,
            $value->email,
            $value->address_1,
            $value->address_2,
            $value->district,
            $value->state,
            $value->pincode,
            $value->feedback_subject,
            $value->feedback_description,
            storage_url().'/'.$value->attachment
        ];
    }

    public  function Collection()
    {
        $feedback= ProductFeedback::wherenotNull('id');
        if($this->start_date)
        {
            $feedback->where(function($a){
                $a->whereDate('created_at','>=',$this->start_date)->whereDate('created_at','<=',$this->end_date);
            });
        }
         $feedback=$feedback->get();
         return $feedback;
    }
    public function headings(): array
    {
        return [
            'Product Category',
            'Product',
            'Model Number',
            'Serial Number',
            'Feedback Date',
            'Name','Mobile',
            'Email',
            'Address 1',
            'Address 2',
            'District/City/Town',
            'State',
            'Pincode',
            'Subject',
            'Feedback',
            'Attached Document'
        ];
    }
}
