<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Admin\Entities\Statistics;
use Modules\Offers\Entities\Offers;
use Modules\Events\Entities\Events;
use Modules\Shops\Entities\Brands;
use Modules\Shops\Entities\Categories;
use Modules\Shops\Entities\Shops;
use Modules\Users\Entities\Users;
use Modules\Users\Entities\UserOtp;
use Modules\Users\Entities\UserDevices;
use Modules\Users\Entities\UserVehicles;
use Modules\Users\Entities\UserNumberChange;
use Modules\Loyalty\Entities\UserPointTransactionLog;
use Modules\Vouchers\Entities\Vouchers;
use Modules\Vouchers\Entities\VoucherLog;
use Modules\Vouchers\Entities\UserVoucherUsage;
use Modules\Vouchers\Entities\VoucherDeleteLog;
use Modules\Loyalty\Entities\BillSubmissions;
use Modules\Loyalty\Entities\PointAdjustments;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', -1);                                                                                                                                                           
use DB;

class StatisticsController extends Controller
{
    /*public function loadStatistics()
    {
        //Events

        $total_events = Events::count();
        $active_events = Events::where('status',1)->whereDate('end_date','>',date('Y-m-d'))->count();

        $events_count = array();

        $events_count['total'] = $total_events;
        $events_count['active'] = $active_events;

        $event_statistics = Statistics::where('page','events')->first();
        if($event_statistics == null)
        {
            $event_statistics = new Statistics;
            $event_statistics->page = 'events';
        }
        $event_statistics->statistics = json_encode($events_count);
        $event_statistics->save();


        //Offers

        $total_offers = Offers::count();
        $active_offers = Offers::whereHas('offer_shop', function($q)
                            {
                                $q->whereNull('deleted_at');
                            })->where('status',1)->whereDate('offer_to','>=',date('Y-m-d'))->count();

        $offers_count = array();
        
        $offers_count['total'] = $total_offers;
        $offers_count['active'] = $active_offers;

        $offers_statistics = Statistics::where('page','offers')->first();
        if($offers_statistics == null)
        {
            $offers_statistics = new Statistics;
            $offers_statistics->page = 'offers';
        }
        $offers_statistics->statistics = json_encode($offers_count);
        $offers_statistics->save();



        //Shops

        $brand = Brands::count();

        $brand_statistics = Statistics::where('page','brand')->first();
        if($brand_statistics == null)
        {
            $brand_statistics = new Statistics;
            $brand_statistics->page = 'brand';
        }
        $brand_statistics->statistics = json_encode($brand);
        $brand_statistics->save();



        $category = Categories::count();

        $category_statistics = Statistics::where('page','category')->first();
        if($category_statistics == null)
        {
            $category_statistics = new Statistics;
            $category_statistics->page = 'category';
        }
        $category_statistics->statistics = json_encode($category);
        $category_statistics->save();



        $shop_split = DB::table('shops')
                        ->select(DB::raw('count(shops.id) as shop_count,floor'))
                        ->whereNull('deleted_at')
                        ->groupBy('floor')
                        ->get();

        $shop_count = array();

        foreach ($shop_split as $value) 
        {
            $shop_count[$value->floor] = $value->shop_count;
        }

        $shops_statistics = Statistics::where('page','shops')->first();
        if($shops_statistics == null)
        {
            $shops_statistics = new Statistics;
            $shops_statistics->page = 'shops';
        }
        $shops_statistics->statistics = json_encode($shop_count);
        $shops_statistics->save();



        //Users

        $user_count['male'] = Users::where('gender',0)->where('is_complete',1)->count();
        $user_count['female'] = Users::where('gender',1)->where('is_complete',1)->count();
        $user_count['others'] = Users::where('gender',2)->where('is_complete',1)->count();
        $user_count['total'] = $user_count['male']+$user_count['female']+$user_count['others'];

        $users_statistics = Statistics::where('page','users')->first();
        if($users_statistics == null)
        {
            $users_statistics = new Statistics;
            $users_statistics->page = 'users';
        }
        $users_statistics->statistics = json_encode($user_count);
        $users_statistics->save();



        $request['total'] = UserNumberChange::where('is_approved',0)
                            ->whereHas('user_details', function($q)
                            {
                                $q->where('is_complete',1);
                            })
                            ->has('user_details')->count();

        $request_statistics = Statistics::where('page','request')->first();
        if($request_statistics == null)
        {
            $request_statistics = new Statistics;
            $request_statistics->page = 'request';
        }
        $request_statistics->statistics = json_encode($request);
        $request_statistics->save();



        $changed['total'] = UserNumberChange::where('is_approved',1)->count();

        $changed_statistics = Statistics::where('page','changed')->first();
        if($changed_statistics == null)
        {
            $changed_statistics = new Statistics;
            $changed_statistics->page = 'changed';
        }
        $changed_statistics->statistics = json_encode($changed);
        $changed_statistics->save();



        //Vouchers

        //Finance

        $finance['shops'] = Vouchers::groupBy('shop_id')->get()->count();
        $total = VoucherLog::with('voucher_details')->whereHas('voucher_details', function($q)
                            {
                                //$q->whereDate('expiry_date','>',date('Y-m-d'));
                            })->where('from_user',0)->where('to_user',0)->where('type',2)->get();
        
        $finance['total'] = 0;

        foreach ($total as $value) 
        {
            $finance['total'] += ($value->count+$value->voucher_details->count) * $value->voucher_details->voucher_price;
        }

        $finance['removed'] = Vouchers::get()->sum('finance_deleted');
        $finance['added'] = VoucherLog::whereHas('voucher_details', function($q)
                            {
                                //$q->whereDate('expiry_date','>',date('Y-m-d'));
                            })->where('from_user',0)->where('to_user',0)->where('type',2)->get()->sum('count');

        $finance_statistics = Statistics::where('page','finance')->first();
        if($finance_statistics == null)
        {
            $finance_statistics = new Statistics;
            $finance_statistics->page = 'finance';
        }
        $finance_statistics->statistics = json_encode($finance);
        $finance_statistics->save();

        
        //Inhand

        $total = VoucherLog::with('voucher_details')->whereHas('voucher_details', function($q)
                                {
                                    //$q->whereDate('expiry_date','>',date('Y-m-d'));
                                })->where('to_user',1)->where('type',2)->get();
        $total_points = 0;

        foreach ($total as $value) 
        {
            $total_points += $value->count*$value->voucher_details->voucher_price;
        }
        $inhand['total'] = $total_points;

        $inhand['removed'] = Vouchers::whereDate('expiry_date','>',date('Y-m-d'))->get()->sum('in_hand_deleted');
        $inhand['transfered'] = VoucherLog::whereHas('voucher_details', function($q)
                            {
                                $q->whereDate('expiry_date','>',date('Y-m-d'));
                            })->where('from_user',1)->where('type',1)->get()->sum('count');


        $inhand_statistics = Statistics::where('page','inhand')->first();
        if($inhand_statistics == null)
        {
            $inhand_statistics = new Statistics;
            $inhand_statistics->page = 'inhand';
        }
        $inhand_statistics->statistics = json_encode($inhand);
        $inhand_statistics->save();


        //Loyalty

        $total = VoucherLog::with('voucher_details')->where('to_user',2)->where('type',2)->has('voucher_details')->get();
        $loyalty['total'] = 0;

        foreach ($total as $value) 
        {
            $loyalty['total'] += $value->count * $value->voucher_details->voucher_price;
        }

        $loyalty['removed'] = Vouchers::get()->sum('loyalty_deleted');

        $loyalty['used'] = UserVoucherUsage::select(DB::raw('sum(quantity) as total'))->first()->total;


        $loyalty_statistics = Statistics::where('page','loyalty')->first();
        if($loyalty_statistics == null)
        {
            $loyalty_statistics = new Statistics;
            $loyalty_statistics->page = 'loyalty';
        }
        $loyalty_statistics->statistics = json_encode($loyalty);
        $loyalty_statistics->save();




        //Submissions
        $submissions['barcode'] = BillSubmissions::where('bill_type',2)->count();
        $submissions['mobile'] = BillSubmissions::where('submitted_from','user app')->count();
        $submissions['other'] = BillSubmissions::where('submitted_from','!=','user app')->count();
        $submissions['pending'] = BillSubmissions::where('status',0)->count();
        $submissions['total'] = Users::get()->sum('total_spend');
        $submissions['earned'] = Users::get()->sum('bill_points');

        $submissions_statistics = Statistics::where('page','submissions')->first();
        if($submissions_statistics == null)
        {
            $submissions_statistics = new Statistics;
            $submissions_statistics->page = 'submissions';
        }
        $submissions_statistics->statistics = json_encode($submissions);
        $submissions_statistics->save();



        //Redumptions

        $redumptions['customer'] = UserVoucherUsage::groupBy('user_id')->count();
        $redumptions['voucher'] = UserVoucherUsage::groupBy('voucher_id')->count();
        $redumptions['points'] = UserVoucherUsage::sum('points_used');
        $redumptions['total'] = UserVoucherUsage::count();

        $redumptions_statistics = Statistics::where('page','redumptions')->first();
        if($redumptions_statistics == null)
        {
            $redumptions_statistics = new Statistics;
            $redumptions_statistics->page = 'redumptions';
        }
        $redumptions_statistics->statistics = json_encode($redumptions);
        $redumptions_statistics->save();


        //Expiring

        $from = date('Y-m-d');
        $to = date('Y').'-'.date('m').'-31';

        $expire_points = Vouchers::with(['added_counts' => function($q) {
                                    $q->where('to_user',3);
                                }])
                                ->with('voucher_brand','voucher_shop')
                                ->with(['user_usage' => function ($q) {
                                   $q->whereIn('status',array(1,2));
                                }])
                                ->whereDate('expiry_date','>=',$from)->whereDate('expiry_date','<=',$to)
                                ->whereHas('log_details', function($q)
                                {
                                    $q->where('to_user',3);
                                    $q->where('type',2);
                                })->where('status',1)->has('voucher_shop')->get();

        $vcount = 0;

        foreach ($expire_points as $key => $value) 
        {
            $added = $value->added_counts->sum('count');
            $usage = $value->user_usage->sum('quantity');
            $deleted = $value->desk_deleted;
            $balance = $added-($deleted+$usage);

            if($balance > 0)
                $vcount++;
        }

        $expiring_statistics = Statistics::where('page','expiring')->first();
        if($expiring_statistics == null)
        {
            $expiring_statistics = new Statistics;
            $expiring_statistics->page = 'expiring';
        }
        $expiring_statistics->statistics = json_encode($vcount);
        $expiring_statistics->save();



        //Dashboard

        $from = date('Y-m-01');
        $to = date('Y-m-d');

        $dashboard['new_male'] = Users::where('gender',0)->where('is_complete',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->count();
        $dashboard['new_female'] = Users::where('gender',1)->where('is_complete',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->count();
        $dashboard['new_others'] = Users::where('gender',2)->where('is_complete',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->count();


        $month_liability = Vouchers::whereDate('expiry_date','>=',date('Y-m-d'))->whereDate('expiry_date','<=',date('Y-m-31'))->where('is_hidden',0)->where('balance','>',0)->sum('balance');

        $dashboard['liability'] = $month_liability;


        $year_liability = Vouchers::whereDate('expiry_date','>=',date('Y-m-d'))->whereYear('expiry_date','=',date('Y'))->where('is_hidden',0)->where('balance','>',0)->sum('balance');

        $dashboard['ytd_liability'] = $year_liability;


        $month_expired_liability = Vouchers::whereDate('expiry_date','<',date('Y-m-d'))->whereDate('expiry_date','>=',date('Y-m-1'))->where('is_hidden',0)->sum('balance');

        $dashboard['expired_liability'] = $month_expired_liability;


        $year_liability_expired = Vouchers::whereDate('expiry_date','<',date('Y-m-d'))->whereYear('expiry_date','=',date('Y'))->where('is_hidden',0)->sum('balance');

        $dashboard['ytd_expired_liability'] = $year_liability_expired;


        $dashboard['redumption'] = UserPointTransactionLog::whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('type',1)->sum('points');
        $dashboard['ytd_redumption'] = UserPointTransactionLog::whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('type',1)->sum('points');


        $dashboard['mobile_count'] = BillSubmissions::whereDate('submitted_date','>=',$from)->whereDate('submitted_date','<=',$to)->whereIn('submitted_from',array('user app','Mobile App'))->count();
        $dashboard['admin_approved'] = BillSubmissions::whereDate('submitted_date','>=',$from)->whereDate('submitted_date','<=',$to)->whereIn('submitted_from', array('admin','Kiosk'))->count();
        $dashboard['desk_value'] = BillSubmissions::whereDate('submitted_date','>=',$from)->whereDate('submitted_date','<=',$to)->where('submitted_from','LIKE','loyalty app')->count();
        $dashboard['pending'] = BillSubmissions::whereDate('submitted_date','>=',$from)->whereDate('submitted_date','<=',$to)->where('status',0)->count();


        $dashboard['total_sales'] = UserVoucherUsage::sum('points_used');
        $dashboard['sales'] = UserVoucherUsage::whereIn('status',array(1,2))->whereDate('date','>=',$from)->whereDate('date','<=',$to)->sum('points_used');
        $dashboard['ytd_sales'] = UserVoucherUsage::whereIn('status',array(1,2))->whereYear('date',date('Y'))->sum('points_used');


        $total = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('from_user',0)->where('to_user',0)->where('type',2)->has('voucher_details')->sum('count');
        $added = Vouchers::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->sum('count');
        $dashboard['finance'] = $total+$added;
        $dashboard['inhand'] = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',1)->where('type',2)->has('voucher_details')->get()->sum('count');
        $dashboard['loyalty'] = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',2)->where('type',2)->has('voucher_details')->get()->sum('count');
        $dashboard['desk'] = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',3)->where('type',2)->has('voucher_details')->get()->sum('count');

        $desk_value = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',3)->where('type',2)->has('voucher_details')->get();
        $dashboard['desk_value'] = 0;
        foreach ($desk_value as $value) 
        {
            $dashboard['desk_value'] += $value->count * $value->voucher_details->voucher_price;
        }
        $dashboard['desk_count'] = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',3)->where('type',2)->has('voucher_details')->get()->sum('count');

        $dashboard['active'] = Users::where('status',1)->where('is_complete',1)->count();
        $dashboard['in_active'] = Users::where('status',0)->count();
        $dashboard['login'] = UserDevices::where('is_logout',0)->distinct('user_id')->count();

        $expiring_statistics = Statistics::where('page','dashboard_count')->first();
        if($expiring_statistics == null)
        {
            $expiring_statistics = new Statistics;
            $expiring_statistics->page = 'dashboard_count';
        }
        $expiring_statistics->statistics = json_encode($dashboard);
        $expiring_statistics->save();


        // Dashboard prev month stats

        $prev_from = date('Y-m-01', strtotime('-1 MONTH'));
        $prev_to = date('Y-m-d', strtotime($prev_from.' +30 DAYS'));

        $prev['new'] = Users::where('is_complete',1)->whereDate('created_at','>=',$prev_from)->whereDate('created_at','<=',$prev_to)->count();
        $prev['blocked'] = Users::where('is_complete',1)->where('is_blocked',1)->whereDate('created_at','>=',$prev_from)->whereDate('created_at','<=',$prev_to)->count();
        $prev['sales'] = BillSubmissions::whereDate('submitted_date','>=',$prev_from)->whereDate('submitted_date','<=',$prev_to)->sum('bill_amount');
        $prev['mobile_value'] = BillSubmissions::whereDate('submitted_date','>=',$prev_from)->whereDate('submitted_date','<=',$prev_to)->where('submitted_from','user app')->sum('bill_amount');
        $prev['total_redumption'] = UserVoucherUsage::whereDate('date','>=',$prev_from)->whereDate('date','<=',$prev_to)->whereIn('status',array(1,2))->sum('points_used');
        $prev['mobile_redumption_points'] = UserVoucherUsage::whereDate('date','>=',$prev_from)->whereDate('date','<=',$prev_to)->whereIn('status',array(1,2))->where('purchased_from','mobile app')->sum('points_used');
        $total = VoucherLog::with('voucher_details')->whereHas('voucher_details', function($q)
                            {
                                $q->whereDate('expiry_date','>',date('Y-m-d'));
                            })->whereDate('date','>=',$prev_from)->whereDate('date','<=',$prev_to)->where('to_user',3)->where('type',2)->has('voucher_details')->get();
        $voucher_total = 0;
        foreach ($total as $value) 
        {
            $voucher_total += $value->count * $value->voucher_details->voucher_price;
        }
        $voucher_removed = Vouchers::whereDate('expiry_date','>',date('Y-m-d'))->whereDate('created_at','>=',$prev_from)->whereDate('created_at','<=',$prev_to)->get()->sum('loyalty_deleted');
        $voucher_used = UserVoucherUsage::whereHas('voucher_details', function($q)
                                {
                                    $q->whereDate('expiry_date','>',date('Y-m-d'));
                                })->whereDate('date','>=',$prev_from)->whereDate('date','<=',$prev_to)->has('voucher_details')->get()->sum('points_used');
        $prev['liability'] = $voucher_total-($voucher_used+$voucher_removed);
        $prev['voucher_redeemed_sum'] = UserVoucherUsage::whereDate('date','>=',$prev_from)->whereDate('date','<=',$prev_to)->sum('points_used');


        $expiring_statistics = Statistics::where('page','prev_count')->first();
        if($expiring_statistics == null)
        {
            $expiring_statistics = new Statistics;
            $expiring_statistics->page = 'prev_count';
        }
        $expiring_statistics->statistics = json_encode($prev);
        $expiring_statistics->save();


        //Dashboard best seller

        $sellers = DB::table('vouchers')
                    ->select('title',DB::raw('(SELECT name FROM shops WHERE shops.id = vouchers.shop_id) as shop_name'),DB::raw('(SELECT logo FROM shops WHERE shops.id = vouchers.shop_id) as shop_logo'),DB::raw('(SELECT SUM(points_used) FROM user_voucher_usage WHERE user_voucher_usage.voucher_id IN (SELECT id FROM vouchers as voc WHERE shop_id = vouchers.shop_id AND is_hidden = 0 AND status = 1) AND status IN (1,2)) as "usages"'),DB::raw('(SELECT COUNT(points_used) FROM user_voucher_usage WHERE user_voucher_usage.voucher_id IN (SELECT id FROM vouchers as voc WHERE shop_id = vouchers.shop_id AND is_hidden = 0 AND status = 1) AND status IN(1,2)) as count'),DB::raw('(SELECT SUM(bill_amount) FROM bill_submissions WHERE bill_submissions.shop_id = vouchers.shop_id) as bills'))
                    ->whereNotIn('shop_id',array(18,19,32,40,118,515))
                    ->where('is_hidden',0)
                    ->where('status',1)
                    ->where('balance','>',0)
                    ->groupBy('shop_id')
                    ->orderBy(DB::raw('ABS(bills)'),'desc')
                    ->limit(5)
                    ->get();


        $b_sellers = array();

        foreach ($sellers as $key => $seller) 
        {
            $b_sellers[] = array(
                'logo' => $seller->shop_logo,
                'name' => $seller->shop_name,
                'count' => $seller->count,
                'point' => $seller->usages,
                'bill_count' => $seller->bills
            );
        }

        $expiring_statistics = Statistics::where('page','dashboard_seller')->first();
        if($expiring_statistics == null)
        {
            $expiring_statistics = new Statistics;
            $expiring_statistics->page = 'dashboard_seller';
        }
        $expiring_statistics->statistics = json_encode($b_sellers);
        $expiring_statistics->save();



        //Dashboard best buyer

        $buyers = Users::select('first_name','mobile','total_spend','points_used')
                    ->orderBy(DB::raw('ABS(total_spend)'),'desc')
                    ->limit(5)
                    ->get();


        $b_buyers = array();

        foreach ($buyers as $key => $buyer) 
        {
            $b_buyers[] = array(
                'name' => $buyer->first_name,
                'mobile' => $buyer->mobile,
                'total_spend' => $buyer->total_spend,
                'points_used' => $buyer->points_used
            );
        }

        $expiring_statistics = Statistics::where('page','dashboard_buyers')->first();
        if($expiring_statistics == null)
        {
            $expiring_statistics = new Statistics;
            $expiring_statistics->page = 'dashboard_buyers';
        }
        $expiring_statistics->statistics = json_encode($b_buyers);
        $expiring_statistics->save();


        //Dashboard vouchers

        $vouchers = Vouchers::whereHas('log_details', function($q)
                            {
                                $q->where('to_user',3);
                                $q->where('type',2);
                            })
                            ->where('expiry_date','>',date('Y-m-d'))
                            ->orderBy('expiry_date')
                            ->where('is_hidden',0)
                            ->where('status',1)
                            ->where('balance','>',0)
                            ->limit(5)
                            ->get();

        $d_vouchers = array();

        foreach ($vouchers as $key => $voucher) 
        {
            $d_vouchers[] = array(
                'name' => $voucher->title,
                'value' => $voucher->offer_points,
                'count' => $voucher->balance,
                'expired' => date('d M Y',strtotime($voucher->expiry_date))
            );
        }

        $expiring_statistics = Statistics::where('page','dashboard_voucher_list')->first();
        if($expiring_statistics == null)
        {
            $expiring_statistics = new Statistics;
            $expiring_statistics->page = 'dashboard_voucher_list';
        }
        $expiring_statistics->statistics = json_encode($d_vouchers);
        $expiring_statistics->save();




        echo "Success";
    }*/

