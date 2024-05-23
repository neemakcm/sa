<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Users\Entities\Users;
use Modules\Users\Entities\UserVehicles;
use Modules\Shops\Entities\Pos;
use Modules\Shops\Entities\Shops;
use Modules\Shops\Entities\ShopTags;
use Modules\Shops\Entities\Categories;
use Modules\Shops\Entities\ShopImages;
use Modules\Loyalty\Entities\BillImages;
use Modules\Loyalty\Entities\BillSubmissions;
use Modules\Loyalty\Entities\UserPointTransactionLog;
use Modules\Vouchers\Entities\Vouchers;
use Modules\Vouchers\Entities\VoucherLog;
use Modules\Vouchers\Entities\VoucherDeleteLog;
use Modules\Vouchers\Entities\UserVoucherUsage;

use Session,DB,Validator,config;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', -1);
ini_set('max_execution_time', '0');

class MigrationController extends Controller
{
    public function migrate()
    {
        //Users

        $this->db_shift('mysql2');

        $live_users = DB::table('contacts')->get();

        $this->db_shift('mysql');
        
        foreach ($live_users as $key => $value)
        {
            $user = new Users;
            $user->first_name = $value->contact_name;
            $user->country_code = '91';
            $user->mobile = $value->contact_phone;
            $user->email = $value->contact_emailid;
            $user->district = $value->place;
            $user->pincode = $value->pincode;
            $user->gender = $value->gender;
            $user->marital_status = $value->marital_status;
            $user->dob = $value->birthday;
            $user->wedding_anniversary = $value->wed_anniversary;
            $user->image = $value->user_pics;
            $user->status = $value->status;
            $user->is_complete = $value->status;
            $user->is_blocked = $value->status;
            $user->block_reason = $value->deactivate_reason;
            $user->created_at = date('Y-m-d',strtotime($value->registered_date));
            $user->updated_at = date('Y-m-d',strtotime($value->registered_date));
            $user->save();

            $vehicleSplit = explode('-', $value->vehicle);
            if(count($vehicleSplit) > 0)
            {
                if(strlen($vehicleSplit[0]) > 5)
                {
                    $vehicle = new UserVehicles;
                    $vehicle->user_id = $user->id;
                    $vehicle->vehicle_type = (isset($vehicleSplit[1]) && $vehicleSplit[1] == 'car')?4:2;
                    $vehicle->vehicle_number = $vehicleSplit[0];
                    $vehicle->save();
                }
            }
        }

        //Shops

        $this->db_shift('mysql2');

        $live_stores = DB::table('stores')->get();

        $this->db_shift('mysql');

        foreach ($live_stores as $key => $value) 
        {
            $location = explode(',', $value->store_location);
            $store = new Shops;
            $store->name = $value->store_title;
            $store->floor = count($location)>0?explode(' ', $location[0])[0]:'Ground';
            $store->mobile = $value->store_phone;
            $store->logo = $value->storelogo;
            $store->description = $value->store_description;
            $store->status = 1;
            $store->save();

            if($value->store_image != '')
            {
                $store_image = new ShopImages;
                $store_image->shop_id = $store->id;
                $store_image->image = $value->store_image;
                $store_image->save();
            }

            if($value->store_tags != '')
            {
                $tags = explode(',', $value->store_tags);

                foreach($tags as $tag)
                {
                    if($tag != '')
                    {
                        $stags = new ShopTags;
                        $stags->shop_id = $store->id;
                        $stags->tag = $tag;
                        $stags->save();
                    }
                }
            }

            if($value->store_purchase_category != '')
            {
                $category = Categories::where('title','LIKE',$value->store_purchase_category)->first();

                if($category == null)
                {
                    $category = new Categories;
                    $category->title = $value->store_purchase_category;
                    $category->image = '';
                    $category->description = '';
                    $category->save();
                }

                $store->shop_categories()->sync(array($category->id));
            }
        }


        //POS

        $this->db_shift('mysql2');

        $live_pos = DB::table('pos_numbers')->get();

        $this->db_shift('mysql');

        foreach ($live_pos as $key => $value) 
        {
            $store = Shops::where('name','LIKE',$value->shop)->first();

            if($store != null)
            {
                $pos = new Pos;
                $pos->shop_id = $store->id;
                $pos->pos = $value->p_number;
                $pos->save();
            }
        }


        //Bill submission

        /*$this->db_shift('mysql2');

        $live_bills = DB::table('bill_details')->take(2000)->skip(4000)->get();

        $this->db_shift('mysql');

        foreach ($live_bills as $key => $value) 
        {
            $shop = Shops::where('name','LIKE',$value->bill_brand)->first();
            $user = Users::where('mobile','LIKE',$value->customer)->first();

            if($shop == null)
            {
                $shop = new Shops;
                $shop->name = $value->bill_brand;
                $shop->mobile = '';
                $shop->logo = '';
                $shop->save();
            }
            
            if($user != null)
            {
                if($value->status == 'P')
                    $status = 0;
                else if($value->status == 'R')
                    $status = 2;
                else if($value->status == 'C')
                    $status = 3;
                else
                    $status = 1;

                $bill = new BillSubmissions;
                $bill->user_id = $user->id;
                $bill->location = $value->location;
                $bill->shop_id = $shop->id;
                $bill->bill_date = date('Y-m-d',strtotime($value->bill_date));
                $bill->bill_no = $value->bill_number;
                $bill->bill_amount = $value->bill_amount == ''?0:$value->bill_amount;
                $bill->bill_type = strlen($value->bill_images) == 30?2:1;
                $bill->barcode = strlen($value->bill_images) == 30?$value->bill_images:'';
                $bill->submitted_from = $value->submitted_from;
                $bill->submitted_date = date('Y-m-d',$value->submission_date);
                $bill->status = $status;
                $bill->approved_date = $value->approved_on == ''?'': date('Y-m-d',explode(' ', $value->approved_on)[0]);
                $bill->approved_by = $value->approved_by;
                $bill->rejected_date = $value->rejected_on == ''?'':date('Y-m-d',explode(' ', $value->rejected_on)[0]);
                $bill->rejected_by = $value->rejected_by;
                $bill->rejected_reason = $value->rejected_reason;
                $bill->cancelled_by = $value->cancelled_by;
                $bill->cancelled_date = $value->cancelled_on == ''?'':date('Y-m-d',explode(' ', $value->cancelled_on)[0]);
                $bill->earned_points = $value->points_earned == ''?0:$value->points_earned;
                $bill->bill_submitted_by = $value->added_by == 'user'?$user->id:1;
                $bill->save();

                if(strlen($value->bill_images) > 30)
                {
                    $image = new BillImages;
                    $image->bill_id = $bill->id;
                    $image->bill_image = $value->bill_images;
                    $image->save();
                }
            }
        }*/

        //Vouchers

        $this->db_shift('mysql2');

        $live_vouchers = DB::table('voucher_list')->get();

        $this->db_shift('mysql');

        foreach ($live_vouchers as $key => $value) 
        {
            $shop = Shops::where('name','LIKE',$value->voucher_brand)->first();

            if($shop != null)
            {
                $voucher = new Vouchers;
                $voucher->shop_id = $shop->id;
                $voucher->brand_id = 0;
                $voucher->title = $value->voucher_title;
                $voucher->description = $value->voucher_desc;
                $voucher->actual_price = $value->voucher_actualprice;
                $voucher->voucher_price = $value->voucher_grossvalue;
                $voucher->offer_percentage = $value->voucher_percent;
                $voucher->expiry_date = date('Y-m-d',$value->voucher_enddate);
                $voucher->image = $value->voucher_image;
                $voucher->count = $value->voucher_openingcount;
                $voucher->loyalty_deleted = $value->voucher_removedcount;
                $voucher->offer_points = $value->voucher_grossvalue;
                $voucher->sort_order = $value->voucher_sort;
                $voucher->status = $value->voucher_status;
                $voucher->save();

                $log = new VoucherLog;
                $log->voucher_id = $voucher->id;
                $log->count = $value->voucher_openingcount;
                $log->from_user = 1;
                $log->to_user = 1;
                $log->initial_count = 0;
                $log->updated_count = $value->voucher_openingcount;
                $log->type = 2;
                $log->date = date('Y-m-d');
                $log->save();

                $user_log = new VoucherLog;
                $user_log->voucher_id = $voucher->id;
                $user_log->count = $value->voucher_openingcount;
                $user_log->from_user = 1;
                $user_log->to_user = 3;
                $user_log->initial_count = 0;
                $user_log->updated_count = $value->voucher_openingcount;
                $user_log->type = 2;
                $user_log->date = date('Y-m-d');
                $user_log->save();

                if($value->voucher_addedcount != '' && $value->voucher_addedcount > 0)
                {
                    $prev = VoucherLog::where('from_user',1)->where('voucher_id',$voucher->id)->orderBy('created_at','desc')->first();
                    if($prev == null)
                        $updated_count = 0;
                    else
                        $updated_count = $prev->updated_count;

                    $log = new VoucherLog;
                    $log->voucher_id = $voucher->id;
                    $log->count = $value->voucher_addedcount;
                    $log->from_user = 1;
                    $log->to_user = 1;
                    $log->initial_count = $updated_count;
                    $log->updated_count = $updated_count+$value->voucher_addedcount;
                    $log->type = 2;
                    $log->date = date('Y-m-d');
                    $log->save();

                    $finance_prev = VoucherLog::where('from_user',1)->where('voucher_id',$voucher->id)->orderBy('created_at','desc')->first();

                    $user_prev = VoucherLog::where('voucher_id',$voucher->id)
                                ->where(function($query){
                                    $query->where('to_user',3);
                                    $query->orWhere('from_user',1);
                                })
                                ->orderBy('created_at','desc')->first();

                    if($finance_prev == null)
                        $updated_count = $voucher->count;
                    else
                        $updated_count = $finance_prev->updated_count;

                    $log = new VoucherLog;
                    $log->voucher_id = $voucher->id;
                    $log->count = $value->voucher_addedcount;
                    $log->from_user = 1;
                    $log->to_user = 3;
                    $log->initial_count = $updated_count;
                    $log->updated_count = $updated_count-$value->voucher_addedcount;
                    $log->type = 1;
                    $log->date = date('Y-m-d');
                    $log->save();


                    if($user_prev == null)
                        $updated_count = 0;
                    else
                        $updated_count = $user_prev->updated_count;

                    $user_log = new VoucherLog;
                    $user_log->voucher_id = $voucher->id;
                    $user_log->count = $value->voucher_addedcount;
                    $user_log->from_user = 1;
                    $user_log->to_user = 3;
                    $user_log->initial_count = $updated_count;
                    $user_log->updated_count = $updated_count+$value->voucher_addedcount;
                    $user_log->type = 2;
                    $user_log->date = date('Y-m-d');
                    $user_log->save();


                }

                if($value->voucher_removedcount != '' && $value->voucher_removedcount > 0)
                {
                    $delete = new VoucherDeleteLog;
                    $delete->voucher_id = $voucher->id;
                    $delete->user_type = 2;
                    $delete->user_id = 1;
                    $delete->quantity = $value->voucher_removedcount;
                    $delete->date = date('Y-m-d');
                    $delete->save();
                }
            }
            
        }


        //Voucher redumptions

        $this->db_shift('mysql2');

        $live_redeems = DB::table('redeem_points')
                            ->join('voucher_list','voucher_list.voucher_id','=','redeem_points.coupon_applied')->limit(50)->get();

        $this->db_shift('mysql');

        foreach ($live_redeems as $key => $value) 
        {
            $voucher = Vouchers::where('title','LIKE',$value->voucher_title)->orderBy('id','desc')->first();
            $user = Users::where('mobile','LIKE',$value->customer)->first();

            if($voucher != null && $user != null)
            {
                if($value->status == 'C/R' || $value->status == 'C' || $value->status == 'R')
                    $status = 3;
                else if($value->status == 'O')
                    $status = 1;
                else if($value->status == 'D/C')
                    $status = 2;

                $usage = new UserVoucherUsage;
                $usage->user_id = $user->id;
                $usage->voucher_id = $voucher->id;
                $usage->quantity = $value->order_count;
                $usage->points_used = $value->redeemed_points;
                $usage->purchased_from = $value->purchased_from == 'Kiosk'?'admin':'mobile app';
                $usage->purchased_by = $user->id;
                $usage->date = date('Y-m-d',$value->order_date);
                $usage->status = $status;
                $usage->collected_date = $value->collected_date == ''?'':date('Y-m-d',$value->collected_date);
                $usage->save();
            }
        }


        //User transactions

        $this->db_shift('mysql');
        //$users = Users::where('status',1)->where('is_complete',1)->get();
        $users = Users::where('id','=',29262)->get();

        foreach($users as $user)
        {
            $this->db_shift('mysql');
            $bills = BillSubmissions::where('user_id',$user->id)->where('status',1)->get();
            $redeems = UserVoucherUsage::where('user_id',$user->id)->get();

            $this->db_shift('mysql2');
            $expired = DB::table('expire_points')->where('customer',$user->mobile)->get();
            $in_loyal = DB::table('contacts')->where('contact_phone',$user->mobile)->first();

            $points = array();

            foreach ($bills as $key => $value) {

                $points[] = array(
                    'user_id' => $user->id,
                    'points' => $value->earned_points,
                    'type' => 2,
                    'date' => strtotime($value->approved_date),
                    'bill_submission_id' => $value->id,
                    'voucher_id' => '',
                    'submission_from' => 'user app'
                );
            }

            foreach ($redeems as $key => $value) {

                $points[] = array(
                    'user_id' => $user->id,
                    'points' => $value->points_used,
                    'type' => 1,
                    'date' => strtotime($value->created_at),
                    'bill_submission_id' => '',
                    'voucher_id' => $value->id,
                    'submission_from' => 'user app'
                );
            }

            foreach ($expired as $key => $value) {

                $points[] = array(
                    'user_id' => $user->id,
                    'points' => $value->expired_points,
                    'type' => 3,
                    'date' => $value->exp_date,
                    'bill_submission_id' => '',
                    'voucher_id' => '',
                    'submission_from' => 'user app'
                );
            }

            $columns_1 = array_column($points, 'date');
            $columns_2 = array_column($points, 'bill_submission_id');
            array_multisort($columns_1, SORT_ASC, $columns_2, SORT_ASC, $points);

            $prev_balance = 0;

            $this->db_shift('mysql');

            foreach($points as $key => $point)
            {
                if($key == 0)
                {
                    if($in_loyal->inloyal_points != '' && $in_loyal->inloyal_points != 0)
                        $prev_balance = $in_loyal->inloyal_points;
                    else
                        $prev_balance = 0;
                }

                if($point['type'] == 2)
                    $new_bal = $prev_balance+$point['points'];
                else
                    $new_bal = $prev_balance-$point['points'];

                $transaction = new UserPointTransactionLog;
                $transaction->user_id = $point['user_id'];
                $transaction->points = $point['points'];
                $transaction->type = $point['type'];
                $transaction->previous_balance = $prev_balance; 
                $transaction->current_balance =  $new_bal;
                $transaction->date = date('Y-m-d',$point['date']);
                $transaction->bill_submission_id = $point['bill_submission_id'];
                $transaction->voucher_id = $point['voucher_id'];
                $transaction->submission_from = $point['submission_from'];
                $transaction->save();

                $prev_balance = $new_bal;
            }
        }

        echo "success";
    }

