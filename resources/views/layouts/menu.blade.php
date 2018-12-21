            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler"> </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>

						
                        <li class="nav-item start {{ Request::is('dashboard') ? 'active' : ''}}">
                            <a href="{{ url('/dashboard') }}" class="nav-link">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
						
						<!-- 
                        <li class="nav-item {{ Request::is('dashboard/api') ? 'active' : ''}}">
                            <a href="{{ url('/dashboard/api') }}" class="nav-link">
                                <i class="fa fa-tasks"></i>
                                <span class="title">My API</span>
								<span class="{{ Request::is('dashboard/api') ? 'selected' : ''}}"></span>
                            </a>
                        </li>	

                        <li class="nav-item {{ Request::is('dashboard/help') ? 'active' : ''}}">
                            <a href="{{ url('/dashboard/help') }}" class="nav-link">
                                <i class="fa fa-tasks"></i>
                                <span class="title">Help</span>
								<span class="{{ Request::is('dashboard/help') ? 'selected' : ''}}"></span>
                            </a>
                        </li>
        -->					

                        <li class="nav-item {{ Request::is('dashboard/blog/index') ? 'active' : ''}}">
                            <a href="{{ route('dashboard.blog.index') }}" class="nav-link">
                                <i class="fa fa-book"></i>
                                <span class="title">Blog</span>
								<span class="{{ Request::is('dashboard/blog/index') ? 'selected' : ''}}"></span>
                            </a>
                        </li>

                        <li class="nav-item {{ Request::is('dashboard/category') ? 'active' : ''}}">
                            <a href="{{ route('dashboard.category') }}" class="nav-link">
                                <i class="fa fa-folder"></i>
                                <span class="title">Category</span>
								<span class="{{ Request::is('dashboard/category') ? 'selected' : ''}}"></span>
                            </a>
                        </li>

                        <li class="nav-item {{ Request::is('tags/category') ? 'active' : ''}}">
                            <a href="{{ route('dashboard.tags') }}" class="nav-link">
                                <i class="fa fa-tag"></i>
                                <span class="title">Tags</span>
								<span class="{{ Request::is('dashboard/tags') ? 'selected' : ''}}"></span>
                            </a>
                        </li>                        

                        <li class="nav-item {{ Request::is('dashboard/documents') ? 'active' : ''}}">
                            <a href="{{ route('dashboard.documents') }}" class="nav-link">
                                <i class="fa fa-image"></i>
                                <span class="title">Resources</span>
								<span class="{{ Request::is('dashboard/documents') ? 'selected' : ''}}"></span>
                            </a>
                        </li>

						@if(Auth::user()->withRole(["super_admin"]))
						
						
                        <li class="nav-item {{ Request::is('dashboard/routes') ? 'active' : ''}}">
                            <a href="{{ url('/dashboard/routes') }}" class="nav-link">
                                <i class="fa fa-database"></i>
                                <span class="title">Route Path </span>
								<span class="{{ Request::is('dashboard/routes') ? 'selected' : ''}}"></span>
                            </a>
                        </li>						
						
                        <li class="nav-item {{ Request::is('dashboard/users') ? 'active' : ''}}">
                            <a href="{{ url('/dashboard/users') }}" class="nav-link">
                                <i class="fa fa-group"></i>
                                <span class="title">Users </span>
								<span class="{{ Request::is('dashboard/users') ? 'selected' : ''}}"></span>
                            </a>
                        </li>
						
                        <li class="nav-item {{ Request::is('dashboard/settings/*') ? 'active open' : ''}}">
						    <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-cogs"></i>
                                <span class="title">Settings</span>
								<span class="{{ Request::is('dashboard/settings/*') ? 'selected' : ''}}"></span>
                                <span class="arrow {{ Request::is('dashboard/settings/*') ? 'open' : ''}}"></span>
                            </a>
                            <ul class="sub-menu">
							
							
							
                                <li class="nav-item {{ Request::is('dashboard/settings/roles') ? 'active' : ''}}">
                                    <a href="{{ url('/dashboard/settings/roles') }}" class="nav-link ">
										<i class="fa fa-tasks"></i>
                                        <span class="title">Roles</span>
                                    </a>
                                </li>
                                <li class="nav-item  {{ Request::is('dashboard/settings/permission') ? 'active' : ''}}">
                                    <a href="{{ url('/dashboard/settings/permission') }}" class="nav-link ">
									<i class="fa fa-unlock-alt"></i>
                                        <span class="title">Permissions</span>
                                    </a>
                                </li>

								@if(Auth::user()->withRole("super_admin"))								
                                <li class="nav-item  {{ Request::is('dashboard/settings/configuration') ? 'active' : ''}}">
                                    <a href="{{ url('/dashboard/settings/configuration') }}" class="nav-link ">
									<i class="fa fa-gear"></i>
                                        <span class="title">System Configurations</span>
                                    </a>
                                </li>								
								@endif
                            </ul>
                        </li>						
						@endif

                        <li class="nav-item start ">
                            <a href="{{ url('/logout') }}" class="nav-link">
                                <i class="fa fa-sign-out"></i>
                                <span class="title">Logout</span>
                            </a>
                        </li>

                    </ul>
					<form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->

