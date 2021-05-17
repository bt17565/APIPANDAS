
<!-- Layout navigation-->
<div id="layoutDrawer_nav">
    <!-- Drawer navigation-->
    <nav class="drawer accordion drawer-light bg-white" id="drawerAccordion">
        <div class="drawer-menu">
            <div class="nav">
                <!-- Drawer section heading (Account)-->
                <div class="drawer-menu-heading d-sm-none">Account</div>
                <!-- Drawer link (Notifications)-->
                <a class="nav-link d-sm-none" href="#!">
                    <div class="nav-link-icon"><i class="material-icons">notifications</i></div>
                    Notifications
                </a>
                <!-- Drawer link (Messages)-->
                <a class="nav-link d-sm-none" href="#!">
                    <div class="nav-link-icon"><i class="material-icons">mail</i></div>
                    Messages
                </a>
                <!-- Divider-->
                <div class="drawer-menu-divider d-sm-none"></div>
                <!-- Drawer section heading (Interface)-->
                <div class="drawer-menu-heading">Interface</div>
                <!-- Drawer link (Overview)-->

                <a class="nav-link @if(request()->routeIs('dashboard')){{' active'}}@endif" href="{{ route('dashboard') }}" >
                    <div class="nav-link-icon"><i class="material-icons">language</i></div>
                    Dashboard
                </a>
                <a class="nav-link @if(request()->routeIs('bundlers*')){{' active'}}@endif" href="{{ route('bundlers.index') }}">
                    <div class="nav-link-icon"><i class="material-icons">view_compact</i></div>
                    Bundlers
                </a>
                <!-- Divider-->
                <div class="drawer-menu-divider"></div>
                <!-- Drawer section heading (Plugins)-->
                <div class="drawer-menu-heading">My Account</div>
                <!-- Drawer link (Charts)-->
                <a class="nav-link @if(request()->routeIs('profile*')){{' active'}}@endif" href="{{ route('profile.show') }}">
                    <div class="nav-link-icon"><i class="material-icons">person</i></div>
                    Profile
                </a>
                <!-- Drawer link (Code Blocks)-->
                <a class="nav-link @if(request()->routeIs('api-tokens*')){{' active'}}@endif" href="{{ route('api-tokens.index') }}">
                    <div class="nav-link-icon"><i class="material-icons">settings</i></div>
                    API Tokens
                </a>
                <!-- Drawer link (Data Tables)-->
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">            
                    <div class="nav-link-icon"><i class="material-icons">logout</i></div>
                    Logout
                </a>
                <form method="POST" id="logout-form" action="{{ route('logout') }}">
                    @csrf
                </form>
            </div>
        </div>
        <!-- Drawer footer        -->
        <div class="drawer-footer border-top">
            <div class="d-flex align-items-center">
                <i class="material-icons text-muted">account_circle</i>
                <div class="ms-3">
                    <div class="caption">Logged in as:</div>
                    <div class="small fw-500">{{ Auth::user()->name }}</div>
                </div>
            </div>
        </div>
    </nav>
</div>
