<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use Modules\Roles\Entities\Roles;
use Modules\Admin\Entities\Admin;
use Modules\Categories\Entities\Categories;
use Modules\Vendor\Entities\Vendor;
use Modules\Settings\Entities\Settings;
use Modules\Pages\Entities\Pages;
use Modules\Pages\Entities\HomeDesign;
use Modules\Settings\Entities\FooterCategories;
use Modules\Settings\Entities\FooterLinks;

use Auth, DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin::layouts.side-content-wrap', function($view) {

            $user = Auth::guard('admin')->user();

            $user_permissions = Admin::find($user->id);
            $permissions = array();
            foreach ($user_permissions->roles()->get() as $key => $value) {
                $permissions = array_merge($permissions,$value->permissions()->pluck('permissions.slug')->toArray());
                $permissions = array_unique($permissions);
            }

            $view->with(compact('permissions'));

        });

        View::composer('admin::dashboard', function($view) {

            $user = Auth::guard('admin')->user();

            $user_permissions = Admin::find($user->id);
            $permissions = array();
            foreach ($user_permissions->roles()->get() as $key => $value) {
                $permissions = array_merge($permissions,$value->permissions()->pluck('permissions.slug')->toArray());
                $permissions = array_unique($permissions);
            }

            $view->with(compact('permissions'));

        });
        View::composer('pages::layouts.master', function($view) {

            $category = array();

            $categories = Categories::with(['children' => function ($q)
                                    {
                                        $q->with(['children' => function ($r)
                                        {
                                            $r->where('status',1)->orderBy(DB::raw('ABS(sort_oder)'));
                                        }]);
                                        $q->where('status',1)->orderBy(DB::raw('ABS(sort_oder)'));
                                    }])->where('parent_id',0)->where('status',1)->orderBy(DB::raw('ABS(sort_oder)'))->get();

            foreach ($categories as $key => $value)
            {
                $sub = array();

                if($value->children->count() > 0)
                {
                    foreach ($value->children as $key1 => $value1)
                    {
                        $child = array();
                        if($value1->children->count() > 0)
                        {
                            foreach ($value1->children as $key2 => $value2)
                            {
                                $child[] = array(
                                    'name' => $value2->name,
                                    'slug' => $value2->slug,
                                    'id' => $value2->id
                                );
                            }
                        }

                        $sub[] = array(
                            'id' => $value1->id,
                            'name' => $value1->name,
                            'slug' => $value1->slug,
                            'child' => $child
                        );
                    }
                }

                $category[$key] = array(
                    'id' => $value->id,
                    'name' => $value->name,
                    'slug' => $value->slug,
                    'child' => $sub
                );
            }
            //dd($category);

            $child_categories = Categories::where('is_last_child',1)->limit(5)->get();
            $vendors = Vendor::get();
            $settings = Settings::first();
            $newest = HomeDesign::with('products.category')->where('type',2)->orderBy('position','desc')->has('products')->orderBy('position')->limit(5)->get();
            $pages = Pages::whereIn('slug',array('covid-19-support','cookie-preferences'))->get();
            $footers = FooterCategories::with('category')->orderBy('position')->has('category')->get();

            $service_links = FooterLinks::where('type',1)->get();
            $quick_links = FooterLinks::where('type',2)->get();

            $view->with(compact('category','child_categories','vendors','settings','newest','pages','footers','service_links','quick_links'));

        });


        View::composer('errors::404', function($view) {

            $category = array();

            $categories = Categories::with(['children' => function ($q)
                                    {
                                        $q->with(['children' => function ($r)
                                        {
                                            $r->orderBy('sort_oder');
                                        }]);
                                        $q->orderBy('sort_oder');
                                    }])->where('parent_id',0)->where('status',1)->orderBy('sort_oder')->get();

            foreach ($categories as $key => $value)
            {
                $sub = array();

                if($value->children->count() > 0)
                {
                    foreach ($value->children as $key1 => $value1)
                    {
                        $child = array();
                        if($value1->children->count() > 0)
                        {
                            foreach ($value1->children as $key2 => $value2)
                            {
                                $child[] = array(
                                    'name' => $value2->name,
                                    'slug' => $value2->slug,
                                    'id' => $value2->id
                                );
                            }
                        }

                        $sub[] = array(
                            'id' => $value1->id,
                            'name' => $value1->name,
                            'slug' => $value1->slug,
                            'child' => $child
                        );
                    }
                }

                $category[$key] = array(
                    'id' => $value->id,
                    'name' => $value->name,
                    'slug' => $value->slug,
                    'child' => $sub
                );
            }
            //dd($category);

            $child_categories = Categories::where('is_last_child',1)->limit(5)->get();
            $vendors = Vendor::limit(5)->get();
            $settings = Settings::first();
            $newest = HomeDesign::with('products.category')->where('type',2)->orderBy('position','desc')->has('products')->orderBy('position')->limit(5)->get();
            $pages = Pages::whereIn('slug',array('covid-19-support','cookie-preferences'))->get();

            $view->with(compact('category','child_categories','vendors','settings','newest','pages'));

        });
    }
}
