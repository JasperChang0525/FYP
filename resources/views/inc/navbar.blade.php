<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <!-- Branding Image -->
                @if (Auth::guard('web')->check())
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Ez-Ronda2 UKM') }}
                    </a>
                @elseif(Auth::guard('admin')->check())
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    {{ config('app.name', 'Ez-Ronda2 UKM') }}
                </a>
                @endif

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::guard('admin')->check())
                    <li><a href="/zonlist">Create New Checkpoint</a></li>
                    <li><a href="/shift">Shift</a></li>
                    <li><a href="/admin/report">Report</a></li>
                    <li><a href="/posts">View Incident</a></li>
                    <li><a href="/alert">View SOS</a></li>


                    @elseif(Auth::guard('web')->check())
                    <li><a href="/posts/create">Create Incident</a></li>
                    <li><a href="/sos">SOS</a></li>
                    <li><a href="/shiftlist">Schedule</a></li>
                    
                    @endif
                   
                    
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guard('admin')->check())
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">                    
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @elseif(Auth::guard('web')->check())
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::guard('web')->user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">                    
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endif
                </ul>
            </div>
        </div>
    </nav> 