    public function loadStatistics()
    {
        /*Dashboard new data starts*/

        $from = date('Y-m-01');
        $to = date('Y-m-d');
        $prev_from = date("Y-m-01",strtotime("-1 Year"));
        $prev_to = date("Y-m-t",strtotime("-1 Year"));

        $new_dashboard['male'] = Users::where('gender',0)->where('is_complete',1)->count();
        $new_dashboard['female'] = Users::where('gender',1)->where('is_complete',1)->count();
        $new_dashboard['others'] = Users::where('gender',2)->where('is_complete',1)->count();
        $new_dashboard['total'] = $new_dashboard['male']+$new_dashboard['female']+$new_dashboard['others'];

        $new_dashboard['new_male'] = Users::where('gender',0)->where('is_complete',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->count();
        $new_dashboard['new_female'] = Users::where('gender',1)->where('is_complete',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->count();
        $new_dashboard['new_others'] = Users::where('gender',2)->where('is_complete',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->count();

        $total = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('from_user',0)->where('to_user',0)->where('type',2)->has('voucher_details')->sum('count');
        $added = Vouchers::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->sum('count');
        $new_dashboard['finance'] = $total+$added;
        $new_dashboard['inhand'] = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',1)->where('type',2)->has('voucher_details')->get()->sum('count');
        $new_dashboard['loyalty'] = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',2)->where('type',2)->has('voucher_details')->get()->sum('count');
        $new_dashboard['desk'] = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',3)->where('type',2)->has('voucher_details')->get()->sum('count');

        $total_value = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('from_user',0)->where('to_user',0)->where('type',2)->has('voucher_details')->get();
        $t_value = 0;
        foreach ($total_value as $key => $value) {
            $t_value += $value->voucher_details->voucher_price;
        }
        $added_value = Vouchers::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to);
        $a_value = 0;
        foreach ($added_value as $key => $value) {
            $a_value += $value->voucher_details->voucher_price;
        }
        $new_dashboard['finance_value'] = $t_value+$a_value;
        $inhand_value = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',1)->where('type',2)->has('voucher_details')->get();
        $new_dashboard['inhand_value'] = 0;
        foreach ($inhand_value as $inhand) {
            $new_dashboard['inhand_value'] += $inhand->voucher_details->voucher_price;
        }
        $loyalty_value = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',2)->where('type',2)->has('voucher_details')->get();
        $new_dashboard['loyalty_value'] = 0;
        foreach ($loyalty_value as $loyalty) {
            $new_dashboard['loyalty_value'] += $loyalty->voucher_details->voucher_price;
        }
        $desk_value = VoucherLog::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->where('to_user',3)->where('type',2)->has('voucher_details')->get();
        $new_dashboard['desk_value'] = 0;
        foreach ($desk_value as $desk) {
            $new_dashboard['desk_value'] += $desk->voucher_details->voucher_price;
        }

        $new_dashboard['total_bills'] = BillSubmissions::whereDate('submitted_date','>=',$from)->whereDate('submitted_date','<=',$to)->count();
        $new_dashboard['pending_barcodes'] = BillSubmissions::whereDate('submitted_date','>=',$from)->whereDate('submitted_date','<=',$to)->where('status',0)->where('bill_type',2)->count();
        $new_dashboard['pending_images'] = BillSubmissions::whereDate('submitted_date','>=',$from)->whereDate('submitted_date','<=',$to)->where('status',0)->where('bill_type',1)->count();
        $new_dashboard['total_pending'] = $new_dashboard['pending_barcodes']+$new_dashboard['pending_images'];
        $new_dashboard['approved'] = BillSubmissions::whereDate('approved_date','>=',$from)->whereDate('approved_date','<=',$to)->where('status',1)->count();
        $new_dashboard['rejected'] = BillSubmissions::whereDate('rejected_date','>=',$from)->whereDate('rejected_date','<=',$to)->where('status',2)->count();


        $t_mnts = date("y-m-d",strtotime("-3 Months"));
        $s_mnts = date("y-m-d",strtotime("-6 Months"));
        $new_dashboard['active'] = BillSubmissions::whereDate('submitted_date','>=',$t_mnts)->groupBy('user_id')->count();
        $new_dashboard['semiactive'] = BillSubmissions::whereDate('submitted_date','>=',$s_mnts)->whereDate('submitted_date','<=',$t_mnts)->groupBy('user_id')->count();
        $new_dashboard['inactive'] = BillSubmissions::whereDate('submitted_date','<',$s_mnts)->groupBy('user_id')->count();
        $bill_today = BillSubmissions::whereDate('submitted_date',date('Y-m-d'))->groupBy('user_id')->count();
        $redeem_today = UserVoucherUsage::whereDate('date',date('Y-m-d'))->groupBy('user_id')->count();
        $new_dashboard['login'] = $bill_today+$redeem_today;


        $new_dashboard['redumption'] = UserVoucherUsage::whereDate('date','>=',$from)->whereDate('date','<=',$to)->whereIn('status',array(1,2))->sum('points_used');
        $new_dashboard['ytd_redumption'] = UserVoucherUsage::whereDate('date','>=',date("y-m-d",strtotime("-1 Year")))->whereDate('date','<=',$to)->whereIn('status',array(1,2))->sum('points_used');
        $actual_redumption = UserVoucherUsage::with('voucher_details')->whereDate('date','>=',$from)->whereDate('date','<=',$to)->whereIn('status',array(1,2))->get();
        $new_dashboard['actual_redumption'] = 1;
        foreach ($actual_redumption as $value) {
            $new_dashboard['actual_redumption'] += $value->voucher_details->actual_price;
        }
        $new_dashboard['discount_redumption'] = $new_dashboard['actual_redumption']-$new_dashboard['redumption'];
        $new_dashboard['discount_percent_redumption'] = $new_dashboard['redumption'] > 0?($new_dashboard['redumption']/$new_dashboard['actual_redumption'])*100:0;

        $new_dashboard['last_redumption'] = UserVoucherUsage::whereDate('date','>=',$prev_from)->whereDate('date','<=',$prev_to)->whereIn('status',array(1,2))->sum('points_used');
        $new_dashboard['last_ytd_redumption'] = UserVoucherUsage::whereDate('date','>=',date("y-m-d",strtotime("-2 Year")))->whereDate('date','<=',date("y-m-d",strtotime("-1 Year")))->whereIn('status',array(1,2))->sum('points_used');
        $actual_redumption = UserVoucherUsage::with('voucher_details')->whereDate('date','>=',$prev_from)->whereDate('date','<=',$prev_to)->whereIn('status',array(1,2))->get();
        $new_dashboard['last_actual_redumption'] = 1;
        foreach ($actual_redumption as $value) {
            $new_dashboard['last_actual_redumption'] += $value->voucher_details->actual_price;
        }
        $new_dashboard['last_discount_redumption'] = $new_dashboard['last_actual_redumption']-$new_dashboard['last_redumption'];
        $new_dashboard['last_discount_percent_redumption'] = ($new_dashboard['last_redumption']/$new_dashboard['last_actual_redumption'])*100;


        $mtd_bill_count = BillSubmissions::where('status',1)->whereDate('approved_date','>=',$from)->sum('earned_points');
        $mtd_winners = DB::table('contest_winner_history')->where('contest_date','>=',strtotime($from))->sum('points_earned');
        $mtd_added = PointAdjustments::whereDate('expiry_date','>=',$from)->where('type',1)->sum('points');
        $new_dashboard['mtd_liability'] = $mtd_bill_count+$mtd_winners+$mtd_added;

        $ytd_bill_count = BillSubmissions::where('status',1)->whereDate('approved_date','>=',$prev_to)->whereDate('approved_date','=',$to)->sum('earned_points');
        $ytd_winners = DB::table('contest_winner_history')->where('contest_date','>=',strtotime($prev_to))->where('contest_date','<=',strtotime($to))->sum('points_earned');
        $ytd_added = PointAdjustments::whereDate('expiry_date','>=',$prev_to)->whereDate('expiry_date','<=',$to)->where('type',1)->sum('points');
        $new_dashboard['ytd_liability'] = $ytd_bill_count+$ytd_winners+$ytd_added;


        $prev_mtd_bill_count = BillSubmissions::where('status',1)->whereDate('approved_date','>=',$prev_from)->whereDate('approved_date','<=',$prev_to)->sum('earned_points');
        $prev_mtd_winners = DB::table('contest_winner_history')->where('contest_date','>=',strtotime($prev_from))->where('contest_date','<=',strtotime($prev_to))->sum('points_earned');
        $prev_mtd_added = PointAdjustments::whereDate('expiry_date','>=',$prev_from)->whereDate('expiry_date','<=',$prev_to)->where('type',1)->sum('points');
        $new_dashboard['prev_mtd_liability'] = $prev_mtd_bill_count+$prev_mtd_winners+$prev_mtd_added;

        $prev_ytd_bill_count = BillSubmissions::where('status',1)->whereDate('approved_date','>=',date("y-m-d",strtotime("-2 Year")))->whereDate('approved_date','=',date("y-m-d",strtotime("-1 Year")))->sum('earned_points');
        $prev_ytd_winners = DB::table('contest_winner_history')->where('contest_date','>=',strtotime(date("y-m-d",strtotime("-2 Year"))))->where('contest_date','<=',strtotime(date("y-m-d",strtotime("-1 Year"))))->sum('points_earned');
        $prev_ytd_added = PointAdjustments::whereDate('expiry_date','>=',date("y-m-d",strtotime("-2 Year")))->whereDate('expiry_date','<=',date("y-m-d",strtotime("-1 Year")))->where('type',1)->sum('points');
        $new_dashboard['prev_ytd_liability'] = $prev_ytd_bill_count+$prev_ytd_winners+$prev_ytd_added;

        $expiring_statistics = Statistics::where('page','dashboard_count')->first();
        if($expiring_statistics == null)
        {
            $expiring_statistics = new Statistics;
            $expiring_statistics->page = 'dashboard_count';
        }
        $expiring_statistics->statistics = json_encode($new_dashboard);
        $expiring_statistics->save();


        //Dashboard best seller

        $sellers = DB::table('vouchers')
                    ->select('title',DB::raw('(SELECT name FROM shops WHERE shops.id = vouchers.shop_id) as shop_name'),DB::raw('(SELECT logo FROM shops WHERE shops.id = vouchers.shop_id) as shop_logo'),DB::raw('(SELECT SUM(points_used) FROM user_voucher_usage WHERE user_voucher_usage.voucher_id IN (SELECT id FROM vouchers as voc WHERE shop_id = vouchers.shop_id AND is_hidden = 0 AND status = 1) AND status IN (1,2)) as "usages"'),DB::raw('(SELECT COUNT(points_used) FROM user_voucher_usage WHERE user_voucher_usage.voucher_id IN (SELECT id FROM vouchers as voc WHERE shop_id = vouchers.shop_id AND is_hidden = 0 AND status = 1) AND status IN(1,2)) as count'),DB::raw('(SELECT SUM(bill_amount) FROM bill_submissions WHERE bill_submissions.shop_id = vouchers.shop_id) as bills'))
                    ->whereNotIn('shop_id',array(18,19,32,40,118,515))
                    ->where('is_hidden',0)
                    ->where('status',1)
                    ->where('balance','>',0)
                    ->groupBy('shop_id')
                    ->orderBy(DB::raw('ABS(bills)'),'desc')
                    ->limit(5)
                    ->get();


        $b_sellers = array();

        foreach ($sellers as $key => $seller) 
        {
            $b_sellers[] = array(
                'logo' => $seller->shop_logo,
                'name' => $seller->shop_name,
                'count' => $seller->count,
                'point' => $seller->usages,
                'bill_count' => $seller->bills
            );
        }

        $expiring_statistics = Statistics::where('page','dashboard_seller')->first();
        if($expiring_statistics == null)
        {
            $expiring_statistics = new Statistics;
            $expiring_statistics->page = 'dashboard_seller';
        }
        $expiring_statistics->statistics = json_encode($b_sellers);
        $expiring_statistics->save();



        //Dashboard best buyer

        $buyers = Users::select('first_name','mobile','total_spend','points_used')
                    ->where('is_complete',1)
                    ->where('total_spend','>',0)
                    ->orderBy(DB::raw('ABS(total_spend)'),'desc')
                    ->limit(5)
                    ->get();

        $b_buyers = array();

        foreach ($buyers as $key => $buyer) 
        {
            $b_buyers[] = array(
                'name' => $buyer->first_name,
                'mobile' => $buyer->mobile,
                'total_spend' => $buyer->total_spend,
                'points_used' => $buyer->points_used
            );
        }

        $expiring_statistics = Statistics::where('page','dashboard_buyers')->first();
        if($expiring_statistics == null)
        {
            $expiring_statistics = new Statistics;
            $expiring_statistics->page = 'dashboard_buyers';
        }
        $expiring_statistics->statistics = json_encode($b_buyers);
        $expiring_statistics->save();


        //Expiring vouchers

        $expiring_vouchers = Vouchers::where('expiry_date','>',date('Y-m-d'))
                                     ->orderBy('expiry_date','asc')
                                     ->limit(5)->get();

         $e_vouchers = array();

        foreach ($expiring_vouchers as $key => $vouchers) 
        {
            $voucher_usage = UserVoucherUsage::where('voucher_id',$vouchers->id)->whereIn('status',array(1,2))->sum('quantity');
            $voucher_log = VoucherLog::where('voucher_id',$vouchers->id)
                            ->where(function($query){
                                        $query->where('to_user',3);
                                        $query->orWhere('from_user',3);
                                    })
                            ->where('type',2)
                            ->sum('count');
            if($voucher_log == 0)
                $voucher_balance = 0;
            else
                $voucher_balance = $voucher_log-($vouchers->desk_deleted+$voucher_usage);

            $e_vouchers[] = array(
                'title' => $vouchers->title,
                'voucher_price' => $vouchers->voucher_price,
                'expiry_date' => $vouchers->expiry_date,
                'balanc' => $voucher_balance
            );
        }

        $expiring_statistics = Statistics::where('page','dashboard_expiring_vouchers')->first();
        if($expiring_statistics == null)
        {
            $expiring_statistics = new Statistics;
            $expiring_statistics->page = 'dashboard_expiring_vouchers';
        }
        $expiring_statistics->statistics = json_encode($e_vouchers);
        $expiring_statistics->save();                            

        /*Dashboard new data emds*/



        echo "Success";
    }
}
