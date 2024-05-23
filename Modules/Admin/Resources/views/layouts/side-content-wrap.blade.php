<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item" ><a class="nav-item-hold" href="{{URL('admin')}}"><div class="icon_div"><img src="{{asset('public/admins/images/icons/dashboard.svg')}}"></div><span class="nav-text">Dashboard</span></a>
                <div class="triangle"></div>
            </li>

            @if(in_array('admin_users',$permissions) || in_array('roles',$permissions))
                <li class="nav-item" data-item="extrakits"><a class="nav-item-hold" href="#"><div class="icon_div"><img src="{{asset('public/admins/images/icons/admin-user.svg')}}"></div><span class="nav-text">Admin User</span></a>
                    <div class="triangle"></div>
                </li>
            @endif  
           

           

            @if(in_array('products',$permissions) || in_array('product_review',$permissions) || in_array('categories',$permissions) || in_array('attributes',$permissions) )
                <li class="nav-item" data-item="products"><a class="nav-item-hold" href="#"><div class="icon_div"><img src="{{asset('public/admins/images/icons/product.svg')}}"></div><span class="nav-text">Products</span></a>
                    <div class="triangle"></div>
                </li>
            @endif   
            @if( in_array('user_manual',$permissions) || in_array('faq',$permissions) || in_array('video_tutorial',$permissions) || in_array('drop_point',$permissions) || in_array('registered_products',$permissions) )
                <li class="nav-item" data-item="productsSupport"><a class="nav-item-hold" href="#"><div class="icon_div"><img src="{{asset('public/admins/images/icons/product-enquiry.svg')}}"></div><span class="nav-text">Product Support</span></a>
                    <div class="triangle"></div>
                </li>
            @endif 
            @if( in_array('services',$permissions) || in_array('service_center',$permissions) || in_array('warranty_extension',$permissions))
                <li class="nav-item" data-item="serviceSupport"><a class="nav-item-hold" href="#"><div class="icon_div"><img src="{{asset('public/admins/images/icons/service-request.svg')}}"></div><span class="nav-text">Service Support</span></a>
                    <div class="triangle"></div>
                </li>
            @endif 

           
            @if(in_array('product_enquiry',$permissions) || in_array('sales_enquiry',$permissions))
                <li class="nav-item" data-item="enquiry"><a class="nav-item-hold" href="#"><div class="icon_div"><img src="{{asset('public/admins/images/icons/sales-enquiry.svg')}}"></div><span class="nav-text">Enquiry</span></a>
                    <div class="triangle"></div>
                </li>
            @endif 
            @if(in_array('latest_blogs',$permissions) || in_array('news_and_events',$permissions))
                <li class="nav-item" data-item="blogEvent"><a class="nav-item-hold" href="#"><div class="icon_div"><img src="{{asset('public/admins/images/icons/blog.svg')}}"></div><span class="nav-text">Blogs & News</span></a>
                    <div class="triangle"></div>
                </li>
            @endif 

            @if(in_array('stores',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/stores')}}"><div class="icon_div"><img src="{{asset('public/admins/images/icons/store.svg')}}"></div><span class="nav-text">Stores</span></a>
                    <div class="triangle"></div>
                </li> 
            @endif 
            
            @if(in_array('shopping_faq',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/shopping-faq')}}"><div class="icon_div"><img src="{{asset('public/admins/images/icons/faq.svg')}}"></div><span class="nav-text">Shopping Faq </span></a>
            @endif
            @if(in_array('media-center',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/mediaCenter')}}"><div class="icon_div"><img src="{{asset('public/admins/images/icons/media-center.svg')}}"></div><span class="nav-text">Media Center </span></a>
                    <div class="triangle"></div>
                </li> 
            @endif 
            

            @if(in_array('careers',$permissions))
                <li class="nav-item" data-item="careers"><a class="nav-item-hold" href="#"><div class="icon_div"><img src="{{asset('public/admins/images/icons/career.svg')}}"></div><span class="nav-text">Careers</span></a>
                    <div class="triangle"></div>
                </li>
            @endif 
            @if(in_array('feedbacks',$permissions) || in_array('escalate_to_service',$permissions))
                <li class="nav-item" data-item="feedback"><a class="nav-item-hold" href="#"><div class="icon_div"><img src="{{asset('public/admins/images/icons/feedback.svg')}}"></div><span class="nav-text">Feedbacks</span></a>
                    <div class="triangle"></div>
                </li>
            @endif
            @if(in_array('settings',$permissions) || in_array('latest-videos',$permissions) || in_array('vendor',$permissions) || in_array('offers',$permissions) || in_array('pages',$permissions) || in_array('banners',$permissions))
                <li class="nav-item" data-item="settings"><a class="nav-item-hold" href="#"><div class="icon_div"><img src="{{asset('public/admins/images/icons/settings.svg')}}"></div><span class="nav-text">Settings</span></a>
                    <div class="triangle"></div>
                </li>
            @endif
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
        <!-- Submenu Dashboards-->
        <ul class="childNav" data-parent="extrakits">
            @if(in_array('roles',$permissions))
                <li class="nav-item"><a href="{{URL('admin/roles')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Role Management</span></a></li>
            @endif
            @if(in_array('admin_users',$permissions))
                <li class="nav-item"><a href="{{URL('admin/admin-users')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Admin User</span></a></li>
            @endif
        </ul>

        <ul class="childNav" data-parent="products">
            @if(in_array('attributes',$permissions))
                <li class="nav-item"><a href="{{URL('admin/attributes')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Attributes</span></a></li>
            @endif
            @if(in_array('categories',$permissions))
                <li class="nav-item"><a href="{{URL('admin/categories')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Categories</span></a></li>
            @endif
            <!-- @if(in_array('support',$permissions)) -->
                <!-- <li class="nav-item"><a href="{{URL('admin/support-options')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Support Options</span></a></li> -->
            <!-- @endif -->
            @if(in_array('products',$permissions))
                <li class="nav-item"><a href="{{URL('admin/products')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Products</span></a></li>
            @endif
                <!-- <li class="nav-item"><a href="{{URL('admin/products/registered')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Registered Products</span></a></li> -->
            @if(in_array('product_review',$permissions))
                <li class="nav-item"><a href="{{URL('admin/products/pendingReviews')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Pending Product Reviews</span></a></li>
            @endif
        </ul>

        <ul class="childNav" data-parent="feedback">
            @if(in_array('feedbacks',$permissions))
                <li class="nav-item"><a href="{{URL('admin/products/feedback')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Product Feedback</span></a></li>
                <li class="nav-item"><a href="{{URL('admin/service/feedback')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Service Feedback</span></a></li>
            @endif
            @if(in_array('escalate_to_service',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/escalate-to-service')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">Escalate To Service Head </span></a>
                </li> 
            @endif 
        </ul>

        <ul class="childNav" data-parent="careers">
            <li class="nav-item"><a href="{{URL('admin/jobFields')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Job Category</span></a></li>
            <li class="nav-item"><a href="{{URL('admin/jobs')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Jobs</span></a></li>
        </ul>
        <ul class="childNav" data-parent="settings">
            @if(in_array('settings',$permissions))
            <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/settings')}}"><i class="nav-icon  text-20 i-Gear"></i><span class="nav-text">General Settings </span></a>
                <div class="triangle"></div>
            </li> 
            @endif
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon text-20 i-Gear"></i>
                    <span class="item-name">Page settings</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if(in_array('banners',$permissions))
                        <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/banners')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Banner</span></a></li> 
                    @endif
                    @if(in_array('home_page',$permissions))
                        <li class="nav-item"><a href="{{URL('admin/homePage')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Homepage Design</span></a></li>
                    @endif  
                    @if(in_array('latest-videos',$permissions))
                        <li class="nav-item"><a href="{{URL('admin/latestVideos')}}"><i class="nav-icon  text-20 i-Gear"></i><span class="item-name">Latest Videos</span></a></li>
                    @endif 
                   
                    @if(in_array('pages',$permissions))
                       <li class="nav-item"><a href="{{URL('admin/about/banners')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">About Banner</span></a></li>
                    @endif  
                   
                    @if(in_array('pages',$permissions))
                       <li class="nav-item"><a href="{{URL('admin/footerSettings')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Footer Settings</span></a></li>
                    @endif   
                    @if(in_array('pages',$permissions))
                       <li class="nav-item"><a href="{{URL('admin/footerCategorySettings')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Footer Category Settings</span></a></li>
                    @endif   
                   
                </ul>
            </li>
            @if(in_array('offers',$permissions))
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon text-20 i-Gear"></i>
                    <span class="item-name">Offers</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li class="nav-item"><a href="{{URL('admin/offers')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Offers</span></a></li>
                    <li class="nav-item"><a href="{{URL('admin/offers/interest')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Interest</span></a></li>
                </ul>
            </li>
            @endif  
            @if(in_array('vendor',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/vendor')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">Vendor </span></a>
                    <div class="triangle"></div>
                </li> 
            @endif
            @if(in_array('pages',$permissions))
                <li class="nav-item dropdown-sidemenu">
                    <a>
                        <i class="nav-icon text-20 i-Gear"></i>
                        <span class="item-name">About</span>
                        <i class="dd-arrow i-Arrow-Down"></i>
                    </a>
                    <ul class="submenu">
                        <li class="nav-item"><a href="{{URL('admin/milestones')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Milestones</span></a></li>
                        <li class="nav-item"><a href="{{URL('admin/awards')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Awards</span></a></li>
                        <li class="nav-item"><a href="{{URL('admin/managements')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Managements</span></a></li>
                        <li class="nav-item"><a href="{{URL('admin/brands')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Brands</span></a></li>
                        <li class="nav-item"><a href="{{URL('admin/values')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Our Values</span></a></li>

                    </ul>
                </li>
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/pages')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">Pages</span></a>
                    <div class="triangle"></div>
                </li> 
            @endif
            

        </ul>
        <ul class="childNav" data-parent="productsSupport">
            @if(in_array('registered_products',$permissions))
                <li class="nav-item"><a href="{{URL('admin/products/registered')}}"><i class="nav-icon i-Loading-3"></i><span class="item-name">Registered Products</span></a></li>
             @endif
             
            @if(in_array('user_manual',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/user-manuals')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">User Manuals</span></a>
                </li> 
            @endif  

            @if(in_array('faq',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/faq')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">Faq</span></a>
                </li> 
            @endif  
            @if(in_array('video_tutorial',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/video-tutorials')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">Video Tutorial</span></a>
                </li> 
            @endif 
            @if(in_array('drop_point',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/drop-point')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">Drop Point </span></a>
                </li> 
            @endif 
        </ul>
        <ul class="childNav" data-parent="serviceSupport">
        @if(in_array('services',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/service')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">Service Requests</span></a>
                    <div class="triangle"></div>
                </li> 
            @endif  

            @if(in_array('service_center',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/serviceCenters')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">Service Centers</span></a>
                    <div class="triangle"></div>
                </li> 
            @endif 
            @if(in_array('warranty_extension',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/warranty-extension')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">Warranty Extension </span></a>
                    <div class="triangle"></div>
                </li> 
            @endif
        </ul>
        <ul class="childNav" data-parent="enquiry">
        @if(in_array('product_enquiry',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/product-enquiry')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">Product Enquiry </span></a>
                    <div class="triangle"></div>
                </li> 
            @endif 
            @if(in_array('sales_enquiry',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/sales-enquiry')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">Bussiness Enquiry </span></a>
                    <div class="triangle"></div>
                </li> 
            @endif 
        </ul>
        <ul class="childNav" data-parent="blogEvent">
            @if(in_array('latest_blogs',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/blog')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">Blogs </span></a>
                    <div class="triangle"></div>
                </li> 
            @endif 
            @if(in_array('news_and_events',$permissions))
                <li class="nav-item"><a class="nav-item-hold" href="{{URL('admin/news-and-events')}}"><i class="nav-icon i-Loading-3"></i><span class="nav-text">News And Events </span></a>
                    <div class="triangle"></div>
                </li> 
            @endif 
        </ul>
        
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!-- =============== Left side End ================-->
