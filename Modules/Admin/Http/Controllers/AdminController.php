<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ProductEnquiry\Entities\ProductEnquiry;
use Modules\SalesEnquiry\Entities\SalesEnquiry;
use Modules\Service\Entities\ServiceRequest;
use Modules\Products\Entities\Products;
use DB,Auth;
use Session;
use Artisan;

class AdminController extends Controller
{
    public function forbidden()
    {
        return view('403');
    }

    public function dashboard()
    {
        $product_enquiry=(new ProductEnquiry())->productEnquiryCount();
        $sales_enquiry=(new SalesEnquiry())->salesEnquiryCount();
        $service_request_count=(new ServiceRequest())->requestCount();
        $product_count=(new Products())->productCount();
        return view('admin::dashboard',['product_enquiry_count'=>$product_enquiry,'sales_enquiry_count'=>$sales_enquiry,'service_request_count'=>$service_request_count,'product_count'=>$product_count]);
    }


    public function filterDashboard(Request $request)
    {
    	$from = $request->from;
    	$to = $request->to;

    	$count['new_male'] = Users::where('gender',0)->where('is_complete',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->count();
        $count['new_female'] = Users::where('gender',1)->where('is_complete',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->count();
        $count['new_others'] = Users::where('gender',2)->where('is_complete',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->count();

        
        $total = VoucherLog::with('voucher_details')->whereHas('voucher_details', function($q)
                            {
                                $q->whereDate('expiry_date','>=',date('Y-m-d'));
                            })->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',3)->where('type',2)->sum('count');

        $voucher_removed = Vouchers::whereDate('expiry_date','>=',date('Y-m-d'))->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get()->sum('loyalty_deleted');
        $voucher_used = UserVoucherUsage::whereHas('voucher_details', function($q)
                                {
                                    $q->whereDate('expiry_date','>=',date('Y-m-d'));
                                })->whereDate('date','>=',$from)->whereDate('date','<=',$to)->get()->sum('points_used');
        $count['liability'] = $total-($voucher_used+$voucher_removed) < 0?0:$total-($voucher_used+$voucher_removed);

        $total = VoucherLog::with('voucher_details')->whereHas('voucher_details', function($q)
                            {
                                $q->whereDate('expiry_date','<',date('Y-m-d'));
                            })->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',3)->where('type',2)->sum('count');
        $voucher_removed = Vouchers::whereDate('expiry_date','<',date('Y-m-d'))->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get()->sum('loyalty_deleted');
        $voucher_used = UserVoucherUsage::whereHas('voucher_details', function($q)
                                {
                                    $q->whereDate('expiry_date','<',date('Y-m-d'));
                                })->whereDate('date','>=',$from)->whereDate('date','<=',$to)->get()->sum('points_used');
        $count['expired_liability'] = $total-($voucher_used+$voucher_removed) < 0?0:$total-($voucher_used+$voucher_removed);


        $count['redumption'] = UserPointTransactionLog::whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('type',1)->sum('points');

        //$count['expired_redumption'] = $this->getTotalExpiringPoints('month',$from,$to);

        $count['mobile_count'] = BillSubmissions::whereDate('submitted_date','>=',$from)->whereDate('submitted_date','<=',$to)->where('submitted_from','user app')->count();
        $count['admin_approved'] = BillSubmissions::whereDate('submitted_date','>=',$from)->whereDate('submitted_date','<=',$to)->where('submitted_from','admin')->count();
        $count['desk_value'] = BillSubmissions::whereDate('submitted_date','>=',$from)->whereDate('submitted_date','<=',$to)->where('submitted_from','loyalty app')->count();
        $count['pending'] = BillSubmissions::whereDate('submitted_date','>=',$from)->whereDate('submitted_date','<=',$to)->where('status',1)->count();


        $count['total_sales'] = UserVoucherUsage::sum('points_used');
        $count['sales'] = UserVoucherUsage::whereDate('date','>=',$from)->whereDate('date','<=',$to)->sum('points_used');

        $total = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('from_user',1)->where('to_user',1)->where('type',2)->get();
        $count['finance'] = 0;
        foreach ($total as $value) 
        {
            $count['finance'] += $value->count * $value->voucher_details->voucher_price;
        }
        $count['inhand'] = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',2)->where('type',2)->get()->sum('count');
        $count['loyalty'] = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',3)->where('type',3)->get()->sum('count');

        $desk_value = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',3)->where('type',3)->get();
        $count['desk_value'] = 0;
        foreach ($desk_value as $value) 
        {
            $count['desk_value'] += $value->count * $value->voucher_details->voucher_price;
        }
        $count['desk_count'] = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',3)->where('type',3)->get()->sum('count');

        $count['active'] = Users::where('status',1)->where('is_complete',1)->count();
        $count['in_active'] = Users::where('status',0)->count();
        $count['login'] = UserDevices::where('is_logout',0)->distinct('user_id')->count();

        echo json_encode($count);
    }

    public function getDashboardChart()
    {
    	$maxDays = date('t');
    	$from = date('Y-m-01');
    	$to = date('Y-m-'.$maxDays);

    	$bills = BillSubmissions::select('*',DB::raw('count(id) as count,DAY(submitted_date) as day'))
    							->whereDate('submitted_date','>=',$from)
    							->whereDate('submitted_date','<=',$to)
								->groupBy('bill_submissions.submitted_date')
								->orderBy('submitted_date')
								->get();

		foreach ($bills as $key => $value) 
		{
          $intermediate_day_plot[$value->day]     = (int)$value->count;
        }

		for($i = 1; $i <= $maxDays; $i++)
        {
          if(isset($intermediate_day_plot[$i]))
            $day_plot[$i] = $intermediate_day_plot[$i];
          else
            $day_plot[$i] = 0;
        }

		echo json_encode($day_plot);
    }



    function getTotalExpiringPoints($type,$from,$to)
    {
        $users = UserPointTransactionLog::whereIn('type',array(1,3,5))->distinct('user_id')->get();

        $total = 0;
        $year = date('Y');

        foreach ($users as $key => $value) 
        {
            $balance = UserPointTransactionLog::where('user_id',$value->user_id)->whereIn('type',array(1,3,5))->get();
            if($balance == null)
                $balance = 0;
            else
                $balance = $balance->sum('points'); 


            $count = UserPointTransactionLog::where('user_id',$value->user_id)->whereIn('type',array(2,4))->count();

            if($count == 1)
            {
                $points = DB::table('user_point_transaction_log AS o')
                            ->select('o.id','o.points','o.created_at','o.date',DB::Raw('(SELECT SUM(`points`) FROM user_point_transaction_log WHERE type IN (2,4) AND user_id = '.$value->user_id.') as total'))
                            ->whereIn('type',array(2,4))
                            ->where('user_id',$value->user_id)
                            ->orderBy('id','desc')
                            ->first();
            }
            else
            {
                $points = DB::table('user_point_transaction_log AS o')
                            ->select('o.id','o.points','o.created_at','o.date',DB::Raw('(SELECT SUM(`points`) FROM user_point_transaction_log WHERE id <= o.id AND type = 2 AND user_id = '.$value->user_id.') as total'))
                            ->whereIn('type',array(2,4))
                            ->where('user_id',$value->user_id)
                            ->having('total','<=',$balance)
                            ->orderBy('id','desc')
                            ->first();
            }

            $epoints = 0;

            if($points != null)
            {
                $epoint = UserPointTransactionLog::where('id','>',$points->id)->whereIn('type',array(2,4))->where('user_id',$value->user_id)->first();

                if($epoint == null)
                {
                    $expire['points'] = $points->total-$balance;
                    $expire['date'] = date("Y-m-d", strtotime($points->date . " + 1 year"));
                }
                else
                {
                    if($points->total == $balance)
                    {
                        $epoints = $epoint->points;
                        $edate = date("Y-m-d", strtotime($points->date . " + 1 year"));
                    }
                    else
                    {
                        $epoints = ($points->total+$epoint->points)-$balance;
                        $edate = date("Y-m-d", strtotime($epoint->date . " + 1 year"));
                    }
                }
                
            }

            if($epoints != 0)
            {
                if($type == 'month')
                {
                    if($edate >= $from && $edate <= $to)
                        $total += $epoints;
                }
                elseif ($type == 'year') 
                {
                    if(date("Y", strtotime($epoint->date . " + 1 year")) == $year)
                        $total += $epoints;
                }
            }

        }

        

        return $total;
    }

    public function signature()
    {
        return view('admin::signature_dashboard');
    }
    public function cachClear()
    {
        Artisan::call('page-cache:clear');
        Session::flash('message', 'Page Cache Cleared' );
        Session::flash('alert-class', 'alert-success');
        return redirect('admin/dashboard');
        // $product_enquiry=(new ProductEnquiry())->productEnquiryCount();
        // $sales_enquiry=(new SalesEnquiry())->salesEnquiryCount();
        // $service_request_count=(new ServiceRequest())->requestCount();
        // $product_count=(new Products())->productCount();
        // return view('admin::dashboard',['product_enquiry_count'=>$product_enquiry,'sales_enquiry_count'=>$sales_enquiry,'service_request_count'=>$service_request_count,'product_count'=>$product_count]);
    }
}
