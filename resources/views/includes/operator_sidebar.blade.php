<div class="col-md-3 mb-3">
                <div class="Left_tabs_panel border">
                    <div class="profile_img">
                        <img src="{{asset('assets/images/user_img.jpg')}}" class="img-fluid" />
                        <h3>{{Auth::user()->email}} <span>Operator</span></h3>
                    </div>
                    <div class="tabs_menu">
                        <ul class="nav flex-column" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a href="{{url('operator/profile')}}" class="nav-link"><img src="{{asset('assets/images/change_profile_icon.png')}}" /> Change My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"><img src="{{asset('assets/images/create_mission_icon.png')}}" /> Create a Mission</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('operator/agents/pending')}}" class="nav-link"><img src="{{asset('assets/images/change_profile_icon.png')}}" /> Agents</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('operator/customers/pending')}}" class="nav-link"><img src="{{asset('assets/images/change_profile_icon.png')}}" /> Customers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"><img src="{{asset('assets/images/billing_icon.png')}}" /> Billing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('logout')}}"><img src="{{asset('assets/images/LogOut_icon.png')}}" /> Log Out</a>
                            </li>
                        </ul>
                    </div>
                    <div class="Quick_Order_Agent">
                        <a href="#">Quick Order My Agent</a>
                    </div>
                </div>
            </div>