    function db_shift($db)
    {
        Config::set('database.default', $db);
        DB::reconnect($db);
    }

    public function migrateStage1()
    {
        //Users

        $this->db_shift('mysql2');

        $live_users = DB::table('contacts')->get();

        $this->db_shift('mysql');
        
        foreach ($live_users as $key => $value)
        {
            $user = new Users;
            $user->first_name = $value->contact_name;
            $user->country_code = '91';
            $user->mobile = $value->contact_phone;
            $user->email = $value->contact_emailid;
            $user->district = $value->place;
            $user->pincode = $value->pincode;
            $user->gender = $value->gender=='Male'?0:1;
            $user->marital_status = $value->marital_status;
            $user->dob = $value->birthday;
            $user->wedding_anniversary = $value->wed_anniversary;
            $user->image = $value->user_pics;
            $user->status = $value->status;
            $user->is_complete = $value->status;
            $user->is_blocked = $value->status == 1?0:1;
            $user->block_reason = $value->deactivate_reason;
            $user->created_at = date('Y-m-d',strtotime($value->registered_date));
            $user->updated_at = date('Y-m-d',strtotime($value->registered_date));
            $user->save();

            $vehicleSplit = explode('-', $value->vehicle);
            if(count($vehicleSplit) > 0)
            {
                if(strlen($vehicleSplit[0]) > 5)
                {
                    $vehicle = new UserVehicles;
                    $vehicle->user_id = $user->id;
                    $vehicle->vehicle_type = (isset($vehicleSplit[1]) && $vehicleSplit[1] == 'car')?4:2;
                    $vehicle->vehicle_number = $vehicleSplit[0];
                    $vehicle->save();
                }
            }
        }

        echo "success";
    }

