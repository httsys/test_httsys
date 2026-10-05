<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset('css/libs/bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/libs/fontawesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/libs/custom-dashboard.css')}}" rel="stylesheet">
    
    @yield('styles')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#0">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa fa-code"></i>
                </div>
                <div class="sidebar-brand-text mx-3">HT Tech system<sup>v1.0</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{clean( trans('niva-backend.dashboard') , array('Attr.EnableID' => true))}}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            @php $lang = App\Models\Language::find(1); @endphp

            @if(Auth::user()->role->name == 'administrator')
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="/admin" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="far fa-fw fa-file"></i>
                    <span>{{clean( trans('niva-backend.pages') , array('Attr.EnableID' => true))}}</span>
                </a>
                <div id="collapsePages" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                     
                        

                        <a class="collapse-item" href="{{ route('page.index') }}?language=@php echo $lang->code; @endphp">{{clean( trans('niva-backend.all_pages') , array('Attr.EnableID' => true))}}</a>
                        <a class="collapse-item" href="{{ route('page.create') }}?language=@php echo $lang->code; @endphp">{{clean( trans('niva-backend.create_page') , array('Attr.EnableID' => true))}}</a>
                       
                        <h6 class="collapse-header">{{clean( trans('niva-backend.custom_pages') , array('Attr.EnableID' => true))}}</h6>

                        
                           <a class="collapse-item" href="{{ route('index-custom') }}?language=@php echo $lang->code; @endphp">{{clean( trans('niva-backend.custom_templates') , array('Attr.EnableID' => true))}}</a>


                        
                    </div>
                </div>
            </li>
            @endif

            @if(Auth::user()->role->name == 'administrator')
            <li class="nav-item">
                <a class="nav-link collapsed" href="/admin" data-toggle="collapse" data-target="#collapseProjects"
                    aria-expanded="true" aria-controls="collapseProjects">
                    <i class="fas fa-fw fa-pencil-ruler"></i>
                    <span>{{clean( trans('niva-backend.projects') , array('Attr.EnableID' => true))}}</span>
                </a>
                <div id="collapseProjects" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('project.index') }}?language=@php echo $lang->code; @endphp">{{clean( trans('niva-backend.all_projects') , array('Attr.EnableID' => true))}}</a>
                        <a class="collapse-item" href="{{ route('project.create') }}?language=@php echo $lang->code; @endphp">{{clean( trans('niva-backend.create_project') , array('Attr.EnableID' => true))}}</a>
                        <h6 class="collapse-header">{{clean( trans('niva-backend.categories') , array('Attr.EnableID' => true))}}</h6>
                        <a class="collapse-item" href="{{ route('project-category.index') }}?language=@php echo $lang->code; @endphp">{{clean( trans('niva-backend.all_categories') , array('Attr.EnableID' => true))}}</a>
                    </div>
                </div>
            </li>
            @endif

            @haspermission('pos.access')
            <li class="nav-item">
                <a class="nav-link collapsed" href="/admin" data-toggle="collapse" data-target="#collapsePos"
                    aria-expanded="true" aria-controls="collapsePos">
                    <i class="fas fa-fw fa-cash-register"></i>
                    <span>POS</span>
                </a>
                <div id="collapsePos" class="collapse" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('pos.index') }}">New Sale</a>
                        <a class="collapse-item" href="{{ route('pos-orders.index') }}">POS Orders</a>
                    </div>
                </div>
            </li>
            @endhaspermission

            @haspermission('wallet.view')
            <li class="nav-item">
                <a class="nav-link collapsed" href="/admin" data-toggle="collapse" data-target="#collapseWallet"
                    aria-expanded="true" aria-controls="collapseWallet">
                    <i class="fas fa-fw fa-wallet"></i>
                    <span>Wallet</span>
                </a>
                <div id="collapseWallet" class="collapse" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('wallet.admin.index') }}">All Wallets</a>
                        <a class="collapse-item" href="{{ route('wallet.admin.escrow.index') }}">Escrow Holds</a>
                        <a class="collapse-item" href="{{ route('wallet.admin.withdrawals.index') }}">Withdrawal Requests</a>
                        <a class="collapse-item" href="{{ route('wallet.admin.topups.index') }}">Top-up Requests</a>
                        @haspermission('wallet.fees.manage')
                            <a class="collapse-item" href="{{ route('wallet.admin.fees.edit') }}">Fee Settings</a>
                        @endhaspermission
                        @haspermission('currency_exchange.manage')
                            <a class="collapse-item" href="{{ route('currency.admin.index') }}">Currency Listings</a>
                            <a class="collapse-item" href="{{ route('currency.admin.currencies.index') }}">Currencies</a>
                        @endhaspermission
                        @haspermission('marketplace.manage')
                            <a class="collapse-item" href="{{ route('marketplace.admin.index') }}">Marketplace Listings</a>
                        @endhaspermission
                    </div>
                </div>
            </li>
            @endhaspermission

            @if(Auth::user()->role->name == 'administrator')
            <li class="nav-item">
                <a class="nav-link collapsed" href="/admin" data-toggle="collapse" data-target="#collapseShop"
                    aria-expanded="true" aria-controls="collapseShop">
                    <i class="fas fa-fw fa-store"></i>
                    <span>Shop</span>
                </a>
                <div id="collapseShop" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @haspermission('shop.products.manage')
                        <a class="collapse-item" href="{{ route('products.index') }}?language=@php echo $lang->code; @endphp">All Products</a>
                        @endhaspermission
                        @haspermission('shop.products.manage')
                        <a class="collapse-item" href="{{ route('products.create') }}?language=@php echo $lang->code; @endphp">Add Product</a>
                        @endhaspermission
                        <h6 class="collapse-header">Catalog</h6>
                        @haspermission('shop.categories.manage')
                        <a class="collapse-item" href="{{ route('product-categories.index') }}?language=@php echo $lang->code; @endphp">Categories</a>
                        @endhaspermission
                        @haspermission('shop.brands.manage')
                        <a class="collapse-item" href="{{ route('brands.index') }}">Brands</a>
                        @endhaspermission
                        <h6 class="collapse-header">Sales</h6>
                        @haspermission('orders.view')
                        <a class="collapse-item" href="{{ route('orders.admin.index') }}">All Orders</a>
                        @haspermission('orders.returns.manage')
                        <a class="collapse-item" href="{{ route('order-returns.admin.index') }}">Return Requests</a>
                        @endhaspermission
                        @endhaspermission
                        @haspermission('shop.payment_methods.manage')
                        <a class="collapse-item" href="{{ route('shop-payment-methods.index') }}">Payment Methods</a>
                        @endhaspermission
                        @haspermission('shop.coupons.manage')
                        <a class="collapse-item" href="{{ route('coupons.index') }}">Coupons</a>
                        @endhaspermission
                        @haspermission('shop.pickup_locations.manage')
                        <a class="collapse-item" href="{{ route('pickup-locations.index') }}">Pickup Locations</a>
                        @endhaspermission
                    </div>
                </div>
            </li>
            @endif

            @if(Auth::user()->hasPermission('games.settings.manage') || Auth::user()->hasPermission('games.ads.manage') || Auth::user()->hasPermission('games.plays.view'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="/admin" data-toggle="collapse" data-target="#collapseGames"
                    aria-expanded="true" aria-controls="collapseGames">
                    <i class="fas fa-fw fa-gamepad"></i>
                    <span>Mini Games</span>
                </a>
                <div id="collapseGames" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @haspermission('games.settings.manage')
                        <a class="collapse-item" href="{{ route('game-settings.edit') }}">Game Settings</a>
                        @endhaspermission
                        @haspermission('games.ads.manage')
                        <a class="collapse-item" href="{{ route('game-ads.index') }}">Advertisements</a>
                        <a class="collapse-item" href="{{ route('game-ads.create') }}">Add Advertisement</a>
                        @endhaspermission
                        @haspermission('games.plays.view')
                        <a class="collapse-item" href="{{ route('game-plays.index') }}">Play History</a>
                        @endhaspermission
                    </div>
                </div>
            </li>
            @endif

            @if(Auth::user()->role->name == 'administrator')
            <li class="nav-item">
                <a class="nav-link collapsed" href="/admin" data-toggle="collapse" data-target="#collapseDonations"
                    aria-expanded="true" aria-controls="collapseDonations">
                    <i class="fas fa-fw fa-hand-holding-heart"></i>
                    <span>Donations</span>
                </a>
                <div id="collapseDonations" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @haspermission('donations.view')
                        <a class="collapse-item" href="{{ route('donations.admin.index') }}">All Donations</a>
                        @endhaspermission
                        <h6 class="collapse-header">Setup</h6>
                        @haspermission('donations.funds.manage')
                        <a class="collapse-item" href="{{ route('funds.index') }}?language=@php echo $lang->code; @endphp">Funds</a>
                        @endhaspermission
                        @haspermission('donations.payment_methods.manage')
                        <a class="collapse-item" href="{{ route('payment-methods.index') }}">Payment Methods</a>
                        @endhaspermission
                    </div>
                </div>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link collapsed" href="/admin" data-toggle="collapse" data-target="#collapsePosts"
                    aria-expanded="true" aria-controls="collapsePosts">
                    <i class="fas fa-fw fa-file-signature"></i>
                    <span>{{clean( trans('niva-backend.posts') , array('Attr.EnableID' => true))}}</span>
                </a>
                <div id="collapsePosts" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @haspermission('content.posts.manage')
                        <a class="collapse-item" href="{{ route('post.index') }}?language=@php echo $lang->code; @endphp">{{clean( trans('niva-backend.all_posts') , array('Attr.EnableID' => true))}}</a>
                        @endhaspermission
                        @haspermission('content.posts.manage')
                        <a class="collapse-item" href="{{ route('post.create') }}?language=@php echo $lang->code; @endphp">{{clean( trans('niva-backend.create_post') , array('Attr.EnableID' => true))}}</a>
                        @endhaspermission
                        <h6 class="collapse-header">{{clean( trans('niva-backend.categories') , array('Attr.EnableID' => true))}}</h6>
                        @haspermission('content.categories.manage')
                        <a class="collapse-item" href="{{ route('category.index') }}?language=@php echo $lang->code; @endphp">{{clean( trans('niva-backend.all_categories') , array('Attr.EnableID' => true))}}</a>
                        @endhaspermission
                        <h6 class="collapse-header">Comments</h6>
                        @haspermission('content.comments.manage')
                        <a class="collapse-item" href="{{ route('comments.index') }}">All Comments</a>
                        @endhaspermission
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="/media" data-toggle="collapse" data-target="#collapseMedia"
                    aria-expanded="true" aria-controls="collapseMedia">
                    <i class="fas fa-fw fa-images"></i>
                    <span>{{clean( trans('niva-backend.media') , array('Attr.EnableID' => true))}}</span>
                </a>
                <div id="collapseMedia" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @haspermission('content.media.manage')
                        <a class="collapse-item" href="{{ route('media.index') }}">{{clean( trans('niva-backend.all_media') , array('Attr.EnableID' => true))}}</a>
                        @endhaspermission
                        @haspermission('content.media.manage')
                        <a class="collapse-item" href="{{ route('media.create') }}">{{clean( trans('niva-backend.upload_image') , array('Attr.EnableID' => true))}}</a>
                        @endhaspermission
                    </div>
                </div>
            </li>

            @if(Auth::user()->role->name == 'administrator')
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="/admin" data-toggle="collapse" data-target="#collapseUsers"
                    aria-expanded="true" aria-controls="collapseUsers">
                    <i class="fas fa-fw fa-user"></i>
                    <span>{{clean( trans('niva-backend.users') , array('Attr.EnableID' => true))}}</span>
                </a>
                <div id="collapseUsers" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @haspermission('users.view')
                        <a class="collapse-item" href="{{ route('users.index') }}">{{clean( trans('niva-backend.all_users') , array('Attr.EnableID' => true))}}</a>
                        @endhaspermission
                        @haspermission('users.create')
                        <a class="collapse-item" href="{{ route('users.create') }}">{{clean( trans('niva-backend.create_user') , array('Attr.EnableID' => true))}}</a>
                        @endhaspermission
                        @haspermission('users.roles.manage')
                        <a class="collapse-item" href="{{ route('roles.index') }}">Roles &amp; Permissions</a>
                        @endhaspermission
                        @haspermission('users.profile_requests')
                        <a class="collapse-item" href="{{ route('profile-requests.admin.index') }}">Profile Change Requests
                            @php $pendingProfileRequestCount = \App\Models\ProfileUpdateRequest::where('status', 'pending')->count(); @endphp
                            @if ($pendingProfileRequestCount)
                                <span class="badge badge-danger">{{ $pendingProfileRequestCount }}</span>
                            @endif
                        </a>
                        @endhaspermission
                    </div>
                </div>
            </li>
            @endif

            @if(Auth::user()->role->name == 'administrator')
             <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="/admin" data-toggle="collapse" data-target="#collapseElements"
                    aria-expanded="true" aria-controls="collapseElements">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Elements</span>
                </a>
                <div id="collapseElements" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    	<a class="collapse-item" href="{{ route('slider.index') }}?language=@php echo $lang->code; @endphp">Manage slider </a>
                    	<a class="collapse-item" href="{{ route('service.index') }}?language=@php echo $lang->code; @endphp">Manage services</a>
                    	<a class="collapse-item" href="{{ route('testimonial.index') }}?language=@php echo $lang->code; @endphp">Manage testimonials</a>
                        <a class="collapse-item" href="{{ route('member.index') }}?language=@php echo $lang->code; @endphp">Manage members</a>
                        <a class="collapse-item" href="{{ route('client.index') }}?language=@php echo $lang->code; @endphp">Manage clients</a>
                        <a class="collapse-item" href="{{ route('pricing.index') }}?language=@php echo $lang->code; @endphp">Pricing tables</a>
                    </div>
                </div>
            </li>
            @endif

            @if(Auth::user()->role->name == 'administrator')
             <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="/admin" data-toggle="collapse" data-target="#collapseSEO"
                    aria-expanded="true" aria-controls="collapseSEO">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>{{clean( trans('niva-backend.settings') , array('Attr.EnableID' => true))}}</span>
                </a>
                <div id="collapseSEO" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('setting.edit') }}?language=@php echo $lang->code; @endphp">{{clean( trans('niva-backend.title_log_favicon') , array('Attr.EnableID' => true))}}</a>
                        <a class="collapse-item" href="{{ route('menu.index') }}?language=@php echo $lang->code; @endphp">{{clean( trans('niva-backend.main_menu') , array('Attr.EnableID' => true))}}</a>
                        <a class="collapse-item" href="{{ route('headerfooter-setting.edit') }}?language=@php echo $lang->code; @endphp">{{clean( trans('niva-backend.header_and_footer') , array('Attr.EnableID' => true))}}</a>
                        <a class="collapse-item" href="{{ route('contact-setting.edit') }}?language=@php echo $lang->code; @endphp">Contact</a>
                        <a class="collapse-item" href="{{ route('blog-setting.edit') }}?language=@php echo $lang->code; @endphp">Blog</a>
                        <a class="collapse-item" href="{{ route('notification-setting.edit') }}?language=@php echo $lang->code; @endphp">Notification Popup</a>
                        <a class="collapse-item" href="{{ route('ad-zone.index') }}">Ad Placements</a>
                        <a class="collapse-item" href="{{ route('home-section.index') }}">Homepage Sections</a>
                        <a class="collapse-item" href="{{ route('language.index') }}">{{clean( trans('niva-backend.all_languages') , array('Attr.EnableID' => true))}}</a>
                    </div>
                </div>
            </li>
            @endif


           


            


  

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


     

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

    


                        <li class="mr-2"> <a target="_blank" href="{{ route('profile.show') }}" class="user-profile-link d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm"><i class="fas fa-user"></i> User Profile</a></li>

                        <li> <a target="_blank" href="{{ route('home') }}" class="view-website-link d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fab fa-chrome"></i> {{clean( trans('niva-backend.view_website') , array('Attr.EnableID' => true))}}</a></li>

                        <div class="topbar-divider d-none d-sm-block"></div>



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @php $user = Auth::user(); @endphp
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{$user->photo ? '/public/images/media/' . $user->photo->file : '/public/img/200x200.png'}}" alt="">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Profile &amp; Notepad
                                </a>
                                <a class="dropdown-item" href="{{ url('/admin/users') }}/{{auth()->user()->id}}/edit">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{clean( trans('niva-backend.edit_user') , array('Attr.EnableID' => true))}}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{clean( trans('niva-backend.logout') , array('Attr.EnableID' => true))}}
                                </a>
                               
                            </div>
                        </li>

                    </ul>

                </nav>





                 @yield('content')
 

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>{{clean( trans('niva-backend.copyright_text') , array('Attr.EnableID' => true))}}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{clean( trans('niva-backend.ready_leave') , array('Attr.EnableID' => true))}}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">{{clean( trans('niva-backend.logout_message') , array('Attr.EnableID' => true))}}</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" >{{clean( trans('niva-backend.cancel') , array('Attr.EnableID' => true))}}</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{clean( trans('niva-backend.logout') , array('Attr.EnableID' => true))}}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }} </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('js/libs/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/libs/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/libs/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/libs/custom-dashboard.js') }}"></script>



    @yield('footer')
   

    


</body>

</html>
