<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="#" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20"/>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
          <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#" class="collapsed">
                        <i class="fas fa-exchange-alt"></i>
                        <p>CASH Txrn</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#" class="collapsed">
                        <i class="fas fa-exchange-alt"></i>
                        <p>Bank Txrn</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#" class="collapsed">
                        <i class="fas fa-home"></i>
                        <p>Journal Entry</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#">
                        <i class="fas fa-pen-square"></i>
                        <p>Statement</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#reports">
                        <i class="fas fa-layer-group"></i>
                        <p>Reports</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="reports">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Day Book</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Cash Book</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Bank Book</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Balance Sheet</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Trial Balance</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Profit & Loss</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#setting">
                        <i class="fas fa-th-list"></i>
                        <p>Settings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="setting">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Head</span>
                                </a>
                            </li>
                            <li>
                                <a href="icon-menu.html">
                                    <span class="sub-item">Subhead</span>
                                </a>
                            </li>
                            <li>
                                <a href="icon-menu.html">
                                    <span class="sub-item">Account</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>