
        <div class="side-nav">
            <div class="main-menu">
                <ul class="metismenu" id="menu">
                <li class="Ul_li--hover"><a href="{{route('admin.dashboard')}}"><i class="fa fa-tachometer text-20 mr-2" aria-hidden="true"></i><span class="item-name text-15 text-muted">Dashboard</span></a>
                    </li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="fa fa-paw text-20 mr-2" aria-hidden="true"></i><span class="item-name text-15 text-muted">Cows</span></a>
                        <ul class="mm-collapse">
                            <li class="item-name"><a href="{{route('seller')}}"><i class="nav-icon i-Width-Window"></i><span class="item-name">Seller</span></a></li>
                            <li class="item-name"><a href="{{route('buyer')}}"><i class="nav-icon i-Duplicate-Window"></i><span class="item-name">Buyer</span></a></li>
                            <li class="item-name"><a href="{{route('bread')}}"><i class="nav-icon i-Duplicate-Window"></i><span class="item-name">Bread</span></a></li>
                            <li class="item-name"><a href="{{route('cow_list')}}"><i class="nav-icon i-Width-Window"></i><span class="item-name">Cow List</span></a></li>
                        </ul>
                    </li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="fa fa-hourglass-start text-20 mr-2" aria-hidden="true"></i><span class="item-name text-15 text-muted">Milk Store</span></a>
                        <ul class="mm-collapse">
                            <li class="item-name"><a href="{{route('collect_milk')}}"><i class="nav-icon i-Width-Window"></i><span class="item-name">Collect Milk</span></a></li>
                            <li class="item-name"><a href="{{route('milk_buyer')}}"><i class="nav-icon i-Duplicate-Window"></i><span class="item-name">Milk Buyer</span></a></li>
                            <li class="item-name"><a href="{{route('sell_milk')}}"><i class="nav-icon i-Duplicate-Window"></i><span class="item-name">Sell Milk</span></a></li>
                            <li class="item-name"><a href="{{route('milk_stock')}}"><i class="nav-icon i-Width-Window"></i><span class="item-name">Milk Stock</span></a></li>
                        </ul>
                    </li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><ion-icon class="text-20 mr-2 text-muted" name="server-outline"></ion-icon><span class="item-name text-15 text-muted">Foods</span></a>
                        <ul class="mm-collapse">
                            <li class="item-name"><a href="{{route('food.category')}}"><i class="nav-icon i-Width-Window"></i><span class="item-name">Food Category</span></a></li>
                            <li class="item-name"><a href="{{route('food')}}"><i class="nav-icon i-Duplicate-Window"></i><span class="item-name">Foods</span></a></li>
                            <li class="item-name"><a href="{{route('buy_food')}}"><i class="nav-icon i-Duplicate-Window"></i><span class="item-name">Buy Food</span></a></li>
                            <li class="item-name"><a href="{{route('feed_food')}}"><i class="nav-icon i-Duplicate-Window"></i><span class="item-name">Feed Food</span></a></li>
                            <li class="item-name"><a href="{{route('food_stock')}}"><i class="nav-icon i-Duplicate-Window"></i><span class="item-name">Food Stock</span></a></li>
                        </ul>
                    </li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><ion-icon class="text-20 mr-2 text-muted" name="person-add-outline"></ion-icon><span class="item-name text-15 text-muted">Human Resource</span></a>
                        <ul class="mm-collapse">
                        <li class="item-name"><a href="{{route('staff_list')}}"><i class="i-Computer-Secure text-20 mr-2 text-muted"></i><span class="item-name">Staff List</span></a></li>
                        <li class="item-name"><a href="{{route('add_staff')}}"><i class="i-Computer-Secure text-20 mr-2 text-muted"></i><span class="item-name">Add Staff</span></a></li>
                        </ul>
                    </li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><ion-icon class="text-20 mr-2 text-muted" name="git-branch-outline"></ion-icon><span class="item-name text-15 text-muted">Payment</span></a>
                        <ul class="mm-collapse">
                        <li class="item-name"><a href="{{route('milk_payment')}}"><i class="nav-icon i-Receipt-4"></i><span class="item-name">Milk Payment</span></a></li>
                            <li class="item-name"><a href="{{route('staff_payment')}}"><i class="nav-icon i-Receipt-4"></i><span class="item-name">Staff payment</span></a></li>
                        </ul>
                    </li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><ion-icon class="text-20 mr-2 text-muted" name="git-branch-outline"></ion-icon><span class="item-name text-15 text-muted">Expenses</span></a>
                        <ul class="mm-collapse">
                        <li class="item-name"><a href="{{route('expense_type')}}"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">Expense Type</span></a></li>
                            <li class="item-name"><a href="{{route('expenses')}}"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">Expense List</span></a></li>
                        </ul>
                    </li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><ion-icon class="text-20 mr-2 text-muted" name="reader-outline"></ion-icon><span class="item-name text-15 text-muted">Reports</span></a>
                        <ul class="mm-collapse">
                        <li class="item-name"><a href="{{route('sell_report_search')}}"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">Milk Sell Report</span></a></li>
                        <li class="item-name"><a href="{{route('cow_sell_report_search')}}"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">Cow Sell Report</span></a></li>
                            <li class="item-name"><a href="{{route('expense_report_search')}}"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">Expense Report</span></a></li>
                            <li class="item-name"><a href="{{route('income_summery_search')}}"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">Income Summery</span></a></li>
                        </ul>
                    </li>
                    <li class="Ul_li--hover"><a class="has-arrow"><i class="fa fa-cogs text-20 mr-2" aria-hidden="true"></i></i><span class="item-name text-15 text-muted">System Setting</span></a>
                        <ul class="mm-collapse">
                            <li class="item-name"><a href="{{route('general_setting')}}"><i class="nav-icon i-Error-404-Window"></i><span class="item-name">General Setting</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        {{-- <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
        </div> --}}
    </div>
    <!--  side-nav-close -->
</div>

    <div class="switch-overlay"></div>
        <div class="main-content-wrap mobile-menu-content bg-off-white m-0">
            <header class="main-header bg-white d-flex justify-content-between p-2">
                <div class="header-toggle">
                    <div class="menu-toggle mobile-menu-icon">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div><i class="i-Add-UserStar mr-3 text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Todo"></i><i class="i-Speach-Bubble-3 mr-3 text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Chat"></i><i class="i-Email mr-3 text-20 mobile-hide cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inbox"></i><i class="i-Calendar-4 mr-3 mobile-hide text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Calendar"></i><i class="i-Checkout-Basket mobile-hide mr-3 text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Calendar"></i>
                </div>
                <div class="header-part-right">
                    <!-- Full screen toggle--><i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>
                    <!-- Grid menu Dropdown-->
                    
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="{{url('admin/profile')}}"><img height="35px" width="35px" style="margin-left: 20px;" src="{{ file_exists(@$profile->image) ? asset(@$profile->image) : asset('backend/uploads/staff/admin.PNG') }}" alt=""></a>
                </div>
            </header><!-- ============ Body content start ============= -->
        <div class="main-content pt-4">