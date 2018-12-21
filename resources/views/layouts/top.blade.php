        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
				<style>
				span.systemlogo{
					font-color:#fff;
					font-family: "Open Sans", sans-serif;
					color:#fff;
					font-size:21px;
					font-weight:bold;
				}
				</style>
                <div class="page-logo">
					<a href="#" style="text-decoration:none"> 
					<span class="systemlogo logo-default">{{ config('app.name', 'Laravel') }}</span></span>
                    </a>
                    <div class="menu-toggler sidebar-toggler"> </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="{{ Auth::user()->getProfilePic() }}" />
                                <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="{{ url('/dashboard/profile/'.Auth::user()->getHashId()) }}">
                                        <i class="icon-user"></i> My Profile </a>
                                </li>
                                <li>
                                    <a href="{{ url('/dashboard/inbox') }}">
                                        <i class="icon-envelope-open"></i> My Inbox
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/dashboard/tasks') }}">
                                        <i class="icon-rocket"></i> My Tasks
                                    </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="{{ url('/logout') }}"><i class="icon-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->

