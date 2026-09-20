<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <button style="float: right; background: rgba(0, 0, 0, 0.308); padding: 5px 10px; font-size: 18px;" id="toggleSidebarButton" class="btn btn-primary d-lg-none">
        <i class="fas fa-bars"></i>
    </button>
    <div
        class="sidebar-brand-wrapper d-none d-lg-flex navbar-dark bg-light align-items-center justify-content-center fixed-top">
        <a  href="index.html"><img style="width:3.5cm; " src="{{ asset('home/images/logstt.png') }}" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="{{ asset('home/images/logstt.png') }}"
                alt="logo" /></a>

    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{{ asset('admin/assets/images/faces/face15.jpg') }}"
                            alt="">
                        <span class="count bg-success"></span>
                    </div>

                    <div class="profile-name">

                        <h5 style="color: black;" class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
                        @if (Auth::user()->usertype === '1')
                            <span>admin</span>
                        @elseif (Auth::user()->usertype === '2')
                            <span>cashier</span>
                        @endif

                    </div>
                </div>
                <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                    aria-labelledby="profile-dropdown">
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-onepassword  text-info"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-calendar-today text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                        </div>
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/redirect') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/show_product') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-package-variant-closed"></i>
                </span>
                <span class="menu-title">Products</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/show_transaction') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-home"></i> <!-- Replace "mdi-new-icon-class" with the class of your desired icon -->
                </span>
                <span class="menu-title">Transaction</span>
            </a>
        </li>

        {{-- <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                    <i class="mdi mdi-package-variant-closed"></i>
                </span>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/view_product') }}">Add Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/show_product') }}">Show Products</a>
                    </li>
                </ul>
            </div>
        </li> --}}

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('view_category') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-folder"></i>
                </span>
                <span class="menu-title">Category</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('order') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-cart"></i>
                </span>
                <span class="menu-title">Order</span>
            </a>
        </li>

        {{-- <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/delivered_orders') }}">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Delivered</span>
            </a>
          </li> --}}

        {{-- <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('delivered_order') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Delivered</span>
            </a>
        </li> --}}
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/customers') }}">
                <span class="menu-icon">
                    <i class="fas fa-user"></i> <!-- Replace with your desired icon class -->
                </span>
                <span class="menu-title">Show Customers</span>
            </a>
        </li>


        {{-- <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-icon">
                    <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Costumers</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('/add_customer') }}">Add customer</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('/customers') }}">Show customer</a></li>
                </ul>
            </div>
        </li> --}}



        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('pos') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">POS</span>
            </a>
        </li>
    </ul>
</nav>
<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('#sidebar');
        const isActive = sidebar.classList.contains('active');

        if (isActive) {
            sidebar.classList.remove('active');
        } else {
            sidebar.classList.add('active');
        }
    }

    const toggleSidebarButton = document.querySelector('#toggleSidebarButton');
    toggleSidebarButton.addEventListener('click', toggleSidebar);
</script>
