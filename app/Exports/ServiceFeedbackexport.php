<?php

namespace App\Exports;
use Modules\Service\Entities\ServiceFeedback;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\Exportable;
class ServiceFeedbackexport extends DefaultValueBinder implements FromCollection,WithMapping,ShouldAutoSize,WithHeadings
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
      
        if($value->rating == 1)
        $rate = 'Very Bad';
        else if($value->rating == 2)
            $rate = 'Bad';
        else if($value->rating == 3)
            $rate = 'Average';
        else if($value->rating == 4)
            $rate = 'Good';
        else
            $rate = 'Very Good';
        return [
            $value->first_name.' '.$value->last_name,
            $value->mobile,
            $value->email,
            $value->case_number,
            $value->is_fixed == 1?'Yes':'No',
            $rate,
            $value->comments
        ];
    }

    public  function Collection()
    {
        $feedback= ServiceFeedback::wherenotNull('id');
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
            'Name',
            'Mobile',
            'Email',
            'Case Number',
            'Was your issue fixed?',
            'Overall, how satisfied are you with the service provided?',
            'Additional comments'
           
        ];
    }
}
