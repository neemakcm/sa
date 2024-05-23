<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{asset('public/dashboard/img/logo/logo.png')}}" rel="icon">
  <title>LuLu Admin - Dashboard</title>
  <link href="{{asset('public/dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('public/dashboard/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('public/dashboard/css/ruang-admin.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/dashboard/css/custom.css')}}" rel="stylesheet">

  <script type="text/javascript">
        var base_url="{{url('/')}}";
        var storage_url="{{storage_url()}}";
    </script>
    
</head>

<body id="page-top" class="theme dark">
  <div onclick="themeFunction()" class="theme-selector"></div>

  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar accordion" id="accordionSidebar">
      <div class="sidebar-brand d-flex align-items-center mb-md-1 mt-1">
        <a href="dashboard.html" class="sidebar-head">
          <img src="{{asset('public/dashboard/img/logo/lulukochilogo.png')}}" class="img-fluid" alt="logo">
        </a>
        <button id="sidebarToggleTop" class="btn btn-link rounded-circle">
          <i class="fa fa-bars"></i>
        </button>
      </div>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#">
          <img src="img/icons/started.png" class="img-fluid" alt="icon">
          <span>Get Started</span>
        </a>
      </li> -->

      <li class="nav-item active">
        <a class="nav-link" href="{{URL('admin')}}">
          <img src="{{asset('public/dashboard/img/icons/home.png')}}" class="img-fluid home-link" alt="icon">
          <span>Dashboard</span>
        </a>
      </li>

      @if(in_array('list_user',$permissions))
        <li class="nav-item">
          <a class="nav-link" href="{{URL('admin/app-users')}}">
            <img src="{{asset('public/dashboard/img/icons/app-user.png')}}" class="img-fluid" alt="icon">
            <span>App User</span>
          </a>
        </li>
      @endif

      @if(in_array('list_admin_user',$permissions))
        <li class="nav-item">
          <a class="nav-link" href="{{URL('admin/admin-users')}}">
            <img src="{{asset('public/dashboard/img/icons/admin-user.png')}}" class="img-fluid" alt="icon">
            <span>Admin User</span>
          </a>
        </li>    
      @endif 

      @if(in_array('list_vendor',$permissions))
        <li class="nav-item">
          <a class="nav-link" href="{{URL('admin/signature')}}">
            <img src="{{asset('public/dashboard/img/icons/voucher.png')}}" class="img-fluid" alt="icon">
            <span>Signature</span>
          </a>
        </li>
      @endif

      @if(in_array('list_finance',$permissions) || in_array('list_inhand',$permissions) || in_array('list_loyalty',$permissions) || in_array('list_desk',$permissions))
        <li class="nav-item">
          <a class="nav-link" href="{{URL('admin/vouchers/finance')}}">
            <img src="{{asset('public/dashboard/img/icons/voucher.png')}}" class="img-fluid" alt="icon">
            <span>Vouchers</span>
          </a>
        </li>
      @endif

      @if(in_array('list_submissions',$permissions))
      <li class="nav-item">
        <a class="nav-link" href="{{URL('admin/loyalty/submissions')}}">
          <img src="{{asset('public/dashboard/img/icons/voucher.png')}}" class="img-fluid" alt="icon">
          <span>Submissions</span>
        </a>
      </li>
      @endif

       @if(in_array('list_redumption',$permissions))
      <li class="nav-item">
        <a class="nav-link" href="{{URL('admin/loyalty/redumption')}}">
          <img src="{{asset('public/dashboard/img/icons/voucher.png')}}" class="img-fluid" alt="icon">
          <span>Redemptions</span>
        </a>
      </li>
      @endif

      @if(in_array('list_floor_plan',$permissions))
      <li class="nav-item">
        <a class="nav-link" href="{{URL('admin/floor-plans')}}">
          <img src="{{asset('public/dashboard/img/icons/plans.png')}}" class="img-fluid" alt="icon">
          <span>Floor Plans</span>
        </a>
      </li>
      @endif

      @if(in_array('list_banners',$permissions))
      <li class="nav-item">
        <a class="nav-link" href="{{URL('admin/banners')}}">
          <img src="{{asset('public/dashboard/img/icons/plans.png')}}" class="img-fluid" alt="icon">
          <span>Banner</span>
        </a>
      </li>
      @endif

      @if(in_array('list_shop_offers',$permissions))
      <li class="nav-item">
        <a class="nav-link" href="{{URL('admin/offers')}}">
          <img src="{{asset('public/dashboard/img/icons/discount.png')}}" class="img-fluid" alt="icon">
          <span>Offers</span>
        </a>
      </li>
      @endif

      @if(in_array('list_events',$permissions))
      <li class="nav-item">
        <a class="nav-link" href="{{URL('admin/events')}}">
          <img src="{{asset('public/dashboard/img/icons/discount.png')}}" class="img-fluid" alt="icon">
          <span>Events</span>
        </a>
      </li>
      @endif

      @if(in_array('list_magazines',$permissions))
      <li class="nav-item">
        <a class="nav-link" href="{{URL('admin/magazines')}}">
          <img src="{{asset('public/dashboard/img/icons/book.png')}}" class="img-fluid" alt="icon">
          <span>Magazines</span>
        </a>
      </li>
      @endif

      @if(in_array('list_shops',$permissions))
      <li class="nav-item">
        <a class="nav-link" href="{{URL('admin/loyalty/redumption')}}">
          <img src="{{asset('public/dashboard/img/icons/shop.png')}}" class="img-fluid" alt="icon">
          <span>Shop</span>
        </a>
      </li>
      @endif

      @if(in_array('reports',$permissions))
      <li class="nav-item">
        <a class="nav-link" href="{{URL('admin/reports/submissions')}}">
          <img src="{{asset('public/dashboard/img/icons/report.png')}}" class="img-fluid" alt="icon">
          <span>Report</span>
        </a>
      </li>
      @endif

      @if(in_array('list_rating',$permissions))
      <li class="nav-item">
        <a class="nav-link" href="{{URL('admin/rating-questions')}}">
          <img src="{{asset('public/dashboard/img/icons/star.png')}}" class="img-fluid" alt="icon">
          <span>Rating</span>
        </a>
      </li>
      @endif
            
            @if(in_array('list_notification',$permissions))
      <li class="nav-item">
        <a class="nav-link" href="{{URL('admin/notifications')}}">
          <img src="{{asset('public/dashboard/img/icons/star.png')}}" class="img-fluid" alt="icon">
          <span>Notifications</span>
        </a>
      </li>
      @endif

      <li class="nav-item">
        <a class="nav-link" href="{{URL('admin/settings')}}">
          <img src="{{asset('public/dashboard/img/icons/star.png')}}" class="img-fluid" alt="icon">
          <span>Settings</span>
        </a>
      </li>

    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand topbar mb-0 static-top">
          <div class="form-group d-flex align-items-center mb-0">
            <!-- <img src="img/icons/profile.png" class="img-fluid" alt="img"> -->
            <!-- <select class="form-control admin-select" id="">
              <option>Super Admin</option>
              <option>Admin</option>
              <option>Sub Admin</option>
            </select> -->
            <ul class="navbar-nav">
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <img class="img-profile rounded-circle non-invert" src="{{asset('public/dashboard/img/icons/profile.png')}}">
                  <span class="ml-2 d-none d-lg-inline text-white small">{{Auth::guard('admin')->user()->first_name}}</span>
                  <!-- <span class=ml-3><img src="{{asset('public/dashboard/img/icons/down-arrow.png')}}" class="img-fluid non-invert" alt="icon"></span> -->
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <!-- <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                  </a>
                  <div class="dropdown-divider"></div> -->
                  <a class="dropdown-item" href="{{URL('admin/logout')}}" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </div>
          <!-- <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow d-flex align-items-center">
              <form action="">
                <div class="form-group search-form mb-0">
                  <input type="text" class="form-control" id="search" aria-describedby="search" placeholder="Search">
                  <a href="member-profile.html" class="search-btn"><img src="{{asset('public/dashboard/img/icons/search.png')}}" class="img-fluid" alt="icon"></a>
                </div>
              </form>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="">
                <img src="{{asset('public/dashboard/img/icons/contact.png')}}" class="img-fluid" alt="icon">
              </a>
            </li>

            <li class="nav-item notification">
              <a class="nav-link" href="">
                <img src="{{asset('public/dashboard/img/icons/notification.png')}}" class="img-fluid" alt="icon">
              </a>
            </li>
          </ul> -->
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-head">Dashboard</h1>
            <!-- <img src="img/logo/hyatt.png" class="img-fluid" alt="img"> -->
          </div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Gerneral</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
          </ol>
          <div class="row mb-3">
            <!-- Total -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card dash-cards h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <img src="{{asset('public/dashboard/img/icons/customers.png')}}" class="img-fluid" alt="icon">
                    </div>
                    <div class="col mr-2">
                      <div class="h5 mb-2 font-weight-bold text-value">{{$dvalue['dashboard_count']->total}}</div>
                      <div class="text-xs mb-1">Total Customers</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Male -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card dash-cards h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <img src="{{asset('public/dashboard/img/icons/male-user.png')}}" class="img-fluid" alt="icon">
                    </div>
                    <div class="col mr-2">
                      <div class="h5 mb-2 font-weight-bold text-value">{{$dvalue['dashboard_count']->male}}</div>
                      <div class="text-xs mb-1">Male Customers</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Female -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card dash-cards h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <img src="{{asset('public/dashboard/img/icons/female-user.png')}}" class="img-fluid" alt="icon">
                    </div>
                    <div class="col mr-2">
                      <div class="h5 mb-2 font-weight-bold text-value">{{$dvalue['dashboard_count']->female}}</div>
                      <div class="text-xs mb-1">Female Customers</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Others -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card dash-cards h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <img src="{{asset('public/dashboard/img/icons/other-user.png')}}" class="img-fluid" alt="icon">
                    </div>
                    <div class="col mr-2">
                      <div class="h5 mb-2 font-weight-bold text-value">{{$dvalue['dashboard_count']->others}}</div>
                      <div class="text-xs mb-1">Other Customers</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

          <div class="row mb-3">
            <!-- Total -->
            <!-- <div class="col-xl-6 col-md-6 mb-4">
              <form action="">
                <div class="form-group search-form">
                  <input type="text" class="form-control" id="search" aria-describedby="search" placeholder="Your mobile number">
                  <a href="member-profile.html" class="search-btn"><img src="img/icons/search.png" class="img-fluid" alt="icon"></a>
                </div>
              </form>
            </div> -->
             <!-- Area Chart -->
             <div class="col-xl-8 col-lg-7 mb-4">
              <div class="card chart-card h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold">Growth Statistics</h6>
                  <!-- <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                      aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div> -->
                 <!--  <select class="form-control date-select mr-md-3" id="">
                    <option>December</option>
                    <option>January</option>
                    <option>February</option>
                  </select> -->
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="dashboardChart"></canvas>
                    <!-- <canvas id="myAreaChartLight"></canvas> -->
                  </div>
                </div>
              </div>
            </div>

            <!-- Notifications -->
            <div class="col-xl-4 col-lg-5">
              <div class="card notification-card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold">Notifications</h6>
                </div>
                <div class="card-body">
                  
                  @foreach($notifications as $notify)
                    <div class="mb-3">
                      <a class="d-flex align-items-center" href="#">
                        <!-- <div class="mr-3">
                          <div class="icon-notification">
                            <img src="{{asset('public/dashboard/img/icons/not-img.png')}}" class="img-fluid" alt="img">
                          </div>
                        </div> -->
                        <div>
                          <span class="notification-text">{{$notify->title}}</span>
                          <div class="notification-text-sm">{{date('Y-m-d h:i a',strtotime('+5 hour +30 minutes',strtotime($notify->created_at)))}}</div>
                        </div>
                      </a>
                    </div>
                  @endforeach  

                </div>

                @if($notify_count > 6)
                  <div class="card-footer text-center">
                    <a class="m-0 small card-link" href="{{URL('admin/adminNotifications')}}">View All</a>
                  </div>
                @endif
              </div>
            </div>
          </div>
          <!--Row-->

          <div class="row">
            <!-- New Customers This Month -->
            <div class="col-xl-4 col-lg-5">
              <div class="card new-user-card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold">New Customers This Month</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3" href="#">
                      <div class="mr-3">
                        <div class="icon-new-user">
                          <img src="{{asset('public/dashboard/img/icons/male-user-sm.png')}}" class="img-fluid" alt="img">
                        </div>
                      </div>
                      <div>
                        <span class="new-user-text">{{$dvalue['dashboard_count']->new_male}}</span>
                        <div class="new-user-text-sm">Male Customers</div>
                      </div>
                    </div>

                    <div class="d-flex align-items-center mb-3" href="#">
                      <div class="mr-3">
                        <div class="icon-new-user">
                          <img src="{{asset('public/dashboard/img/icons/female-user-sm.png')}}" class="img-fluid" alt="img">
                        </div>
                      </div>
                      <div>
                        <span class="new-user-text">{{$dvalue['dashboard_count']->new_female}}</span>
                        <div class="new-user-text-sm">Female Customers</div>
                      </div>
                    </div>

                    <div class="d-flex align-items-center mb-3" href="#">
                      <div class="mr-3">
                        <div class="icon-new-user">
                          <img src="{{asset('public/dashboard/img/icons/other-user-sm.png')}}" class="img-fluid" alt="img">
                        </div>
                      </div>
                      <div>
                        <span class="new-user-text">{{$dvalue['dashboard_count']->new_others}}</span>
                        <div class="new-user-text-sm">Other Customers</div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <!-- New Customers This Month ends-->

            <!-- liability -->
            <div class="col-xl-8 col-lg-7 p-0 mb-4">
              <!-- Datatables -->
              <div class="col-lg-12 h-100">
                <div class="card h-100">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Liability</h6>
                  </div>
                  <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="liabilityTable">
                      <thead class="thead-light-or">
                        <tr>
                          <th>LABEL</th>
                          <th>CURRENT YEAR</th>
                          <th>LAST YEAR</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Points : MTD</td>
                          <td>{{$dvalue['dashboard_count']->mtd_liability}}</td>
                          <td>{{$dvalue['dashboard_count']->prev_mtd_liability}}</td>
                        </tr>
                        <tr>
                          <td>Points : YTD</td>
                          <td>{{$dvalue['dashboard_count']->ytd_liability}}</td>
                          <td>{{$dvalue['dashboard_count']->prev_ytd_liability}}</td>
                        </tr>
                        <tr>
                          <td>Points Expiring this month</td>
                          <td>19</td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> 
            </div>
          </div>

          <div class="row">
            <!-- Redemptions -->
            <div class="col-xl-8 col-lg-7 p-0 mb-4">
              <!-- Datatables -->
              <div class="col-lg-12 h-100">
                <div class="card h-100">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Redemptions</h6>
                  </div>
                  <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="RedemptionsTable">
                      <thead class="thead-light-pi">
                        <tr>
                          <th>LABEL</th>
                          <th>CURRENT YEAR</th>
                          <th>LAST YEAR</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Points : MTD</td>
                          <td>{{$dvalue['dashboard_count']->redumption}}</td>
                          <td>{{$dvalue['dashboard_count']->last_redumption}}</td>
                        </tr>
                        <tr>
                          <td>Points : YTD</td>
                          <td>{{$dvalue['dashboard_count']->ytd_redumption}}</td>
                          <td>{{$dvalue['dashboard_count']->last_ytd_redumption}}</td>
                        </tr>
                        <tr>
                          <td>Discount Value</td>
                          <td>{{$dvalue['dashboard_count']->discount_redumption}}</td>
                          <td>{{$dvalue['dashboard_count']->last_discount_redumption}}</td>
                        </tr>
                        <tr>
                          <td>Discount %</td>
                          <td>{{$dvalue['dashboard_count']->discount_percent_redumption}}</td>
                          <td>{{$dvalue['dashboard_count']->last_discount_percent_redumption}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> 
            </div>
            <!-- Redemptions ends-->
            
            <!-- sales -->
           <div class="col-xl-4 col-lg-5">
             <div class="card sales-card mb-4">
               <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold">sales</h6>
               </div>
               <div class="card-body">
                   <div class="d-flex count light-bg align-items-center justify-content-center mb-3" href="#">
                     <div class="text-center">
                       <span class="sales-text">9009189</span>
                       <div class="sales-text-sm">Current Month</div>
                     </div>
                   </div>

                   <div class="d-flex count dark-bg align-items-center justify-content-center mb-3" href="#">
                    <div class="text-center">
                      <span class="sales-text">10706266</span>
                      <div class="sales-text-sm">Since 1 Year From Now</div>
                    </div>
                  </div>
               </div>
             </div>
           </div>
           <!-- salse ends-->
          </div>

          <div class="row">
            <!-- bill submission -->
            <div class="col-xl-4 col-lg-4 p-0 mb-4">
              <!-- Datatables -->
              <div class="col-lg-12 h-100">
                <div class="card vertical h-100">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Bill Submission</h6>
                  </div>
                  <div class="table-responsive p-4">
                    <table class="table align-items-center table-flush" id="billSubmissionTable">
                      <tbody>
                        <tr>
                          <td>Total This Month</td>
                          <td class="font-weight-bold text-right">{{$dvalue['dashboard_count']->total_bills}}</td>
                        </tr>
                        <tr>
                          <td>Pending Total</td>
                          <td class="font-weight-bold text-right">{{$dvalue['dashboard_count']->total_pending}}</td>
                        </tr>
                        <tr>
                          <td>Pending Barcodes</td>
                          <td class="font-weight-bold text-right">{{$dvalue['dashboard_count']->pending_barcodes}}</td>
                        </tr>
                        <tr>
                          <td>Pending Manual</td>
                          <td class="font-weight-bold text-right">{{$dvalue['dashboard_count']->pending_images}}</td>
                        </tr>
                        <tr>
                          <td>Approved This Month</td>
                          <td class="font-weight-bold text-right">{{$dvalue['dashboard_count']->approved}}</td>
                        </tr>
                        <tr>
                          <td>Rejected This Month</td>
                          <td class="font-weight-bold text-right">{{$dvalue['dashboard_count']->rejected}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> 
            </div>
            <!-- bill submission ends -->

             <!-- Voucher Management -->
             <div class="col-xl-4 col-lg-4 p-0 mb-4">
              <!-- Datatables -->
              <div class="col-lg-12 h-100">
                <div class="card vertical h-100">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Voucher Management</h6>
                  </div>
                  <div class="table-responsive p-4">
                    <table class="table align-items-center table-flush" id="voucherManagementTable">
                      <tbody>
                        <tr>
                          <td>Finance</td>
                          <td class="font-weight-bold text-right">SAR{{$dvalue['dashboard_count']->finance_value}} ({{$dvalue['dashboard_count']->finance}})</td>
                        </tr>
                        <tr>
                          <td>In hand</td>
                          <td class="font-weight-bold text-right">SAR{{$dvalue['dashboard_count']->inhand_value}} ( {{$dvalue['dashboard_count']->inhand}} )</td>
                        </tr>
                        <tr>
                          <td>Loyalty</td>
                          <td class="font-weight-bold text-right">SAR{{$dvalue['dashboard_count']->loyalty_value}} ({{$dvalue['dashboard_count']->loyalty}})</td>
                        </tr>
                        <tr>
                          <td>Desk</td>
                          <td class="font-weight-bold text-right">SAR{{$dvalue['dashboard_count']->desk_value}} ({{$dvalue['dashboard_count']->desk}})</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> 
            </div>
            <!-- Voucher Management ends -->

            <!-- Total App Users -->
            <div class="col-xl-4 col-lg-4 p-0 mb-4">
              <!-- Datatables -->
              <div class="col-lg-12 h-100">
                <div class="card vertical h-100">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Total App Users</h6>
                  </div>
                  <div class="table-responsive p-4">
                    <table class="table align-items-center table-flush" id="appUserTable">
                      <tbody>
                        <tr>
                          <td>Active</td>
                          <td class="font-weight-bold text-right">{{$dvalue['dashboard_count']->active}}</td>
                        </tr>
                        <tr>
                          <td>Semi Active</td>
                          <td class="font-weight-bold text-right">{{$dvalue['dashboard_count']->semiactive}}</td>
                        </tr>
                        <tr>
                          <td>Inactive</td>
                          <td class="font-weight-bold text-right">{{$dvalue['dashboard_count']->inactive}}</td>
                        </tr>
                        <tr>
                          <td>Log in for the day</td>
                          <td class="font-weight-bold text-right">{{$dvalue['dashboard_count']->login}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> 
            </div>
            <!-- Total App Users ends -->
          </div>

          <!-- Best sellers -->
          <div class="row">
              <!-- Datatables -->
              <div class="col-lg-12">
                <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Best Sellers</h6>
                  </div>
                  <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="bestSellers">
                      <thead class="thead-light-gn">
                        <tr>
                          <th>SL NO</th>
                          <th>SHOP LOGO</th>
                          <th>NAME</th>
                          <th>SOLID VOUCHER COUNT</th>
                          <th>SALES</th>
                          <th>BILL UPLOAD</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($dvalue['dashboard_seller'] as $key => $seller)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td><img src="{{storage_url()}}/{{$seller->logo}}" class="img-fluid" alt="logo" width="40"></td>
                            <td>{{$seller->name}}</td>
                            <td>{{$seller->count}}</td>
                            <td>{{$seller->point}}</td>
                            <td>{{$seller->bill_count}}</td>
                          </tr>
                        @endforeach
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> 
          </div>
          <!-- Best sellers ends -->

          <!-- Voucher Expiry -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold">Voucher Expiry</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="voucherExpiry">
                    <thead class="thead-light-bl">
                      <tr>
                        <th>SL NO</th>
                        <th>VOUCHER NAME</th>
                        <th>VALUE</th>
                        <th>NO. OF VOUCHER</th>
                        <th>EXPIRY DATE</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($dvalue['dashboard_expiring_vouchers'] as $key => $vouchers)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$vouchers->title}}</td>
                            <td>{{$vouchers->voucher_price}}</td>
                            <td>{{$vouchers->balanc}}</td>
                            <td>{{date('d M Y',strtotime($vouchers->expiry_date))}}</td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div> 
        </div>
        <!-- Voucher Expiry ends -->

        <!-- Best Buyers -->
        <div class="row">
          <!-- Datatables -->
          <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">Best Buyers</h6>
              </div>
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="bestBuyers">
                  <thead class="thead-light-pr">
                    <tr>
                      <th>SL NO</th>
                      <th>NAME</th>
                      <th>PHONE</th>
                      <th>AMOUNT PURCHASED</th>
                      <th>POINTS REDEEMED</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($dvalue['dashboard_buyers'] as $key => $buyers)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$buyers->name}}</td>
                          <td>{{$buyers->mobile}}</td>
                          <td>{{$buyers->total_spend}}</td>
                          <td>{{$buyers->points_used}}</td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div> 
      </div>
      <!-- Best Buyers ends -->

        </div>
        <!---Container Fluid-->
      </div>
     
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script>
    function themeFunction() {
    var element = document.getElementById("page-top");
    element.classList.toggle("dark");
  }
  </script>
  <script src="{{asset('public/dashboard/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('public/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('public/dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('public/dashboard/js/ruang-admin.min.js')}}"></script>
  <script src="{{asset('public/dashboard/vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('public/dashboard/js/demo/chart-area-demo.js')}}"></script>  
  <script src="{{asset('public/dashboard/js/dev.js')}}"></script>  
</body>

</html>