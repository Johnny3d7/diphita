<div class="container-fluid no-gutters">
    <div class="row">
        <div class="col-lg-12 p-0 ">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="sidebar_icon d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="line_icon open_miniSide d-none d-lg-block">
                    <img src="{{ url('img/line_img.png') }}" alt="">
                </div>
                <div class="serach_field-area d-flex align-items-center">
                    <div class="search_inner">
                        <form action="#">
                            <div class="search_field">
                                <input type="text" placeholder="Search">
                            </div>
                            <button type="submit"> <img src="{{ url('img/icon/icon_search.svg') }}" alt=""> </button>
                        </form>
                    </div>
                </div>
                <div class="header_right d-flex justify-content-between align-items-center">
                    <div class="header_notification_warp d-flex align-items-center">
                        <li>
                            <a class="bell_notification_clicker" href="#"> <img src="{{ url('img/icon/bell.svg') }}" alt="">
                                <span>2</span>
                            </a>
                            <!-- Menu_NOtification_Wrap  -->
                        <div class="Menu_NOtification_Wrap">
                            <div class="notification_Header">
                                <h4>Notifications</h4>
                            </div>
                            <div class="Notification_body">
                                <!-- single_notify  -->
                                <div class="single_notify d-flex align-items-center">
                                    <div class="notify_thumb">
                                        <a href="#"><img src="{{ url('img/staf/2.png') }}" alt=""></a>
                                    </div>
                                    <div class="notify_content">
                                        <a href="#"><h5>Cool Marketing </h5></a>
                                        <p>Lorem ipsum dolor sit amet</p>
                                    </div>
                                </div>
                                <!-- single_notify  -->
                                <div class="single_notify d-flex align-items-center">
                                    <div class="notify_thumb">
                                        <a href="#"><img src="{{ url('img/staf/4.png') }}" alt=""></a>
                                    </div>
                                    <div class="notify_content">
                                        <a href="#"><h5>Awesome packages</h5></a>
                                        <p>Lorem ipsum dolor sit amet</p>
                                    </div>
                                </div>
                                <!-- single_notify  -->
                                <div class="single_notify d-flex align-items-center">
                                    <div class="notify_thumb">
                                        <a href="#"><img src="{{ url('img/staf/3.png') }}" alt=""></a>
                                    </div>
                                    <div class="notify_content">
                                        <a href="#"><h5>what a packages</h5></a>
                                        <p>Lorem ipsum dolor sit amet</p>
                                    </div>
                                </div>
                                <!-- single_notify  -->
                                <div class="single_notify d-flex align-items-center">
                                    <div class="notify_thumb">
                                        <a href="#"><img src="{{ url('img/staf/2.png') }}" alt=""></a>
                                    </div>
                                    <div class="notify_content">
                                        <a href="#"><h5>Cool Marketing </h5></a>
                                        <p>Lorem ipsum dolor sit amet</p>
                                    </div>
                                </div>
                                <!-- single_notify  -->
                                <div class="single_notify d-flex align-items-center">
                                    <div class="notify_thumb">
                                        <a href="#"><img src="{{ url('img/staf/4.png') }}" alt=""></a>
                                    </div>
                                    <div class="notify_content">
                                        <a href="#"><h5>Awesome packages</h5></a>
                                        <p>Lorem ipsum dolor sit amet</p>
                                    </div>
                                </div>
                                <!-- single_notify  -->
                                <div class="single_notify d-flex align-items-center">
                                    <div class="notify_thumb">
                                        <a href="#"><img src="{{ url('img/staf/3.png') }}" alt=""></a>
                                    </div>
                                    <div class="notify_content">
                                        <a href="#"><h5>what a packages</h5></a>
                                        <p>Lorem ipsum dolor sit amet</p>
                                    </div>
                                </div>
                            </div>
                            <div class="nofity_footer">
                                <div class="submit_button text-center pt_20">
                                    <a href="#" class="btn_1">See More</a>
                                </div>
                            </div>
                        </div>
                        <!--/ Menu_NOtification_Wrap  -->
                        </li>
                        <li>
                            <a class="CHATBOX_open" href="#"> <img src="{{ url('img/icon/msg.svg') }}" alt=""> <span>2</span>  </a>
                        </li>
                    </div>
                    <div class="profile_info">
                        <img src="{{ url('img/'.auth()->user()->image_name.'.png') }}" alt="#">
                        <div class="profile_info_iner">
                            <div class="profile_author_name">
                                <p>{{ auth()->user()->nom_pnom() }}</p>
                                <h5 style="color:white !important;">Super Admin</h5>
                            </div>
                            <div class="profile_info_details">
                                <a href="{{ route('admin.user.show_profile') }}">Mon compte</a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Déconnexion </a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>