    public function migrateStage2()
    {
        //Shops

        $this->db_shift('mysql2');

        $live_stores = DB::table('stores')->get();

        $this->db_shift('mysql');

        $chars = [' ', '.', ','];

        foreach ($live_stores as $key => $value) 
        {
            $title = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $value->store_title));

            $exist = Shops::where(\DB::raw("LOWER(alphanum(name))"), 'LIKE', $title)->first();

            if($exist == null)
            {
                $location = explode(',', $value->store_location);
                $store = new Shops;
                $store->name = $value->store_title;
                $store->floor = count($location)>0?explode(' ', $location[0])[0]:'Ground';
                $store->mobile = $value->store_phone;
                $store->logo = $value->storelogo;
                $store->description = $value->store_description;
                $store->duplicate_status = 1;
                $store->status = 1;
                $store->save();

                if($value->store_image != '')
                {
                    $store_image = new ShopImages;
                    $store_image->shop_id = $store->id;
                    $store_image->image = $value->store_image;
                    $store_image->save();
                }

                if($value->store_tags != '')
                {
                    $tags = explode(',', $value->store_tags);

                    foreach($tags as $tag)
                    {
                        if($tag != '')
                        {
                            $stags = new ShopTags;
                            $stags->shop_id = $store->id;
                            $stags->tag = $tag;
                            $stags->save();
                        }
                    }
                }

                if($value->store_purchase_category != '')
                {
                    $category = Categories::where('title','LIKE',$value->store_purchase_category)->first();

                    if($category == null)
                    {
                        $category = new Categories;
                        $category->title = $value->store_purchase_category;
                        $category->image = '';
                        $category->description = '';
                        $category->save();
                    }

                    $store->shop_categories()->sync(array($category->id));
                }
            }

            
        }

        echo "success";
    }

    public function migrateStage3()
    {
        //POS

        $this->db_shift('mysql2');

        $live_pos = DB::table('pos_numbers')->get();

        $this->db_shift('mysql');

        foreach ($live_pos as $key => $value) 
        {
            $title = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $value->shop));

            $store = Shops::where(\DB::raw("LOWER(alphanum(name))"), 'LIKE', $title)->first();

            if($store != null)
            {
                $pos = new Pos;
                $pos->shop_id = $store->id;
                $pos->pos = $value->p_number;
                $pos->save();
            }
        }

        echo "success";
    }

    public function migrateStage4()
    {
        //Bill submission

        $this->db_shift('mysql2');

        $live_bills = DB::table('bill_details')
                        ->select('bill_brand','customer','status','location',DB::raw('STR_TO_DATE(bill_date, "%d-%m-%Y") as bill_date'),'bill_number','bill_amount','bill_images','submitted_from','submission_date','approved_on','approved_by','rejected_on','rejected_by','rejected_reason','cancelled_by','cancelled_on','points_earned','added_by')
                        ->where('status','NOT LIKE','R')
                        ->get();

        $this->db_shift('mysql');

        foreach ($live_bills as $key => $value) 
        {
            $title = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $value->bill_brand));

            $shop = Shops::where(\DB::raw("LOWER(alphanum(name))"), 'LIKE', $title)->first();
            $user = Users::where('mobile',$value->customer)->first();

            if($shop == null)
            {
                $shop = new Shops;
                $shop->name = $value->bill_brand;
                $shop->mobile = '';
                $shop->logo = '';
                $shop->duplicate_status = 1;
                $shop->save();
            }
            
            if($user != null)
            {
                if($value->status == 'P')
                    $status = 0;
                else if($value->status == 'R')
                    $status = 2;
                else if($value->status == 'C')
                    $status = 3;
                else
                    $status = 1;

                $bill = new BillSubmissions;
                $bill->user_id = $user->id;
                $bill->location = $value->location;
                $bill->shop_id = $shop->id;
                $bill->bill_date = $value->bill_date;
                $bill->bill_no = $value->bill_number;
                $bill->bill_amount = $value->bill_amount == ''?0:$value->bill_amount;
                $bill->bill_type = strlen($value->bill_images) == 30?2:1;
                $bill->barcode = strlen($value->bill_images) == 30?$value->bill_images:'';
                $bill->submitted_from = $value->submitted_from;
                $bill->submitted_date = date('Y-m-d',$value->submission_date);
                $bill->status = $status;
                $bill->approved_date = $value->approved_on == ''?'': date('Y-m-d',explode(' ', $value->approved_on)[0]);
                $bill->approved_by = $value->approved_by;
                $bill->rejected_date = $value->rejected_on == ''?'':date('Y-m-d',explode(' ', $value->rejected_on)[0]);
                $bill->rejected_by = $value->rejected_by;
                $bill->rejected_reason = $value->rejected_reason;
                $bill->cancelled_by = $value->cancelled_by;
                $bill->cancelled_date = $value->cancelled_on == ''?'':date('Y-m-d',explode(' ', $value->cancelled_on)[0]);
                $bill->earned_points = $value->points_earned == ''?0:$value->points_earned;
                $bill->bill_submitted_by = $value->added_by == 'user'?$user->id:1;
                $bill->save();

                if(strlen($value->bill_images) > 30)
                {
                    $image = new BillImages;
                    $image->bill_id = $bill->id;
                    $image->bill_image = $value->bill_images;
                    $image->save();
                }
            }
        }

        echo "success";
    }

    public function migrateStage5()
    {
        //Vouchers

        $this->db_shift('mysql2');

        $live_vouchers = DB::table('voucher_list')->get();

        $this->db_shift('mysql');

        foreach ($live_vouchers as $key => $value) 
        {
            $title = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $value->voucher_brand));

            $shop = Shops::where(\DB::raw("LOWER(alphanum(name))"), 'LIKE', $title)->first();
            if($shop != null)
            {
                $voucher = new Vouchers;
                $voucher->shop_id = $shop->id;
                $voucher->brand_id = 0;
                $voucher->title = $value->voucher_title;
                $voucher->description = $value->voucher_desc;
                $voucher->actual_price = $value->voucher_actualprice;
                $voucher->voucher_price = $value->voucher_grossvalue;
                $voucher->offer_percentage = $value->voucher_percent;
                $voucher->expiry_date = date('Y-m-d',$value->voucher_enddate);
                $voucher->image = $value->voucher_image;
                $voucher->count = $value->voucher_openingcount;
                $voucher->loyalty_deleted = $value->voucher_removedcount;
                $voucher->offer_points = $value->voucher_grossvalue;
                $voucher->sort_order = $value->voucher_sort;
                $voucher->status = $value->voucher_status;
                $voucher->save();

                $log = new VoucherLog;
                $log->voucher_id = $voucher->id;
                $log->count = $value->voucher_openingcount;
                $log->from_user = 0;
                $log->to_user = 0;
                $log->initial_count = 0;
                $log->updated_count = $value->voucher_openingcount;
                $log->type = 2;
                $log->date = date('Y-m-d');
                $log->save();

                $user_log = new VoucherLog;
                $user_log->voucher_id = $voucher->id;
                $user_log->count = $value->voucher_openingcount;
                $user_log->from_user = 0;
                $user_log->to_user = 2;
                $user_log->initial_count = 0;
                $user_log->updated_count = $value->voucher_openingcount;
                $user_log->type = 2;
                $user_log->date = date('Y-m-d');
                $user_log->save();

                if($value->voucher_status == 1)
                {
                    $user_log = new VoucherLog;
                    $user_log->voucher_id = $voucher->id;
                    $user_log->count = $value->voucher_openingcount;
                    $user_log->from_user = 0;
                    $user_log->to_user = 3;
                    $user_log->initial_count = 0;
                    $user_log->updated_count = $value->voucher_openingcount;
                    $user_log->type = 2;
                    $user_log->date = date('Y-m-d');
                    $user_log->save();
                }

                if($value->voucher_addedcount != '' && $value->voucher_addedcount > 0)
                {
                    $prev = VoucherLog::where('from_user',0)->where('voucher_id',$voucher->id)->orderBy('created_at','desc')->first();
                    if($prev == null)
                        $updated_count = 0;
                    else
                        $updated_count = $prev->updated_count;

                    $log = new VoucherLog;
                    $log->voucher_id = $voucher->id;
                    $log->count = $value->voucher_addedcount;
                    $log->from_user = 0;
                    $log->to_user = 0;
                    $log->initial_count = $updated_count;
                    $log->updated_count = $updated_count+$value->voucher_addedcount;
                    $log->type = 2;
                    $log->date = date('Y-m-d');
                    $log->save();

                    $finance_prev = VoucherLog::where('from_user',0)->where('voucher_id',$voucher->id)->orderBy('created_at','desc')->first();

                    $user_prev = VoucherLog::where('voucher_id',$voucher->id)
                                ->where(function($query){
                                    $query->where('to_user',2);
                                    $query->orWhere('from_user',0);
                                })
                                ->orderBy('created_at','desc')->first();

                    if($finance_prev == null)
                        $updated_count = $voucher->count;
                    else
                        $updated_count = $finance_prev->updated_count;

                    $log = new VoucherLog;
                    $log->voucher_id = $voucher->id;
                    $log->count = $value->voucher_addedcount;
                    $log->from_user = 0;
                    $log->to_user = 2;
                    $log->initial_count = $updated_count;
                    $log->updated_count = $updated_count-$value->voucher_addedcount;
                    $log->type = 1;
                    $log->date = date('Y-m-d');
                    $log->save();


                    if($value->voucher_status == 1)
                    {
                        if($user_prev == null)
                            $updated_count = 0;
                        else
                            $updated_count = $user_prev->updated_count;

                        $user_log = new VoucherLog;
                        $user_log->voucher_id = $voucher->id;
                        $user_log->count = $value->voucher_addedcount;
                        $user_log->from_user = 0;
                        $user_log->to_user = 2;
                        $user_log->initial_count = $updated_count;
                        $user_log->updated_count = $updated_count+$value->voucher_addedcount;
                        $user_log->type = 2;
                        $user_log->date = date('Y-m-d');
                        $user_log->save();

                        $loyalty_prev = VoucherLog::where('to_user',2)->where('voucher_id',$voucher->id)->orderBy('created_at','desc')->first();

                        $user_prev = VoucherLog::where('voucher_id',$voucher->id)
                                    ->where(function($query){
                                        $query->where('to_user',3);
                                        $query->orWhere('from_user',2);
                                    })
                                    ->orderBy('created_at','desc')->first();

                        if($loyalty_prev == null)
                            $updated_count = $voucher->count;
                        else
                            $updated_count = $loyalty_prev->updated_count;

                        $log = new VoucherLog;
                        $log->voucher_id = $voucher->id;
                        $log->count = $value->voucher_addedcount;
                        $log->from_user = 2;
                        $log->to_user = 3;
                        $log->initial_count = $updated_count;
                        $log->updated_count = $updated_count-$value->voucher_addedcount;
                        $log->type = 1;
                        $log->date = date('Y-m-d');
                        $log->save();

                        if($user_prev == null)
                            $updated_count = 0;
                        else
                            $updated_count = $user_prev->updated_count;

                        $user_log = new VoucherLog;
                        $user_log->voucher_id = $voucher->id;
                        $user_log->count = $value->voucher_addedcount;
                        $user_log->from_user = 2;
                        $user_log->to_user = 3;
                        $user_log->initial_count = $updated_count;
                        $user_log->updated_count = $updated_count+$value->voucher_addedcount;
                        $user_log->type = 2;
                        $user_log->date = date('Y-m-d');
                        $user_log->save();

                    }
                    else
                    {
                        if($user_prev == null)
                            $updated_count = 0;
                        else
                            $updated_count = $user_prev->updated_count;

                        $user_log = new VoucherLog;
                        $user_log->voucher_id = $voucher->id;
                        $user_log->count = $value->voucher_addedcount;
                        $user_log->from_user = 0;
                        $user_log->to_user = 2;
                        $user_log->initial_count = $updated_count;
                        $user_log->updated_count = $updated_count+$value->voucher_addedcount;
                        $user_log->type = 2;
                        $user_log->date = date('Y-m-d');
                        $user_log->save();
                    }
                }

                if($value->voucher_removedcount != '' && $value->voucher_removedcount > 0)
                {
                    $delete = new VoucherDeleteLog;
                    $delete->voucher_id = $voucher->id;
                    $delete->user_type = 2;
                    $delete->user_id = 0;
                    $delete->quantity = $value->voucher_removedcount;
                    $delete->date = date('Y-m-d');
                    $delete->save();
                }
            }
        }

        echo "success";
    }

    public function migrateStage6()
    {
        //Voucher redumptions

        $this->db_shift('mysql2');

        $live_redeems = DB::table('redeem_points')
                            ->leftJoin('voucher_list','voucher_list.voucher_id','=','redeem_points.coupon_applied')->get();

        $this->db_shift('mysql');

        foreach ($live_redeems as $key => $value) 
        {
            $voucher = Vouchers::where('title','LIKE',$value->voucher_title)->orderBy('id','desc')->first();
            $user = Users::where('mobile','LIKE',$value->customer)->first();

            if($user != null)
            {
                if($value->status == 'C/R' || $value->status == 'C' || $value->status == 'R')
                    $status = 3;
                else if($value->status == 'O')
                    $status = 1;
                else if($value->status == 'D/C')
                    $status = 2;

                $usage = new UserVoucherUsage;
                $usage->user_id = $user->id;
                if($voucher == null || $value->voucher_title == null)
                {
                    $voucher = Vouchers::where('title','LIKE','deleted voucher')->first();
                }
                $usage->voucher_id = $voucher->id;
                $usage->quantity = $value->order_count;
                $usage->points_used = $value->redeemed_points;
                $usage->purchased_from = $value->purchased_from == 'Kiosk'?'admin':'mobile app';
                $usage->purchased_by = $user->id;
                $usage->date = date('Y-m-d',$value->order_date);
                $usage->status = $status;
                $usage->collected_date = $value->collected_date == ''?'':date('Y-m-d',$value->collected_date);
                $usage->save();
            }
        }

        echo "success";
    }

    public function migrateStage7()
    {
        //User transactions

        $this->db_shift('mysql');
        $users = Users::where('status',1)->where('is_complete',1)->get();

        foreach($users as $user)
        {
            $this->db_shift('mysql');
            $bills = BillSubmissions::where('user_id',$user->id)->where('status',1)->get();
            $redeems = UserVoucherUsage::where('user_id',$user->id)->where('status','!=',3)->get();

            $this->db_shift('mysql2');
            $expired = DB::table('expire_points')->where('customer',$user->mobile)->get();
            $in_loyal = DB::table('contacts')->where('contact_phone',$user->mobile)->first();

            $points = array();
            if($in_loyal != null)
            {
                foreach ($bills as $key => $value) {

                    $points[] = array(
                        'user_id' => $user->id,
                        'points' => $value->earned_points,
                        'type' => 2,
                        'date' => strtotime($value->approved_date),
                        'bill_submission_id' => $value->id,
                        'voucher_id' => '',
                        'submission_from' => 'user app'
                    );
                }

                foreach ($redeems as $key => $value) {

                    $points[] = array(
                        'user_id' => $user->id,
                        'points' => $value->points_used,
                        'type' => 1,
                        'date' => strtotime($value->collected_date),
                        'bill_submission_id' => '',
                        'voucher_id' => $value->voucher_id,
                        'submission_from' => 'user app'
                    );
                }

                foreach ($expired as $key => $value) {

                    $points[] = array(
                        'user_id' => $user->id,
                        'points' => $value->expired_points,
                        'type' => 3,
                        'date' => $value->exp_date,
                        'bill_submission_id' => '',
                        'voucher_id' => '',
                        'submission_from' => 'user app'
                    );
                }

                $columns_1 = array_column($points, 'date');
                $columns_2 = array_column($points, 'bill_submission_id');
                array_multisort($columns_1, SORT_ASC, $columns_2, SORT_ASC, $points);

                $prev_balance = 0;

                $this->db_shift('mysql');

                foreach($points as $key => $point)
                {
                    if($key == 0)
                    {
                        if($in_loyal->inloyal_points != '' && $in_loyal->inloyal_points != 0)
                            $prev_balance = $in_loyal->inloyal_points;
                        else
                            $prev_balance = 0;
                    }

                    if($point['type'] == 2)
                        $new_bal = $prev_balance+(int)str_replace("\r\n","",$point['points']);
                    /*else
                        $new_bal = $prev_balance==0?0:$prev_balance-(int)str_replace("\r\n","",$point['points']);*/

                    $expire_from = date("Y-m-d", strtotime(date("Y-m-d", strtotime($point['date'])) . " + 1 year"));

                    //$expire_date_from = date('Y',strtotime($expire_from)).'-'.date('m',strtotime($expire_from)).'-'.date('t',strtotime($expire_from));

                    $transaction = new UserPointTransactionLog;
                    $transaction->user_id = $point['user_id'];
                    $transaction->points = $point['points'];
                    $transaction->type = $point['type'];
                    $transaction->previous_balance = $prev_balance; 
                    $transaction->current_balance =  $new_bal;
                    $transaction->date = date('Y-m-d',$point['date']);
                    $transaction->expiry_date = $expire_from;
                    $transaction->bill_submission_id = $point['bill_submission_id'];
                    $transaction->voucher_id = $point['voucher_id'];
                    $transaction->submission_from = $point['submission_from'];
                    $transaction->save();

                    $prev_balance = (int)$new_bal;
                }
            }
        }

        echo "success";
    }
}
