<div class="main-header">
            <div class="logo">
                <img src="{{asset('public/admins/images/IMPEX-Logo-without-tag@2x.png')}}" style="width: 85%">
            </div>
            <div class="menu-toggle">
                <div></div>
                <div></div>
                <div></div>
            </div>
            
            <div style="margin: auto"></div>
            <div class="header-part-right">
                <!-- Full screen toggle -->
               
                <!-- Notificaiton -->
                
                <!-- Notificaiton End -->
                <!-- User avatar dropdown -->
                <div class="dropdown">
                    <div class="user col align-self-end">
                        <img src="{{asset('public/admins/images/IMPEX-Logo-without-tag.png')}}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{URL('admin/logout')}}">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>