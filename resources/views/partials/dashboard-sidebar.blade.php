<div class="col-md-4">
            <div class="sidebar left">
                <div class="my-account-nav-container">
                    <ul class="my-account-nav">
                        <li class="sub-nav-title">Manage Listings</li>
                        <li><a href="{{ route('dashboard.properties') }}" class="{{ Route::is('dashboard.properties') ? 'current' : '' }}"><i class="sl sl-icon-docs"></i> My Properties</a></li>
                        <li><a href="{{ route('create') }}"><i class="sl sl-icon-action-redo"></i> Submit New Property</a></li>
                    </ul>
                    <ul class="my-account-nav">
                        <li class="sub-nav-title">Manage Account</li>
                        <li><a href="{{ route('profile') }}" class="{{ Route::is('profile') ? 'current' : '' }}"><i class="sl sl-icon-user"></i> My Profile</a></li>
                        <li>
                            <a class="navbar-item" href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                class="is-danger">
                                    <i class="sl sl-icon-power"></i>
                                    <span>Log out</span>
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="is-hidden">
                                    {{ csrf_field() }}
                                </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>