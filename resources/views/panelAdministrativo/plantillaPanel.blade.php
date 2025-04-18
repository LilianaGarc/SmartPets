<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body data-sidebar="colored" class="">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">



    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-dark.png" alt="logo-sm-dark" height="24">
                                </span>
                        <span class="logo-lg">
                                    <img src="assets/images/logo-sm-dark.png" alt="logo-dark" height="25">
                                </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-light.png" alt="logo-sm-light" height="24">
                                </span>
                        <span class="logo-lg">
                                    <img src="assets/images/logo-sm-light.png" alt="logo-light" height="25">
                                </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn" id="vertical-menu-btn">
                    <i class="ri-menu-2-line align-middle"></i>
                </button>

                <!-- start page title -->
                <div class="page-title-box align-self-center d-none d-md-block">
                    <h4 class="page-title mb-0">Dashboard</h4>
                </div>
                <!-- end page title -->
            </div>

            <div class="d-flex">

                <!-- App Search-->
                <form class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="ri-search-line"></span>
                    </div>
                </form>

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-search-line"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="mb-3 m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dropdown d-none d-sm-inline-block">
                    <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="" src="assets/images/flags/us.jpg" alt="Header Language" height="16">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <img src="assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <img src="assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <img src="assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <img src="assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                        </a>
                    </div>
                </div>

                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-apps-2-line"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <div class="px-lg-2">
                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="assets/images/brands/github.png" alt="Github">
                                        <span>GitHub</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="assets/images/brands/bitbucket.png" alt="bitbucket">
                                        <span>Bitbucket</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="assets/images/brands/dribbble.png" alt="dribbble">
                                        <span>Dribbble</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="assets/images/brands/dropbox.png" alt="dropbox">
                                        <span>Dropbox</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                        <span>Mail Chimp</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="assets/images/brands/slack.png" alt="slack">
                                        <span>Slack</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="ri-fullscreen-line"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-notification-3-line"></i>
                        <span class="noti-dot"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="small"> View All</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar="init" style="max-height: 230px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">
                                                <a href="" class="text-reset notification-item">
                                                    <div class="d-flex">
                                                        <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="ri-shopping-cart-line"></i>
                                                </span>
                                                        </div>
                                                        <div class="flex-1">
                                                            <h6 class="mb-1">Your order is placed</h6>
                                                            <div class="font-size-12 text-muted">
                                                                <p class="mb-1">If several languages coalesce the grammar</p>
                                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="" class="text-reset notification-item">
                                                    <div class="d-flex">
                                                        <img src="assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                        <div class="flex-1">
                                                            <h6 class="mb-1">James Lemire</h6>
                                                            <div class="font-size-12 text-muted">
                                                                <p class="mb-1">It will seem like simplified English.</p>
                                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="" class="text-reset notification-item">
                                                    <div class="d-flex">
                                                        <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="ri-checkbox-circle-line"></i>
                                                </span>
                                                        </div>
                                                        <div class="flex-1">
                                                            <h6 class="mb-1">Your item is shipped</h6>
                                                            <div class="font-size-12 text-muted">
                                                                <p class="mb-1">If several languages coalesce the grammar</p>
                                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="" class="text-reset notification-item">
                                                    <div class="d-flex">
                                                        <img src="assets/images/users/avatar-4.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                        <div class="flex-1">
                                                            <h6 class="mb-1">Salena Layfield</h6>
                                                            <div class="font-size-12 text-muted">
                                                                <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div></div>
                        <div class="p-2 border-top">
                            <div class="d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="ri-settings-2-line"></i>
                    </button>
                </div>

            </div>
        </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu mm-active">

        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm-dark.png" alt="logo-sm-dark" height="24">
                        </span>
                <span class="logo-lg">
                            <img src="assets/images/logo-dark.png" alt="logo-dark" height="22">
                        </span>
            </a>

            <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm-light.png" alt="logo-sm-light" height="24">
                        </span>
                <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="logo-light" height="22">
                        </span>
            </a>
        </div>

        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn" id="vertical-menu-btn">
            <i class="ri-menu-2-line align-middle"></i>
        </button>

        <div data-simplebar="init" class="vertical-scroll mm-show simplebar-scrollable-y"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">

                                <!--- Sidemenu -->
                                <div id="sidebar-menu" class="mm-active">

                                    <div class="dropdown mx-3 sidebar-user user-dropdown select-dropdown mm-active">
                                        <button type="button" class="btn btn-light w-100 waves-effect waves-light border-0" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs rounded-circle flex-shrink-0">
                                            <div class="avatar-title border bg-light text-primary rounded-circle text-uppercase user-sort-name">R</div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-2 text-start">
                                        <h6 class="mb-1 fw-medium user-name-text"> Reporting </h6>
                                        <p class="font-size-13 text-muted user-name-sub-text mb-0"> Team Reporting </p>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <i class="mdi mdi-chevron-down font-size-16"></i>
                                    </div>
                                </span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end w-100">
                                            <!-- item-->
                                            <a class="dropdown-item d-flex align-items-center px-3" href="#">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar-xs rounded-circle flex-shrink-0">
                                                        <div class="avatar-title border rounded-circle text-uppercase dropdown-sort-name">C</div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 dropdown-name">CRM</h6>
                                                    <p class="text-muted font-size-13 mb-0 dropdown-sub-desc">Designer Team</p>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center px-3" href="#">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar-xs rounded-circle flex-shrink-0">
                                                        <div class="avatar-title border rounded-circle text-uppercase dropdown-sort-name">A</div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 dropdown-name">Application Design</h6>
                                                    <p class="text-muted font-size-13 mb-0 dropdown-sub-desc">Flutter Devs</p>
                                                </div>
                                            </a>

                                            <a class="dropdown-item d-flex align-items-center px-3" href="#">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar-xs rounded-circle flex-shrink-0">
                                                        <div class="avatar-title border rounded-circle text-uppercase dropdown-sort-name">E</div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 dropdown-name">Ecommerce</h6>
                                                    <p class="text-muted font-size-13 mb-0 dropdown-sub-desc">Developer Team</p>
                                                </div>
                                            </a>

                                            <a class="dropdown-item d-flex align-items-center px-3" href="#">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar-xs rounded-circle flex-shrink-0">
                                                        <div class="avatar-title border rounded-circle text-uppercase dropdown-sort-name">R</div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 dropdown-name">Reporting</h6>
                                                    <p class="text-muted font-size-13 mb-0 dropdown-sub-desc">Team Reporting</p>
                                                </div>
                                            </a>

                                            <a class="btn btn-sm btn-link font-size-14 text-center w-100" href="javascript:void(0)">
                                                View More..
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Left Menu Start -->
                                    <ul class="metismenu list-unstyled mm-show" id="side-menu">
                                        <li class="menu-title">Menu</li>

                                        <li class="mm-active">
                                            <a href="index.html" class="waves-effect active">
                                                <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><rect width="20" height="15" x="2" y="3" class="uim-tertiary" rx="3"></rect><path class="uim-primary" d="M16,21H8a.99992.99992,0,0,1-.832-1.55469l4-6a1.03785,1.03785,0,0,1,1.66406,0l4,6A.99992.99992,0,0,1,16,21Z"></path></svg></span><span class="badge rounded-pill bg-success float-end">3</span>
                                                <span>Dashboard</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-primary" d="M17,13H7a1,1,0,0,1,0-2H17a1,1,0,0,1,0,2Z"></path><path class="uim-tertiary" d="M12,2A10.00082,10.00082,0,0,0,4.25684,18.3291L2.293,20.293A.99991.99991,0,0,0,3,22h9A10,10,0,0,0,12,2ZM9,7h6a1,1,0,0,1,0,2H9A1,1,0,0,1,9,7Zm6,10H9a1,1,0,0,1,0-2h6a1,1,0,0,1,0,2Zm2-4H7a1,1,0,0,1,0-2H17a1,1,0,0,1,0,2Z"></path><path class="uim-primary" d="M15 17H9a1 1 0 0 1 0-2h6a1 1 0 0 1 0 2zM15 9H9A1 1 0 0 1 9 7h6a1 1 0 0 1 0 2z"></path></svg></span>
                                                <span>Apps</span>
                                            </a>
                                            <ul class="sub-menu mm-collapse" aria-expanded="true">
                                                <li>
                                                    <a href="javascript: void(0);" class="has-arrow">Email</a>
                                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                                        <li><a href="email-inbox.html">Inbox</a></li>
                                                        <li><a href="email-read.html">Read Email</a></li>
                                                    </ul>
                                                </li>

                                                <li><a href="calendar.html">Calendar</a></li>

                                                <li><a href="apps-chat.html">Chat</a></li>

                                                <li><a href="apps-file-manager.html">File Manager</a></li>


                                                <li>
                                                    <a href="javascript: void(0);" class="has-arrow">Invoice</a>
                                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                                        <li><a href="invoices.html">Invoices</a></li>
                                                        <li><a href="invoice-detail.html">Invoice Detail</a></li>
                                                    </ul>
                                                </li>

                                                <li>
                                                    <a href="javascript: void(0);" class="has-arrow">Users</a>
                                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                                        <li><a href="users-list.html">Users List</a></li>
                                                        <li><a href="users-detail.html">Users Detail</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>


                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><polygon class="uim-quaternary" points="22 11 10 11 10 2 8 2 8 11 8 11 8 13 8 13 8 22 10 22 10 13 22 13 22 11"></polygon><path class="uim-primary" d="M3,2H8A0,0,0,0,1,8,2V22a0,0,0,0,1,0,0H3a1,1,0,0,1-1-1V3A1,1,0,0,1,3,2Z"></path><path class="uim-tertiary" d="M10 2H21a1 1 0 0 1 1 1v8a0 0 0 0 1 0 0H10a0 0 0 0 1 0 0V2A0 0 0 0 1 10 2zM10 13H22a0 0 0 0 1 0 0v8a1 1 0 0 1-1 1H10a0 0 0 0 1 0 0V13A0 0 0 0 1 10 13z"></path></svg></span>
                                                <span>Layouts</span>
                                            </a>
                                            <ul class="sub-menu mm-collapse" aria-expanded="true">
                                                <li>
                                                    <a href="javascript: void(0);" class="has-arrow">Vertical</a>
                                                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                                                        <li><a href="layouts-dark-sidebar.html">Dark Sidebar</a></li>
                                                        <li><a href="layouts-light-sidebar.html">Light Sidebar</a></li>
                                                        <li><a href="layouts-compact-sidebar.html">Compact Sidebar</a></li>
                                                        <li><a href="layouts-icon-sidebar.html">Icon Sidebar</a></li>
                                                        <li><a href="layouts-boxed.html">Boxed Layout</a></li>
                                                        <li><a href="layouts-preloader.html">Preloader</a></li>
                                                    </ul>
                                                </li>

                                                <li>
                                                    <a href="javascript: void(0);" class="has-arrow">Horizontal</a>
                                                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                                                        <li><a href="layouts-horizontal.html">Horizontal</a></li>
                                                        <li><a href="layouts-hori-light-header.html">Light Header</a></li>
                                                        <li><a href="layouts-hori-topbar-dark.html">Topbar Dark</a></li>
                                                        <li><a href="layouts-hori-boxed-width.html">Boxed width</a></li>
                                                        <li><a href="layouts-hori-preloader.html">Preloader</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="menu-title">Pages</li>

                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-primary" d="M21,12c0-.34-.02-.67-.05-1H12.5V9.5a.99991.99991,0,0,0-1.707-.707l-2.5,2.5a.99962.99962,0,0,0,0,1.41406l2.5,2.5A.99991.99991,0,0,0,12.5,14.5V13h8.45C20.98,12.67,21,12.34,21,12Z"></path><path class="uim-tertiary" d="M12.5,13v1.5a.99989.99989,0,0,1-1.707.707l-2.5-2.5a.99962.99962,0,0,1,0-1.41406l2.5-2.5A.99991.99991,0,0,1,12.5,9.5V11h8.44952a10,10,0,1,0,0,2Z"></path></svg></span>
                                                <span>Authentication</span>
                                            </a>
                                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                                <li><a href="auth-login.html">Login</a></li>
                                                <li><a href="auth-register.html">Register</a></li>
                                                <li><a href="auth-recoverpw.html">Recover Password</a></li>
                                                <li><a href="auth-lock-screen.html">Lock Screen</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-quaternary" d="M20.23,7.24,12,12,3.77,7.24A1.98084,1.98084,0,0,1,4.47,6.53L11,2.76a2.03581,2.03581,0,0,1,2,0l6.53,3.77A1.98084,1.98084,0,0,1,20.23,7.24Z"></path><path class="uim-tertiary" d="M12,12v9.5a2.08912,2.08912,0,0,1-.91-.21L4.5,17.48a2.003,2.003,0,0,1-1-1.73V8.25a2.06026,2.06026,0,0,1,.27-1.01Z"></path><path class="uim-primary" d="M20.5,8.25v7.5a2.003,2.003,0,0,1-1,1.73L12.88,21.3a2.0937,2.0937,0,0,1-.88.2V12l8.23-4.76A2.06026,2.06026,0,0,1,20.5,8.25Z"></path></svg></span>
                                                <span>Extra Pages</span>
                                            </a>
                                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                                <li><a href="pages-starter.html">Starter Page</a></li>
                                                <li><a href="pages-maintenance.html">Maintenance</a></li>
                                                <li><a href="pages-comingsoon.html">Coming Soon</a></li>
                                                <li><a href="pages-404.html">Error 404</a></li>
                                                <li><a href="pages-500.html">Error 500</a></li>
                                                <li><a href="pages-faq.html">(Help Center) FAQ</a></li>
                                                <li><a href="pages-profile.html">Profile</a></li>
                                                <li><a href="pages-pricing.html">Pricing</a></li>
                                                <li><a href="pages-terms-conditions.html">Terms &amp; Conditions</a></li>
                                            </ul>
                                        </li>

                                        <li class="menu-title">Components</li>

                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-quaternary" d="M12,14.19531a1.00211,1.00211,0,0,1-.5-.13379l-9-5.19726a1.00032,1.00032,0,0,1,0-1.73242l9-5.19336a1.00435,1.00435,0,0,1,1,0l9,5.19336a1.00032,1.00032,0,0,1,0,1.73242l-9,5.19726A1.00211,1.00211,0,0,1,12,14.19531Z"></path><path class="uim-tertiary" d="M21.5,11.13184,19.53589,9.99847,12.5,14.06152a1.0012,1.0012,0,0,1-1,0L4.46411,9.99847,2.5,11.13184a1.00032,1.00032,0,0,0,0,1.73242l9,5.19726a1.0012,1.0012,0,0,0,1,0l9-5.19726a1.00032,1.00032,0,0,0,0-1.73242Z"></path><path class="uim-primary" d="M21.5,15.13184l-1.96411-1.13337L12.5,18.06152a1.0012,1.0012,0,0,1-1,0L4.46411,13.99847,2.5,15.13184a1.00032,1.00032,0,0,0,0,1.73242l9,5.19726a1.0012,1.0012,0,0,0,1,0l9-5.19726a1.00032,1.00032,0,0,0,0-1.73242Z"></path></svg></span>
                                                <span>UI Elements</span>
                                            </a>
                                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                                <li><a href="ui-alerts.html">Alerts</a></li>
                                                <li><a href="ui-buttons.html">Buttons</a></li>
                                                <li><a href="ui-cards.html">Cards</a></li>
                                                <li><a href="ui-carousel.html">Carousel</a></li>
                                                <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                                                <li><a href="ui-grid.html">Grid</a></li>
                                                <li><a href="ui-images.html">Images</a></li>
                                                <li><a href="ui-lightbox.html">Lightbox</a></li>
                                                <li><a href="ui-modals.html">Modals</a></li>
                                                <li><a href="ui-offcanvas.html">Offcavas</a></li>
                                                <li><a href="ui-rangeslider.html">Range Slider</a></li>
                                                <li><a href="ui-roundslider.html">Round Slider</a></li>
                                                <li><a href="ui-session-timeout.html">Session Timeout</a></li>
                                                <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                                <li><a href="ui-sweet-alert.html">Sweetalert 2</a></li>
                                                <li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a></li>
                                                <li><a href="ui-typography.html">Typography</a></li>
                                                <li><a href="ui-video.html">Video</a></li>
                                                <li><a href="ui-general.html">General</a></li>
                                                <li><a href="ui-rating.html">Rating</a></li>
                                                <li><a href="ui-notifications.html">Notifications</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);" class="waves-effect">
                                                <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-tertiary" d="M21 8H13a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2zM21 12H13a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2z"></path><rect width="8" height="8" x="2" y="4" class="uim-primary" rx="1"></rect><path class="uim-tertiary" d="M21 16H3a1 1 0 0 1 0-2H21a1 1 0 0 1 0 2zM13 20H3a1 1 0 0 1 0-2H13a1 1 0 0 1 0 2z"></path></svg></span>
                                                <span class="badge rounded-pill bg-danger float-end">6</span>
                                                <span>Forms</span>
                                            </a>
                                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                                <li><a href="form-elements.html">Basic Elements</a></li>
                                                <li><a href="form-validation.html">Validation</a></li>
                                                <li><a href="form-plugins.html">Plugins</a></li>
                                                <li><a href="form-editors.html">Editors</a></li>
                                                <li><a href="form-uploads.html">File Upload</a></li>
                                                <li><a href="form-wizard.html">Wizard</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-primary" d="M21,22H3a.99974.99974,0,0,1-1-1V3A.99974.99974,0,0,1,3,2H21a.99974.99974,0,0,1,1,1V21A.99974.99974,0,0,1,21,22ZM4,20H20V4H4Z"></path><path class="uim-primary" d="M9 22a.99974.99974 0 0 1-1-1V3a1 1 0 0 1 2 0V21A.99974.99974 0 0 1 9 22zM15 22a.99974.99974 0 0 1-1-1V3a1 1 0 0 1 2 0V21A.99974.99974 0 0 1 15 22z"></path><path class="uim-primary" d="M21 10H3A1 1 0 0 1 3 8H21a1 1 0 0 1 0 2zM21 16H3a1 1 0 0 1 0-2H21a1 1 0 0 1 0 2z"></path></svg></span>
                                                <span>Tables</span>
                                            </a>
                                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                                <li><a href="tables-bootstrap.html">Bootstrap Tables</a></li>
                                                <li><a href="tables-datatable.html">Data Tables</a></li>
                                                <li><a href="tables-editable.html">Editable Table</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-quaternary" d="M12,12V2A10,10,0,0,1,22,12Z"></path><path class="uim-tertiary" d="M12,12l5,8.66022A10.01081,10.01081,0,0,0,22,12Z"></path><path class="uim-primary" d="M17,20.66022,12,12V2a10,10,0,1,0,5.00085,18.66168l.00336-.00427Z"></path></svg></span>
                                                <span>Charts</span>
                                            </a>
                                            <ul class="sub-menu mm-collapse" aria-expanded="true">
                                                <li><a href="javascript: void(0);" class="has-arrow">Apexcharts Part 1</a>
                                                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                                                        <li><a href="charts-line.html">Line</a></li>
                                                        <li><a href="charts-area.html">Area</a></li>
                                                        <li><a href="charts-column.html">Column</a></li>
                                                        <li><a href="charts-bar.html">Bar</a></li>
                                                        <li><a href="charts-mixed.html">Mixed</a></li>
                                                        <li><a href="charts-timeline.html">Timeline</a></li>
                                                        <li><a href="charts-candlestick.html">Candlestick</a></li>
                                                        <li><a href="charts-boxplot.html">Boxplot</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="javascript: void(0);" class="has-arrow">Apexcharts Part 2</a>
                                                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                                                        <li><a href="charts-bubble.html">Bubble</a></li>
                                                        <li><a href="charts-scatter.html">Scatter</a></li>
                                                        <li><a href="charts-heatmap.html">Heatmap</a></li>
                                                        <li><a href="charts-treemap.html">Treemap</a></li>
                                                        <li><a href="charts-pie.html">Pie</a></li>
                                                        <li><a href="charts-radialbar.html">Radialbar</a></li>
                                                        <li><a href="charts-radar.html">Radar</a></li>
                                                        <li><a href="charts-polararea.html">Polararea</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="charts-echart.html">E Charts</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-tertiary" d="M4 16a2 2 0 1 1 2-2A2.0026 2.0026 0 0 1 4 16zm0-2.002v0zM4 6A2 2 0 1 1 6 4 2.0026 2.0026 0 0 1 4 6zM4 3.99805v0zM14 6a2 2 0 1 1 2-2A2.0026 2.0026 0 0 1 14 6zm0-2.00195v0zM14 16a2 2 0 1 1 2-2A2.0026 2.0026 0 0 1 14 16zm0-2.002v0z"></path><path class="uim-primary" d="M10 22a2 2 0 1 1 2-2A2.0026 2.0026 0 0 1 10 22zm0-2.002v0zM10 12a2 2 0 1 1 2-2A2.0026 2.0026 0 0 1 10 12zm0-2.002v0zM20 12a2 2 0 1 1 2-2A2.0026 2.0026 0 0 1 20 12zm0-2.002v0zM20 22a2 2 0 1 1 2-2A2.0026 2.0026 0 0 1 20 22zm0-2.002v0z"></path><path class="uim-quaternary" d="M12.27832 5a1.93565 1.93565 0 0 1 0-2H5.72168a1.93565 1.93565 0 0 1 0 2zM4 12a1.97629 1.97629 0 0 1 1 .27832V5.72168a1.93565 1.93565 0 0 1-2 0v6.55664A1.97629 1.97629 0 0 1 4 12z"></path><path class="uim-tertiary" d="M20 18a1.97629 1.97629 0 0 1 1 .27832V11.72168a1.93565 1.93565 0 0 1-2 0v6.55664A1.97629 1.97629 0 0 1 20 18zM10 18a1.97629 1.97629 0 0 1 1 .27832V11.72168a1.93565 1.93565 0 0 1-2 0v6.55664A1.97629 1.97629 0 0 1 10 18z"></path><path class="uim-quaternary" d="M12.27832 13H11v2h1.27832a1.93565 1.93565 0 0 1 0-2zM9 15V13H5.72168a1.93565 1.93565 0 0 1 0 2z"></path><path class="uim-tertiary" d="M18.27832 19H11.72168a1.93565 1.93565 0 0 1 0 2h6.55664a1.93565 1.93565 0 0 1 0-2zM18.27832 11a1.93565 1.93565 0 0 1 0-2H11.72168a1.93565 1.93565 0 0 1 0 2z"></path><path class="uim-quaternary" d="M15 9V5.72168a1.93565 1.93565 0 0 1-2 0V9zM13 11v1.27832a1.93565 1.93565 0 0 1 2 0V11z"></path></svg></span>
                                                <span>Icons</span>
                                            </a>
                                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                                <li><a href="icons-remix.html">Remix Icons</a></li>
                                                <li><a href="icons-materialdesign.html">Material Design</a></li>
                                                <li><a href="icons-unicons.html">Unicons</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-primary" d="M15,11H13V9a1,1,0,0,0-2,0v2H9a1,1,0,0,0,0,2h2v2a1,1,0,0,0,2,0V13h2a1,1,0,0,0,0-2Z"></path><path class="uim-tertiary" d="M12,2A10.00082,10.00082,0,0,0,4.25684,18.3291L2.293,20.293A.99991.99991,0,0,0,3,22h9A10,10,0,0,0,12,2Zm3,11H13v2a1,1,0,0,1-2,0V13H9a1,1,0,0,1,0-2h2V9a1,1,0,0,1,2,0v2h2a1,1,0,0,1,0,2Z"></path></svg></span>
                                                <span>Maps</span>
                                            </a>
                                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                                <li><a href="maps-google.html">Google Maps</a></li>
                                                <li><a href="maps-vector.html">Vector Maps</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-quaternary" d="M21,2H9A.99943.99943,0,0,0,8,3V7h8a.99943.99943,0,0,1,1,1v8h4a.99943.99943,0,0,0,1-1V3A.99943.99943,0,0,0,21,2Z"></path><rect width="10" height="10" x="2" y="12" class="uim-primary" rx="1"></rect><path class="uim-tertiary" d="M16,7H6A.99943.99943,0,0,0,5,8v4h6a.99943.99943,0,0,1,1,1v6h4a.99943.99943,0,0,0,1-1V8A.99943.99943,0,0,0,16,7Z"></path></svg></span>
                                                <span>Multi Level</span>
                                            </a>
                                            <ul class="sub-menu mm-collapse" aria-expanded="true">
                                                <li><a href="javascript: void(0);">Level 1.1</a></li>
                                                <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
                                                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                                                        <li><a href="javascript: void(0);">Level 2.1</a></li>
                                                        <li><a href="javascript: void(0);">Level 2.2</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>

                                    </ul>

                                </div>
                                <!-- Sidebar -->
                            </div></div></div></div><div class="simplebar-placeholder" style="width: 250px; height: 759px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 594px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>

        <div class="dropdown px-3 sidebar-user sidebar-user-info">
            <button type="button" class="btn w-100 px-0 border-0" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                    <img src="assets/images/users/avatar-2.jpg" class="img-fluid header-profile-user rounded-circle" alt="">
                            </div>

                            <div class="flex-grow-1 ms-2 text-start">
                                <span class="ms-1 fw-medium user-name-text">Steven Deese</span>
                            </div>

                            <div class="flex-shrink-0 text-end">
                                <i class="mdi mdi-dots-vertical font-size-16"></i>
                            </div>
                        </span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                <a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Messages</span></a>
                <a class="dropdown-item" href="pages-faq.html"><i class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-wallet text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$5971.67</b></span></a>
                <a class="dropdown-item" href="#"><span class="badge bg-primary mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a>
                <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a>
            </div>
        </div>

    </div>
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">



                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-md flex-shrink-0">
                                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-primary" d="M10,6V5h4V6h2V5a2.00229,2.00229,0,0,0-2-2H10A2.00229,2.00229,0,0,0,8,5V6Z"></path><path class="uim-quaternary" d="M9 15a.99974.99974 0 0 1-1-1V12a1 1 0 0 1 2 0v2A.99974.99974 0 0 1 9 15zM15 15a.99974.99974 0 0 1-1-1V12a1 1 0 0 1 2 0v2A.99974.99974 0 0 1 15 15z"></path><path class="uim-tertiary" d="M20,6H4A2,2,0,0,0,2,8v3a2,2,0,0,0,2,2H8V12a1,1,0,0,1,2,0v1h4V12a1,1,0,0,1,2,0v1h4a2,2,0,0,0,2-2V8A2,2,0,0,0,20,6Z"></path><path class="uim-primary" d="M20,13H16v1a1,1,0,0,1-2,0V13H10v1a1,1,0,0,1-2,0V13H4a2,2,0,0,1-2-2v8a2,2,0,0,0,2,2H20a2,2,0,0,0,2-2V11A2,2,0,0,1,20,13Z"></path></svg></span>
                                                </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-4">
                                        <p class="text-muted text-truncate font-size-15 mb-2"> Total Earnings</p>
                                        <h3 class="fs-4 flex-grow-1 mb-3">34,123.20 <span class="text-muted font-size-16">USD</span></h3>
                                        <p class="text-muted mb-0 text-truncate"><span class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i class="mdi mdi-arrow-top-right"></i> 2.8% Increase</span> vs last month</p>
                                    </div>
                                    <div class="flex-shrink-0 align-self-start">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle btn-icon border rounded-circle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-more-2-fill text-muted font-size-16"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Yearly</a>
                                                <a class="dropdown-item" href="#">Monthly</a>
                                                <a class="dropdown-item" href="#">Weekly</a>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-md flex-shrink-0">
                                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-quaternary" d="M12,14.19531a1.00211,1.00211,0,0,1-.5-.13379l-9-5.19726a1.00032,1.00032,0,0,1,0-1.73242l9-5.19336a1.00435,1.00435,0,0,1,1,0l9,5.19336a1.00032,1.00032,0,0,1,0,1.73242l-9,5.19726A1.00211,1.00211,0,0,1,12,14.19531Z"></path><path class="uim-tertiary" d="M21.5,11.13184,19.53589,9.99847,12.5,14.06152a1.0012,1.0012,0,0,1-1,0L4.46411,9.99847,2.5,11.13184a1.00032,1.00032,0,0,0,0,1.73242l9,5.19726a1.0012,1.0012,0,0,0,1,0l9-5.19726a1.00032,1.00032,0,0,0,0-1.73242Z"></path><path class="uim-primary" d="M21.5,15.13184l-1.96411-1.13337L12.5,18.06152a1.0012,1.0012,0,0,1-1,0L4.46411,13.99847,2.5,15.13184a1.00032,1.00032,0,0,0,0,1.73242l9,5.19726a1.0012,1.0012,0,0,0,1,0l9-5.19726a1.00032,1.00032,0,0,0,0-1.73242Z"></path></svg></span>
                                                </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-4">
                                        <p class="text-muted text-truncate font-size-15 mb-2"> Total Orders</p>
                                        <h3 class="fs-4 flex-grow-1 mb-3">63,234 <span class="text-muted font-size-16">NOU</span></h3>
                                        <p class="text-muted mb-0 text-truncate"><span class="badge bg-subtle-danger text-danger font-size-12 fw-normal me-1"><i class="mdi mdi-arrow-bottom-left"></i> 7.8% Loss</span> vs last month</p>
                                    </div>
                                    <div class="flex-shrink-0 align-self-start">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle btn-icon border rounded-circle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-more-2-fill text-muted font-size-16"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Yearly</a>
                                                <a class="dropdown-item" href="#">Monthly</a>
                                                <a class="dropdown-item" href="#">Weekly</a>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-md flex-shrink-0">
                                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-quinary" d="M13.5,9A1.5,1.5,0,1,1,15,7.5,1.50164,1.50164,0,0,1,13.5,9Z"></path><path class="uim-tertiary" d="M19,2H5A3.00879,3.00879,0,0,0,2,5v8.86L5.88,9.98a3.07531,3.07531,0,0,1,4.24,0l2.87139,2.887.88752-.88751a3.00846,3.00846,0,0,1,4.24218,0L22,15.8584V5A3.00879,3.00879,0,0,0,19,2ZM13.5,9A1.5,1.5,0,1,1,15,7.5,1.50164,1.50164,0,0,1,13.5,9Z"></path><path class="uim-primary" d="M10.12,9.98a3.07531,3.07531,0,0,0-4.24,0L2,13.86V19a3.00882,3.00882,0,0,0,3,3H19a2.9986,2.9986,0,0,0,2.16-.92Z"></path><path class="uim-quaternary" d="M22,15.8584l-3.87891-3.87891a3.00849,3.00849,0,0,0-4.24218,0l-.88752.88751,8.16425,8.20856A2.96485,2.96485,0,0,0,22,19Z"></path></svg></span>
                                                </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-4">
                                        <p class="text-muted text-truncate font-size-15 mb-2"> Today Visitor</p>
                                        <h3 class="fs-4 flex-grow-1 mb-3">425,34 <span class="text-muted font-size-16">NOU</span></h3>
                                        <p class="text-muted mb-0 text-truncate"><span class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i class="mdi mdi-arrow-top-right"></i> 4.6% Growth</span> vs last month</p>
                                    </div>
                                    <div class="flex-shrink-0 align-self-start">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle btn-icon border rounded-circle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-more-2-fill text-muted font-size-16"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Yearly</a>
                                                <a class="dropdown-item" href="#">Monthly</a>
                                                <a class="dropdown-item" href="#">Weekly</a>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-md flex-shrink-0">
                                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><rect width="20" height="15" x="2" y="3" class="uim-tertiary" rx="3"></rect><path class="uim-primary" d="M16,21H8a.99992.99992,0,0,1-.832-1.55469l4-6a1.03785,1.03785,0,0,1,1.66406,0l4,6A.99992.99992,0,0,1,16,21Z"></path></svg></span>
                                                </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-4">
                                        <p class="text-muted text-truncate font-size-15 mb-2"> Total Expense</p>
                                        <h3 class="fs-4 flex-grow-1 mb-3">26,482.46 <span class="text-muted font-size-16">USD</span></h3>
                                        <p class="text-muted mb-0 text-truncate"><span class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i class="mdi mdi-arrow-top-right"></i> 23% Increase</span> vs last month</p>
                                    </div>
                                    <div class="flex-shrink-0 align-self-start">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle btn-icon border rounded-circle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-more-2-fill text-muted font-size-16"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Yearly</a>
                                                <a class="dropdown-item" href="#">Monthly</a>
                                                <a class="dropdown-item" href="#">Weekly</a>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END ROW -->

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex pb-0">
                                <h4 class="card-title mb-0 flex-grow-1">Audiences Metrics</h4>
                                <div>
                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                        ALL
                                    </button>
                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                        1M
                                    </button>
                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                        6M
                                    </button>
                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                        1Y
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 audiences-border">
                                        <div id="column-chart" class="apex-charts" style="min-height: 365px;"><div id="apexchartssybu3sbv" class="apexcharts-canvas apexchartssybu3sbv apexcharts-theme-" style="width: 746px; height: 350px;"><svg id="SvgjsSvg1819" width="746" height="350" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"><foreignObject x="0" y="0" width="746" height="350"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 175px;"></div><style type="text/css">
                                                            .apexcharts-flip-y {
                                                                transform: scaleY(-1) translateY(-100%);
                                                                transform-origin: top;
                                                                transform-box: fill-box;
                                                            }
                                                            .apexcharts-flip-x {
                                                                transform: scaleX(-1);
                                                                transform-origin: center;
                                                                transform-box: fill-box;
                                                            }
                                                            .apexcharts-legend {
                                                                display: flex;
                                                                overflow: auto;
                                                                padding: 0 10px;
                                                            }
                                                            .apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
                                                                flex-wrap: wrap
                                                            }
                                                            .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
                                                                flex-direction: column;
                                                                bottom: 0;
                                                            }
                                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
                                                                justify-content: flex-start;
                                                            }
                                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                                                justify-content: center;
                                                            }
                                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                                                justify-content: flex-end;
                                                            }
                                                            .apexcharts-legend-series {
                                                                cursor: pointer;
                                                                line-height: normal;
                                                                display: flex;
                                                                align-items: center;
                                                            }
                                                            .apexcharts-legend-text {
                                                                position: relative;
                                                                font-size: 14px;
                                                            }
                                                            .apexcharts-legend-text *, .apexcharts-legend-marker * {
                                                                pointer-events: none;
                                                            }
                                                            .apexcharts-legend-marker {
                                                                position: relative;
                                                                display: flex;
                                                                align-items: center;
                                                                justify-content: center;
                                                                cursor: pointer;
                                                                margin-right: 1px;
                                                            }

                                                            .apexcharts-legend-series.apexcharts-no-click {
                                                                cursor: auto;
                                                            }
                                                            .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
                                                                display: none !important;
                                                            }
                                                            .apexcharts-inactive-legend {
                                                                opacity: 0.45;
                                                            }</style></foreignObject><g id="SvgjsG1832" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g><g id="SvgjsG1833" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g><g id="SvgjsG1955" class="apexcharts-yaxis" rel="0" transform="translate(10.5234375, 0)"><g id="SvgjsG1956" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1958" font-family="Helvetica, Arial, sans-serif" x="20" y="33.666666666666664" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1959">50</tspan><title>50</title></text><text id="SvgjsText1961" font-family="Helvetica, Arial, sans-serif" x="20" y="90.13626666666667" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1962">40</tspan><title>40</title></text><text id="SvgjsText1964" font-family="Helvetica, Arial, sans-serif" x="20" y="146.60586666666666" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1965">30</tspan><title>30</title></text><text id="SvgjsText1967" font-family="Helvetica, Arial, sans-serif" x="20" y="203.07546666666667" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1968">20</tspan><title>20</title></text><text id="SvgjsText1970" font-family="Helvetica, Arial, sans-serif" x="20" y="259.5450666666667" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1971">10</tspan><title>10</title></text><text id="SvgjsText1973" font-family="Helvetica, Arial, sans-serif" x="20" y="316.0146666666667" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1974">0</tspan><title>0</title></text></g></g><g id="SvgjsG1821" class="apexcharts-inner apexcharts-graphical" transform="translate(40.5234375, 30)"><defs id="SvgjsDefs1820"><linearGradient id="SvgjsLinearGradient1824" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1825" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop1826" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop1827" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient><clipPath id="gridRectMasksybu3sbv"><rect id="SvgjsRect1829" width="682.31640625" height="282.348" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectBarMasksybu3sbv"><rect id="SvgjsRect1830" width="686.31640625" height="286.348" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMasksybu3sbv"><rect id="SvgjsRect1831" width="682.31640625" height="282.348" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMasksybu3sbv"></clipPath><clipPath id="nonForecastMasksybu3sbv"></clipPath></defs><rect id="SvgjsRect1828" width="23.88107421875" height="282.348" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1824)" class="apexcharts-xcrosshairs" y2="282.348" filter="none" fill-opacity="0.9"></rect><line id="SvgjsLine1893" x1="0" y1="282.348" x2="0" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1894" x1="56.859700520833336" y1="282.348" x2="56.859700520833336" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1895" x1="113.71940104166667" y1="282.348" x2="113.71940104166667" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1896" x1="170.5791015625" y1="282.348" x2="170.5791015625" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1897" x1="227.43880208333334" y1="282.348" x2="227.43880208333334" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1898" x1="284.2985026041667" y1="282.348" x2="284.2985026041667" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1899" x1="341.158203125" y1="282.348" x2="341.158203125" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1900" x1="398.0179036458333" y1="282.348" x2="398.0179036458333" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1901" x1="454.87760416666663" y1="282.348" x2="454.87760416666663" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1902" x1="511.73730468749994" y1="282.348" x2="511.73730468749994" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1903" x1="568.5970052083333" y1="282.348" x2="568.5970052083333" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1904" x1="625.4567057291666" y1="282.348" x2="625.4567057291666" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1905" x1="682.31640625" y1="282.348" x2="682.31640625" y2="288.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><g id="SvgjsG1889" class="apexcharts-grid"><g id="SvgjsG1890" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine1907" x1="0" y1="56.4696" x2="682.31640625" y2="56.4696" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1908" x1="0" y1="112.9392" x2="682.31640625" y2="112.9392" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1909" x1="0" y1="169.40879999999999" x2="682.31640625" y2="169.40879999999999" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1910" x1="0" y1="225.8784" x2="682.31640625" y2="225.8784" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1891" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine1913" x1="0" y1="282.348" x2="682.31640625" y2="282.348" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1912" x1="0" y1="1" x2="0" y2="282.348" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1892" class="apexcharts-grid-borders"><line id="SvgjsLine1906" x1="0" y1="0" x2="682.31640625" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1911" x1="0" y1="282.348" x2="682.31640625" y2="282.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1954" x1="0" y1="282.348" x2="682.31640625" y2="282.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line></g><g id="SvgjsG1834" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1835" class="apexcharts-series" seriesName="NetxProfit" rel="1" data:realIndex="0"><path id="SvgjsPath1839" d="M 16.489313151041667 282.349 L 16.489313151041667 175.05676000000003 C 16.489313151041667 175.05676000000003 16.489313151041667 175.05676000000003 16.489313151041667 175.05676000000003 L 40.37038736979167 175.05676000000003 C 40.37038736979167 175.05676000000003 40.37038736979167 175.05676000000003 40.37038736979167 175.05676000000003 L 40.37038736979167 282.349 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="0" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 16.489313151041667 282.349 L 16.489313151041667 175.05676000000003 C 16.489313151041667 175.05676000000003 16.489313151041667 175.05676000000003 16.489313151041667 175.05676000000003 L 40.37038736979167 175.05676000000003 C 40.37038736979167 175.05676000000003 40.37038736979167 175.05676000000003 40.37038736979167 175.05676000000003 L 40.37038736979167 282.349 z " pathFrom="M 16.489313151041667 282.349 L 16.489313151041667 282.349 L 40.37038736979167 282.349 L 40.37038736979167 282.349 L 40.37038736979167 282.349 L 40.37038736979167 282.349 L 40.37038736979167 282.349 L 16.489313151041667 282.349 z" cy="175.05576000000002" cx="73.349013671875" j="0" val="19" barHeight="107.29224" barWidth="23.88107421875"></path><path id="SvgjsPath1841" d="M 73.349013671875 282.349 L 73.349013671875 79.05844000000002 C 73.349013671875 79.05844000000002 73.349013671875 79.05844000000002 73.349013671875 79.05844000000002 L 97.230087890625 79.05844000000002 C 97.230087890625 79.05844000000002 97.230087890625 79.05844000000002 97.230087890625 79.05844000000002 L 97.230087890625 282.349 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="0" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 73.349013671875 282.349 L 73.349013671875 79.05844000000002 C 73.349013671875 79.05844000000002 73.349013671875 79.05844000000002 73.349013671875 79.05844000000002 L 97.230087890625 79.05844000000002 C 97.230087890625 79.05844000000002 97.230087890625 79.05844000000002 97.230087890625 79.05844000000002 L 97.230087890625 282.349 z " pathFrom="M 73.349013671875 282.349 L 73.349013671875 282.349 L 97.230087890625 282.349 L 97.230087890625 282.349 L 97.230087890625 282.349 L 97.230087890625 282.349 L 97.230087890625 282.349 L 73.349013671875 282.349 z" cy="79.05744000000001" cx="130.20871419270833" j="1" val="36" barHeight="203.29056" barWidth="23.88107421875"></path><path id="SvgjsPath1843" d="M 130.20871419270833 282.349 L 130.20871419270833 146.82196000000002 C 130.20871419270833 146.82196000000002 130.20871419270833 146.82196000000002 130.20871419270833 146.82196000000002 L 154.08978841145833 146.82196000000002 C 154.08978841145833 146.82196000000002 154.08978841145833 146.82196000000002 154.08978841145833 146.82196000000002 L 154.08978841145833 282.349 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="0" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 130.20871419270833 282.349 L 130.20871419270833 146.82196000000002 C 130.20871419270833 146.82196000000002 130.20871419270833 146.82196000000002 130.20871419270833 146.82196000000002 L 154.08978841145833 146.82196000000002 C 154.08978841145833 146.82196000000002 154.08978841145833 146.82196000000002 154.08978841145833 146.82196000000002 L 154.08978841145833 282.349 z " pathFrom="M 130.20871419270833 282.349 L 130.20871419270833 282.349 L 154.08978841145833 282.349 L 154.08978841145833 282.349 L 154.08978841145833 282.349 L 154.08978841145833 282.349 L 154.08978841145833 282.349 L 130.20871419270833 282.349 z" cy="146.82096" cx="187.06841471354167" j="2" val="24" barHeight="135.52704" barWidth="23.88107421875"></path><path id="SvgjsPath1845" d="M 187.06841471354167 282.349 L 187.06841471354167 169.40980000000002 C 187.06841471354167 169.40980000000002 187.06841471354167 169.40980000000002 187.06841471354167 169.40980000000002 L 210.94948893229167 169.40980000000002 C 210.94948893229167 169.40980000000002 210.94948893229167 169.40980000000002 210.94948893229167 169.40980000000002 L 210.94948893229167 282.349 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="0" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 187.06841471354167 282.349 L 187.06841471354167 169.40980000000002 C 187.06841471354167 169.40980000000002 187.06841471354167 169.40980000000002 187.06841471354167 169.40980000000002 L 210.94948893229167 169.40980000000002 C 210.94948893229167 169.40980000000002 210.94948893229167 169.40980000000002 210.94948893229167 169.40980000000002 L 210.94948893229167 282.349 z " pathFrom="M 187.06841471354167 282.349 L 187.06841471354167 282.349 L 210.94948893229167 282.349 L 210.94948893229167 282.349 L 210.94948893229167 282.349 L 210.94948893229167 282.349 L 210.94948893229167 282.349 L 187.06841471354167 282.349 z" cy="169.4088" cx="243.928115234375" j="3" val="20" barHeight="112.9392" barWidth="23.88107421875"></path><path id="SvgjsPath1847" d="M 243.928115234375 282.349 L 243.928115234375 90.35236 C 243.928115234375 90.35236 243.928115234375 90.35236 243.928115234375 90.35236 L 267.809189453125 90.35236 C 267.809189453125 90.35236 267.809189453125 90.35236 267.809189453125 90.35236 L 267.809189453125 282.349 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="0" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 243.928115234375 282.349 L 243.928115234375 90.35236 C 243.928115234375 90.35236 243.928115234375 90.35236 243.928115234375 90.35236 L 267.809189453125 90.35236 C 267.809189453125 90.35236 267.809189453125 90.35236 267.809189453125 90.35236 L 267.809189453125 282.349 z " pathFrom="M 243.928115234375 282.349 L 243.928115234375 282.349 L 267.809189453125 282.349 L 267.809189453125 282.349 L 267.809189453125 282.349 L 267.809189453125 282.349 L 267.809189453125 282.349 L 243.928115234375 282.349 z" cy="90.35136" cx="300.7878157552083" j="4" val="34" barHeight="191.99664" barWidth="23.88107421875"></path><path id="SvgjsPath1849" d="M 300.7878157552083 282.349 L 300.7878157552083 146.82196000000002 C 300.7878157552083 146.82196000000002 300.7878157552083 146.82196000000002 300.7878157552083 146.82196000000002 L 324.66888997395836 146.82196000000002 C 324.66888997395836 146.82196000000002 324.66888997395836 146.82196000000002 324.66888997395836 146.82196000000002 L 324.66888997395836 282.349 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="0" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 300.7878157552083 282.349 L 300.7878157552083 146.82196000000002 C 300.7878157552083 146.82196000000002 300.7878157552083 146.82196000000002 300.7878157552083 146.82196000000002 L 324.66888997395836 146.82196000000002 C 324.66888997395836 146.82196000000002 324.66888997395836 146.82196000000002 324.66888997395836 146.82196000000002 L 324.66888997395836 282.349 z " pathFrom="M 300.7878157552083 282.349 L 300.7878157552083 282.349 L 324.66888997395836 282.349 L 324.66888997395836 282.349 L 324.66888997395836 282.349 L 324.66888997395836 282.349 L 324.66888997395836 282.349 L 300.7878157552083 282.349 z" cy="146.82096" cx="357.64751627604164" j="5" val="24" barHeight="135.52704" barWidth="23.88107421875"></path><path id="SvgjsPath1851" d="M 357.64751627604164 282.349 L 357.64751627604164 220.23244000000003 C 357.64751627604164 220.23244000000003 357.64751627604164 220.23244000000003 357.64751627604164 220.23244000000003 L 381.5285904947916 220.23244000000003 C 381.5285904947916 220.23244000000003 381.5285904947916 220.23244000000003 381.5285904947916 220.23244000000003 L 381.5285904947916 282.349 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="0" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 357.64751627604164 282.349 L 357.64751627604164 220.23244000000003 C 357.64751627604164 220.23244000000003 357.64751627604164 220.23244000000003 357.64751627604164 220.23244000000003 L 381.5285904947916 220.23244000000003 C 381.5285904947916 220.23244000000003 381.5285904947916 220.23244000000003 381.5285904947916 220.23244000000003 L 381.5285904947916 282.349 z " pathFrom="M 357.64751627604164 282.349 L 357.64751627604164 282.349 L 381.5285904947916 282.349 L 381.5285904947916 282.349 L 381.5285904947916 282.349 L 381.5285904947916 282.349 L 381.5285904947916 282.349 L 357.64751627604164 282.349 z" cy="220.23144000000002" cx="414.50721679687496" j="6" val="11" barHeight="62.11656" barWidth="23.88107421875"></path><path id="SvgjsPath1853" d="M 414.50721679687496 282.349 L 414.50721679687496 79.05844000000002 C 414.50721679687496 79.05844000000002 414.50721679687496 79.05844000000002 414.50721679687496 79.05844000000002 L 438.388291015625 79.05844000000002 C 438.388291015625 79.05844000000002 438.388291015625 79.05844000000002 438.388291015625 79.05844000000002 L 438.388291015625 282.349 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="0" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 414.50721679687496 282.349 L 414.50721679687496 79.05844000000002 C 414.50721679687496 79.05844000000002 414.50721679687496 79.05844000000002 414.50721679687496 79.05844000000002 L 438.388291015625 79.05844000000002 C 438.388291015625 79.05844000000002 438.388291015625 79.05844000000002 438.388291015625 79.05844000000002 L 438.388291015625 282.349 z " pathFrom="M 414.50721679687496 282.349 L 414.50721679687496 282.349 L 438.388291015625 282.349 L 438.388291015625 282.349 L 438.388291015625 282.349 L 438.388291015625 282.349 L 438.388291015625 282.349 L 414.50721679687496 282.349 z" cy="79.05744000000001" cx="471.36691731770827" j="7" val="36" barHeight="203.29056" barWidth="23.88107421875"></path><path id="SvgjsPath1855" d="M 471.36691731770827 282.349 L 471.36691731770827 146.82196000000002 C 471.36691731770827 146.82196000000002 471.36691731770827 146.82196000000002 471.36691731770827 146.82196000000002 L 495.24799153645824 146.82196000000002 C 495.24799153645824 146.82196000000002 495.24799153645824 146.82196000000002 495.24799153645824 146.82196000000002 L 495.24799153645824 282.349 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="0" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 471.36691731770827 282.349 L 471.36691731770827 146.82196000000002 C 471.36691731770827 146.82196000000002 471.36691731770827 146.82196000000002 471.36691731770827 146.82196000000002 L 495.24799153645824 146.82196000000002 C 495.24799153645824 146.82196000000002 495.24799153645824 146.82196000000002 495.24799153645824 146.82196000000002 L 495.24799153645824 282.349 z " pathFrom="M 471.36691731770827 282.349 L 471.36691731770827 282.349 L 495.24799153645824 282.349 L 495.24799153645824 282.349 L 495.24799153645824 282.349 L 495.24799153645824 282.349 L 495.24799153645824 282.349 L 471.36691731770827 282.349 z" cy="146.82096" cx="528.2266178385416" j="8" val="24" barHeight="135.52704" barWidth="23.88107421875"></path><path id="SvgjsPath1857" d="M 528.2266178385416 282.349 L 528.2266178385416 197.6446 C 528.2266178385416 197.6446 528.2266178385416 197.6446 528.2266178385416 197.6446 L 552.1076920572916 197.6446 C 552.1076920572916 197.6446 552.1076920572916 197.6446 552.1076920572916 197.6446 L 552.1076920572916 282.349 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="0" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 528.2266178385416 282.349 L 528.2266178385416 197.6446 C 528.2266178385416 197.6446 528.2266178385416 197.6446 528.2266178385416 197.6446 L 552.1076920572916 197.6446 C 552.1076920572916 197.6446 552.1076920572916 197.6446 552.1076920572916 197.6446 L 552.1076920572916 282.349 z " pathFrom="M 528.2266178385416 282.349 L 528.2266178385416 282.349 L 552.1076920572916 282.349 L 552.1076920572916 282.349 L 552.1076920572916 282.349 L 552.1076920572916 282.349 L 552.1076920572916 282.349 L 528.2266178385416 282.349 z" cy="197.6436" cx="585.086318359375" j="9" val="15" barHeight="84.7044" barWidth="23.88107421875"></path><path id="SvgjsPath1859" d="M 585.086318359375 282.349 L 585.086318359375 163.76284 C 585.086318359375 163.76284 585.086318359375 163.76284 585.086318359375 163.76284 L 608.967392578125 163.76284 C 608.967392578125 163.76284 608.967392578125 163.76284 608.967392578125 163.76284 L 608.967392578125 282.349 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="0" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 585.086318359375 282.349 L 585.086318359375 163.76284 C 585.086318359375 163.76284 585.086318359375 163.76284 585.086318359375 163.76284 L 608.967392578125 163.76284 C 608.967392578125 163.76284 608.967392578125 163.76284 608.967392578125 163.76284 L 608.967392578125 282.349 z " pathFrom="M 585.086318359375 282.349 L 585.086318359375 282.349 L 608.967392578125 282.349 L 608.967392578125 282.349 L 608.967392578125 282.349 L 608.967392578125 282.349 L 608.967392578125 282.349 L 585.086318359375 282.349 z" cy="163.76184" cx="641.9460188802084" j="10" val="21" barHeight="118.58616" barWidth="23.88107421875"></path><path id="SvgjsPath1861" d="M 641.9460188802084 282.349 L 641.9460188802084 124.23412000000002 C 641.9460188802084 124.23412000000002 641.9460188802084 124.23412000000002 641.9460188802084 124.23412000000002 L 665.8270930989584 124.23412000000002 C 665.8270930989584 124.23412000000002 665.8270930989584 124.23412000000002 665.8270930989584 124.23412000000002 L 665.8270930989584 282.349 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="0" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 641.9460188802084 282.349 L 641.9460188802084 124.23412000000002 C 641.9460188802084 124.23412000000002 641.9460188802084 124.23412000000002 641.9460188802084 124.23412000000002 L 665.8270930989584 124.23412000000002 C 665.8270930989584 124.23412000000002 665.8270930989584 124.23412000000002 665.8270930989584 124.23412000000002 L 665.8270930989584 282.349 z " pathFrom="M 641.9460188802084 282.349 L 641.9460188802084 282.349 L 665.8270930989584 282.349 L 665.8270930989584 282.349 L 665.8270930989584 282.349 L 665.8270930989584 282.349 L 665.8270930989584 282.349 L 641.9460188802084 282.349 z" cy="124.23312000000001" cx="698.8057194010418" j="11" val="28" barHeight="158.11488" barWidth="23.88107421875"></path><g id="SvgjsG1837" class="apexcharts-bar-goals-markers"><g id="SvgjsG1838" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1840" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1842" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1844" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1846" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1848" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1850" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1852" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1854" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1856" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1858" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1860" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g></g></g><g id="SvgjsG1862" class="apexcharts-series" seriesName="Revenue" rel="2" data:realIndex="1"><path id="SvgjsPath1866" d="M 16.489313151041667 175.05776000000003 L 16.489313151041667 135.52904000000004 C 16.489313151041667 135.52904000000004 16.489313151041667 135.52904000000004 16.489313151041667 135.52904000000004 L 40.37038736979167 135.52904000000004 C 40.37038736979167 135.52904000000004 40.37038736979167 135.52904000000004 40.37038736979167 135.52904000000004 L 40.37038736979167 175.05776000000003 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="1" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 16.489313151041667 175.05776000000003 L 16.489313151041667 135.52904000000004 C 16.489313151041667 135.52904000000004 16.489313151041667 135.52904000000004 16.489313151041667 135.52904000000004 L 40.37038736979167 135.52904000000004 C 40.37038736979167 135.52904000000004 40.37038736979167 135.52904000000004 40.37038736979167 135.52904000000004 L 40.37038736979167 175.05776000000003 z " pathFrom="M 16.489313151041667 175.05776000000003 L 16.489313151041667 175.05776000000003 L 40.37038736979167 175.05776000000003 L 40.37038736979167 175.05776000000003 L 40.37038736979167 175.05776000000003 L 40.37038736979167 175.05776000000003 L 40.37038736979167 175.05776000000003 L 16.489313151041667 175.05776000000003 z" cy="135.52804000000003" cx="73.349013671875" j="0" val="7" barHeight="39.52872" barWidth="23.88107421875"></path><path id="SvgjsPath1868" d="M 73.349013671875 79.05944000000002 L 73.349013671875 11.295920000000018 C 73.349013671875 11.295920000000018 73.349013671875 11.295920000000018 73.349013671875 11.295920000000018 L 97.230087890625 11.295920000000018 C 97.230087890625 11.295920000000018 97.230087890625 11.295920000000018 97.230087890625 11.295920000000018 L 97.230087890625 79.05944000000002 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="1" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 73.349013671875 79.05944000000002 L 73.349013671875 11.295920000000018 C 73.349013671875 11.295920000000018 73.349013671875 11.295920000000018 73.349013671875 11.295920000000018 L 97.230087890625 11.295920000000018 C 97.230087890625 11.295920000000018 97.230087890625 11.295920000000018 97.230087890625 11.295920000000018 L 97.230087890625 79.05944000000002 z " pathFrom="M 73.349013671875 79.05944000000002 L 73.349013671875 79.05944000000002 L 97.230087890625 79.05944000000002 L 97.230087890625 79.05944000000002 L 97.230087890625 79.05944000000002 L 97.230087890625 79.05944000000002 L 97.230087890625 79.05944000000002 L 73.349013671875 79.05944000000002 z" cy="11.294920000000019" cx="130.20871419270833" j="1" val="12" barHeight="67.76352" barWidth="23.88107421875"></path><path id="SvgjsPath1870" d="M 130.20871419270833 146.82296000000002 L 130.20871419270833 90.35336000000002 C 130.20871419270833 90.35336000000002 130.20871419270833 90.35336000000002 130.20871419270833 90.35336000000002 L 154.08978841145833 90.35336000000002 C 154.08978841145833 90.35336000000002 154.08978841145833 90.35336000000002 154.08978841145833 90.35336000000002 L 154.08978841145833 146.82296000000002 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="1" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 130.20871419270833 146.82296000000002 L 130.20871419270833 90.35336000000002 C 130.20871419270833 90.35336000000002 130.20871419270833 90.35336000000002 130.20871419270833 90.35336000000002 L 154.08978841145833 90.35336000000002 C 154.08978841145833 90.35336000000002 154.08978841145833 90.35336000000002 154.08978841145833 90.35336000000002 L 154.08978841145833 146.82296000000002 z " pathFrom="M 130.20871419270833 146.82296000000002 L 130.20871419270833 146.82296000000002 L 154.08978841145833 146.82296000000002 L 154.08978841145833 146.82296000000002 L 154.08978841145833 146.82296000000002 L 154.08978841145833 146.82296000000002 L 154.08978841145833 146.82296000000002 L 130.20871419270833 146.82296000000002 z" cy="90.35236000000002" cx="187.06841471354167" j="2" val="10" barHeight="56.4696" barWidth="23.88107421875"></path><path id="SvgjsPath1872" d="M 187.06841471354167 169.41080000000002 L 187.06841471354167 101.64728000000002 C 187.06841471354167 101.64728000000002 187.06841471354167 101.64728000000002 187.06841471354167 101.64728000000002 L 210.94948893229167 101.64728000000002 C 210.94948893229167 101.64728000000002 210.94948893229167 101.64728000000002 210.94948893229167 101.64728000000002 L 210.94948893229167 169.41080000000002 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="1" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 187.06841471354167 169.41080000000002 L 187.06841471354167 101.64728000000002 C 187.06841471354167 101.64728000000002 187.06841471354167 101.64728000000002 187.06841471354167 101.64728000000002 L 210.94948893229167 101.64728000000002 C 210.94948893229167 101.64728000000002 210.94948893229167 101.64728000000002 210.94948893229167 101.64728000000002 L 210.94948893229167 169.41080000000002 z " pathFrom="M 187.06841471354167 169.41080000000002 L 187.06841471354167 169.41080000000002 L 210.94948893229167 169.41080000000002 L 210.94948893229167 169.41080000000002 L 210.94948893229167 169.41080000000002 L 210.94948893229167 169.41080000000002 L 210.94948893229167 169.41080000000002 L 187.06841471354167 169.41080000000002 z" cy="101.64628000000002" cx="243.928115234375" j="3" val="12" barHeight="67.76352" barWidth="23.88107421875"></path><path id="SvgjsPath1874" d="M 243.928115234375 90.35336000000001 L 243.928115234375 28.236800000000006 C 243.928115234375 28.236800000000006 243.928115234375 28.236800000000006 243.928115234375 28.236800000000006 L 267.809189453125 28.236800000000006 C 267.809189453125 28.236800000000006 267.809189453125 28.236800000000006 267.809189453125 28.236800000000006 L 267.809189453125 90.35336000000001 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="1" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 243.928115234375 90.35336000000001 L 243.928115234375 28.236800000000006 C 243.928115234375 28.236800000000006 243.928115234375 28.236800000000006 243.928115234375 28.236800000000006 L 267.809189453125 28.236800000000006 C 267.809189453125 28.236800000000006 267.809189453125 28.236800000000006 267.809189453125 28.236800000000006 L 267.809189453125 90.35336000000001 z " pathFrom="M 243.928115234375 90.35336000000001 L 243.928115234375 90.35336000000001 L 267.809189453125 90.35336000000001 L 267.809189453125 90.35336000000001 L 267.809189453125 90.35336000000001 L 267.809189453125 90.35336000000001 L 267.809189453125 90.35336000000001 L 243.928115234375 90.35336000000001 z" cy="28.235800000000005" cx="300.7878157552083" j="4" val="11" barHeight="62.11656" barWidth="23.88107421875"></path><path id="SvgjsPath1876" d="M 300.7878157552083 146.82296000000002 L 300.7878157552083 90.35336000000002 C 300.7878157552083 90.35336000000002 300.7878157552083 90.35336000000002 300.7878157552083 90.35336000000002 L 324.66888997395836 90.35336000000002 C 324.66888997395836 90.35336000000002 324.66888997395836 90.35336000000002 324.66888997395836 90.35336000000002 L 324.66888997395836 146.82296000000002 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="1" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 300.7878157552083 146.82296000000002 L 300.7878157552083 90.35336000000002 C 300.7878157552083 90.35336000000002 300.7878157552083 90.35336000000002 300.7878157552083 90.35336000000002 L 324.66888997395836 90.35336000000002 C 324.66888997395836 90.35336000000002 324.66888997395836 90.35336000000002 324.66888997395836 90.35336000000002 L 324.66888997395836 146.82296000000002 z " pathFrom="M 300.7878157552083 146.82296000000002 L 300.7878157552083 146.82296000000002 L 324.66888997395836 146.82296000000002 L 324.66888997395836 146.82296000000002 L 324.66888997395836 146.82296000000002 L 324.66888997395836 146.82296000000002 L 324.66888997395836 146.82296000000002 L 300.7878157552083 146.82296000000002 z" cy="90.35236000000002" cx="357.64751627604164" j="5" val="10" barHeight="56.4696" barWidth="23.88107421875"></path><path id="SvgjsPath1878" d="M 357.64751627604164 220.23344000000003 L 357.64751627604164 146.82296000000002 C 357.64751627604164 146.82296000000002 357.64751627604164 146.82296000000002 357.64751627604164 146.82296000000002 L 381.5285904947916 146.82296000000002 C 381.5285904947916 146.82296000000002 381.5285904947916 146.82296000000002 381.5285904947916 146.82296000000002 L 381.5285904947916 220.23344000000003 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="1" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 357.64751627604164 220.23344000000003 L 357.64751627604164 146.82296000000002 C 357.64751627604164 146.82296000000002 357.64751627604164 146.82296000000002 357.64751627604164 146.82296000000002 L 381.5285904947916 146.82296000000002 C 381.5285904947916 146.82296000000002 381.5285904947916 146.82296000000002 381.5285904947916 146.82296000000002 L 381.5285904947916 220.23344000000003 z " pathFrom="M 357.64751627604164 220.23344000000003 L 357.64751627604164 220.23344000000003 L 381.5285904947916 220.23344000000003 L 381.5285904947916 220.23344000000003 L 381.5285904947916 220.23344000000003 L 381.5285904947916 220.23344000000003 L 381.5285904947916 220.23344000000003 L 357.64751627604164 220.23344000000003 z" cy="146.82196000000002" cx="414.50721679687496" j="6" val="13" barHeight="73.41048" barWidth="23.88107421875"></path><path id="SvgjsPath1880" d="M 414.50721679687496 79.05944000000002 L 414.50721679687496 22.58984000000002 C 414.50721679687496 22.58984000000002 414.50721679687496 22.58984000000002 414.50721679687496 22.58984000000002 L 438.388291015625 22.58984000000002 C 438.388291015625 22.58984000000002 438.388291015625 22.58984000000002 438.388291015625 22.58984000000002 L 438.388291015625 79.05944000000002 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="1" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 414.50721679687496 79.05944000000002 L 414.50721679687496 22.58984000000002 C 414.50721679687496 22.58984000000002 414.50721679687496 22.58984000000002 414.50721679687496 22.58984000000002 L 438.388291015625 22.58984000000002 C 438.388291015625 22.58984000000002 438.388291015625 22.58984000000002 438.388291015625 22.58984000000002 L 438.388291015625 79.05944000000002 z " pathFrom="M 414.50721679687496 79.05944000000002 L 414.50721679687496 79.05944000000002 L 438.388291015625 79.05944000000002 L 438.388291015625 79.05944000000002 L 438.388291015625 79.05944000000002 L 438.388291015625 79.05944000000002 L 438.388291015625 79.05944000000002 L 414.50721679687496 79.05944000000002 z" cy="22.58884000000002" cx="471.36691731770827" j="7" val="10" barHeight="56.4696" barWidth="23.88107421875"></path><path id="SvgjsPath1882" d="M 471.36691731770827 146.82296000000002 L 471.36691731770827 79.05944000000002 C 471.36691731770827 79.05944000000002 471.36691731770827 79.05944000000002 471.36691731770827 79.05944000000002 L 495.24799153645824 79.05944000000002 C 495.24799153645824 79.05944000000002 495.24799153645824 79.05944000000002 495.24799153645824 79.05944000000002 L 495.24799153645824 146.82296000000002 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="1" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 471.36691731770827 146.82296000000002 L 471.36691731770827 79.05944000000002 C 471.36691731770827 79.05944000000002 471.36691731770827 79.05944000000002 471.36691731770827 79.05944000000002 L 495.24799153645824 79.05944000000002 C 495.24799153645824 79.05944000000002 495.24799153645824 79.05944000000002 495.24799153645824 79.05944000000002 L 495.24799153645824 146.82296000000002 z " pathFrom="M 471.36691731770827 146.82296000000002 L 471.36691731770827 146.82296000000002 L 495.24799153645824 146.82296000000002 L 495.24799153645824 146.82296000000002 L 495.24799153645824 146.82296000000002 L 495.24799153645824 146.82296000000002 L 495.24799153645824 146.82296000000002 L 471.36691731770827 146.82296000000002 z" cy="79.05844000000002" cx="528.2266178385416" j="8" val="12" barHeight="67.76352" barWidth="23.88107421875"></path><path id="SvgjsPath1884" d="M 528.2266178385416 197.6456 L 528.2266178385416 152.46992 C 528.2266178385416 152.46992 528.2266178385416 152.46992 528.2266178385416 152.46992 L 552.1076920572916 152.46992 C 552.1076920572916 152.46992 552.1076920572916 152.46992 552.1076920572916 152.46992 L 552.1076920572916 197.6456 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="1" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 528.2266178385416 197.6456 L 528.2266178385416 152.46992 C 528.2266178385416 152.46992 528.2266178385416 152.46992 528.2266178385416 152.46992 L 552.1076920572916 152.46992 C 552.1076920572916 152.46992 552.1076920572916 152.46992 552.1076920572916 152.46992 L 552.1076920572916 197.6456 z " pathFrom="M 528.2266178385416 197.6456 L 528.2266178385416 197.6456 L 552.1076920572916 197.6456 L 552.1076920572916 197.6456 L 552.1076920572916 197.6456 L 552.1076920572916 197.6456 L 552.1076920572916 197.6456 L 528.2266178385416 197.6456 z" cy="152.46892" cx="585.086318359375" j="9" val="8" barHeight="45.17568" barWidth="23.88107421875"></path><path id="SvgjsPath1886" d="M 585.086318359375 163.76384000000002 L 585.086318359375 90.35336000000001 C 585.086318359375 90.35336000000001 585.086318359375 90.35336000000001 585.086318359375 90.35336000000001 L 608.967392578125 90.35336000000001 C 608.967392578125 90.35336000000001 608.967392578125 90.35336000000001 608.967392578125 90.35336000000001 L 608.967392578125 163.76384000000002 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="1" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 585.086318359375 163.76384000000002 L 585.086318359375 90.35336000000001 C 585.086318359375 90.35336000000001 585.086318359375 90.35336000000001 585.086318359375 90.35336000000001 L 608.967392578125 90.35336000000001 C 608.967392578125 90.35336000000001 608.967392578125 90.35336000000001 608.967392578125 90.35336000000001 L 608.967392578125 163.76384000000002 z " pathFrom="M 585.086318359375 163.76384000000002 L 585.086318359375 163.76384000000002 L 608.967392578125 163.76384000000002 L 608.967392578125 163.76384000000002 L 608.967392578125 163.76384000000002 L 608.967392578125 163.76384000000002 L 608.967392578125 163.76384000000002 L 585.086318359375 163.76384000000002 z" cy="90.35236" cx="641.9460188802084" j="10" val="13" barHeight="73.41048" barWidth="23.88107421875"></path><path id="SvgjsPath1888" d="M 641.9460188802084 124.23512000000002 L 641.9460188802084 50.82464000000001 C 641.9460188802084 50.82464000000001 641.9460188802084 50.82464000000001 641.9460188802084 50.82464000000001 L 665.8270930989584 50.82464000000001 C 665.8270930989584 50.82464000000001 665.8270930989584 50.82464000000001 665.8270930989584 50.82464000000001 L 665.8270930989584 124.23512000000002 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area " index="1" clip-path="url(#gridRectBarMasksybu3sbv)" pathTo="M 641.9460188802084 124.23512000000002 L 641.9460188802084 50.82464000000001 C 641.9460188802084 50.82464000000001 641.9460188802084 50.82464000000001 641.9460188802084 50.82464000000001 L 665.8270930989584 50.82464000000001 C 665.8270930989584 50.82464000000001 665.8270930989584 50.82464000000001 665.8270930989584 50.82464000000001 L 665.8270930989584 124.23512000000002 z " pathFrom="M 641.9460188802084 124.23512000000002 L 641.9460188802084 124.23512000000002 L 665.8270930989584 124.23512000000002 L 665.8270930989584 124.23512000000002 L 665.8270930989584 124.23512000000002 L 665.8270930989584 124.23512000000002 L 665.8270930989584 124.23512000000002 L 641.9460188802084 124.23512000000002 z" cy="50.82364000000001" cx="698.8057194010418" j="11" val="13" barHeight="73.41048" barWidth="23.88107421875"></path><g id="SvgjsG1864" class="apexcharts-bar-goals-markers"><g id="SvgjsG1865" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1867" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1869" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1871" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1873" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1875" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1877" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1879" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1881" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1883" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1885" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g><g id="SvgjsG1887" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMasksybu3sbv)"></g></g></g><g id="SvgjsG1836" class="apexcharts-datalabels" data:realIndex="0"></g><g id="SvgjsG1863" class="apexcharts-datalabels" data:realIndex="1"></g></g><line id="SvgjsLine1914" x1="0" y1="0" x2="682.31640625" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1915" x1="0" y1="0" x2="682.31640625" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1916" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1917" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1919" font-family="Helvetica, Arial, sans-serif" x="28.429850260416668" y="310.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1920">Jan</tspan><title>Jan</title></text><text id="SvgjsText1922" font-family="Helvetica, Arial, sans-serif" x="85.28955078125" y="310.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1923">Feb</tspan><title>Feb</title></text><text id="SvgjsText1925" font-family="Helvetica, Arial, sans-serif" x="142.14925130208334" y="310.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1926">Mar</tspan><title>Mar</title></text><text id="SvgjsText1928" font-family="Helvetica, Arial, sans-serif" x="199.00895182291669" y="310.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1929">Apr</tspan><title>Apr</title></text><text id="SvgjsText1931" font-family="Helvetica, Arial, sans-serif" x="255.86865234375003" y="310.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1932">May</tspan><title>May</title></text><text id="SvgjsText1934" font-family="Helvetica, Arial, sans-serif" x="312.7283528645833" y="310.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1935">Jun</tspan><title>Jun</title></text><text id="SvgjsText1937" font-family="Helvetica, Arial, sans-serif" x="369.58805338541663" y="310.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1938">July</tspan><title>July</title></text><text id="SvgjsText1940" font-family="Helvetica, Arial, sans-serif" x="426.44775390624994" y="310.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1941">Aug</tspan><title>Aug</title></text><text id="SvgjsText1943" font-family="Helvetica, Arial, sans-serif" x="483.30745442708326" y="310.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1944">Sep</tspan><title>Sep</title></text><text id="SvgjsText1946" font-family="Helvetica, Arial, sans-serif" x="540.1671549479166" y="310.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1947">Oct</tspan><title>Oct</title></text><text id="SvgjsText1949" font-family="Helvetica, Arial, sans-serif" x="597.02685546875" y="310.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1950">Nov</tspan><title>Nov</title></text><text id="SvgjsText1952" font-family="Helvetica, Arial, sans-serif" x="653.8865559895834" y="310.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1953">Des</tspan><title>Des</title></text></g></g><g id="SvgjsG1975" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1976" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1977" class="apexcharts-point-annotations"></g></g></svg><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-0" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(12, 118, 138);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-1" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(218, 234, 238);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div id="donut-chart" class="apex-charts" style="min-height: 350px;"><div id="apexcharts3y4vonrz" class="apexcharts-canvas apexcharts3y4vonrz apexcharts-theme-" style="width: 747px; height: 350px;"><svg id="SvgjsSvg1978" width="747" height="350" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"><foreignObject x="0" y="0" width="747" height="350"><div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="right: 0px; position: absolute; left: 0px; top: 325px; max-height: 175px;"><div class="apexcharts-legend-series" rel="1" seriesname="Online" data:collapsed="false" style="margin: 4px 5px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="height: 16px; width: 16px; left: 0px; top: 0px;"><svg id="SvgjsSvg1981" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"><defs id="SvgjsDefs1982"><clipPath id="gridRectMask3y4vonrz"><rect id="SvgjsRect1990" width="747" height="316" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectBarMask3y4vonrz"><rect id="SvgjsRect1991" width="753" height="322" x="-3" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMask3y4vonrz"><rect id="SvgjsRect1992" width="747" height="316" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask3y4vonrz"></clipPath><clipPath id="nonForecastMask3y4vonrz"></clipPath></defs><path id="SvgjsPath1983" d="M 0, 0
           m -7, 0
           a 7,7 0 1,0 14,0
           a 7,7 0 1,0 -14,0" fill="#0c768a" fill-opacity="1" stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle" style="transform: translate(50%, 50%);"></path></svg></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="Online" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Online</span></div><div class="apexcharts-legend-series" rel="2" seriesname="Offline" data:collapsed="false" style="margin: 4px 5px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="height: 16px; width: 16px; left: 0px; top: 0px;"><svg id="SvgjsSvg1984" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"><defs id="SvgjsDefs1985"></defs><path id="SvgjsPath1986" d="M 0, 0
           m -7, 0
           a 7,7 0 1,0 14,0
           a 7,7 0 1,0 -14,0" fill="#38c786" fill-opacity="1" stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle" style="transform: translate(50%, 50%);"></path></svg></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="Offline" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Offline</span></div><div class="apexcharts-legend-series" rel="3" seriesname="Marketing" data:collapsed="false" style="margin: 4px 5px;"><span class="apexcharts-legend-marker" rel="3" data:collapsed="false" style="height: 16px; width: 16px; left: 0px; top: 0px;"><svg id="SvgjsSvg1987" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"><defs id="SvgjsDefs1988"></defs><path id="SvgjsPath1989" d="M 0, 0
           m -7, 0
           a 7,7 0 1,0 14,0
           a 7,7 0 1,0 -14,0" fill="#daeaee" fill-opacity="1" stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle" style="transform: translate(50%, 50%);"></path></svg></span><span class="apexcharts-legend-text" rel="3" i="2" data:default-text="Marketing" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Marketing</span></div></div><style type="text/css">
                                                            .apexcharts-flip-y {
                                                                transform: scaleY(-1) translateY(-100%);
                                                                transform-origin: top;
                                                                transform-box: fill-box;
                                                            }
                                                            .apexcharts-flip-x {
                                                                transform: scaleX(-1);
                                                                transform-origin: center;
                                                                transform-box: fill-box;
                                                            }
                                                            .apexcharts-legend {
                                                                display: flex;
                                                                overflow: auto;
                                                                padding: 0 10px;
                                                            }
                                                            .apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
                                                                flex-wrap: wrap
                                                            }
                                                            .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
                                                                flex-direction: column;
                                                                bottom: 0;
                                                            }
                                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
                                                                justify-content: flex-start;
                                                            }
                                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                                                justify-content: center;
                                                            }
                                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                                                justify-content: flex-end;
                                                            }
                                                            .apexcharts-legend-series {
                                                                cursor: pointer;
                                                                line-height: normal;
                                                                display: flex;
                                                                align-items: center;
                                                            }
                                                            .apexcharts-legend-text {
                                                                position: relative;
                                                                font-size: 14px;
                                                            }
                                                            .apexcharts-legend-text *, .apexcharts-legend-marker * {
                                                                pointer-events: none;
                                                            }
                                                            .apexcharts-legend-marker {
                                                                position: relative;
                                                                display: flex;
                                                                align-items: center;
                                                                justify-content: center;
                                                                cursor: pointer;
                                                                margin-right: 1px;
                                                            }

                                                            .apexcharts-legend-series.apexcharts-no-click {
                                                                cursor: auto;
                                                            }
                                                            .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
                                                                display: none !important;
                                                            }
                                                            .apexcharts-inactive-legend {
                                                                opacity: 0.45;
                                                            }</style></foreignObject><g id="SvgjsG1980" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1979"></defs><g id="SvgjsG1995" class="apexcharts-pie"><g id="SvgjsG1996" transform="translate(0, 0) scale(1)"><circle id="SvgjsCircle1997" r="114.07268292682927" cx="373.5" cy="158" fill="transparent"></circle><g id="SvgjsG1998" class="apexcharts-slices"><g id="SvgjsG1999" class="apexcharts-series apexcharts-pie-series" seriesName="Online" rel="1" data:realIndex="0"><path id="SvgjsPath2000" d="M 373.5 9.853658536585357 A 148.14634146341464 148.14634146341464 0 1 1 342.83722787538755 302.93837619701947 L 349.88966546404845 269.602549671705 A 114.07268292682927 114.07268292682927 0 1 0 373.5 43.92731707317073 L 373.5 9.853658536585357 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="191.94521054090075" data:startAngle="0" data:strokeWidth="2" data:value="40405" data:pathOrig="M 373.5 9.853658536585357 A 148.14634146341464 148.14634146341464 0 1 1 342.83722787538755 302.93837619701947 L 349.88966546404845 269.602549671705 A 114.07268292682927 114.07268292682927 0 1 0 373.5 43.92731707317073 L 373.5 9.853658536585357 z " stroke="#ffffff"></path></g><g id="SvgjsG2001" class="apexcharts-series apexcharts-pie-series" seriesName="Offline" rel="2" data:realIndex="1"><path id="SvgjsPath2002" d="M 342.83722787538755 302.93837619701947 A 148.14634146341464 148.14634146341464 0 0 1 225.74670016963572 168.78428848988773 L 259.7299591306195 166.30390213721353 A 114.07268292682927 114.07268292682927 0 0 0 349.88966546404845 269.602549671705 L 342.83722787538755 302.93837619701947 z " fill="rgba(56,199,134,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="73.88026022353887" data:startAngle="191.94521054090075" data:strokeWidth="2" data:value="15552" data:pathOrig="M 342.83722787538755 302.93837619701947 A 148.14634146341464 148.14634146341464 0 0 1 225.74670016963572 168.78428848988773 L 259.7299591306195 166.30390213721353 A 114.07268292682927 114.07268292682927 0 0 0 349.88966546404845 269.602549671705 L 342.83722787538755 302.93837619701947 z " stroke="#ffffff"></path></g><g id="SvgjsG2003" class="apexcharts-series apexcharts-pie-series" seriesName="Marketing" rel="3" data:realIndex="2"><path id="SvgjsPath2004" d="M 225.74670016963572 168.78428848988773 A 148.14634146341464 148.14634146341464 0 0 1 373.47414358579806 9.853660792983163 L 373.4800905610645 43.92731881059703 A 114.07268292682927 114.07268292682927 0 0 0 259.7299591306195 166.30390213721353 L 225.74670016963572 168.78428848988773 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="94.17452923556039" data:startAngle="265.8254707644396" data:strokeWidth="2" data:value="19824" data:pathOrig="M 225.74670016963572 168.78428848988773 A 148.14634146341464 148.14634146341464 0 0 1 373.47414358579806 9.853660792983163 L 373.4800905610645 43.92731881059703 A 114.07268292682927 114.07268292682927 0 0 0 259.7299591306195 166.30390213721353 L 225.74670016963572 168.78428848988773 z " stroke="#ffffff"></path></g></g></g><g id="SvgjsG1993" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"><text id="SvgjsText2005" font-family="Helvetica, Arial, sans-serif" x="373.5" y="153" text-anchor="middle" dominant-baseline="auto" font-size="16px" font-weight="400" fill="#9599ad" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif;">Total value</text><text id="SvgjsText2006" font-family="Helvetica, Arial, sans-serif" x="373.5" y="184" text-anchor="middle" dominant-baseline="auto" font-size="24px" font-weight="500" fill="#343a40" class="apexcharts-text apexcharts-datalabel-value" style="font-family: Helvetica, Arial, sans-serif;">$75781</text></g></g><line id="SvgjsLine2007" x1="0" y1="0" x2="747" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2008" x1="0" y1="0" x2="747" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG1994" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g></svg><div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-0" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(12, 118, 138);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-1" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(56, 199, 134);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-2" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(218, 234, 238);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex pb-1">
                                <h4 class="card-title mb-0 flex-grow-1">Live Users By Country</h4>
                                <div>
                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                        Export Report
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="world-map-markers" style="height: 346px; background-color: transparent;" class="jvm-container"><svg width="333" height="346"><defs></defs><g id="jvm-regions-group" transform="scale(0.37) translate(0, 176.02744152159786)"><path d="M651.84,359.63l-0.6,-2.05l-1.36,-1.76l-2.31,-0.11l-0.41,0.48l0.2,0.98l-0.54,1.03l-0.71,-0.37l-0.68,0.36l-1.19,-0.37l-0.37,-2.06l-0.81,-1.92l0.39,-1.52l-0.21,-0.46l-1.16,-0.55l0.3,-0.55l1.48,-0.98l0.03,-0.64l-1.56,-1.27l0.56,-1.2l1.6,0.97l1.04,0.16l0.18,1.62l0.33,0.35l5.65,0.65l-0.86,1.73l-1.21,0.35l-0.77,1.56l0.07,0.46l1.37,1.41l0.68,-0.19l0.42,-1.44l1.21,3.96l-0.03,1.26l-0.32,-0.15l-0.41,0.28Z" data-code="BD" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M429.3,264.88l1.93,0.28l2.07,-0.74l1.41,1.55l1.25,0.86l-0.23,2.13l-0.68,0.42l-0.18,1.46l-1.63,-1.32l-1.4,0.17l-2.72,-3.22l-1.17,-0.21l-0.2,-0.77l1.57,-0.62Z" data-code="BE" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M421.42,377.38l-0.11,0.96l0.34,1.18l1.4,1.73l0.07,1.11l0.32,0.37l2.56,0.52l-0.04,1.3l-0.38,0.54l-1.07,0.21l-0.73,1.19l-0.63,0.21l-3.22,-0.25l-0.94,0.39l-5.4,-0.05l-0.39,0.38l0.16,2.75l-1.23,-0.43l-1.17,0.1l-0.89,0.57l-2.27,-1.73l-0.13,-1.12l0.61,-0.96l0.01,-0.93l1.87,-2.0l0.44,-1.83l0.43,-0.39l1.28,0.26l1.05,-0.52l0.47,-0.73l1.84,-1.1l0.55,-0.84l2.2,-1.01l1.15,-0.31l0.72,0.46l1.13,-0.01Z" data-code="BF" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M491.72,293.09l-0.93,1.06l-0.91,2.45l0.52,1.52l-1.65,-0.27l-2.55,1.06l-0.27,1.69l-1.79,0.25l-2.03,-1.11l-1.92,0.88l-1.4,-0.07l-0.15,-1.87l-1.09,-1.09l0.34,-1.71l0.91,-1.02l0.01,-0.52l-1.15,-1.41l-0.06,-1.14l0.44,0.87l0.46,0.21l0.87,-0.23l1.91,0.53l3.68,0.18l1.44,-0.92l2.7,-0.74l1.67,1.16l0.95,0.26Z" data-code="BG" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M463.49,287.91l2.09,0.57l1.72,-0.03l1.56,0.78l-0.4,0.99l1.14,1.61l-0.27,1.19l-1.82,1.31l-0.37,1.54l-1.65,-0.96l-0.89,-1.36l-2.11,-2.07l-1.65,-2.57l0.25,-0.7l0.45,0.41l0.59,-0.06l0.43,-0.59l0.92,-0.06Z" data-code="BA" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M707.48,403.47l0.69,-0.65l1.41,-0.91l-0.15,1.64l-0.81,-0.05l-0.61,0.58l-0.53,-0.6Z" data-code="BN" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M263.83,471.11l-3.09,-0.24l-0.38,0.24l-0.7,1.56l-1.31,-1.57l-3.28,-0.66l-2.38,2.47l-1.3,0.27l-0.88,-3.36l-1.31,-2.93l0.74,-2.43l-0.12,-0.42l-1.2,-1.03l-0.37,-1.92l-1.09,-1.59l1.46,-2.61l-0.97,-2.36l0.48,-1.07l-0.35,-0.74l0.91,-1.33l0.16,-3.89l0.5,-1.18l-1.81,-3.45l2.46,0.08l0.8,-0.85l3.4,-1.92l2.66,-0.35l-0.19,1.39l0.3,1.07l-0.05,1.98l2.72,2.29l2.88,0.49l0.89,0.87l1.79,0.59l0.98,0.71l1.71,0.05l1.17,0.61l0.6,2.74l-0.7,0.54l0.96,3.03l0.37,0.28l4.3,0.1l-0.25,1.22l0.27,1.03l1.43,0.92l0.5,1.38l-0.41,1.9l-0.65,1.11l0.13,1.37l-2.69,-1.68l-2.4,-0.03l-4.36,0.77l-1.49,2.56l-0.1,1.55l-0.75,2.44Z" data-code="BO" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M781.1,291.58l1.81,0.77l1.63,-1.08l0.4,2.83l-3.6,1.02l-1.98,3.05l-3.61,-2.12l-0.58,0.21l-1.27,3.44l-2.14,0.04l-0.3,-2.88l1.09,-2.32l2.44,-0.17l0.37,-0.34l1.26,-6.78l2.45,3.07l2.03,1.27ZM773.56,314.42l-0.92,2.42l0.38,1.64l-1.15,1.91l-3.02,1.35l-4.59,0.3l-3.33,3.22l-1.25,-0.86l-0.09,-2.06l-0.46,-0.38l-4.35,0.67l-3.0,1.42l-2.84,0.06l-0.37,0.26l0.11,0.44l2.34,2.04l-1.55,4.67l-1.25,0.95l-0.8,-0.75l0.56,-2.43l-0.2,-0.44l-1.47,-0.8l-0.77,-1.54l2.14,-0.91l1.27,-1.83l2.45,-1.53l1.83,-2.06l4.77,-0.88l2.6,0.61l0.45,-0.22l2.39,-5.05l1.27,1.14l0.53,0.01l5.1,-4.39l1.68,-4.08l-0.39,-3.75l0.92,-1.82l2.11,-0.49l1.24,4.16l-0.07,2.45l-2.25,3.13l-0.03,3.43ZM757.77,324.02l0.2,0.64l-1.01,1.31l-1.17,-0.72l-1.28,0.7l-0.69,1.54l-1.01,-0.53l0.01,-1.04l1.14,-1.49l1.58,0.15l0.85,-1.05l1.38,0.49Z" data-code="JP" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M495.45,425.39l-1.08,-2.99l1.14,-0.11l0.64,-1.19l0.76,0.09l0.65,1.83l-2.1,2.37Z" data-code="BI" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M429.57,385.57l-0.05,0.81l0.5,1.35l-0.42,0.87l0.17,0.79l-1.82,2.14l-0.57,1.77l-0.08,5.44l-1.41,0.2l-0.48,-1.36l0.11,-5.73l-0.52,-0.7l-0.2,-1.35l-1.48,-1.49l0.22,-0.91l0.89,-0.43l0.42,-0.93l1.27,-0.36l1.22,-1.35l0.61,-0.0l1.62,1.25Z" data-code="BJ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M650.32,342.67l0.85,0.75l-0.12,1.18l-3.76,-0.12l-1.57,0.41l-1.93,-0.91l1.49,-2.09l1.12,-0.6l1.62,0.6l1.33,0.09l0.98,0.68Z" data-code="BT" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M228.38,368.9l-0.8,0.41l-2.27,-1.09l0.84,-0.25l2.14,0.31l1.18,0.59l-1.09,0.03Z" data-code="JM" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M483.92,460.24l2.27,4.08l2.83,2.92l0.96,0.32l0.77,2.5l2.13,0.63l1.04,0.8l-3.01,1.7l-2.32,2.09l-1.54,2.79l-1.52,0.46l-0.64,2.01l-1.34,0.54l-1.84,-0.12l-1.21,-0.77l-1.36,-0.31l-1.22,0.64l-0.75,1.42l-2.31,1.98l-1.39,0.22l-0.36,-0.63l0.16,-1.82l-1.48,-2.63l-0.62,-0.44l-0.0,-7.35l2.08,-0.08l0.38,-0.4l0.07,-9.12l1.56,-0.08l3.63,-0.87l0.8,0.91l0.52,0.07l1.5,-0.97l2.2,-0.5Z" data-code="BW" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M259.98,404.95l3.24,0.7l0.65,-0.53l4.55,-1.32l1.08,-1.06l-0.02,-0.64l0.55,-0.05l0.28,0.28l-0.26,0.87l0.22,0.48l0.73,0.32l0.4,0.81l-0.62,0.86l-0.4,2.13l0.82,2.56l1.69,1.43l1.43,0.2l3.17,-1.68l3.18,0.3l0.65,-0.75l-0.27,-0.92l1.9,-0.09l2.39,0.99l1.06,-0.61l0.84,0.78l1.2,-0.18l1.18,-1.06l0.84,-1.94l1.36,-2.11l0.37,-0.05l1.89,5.46l1.33,0.59l0.05,1.28l-1.77,1.94l0.02,0.56l1.02,0.87l4.07,0.36l0.08,2.16l0.66,0.29l1.74,-1.5l6.97,2.32l1.02,1.22l-0.35,1.18l0.49,0.5l2.81,-0.74l4.77,1.3l3.75,-0.08l3.57,2.0l3.29,2.86l1.93,0.73l2.12,0.12l0.71,0.62l1.21,4.52l-0.95,4.0l-4.72,5.09l-1.64,2.95l-1.72,2.07l-0.8,0.3l-0.72,2.05l0.18,4.81l-0.94,5.62l-0.81,1.15l-0.43,3.44l-2.55,3.58l-0.4,2.59l-1.86,1.08l-0.67,1.57l-2.54,0.01l-3.94,1.05l-1.83,1.24l-2.87,0.85l-3.03,2.27l-2.2,2.92l-0.36,2.08l0.4,1.64l-0.45,2.73l-0.52,1.26l-1.77,1.62l-2.75,5.05l-3.83,3.63l-1.23,2.92l-1.18,1.22l-0.37,-0.92l0.96,-1.23l0.01,-0.48l-1.52,-2.09l-4.56,-3.52l-1.03,-0.01l-2.38,-2.13l-0.85,0.0l5.38,-5.77l3.77,-2.69l0.21,-2.55l-1.34,-1.86l-0.92,0.07l0.59,-2.44l0.01,-1.59l-1.11,-0.85l-1.75,0.31l-0.44,-3.22l-0.52,-0.97l-1.88,-0.9l-1.24,0.48l-2.17,-0.43l0.15,-3.31l-0.63,-1.37l0.67,-0.74l-0.22,-1.37l0.66,-1.16l0.44,-2.08l-0.61,-1.86l-1.4,-0.87l-0.2,-0.77l0.34,-1.41l-0.38,-0.49l-4.52,-0.1l-0.72,-2.27l0.59,-0.42l-0.03,-1.12l-0.5,-0.87l-0.32,-1.71l-1.45,-0.76l-1.63,-0.02l-1.05,-0.73l-1.6,-0.48l-1.13,-1.0l-2.69,-0.41l-2.47,-2.08l0.13,-4.38l-0.45,-0.45l-3.46,0.5l-3.44,1.95l-0.6,0.74l-2.89,-0.17l-1.47,0.42l-0.72,-0.18l0.15,-3.54l-0.64,-0.34l-1.94,1.42l-1.87,-0.06l-0.83,-1.19l-1.38,-0.27l0.21,-1.01l-1.35,-1.5l-0.88,-1.92l0.56,-0.6l-0.0,-0.81l1.29,-0.62l0.22,-0.43l-0.22,-1.19l0.61,-0.91l0.15,-0.99l2.65,-1.58l1.99,-0.47l0.42,-0.36l2.06,0.11l0.42,-0.33l1.19,-8.0l-0.41,-1.56l-1.1,-1.0l0.01,-1.33l1.91,-0.42l0.08,-0.96l-0.33,-0.43l-1.14,-0.2l-0.02,-0.83l4.47,0.05l0.82,-0.67l0.82,1.81l0.8,0.07l1.15,1.1l2.26,-0.05l0.71,-0.83l2.78,-0.96l0.48,-1.13l1.6,-0.64l0.24,-0.47l-0.48,-0.83l-1.83,-0.19l-0.36,-3.22Z" data-code="BR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M227.69,345.88l0.0,-0.01l0.0,0.0l-0.0,0.01ZM226.4,353.1l-0.48,-1.18l-0.85,-0.78l0.36,-1.17l0.95,2.03l0.01,1.1ZM225.65,345.38l-1.96,0.32l-0.04,-0.26l0.74,-0.14l1.26,0.08Z" data-code="BS" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M493.82,245.43l0.3,0.93l0.53,0.25l1.16,-0.47l2.08,0.9l0.2,1.73l-0.48,1.43l1.57,2.82l0.93,0.75l0.13,0.97l1.58,0.7l0.48,0.74l-0.6,0.57l-1.85,-0.13l-0.76,0.48l-0.12,0.47l1.08,3.5l-1.96,0.33l-0.87,1.12l-0.12,1.49l-0.67,-0.22l-2.03,0.17l-0.52,-0.75l-0.57,-0.09l-0.72,0.54l-0.9,-0.5l-1.91,-0.08l-2.74,-0.95l-2.61,-0.34l-2.01,0.09l-1.52,1.11l-0.65,0.08l-0.07,-1.5l-0.64,-1.57l1.4,-1.01l0.01,-1.65l-0.7,-1.69l-0.08,-1.37l2.2,-0.03l2.72,-1.61l0.73,-2.54l2.1,-1.69l-0.2,-1.69l3.82,-2.26l2.27,0.97Z" data-code="BY" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M198.03,374.09l0.1,-4.57l0.69,-0.06l0.74,-1.32l0.34,0.28l-0.4,1.33l0.17,0.59l-0.34,2.3l-1.3,1.44Z" data-code="BZ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M491.5,228.55l2.65,-2.55l-0.01,-0.58l-2.35,-2.15l7.46,-9.43l1.0,-2.89l-0.09,-0.41l-3.55,-3.64l0.93,-3.78l-2.18,-4.19l1.62,-5.27l-2.85,-6.95l2.24,-4.74l-0.06,-0.43l-3.73,-4.33l0.33,-4.4l1.87,-0.61l4.26,-2.85l2.35,-2.28l3.83,4.05l6.96,1.77l9.34,7.63l1.83,2.99l0.16,4.03l-2.62,3.11l-3.84,1.55l-11.03,-4.69l-2.16,0.81l-0.14,0.63l3.99,4.45l0.31,8.71l5.34,3.55l0.64,-0.27l0.32,-2.78l-1.43,-2.53l1.23,-1.72l5.74,3.47l0.43,-0.01l2.11,-1.42l0.15,-0.48l-1.59,-4.12l5.51,-5.69l1.99,0.31l2.25,2.09l0.65,-0.16l1.46,-4.3l-2.03,-4.0l1.18,-3.78l-1.5,-3.67l5.98,1.86l1.2,3.14l-2.74,0.7l-0.3,0.39l0.02,3.61l2.07,2.45l0.43,0.11l3.87,-1.38l0.85,-4.25l13.69,-8.82l1.16,0.21l-2.17,3.65l0.26,0.59l3.11,0.7l0.4,-0.14l1.68,-2.16l4.51,-0.18l3.61,-2.68l2.61,3.78l0.67,-0.02l2.85,-4.55l-0.0,-0.43l-2.5,-3.89l1.03,-1.89l7.03,2.08l3.39,2.18l9.05,7.85l0.62,-0.13l1.64,-3.95l-2.48,-3.58l-0.07,-1.39l-0.31,-0.37l-2.62,-0.61l0.73,-3.21l-1.33,-5.76l-0.07,-2.28l4.55,-7.04l1.67,-7.53l1.59,-1.44l6.17,2.09l0.48,4.29l-2.34,6.42l1.55,2.76l0.79,5.18l-0.57,9.85l2.73,4.33l-1.02,4.26l-4.88,9.07l0.23,0.57l2.86,0.92l0.49,-0.22l0.94,-2.13l2.83,-1.82l0.65,-3.1l2.12,-3.05l-1.37,-4.06l1.14,-4.42l-0.31,-0.49l-2.47,-0.52l-0.55,-3.59l1.95,-7.61l-3.13,-6.05l4.31,-5.2l-0.45,-5.83l0.53,-0.08l1.2,4.22l-0.98,7.66l0.21,0.4l2.68,1.42l0.58,-0.43l-1.09,-5.45l3.9,-2.98l4.9,-0.41l4.5,4.5l0.49,0.06l0.17,-0.47l-2.21,-6.76l-0.24,-8.85l4.01,-1.66l5.93,0.39l5.54,-1.19l0.28,-0.55l-1.97,-4.64l2.73,-5.9l2.89,-0.36l4.78,-4.84l6.49,-1.33l1.07,-2.85l6.11,-0.9l1.91,2.17l0.58,0.02l5.5,-5.45l4.43,0.17l0.41,-0.34l0.68,-4.62l2.32,-4.63l5.58,-4.48l3.69,3.23l-3.04,2.5l0.14,0.69l5.42,1.64l0.64,5.13l0.7,0.21l2.17,-2.49l6.98,0.14l5.48,5.07l1.92,3.72l-0.59,4.98l-2.66,2.78l-6.56,5.27l-1.96,2.84l0.18,0.6l3.08,1.27l3.68,2.26l0.45,-0.02l1.76,-1.33l1.14,5.11l0.34,0.31l0.41,-0.22l1.03,-2.14l3.75,-1.32l7.65,1.4l0.57,3.81l0.35,0.34l10.47,1.28l0.45,-0.39l0.13,-6.16l4.81,1.41l3.93,-0.03l3.85,4.37l1.1,5.17l-1.42,3.65l3.15,6.24l4.05,3.25l0.63,-0.2l2.24,-7.6l3.55,3.15l0.44,0.06l4.09,-2.03l4.67,2.34l0.49,-0.1l1.68,-2.01l3.85,1.04l0.49,-0.48l-1.76,-7.3l3.0,-3.3l22.19,5.31l2.15,4.74l6.55,5.95l10.36,-1.34l4.76,1.21l1.93,2.89l-0.3,5.24l3.26,2.4l3.66,-1.4l4.3,-0.18l4.84,1.4l4.5,-0.75l4.22,6.04l0.56,0.1l3.1,-2.22l0.13,-0.49l-1.96,-4.39l0.94,-2.74l7.63,1.95l5.23,-0.41l7.05,3.36l9.59,8.27l6.43,6.42l-0.21,3.79l1.82,1.88l0.45,0.06l0.21,-0.41l-0.52,-4.08l6.13,0.86l4.58,5.48l-2.15,2.3l-3.97,0.6l-0.34,0.39l-0.06,5.64l-0.78,0.94l-1.98,-0.15l-1.91,-1.99l-3.16,-1.63l-0.77,-2.69l-2.54,-0.99l-2.81,0.69l-1.11,-1.73l0.5,-2.12l-0.56,-0.45l-3.0,1.46l-0.2,0.51l1.06,2.68l-1.31,2.33l-3.03,2.42l-3.08,-0.41l-0.37,0.63l2.22,3.03l1.47,4.59l1.16,1.53l0.26,2.04l-0.46,1.02l-4.64,-1.05l-6.95,4.01l-2.18,0.6l-7.62,6.88l-0.81,1.88l-3.15,-3.07l-0.49,-0.06l-6.18,3.75l-0.93,-1.52l-0.61,-0.09l-2.26,2.01l-3.15,-0.64l-0.47,0.3l-0.79,3.18l-3.03,4.85l0.09,1.91l0.26,0.36l2.58,0.95l-0.3,6.03l-1.97,0.14l-0.36,0.29l-1.07,3.72l0.87,1.82l-4.01,2.02l-1.04,4.88l-3.49,0.95l-0.29,0.32l-0.73,4.06l-3.07,3.18l-0.71,-2.11l-2.45,-15.41l1.17,-6.06l2.06,-2.67l0.2,-2.12l3.83,-1.13l4.47,-6.06l4.28,-5.09l4.48,-4.07l2.13,-7.67l-0.45,-0.5l-3.36,0.72l-1.47,4.3l-5.81,5.21l-1.86,-5.8l-0.49,-0.26l-6.68,1.94l-6.27,8.55l-0.01,0.46l1.74,2.54l-8.37,1.57l0.16,-3.05l-0.32,-0.41l-3.89,-0.75l-3.3,2.39l-7.61,-0.82l-8.47,1.58l-17.7,19.78l0.24,0.67l3.73,0.52l1.14,2.49l2.65,1.15l0.46,-0.13l1.47,-1.95l2.35,0.24l3.43,4.41l0.08,3.28l-1.96,4.11l-0.21,4.69l-1.11,6.02l-3.72,5.32l-0.87,2.56l-8.3,10.17l-3.18,1.92l-1.29,0.04l-1.45,-1.54l-0.53,-0.05l-2.48,1.84l0.28,-0.27l0.36,-4.08l-0.6,-2.85l1.77,-1.03l2.89,0.6l0.44,-0.22l1.71,-3.57l0.84,-3.92l0.97,-1.37l1.32,-3.37l-0.48,-0.53l-4.14,1.11l-2.19,1.46l-3.38,-0.0l-1.05,-3.43l-2.97,-2.72l-4.29,-1.26l-1.76,-6.1l-2.63,-6.06l-2.3,-1.58l-3.75,-1.25l-3.46,0.09l-3.19,0.77l-2.26,2.18l0.05,0.61l1.21,0.86l0.03,1.88l-1.34,1.28l-2.26,4.23l-0.03,1.71l-3.16,2.2l-2.8,-1.36l-3.02,0.27l-1.18,-1.17l-1.68,-0.52l-3.94,2.75l-3.21,0.62l-2.27,0.93l-3.04,-0.6l-2.21,0.03l-1.47,-1.89l-2.61,-1.95l-2.65,-0.52l-5.44,1.21l-3.23,-1.49l-0.71,-3.08l-5.2,-1.5l-2.75,-1.64l-0.54,0.13l-2.59,4.17l0.89,2.46l-2.1,2.34l-3.38,-0.91l-2.42,-0.14l-1.85,-1.84l-2.51,-0.06l-2.46,-1.17l-3.86,1.89l-4.72,3.31l-3.26,0.87l-1.17,-2.07l-0.41,-0.2l-2.97,0.48l-1.1,-1.58l-1.62,-0.7l-1.31,-2.32l-1.38,-0.72l-3.71,0.94l-3.3,-2.2l-0.56,0.12l-0.97,1.52l-5.27,-9.77l-3.03,-3.13l0.73,-1.08l-0.04,-0.5l-0.5,-0.06l-6.2,3.97l-1.82,0.18l0.16,-1.83l-0.23,-0.4l-3.22,-1.46l-2.47,0.85l-0.7,-4.0l-0.31,-0.32l-4.5,-0.95l-2.52,1.84l-6.18,1.58l-1.3,1.08l-9.51,1.62l-1.15,1.45l-0.03,0.46l1.56,2.48l-1.98,0.89l-0.21,0.52l0.35,0.85l-2.18,1.8l0.03,0.64l3.81,2.6l-0.44,1.31l-3.21,-0.16l-0.87,1.02l-3.08,-1.9l-3.97,0.08l-2.66,1.61l-8.29,-4.28l-4.1,0.06l-5.42,4.44l-0.37,2.36l-2.0,-1.76l-0.63,0.13l-2.0,4.27l0.61,1.02l-1.32,2.63l0.05,0.44l2.13,2.54l1.95,0.05l1.39,2.15l-0.23,1.74l1.12,0.83l-0.86,1.61l-2.49,0.71l-2.49,3.66l0.0,0.45l2.19,3.19l-0.16,2.44l2.54,3.7l-1.62,1.81l-0.67,-0.14l-1.63,-1.93l-2.29,-0.94l-0.94,-1.47l-2.34,-0.71l-1.48,0.44l-0.42,-0.51l-3.52,-1.68l-5.76,-1.14l-0.47,0.2l-2.87,-2.64l-2.9,-1.36l-1.63,-1.56l1.39,-0.52l2.08,-3.01l-0.04,-0.51l-0.98,-1.01l3.14,-1.27l0.25,-0.4l-0.07,-0.8l-0.5,-0.35l-1.72,0.45l0.04,-0.92l1.06,-0.85l2.31,-0.26l0.34,-0.28l0.4,-1.47l-0.51,-1.94l0.95,-1.86l0.01,-1.32l-0.27,-0.37l-3.69,-1.26l-1.41,0.02l-1.42,-1.68l-0.43,-0.12l-1.78,0.57l-2.78,-1.21l-0.01,-0.71l-0.89,-1.73l-2.01,-0.38l-0.13,-0.77l0.53,-1.15l-1.6,-2.31l-3.58,0.03l-0.92,0.88l-0.42,-0.07l-1.05,-3.54l2.29,-0.07l0.97,-0.92l0.06,-0.51l-0.9,-1.27l-1.4,-0.62l-0.06,-0.85l-0.95,-0.73l-1.43,-2.57l0.49,-1.21l-0.25,-2.07l-2.69,-1.38l-1.22,0.37l-0.45,-0.94l-2.46,-1.05l-0.74,-2.46l-0.21,-2.19l-1.07,-1.09l0.93,-1.49l-0.72,-4.29l1.7,-2.67l-0.24,-0.98ZM749.34,295.94l-0.76,0.56l-0.11,0.15l-0.01,-0.65l0.87,-0.06ZM871.96,154.57l2.04,-0.2l3.29,2.04l-0.13,0.64l-2.37,1.7l-5.54,0.79l-0.34,-1.85l3.05,-3.11ZM797.75,123.25l-2.42,3.18l-3.66,-0.78l-4.39,-3.6l0.47,-2.52l10.01,3.72ZM783.79,118.53l-1.81,6.68l-8.92,-0.26l-4.06,2.13l-4.64,-5.86l1.28,-6.57l3.04,-1.79l6.39,0.44l8.71,5.22ZM778.23,253.99l-0.64,-1.28l0.31,-0.17l0.33,1.45ZM778.36,254.55l0.92,4.28l-0.05,4.08l1.05,4.08l2.23,6.09l-2.91,-0.99l-0.51,0.27l-1.54,5.47l2.42,4.01l-0.04,1.39l-1.22,-1.41l-0.65,0.06l-1.07,1.83l-0.29,-1.88l0.28,-3.61l-0.28,-4.01l0.58,-2.92l0.11,-5.24l-1.46,-4.02l0.21,-5.38l2.23,-2.09ZM780.09,139.86l-3.31,0.05l-5.09,-1.07l2.11,-3.11l2.77,-0.74l3.29,3.15l0.23,1.71ZM683.7,87.54l-13.17,4.38l4.34,-15.76l1.75,-1.29l1.59,0.74l6.17,7.25l-0.68,4.69ZM670.82,80.26l-5.03,1.48l-6.76,-3.64l-4.04,-4.98l-1.9,-10.03l-3.29,-2.93l6.28,-10.21l5.0,-3.39l4.63,7.67l5.72,14.22l-0.6,11.8ZM564.4,160.28l-0.92,0.41l-7.78,-0.94l-0.83,-3.41l-4.32,-2.0l-0.33,-3.85l2.54,-1.96l-0.08,-4.42l4.9,-7.29l-0.16,-0.58l-1.86,-0.88l5.7,-7.68l-0.57,-4.44l5.43,-5.07l8.18,-6.55l8.25,-1.96l4.4,-4.05l4.43,-1.3l1.54,3.81l-1.55,3.04l-16.43,9.84l-7.93,9.27l-7.69,17.13l0.59,6.93l4.49,5.95ZM548.68,56.87l-5.47,3.05l-0.54,2.57l-2.49,2.05l-2.33,-2.98l1.37,-4.49l-0.35,-0.52l-4.3,-0.36l3.7,-2.13l3.34,-0.17l0.47,3.78l0.35,0.35l0.42,-0.25l1.41,-3.62l2.04,-2.24l3.21,2.97l-0.81,1.96ZM477.39,251.71l-4.1,0.06l-2.6,-0.41l0.38,-1.28l3.15,-1.29l3.25,1.22l-0.09,1.7Z" data-code="RU" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element" cursor="pointer"></path><path d="M497.0,418.15l0.71,1.01l-0.11,1.09l-1.63,0.03l-1.04,1.39l-0.83,-0.11l0.51,-1.2l0.08,-1.34l0.42,-0.41l0.7,0.14l1.19,-0.61Z" data-code="RW" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M469.33,288.43l0.49,-1.17l-1.2,-1.97l1.47,-0.73l1.3,0.13l1.18,1.23l0.45,1.29l1.35,0.74l0.34,1.53l1.46,1.02l0.76,-0.3l0.25,0.82l-0.51,0.87l0.22,1.27l1.08,1.41l-0.8,0.94l-0.38,1.72l-1.22,0.09l0.27,-0.81l-2.46,-2.38l-0.93,0.06l-0.47,1.05l-2.15,-1.58l0.57,-1.85l-1.13,-1.51l0.53,-1.32l-0.49,-0.55Z" data-code="RS" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M734.55,437.87l-0.09,-0.98l4.5,-0.86l-2.82,1.28l-1.59,0.55Z" data-code="TL" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M553.03,299.38l-0.05,0.44l-0.1,-0.29l0.15,-0.15ZM555.85,298.15l0.46,-0.11l1.47,0.82l2.08,2.72l4.07,-0.21l0.38,-0.49l-0.34,-1.39l1.95,-1.07l1.9,-1.78l2.93,1.56l0.41,2.75l1.21,0.76l2.57,-0.15l0.62,0.45l1.32,3.46l4.54,3.8l2.67,1.6l3.07,1.26l-0.04,1.22l-1.32,-0.81l-0.61,0.19l-0.32,0.93l-2.19,0.86l-0.47,2.34l-1.21,0.81l-1.91,0.45l-0.73,1.44l-1.54,0.33l-2.22,-1.01l-0.2,-2.37l-0.37,-0.37l-1.72,-0.1l-2.76,-2.67l-2.14,-0.44l-2.84,-1.62l-1.78,-0.29l-1.25,0.58l-1.56,-0.09l-2.01,1.85l-1.69,0.47l-0.37,-1.75l0.36,-3.28l-0.2,-0.39l-1.68,-0.94l0.55,-1.92l-0.34,-0.51l-1.23,-0.14l0.38,-1.9l2.23,0.64l2.2,-1.06l0.12,-0.63l-1.77,-1.94l-0.69,-1.85Z" data-code="TM" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M597.8,305.02l-0.08,0.09l-2.5,-0.5l-0.48,0.34l-0.24,1.88l0.43,0.45l2.63,-0.24l3.18,1.04l4.38,-0.45l0.56,2.63l0.54,0.29l0.66,-0.26l1.12,0.54l0.21,2.4l-3.76,-0.23l-1.81,1.45l-1.74,0.8l-0.62,-0.64l0.22,-2.47l-0.65,-0.49l-0.04,-1.02l-1.36,-0.73l-0.48,0.07l-1.08,1.11l-0.54,1.62l-1.3,-0.06l-0.96,1.26l-0.91,-0.37l-1.63,0.91l-0.24,-0.12l1.28,-3.1l-0.54,-2.38l-1.69,-0.89l0.36,-0.8l2.18,-0.05l1.19,-1.8l0.76,-1.99l2.44,-0.56l-0.28,1.13l0.36,0.91l0.43,0.25Z" data-code="TJ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M487.52,276.99l0.59,0.28l2.89,4.68l-0.18,3.12l0.45,1.64l1.3,0.9l1.37,-0.47l0.76,0.41l0.03,0.46l-0.83,0.52l-0.57,-0.25l-0.55,0.3l-0.63,3.8l-0.98,-0.24l-2.1,-1.28l-2.95,0.81l-1.25,0.86l-3.49,-0.17l-1.88,-0.53l-0.87,0.17l-0.86,-1.54l0.34,-0.35l-0.05,-0.61l-0.62,-0.44l-0.51,0.04l-0.55,0.55l-1.04,-0.73l-0.17,-1.29l-1.58,-1.05l-0.34,-1.15l-0.92,-0.96l1.63,-0.65l2.66,-4.89l2.39,-1.44l2.93,0.39l1.06,0.83l0.47,0.02l0.79,-0.53l1.77,-0.34l0.76,-0.87l0.76,0.0Z" data-code="RO" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M386.23,383.41l-0.29,0.84l0.15,0.61l-2.21,0.6l-0.86,0.96l-1.04,-0.83l-1.09,-0.23l-0.54,-1.07l-0.66,-0.5l2.41,-0.49l4.13,0.1Z" data-code="GW" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M195.08,379.54l-2.48,-0.37l-1.03,-0.46l-1.14,-0.9l0.3,-1.01l-0.24,-0.68l0.96,-1.69l2.98,-0.01l0.4,-0.37l-0.19,-1.29l-1.68,-1.44l0.53,-0.4l0.0,-1.08l3.85,0.02l-0.21,4.61l0.4,0.43l1.48,0.38l-1.5,1.01l-0.34,0.71l0.12,0.57l-2.2,1.98Z" data-code="GT" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M487.09,300.31l-0.62,1.67l-0.37,0.23l-2.84,-0.38l-3.03,0.86l-0.18,0.66l1.34,1.43l-0.67,0.28l-1.12,0.0l-1.2,-1.54l-0.65,0.03l-0.52,1.05l0.56,1.95l1.06,1.34l-0.61,0.46l-0.05,0.59l2.53,2.34l0.02,1.02l-1.77,-0.64l-0.5,0.54l0.53,1.16l-1.1,0.23l-0.3,0.52l0.77,2.24l-0.99,0.02l-1.84,-1.22l-1.37,-4.59l-2.21,-3.25l-0.12,-0.67l1.06,-1.44l0.2,-1.06l0.84,-0.7l0.03,-0.55l1.33,-0.24l1.01,-0.71l1.21,0.06l0.67,-0.62l2.26,-0.01l1.8,-0.83l1.85,1.11l2.28,-0.31l0.35,-0.39l0.01,-0.9l0.35,0.26ZM480.49,319.61l0.67,0.51l-0.8,-0.16l0.13,-0.35ZM482.3,320.35l2.74,0.05l0.29,0.4l-2.04,0.15l-0.32,-0.47l-0.67,-0.13Z" data-code="GR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M448.79,409.52l0.02,2.22l-4.09,0.0l0.69,-2.27l3.38,0.05Z" data-code="GQ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M277.42,399.96l-0.32,1.83l-1.32,0.57l-0.23,0.46l-0.28,2.01l1.11,1.82l0.83,0.19l0.32,1.25l1.13,1.62l-1.21,-0.19l-1.08,0.71l-1.77,0.5l-0.44,0.46l-0.86,-0.09l-1.32,-1.01l-0.77,-2.27l0.36,-1.91l0.68,-1.23l-0.57,-1.17l-0.74,-0.43l0.12,-1.16l-0.9,-0.69l-1.1,0.09l-1.31,-1.48l0.53,-0.72l-0.04,-0.84l1.99,-0.86l0.05,-0.59l-0.71,-0.78l0.14,-0.57l1.66,-1.24l1.36,0.77l1.41,1.5l0.06,1.15l0.37,0.38l0.8,0.05l2.06,1.87Z" data-code="GY" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M521.61,293.9l5.38,1.03l3.26,1.57l0.84,0.7l1.39,-0.49l2.05,0.63l0.69,1.25l1.15,0.65l-0.2,0.63l1.05,1.54l-1.06,-0.15l-1.81,-0.93l-0.97,0.52l-3.21,0.48l-2.28,-1.55l-2.37,0.06l0.23,-1.11l-0.75,-2.51l-1.45,-1.26l-1.43,-0.44l-0.53,-0.61Z" data-code="GE" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M412.72,233.04l-2.32,4.44l0.45,0.57l2.5,-0.63l2.22,0.02l-0.56,3.24l-2.22,4.0l0.31,0.59l2.36,0.26l2.34,5.43l1.76,0.84l2.21,6.35l2.96,0.93l-0.25,2.13l-1.17,1.09l-0.09,0.47l0.87,1.82l-1.92,1.78l-3.29,-0.02l-4.09,1.04l-1.02,-0.68l-0.52,0.07l-1.5,1.67l-2.09,-0.4l-1.88,1.4l-0.67,-0.39l3.29,-3.71l2.15,-0.83l0.25,-0.41l-0.33,-0.35l-3.72,-0.64l-0.47,-1.06l2.27,-1.1l0.17,-0.57l-1.29,-2.09l0.39,-2.22l3.35,0.34l0.44,-0.34l0.37,-2.46l-1.77,-2.98l-3.1,-0.89l-0.43,-0.84l0.8,-2.18l-0.82,-1.22l-0.67,0.01l-0.66,1.02l-0.1,-3.02l-1.24,-2.37l0.87,-4.6l1.78,-3.54l1.83,0.33l2.26,-0.3ZM406.3,251.21l-1.06,2.32l-1.53,-0.71l-1.21,0.0l0.4,-1.97l-0.42,-1.89l1.46,-0.13l2.36,2.36Z" data-code="GB" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M453.24,409.42l-0.08,0.98l0.7,1.29l2.36,0.24l-0.98,2.63l1.18,1.79l0.25,1.78l-0.29,1.52l-0.6,0.93l-1.84,-0.09l-1.23,-1.11l-0.66,0.23l-0.15,0.84l-1.42,0.26l-1.02,0.7l-0.11,0.52l0.77,1.35l-1.34,0.98l-3.94,-4.31l-1.44,-2.45l0.06,-0.6l0.54,-0.81l1.05,-3.46l4.17,-0.07l0.4,-0.4l-0.02,-2.66l2.39,0.21l1.25,-0.27Z" data-code="GA" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M391.8,383.91l0.47,0.81l1.11,-0.32l0.98,0.71l1.07,0.2l2.26,-1.23l0.63,0.44l1.13,1.58l-0.48,1.41l0.8,0.3l-0.08,0.48l0.46,0.69l-0.35,1.37l1.05,2.63l-1.0,0.69l0.03,1.42l-0.72,-0.06l-1.07,1.01l-0.24,-0.27l0.07,-1.11l-1.05,-1.55l-0.49,-0.14l-1.3,0.36l-0.35,-2.01l-1.6,-2.19l-2.0,-0.0l-1.31,0.54l-1.95,2.19l-1.86,-2.2l-1.2,-0.78l-0.3,-1.12l-0.8,-0.86l0.65,-0.73l0.81,-0.03l1.64,-0.8l0.23,-1.88l2.67,0.64l0.89,-0.31l1.21,0.15Z" data-code="GN" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M379.31,381.18l0.1,-0.36l2.43,-0.07l0.74,-0.62l0.5,-0.03l0.83,0.53l-1.08,-0.33l-1.87,0.91l-1.65,-0.04ZM384.0,380.68l0.95,0.06l0.76,-0.23l-0.59,0.32l-1.11,-0.15Z" data-code="GM" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M352.9,3.19l15.35,16.28l-4.35,6.99l-9.4,0.81l-13.48,1.81l-0.32,0.54l1.26,3.26l0.46,0.25l8.67,-1.96l7.39,6.05l0.55,-0.04l4.4,-4.95l1.83,5.61l-2.72,9.68l0.18,0.45l0.48,-0.06l6.34,-6.15l11.94,-6.62l7.14,3.24l1.33,6.85l-10.07,11.17l-1.42,3.42l-7.83,2.5l-0.28,0.42l0.35,0.36l5.33,0.65l-2.8,9.83l-2.03,8.69l0.08,13.63l2.84,7.11l-3.6,0.49l-4.12,3.47l-0.05,0.56l4.54,5.53l0.56,8.17l-2.39,0.81l-0.24,0.53l3.05,7.7l-5.05,0.6l-0.27,0.64l2.78,3.54l-0.72,2.75l-3.27,1.26l-3.42,0.02l-0.35,0.59l3.09,5.7l0.03,2.82l-4.32,-2.99l-0.57,0.13l-1.29,2.22l0.14,0.54l3.3,2.0l3.18,4.75l0.88,5.79l-3.85,1.25l-4.86,-7.12l-0.48,-0.14l-0.24,0.44l0.83,5.08l-2.81,3.81l0.3,0.64l9.17,0.61l-6.07,5.68l-6.74,5.42l-7.2,2.3l-2.98,0.14l-2.66,2.67l-3.44,6.75l-5.23,4.25l-1.73,0.27l-7.11,3.08l-2.15,3.69l-0.09,4.21l-1.22,3.58l-4.03,4.36l0.89,4.48l-2.31,8.95l-3.05,0.26l-3.56,-4.0l-5.12,-0.16l-2.26,-2.64l-1.69,-5.21l-4.31,-6.82l-1.24,-3.62l-0.4,-5.4l-3.39,-5.47l0.87,-4.47l-1.62,-2.41l2.37,-7.41l3.81,-2.67l1.01,-3.01l0.52,-5.6l-0.22,-0.39l-0.45,0.06l-4.16,3.58l-1.99,0.9l-2.73,-2.07l-0.16,-4.72l0.9,-3.66l1.94,-0.09l5.03,1.98l0.47,-0.14l-0.03,-0.49l-6.54,-7.53l-0.47,-0.11l-2.25,1.0l-1.7,-1.6l2.69,-7.67l-1.51,-3.12l-4.99,-15.74l-3.17,-3.76l-0.11,-4.29l-6.93,-6.07l-5.4,-0.76l-12.62,1.16l-2.75,-3.16l-4.1,-6.46l6.13,-3.31l4.96,-0.6l0.35,-0.37l-0.29,-0.42l-10.63,-2.99l-5.42,-4.66l0.32,-4.37l9.32,-6.03l9.34,-6.65l0.97,-5.04l-0.15,-0.39l-6.52,-4.97l2.06,-5.6l8.57,-10.89l3.56,-1.73l0.22,-0.41l-1.01,-7.43l5.7,-4.5l7.58,-2.82l7.37,-0.16l2.62,5.4l0.69,0.04l6.35,-9.67l5.63,6.55l3.58,1.5l5.14,5.66l0.54,0.05l0.1,-0.53l-5.89,-9.52l0.33,-7.89l8.21,-11.86l8.55,0.93l0.41,-0.25l3.12,-7.8l8.58,-2.09l19.79,2.78Z" data-code="GL" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M420.53,387.35l-0.01,0.72l0.96,1.2l0.24,3.75l0.59,0.95l-0.51,2.1l0.19,1.41l1.02,2.22l-6.97,2.85l-1.8,-0.57l0.04,-0.89l-1.02,-2.04l0.61,-2.66l1.07,-2.33l-0.96,-6.5l5.01,0.07l0.94,-0.39l0.61,0.11Z" data-code="GH" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M568.09,360.37l-0.91,1.71l-1.22,0.04l-0.59,0.78l-0.41,1.53l0.26,1.63l-1.16,0.05l-1.56,0.99l-0.76,1.78l-1.62,0.05l-0.98,0.66l-0.17,1.17l-0.89,0.53l-1.49,-0.18l-2.4,0.95l-2.48,-5.51l7.35,-2.77l1.67,-5.36l-1.12,-2.14l0.05,-0.87l0.67,-1.04l0.07,-1.08l0.91,-0.43l-0.05,-2.14l0.7,-0.01l1.01,1.68l1.51,1.12l3.3,0.87l1.73,2.37l0.81,0.38l-1.23,2.44l-0.99,0.81ZM561.83,347.23l-0.0,-0.01l0.01,-0.01l-0.0,0.02Z" data-code="OM" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M448.18,315.32l-1.08,1.46l-0.02,1.43l0.84,0.93l-0.29,2.3l-1.65,1.83l0.48,1.65l1.41,0.33l0.53,1.2l0.9,0.55l-0.11,1.83l-3.54,2.81l-0.09,2.52l-0.58,0.32l-0.96,-4.72l-1.54,-1.32l-0.15,-0.82l-1.93,-1.68l-0.19,-1.93l1.52,-1.74l0.59,-2.52l-0.38,-3.0l0.43,-1.35l2.45,-1.14l1.29,0.28l-0.06,1.25l0.59,0.37l1.54,-0.84Z" data-code="TN" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M518.65,329.54l-5.15,1.67l-0.19,0.64l2.19,2.56l-0.58,0.44l-0.33,0.78l-1.71,0.36l-1.71,1.89l-2.34,-0.38l1.21,-4.6l0.56,-4.33l2.81,0.99l4.45,-2.88l0.8,2.87Z" data-code="JO" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M455.59,286.98l1.42,0.1l0.57,-0.46l0.74,0.44l0.98,0.07l0.43,-0.4l-0.01,-0.73l0.86,-0.57l0.21,-1.25l1.62,-0.78l2.55,1.93l2.07,0.69l0.88,-0.35l1.09,1.85l-0.56,0.77l-1.05,-0.63l-1.67,0.05l-2.1,-0.57l-1.3,0.07l-0.58,0.54l-0.57,-0.52l-0.65,0.16l-0.47,1.84l1.79,2.75l2.11,2.07l0.81,1.23l-1.27,-1.06l-2.2,-0.99l-1.73,-2.1l0.2,-0.63l-1.06,-1.38l-0.31,-1.43l-1.61,-0.56l-0.49,0.2l-0.45,0.89l-0.26,-1.24Z" data-code="HR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M238.65,368.15l-1.58,-0.17l-1.19,0.44l-0.91,-0.56l0.06,-0.21l3.62,0.5ZM239.22,368.07l0.82,-0.54l0.06,-0.62l-1.02,-1.03l0.02,-0.84l-0.3,-0.39l-0.93,-0.35l3.16,0.46l0.02,1.9l-0.48,0.35l-0.07,0.58l0.54,0.74l-1.81,-0.26Z" data-code="HT" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M462.05,281.37l0.68,-1.93l-0.16,-0.54l0.71,-0.0l0.39,-0.35l0.1,-0.84l1.72,1.0l2.35,-0.43l0.43,-0.77l3.49,-0.92l0.69,-0.91l0.54,-0.15l2.55,1.09l0.69,-0.26l1.03,0.76l0.1,0.55l-1.45,0.83l-2.6,4.82l-1.79,0.61l-1.69,-0.11l-2.72,1.41l-1.83,-0.61l-2.55,-1.92l-0.7,-1.3Z" data-code="HU" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M199.6,379.29l-1.71,-1.22l0.07,-0.96l3.04,-2.17l2.37,0.29l1.27,-0.09l1.1,-0.53l1.3,0.28l1.14,-0.26l1.37,0.37l2.25,1.39l-2.37,0.95l-1.23,-0.4l-0.88,1.31l-1.28,1.0l-0.43,-0.3l-0.55,0.08l-0.42,0.53l-0.96,0.05l-0.36,0.41l0.04,0.89l-0.52,0.6l-0.3,0.04l-0.3,-0.56l-0.66,-0.32l0.12,-0.68l-0.48,-0.66l-0.63,-0.25l-0.97,0.2Z" data-code="HN" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M256.17,368.34l-0.27,0.28l-2.83,0.06l-0.07,-0.57l1.95,-0.1l1.23,0.34Z" data-code="PR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M509.06,331.4l0.27,-0.17l-0.04,0.09l-0.23,0.08ZM509.37,331.14l-0.03,-0.63l-0.35,-0.18l0.32,-1.21l0.24,0.11l-0.19,1.91Z" data-code="PS" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M401.85,314.47l-0.65,0.52l-1.11,-0.37l-0.93,0.18l0.29,-1.97l-0.24,-1.95l-1.24,-0.59l-0.47,-0.95l0.18,-1.87l1.01,-1.29l0.69,-3.25l-0.04,-1.52l-0.59,-2.16l1.29,-0.96l0.85,1.5l3.09,-0.33l0.49,1.17l-1.07,1.02l-0.03,2.43l-0.41,0.6l-0.08,1.25l-0.8,0.2l-0.26,0.57l0.93,1.79l-0.64,1.95l0.78,1.16l-1.12,1.72l0.08,1.13Z" data-code="PT" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M274.9,466.41l0.74,1.55l-0.16,3.55l0.32,0.41l2.64,0.52l1.11,-0.48l1.4,0.6l0.36,0.62l0.53,3.53l1.27,0.41l0.98,-0.39l0.52,0.28l-0.0,1.23l-1.21,5.54l-2.09,1.99l-1.8,0.41l-4.72,-1.03l2.21,-3.81l-0.32,-1.54l-2.77,-1.32l-3.03,-2.01l-2.07,-0.45l-4.34,-4.19l0.91,-2.99l0.08,-1.45l1.07,-2.09l4.13,-0.73l2.18,0.04l2.06,1.2l0.03,0.61Z" data-code="PY" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M213.79,393.56l0.26,-1.53l-0.36,-0.26l-0.01,-0.5l0.44,-0.1l0.93,1.4l1.26,0.03l0.77,0.5l1.38,-0.24l2.51,-1.12l0.86,-0.72l3.45,0.85l1.4,1.19l0.41,1.75l-0.21,0.34l-0.53,-0.12l-0.47,0.29l-0.16,0.6l-0.68,-1.28l0.45,-0.49l-0.19,-0.66l-0.47,-0.13l-0.54,-0.84l-1.5,-0.75l-1.1,0.16l-0.75,0.99l-1.62,0.84l-0.18,0.96l0.85,0.97l-0.58,0.45l-0.69,0.08l-0.34,-1.18l-1.27,0.03l-0.71,-1.05l-2.59,-0.47Z" data-code="PA" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M808.58,428.76l2.54,2.57l-0.13,0.26l-0.33,0.12l-0.87,-0.78l-1.22,-2.17ZM801.41,422.94l0.51,0.29l0.26,0.27l-0.49,-0.36l-0.28,-0.21ZM803.17,424.48l0.59,0.5l0.08,1.06l-0.29,-0.91l-0.38,-0.65ZM796.68,428.31l0.52,0.75l1.43,-0.19l2.27,-1.82l-0.01,-1.43l1.12,0.16l-0.04,1.1l-0.7,1.28l-1.12,0.18l-0.62,0.79l-2.46,1.11l-1.17,-0.0l-3.08,-1.25l3.41,0.0l0.45,-0.68ZM789.15,433.47l2.31,1.81l1.59,2.62l1.34,0.14l-0.06,0.66l0.31,0.43l1.06,0.24l0.06,0.66l2.25,1.06l-1.21,0.13l-0.72,-0.64l-4.56,-0.65l-3.22,-2.89l-1.49,-2.35l-3.27,-1.11l-2.38,0.72l-1.59,0.86l-0.2,0.42l0.27,1.56l-1.55,0.69l-1.36,-0.4l-2.21,-0.09l-0.08,-15.44l8.39,2.93l2.95,2.4l0.6,1.64l4.02,1.5l0.31,0.69l-1.76,0.21l-0.33,0.52l0.55,1.68Z" data-code="PG" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M244.97,425.11l-1.26,-0.07l-0.57,0.42l-1.93,0.45l-2.98,1.76l-0.36,1.36l-0.58,0.8l0.12,1.37l-1.24,0.6l-0.22,1.22l-0.62,0.84l1.04,2.28l1.28,1.44l-0.41,0.85l0.32,0.57l1.48,0.13l1.16,1.37l2.21,0.07l1.63,-1.08l-0.13,3.04l0.3,0.4l1.14,0.29l1.31,-0.35l1.9,3.62l-0.48,0.86l-0.17,3.89l-0.94,1.6l0.35,0.76l-0.48,1.08l0.98,2.0l-2.1,3.89l-0.97,0.51l-2.17,-1.31l-0.39,-1.18l-4.95,-2.62l-4.46,-2.82l-1.85,-1.53l-0.91,-1.87l0.3,-0.97l-2.11,-3.36l-4.82,-9.74l-1.04,-1.2l-0.87,-1.95l-3.4,-2.49l0.58,-1.18l-1.13,-2.23l0.66,-1.5l1.45,-1.15l-0.6,0.99l0.07,0.92l0.47,0.36l1.74,0.03l0.97,1.17l0.54,0.07l1.42,-1.03l0.6,-1.84l1.42,-2.02l3.04,-1.04l2.73,-2.62l0.86,-1.74l-0.1,-1.87l1.44,1.02l0.9,1.25l1.06,0.59l1.7,2.73l1.86,0.31l1.45,-0.61l0.96,0.39l1.36,-0.19l1.45,0.89l-1.4,2.21l0.31,0.61l0.59,0.05l0.47,0.5Z" data-code="PE" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M615.13,319.81l-1.88,2.0l-2.59,0.42l-3.73,-0.73l-1.6,1.43l-0.09,0.4l1.77,4.7l1.73,1.32l-1.73,1.38l-0.11,2.26l-2.34,2.8l-1.59,2.95l-2.46,2.8l-3.03,-0.07l-2.76,2.96l0.05,0.59l1.51,1.16l0.26,1.98l1.44,1.55l0.37,1.77l-5.02,-0.01l-1.78,1.76l-1.41,-0.53l-0.76,-1.94l-2.27,-2.23l-11.61,0.89l0.72,-2.47l3.43,-1.37l0.25,-0.43l-0.21,-1.29l-1.2,-0.67l-0.28,-2.57l-2.29,-1.2l-1.32,-2.09l2.85,1.0l2.62,-0.4l1.42,0.35l0.77,-0.59l1.71,0.2l3.25,-1.2l0.26,-0.36l0.08,-2.33l1.19,-1.41l1.68,0.0l0.58,-0.87l1.59,-0.32l1.2,0.17l0.98,-0.83l0.01,-1.99l0.94,-1.58l1.48,-0.71l0.19,-0.54l-0.69,-1.39l2.06,-0.12l0.69,-1.09l-0.03,-1.23l1.12,-1.15l-0.18,-1.88l-0.5,-1.14l1.17,-1.09l5.42,-0.99l2.59,-0.89l1.6,1.26l0.97,2.53l3.5,1.06Z" data-code="PK" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M737.01,393.71l0.39,2.98l-0.44,1.19l-0.55,-1.53l-0.67,-0.14l-1.17,1.28l0.65,2.1l-0.42,0.69l-2.48,-1.23l-0.58,-1.49l0.66,-1.03l-0.1,-0.53l-1.59,-1.19l-0.56,0.08l-0.65,0.87l-1.23,0.0l-1.58,0.97l0.83,-1.81l2.56,-1.42l0.65,0.84l0.45,0.13l1.9,-0.69l0.56,-1.12l1.5,-0.06l0.38,-0.43l-0.09,-1.2l1.21,0.72l0.36,2.03ZM733.59,386.41l0.05,0.76l0.08,0.27l-0.8,-0.42l-0.18,-0.72l0.85,0.12ZM734.08,385.93l-0.12,-1.13l-1.01,-1.29l1.36,0.03l0.53,0.73l0.51,2.06l-1.27,-0.4ZM733.76,387.52l0.39,0.99l-0.32,0.15l-0.07,-1.14ZM724.65,368.03l1.46,0.71l0.72,-0.31l-0.32,1.19l0.79,1.74l-0.57,1.88l-1.53,1.06l-0.39,2.27l0.56,2.06l1.63,0.57l1.16,-0.27l2.72,1.24l-0.19,1.1l0.77,0.85l-0.08,0.37l-1.4,-0.9l-0.88,-1.29l-0.66,0.0l-0.38,0.55l-1.6,-1.32l-2.15,0.36l-0.87,-0.4l0.07,-0.62l0.66,-0.56l-0.01,-0.62l-0.75,-0.6l-0.72,0.44l-0.73,-0.88l-0.39,-2.53l0.32,0.27l0.66,-0.28l0.26,-4.04l0.71,-2.06l1.14,0.0ZM731.03,388.72l-0.88,0.85l-1.19,1.95l-1.05,-1.2l0.93,-1.11l0.32,-1.48l0.52,-0.06l-0.27,1.16l0.22,0.45l0.49,-0.12l1.0,-1.32l-0.08,0.86ZM726.83,385.61l0.83,0.38l1.17,-0.0l-0.02,0.48l-2.0,1.41l0.02,-2.28ZM724.81,381.88l-0.39,1.29l-1.42,-1.98l1.2,0.05l0.6,0.64ZM716.54,391.7l1.12,-0.97l0.03,-0.03l-0.28,0.38l-0.87,0.63ZM719.21,388.91l0.04,-0.07l0.8,-1.54l0.16,0.76l-1.01,0.85Z" data-code="PH" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M468.45,271.45l-1.1,-1.82l-1.87,-0.39l-0.48,-1.25l-1.72,-0.44l-0.47,0.25l-0.21,0.56l-0.72,-0.43l0.12,-0.82l-0.32,-0.45l-1.74,-0.32l-1.05,-1.13l-0.96,-2.4l0.17,-1.46l-0.62,-2.19l-0.82,-1.37l0.61,-1.22l-0.51,-1.88l1.46,-1.07l6.88,-3.37l2.12,0.62l0.15,0.81l0.38,0.33l5.51,0.54l4.53,-0.06l1.06,0.38l0.5,1.09l0.14,1.93l0.66,1.51l-0.01,1.34l-1.3,0.73l-0.17,0.5l0.74,1.83l0.07,1.86l1.22,3.37l-0.19,0.78l-1.23,0.53l-2.27,3.23l0.24,1.15l-1.99,-1.23l-2.01,0.46l-1.38,-0.32l-1.2,0.67l-1.05,-1.13l-1.17,0.27Z" data-code="PL" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M481.47,443.27l0.39,0.31l2.52,0.15l0.99,1.18l2.01,0.36l1.4,-0.64l0.69,1.18l1.78,0.33l1.84,2.38l2.24,0.19l0.4,-0.43l-0.21,-2.77l-0.62,-0.3l-0.48,0.33l-1.98,-1.18l0.72,-5.32l-0.51,-1.19l0.58,-1.31l3.68,-0.62l0.26,0.64l1.21,0.63l0.9,-0.22l2.16,0.67l1.33,0.71l1.07,1.02l0.56,1.89l-0.88,2.72l0.43,2.1l-0.73,0.88l-0.76,2.39l0.6,0.68l-6.61,1.85l-0.29,0.44l0.19,1.47l-1.69,0.36l-1.43,1.04l-0.38,0.89l-0.87,0.26l-3.48,3.75l-4.15,-0.54l-1.52,-1.01l-1.77,-0.14l-1.82,0.53l-3.04,-3.46l0.11,-7.69l4.82,0.03l0.39,-0.49l-0.18,-0.76l0.33,-0.84l-0.4,-1.37l0.24,-1.06Z" data-code="ZM" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M384.42,359.7l0.26,-0.83l1.06,-1.32l0.8,-3.63l3.38,-2.88l0.69,-1.87l0.06,5.03l-1.98,0.21l-0.94,1.63l0.39,3.66l-3.71,-0.01ZM392.0,347.13l0.72,-1.91l1.77,-0.25l2.09,0.35l0.96,-0.65l1.27,-0.07l-0.0,2.65l-6.8,-0.12Z" data-code="EH" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M485.7,228.2l2.62,0.79l2.44,-0.11l0.18,0.41l-1.67,2.62l0.66,4.56l-0.85,1.18l-1.72,-0.01l-3.21,-2.27l-1.85,0.58l0.22,-2.14l-0.62,-0.38l-0.64,0.42l-1.26,-1.35l-0.18,-2.36l2.87,-1.24l3.02,-0.69Z" data-code="EE" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M492.06,333.38l1.47,0.44l2.95,-1.74l2.03,-0.22l1.52,0.32l0.6,1.27l0.7,0.04l0.41,-0.68l1.8,0.61l1.95,0.17l1.04,-0.54l1.43,4.34l-2.03,4.78l-1.66,-1.85l-1.76,-4.05l-0.65,-0.12l-0.35,0.67l1.04,3.03l3.44,7.26l1.77,3.16l2.04,2.76l-0.37,0.54l0.22,2.06l2.73,2.28l-28.43,0.0l0.0,-19.72l-0.73,-2.31l0.6,-1.66l-0.33,-1.32l0.69,-1.07l3.05,-0.04l4.82,1.62Z" data-code="EG" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M467.15,505.21l-0.13,-2.11l-0.69,-1.7l0.71,-0.7l-0.12,-2.46l-4.57,-8.67l0.78,-0.92l0.59,0.47l0.69,1.37l2.83,0.75l1.5,-0.27l2.24,-1.46l0.18,-9.94l1.35,2.39l-0.21,1.57l0.61,1.24l0.41,0.2l1.79,-0.29l2.61,-2.16l0.69,-1.37l0.95,-0.5l2.19,1.08l2.04,0.14l1.78,-0.67l0.85,-2.2l1.38,-0.34l1.59,-2.85l2.15,-1.95l3.41,-1.92l1.99,0.46l1.02,-0.28l0.99,0.2l1.75,5.47l-0.37,3.39l-0.82,-0.24l-1.0,0.47l-0.87,1.75l-0.04,1.2l1.98,1.91l1.47,-0.3l0.7,-1.24l1.09,0.01l-0.77,3.89l-0.58,1.15l-2.2,1.88l-3.17,5.02l-2.8,3.01l-3.57,3.07l-2.53,1.12l-1.22,0.15l-0.51,0.75l-1.17,-0.34l-1.4,0.54l-2.58,-0.55l-1.62,0.35l-1.19,-0.11l-2.54,1.18l-2.1,0.47l-1.6,1.15l-0.84,0.05l-0.93,-0.95l-0.93,-0.16l-0.97,-1.21l-0.25,0.05ZM491.46,495.56l0.62,-0.98l1.48,-0.62l1.18,-2.31l-0.07,-0.48l-1.99,-1.77l-1.68,0.59l-1.42,1.19l-1.34,1.82l0.02,0.49l1.88,2.23l1.32,-0.17Z" data-code="ZA" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M231.86,415.43l0.29,1.59l-0.69,1.45l-2.61,2.51l-3.13,1.11l-1.53,2.18l-0.49,1.68l-1.0,0.73l-1.02,-1.11l-1.78,-0.16l0.67,-1.15l-0.24,-0.86l1.25,-2.13l-0.54,-1.09l-0.67,-0.08l-0.72,0.87l-0.87,-0.64l0.35,-0.69l-0.36,-1.96l0.81,-0.51l0.45,-1.51l0.92,-1.57l-0.07,-0.97l2.65,-1.33l2.75,1.35l0.77,1.05l2.12,0.35l0.76,-0.32l1.96,1.21Z" data-code="EC" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M451.58,282.14l3.5,1.08l-0.22,1.43l0.34,1.0l-1.55,-0.28l-2.22,1.64l0.13,1.69l-0.27,1.22l0.82,1.78l2.39,1.84l1.3,2.87l2.79,2.73l2.05,0.1l0.25,0.31l-0.43,0.41l0.09,0.64l4.05,2.19l2.2,2.0l-0.17,0.42l-1.16,-1.17l-2.18,-0.54l-0.45,0.21l-1.05,2.12l0.14,0.51l1.59,1.06l-0.2,1.15l-1.06,0.36l-1.25,2.57l-0.36,0.08l0.0,-0.41l1.01,-2.65l-1.73,-3.5l-1.12,-0.56l-0.67,-1.29l-1.72,-0.75l-1.01,-1.25l-2.01,-0.35l-4.11,-3.59l-1.63,-1.87l-1.03,-3.6l-3.56,-1.55l-1.3,0.58l-1.68,1.6l0.17,-0.9l-0.27,-0.45l-1.14,-0.37l-0.55,-2.31l0.78,-1.37l-0.66,-1.44l0.81,0.44l1.41,-0.27l1.08,-0.94l0.53,0.39l1.19,-0.11l0.75,-1.38l1.51,0.37l1.39,-0.65l0.34,-1.31l1.06,0.36l0.5,-0.22l0.21,-0.51l1.95,-0.5l0.42,0.96ZM459.21,311.54l-0.67,1.87l0.33,1.12l-0.32,0.99l-1.48,-0.91l-4.52,-1.83l0.21,-0.97l2.67,0.25l3.8,-0.53ZM443.92,301.94l1.19,1.86l-0.3,3.74l-1.07,-0.01l-0.75,0.79l-0.53,-0.48l-0.1,-3.76l-0.41,-1.41l1.07,0.0l0.9,-0.74Z" data-code="IT" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M690.58,359.66l-2.72,1.89l-2.09,2.52l-0.63,1.98l4.31,6.55l2.32,1.68l1.44,1.97l1.11,4.65l-0.32,4.28l-1.93,1.55l-2.84,1.62l-2.11,2.17l-2.73,2.07l-0.59,-1.06l0.63,-1.54l-0.12,-0.47l-1.34,-1.05l1.51,-0.72l2.55,-0.18l0.3,-0.63l-0.82,-1.16l4.0,-2.09l0.31,-3.08l-0.57,-1.79l0.42,-2.69l-0.73,-1.99l-1.86,-1.79l-3.63,-5.38l-2.73,-1.5l0.37,-0.5l1.5,-0.65l0.21,-0.52l-0.97,-2.33l-0.37,-0.25l-2.83,-0.02l-2.25,-4.02l0.84,-0.42l4.39,-0.3l2.06,-1.35l1.15,0.91l1.88,0.41l-0.18,1.55l1.36,1.19l1.69,0.47Z" data-code="VN" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M826.68,441.55l-0.6,0.09l-0.2,-0.34l0.37,0.15l0.44,0.09ZM824.18,437.32l-0.26,-0.31l-0.31,-0.91l0.03,0.0l0.54,1.22ZM823.04,439.28l-1.66,-0.22l-0.2,-0.53l1.16,0.28l0.7,0.47ZM819.26,434.58l1.17,0.66l0.03,0.04l-0.82,-0.45l-0.38,-0.25Z" data-code="SB" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M516.04,377.54l1.1,0.85l1.63,-0.46l0.68,0.48l1.63,0.03l2.01,0.96l1.73,1.68l1.64,2.1l-1.52,2.06l0.16,1.73l0.39,0.38l2.05,0.01l-0.36,1.03l2.86,3.6l8.32,3.09l1.32,0.02l-6.33,6.76l-3.1,0.11l-2.36,1.77l-1.47,0.04l-0.86,0.79l-1.38,-0.0l-1.32,-0.81l-2.29,1.05l-0.76,0.98l-3.29,-0.41l-3.07,-2.07l-1.8,-0.07l-0.62,-0.6l0.0,-1.24l-0.28,-0.38l-1.15,-0.37l-1.4,-2.6l-1.19,-0.69l-0.47,-1.01l-1.27,-1.23l-1.16,-0.22l0.43,-0.73l1.45,-0.28l0.41,-0.95l-0.03,-2.22l0.68,-2.45l1.05,-0.63l1.43,-3.08l1.57,-1.38l1.02,-2.53l0.35,-1.9l2.52,0.47l0.44,-0.24l0.58,-1.44Z" data-code="ET" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M525.13,418.38l-1.13,-1.57l-0.03,-8.86l2.66,-3.38l1.67,-0.13l2.13,-1.69l3.41,-0.23l7.08,-7.57l2.91,-3.71l0.08,-4.85l2.98,-0.67l1.24,-0.87l0.45,-0.0l-0.2,3.03l-1.21,3.64l-2.73,6.0l-2.13,3.66l-5.03,6.17l-8.56,6.4l-2.78,3.08l-0.8,1.56Z" data-code="SO" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M498.91,471.53l-1.1,-0.22l-0.92,0.29l-2.09,-0.46l-1.49,-1.14l-1.89,-0.44l-0.62,-1.44l-0.01,-0.86l-0.3,-0.38l-0.97,-0.26l-2.72,-2.8l-1.93,-3.41l3.83,0.46l3.74,-3.89l1.08,-0.44l0.26,-0.78l1.25,-0.91l1.41,-0.26l0.5,0.9l1.99,-0.05l1.72,1.19l1.11,0.18l1.05,0.68l0.01,3.05l-0.59,3.84l0.38,0.87l-0.23,1.26l-0.39,0.36l-0.64,1.86l-2.43,2.82Z" data-code="ZW" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M415.99,294.24l1.08,1.32l4.61,1.55l1.08,-0.64l2.58,1.41l2.72,-0.33l0.09,1.34l-2.15,2.02l-3.1,0.68l-0.31,0.31l-0.2,1.01l-1.54,1.87l-0.97,2.65l0.86,1.9l-1.34,1.4l-0.49,1.86l-1.88,0.7l-1.66,2.25l-5.35,-0.01l-1.81,1.17l-0.88,1.06l-0.86,-0.18l-0.79,-0.9l-0.68,-1.73l-2.37,-0.68l-0.12,-0.6l1.21,-2.0l-0.78,-1.19l0.62,-1.89l-0.8,-1.8l0.89,-0.51l0.09,-1.41l0.42,-0.63l0.03,-2.39l1.01,-0.78l0.12,-0.47l-1.04,-1.93l-1.46,-0.12l-0.63,0.42l-1.04,0.0l-0.53,-1.39l-0.55,-0.22l-1.31,0.73l0.07,-1.41l-0.87,-1.4l3.08,-2.16l2.98,0.6l3.32,-0.02l2.62,0.58l6.01,-0.06Z" data-code="ES" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M520.38,375.96l3.42,2.46l3.5,3.81l0.85,0.55l-0.95,-0.01l-3.51,-3.92l-2.33,-1.16l-1.73,-0.07l-0.91,-0.51l-1.25,0.52l-1.34,-1.03l-0.62,0.17l-0.66,1.63l-2.34,-0.43l-0.18,-0.68l1.29,-5.37l0.62,-0.63l1.95,-0.54l0.87,-1.03l1.17,2.45l0.68,2.36l1.49,1.45Z" data-code="ER" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M468.91,298.06l-1.24,-1.13l0.5,-2.11l0.88,-0.81l2.29,1.73l-0.52,0.71l-0.77,-0.3l-1.14,1.91Z" data-code="ME" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M491.9,285.98l-0.28,-1.04l0.25,-1.54l-0.15,-1.8l-3.32,-5.2l1.4,-0.31l1.71,1.08l1.07,0.18l0.88,0.78l0.03,1.44l0.78,0.52l0.33,1.38l0.81,0.94l0.0,0.67l-1.14,-0.08l-0.7,-0.47l-0.52,0.29l-0.06,0.94l-1.08,2.21Z" data-code="MD" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M545.91,449.15l0.4,3.06l0.63,1.22l-0.21,1.04l-0.56,-0.81l-0.69,-0.01l-0.47,0.77l0.41,2.15l-0.18,0.89l-0.72,0.79l-0.15,2.18l-5.77,18.57l-3.92,1.7l-3.12,-1.54l-0.6,-1.26l-0.19,-2.48l-0.86,-2.12l-0.21,-1.83l0.39,-1.67l1.21,-0.76l0.01,-0.79l1.19,-2.08l0.23,-1.69l-1.06,-3.05l-0.19,-2.26l0.81,-1.36l0.32,-1.49l4.63,-1.23l3.44,-3.04l0.85,-1.42l-0.09,-0.71l0.78,-0.04l1.38,-1.79l0.13,-1.65l0.45,-0.62l1.16,1.7l0.59,1.62Z" data-code="MG" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M378.77,359.44l0.06,-0.63l0.93,-0.75l0.82,-1.41l-0.09,-1.07l0.79,-1.77l1.31,-1.64l0.95,-0.61l0.66,-1.61l0.09,-1.52l0.81,-1.54l1.72,-1.11l1.55,-2.81l1.16,-1.0l2.44,-0.41l1.94,-1.91l1.31,-0.82l2.09,-2.4l-0.51,-3.84l1.25,-3.95l1.5,-1.88l4.46,-2.74l2.37,-4.82l1.43,0.01l1.7,1.31l2.31,-0.21l3.46,0.7l0.81,1.67l0.16,1.84l0.86,3.17l0.57,0.63l-0.27,0.69l-3.05,0.46l-1.26,1.11l-1.33,0.24l-0.33,0.37l-0.09,1.91l-2.69,1.06l-1.07,1.5l-1.89,0.72l-2.58,0.47l-4.04,2.12l-0.53,4.86l-1.16,0.07l-0.92,0.64l-1.96,-0.36l-2.42,0.56l-0.74,1.99l-0.86,0.41l-1.14,3.39l-3.53,3.11l-0.81,3.66l-0.96,1.14l-0.29,0.84l-4.94,0.19Z" data-code="MA" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M598.64,298.24l-1.64,1.79l0.06,0.61l1.85,1.26l1.99,-0.71l2.27,1.34l-2.58,1.91l-2.57,-0.24l-0.2,-0.5l0.47,-1.39l-0.47,-0.52l-3.35,0.77l-2.1,3.89l-1.86,-0.14l-0.39,0.23l-0.65,1.43l0.21,0.53l1.65,0.69l0.47,2.05l-1.21,2.74l-1.54,-0.54l-1.11,-0.04l0.05,-1.53l-0.25,-0.38l-3.3,-1.35l-2.56,-1.53l-4.4,-3.69l-1.33,-3.48l-1.1,-0.68l-2.57,0.15l-0.7,-0.5l-0.46,-2.81l-3.37,-1.79l-0.46,0.06l-2.07,1.94l-2.09,1.14l-0.2,0.45l0.29,1.2l-1.92,0.03l-0.09,-11.97l5.98,-1.95l6.18,4.04l2.35,3.08l7.41,-0.61l2.72,2.28l-0.18,3.21l0.39,0.42l0.89,0.02l0.45,2.42l0.38,0.33l2.93,0.1l0.96,1.58l1.29,-0.25l1.05,-2.28l3.18,-2.25l1.24,-0.54Z" data-code="UZ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M673.9,359.64l-1.97,1.62l-0.57,0.98l-1.4,0.62l-1.36,1.08l-1.99,0.36l-1.08,2.72l-0.91,0.41l-0.19,0.55l1.21,2.31l2.52,3.49l-0.79,1.95l-0.74,0.41l-0.17,0.52l0.65,1.39l1.61,1.98l0.25,2.61l0.9,2.15l-1.92,3.6l0.68,-2.27l-0.81,-1.75l0.19,-2.68l-1.05,-1.54l-1.24,-6.25l-1.12,-2.29l-0.61,-0.13l-4.33,3.06l-2.39,-0.66l0.77,-2.89l-0.52,-2.65l-1.92,-3.02l0.25,-0.78l-0.29,-0.51l-1.33,-0.31l-1.61,-1.97l-0.1,-1.35l0.82,-0.23l0.04,-1.7l1.03,-0.53l0.21,-0.44l-0.23,-0.99l0.54,-0.98l0.08,-2.3l1.45,0.46l0.48,-0.2l1.12,-2.26l0.16,-1.4l1.34,-2.25l-0.01,-1.58l2.89,-1.73l1.62,0.46l0.51,-0.43l-0.17,-1.48l0.65,-0.39l0.07,-1.08l0.77,-0.11l0.71,1.41l1.06,0.72l-0.03,4.05l-2.38,2.46l-0.3,3.26l0.47,0.43l2.27,-0.39l0.51,2.15l1.47,0.69l-0.61,1.87l0.19,0.47l2.97,1.52l1.64,-0.56l0.02,0.35Z" data-code="MM" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M392.61,383.9l-0.19,-2.39l-0.99,-0.88l-0.44,-1.31l-0.09,-1.3l0.81,-0.59l0.35,-1.26l2.37,0.66l1.31,-0.48l0.86,0.15l0.66,-0.57l9.83,-0.04l0.38,-0.28l0.56,-1.82l-0.44,-0.66l-2.35,-22.51l3.26,-0.04l16.7,11.72l0.74,1.34l2.5,1.11l0.02,1.42l0.44,0.39l2.34,-0.22l0.01,5.49l-1.28,1.64l-0.26,1.51l-5.31,0.58l-1.08,0.93l-2.9,0.1l-0.87,-0.48l-1.38,0.37l-2.4,1.1l-0.6,0.88l-1.86,1.1l-0.43,0.71l-0.79,0.4l-1.44,-0.21l-0.81,0.84l-0.34,1.65l-1.91,2.04l-0.06,1.04l-0.67,1.23l0.13,1.17l-0.97,0.39l-0.23,-0.65l-0.52,-0.24l-1.35,0.4l-0.34,0.55l-2.69,-0.29l-0.37,-0.36l-0.02,-0.91l-0.65,-0.35l0.45,-0.65l-0.03,-0.52l-2.12,-2.46l-0.76,-0.01l-2.0,1.17l-0.78,-0.15l-0.8,-0.67l-1.21,0.23Z" data-code="ML" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M676.61,267.85l3.78,1.95l5.69,-1.19l2.35,0.48l2.34,1.79l1.81,2.09l2.28,-0.04l3.11,0.62l2.49,-0.96l3.42,-0.7l3.51,-2.62l1.21,0.34l1.56,1.35l2.31,-0.25l-2.72,6.05l0.64,1.85l0.5,0.22l1.31,-0.44l2.36,0.55l2.04,-1.29l1.73,1.03l2.1,2.39l-0.15,0.72l-1.72,-0.34l-3.79,0.54l-1.88,1.14l-1.76,2.29l-3.71,1.35l-2.44,1.82l-3.81,-0.99l-0.44,0.19l-1.31,2.27l1.07,2.53l-1.56,1.04l-1.74,1.78l-2.78,1.14l-3.78,0.14l-4.05,1.18l-2.75,1.69l-1.16,-0.94l-2.93,0.0l-3.61,-2.0l-2.59,-0.55l-3.41,0.46l-5.11,-0.75l-2.62,0.07l-1.31,-1.82l-1.4,-3.4l-1.47,-0.37l-3.14,-2.22l-6.15,-1.06l-0.73,-1.26l0.89,-4.37l-1.73,-2.97l-3.7,-1.54l-1.96,-1.86l-0.53,-2.16l2.39,-0.63l4.75,-3.33l3.59,-1.75l2.18,1.16l2.44,0.05l1.83,1.83l2.46,0.14l3.58,0.97l0.4,-0.12l2.43,-2.72l0.07,-0.43l-0.93,-2.14l2.28,-3.66l2.59,1.52l4.94,1.41l0.44,2.74Z" data-code="MN" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M472.81,299.6l0.49,-0.78l3.56,-0.8l1.01,0.87l0.14,1.71l-0.66,0.59l-1.14,-0.05l-1.14,0.75l-1.37,0.24l-0.79,-0.61l-0.3,-1.19l0.2,-0.73Z" data-code="MK" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M505.5,439.25l0.85,1.96l0.15,2.88l-0.69,1.66l0.72,1.81l0.06,1.29l0.49,0.64l0.07,1.07l0.4,0.55l0.8,-0.23l0.55,0.62l0.7,-0.21l0.34,0.6l0.19,2.98l-1.04,0.63l-0.53,1.27l-1.11,-1.1l-0.16,-1.59l0.51,-1.33l-0.32,-1.32l-0.99,-0.65l-0.82,0.12l-2.36,-1.66l0.63,-1.99l0.82,-1.18l-0.46,-2.03l0.9,-2.88l-0.95,-2.53l0.97,0.19l0.29,0.41Z" data-code="MW" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M407.4,349.79l-2.62,0.03l-0.39,0.44l2.42,23.13l0.37,0.43l-0.39,1.27l-9.75,0.04l-0.56,0.54l-0.91,-0.11l-1.27,0.46l-1.61,-0.66l-0.98,0.03l-0.36,0.29l-0.38,1.37l-0.42,0.24l-2.93,-3.44l-2.96,-1.55l-1.62,-0.03l-1.27,0.55l-1.12,-0.2l-0.65,0.4l-0.08,-0.51l0.68,-1.31l0.31,-2.47l-0.57,-3.99l0.23,-1.25l-0.68,-1.53l-1.16,-1.05l0.25,-0.42l9.58,0.02l0.4,-0.45l-0.46,-3.79l0.47,-1.08l2.11,-0.22l0.36,-0.4l-0.08,-6.64l7.81,0.14l0.41,-0.4l0.01,-3.47l7.8,5.59Z" data-code="MR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M498.55,406.22l0.7,-0.46l1.65,0.5l1.96,-0.57l1.7,0.01l1.45,-0.98l0.91,1.33l1.33,3.95l-2.57,4.03l-1.46,-0.4l-2.54,0.91l-1.37,1.61l-0.01,0.81l-2.42,-0.01l-2.26,1.01l-0.17,-1.59l0.58,-1.04l0.14,-1.94l1.37,-2.28l1.78,-1.58l-0.17,-0.65l-0.72,-0.24l0.13,-2.43Z" data-code="UG" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M717.48,403.36l-1.39,0.65l-2.12,-0.41l-2.88,-0.0l-0.38,0.28l-0.84,2.75l-0.99,0.96l-1.21,3.29l-1.73,0.45l-2.45,-0.68l-1.39,0.31l-1.33,1.15l-1.59,-0.14l-1.41,0.44l-1.44,-1.19l-0.18,-0.73l1.34,0.53l1.93,-0.47l0.75,-2.23l4.02,-1.03l2.75,-3.21l0.82,0.94l0.64,-0.05l0.4,-0.65l0.96,0.06l0.42,-0.36l0.24,-2.69l1.81,-1.65l1.21,-1.87l0.63,-0.01l1.07,1.06l0.34,1.28l3.44,1.35l-0.06,0.35l-1.37,0.1l-0.35,0.54l0.32,0.88ZM673.68,399.48l0.17,1.1l0.47,0.33l1.65,-0.3l0.87,-0.94l1.61,1.52l0.98,1.57l-0.12,2.81l0.41,2.29l0.95,0.9l0.88,2.44l-1.27,0.12l-5.1,-3.68l-0.34,-1.29l-1.37,-1.59l-0.33,-1.97l-0.88,-1.4l0.25,-1.68l-0.46,-1.06l1.63,0.84Z" data-code="MY" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M133.1,328.46l0.22,0.49l9.64,3.54l6.96,-0.02l0.4,-0.4l0.0,-0.81l3.76,0.0l3.55,3.11l1.4,2.99l1.51,1.09l2.08,0.86l0.48,-0.14l1.46,-2.1l1.72,-0.05l1.59,1.03l2.06,3.53l1.47,1.63l1.26,3.28l2.18,1.06l2.27,0.6l-1.19,3.88l-0.42,5.19l1.79,5.01l1.62,1.94l0.61,1.55l1.2,1.45l2.55,0.67l1.38,1.13l7.54,-1.93l1.86,-1.32l1.14,-4.4l4.1,-1.24l3.56,-0.11l0.32,0.31l-0.06,0.97l-1.26,1.49l-0.67,1.74l0.38,0.71l-0.73,2.32l-0.49,-0.3l-1.0,0.08l-1.0,1.41l-0.47,-0.11l-0.53,0.47l-4.26,-0.02l-0.4,0.4l-0.0,1.08l-1.1,0.26l0.1,0.44l1.82,1.46l0.56,0.94l-3.19,0.21l-1.21,2.12l0.24,0.73l-0.2,0.45l-2.24,-2.21l-1.45,-0.94l-2.22,-0.7l-1.52,0.23l-3.06,1.18l-10.55,-3.9l-2.86,-2.0l-3.78,-0.94l-1.08,-1.21l-2.62,-1.46l-1.18,-1.57l-0.39,-0.85l0.66,-0.64l-0.19,-0.55l0.53,-0.77l0.01,-0.93l-2.0,-3.91l-2.21,-2.71l-2.53,-2.16l-1.19,-1.68l-2.2,-1.21l-0.31,-0.45l0.34,-1.56l-0.21,-0.44l-1.23,-0.63l-1.36,-1.26l-0.59,-1.87l-1.53,-0.48l-2.44,-2.68l-0.15,-0.94l-1.33,-2.14l-0.84,-2.11l-0.15,-1.39l-1.81,-1.16l-0.98,0.05l-1.31,-0.74l-0.58,0.22l-0.4,1.19l0.71,3.95l3.51,4.09l0.28,0.83l0.53,0.26l0.41,1.51l1.33,1.8l1.58,1.46l0.8,2.49l1.43,2.51l0.13,1.37l0.37,0.36l1.03,0.08l1.68,2.38l-0.84,0.79l-0.66,-1.55l-1.68,-1.59l-2.91,-1.94l0.06,-1.89l-0.53,-1.73l-2.91,-2.11l-0.56,0.08l-1.95,-1.14l-0.92,-1.02l0.72,-0.08l0.93,-1.06l0.08,-1.82l-1.93,-2.04l-1.46,-0.81l-3.76,-8.06l4.87,-0.45Z" data-code="MX" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M507.77,331.27l0.39,-0.81l0.2,0.43l-0.34,1.09l0.52,0.43l0.68,-0.23l-0.86,3.84l-1.16,-3.52l0.6,-0.8l-0.03,-0.44ZM508.72,328.43l0.38,-1.13l0.64,0.0l0.52,-0.54l0.02,0.67l-0.52,1.01l-0.55,-0.25l-0.5,0.24Z" data-code="IL" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M444.48,298.15l-0.65,2.02l-0.56,-0.34l-0.51,-1.98l0.42,-1.04l0.99,-0.8l0.31,2.13ZM429.62,268.54l1.78,1.88l1.48,-0.14l2.08,1.68l1.36,0.33l1.23,0.98l3.1,0.6l-1.08,2.26l-0.3,2.52l-0.41,0.38l-0.92,-0.28l-0.51,0.42l0.07,0.77l-1.82,2.19l-0.04,1.65l0.57,0.37l0.85,-0.41l0.62,1.14l-0.04,1.13l0.61,1.11l-0.78,1.22l0.65,2.72l1.29,0.62l-0.19,1.03l-2.02,1.73l-4.75,-0.9l-3.84,1.13l-0.52,2.09l-2.47,0.37l-2.7,-1.47l-1.18,0.64l-4.28,-1.44l-0.76,-1.02l1.21,-2.03l0.41,-7.31l-2.58,-3.82l-1.89,-1.93l-3.74,-1.44l-0.2,-2.16l2.82,-0.72l4.11,0.96l0.48,-0.46l-0.62,-3.38l1.98,1.12l5.83,-3.02l0.91,-3.28l1.57,-0.58l0.25,0.97l1.34,0.35l1.05,1.43ZM289.01,408.29l-0.81,0.8l-0.78,0.12l-0.5,-0.66l-0.56,-0.1l-0.91,0.6l-0.46,-0.22l1.09,-2.96l-0.96,-1.77l-0.17,-1.49l1.07,-1.77l2.32,0.75l2.51,2.01l0.3,0.74l-2.14,3.96Z" data-code="FR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M531.15,388.78l1.52,0.12l5.13,-0.96l5.3,-1.49l-0.01,4.43l-2.67,3.4l-1.85,0.01l-8.04,-2.95l-2.55,-3.19l1.12,-1.73l2.04,2.35Z" data-code="XS" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M492.16,172.43l-0.28,5.17l3.67,4.26l-2.21,4.98l2.86,6.98l-1.64,5.01l2.21,4.51l-0.98,3.55l3.63,4.02l-0.84,2.48l-7.53,9.52l-4.5,0.42l-4.38,1.84l-3.74,0.97l-1.3,-2.46l-2.36,-1.68l0.53,-4.89l-1.2,-4.86l1.14,-3.04l2.23,-3.46l5.68,-6.22l1.8,-1.58l-0.4,-2.8l-3.4,-2.81l-0.79,-2.25l-0.16,-10.13l-7.02,-7.77l0.96,-1.19l2.47,3.3l3.5,-0.17l2.57,1.6l0.53,-0.09l2.46,-3.23l1.19,-5.07l3.49,-2.23l2.82,2.55l-1.01,4.77Z" data-code="FI" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M869.95,457.1l-1.21,0.42l-0.08,-0.24l2.98,-1.23l-0.15,0.44l-1.54,0.62ZM867.58,459.4l0.43,0.38l-0.27,0.91l-1.24,0.29l-1.04,-0.25l-0.14,-0.69l0.64,-0.59l0.92,0.26l0.7,-0.31Z" data-code="FJ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M274.37,564.69l1.48,1.33l-0.53,1.0l-2.96,1.07l-0.95,-1.2l-0.57,-0.05l-1.79,1.54l-0.79,-1.16l2.52,-2.03l1.9,0.9l0.46,-0.09l1.23,-1.32Z" data-code="FK" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M202.32,382.47l0.82,-0.18l1.03,-1.02l-0.04,-0.89l0.68,-0.0l0.63,-0.54l0.97,0.23l1.53,-1.28l0.58,-1.0l1.17,0.35l2.41,-0.95l0.13,1.34l-0.81,1.96l0.1,2.77l-0.36,0.38l-0.11,1.76l-0.47,0.81l0.18,1.15l-1.73,-0.86l-0.71,0.27l-1.47,-0.6l-0.52,0.16l-4.02,-3.85Z" data-code="NI" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M430.16,264.22l0.76,-0.72l2.14,-5.88l3.19,-1.63l1.7,0.1l0.35,1.07l-0.6,3.64l-0.51,1.24l-1.24,0.0l-0.4,0.44l0.34,3.35l-2.18,-2.14l-0.43,-0.11l-2.22,0.8l-0.89,-0.15Z" data-code="NL" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M491.42,157.32l7.17,5.11l-2.71,1.67l-0.13,0.55l2.55,4.24l-3.9,2.61l-1.31,0.42l0.79,-4.7l-3.21,-2.91l-0.48,-0.04l-4.06,2.73l-1.21,5.15l-2.11,2.72l-2.64,-1.54l-3.04,0.32l-2.65,-3.53l-0.63,-0.01l-1.41,1.75l-1.41,0.26l-0.33,0.36l-0.33,4.08l-4.27,-0.99l-0.48,0.32l-0.6,3.44l-2.07,-0.02l-0.38,0.27l-4.15,11.7l-3.88,8.48l0.84,2.18l-0.71,1.86l-2.2,-0.09l-0.4,0.28l-1.64,5.41l0.15,7.19l1.58,2.74l-0.8,5.79l-2.04,3.34l-0.83,2.09l-1.27,-2.26l-0.65,-0.07l-4.87,5.52l-3.05,1.02l-3.16,-2.22l-0.86,-5.06l-0.78,-11.7l2.19,-3.29l6.55,-4.59l5.02,-5.96l4.64,-8.4l6.0,-12.26l11.0,-13.83l5.32,-3.11l3.99,0.38l0.38,-0.19l3.69,-6.04l4.48,0.3l4.3,-1.47ZM484.42,59.58l4.68,4.94l-3.51,7.19l-6.97,1.55l-7.03,-2.18l-0.42,-3.6l-0.37,-0.35l-3.35,-0.23l-2.51,-6.12l7.16,-3.9l3.42,3.43l0.63,-0.09l2.33,-4.19l5.93,3.56ZM482.22,93.35l-4.99,4.27l-3.84,-2.35l1.56,-3.06l-1.38,-3.53l4.4,-2.11l0.89,4.13l3.36,2.65ZM466.32,69.71l8.02,9.81l-6.13,5.05l-1.37,8.88l-2.22,2.36l-1.15,9.08l-2.49,0.35l-5.08,-6.44l2.14,-3.9l-0.08,-0.49l-3.69,-3.4l-4.82,-10.44l-1.89,-10.23l6.16,-4.58l1.22,4.4l0.41,0.29l3.57,-0.19l0.37,-0.32l0.9,-4.57l3.14,-0.43l3.02,4.76Z" data-code="NO" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M474.4,460.84l-1.11,0.05l-0.38,0.4l-0.07,9.11l-2.09,0.08l-0.38,0.4l-0.0,18.09l-1.98,1.29l-1.16,0.18l-2.43,-0.69l-0.48,-1.18l-0.99,-0.78l-0.55,0.05l-0.9,1.05l-1.52,-1.75l-0.94,-1.97l-1.99,-8.9l-0.06,-3.23l-0.33,-1.56l-2.3,-3.43l-1.91,-4.94l-1.96,-2.48l-0.12,-1.61l2.33,-0.8l1.43,0.07l1.82,1.15l10.23,-0.26l1.84,1.26l6.01,0.37ZM474.58,460.83l6.59,-1.65l1.91,0.41l-1.71,0.41l-1.31,0.85l-1.12,-0.95l-4.36,0.94Z" data-code="NA" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M839.03,452.86l0.23,1.16l-0.44,0.03l-0.2,-1.47l0.42,0.28Z" data-code="VU" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M838.79,471.67l-0.34,0.23l-2.9,-1.8l-3.27,-3.48l1.65,0.85l4.86,4.19Z" data-code="NC" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M454.74,355.83l1.33,1.41l0.49,0.07l1.26,-0.72l0.53,3.62l0.94,0.85l0.17,0.94l0.82,0.72l-0.45,0.98l-0.96,5.37l-0.13,3.28l-3.05,2.34l-1.22,3.61l1.02,1.25l-0.0,1.48l0.39,0.4l1.13,0.04l-0.1,0.49l-0.45,0.09l-0.35,0.68l-1.47,-2.44l-0.86,-0.29l-2.09,1.38l-1.73,-0.67l-1.45,-0.17l-0.85,0.35l-1.36,-0.07l-1.64,1.1l-1.06,0.05l-2.94,-1.29l-1.44,0.59l-1.01,-0.03l-0.97,-0.95l-2.7,-0.99l-2.69,0.31l-0.87,0.65l-0.46,1.62l-0.74,1.17l-0.12,1.55l-1.57,-1.1l-1.31,0.24l0.03,-0.82l-0.32,-0.41l-2.59,-0.52l-0.15,-1.17l-1.36,-1.62l-0.29,-1.01l0.13,-0.85l1.29,-0.08l1.08,-0.93l3.31,-0.22l2.22,-0.41l0.32,-0.34l0.2,-1.5l1.39,-1.91l-0.01,-5.78l3.37,-1.15l7.24,-5.24l8.41,-5.07l3.69,1.09Z" data-code="NE" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M456.32,383.7l0.64,0.66l-0.28,1.06l-2.11,2.02l-2.03,5.2l-1.37,1.16l-1.15,3.19l-1.33,0.66l-1.46,-0.97l-1.21,0.16l-1.38,1.37l-0.91,0.24l-1.79,4.07l-2.33,0.81l-1.11,-0.07l-0.86,0.51l-1.71,-0.05l-1.19,-1.39l-0.89,-1.9l-1.77,-1.66l-3.95,-0.08l0.07,-5.23l0.42,-1.44l1.95,-2.32l-0.14,-0.91l0.43,-1.18l-0.53,-1.42l0.25,-2.95l0.72,-1.08l0.32,-1.35l0.46,-0.39l2.47,-0.28l2.34,0.89l1.15,1.03l1.28,0.04l1.22,-0.59l3.03,1.28l1.5,-0.14l1.36,-1.01l1.32,0.07l0.82,-0.35l3.45,0.81l1.82,-1.34l1.84,2.7l0.66,0.16Z" data-code="NG" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M857.8,512.11l1.85,3.38l0.45,0.2l0.3,-0.38l0.03,-1.36l0.38,0.29l0.56,2.51l2.02,1.03l1.81,0.29l1.59,-1.16l0.7,0.2l-1.16,4.01l-1.98,0.12l-0.73,1.27l0.21,1.25l-2.44,4.45l-1.47,1.02l-0.42,-0.65l-0.66,-0.3l1.25,-2.35l-0.81,-2.16l-2.64,-1.38l0.04,-0.7l1.82,-1.29l0.42,-2.46l-0.15,-2.29l-0.96,-2.0l-0.05,-0.75l-3.11,-3.94l-0.82,-1.69l1.57,1.56l1.76,0.72l0.66,2.55ZM853.83,527.42l0.57,1.38l0.61,0.17l1.4,-1.06l0.46,0.9l0.0,1.2l-2.48,3.93l-1.26,1.36l-0.06,0.47l0.6,1.08l-1.47,0.09l-2.32,1.54l-2.04,5.78l-3.02,2.49l-2.03,-0.07l-1.72,-1.2l-2.46,-0.23l-0.29,-0.92l1.25,-2.46l3.05,-3.36l1.62,-0.67l4.01,-3.18l1.56,-1.87l1.08,-2.44l1.01,-1.01l0.35,-1.73l1.23,-1.07l0.35,0.88Z" data-code="NZ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M641.15,342.42l-0.0,3.36l-1.74,0.04l-4.8,-0.9l-1.59,-1.45l-3.36,-0.36l-7.66,-3.88l0.81,-2.23l2.33,-1.79l1.77,0.78l2.49,1.85l1.38,0.43l0.99,1.42l1.89,0.55l1.99,1.22l5.5,0.95Z" data-code="NP" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M472.78,298.18l-1.1,-1.47l0.98,-0.9l0.29,-0.94l2.0,1.84l-0.4,0.85l-1.77,0.62Z" data-code="XK" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M407.4,389.11l0.86,0.42l0.56,0.9l1.13,0.54l1.19,-0.61l0.97,-0.08l1.42,0.54l0.6,3.25l-1.03,2.09l-0.65,2.85l1.06,2.33l-0.06,0.53l-2.54,-0.47l-1.66,0.03l-3.06,0.47l-4.11,1.61l0.32,-3.06l-1.18,-1.31l-1.32,-0.67l0.42,-0.86l-0.2,-1.4l0.5,-0.68l0.01,-1.59l0.84,-0.33l0.26,-0.5l-1.15,-3.02l0.12,-0.51l0.51,-0.25l0.66,0.31l1.93,0.02l0.67,-0.72l0.71,-0.14l0.25,0.7l0.57,0.22l1.4,-0.61Z" data-code="CI" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M444.61,279.47l-0.29,1.12l0.16,0.5l1.13,0.67l1.03,0.12l-0.12,0.88l-0.79,0.44l-1.7,-0.42l-0.47,0.25l-0.46,1.23l-0.72,0.07l-0.3,-0.39l-0.58,-0.06l-1.31,1.14l-0.93,0.13l-0.87,-0.62l-0.82,-1.51l-0.52,-0.17l-0.61,0.29l0.02,-0.85l1.73,-1.95l0.07,-0.65l0.96,0.08l0.57,-0.53l1.97,0.02l0.67,-0.71l2.16,0.92Z" data-code="CH" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M242.07,384.75l-1.7,0.59l-0.59,1.19l-1.7,1.7l-0.37,1.94l-0.67,1.44l0.31,0.57l1.03,0.14l0.25,0.91l0.57,0.65l-0.04,2.35l1.64,1.42l3.16,-0.24l1.26,0.28l1.67,2.06l0.41,0.13l4.09,-0.39l0.45,0.22l-0.92,1.95l-0.2,1.8l0.52,1.83l0.75,1.05l-1.12,1.1l0.07,0.63l0.84,0.51l0.74,1.3l-0.39,-0.45l-0.59,-0.01l-0.71,0.74l-4.71,-0.05l-0.4,0.41l0.03,1.57l0.33,0.39l1.11,0.2l-1.68,0.4l-0.29,0.38l-0.01,1.82l1.16,1.14l0.34,1.25l-1.05,7.05l-1.04,-0.87l1.26,-1.99l-0.13,-0.56l-2.18,-1.23l-1.38,0.2l-1.14,-0.38l-1.27,0.61l-1.55,-0.26l-1.38,-2.46l-1.23,-0.75l-0.85,-1.2l-1.67,-1.19l-0.86,0.13l-2.11,-1.32l-1.01,0.31l-1.8,-0.29l-0.52,-0.91l-3.09,-1.68l0.77,-0.52l-0.1,-1.12l0.41,-0.64l1.34,-0.32l2.0,-2.88l-0.11,-0.57l-0.67,-0.43l0.39,-1.38l-0.52,-2.11l0.49,-0.83l-0.4,-2.13l-0.97,-1.36l0.17,-0.67l0.86,-0.08l0.47,-0.75l-0.46,-1.63l1.41,-0.07l1.8,-1.7l0.93,-0.24l0.3,-0.38l0.45,-2.78l1.22,-1.01l1.44,-0.04l0.45,-0.5l1.91,0.12l2.93,-1.85l1.15,-1.15l0.91,0.47l-0.26,0.45Z" data-code="CO" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M740.22,270.81l4.55,1.5l2.81,2.58l0.98,3.43l0.38,0.29l3.8,0.0l2.34,-1.51l3.31,-0.89l-1.01,2.59l-1.01,1.46l-0.85,3.95l-1.53,3.16l-2.73,-0.57l-2.43,1.3l-0.19,0.43l0.65,2.95l-0.32,3.68l-0.94,0.07l-0.37,0.4l0.01,0.58l-0.89,-1.11l-0.67,0.07l-0.92,1.77l-3.72,1.4l-0.25,0.46l0.28,1.25l-1.5,-0.08l-1.08,-0.96l-0.59,0.06l-1.68,2.31l-2.7,1.74l-2.03,2.08l-3.39,0.92l-1.93,1.54l-1.22,0.4l0.42,-0.81l-0.43,-1.03l1.81,-2.01l0.02,-0.51l-1.32,-1.73l-0.51,-0.11l-2.25,1.21l-2.83,2.28l-1.5,2.02l-2.27,0.14l-1.56,1.64l-0.04,0.47l1.32,2.16l2.01,0.63l0.3,1.47l1.98,0.92l0.42,-0.05l2.6,-2.09l1.99,1.1l1.5,0.12l0.24,0.97l-3.39,0.94l-1.12,1.61l-2.5,1.64l-1.29,2.15l0.13,0.55l2.57,1.6l0.97,2.9l3.17,4.94l-0.03,1.8l-1.36,0.69l-0.19,0.5l0.6,1.55l1.41,0.95l-0.9,4.05l-1.43,0.4l-3.85,6.72l-2.28,3.23l-6.78,4.72l-2.73,0.3l-1.45,1.07l-0.61,-0.62l-0.56,-0.01l-1.36,1.29l-3.39,1.31l-2.61,0.41l-1.1,2.86l-0.81,0.09l-0.5,-1.47l0.5,-0.88l-0.25,-0.59l-3.36,-0.86l-1.3,0.41l-2.3,-0.64l-0.95,-0.87l0.34,-1.33l-0.3,-0.49l-2.19,-0.48l-1.13,-0.96l-0.48,-0.03l-2.06,1.4l-4.28,0.28l-2.76,1.08l-0.28,0.43l0.32,2.61l-0.59,-0.03l-0.19,-1.39l-0.56,-0.34l-1.67,0.72l-2.47,-1.26l0.63,-1.94l-0.25,-0.5l-1.37,-0.46l-0.55,-2.3l-0.46,-0.3l-2.13,0.37l0.24,-2.6l2.39,-2.48l0.03,-4.49l-1.19,-0.94l-0.79,-1.57l-0.41,-0.22l-1.4,0.2l-2.0,-0.32l0.48,-1.12l-1.17,-1.78l-0.56,-0.11l-1.62,1.1l-2.25,-0.6l-2.89,1.82l-2.25,2.08l-1.74,0.31l-1.17,-0.74l-3.32,-0.68l-1.48,0.83l-1.04,1.32l-0.12,-1.23l-0.54,-0.34l-1.44,0.56l-5.54,-0.9l-1.98,-1.22l-1.89,-0.56l-0.99,-1.42l-1.34,-0.39l-2.55,-1.88l-2.01,-0.89l-1.21,0.59l-5.57,-3.64l-0.54,-2.5l1.19,0.26l0.49,-0.37l0.08,-1.52l-0.98,-1.65l0.16,-2.6l-2.69,-3.58l-4.12,-1.33l-0.68,-2.18l-1.91,-1.6l-0.38,-0.78l-0.5,-3.27l-1.52,-0.73l-0.7,0.14l-0.49,-2.31l0.57,-0.59l-0.13,-0.89l2.06,-1.34l1.59,-0.59l2.55,0.42l0.43,-0.23l0.85,-1.9l2.99,-0.37l1.11,-1.41l4.04,-1.97l0.39,-0.97l-0.17,-1.67l1.48,-0.77l0.19,-0.49l-2.1,-5.65l4.54,-1.3l1.38,-0.84l1.88,-6.37l4.59,1.12l0.4,-0.13l1.49,-1.91l0.11,-3.42l2.01,-0.45l1.83,-2.43l0.45,-0.15l0.67,2.44l2.23,2.08l3.44,1.35l1.58,2.72l-0.93,4.08l0.95,1.84l6.54,1.28l2.95,2.14l1.48,0.4l1.07,3.0l1.52,2.13l3.06,0.09l5.13,0.76l3.38,-0.46l2.34,0.48l3.65,2.02l3.07,0.05l0.99,0.93l0.48,0.05l2.87,-1.78l3.94,-1.15l3.84,-0.16l3.06,-1.29l1.77,-1.81l1.72,-1.14l0.16,-0.47l-1.12,-2.36l1.05,-1.82l4.03,0.9l2.45,-1.85l3.76,-1.36l1.97,-2.46l1.63,-0.96l3.49,-0.47l1.91,0.4l0.47,-0.31l0.18,-1.65l-2.27,-2.59l-2.11,-1.27l-0.44,0.02l-1.78,1.27l-2.29,-0.54l-1.28,0.37l-0.43,-1.02l2.76,-6.16l3.03,1.25l3.53,-2.45l0.15,-1.96l2.18,-4.08l1.47,-1.55l-0.03,-2.26l-1.16,-1.03l1.66,-1.66l2.96,-0.72l3.21,-0.11l3.62,1.21l2.05,1.43l3.31,8.17l0.92,3.82ZM696.92,366.89l-1.87,1.1l-1.63,-0.65l-0.06,-1.84l1.03,-1.01l2.58,-0.7l1.15,0.05l0.31,0.56l-0.98,1.09l-0.53,1.4Z" data-code="CN" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M457.92,387.33l1.06,1.92l-1.4,0.16l-1.05,-0.23l-0.45,0.23l-0.54,1.2l0.08,0.45l1.48,1.48l1.05,0.45l1.01,2.47l-1.52,3.0l-0.68,0.68l-0.13,3.69l2.38,3.84l1.09,0.8l0.24,2.48l-3.67,-1.14l-11.27,-0.13l0.23,-1.79l-0.98,-1.66l-1.19,-0.54l-0.44,-0.97l-0.6,-0.42l1.71,-4.28l0.75,-0.13l1.38,-1.37l0.65,-0.03l1.71,0.99l1.93,-1.12l1.14,-3.2l1.38,-1.17l2.0,-5.16l2.17,-2.15l0.3,-1.65l-0.86,-0.89l0.18,-0.37l0.8,1.32l0.07,3.24Z" data-code="CM" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M246.67,568.71l-3.34,2.4l-0.55,3.89l-0.62,0.06l-2.66,-1.3l-2.82,-2.86l-3.06,-2.32l-0.71,-2.33l0.65,-2.52l-1.22,-2.56l-0.31,-6.43l1.02,-3.46l2.58,-2.79l-0.19,-0.66l-3.24,-0.91l2.11,-2.91l0.78,-5.35l2.3,1.02l0.56,-0.29l1.31,-7.14l-0.2,-0.42l-1.68,-0.9l-0.58,0.28l-0.7,3.81l-0.82,-0.25l1.58,-10.59l1.15,-2.43l-0.71,-3.1l-0.18,-3.15l1.02,-0.35l3.26,-9.88l1.07,-4.5l-0.56,-4.47l0.74,-2.47l-0.29,-3.45l1.46,-3.5l2.04,-17.19l-0.67,-7.94l1.04,-0.54l0.54,-0.92l0.79,1.16l0.32,1.82l1.25,1.19l-0.69,2.61l1.33,2.98l0.97,3.7l0.47,0.29l1.49,-0.31l0.11,0.25l-0.77,2.53l-2.57,1.28l-0.22,0.37l0.08,4.51l-0.47,0.8l0.58,1.25l-1.59,1.59l-1.68,2.74l-0.89,2.6l0.21,2.85l-1.49,2.9l1.12,5.38l0.64,0.64l-0.01,2.49l-1.39,2.89l0.02,2.59l-1.89,2.18l0.02,2.98l0.7,2.85l-1.44,1.23l-1.26,6.27l0.39,3.95l-0.98,0.94l0.58,3.94l1.04,1.3l-0.69,1.22l0.14,0.54l1.01,0.61l0.18,0.88l-1.04,0.92l0.26,2.03l-0.89,4.69l-1.31,3.11l0.25,2.01l-0.73,2.21l-1.97,1.93l0.28,4.31l0.88,1.43l1.6,0.0l-0.01,2.68l1.04,2.36l6.16,0.76ZM248.69,570.67l0.0,9.15l0.4,0.4l3.58,0.07l-0.53,1.14l-1.93,1.23l-2.45,-0.46l-1.9,-1.34l-2.54,-0.61l-5.59,-4.63l-2.57,-3.5l4.23,3.11l3.32,1.53l0.5,-0.14l1.29,-1.95l0.83,-2.85l2.04,-1.51l1.3,0.35Z" data-code="CL" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M504.86,320.38l0.39,0.01l0.27,-0.07l-0.3,0.35l-0.36,-0.28Z" data-code="XC" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M280.04,266.9l-1.66,3.44l0.11,0.49l0.5,-0.0l1.44,-1.15l1.05,0.52l-0.63,0.98l0.16,0.58l2.22,1.06l1.38,-0.83l1.97,0.93l-0.68,2.46l0.52,0.48l1.3,-0.48l0.99,3.78l-0.93,2.87l-0.77,0.09l-1.25,-0.52l0.49,-2.7l-0.87,-0.87l-0.52,0.06l-2.77,3.06l-0.43,-0.04l1.14,-1.12l-0.14,-0.66l-2.4,-0.9l-7.4,0.09l-0.2,-0.58l1.35,-1.14l0.02,-0.6l-0.8,-0.75l1.91,-2.12l2.57,-6.16l1.48,-2.16l1.98,-1.26l0.5,0.08l-1.6,3.09ZM68.32,168.48l4.07,1.51l3.89,3.35l2.78,0.73l0.42,-0.15l2.16,-2.88l2.84,-2.09l3.89,0.75l3.71,-3.14l3.71,-1.66l1.54,2.72l0.62,0.1l1.99,-1.93l0.48,-2.97l1.15,0.53l4.17,6.45l0.67,0.01l2.68,-3.95l0.27,4.33l0.54,0.35l3.08,-1.17l1.05,-2.04l2.63,0.36l3.83,3.0l5.86,2.58l3.48,1.19l2.44,-0.39l2.95,3.04l-3.23,3.06l0.16,0.67l4.53,1.42l6.92,-0.76l1.96,-1.04l2.47,3.65l0.64,0.03l2.72,-3.33l-0.01,-0.52l-2.34,-2.61l1.33,-1.93l2.87,-0.3l1.88,-0.64l1.8,1.47l2.48,3.63l0.41,0.17l2.63,-0.5l4.62,2.96l3.83,-1.03l3.59,0.16l0.42,-0.43l-0.27,-3.92l1.8,-0.96l3.49,2.08l-0.01,6.03l0.34,0.4l0.44,-0.28l1.5,-4.95l1.69,0.15l0.43,-0.33l1.13,-6.89l-2.74,-4.66l-2.86,-2.89l0.19,-8.09l2.75,-5.34l2.86,1.11l2.44,3.36l3.31,8.33l-2.12,3.42l0.22,0.59l4.38,1.37l-0.01,6.85l0.29,0.39l0.45,-0.18l3.02,-4.91l2.56,3.84l-0.68,5.11l2.42,4.42l0.7,0.0l2.61,-4.74l1.86,-5.93l0.15,-7.44l3.08,0.48l3.57,1.03l3.18,3.35l0.14,3.2l-1.81,3.53l1.71,3.82l-0.29,2.9l-4.72,4.27l-3.21,0.89l-2.43,-1.77l-0.62,0.23l-0.74,3.09l-2.4,5.08l-0.73,2.58l-2.76,3.73l-3.68,0.5l-2.07,2.63l-0.15,3.32l-2.86,0.78l-3.1,4.45l-2.74,5.98l-0.98,4.09l-0.14,5.74l0.31,0.4l3.44,0.75l2.25,7.78l0.48,0.26l3.37,-0.88l4.49,1.92l2.43,1.68l1.92,2.2l3.09,1.21l2.61,1.84l6.65,0.69l-0.36,3.49l0.8,4.33l1.81,4.63l3.81,3.97l0.51,0.05l2.08,-1.51l1.37,-4.39l-1.31,-6.63l-1.54,-2.05l3.69,-1.91l2.84,-3.1l1.49,-3.43l-0.24,-3.19l-1.7,-3.97l-2.92,-3.49l2.86,-5.19l-1.09,-4.55l-0.81,-7.95l1.39,-0.99l4.1,1.4l2.62,0.54l2.14,-1.31l5.09,4.62l1.07,2.2l4.09,0.36l-0.06,3.98l0.83,6.25l2.42,1.04l1.74,2.7l0.57,0.11l3.63,-2.66l2.51,-5.54l1.22,-1.73l7.63,15.44l-0.95,2.7l0.14,0.45l3.3,2.51l2.23,2.5l4.1,1.23l1.45,1.25l0.96,3.51l2.08,0.8l0.87,1.37l0.17,4.34l-3.4,2.77l-4.22,1.5l-3.06,3.15l-4.04,0.61l-5.35,-0.82l-6.4,0.25l-2.32,2.87l-3.25,1.78l-6.48,8.38l-0.03,0.47l0.45,0.17l2.33,-0.73l3.98,-4.83l5.12,-3.08l3.49,-0.36l1.77,1.49l-2.18,2.58l0.8,4.03l1.01,2.99l3.5,1.85l4.14,-0.52l2.14,-3.2l0.24,1.68l1.22,0.99l-2.64,2.0l-5.49,2.09l-2.54,1.45l-2.73,2.43l-1.38,-0.18l-0.08,-2.39l4.16,-2.8l0.16,-0.45l-0.39,-0.28l-4.01,0.12l-2.61,0.4l-1.4,-1.73l-0.12,-5.1l-1.11,-1.06l-1.83,0.44l-0.65,-0.76l-0.63,0.03l-1.91,2.77l-0.81,2.9l-0.81,1.48l-1.66,0.64l-0.47,0.87l-8.32,0.08l-1.21,0.71l-2.33,2.23l-0.72,-0.14l-1.36,1.08l-1.12,-0.54l-4.75,1.43l-0.9,1.32l0.21,0.59l1.7,0.22l0.05,0.22l-1.84,0.36l-1.85,0.9l-1.19,-0.29l-0.92,0.15l-2.95,2.0l-0.71,-0.11l0.32,-0.68l1.12,-1.78l1.72,-1.33l0.09,-2.6l1.16,-2.28l0.48,0.59l2.03,0.48l0.42,-0.16l0.82,-1.6l-2.66,-4.02l-2.29,-0.71l-5.63,-0.81l-0.4,-0.66l-0.86,0.2l0.27,-0.64l-0.21,-0.52l-0.72,-0.32l0.32,-1.06l-0.91,-1.28l0.34,-0.82l-0.29,-0.55l-2.6,-0.52l-0.76,-1.93l-0.95,-0.76l-1.67,-0.09l-2.67,-0.67l-1.13,1.4l-1.48,0.69l-0.85,1.24l-2.8,-0.89l-2.1,0.45l-2.38,-1.13l-4.23,-0.83l-0.58,-0.48l-0.42,-1.96l-0.4,-0.32l-0.85,0.02l-0.39,0.4l-0.01,1.07l-69.11,-0.01l-6.5,-5.37l-4.5,-1.66l-1.29,-3.28l0.34,-2.39l-0.2,-0.41l-3.03,-1.66l-0.52,-3.39l-2.92,-2.97l-0.05,-1.94l1.39,-2.23l-0.07,-2.8l-4.34,-3.13l-4.08,-8.55l-4.01,-4.22l-1.31,-2.51l-0.57,-0.15l-2.51,1.6l-2.18,2.42l-3.81,-5.1l-2.44,-1.39l-2.26,-0.18l0.03,-55.45ZM265.75,272.87l-0.72,0.04l-3.11,-1.15l-1.72,-1.35l3.19,0.89l2.36,1.57ZM249.33,12.09l6.65,1.61l5.26,2.56l4.43,5.22l-0.1,4.84l-5.98,7.79l-6.13,3.67l-2.26,3.84l0.35,0.6l4.74,-0.08l-5.52,9.28l-4.14,4.52l-4.23,11.87l-5.01,2.26l-1.69,2.82l-7.4,1.42l-0.32,0.34l0.22,0.41l3.02,1.48l-1.51,2.34l2.02,6.18l-2.26,4.04l-3.94,3.58l-1.16,4.49l-3.53,3.68l0.35,2.54l0.44,0.34l3.85,-0.39l0.04,2.09l-6.37,6.12l-6.3,-2.81l-7.5,1.6l-3.7,-1.27l-4.4,-0.52l-0.28,-4.64l4.41,-2.41l0.2,-0.41l-1.19,-8.1l1.06,-0.58l6.49,4.94l0.49,-0.0l0.12,-0.48l-3.41,-7.64l-3.92,-2.37l1.85,-4.46l4.51,-3.29l0.71,-4.65l-3.55,-5.6l-0.98,-6.84l6.22,0.58l1.88,1.51l0.57,-0.08l3.91,-5.41l-0.21,-0.62l-5.64,-1.76l-8.71,0.93l-4.24,-5.03l-2.06,-6.44l-2.92,-4.92l-0.52,-5.65l3.5,-3.22l2.94,-0.62l4.91,-2.99l3.67,-6.97l2.62,0.86l2.63,5.2l0.41,0.22l0.34,-0.32l1.88,-10.36l3.17,-3.13l4.37,-2.24l7.32,-0.83l1.2,2.03l0.52,0.16l7.1,-3.49l10.71,2.64ZM203.82,140.61l1.98,5.56l0.38,0.26l0.37,-0.27l2.27,-6.74l5.84,-3.34l4.06,8.5l-0.37,5.31l0.57,0.39l4.95,-2.38l2.28,-3.11l5.2,3.94l3.34,3.74l0.31,3.32l0.54,0.34l4.32,-1.65l2.44,4.64l6.13,3.12l2.09,2.87l2.25,6.4l-4.35,3.07l-0.01,0.65l5.9,4.44l3.95,1.47l3.53,5.87l3.81,0.57l-0.69,3.91l-4.11,6.58l-2.68,-2.22l-3.9,-5.85l-0.43,-0.17l-3.24,0.78l-0.3,0.35l-0.24,3.8l2.63,3.5l3.42,2.75l0.96,1.44l1.58,5.48l-0.73,3.38l-2.67,-1.26l-6.25,-4.45l-0.52,0.05l-0.04,0.52l6.1,8.03l0.24,1.1l-6.09,-1.92l-5.3,-3.12l-2.77,-2.46l0.72,-1.31l-0.1,-0.51l-7.38,-5.75l-0.64,0.33l0.03,1.33l-6.7,0.85l-1.79,-1.68l1.46,-3.85l4.49,-0.1l5.15,-0.77l0.31,-0.54l-0.79,-2.04l0.83,-2.91l3.22,-6.15l-0.67,-3.24l-1.07,-2.43l-3.84,-3.29l-4.67,-2.18l1.24,-1.37l0.05,-0.47l-2.65,-4.44l-2.33,-0.57l-1.88,-2.37l-0.65,0.04l-1.25,2.02l-4.3,0.88l-9.0,-1.6l-5.26,-2.14l-3.98,-1.1l-1.81,-2.3l2.43,-3.26l-0.32,-0.64l-3.2,-0.03l-0.75,-7.66l1.89,-7.38l2.46,-3.41l5.58,-2.04l-1.59,4.91ZM261.18,282.95l2.07,0.7l1.54,-0.05l-0.57,0.69l-0.66,0.17l-2.92,-1.41l-0.44,-0.86l0.38,-0.46l0.61,1.23ZM230.78,185.0l-2.28,0.26l-0.54,-2.72l0.98,-3.45l1.88,-0.76l1.65,1.57l0.03,2.61l-0.24,0.76l-1.47,1.73ZM229.41,141.37l0.16,1.75l-4.89,-0.38l-2.72,1.08l-0.48,-0.34l-2.65,-4.39l0.09,-2.82l0.87,-0.43l5.47,0.92l4.14,4.61ZM222.03,214.7l-0.78,2.22l-0.56,-0.23l-0.54,-1.3l0.87,-1.54l0.57,0.07l0.44,0.77ZM183.65,102.44l3.0,3.59l4.7,-0.02l1.97,3.24l-0.41,4.19l2.83,2.3l1.84,2.54l6.99,1.27l4.2,-2.19l4.96,-0.84l3.84,0.67l2.53,3.56l0.53,3.8l-1.43,2.32l-3.48,1.88l-3.25,-1.1l-7.15,1.44l-5.04,0.16l-3.95,-1.13l-6.43,-2.95l-0.83,-5.12l-0.3,-4.98l-2.56,-4.72l-5.31,-1.46l-2.69,-3.1l0.83,-3.99l4.63,0.64ZM207.36,195.03l0.42,2.4l0.63,0.26l0.99,-0.72l1.27,1.36l5.47,3.76l0.21,2.54l0.49,0.36l1.62,-0.39l1.33,1.4l-1.71,1.36l-3.54,-1.23l-1.33,-2.43l-0.66,-0.06l-2.46,2.99l-3.05,2.47l-0.7,-2.67l-0.45,-0.29l-2.39,0.38l1.64,-2.22l0.32,-4.55l0.78,-5.03l1.13,0.31ZM215.49,211.5l-2.69,2.74l-1.33,-0.09l-0.38,-1.01l1.61,-2.18l2.82,0.04l-0.02,0.5ZM202.66,70.17l2.91,4.33l-3.3,3.83l-4.54,9.4l-4.14,0.83l-4.93,-1.5l-2.57,-4.9l0.04,-4.53l1.93,-3.49l-0.36,-0.59l-4.35,0.1l-2.61,-4.34l-1.55,-6.33l1.71,-6.55l1.67,-4.57l2.41,-1.04l0.22,-0.48l-0.96,-3.26l5.05,-0.73l3.21,8.41l8.21,6.06l1.95,9.35ZM187.39,143.67l-2.74,6.11l-2.28,-0.24l-1.49,-6.99l0.04,-4.2l1.26,-3.63l2.29,-2.28l4.96,0.3l4.35,2.01l-3.51,7.33l-2.87,1.59ZM186.12,124.07l-1.2,3.26l-3.2,-0.62l-2.75,-2.26l1.22,-4.02l3.15,-2.36l1.93,3.09l0.86,2.91ZM185.64,96.93l-0.83,0.24l-4.33,-0.68l-0.51,-2.52l4.35,0.15l1.52,1.89l-0.2,0.91ZM180.62,90.66l-3.24,2.16l-1.76,-2.41l-1.05,-4.51l-0.18,-4.75l2.69,0.43l1.32,0.77l2.85,4.19l-0.63,4.11ZM180.98,172.19l-1.22,1.91l-3.04,-1.9l-2.16,0.64l-2.93,-2.72l1.98,-2.02l1.52,-2.75l3.72,3.03l2.13,3.8ZM169.77,135.22l2.97,1.73l4.08,-1.03l0.51,2.03l-2.26,4.02l0.07,0.48l3.66,3.51l-0.43,6.97l-3.8,2.82l-2.06,-0.56l-1.71,-2.96l-6.1,-6.18l0.04,-2.04l4.64,0.95l0.44,-0.57l-2.66,-5.4l2.61,-3.78ZM174.46,107.75l1.36,3.53l0.08,5.21l-1.09,7.07l-3.71,0.89l-2.35,-1.35l0.05,-5.54l-0.47,-0.4l-3.64,0.69l-0.14,-7.04l2.56,0.16l3.62,-3.51l3.32,0.59l0.42,-0.3ZM170.01,87.71l0.84,4.38l-3.36,-1.1l-4.3,-4.01l-4.91,-0.41l2.06,-3.18l-0.05,-0.5l-2.92,-2.99l-0.16,-4.33l4.31,1.6l6.62,4.67l1.87,5.86ZM134.6,141.21l-1.16,3.7l0.55,0.48l5.29,-2.43l3.29,4.01l0.64,-0.03l2.53,-3.85l1.89,2.29l2.03,7.94l0.37,0.3l0.4,-0.26l1.28,-3.56l-1.72,-8.28l1.76,-1.01l2.22,1.24l2.69,3.29l2.45,13.62l8.57,7.16l-0.23,2.66l-3.8,0.53l-0.29,0.6l1.51,2.57l-0.67,2.03l-4.14,-1.0l-4.49,-1.91l-3.03,0.47l-4.65,2.34l-10.43,1.63l-1.41,-3.17l-3.42,-1.92l-2.23,0.65l-2.72,-5.01l5.02,-1.82l3.63,0.3l3.27,-1.29l0.25,-0.38l-0.26,-0.37l-4.84,-1.75l-5.5,0.57l-3.28,-0.14l-1.06,-2.23l5.47,-2.91l0.2,-0.46l-0.4,-0.3l-3.77,0.11l-3.96,-1.88l1.97,-5.68l1.69,-3.21l6.41,-4.99l2.07,1.35ZM158.82,138.54l-1.83,4.71l-3.34,-5.15l0.6,-0.86l2.98,-0.32l1.59,1.62ZM149.59,111.85l0.99,3.73l0.63,0.21l2.09,-1.62l2.15,0.37l0.41,4.59l-1.42,4.36l-8.24,1.45l-6.38,4.09l-3.32,0.18l-0.26,-2.47l5.03,-4.13l0.12,-0.46l-0.41,-0.24l-11.2,1.15l-3.08,-1.54l3.28,-9.52l2.11,-2.66l6.67,3.38l4.39,5.99l4.63,0.92l0.44,-0.53l-3.52,-9.7l2.01,-3.46l2.07,1.01l0.81,4.89ZM145.71,84.15l-2.55,2.05l-3.61,-0.01l0.03,-1.26l2.32,-3.45l0.99,0.43l2.82,2.24ZM144.69,94.95l-4.27,3.06l-3.27,-3.31l1.81,-3.41l3.34,-1.13l3.11,1.67l-0.73,3.12ZM118.92,155.09l-5.99,3.39l-1.29,-3.14l-5.55,-4.03l2.72,-9.3l2.17,-5.73l-2.25,-5.4l7.82,-1.34l3.61,1.91l6.24,0.5l2.31,2.51l2.44,3.4l-2.87,2.01l-6.21,6.07l-3.1,5.73l-0.05,3.42ZM129.56,96.45l-0.31,7.96l-1.8,3.53l-2.35,0.59l-4.6,4.46l-3.74,1.48l-2.92,-1.93l4.07,-7.68l5.0,-7.12l3.62,0.15l3.02,-1.45ZM111.13,275.3l-0.71,0.3l-3.83,-1.6l-0.83,-1.38l-2.13,-1.28l-0.67,-1.21l-2.4,-0.65l-0.75,-2.19l3.73,1.32l2.25,0.41l2.0,3.05l2.52,1.64l0.8,1.62ZM87.8,253.38l0.9,0.35l1.87,-0.27l-0.67,4.25l1.83,2.97l-1.42,-1.69l-0.98,-1.97l-1.19,-1.23l-0.34,-2.41Z" data-code="CA" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M466.72,406.37l-0.1,1.03l-1.25,2.97l-0.19,3.62l-0.46,1.78l-0.23,0.63l-1.61,1.19l-1.21,1.39l-1.09,2.43l0.04,2.09l-3.25,3.25l-0.5,-0.24l-0.5,-0.83l-1.36,-0.02l-0.98,0.89l-1.68,-0.99l-1.54,1.24l-1.52,-1.96l1.57,-1.14l0.11,-0.52l-0.77,-1.35l2.1,-0.66l0.39,-0.73l1.05,0.82l2.21,0.11l1.12,-1.37l0.37,-1.81l-0.27,-2.09l-1.13,-1.5l1.0,-2.69l-0.13,-0.45l-0.92,-0.58l-1.6,0.17l-0.51,-0.94l0.1,-0.61l2.75,0.09l3.97,1.24l0.51,-0.33l0.17,-1.28l1.24,-2.21l1.28,-1.14l2.76,0.49Z" data-code="CG" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M461.16,408.1l-0.26,-1.19l-1.09,-0.77l-0.84,-1.18l-0.29,-1.0l-1.04,-1.15l0.08,-3.44l0.58,-0.49l1.16,-2.36l1.85,-0.17l0.61,-0.62l0.97,0.58l3.15,-0.97l2.48,-1.92l0.02,-0.96l2.82,0.02l2.36,-1.18l1.93,-2.86l1.16,-0.94l1.11,-0.31l0.27,0.87l1.34,1.48l-0.39,2.02l0.3,1.01l4.01,2.76l0.17,0.93l2.63,2.31l0.6,1.44l2.08,1.4l-3.84,-0.21l-1.94,0.88l-1.24,-0.49l-2.67,1.2l-1.29,-0.18l-0.51,0.37l-0.6,1.22l-3.35,-0.65l-1.57,-0.91l-2.42,-0.83l-1.45,0.91l-0.97,1.28l-0.26,1.56l-3.22,-0.43l-1.49,1.33l-0.94,1.62Z" data-code="CF" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M487.01,402.27l2.34,-0.14l1.35,1.84l1.34,0.45l0.86,-0.39l1.21,0.12l1.07,-0.41l0.54,0.89l2.04,1.54l-0.14,2.72l0.7,0.54l-1.38,1.13l-1.53,2.54l-0.17,2.05l-0.59,1.08l-0.02,1.72l-0.72,0.84l-0.66,3.01l0.63,1.32l-0.44,4.26l0.64,1.47l-0.37,1.22l0.86,1.8l1.53,1.42l0.3,1.27l0.44,0.51l-4.08,0.75l-0.92,1.82l0.51,1.35l-0.74,5.46l0.17,0.38l2.45,1.47l0.54,-0.1l0.12,1.64l-1.28,-0.01l-1.85,-2.37l-1.94,-0.45l-0.48,-1.14l-0.56,-0.2l-1.41,0.74l-1.71,-0.3l-1.01,-1.19l-2.49,-0.2l-0.44,-0.77l-1.98,-0.21l-2.88,0.36l0.11,-2.42l-0.85,-1.13l-0.16,-1.36l0.32,-1.74l-0.47,-0.89l-0.04,-1.5l-0.4,-0.39l-2.53,0.02l0.1,-0.41l-0.39,-0.49l-1.28,0.01l-0.43,0.46l-1.62,0.32l-0.83,1.8l-1.09,-0.28l-2.4,0.52l-1.37,-1.91l-1.3,-3.31l-0.38,-0.27l-7.39,-0.03l-2.46,0.42l0.5,-0.45l0.37,-1.47l0.66,-0.38l0.92,0.08l0.73,-0.82l0.87,0.02l0.31,0.68l1.4,0.36l3.59,-3.63l0.01,-2.23l1.02,-2.29l2.69,-2.39l0.43,-0.99l0.49,-1.96l0.17,-3.51l1.25,-2.95l0.36,-3.15l0.86,-1.13l1.1,-0.67l3.57,1.73l3.65,0.73l0.46,-0.21l0.8,-1.46l1.24,0.19l2.61,-1.17l0.81,0.44l1.04,-0.03l0.59,-0.66l0.7,-0.16l1.81,0.25Z" data-code="CD" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M458.44,265.89l1.23,1.2l1.49,0.27l0.09,1.1l1.36,0.81l0.58,-0.21l0.25,-0.67l1.12,0.29l0.53,1.3l1.67,0.21l0.69,1.14l-1.4,1.19l-0.12,0.65l-0.55,0.55l-1.59,0.21l-0.56,0.65l-1.03,-0.52l-1.03,0.17l-2.15,-1.12l-1.05,0.4l-1.18,1.3l-1.53,-1.0l-2.59,-2.49l-0.57,-2.36l1.48,-0.7l0.99,-1.01l1.72,-0.74l0.54,-0.59l0.73,0.29l0.87,-0.32Z" data-code="CZ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M504.35,321.02l0.49,0.34l-1.34,0.65l-0.91,-0.29l-0.26,-0.55l2.02,-0.14Z" data-code="CY" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M211.34,387.89l0.48,1.0l1.61,1.62l-0.54,0.45l0.3,1.42l-0.25,1.2l-1.09,-0.6l-0.05,-1.25l-2.46,-1.43l-0.28,-0.77l-0.66,-0.45l-0.45,-0.0l-0.11,1.05l-1.32,-0.95l0.31,-1.31l-0.36,-0.6l0.31,-0.27l1.42,0.58l1.29,-0.14l0.56,0.56l0.74,0.17l0.55,-0.27Z" data-code="CR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M221.21,356.57l1.27,1.05l2.18,-0.29l4.43,3.42l2.09,0.45l-0.1,0.41l0.36,0.49l1.75,0.1l1.44,0.97l-3.07,0.42l-4.17,-0.03l0.79,-0.7l-0.04,-0.63l-1.2,-0.76l-1.49,-0.16l-0.7,-0.62l-0.56,-1.44l-0.4,-0.25l-1.34,0.1l-2.2,-0.68l-0.89,-0.6l-3.18,-0.41l-0.28,-0.17l0.6,-0.76l-0.36,-0.29l-2.73,-0.05l-1.7,1.33l-0.91,0.03l-0.61,0.71l-1.03,0.22l1.14,-1.35l1.01,-0.54l3.69,-1.04l3.98,0.22l2.21,0.87Z" data-code="CU" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M500.35,482.11l0.5,2.14l-0.39,0.94l-1.04,0.22l-1.23,-1.25l-0.02,-0.69l0.84,-1.65l1.34,0.28Z" data-code="SZ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M510.98,327.85l0.08,-1.44l0.55,-1.47l1.28,-1.07l0.12,-0.44l-0.41,-1.19l-1.14,-0.38l-0.19,-1.91l0.53,-1.11l1.29,-1.31l0.19,-1.27l0.6,0.24l2.61,-0.82l1.36,0.56l2.06,-0.01l2.95,-1.17l3.29,-0.29l-0.72,1.1l-1.49,1.11l0.23,2.19l-0.89,3.46l-10.14,6.13l-2.17,-0.92Z" data-code="SY" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M621.37,297.76l-3.91,1.98l-0.95,1.31l-3.03,0.37l-1.14,2.06l-2.35,-0.39l-2.01,0.7l-2.39,1.55l0.09,1.02l-0.42,0.44l-4.5,0.47l-3.01,-1.02l-2.38,0.19l0.12,-0.96l2.3,0.46l1.14,-0.97l1.99,0.21l3.21,-2.37l-0.03,-0.67l-2.97,-1.75l-1.95,0.72l-1.27,-0.86l1.77,-1.84l-0.12,-0.64l-0.4,-0.18l0.36,-0.95l1.35,-0.39l4.01,1.14l0.5,-0.31l0.35,-1.82l1.08,-0.54l3.4,1.37l1.14,-0.35l7.61,0.43l1.15,1.13l1.27,0.45Z" data-code="KG" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M506.26,414.59l1.87,-2.56l0.93,-2.15l-1.38,-4.08l-1.06,-1.6l2.82,-2.75l0.79,0.26l0.12,1.41l0.86,0.83l1.9,0.11l3.28,2.13l3.57,0.44l1.05,-1.12l1.96,-0.9l0.82,0.69l1.16,0.09l-1.78,2.45l0.03,9.12l1.3,1.94l-1.37,0.78l-0.67,1.03l-1.08,0.46l-0.34,1.67l-0.81,1.07l-0.45,1.55l-0.68,0.56l-3.2,-2.23l-0.35,-1.58l-8.86,-4.98l0.14,-1.6l-0.57,-1.04Z" data-code="KE" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M481.71,393.21l1.07,-0.73l1.2,-3.2l1.36,-0.26l1.61,2.0l0.87,0.34l1.11,-0.41l1.5,0.07l0.57,0.53l2.49,0.0l0.44,-0.63l1.07,-0.4l0.45,-0.84l0.59,-0.33l1.9,1.34l1.6,-0.2l2.83,-3.35l-0.32,-2.23l1.6,-0.53l-0.24,1.62l0.3,1.84l1.34,1.18l0.2,1.88l0.35,0.41l0.02,1.54l-0.23,0.47l-1.42,0.25l-0.85,1.44l0.3,0.6l1.4,0.17l1.12,1.08l0.59,1.13l1.03,0.53l1.28,2.37l-4.42,3.99l-1.74,0.01l-1.89,0.55l-1.47,-0.52l-1.15,0.57l-2.96,-2.62l-1.3,0.49l-1.06,-0.15l-0.79,0.39l-0.82,-0.22l-1.8,-2.7l-1.91,-1.1l-0.66,-1.5l-2.62,-2.33l-0.18,-0.94l-2.37,-1.61Z" data-code="SS" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M283.12,400.08l2.1,0.53l-1.08,1.95l0.2,1.72l0.93,1.49l-0.59,2.04l-0.43,0.71l-1.12,-0.42l-1.32,0.22l-0.93,-0.2l-0.46,0.26l-0.25,0.73l0.33,0.7l-0.89,-0.13l-1.39,-1.98l-0.31,-1.34l-0.97,-0.31l-0.89,-1.47l0.35,-1.61l1.45,-0.82l0.33,-1.87l2.61,0.44l0.58,-0.47l1.75,-0.16Z" data-code="SR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M689.52,379.15l0.5,1.47l-0.28,2.77l-4.0,1.87l-0.16,0.59l0.69,0.97l-2.06,0.17l-2.05,0.97l-1.82,-0.32l-0.9,-1.17l-1.23,-2.56l-0.55,-2.88l1.4,-1.87l3.01,-0.46l2.23,0.35l2.01,0.99l0.51,-0.14l0.95,-1.49l1.74,0.75Z" data-code="KH" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M195.8,379.9l1.41,-1.21l2.24,1.46l0.98,-0.27l0.44,0.21l-0.27,1.07l-1.14,-0.03l-3.65,-1.23Z" data-code="SV" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M476.87,273.43l-1.2,2.33l-2.74,-1.08l-1.05,0.4l-0.52,0.78l-3.44,0.85l-0.48,0.81l-1.74,0.38l-1.88,-1.17l-0.2,-1.03l0.4,-0.94l1.02,0.01l0.86,-0.39l1.74,-2.23l0.83,0.19l0.76,-0.39l1.06,1.14l0.49,0.08l1.33,-0.74l1.26,0.34l1.63,-0.49l1.87,1.16Z" data-code="SK" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M737.47,312.73l1.03,-0.11l0.87,-1.28l2.69,-0.35l0.32,-0.3l1.75,3.04l0.59,1.94l0.02,3.41l-0.81,1.45l-2.22,0.59l-1.92,1.21l-1.79,0.21l-0.2,-1.21l0.44,-2.44l-0.97,-2.83l1.45,-0.41l0.23,-0.6l-1.48,-2.32Z" data-code="KR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M456.18,286.22l-0.51,-1.56l0.2,-1.29l1.68,0.23l1.44,-0.83l2.08,-0.09l0.62,-0.56l0.24,0.62l-1.66,0.8l-0.43,1.53l-0.67,0.28l-0.24,0.94l-1.2,-0.55l-0.54,0.09l-0.33,0.43l-0.67,-0.05Z" data-code="SI" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M736.77,312.06l-0.91,-0.45l-0.89,0.68l-1.23,-0.97l0.49,-1.01l0.5,-0.32l0.58,-2.78l-0.45,-0.8l-1.38,-0.34l-0.75,-0.55l1.69,-1.74l2.72,-1.75l1.57,-2.11l1.1,0.86l2.17,0.12l0.41,-0.49l-0.32,-1.43l3.54,-1.33l0.93,-1.56l1.03,1.28l-1.46,1.26l-0.79,1.2l0.02,2.38l-1.08,0.61l-1.41,1.55l-1.7,0.58l-1.23,1.17l-0.16,2.14l2.12,1.67l-0.16,0.33l-2.59,0.32l-1.14,1.41l-1.21,0.08Z" data-code="KP" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M540.8,336.41l0.38,0.92l-0.17,0.78l0.61,1.64l-0.95,0.04l-0.83,-1.35l-1.59,-0.2l1.34,-2.02l1.21,0.17Z" data-code="KW" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M390.09,377.95l0.12,1.57l0.49,1.48l0.96,0.82l0.05,1.3l-1.26,-0.19l-0.75,0.33l-1.84,-0.62l-5.84,-0.13l-2.54,0.51l-0.22,-1.04l1.78,0.04l2.01,-0.92l1.03,0.48l1.09,0.05l1.29,-0.62l0.14,-0.58l-0.51,-0.74l-1.81,0.25l-1.13,-0.64l-0.79,0.04l-0.72,0.61l-2.31,0.06l-0.92,-1.79l-0.82,-0.65l0.64,-0.36l1.81,-3.15l0.65,-0.64l1.04,0.19l1.39,-0.56l1.19,-0.02l2.72,1.39l3.03,3.53Z" data-code="SN" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M394.46,393.98l-1.73,1.98l-0.58,1.34l-2.07,-1.06l-1.22,-1.26l-0.65,-2.4l1.16,-0.97l0.67,-1.18l1.21,-0.52l1.66,0.0l1.03,1.65l0.52,2.42Z" data-code="SL" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M552.75,298.52l0.51,-1.47l-0.48,-1.19l-2.96,-1.32l-1.07,-2.94l-1.37,-0.98l-0.03,-0.45l1.95,0.27l0.45,-0.38l0.09,-2.29l1.75,-0.47l2.09,0.51l0.49,-0.34l0.45,-3.5l-0.45,-2.38l-0.42,-0.32l-2.41,0.17l-2.39,-0.84l-2.87,1.59l-2.15,0.7l-0.86,-0.4l0.15,-1.86l-1.6,-2.47l-2.02,-0.09l-1.83,-2.19l1.33,-2.64l-0.61,-1.04l1.66,-3.54l2.17,1.91l0.66,-0.26l0.29,-2.7l4.94,-4.15l3.67,-0.1l8.38,4.33l2.97,-1.63l3.74,-0.08l3.1,1.99l0.56,-0.13l0.6,-0.97l3.28,0.16l0.4,-0.27l0.63,-1.89l-0.15,-0.46l-3.62,-2.47l1.99,-1.65l-0.2,-1.23l2.05,-0.92l0.17,-0.58l-1.66,-2.63l0.88,-1.1l9.22,-1.46l1.35,-1.1l6.17,-1.58l2.26,-1.78l4.05,0.85l0.74,4.22l0.54,0.3l2.46,-0.98l2.8,1.27l-0.18,2.03l0.44,0.43l2.58,-0.3l4.83,-3.09l0.03,0.36l3.16,3.23l5.57,10.31l0.69,0.03l1.11,-1.75l3.11,2.07l3.78,-0.93l1.13,0.59l1.15,2.17l1.83,0.89l1.0,1.55l0.4,0.18l2.95,-0.47l1.06,1.89l-1.65,2.2l-1.92,0.33l-0.33,0.38l-0.12,3.61l-1.14,1.37l-4.73,-1.15l-0.48,0.28l-1.76,6.36l-1.1,0.68l-4.91,1.4l-0.26,0.52l2.13,5.72l-1.4,0.73l-0.08,1.73l-0.87,-0.28l-1.43,-1.27l-7.9,-0.45l-0.92,0.34l-3.74,-1.37l-1.63,0.99l-0.31,1.59l-3.7,-1.05l-1.87,0.48l-0.76,1.57l-1.35,0.6l-3.3,2.34l-1.12,2.31l-0.42,0.01l-0.93,-1.56l-2.86,-0.1l-0.45,-2.43l-0.39,-0.33l-0.81,-0.02l0.02,-3.32l-3.0,-2.52l-4.58,0.18l-2.74,0.47l-2.34,-3.04l-6.74,-4.23l-6.45,2.1l-0.28,0.38l0.1,12.31l-0.69,0.09l-1.62,-2.42l-1.83,-1.07l-3.13,0.66l-0.68,0.6Z" data-code="KZ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M537.53,338.97l2.0,0.25l0.91,1.39l1.49,-0.06l0.88,2.19l1.29,0.79l0.51,1.03l1.56,1.08l-0.1,1.98l0.32,0.93l1.57,2.56l0.76,0.55l0.71,-0.04l1.37,4.1l7.83,1.63l0.51,-0.29l0.77,1.29l-1.56,5.0l-7.29,2.58l-7.31,1.05l-2.34,1.19l-1.88,2.79l-0.76,0.28l-0.83,-0.79l-0.91,0.12l-2.88,-0.52l-3.5,0.25l-0.86,-0.57l-0.58,0.15l-0.66,1.29l0.16,1.12l-0.43,0.33l-0.93,-1.42l-0.33,-1.18l-1.23,-0.89l-1.27,-2.1l-0.78,-2.27l-1.73,-1.83l-1.14,-0.49l-1.54,-2.37l-0.2,-3.5l-1.44,-3.02l-1.27,-1.19l-1.33,-0.58l-1.31,-3.5l-0.77,-0.7l-0.97,-2.05l-2.8,-4.2l-1.07,-0.17l0.59,-2.85l2.75,0.31l1.08,-0.88l0.6,-0.99l1.74,-0.36l0.65,-1.08l0.72,-0.43l0.1,-0.6l-2.09,-2.45l4.42,-1.3l0.48,-0.39l2.75,0.73l3.66,2.01l7.03,5.8l4.88,0.32Z" data-code="SA" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M480.3,192.35l-4.15,1.76l-2.43,4.19l0.32,3.66l-3.86,4.45l-4.93,4.95l-1.79,7.79l1.78,3.64l2.29,2.71l-2.14,5.19l-2.69,1.39l-0.95,7.87l-1.3,3.9l-2.71,-0.39l-0.43,0.25l-1.32,3.3l-2.29,0.16l-0.75,-3.94l-2.09,-5.18l-1.86,-6.56l1.04,-2.66l2.12,-3.53l0.83,-6.02l-1.6,-2.83l-0.15,-7.02l1.52,-4.93l2.18,0.09l0.39,-0.26l0.87,-2.28l-0.85,-2.14l3.83,-8.36l4.06,-11.45l2.12,0.02l0.4,-0.33l0.59,-3.35l4.31,1.0l0.49,-0.36l0.34,-4.24l1.04,-0.19l6.98,7.72l0.07,9.8l0.74,2.18Z" data-code="SE" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M505.98,389.25l-0.34,-0.78l-1.17,-0.91l-0.27,-1.62l0.29,-1.82l-0.34,-0.46l-1.16,-0.18l-0.54,0.59l-1.23,0.11l-0.28,0.65l0.53,0.66l0.17,1.23l-2.44,3.01l-0.96,0.2l-2.39,-1.41l-0.95,0.52l-0.38,0.78l-1.11,0.41l-0.29,0.5l-1.94,0.0l-0.54,-0.52l-1.81,-0.09l-0.95,0.41l-2.45,-2.36l-2.07,0.54l-0.73,1.27l-0.6,2.11l-1.25,0.58l-0.75,-0.62l0.27,-2.67l-1.48,-1.78l-0.22,-1.49l-0.92,-0.97l-0.02,-1.3l-0.57,-1.17l-0.69,-0.16l0.7,-1.31l-0.18,-1.15l0.65,-0.63l0.03,-0.55l-0.36,-0.42l1.56,-3.02l1.91,0.16l0.43,-0.4l-0.1,-11.14l2.49,-0.01l0.4,-0.4l-0.0,-4.96l29.02,0.0l0.65,2.11l-0.49,0.67l0.36,2.75l0.93,3.22l2.12,1.59l-0.9,1.07l-1.72,0.4l-0.98,0.91l-1.42,5.73l0.24,1.16l-0.38,2.09l-0.97,2.4l-1.53,1.32l-1.32,2.93l-1.22,0.86l-0.37,1.34Z" data-code="SD" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M241.8,368.82l0.05,-0.67l-0.47,-0.75l0.43,-0.45l0.19,-1.02l-0.09,-1.57l1.66,0.01l1.99,0.64l0.33,0.69l1.29,0.19l0.33,0.77l0.99,0.09l0.81,0.64l-0.46,0.53l-1.13,-0.48l-1.87,-0.01l-1.27,0.6l-0.75,-0.56l-1.01,0.55l-0.79,1.43l-0.23,-0.62Z" data-code="DO" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M528.43,386.01l-0.45,0.67l-0.58,-0.25l-1.51,0.13l-0.18,-1.02l1.45,-1.97l0.83,0.17l0.77,-0.44l0.2,1.01l-1.21,0.52l-0.06,0.7l0.73,0.48Z" data-code="DJ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M452.3,246.5l-1.22,2.88l-2.11,-1.99l-0.26,-1.39l2.98,-1.2l0.61,1.7ZM447.78,242.9l-0.32,0.89l-0.89,-0.07l-1.8,3.21l0.54,2.1l-1.13,0.47l-1.58,-0.48l-0.91,-2.19l-0.07,-4.44l0.99,-2.3l2.0,-0.26l1.11,-1.38l1.3,-0.85l-0.05,1.54l-0.73,1.69l0.3,1.28l1.25,0.79Z" data-code="DK" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M453.15,278.66l-0.56,-0.42l-1.2,-0.11l-1.89,0.66l-2.12,-0.15l-0.57,0.71l-0.83,-0.67l-0.98,0.09l-2.56,-1.08l-0.49,0.15l-0.39,0.62l-1.46,-0.02l0.26,-2.16l1.24,-2.54l-0.28,-0.57l-3.51,-0.68l-0.95,-0.81l0.12,-1.49l-0.49,-1.0l0.27,-2.61l-0.38,-3.76l1.43,-0.25l0.63,-1.53l0.65,-3.87l-0.43,-1.44l0.31,-0.56l1.61,-0.18l0.34,0.68l0.67,0.07l1.7,-2.09l-0.57,-3.77l1.35,0.41l1.33,-0.45l0.28,1.46l2.27,0.9l-0.02,1.24l0.52,0.39l2.55,-0.8l1.33,-1.07l2.53,1.51l1.08,1.24l0.51,1.88l-0.61,1.39l0.88,1.43l0.58,2.06l-0.16,1.52l0.87,2.18l-0.54,0.2l-0.49,-0.34l-0.54,0.07l-0.57,0.68l-1.71,0.73l-1.01,1.02l-1.75,0.82l-0.2,0.5l0.84,2.98l2.45,2.3l-0.71,1.4l-1.0,0.83l0.33,2.27Z" data-code="DE" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M528.26,376.46l0.26,-0.43l-0.22,-1.03l0.28,-0.61l-0.09,-0.91l0.92,-0.7l-0.08,-1.37l0.39,-0.76l1.01,0.48l3.33,-0.27l3.76,0.42l0.95,0.82l1.36,-0.59l1.74,-2.67l2.18,-1.11l6.86,-0.96l2.48,5.52l-1.64,0.77l-0.56,1.93l-6.23,2.19l-2.29,1.82l-1.93,0.05l-1.41,1.03l-4.24,0.75l-1.72,1.5l-3.28,0.19l-0.52,-1.19l0.02,-1.52l-1.34,-3.33Z" data-code="YE" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M441.47,315.57l-0.34,1.19l0.39,2.88l-0.55,2.35l-1.58,1.92l0.36,2.53l1.92,1.66l0.17,0.85l1.43,1.1l1.85,7.66l0.13,1.23l-0.57,5.23l0.2,1.59l-0.88,1.03l-0.02,0.5l1.41,1.93l0.14,1.24l0.89,1.54l0.5,0.17l0.97,-0.42l1.72,1.11l0.83,1.29l-8.23,4.95l-7.23,5.24l-3.43,1.15l-2.3,0.21l-0.28,-1.63l-2.56,-1.12l-0.67,-1.28l-26.12,-18.48l0.01,-3.67l3.77,-1.98l2.44,-0.43l2.12,-0.8l1.08,-1.5l2.81,-1.11l0.34,-2.2l1.34,-0.31l1.04,-1.0l3.46,-0.73l0.36,-1.59l-0.58,-0.56l-0.83,-3.02l-0.18,-1.95l-0.8,-1.65l2.06,-1.44l2.62,-0.52l1.71,-1.32l2.31,-0.91l8.23,-0.8l1.51,0.41l2.27,-1.19l2.45,-0.02l0.91,0.65l1.38,-0.05Z" data-code="DZ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M892.73,206.44l1.34,0.72l1.36,-0.5l1.85,1.36l2.21,0.69l-1.59,1.04l-2.57,-2.02l-2.38,0.18l-0.3,-0.25l0.09,-1.21ZM183.2,272.56l0.38,1.78l1.12,0.96l4.22,0.82l2.39,1.15l2.19,-0.43l2.01,0.64l-1.73,0.85l-3.49,3.04l-0.14,0.83l0.52,0.39l2.3,-0.7l1.8,1.17l5.17,-2.8l-0.37,0.89l0.24,0.53l1.35,0.45l1.71,1.35l4.7,-1.01l0.4,0.77l1.58,0.45l0.68,0.78l-1.42,0.21l-2.2,-0.37l-3.59,1.03l-2.72,3.73l0.35,0.91l0.62,-0.0l0.61,-0.75l-1.43,5.39l0.29,3.47l0.67,1.77l0.61,0.48l1.03,-0.07l0.75,-0.43l1.59,-2.19l0.13,-2.45l-0.82,-2.2l0.11,-1.33l1.2,-2.74l0.42,-0.36l0.48,0.84l0.4,-0.3l0.4,-1.6l0.59,-0.51l0.24,-0.94l1.66,0.56l1.67,1.25l-0.03,2.8l-1.28,1.3l0.02,1.21l0.87,0.37l1.67,-1.46l0.49,0.18l0.51,3.02l-2.51,4.23l0.17,0.59l1.54,0.69l1.51,0.19l1.93,-0.49l4.72,-2.41l2.16,-2.03l-0.08,-1.39l0.77,-0.26l3.91,0.4l2.14,-1.19l0.19,-0.39l-0.31,-1.71l2.31,-2.21l1.0,-0.57l8.31,-0.03l0.57,-0.94l1.9,-0.88l0.92,-1.72l0.75,-2.75l1.58,-2.29l0.94,0.69l1.44,-0.54l0.81,0.77l-0.0,4.78l1.98,3.01l-2.38,1.52l-5.36,2.37l-1.81,3.03l0.01,1.98l0.83,1.79l0.78,0.27l-6.43,1.12l-2.21,1.0l-0.21,0.48l0.45,0.28l3.52,-0.57l-2.73,0.77l-1.77,-0.26l-0.76,0.91l0.23,0.65l0.34,0.07l-0.43,1.87l-1.26,1.73l-1.46,-1.16l-0.49,-0.06l-0.18,0.46l0.52,1.74l0.61,0.64l0.03,0.92l-0.94,1.5l-1.22,-1.31l-0.28,-2.52l-0.35,-0.35l-0.42,0.27l-0.48,1.39l0.34,1.57l-0.97,-0.29l-0.48,0.22l0.16,0.5l1.54,0.91l0.1,2.78l0.78,0.52l0.53,3.76l-1.43,2.04l-2.47,0.86l-1.71,1.78l-1.31,0.27l-1.27,1.11l-0.43,1.05l-2.7,1.91l-2.64,3.21l-0.45,2.23l0.45,2.17l0.85,2.51l1.09,2.0l0.04,1.26l1.16,3.2l-0.18,2.82l-0.55,1.49l-0.47,0.22l-0.88,-0.24l-0.33,-1.01l-1.03,-0.79l-2.75,-5.4l0.46,-2.04l-0.76,-1.66l-1.95,-2.41l-1.47,-0.55l-2.38,1.23l-1.46,-1.42l-1.79,-0.75l-2.78,0.36l-2.27,-0.31l-2.03,0.23l-1.04,0.45l-0.18,0.57l0.39,0.67l0.19,1.47l-0.9,-0.23l-0.84,0.49l-1.57,-0.08l-2.08,-1.52l-2.08,0.34l-1.91,-0.65l-3.74,0.89l-2.39,2.17l-2.54,1.28l-1.45,1.47l-0.61,1.43l-0.02,1.98l0.38,1.9l-1.99,-0.55l-1.81,-0.8l-1.25,-3.25l-1.44,-1.57l-2.24,-3.73l-1.76,-1.15l-2.28,-0.01l-1.71,2.18l-1.74,-0.72l-1.16,-0.78l-1.52,-3.14l-3.94,-3.35l-4.34,-0.0l-0.4,0.4l-0.0,0.81l-6.5,0.02l-9.04,-3.34l-0.33,-0.75l-5.69,0.52l-0.43,-1.37l-1.62,-1.72l-1.14,-0.41l-0.55,-0.94l-1.27,-0.14l-1.02,-0.83l-2.22,-0.29l-0.43,-0.33l-0.36,-1.7l-2.4,-3.06l-2.02,-4.21l-0.05,-0.96l-2.93,-3.59l-0.33,-2.54l-1.3,-1.83l0.52,-2.65l-0.09,-2.87l-0.78,-2.59l0.96,-3.2l0.61,-6.46l-0.46,-4.91l-1.48,-4.8l0.09,-0.23l3.09,1.09l1.27,3.33l0.71,0.07l0.68,-1.24l-1.12,-5.71l68.79,-0.0l0.4,-0.4l0.13,-1.09ZM32.37,157.48l1.75,3.33l0.67,0.06l0.98,-1.29l3.62,0.39l-0.12,1.35l0.27,0.41l3.83,1.28l2.65,-0.7l5.14,2.3l4.86,0.72l1.87,0.93l3.47,-1.11l3.64,2.11l2.52,0.95l-0.03,56.12l0.38,0.4l2.37,0.14l2.29,1.31l3.91,5.31l0.63,0.04l2.4,-2.69l2.1,-1.34l1.18,2.24l3.95,4.14l4.1,8.6l4.22,2.91l0.06,2.46l-1.03,1.56l-1.12,-1.31l-2.06,-1.31l-0.68,-3.73l-3.26,-3.82l-1.32,-4.34l-0.33,-0.28l-6.34,-0.42l-2.8,-1.31l-5.26,-5.09l-6.77,-2.72l-3.55,0.39l-4.79,-2.25l-3.33,-2.21l-2.78,1.09l-0.25,0.43l0.46,3.15l-3.97,1.29l-2.26,1.69l-2.25,0.84l-0.29,-2.33l1.07,-4.71l2.51,-1.5l0.15,-0.53l-0.69,-1.3l-0.62,-0.11l-3.19,2.88l-1.77,3.43l-3.56,3.49l-0.04,0.53l1.65,2.14l-2.16,3.15l-5.1,3.33l-0.76,2.13l-3.78,2.28l-0.91,2.19l-2.68,1.74l-1.82,-0.27l-6.95,4.17l-3.92,1.13l2.36,-1.94l2.5,-1.4l2.58,-2.35l3.26,-0.66l1.2,-1.79l3.42,-2.69l2.56,-2.83l0.42,-3.52l1.25,-2.78l-0.09,-0.45l-0.46,-0.07l-2.63,1.33l-0.6,-0.62l-0.6,0.03l-1.02,1.31l-1.33,-1.98l-0.71,0.08l-0.3,0.77l-0.56,-1.45l-0.62,-0.17l-2.39,1.85l-1.03,-0.0l-0.18,-2.46l0.44,-1.74l-1.7,-2.14l-0.41,-0.11l-3.01,0.89l-1.94,-2.17l-1.61,-1.16l-0.11,-2.96l-1.78,-2.05l0.88,-2.78l2.01,-2.96l0.87,-2.7l1.66,-0.33l1.59,0.82l0.5,-0.12l1.86,-2.47l1.93,0.32l1.91,-1.75l-0.34,-2.97l-1.22,-1.04l1.59,-1.93l-0.33,-0.65l-1.69,0.11l-2.66,1.27l-0.72,1.08l-1.92,-1.11l-3.43,0.63l-3.41,-1.3l-1.05,-2.33l-2.87,-3.16l3.14,-2.29l5.47,-2.98l1.51,0.0l-0.29,2.67l0.42,0.44l5.29,-0.24l0.34,-0.59l-2.03,-3.88l-3.12,-2.51l-1.79,-3.25l-2.4,-2.83l-3.25,-2.04l1.19,-3.05l4.45,-0.33l3.16,-3.2l0.69,-3.62l2.43,-3.32l2.42,-0.86l4.6,-3.26l2.51,0.36l3.66,-3.91l3.4,1.47ZM37.56,239.39l-2.21,1.54l-0.94,-0.87l-0.32,-1.79l3.24,-2.14l1.37,0.26l0.77,1.05l-1.9,1.94ZM31.06,363.53l0.98,0.48l0.75,0.91l-1.77,1.1l-0.44,-1.57l0.48,-0.92ZM29.32,361.52l0.19,0.06l0.11,0.07l-0.18,0.04l-0.12,-0.16ZM25.2,359.55l0.2,0.24l-0.14,-0.02l-0.05,-0.23ZM5.91,226.07l-1.09,0.55l-2.4,-1.69l1.72,-0.6l1.6,0.37l0.17,1.37Z" data-code="US" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M286.86,504.69l-0.94,1.64l-2.58,1.54l-1.67,-0.55l-1.42,0.28l-2.4,-1.28l-1.51,0.09l-1.28,-1.4l0.16,-1.65l0.56,-0.83l-0.02,-2.91l1.22,-5.04l1.18,-0.23l2.36,2.12l1.08,0.03l4.36,3.37l1.24,1.73l-0.98,1.58l0.62,1.52Z" data-code="UY" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M510.37,325.96l-0.89,0.55l1.84,-3.86l0.6,0.08l0.24,0.7l-1.15,0.96l-0.64,1.57Z" data-code="LB" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M689.54,378.29l-1.76,-0.75l-0.5,0.15l-0.94,1.48l-1.33,-0.65l0.62,-0.99l0.11,-2.2l-2.04,-2.45l-0.25,-2.69l-1.9,-2.14l-2.15,-0.31l-0.79,0.93l-1.12,0.06l-1.06,-0.4l-2.05,1.22l-0.04,-1.63l0.61,-2.74l-0.36,-0.49l-1.35,-0.1l-0.11,-1.26l-0.97,-0.9l0.33,-0.61l1.63,-1.34l0.39,0.36l1.33,0.07l0.42,-0.45l-0.34,-2.75l0.7,-0.21l1.28,1.86l1.11,2.41l0.36,0.23l2.82,0.02l0.72,1.72l-1.4,0.67l-0.72,0.95l0.13,0.59l2.91,1.54l3.61,5.34l1.88,1.81l0.57,1.65l-0.35,1.99Z" data-code="LA" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M724.01,356.0l-0.73,1.52l-0.9,-1.56l-0.26,-1.81l1.38,-2.53l1.73,-1.8l0.64,0.46l-1.86,5.73Z" data-code="TW" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M266.64,389.17l0.28,-1.17l1.13,-0.22l-0.06,1.21l-1.35,0.18Z" data-code="TT" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M513.19,301.28l3.65,1.31l3.06,-0.48l2.09,0.29l3.13,-1.74l2.44,-0.15l2.19,1.49l0.35,0.95l-0.23,1.5l0.24,0.43l2.34,1.31l-1.23,0.67l-0.2,0.43l0.75,3.55l-0.42,1.23l1.16,2.15l-0.57,0.25l-0.9,-0.73l-2.91,-0.41l-1.25,0.5l-4.23,0.45l-2.81,1.15l-1.9,0.01l-1.54,-0.57l-2.56,0.81l-0.66,-0.49l-0.64,0.29l-0.12,1.59l-0.89,0.9l-0.49,-0.75l0.8,-1.4l-0.41,-0.19l-1.43,0.25l-2.0,-0.69l-2.04,1.79l-3.49,0.32l-2.14,-1.66l-2.7,-0.1l-0.87,1.34l-1.36,0.29l-2.28,-1.56l-2.71,-0.02l-1.37,-2.89l-1.7,-1.68l1.09,-2.23l-0.08,-0.46l-1.31,-1.28l2.41,-2.71l3.68,-0.13l0.36,-0.25l0.94,-2.24l4.48,0.41l3.23,-2.2l2.8,-0.91l3.98,-0.07l4.28,2.31ZM488.78,302.77l-1.7,1.44l-0.51,-0.99l1.37,-2.91l-0.78,-0.93l1.78,-0.74l1.78,0.37l0.45,1.31l1.81,0.89l-0.14,0.26l-2.76,0.17l-1.31,1.13Z" data-code="TR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M624.16,398.87l-1.82,0.48l-0.99,-1.67l-0.42,-3.47l0.95,-3.45l1.21,0.98l2.26,4.21l-0.34,2.34l-0.85,0.58Z" data-code="LK" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M489.13,238.44l0.98,0.86l0.21,2.15l0.72,2.39l-3.68,2.17l-2.21,-1.98l-1.3,-0.34l-0.27,-0.73l-0.45,-0.25l-2.41,0.44l-4.15,-0.29l-2.48,1.13l0.07,-2.68l1.15,-2.72l1.91,-1.29l2.14,3.3l2.01,-0.09l0.38,-0.35l0.45,-3.34l1.74,-0.68l3.03,2.19l2.16,0.1Z" data-code="LV" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M486.92,246.68l0.19,1.58l-2.02,1.5l-0.54,2.27l-2.48,1.47l-2.05,-0.02l-0.5,-1.08l-1.3,-0.59l-0.07,-2.33l-1.21,-0.74l-2.38,-0.69l-0.45,-3.18l2.51,-1.21l4.09,0.28l2.23,-0.39l0.52,0.88l1.23,0.27l2.22,1.99Z" data-code="LT" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M436.07,271.5l-0.48,-0.1l0.29,-1.66l0.29,0.51l-0.1,1.25Z" data-code="LU" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M399.36,395.85l0.18,1.54l-0.49,1.0l0.08,0.47l2.47,1.8l-0.33,2.81l-2.65,-1.13l-5.78,-4.62l0.58,-1.32l2.1,-2.34l0.86,-0.22l0.77,1.14l-0.14,0.86l0.59,0.87l1.0,0.14l0.76,-0.99Z" data-code="LR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M491.05,494.85l-0.48,0.15l-1.5,-1.78l1.12,-1.53l2.18,-1.51l1.52,1.34l-0.99,1.94l-1.23,0.4l-0.62,0.98Z" data-code="LS" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M670.27,385.68l-1.41,3.9l0.15,2.01l0.38,0.36l1.38,0.07l0.9,2.05l0.55,2.34l1.4,1.45l1.61,0.38l0.96,0.97l-0.5,0.64l-1.1,0.2l-0.34,-1.18l-2.04,-1.1l-0.63,0.23l-0.63,-0.62l-0.48,-1.3l-2.55,-2.64l-0.73,0.41l0.95,-3.91l2.16,-4.25ZM670.67,384.59l-0.92,-2.2l-0.26,-2.64l-2.14,-3.1l0.72,-0.5l0.89,-2.62l-2.62,-3.66l-0.99,-1.9l0.88,-0.52l1.05,-2.63l1.74,-0.19l2.59,-1.63l0.76,0.58l0.13,1.42l0.37,0.36l1.23,0.09l-0.52,2.34l0.05,2.46l0.6,0.33l2.43,-1.45l0.77,0.4l1.47,-0.08l0.71,-0.89l1.48,0.14l1.71,1.92l0.25,2.69l1.92,2.15l-0.1,1.92l-0.61,0.87l-2.22,-0.33l-3.5,0.65l-1.6,2.14l0.36,2.6l-1.51,-0.79l-1.85,-0.01l0.28,-1.54l-0.4,-0.47l-2.21,0.02l-0.4,0.37l-0.19,2.77l-0.34,0.94Z" data-code="TH" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M596.66,558.28l-3.18,0.21l-0.05,-1.59l0.4,-1.7l1.28,0.9l2.08,0.42l-0.53,1.76Z" data-code="TF" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M422.7,387.47l-0.1,1.24l1.53,1.53l0.08,1.1l0.5,0.65l-0.11,5.64l0.49,1.47l-1.31,0.35l-1.02,-2.13l-0.18,-1.13l0.53,-2.2l-0.63,-1.16l-0.22,-3.7l-1.01,-1.41l0.07,-0.29l1.37,0.03Z" data-code="TG" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M480.25,365.02l0.12,9.75l-2.1,0.05l-1.14,1.91l-0.69,1.65l0.34,0.73l-0.66,0.92l0.24,0.9l-0.86,1.97l0.45,0.5l0.59,-0.1l0.34,0.65l0.03,1.39l0.9,1.06l-1.45,0.43l-1.27,1.03l-1.83,2.78l-2.16,1.08l-2.31,-0.15l-0.86,0.25l-0.26,0.49l0.17,0.62l-2.11,1.69l-2.85,0.87l-1.09,-0.57l-0.73,0.67l-1.12,0.1l-1.1,-3.13l-1.25,-0.64l-1.22,-1.23l0.3,-0.65l3.01,0.04l0.35,-0.6l-1.3,-2.21l-0.08,-3.33l-0.97,-1.68l0.22,-1.06l-0.38,-0.48l-1.22,-0.04l0.0,-1.27l-0.98,-1.08l0.97,-3.05l3.25,-2.68l0.13,-3.38l0.95,-5.29l0.52,-1.1l-0.1,-0.47l-0.91,-0.8l-0.19,-0.98l-0.8,-0.6l-0.55,-3.77l2.11,-1.24l19.56,10.1Z" data-code="TD" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M483.49,331.4l-0.77,1.19l0.3,1.46l-0.6,1.92l0.73,2.26l0.0,25.02l-2.48,0.01l-0.41,0.87l-19.41,-10.02l-4.41,2.35l-1.37,-1.37l-3.82,-1.13l-1.14,-1.71l-1.98,-1.28l-1.22,0.33l-0.67,-1.15l-0.16,-1.3l-1.29,-1.77l0.88,-1.24l-0.07,-4.54l0.43,-2.38l-0.86,-3.65l1.13,-0.8l0.22,-1.23l-0.21,-1.1l3.49,-2.78l0.28,-2.06l2.44,0.85l1.18,-0.22l1.97,0.47l3.14,1.26l1.37,2.7l5.71,1.77l2.64,1.43l1.62,-0.76l1.29,-1.41l-0.45,-2.46l0.67,-1.22l1.67,-1.29l1.56,-0.37l3.13,0.56l1.09,1.36l3.98,0.83l0.38,0.6Z" data-code="LY" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M550.76,353.19l1.89,-0.42l3.84,0.02l4.77,-4.92l0.19,0.38l0.26,1.67l-0.82,0.01l-0.39,0.35l-0.08,2.12l-0.82,0.64l-0.01,1.0l-0.67,1.03l-0.39,1.45l-7.07,-1.29l-0.71,-2.04Z" data-code="AE" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M240.68,386.52l0.53,0.75l-0.02,1.07l-1.07,1.78l0.95,2.01l0.42,0.23l1.4,-0.44l0.56,-1.84l-0.77,-1.17l-0.1,-1.49l2.83,-0.94l0.26,-0.49l-0.28,-0.97l0.3,-0.28l0.66,1.32l1.96,0.26l1.4,1.23l0.08,0.69l0.39,0.35l4.81,-0.23l1.49,1.12l1.92,0.31l1.67,-0.84l0.22,-0.61l3.44,-0.14l-0.18,0.56l0.86,1.2l2.19,0.35l1.68,1.1l0.37,1.87l0.41,0.32l1.56,0.17l-1.66,1.36l-0.22,0.92l0.66,0.98l-1.67,0.54l-0.3,0.4l0.04,0.99l-0.56,0.57l-0.01,0.55l1.85,2.27l-0.66,0.69l-4.47,1.29l-0.72,0.54l-3.69,-0.9l-0.71,0.27l-0.02,0.7l0.91,0.53l-0.08,1.55l0.35,1.58l0.35,0.31l1.66,0.17l-1.3,0.52l-0.48,1.13l-2.68,0.91l-0.6,0.77l-1.57,0.13l-1.17,-1.13l-0.8,-2.52l-1.25,-1.26l1.02,-1.23l-1.29,-2.95l0.18,-1.62l1.0,-2.21l-0.2,-0.49l-1.14,-0.47l-4.02,0.36l-1.82,-2.11l-1.57,-0.33l-2.99,0.23l-1.06,-0.98l0.25,-1.24l-0.2,-1.02l-0.59,-0.69l-0.29,-1.06l-1.08,-0.39l0.78,-2.81l1.9,-2.12Z" data-code="VE" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M600.86,316.06l-1.73,1.47l0.72,3.0l-1.1,1.13l-0.02,1.35l-0.49,0.78l-2.15,-0.09l-0.37,0.58l0.8,1.63l-1.4,0.74l-1.06,1.8l0.07,1.81l-0.66,0.56l-0.91,-0.22l-1.91,0.38l-0.48,0.81l-1.88,0.14l-1.49,1.9l-0.08,2.2l-2.91,1.07l-1.64,-0.24l-0.72,0.58l-1.41,-0.31l-2.4,0.41l-3.54,-1.24l1.98,-2.49l-0.21,-1.88l-0.3,-0.34l-1.63,-0.42l-0.19,-1.69l-0.76,-2.19l0.96,-1.48l-0.18,-0.59l-0.75,-0.31l1.48,-5.22l2.12,0.97l2.14,-0.38l0.74,-1.45l1.77,-0.42l1.54,-1.0l0.62,-2.51l1.88,-0.54l0.48,-0.87l0.93,0.61l2.13,0.12l2.55,1.01l1.96,-0.89l0.64,0.46l0.58,-0.13l0.69,-1.23l1.58,-0.09l0.47,-0.64l0.24,-1.17l0.79,-0.81l0.81,0.43l-0.19,0.66l0.71,0.58l-0.09,2.61l1.28,1.05ZM601.25,315.96l1.86,-0.88l1.42,-1.28l3.93,0.22l0.11,0.23l-2.26,0.81l-5.06,0.9Z" data-code="AF" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M530.81,314.51l0.79,0.72l1.26,-0.3l1.46,3.35l1.63,1.01l0.15,1.38l-1.23,1.13l-0.53,2.67l1.73,2.85l3.12,1.72l1.16,2.02l-0.38,1.98l0.39,0.48l0.41,-0.0l0.02,1.16l0.79,1.02l-2.51,-0.11l-1.71,2.58l-4.3,-0.21l-7.02,-5.78l-3.73,-2.06l-2.89,-0.78l-0.86,-3.1l5.46,-3.23l0.95,-3.7l-0.2,-2.14l1.28,-0.77l1.22,-1.86l0.86,-0.39l2.67,0.37Z" data-code="IQ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M384.17,190.14l-0.45,3.88l2.67,3.88l-3.04,4.17l-9.15,4.83l-9.47,-2.42l1.99,-2.05l-0.1,-0.63l-4.53,-2.38l3.43,-0.89l0.3,-0.41l-0.11,-1.75l-0.3,-0.36l-4.81,-1.29l1.43,-3.39l3.37,-0.82l3.74,4.02l0.56,0.03l3.59,-3.17l2.9,1.61l0.45,-0.04l3.95,-3.21l3.58,0.38Z" data-code="IS" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M533.43,314.24l-1.29,-2.38l0.43,-1.06l-0.72,-3.4l1.03,-0.56l0.32,0.9l1.26,1.49l2.06,0.57l1.12,-0.18l2.89,-2.33l0.6,-0.15l0.42,0.54l-0.74,1.37l0.06,0.46l1.56,1.68l0.66,0.05l0.67,1.99l2.55,0.89l1.88,1.61l3.7,0.53l3.91,-0.83l0.47,-0.8l2.17,-0.66l1.65,-1.68l1.49,0.08l1.19,-0.57l1.57,0.26l2.84,1.62l1.88,0.32l2.77,2.69l1.78,0.2l0.18,2.19l-1.69,5.93l0.23,0.49l0.64,0.26l-0.85,1.58l0.81,2.33l0.19,1.83l0.3,0.35l1.63,0.43l0.16,1.43l-2.16,2.5l-0.01,0.51l2.21,3.19l2.35,1.3l0.06,2.26l1.24,0.74l0.12,0.75l-3.31,1.33l-1.08,3.14l-9.68,-1.74l-0.99,-3.18l-1.43,-0.75l-2.18,0.48l-2.47,1.31l-2.82,-0.86l-2.46,-2.11l-2.41,-0.84l-3.42,-6.37l-0.49,-0.2l-1.17,0.41l-1.43,-0.86l-0.51,0.09l-0.64,0.77l-0.97,-1.07l-0.02,-1.4l-0.71,-0.39l0.27,-1.92l-1.29,-2.25l-3.13,-1.73l-1.59,-2.62l0.51,-2.08l1.3,-1.32l-0.19,-1.79l-1.73,-1.17l-1.57,-3.6Z" data-code="IR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M537.0,308.96l-0.27,0.03l-1.24,-2.34l-0.92,0.01l-0.62,-0.73l-0.69,-0.08l-0.96,-0.89l-1.58,-0.69l0.2,-1.3l-0.28,-0.9l2.73,-0.41l1.13,1.15l-0.21,1.0l1.06,0.9l-0.5,0.74l0.08,0.53l2.05,1.37l0.04,1.62Z" data-code="AM" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M470.32,297.19l0.73,0.03l0.93,0.99l0.13,0.95l-0.3,1.27l0.36,1.43l1.02,0.9l-1.82,3.2l-0.18,-0.65l-1.26,-1.0l-0.19,-1.36l0.53,-3.17l-0.55,-1.64l0.61,-0.94Z" data-code="AL" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M461.55,429.93l1.26,3.16l1.94,2.36l2.47,-0.54l1.25,0.32l0.44,-0.18l0.93,-1.92l1.31,-0.08l0.41,-0.44l0.47,-0.0l-0.1,0.41l0.39,0.49l2.65,-0.02l0.03,1.2l0.48,1.02l-0.34,1.52l0.18,1.56l0.83,1.04l-0.13,2.87l0.54,0.39l3.96,-0.41l-0.1,1.81l0.39,1.06l-0.24,1.45l-4.7,-0.03l-0.4,0.39l-0.12,8.23l2.93,3.55l-3.84,0.9l-5.89,-0.36l-1.88,-1.27l-10.47,0.23l-1.3,-1.03l-1.85,-0.16l-2.4,0.78l-0.15,-1.08l0.33,-2.2l1.0,-3.5l1.35,-3.24l2.24,-2.82l0.33,-2.07l-0.13,-1.54l-0.8,-1.08l-1.21,-2.88l0.87,-1.62l-1.27,-4.13l-1.17,-1.53l2.47,-0.63l7.03,0.03ZM451.71,428.77l-0.47,-1.26l1.25,-1.11l0.32,0.3l-0.99,1.03l-0.12,1.04Z" data-code="AO" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M258.05,471.85l1.38,1.83l0.68,-0.08l0.87,-1.93l2.39,0.09l4.94,4.92l2.17,0.51l2.99,1.99l2.47,1.04l0.26,0.88l-2.38,4.1l0.23,0.58l5.39,1.21l2.13,-0.46l2.46,-2.25l0.49,-2.47l0.76,-0.32l0.98,1.25l-0.04,1.9l-3.67,2.62l-2.85,2.79l-3.42,4.08l-1.3,5.37l0.01,2.9l-0.54,0.77l-0.36,3.52l3.15,2.82l-0.31,1.9l1.54,1.59l-0.1,1.23l-2.3,3.86l-3.55,1.64l-4.91,0.65l-2.7,-0.32l-0.43,0.5l0.5,1.83l-0.49,2.34l0.4,1.59l-1.21,0.94l-2.34,0.42l-2.29,-1.15l-1.41,0.93l0.41,3.97l1.69,1.02l1.41,-0.77l0.39,0.92l-2.08,0.99l-2.01,2.14l-0.47,3.69l-0.49,1.57l-2.34,0.12l-2.08,2.01l-0.63,3.07l2.46,2.67l2.21,0.74l-0.73,2.83l-2.84,2.04l-1.73,4.57l-2.18,1.47l-1.15,1.98l0.77,4.43l1.16,1.7l-2.44,-0.66l-5.82,-0.52l-0.91,-2.06l0.05,-2.9l-0.46,-0.4l-1.41,0.21l-0.69,-1.12l-0.2,-3.82l1.89,-1.73l0.79,-2.4l-0.26,-1.97l1.31,-3.13l0.91,-4.79l-0.23,-1.96l1.06,-0.95l-0.27,-1.32l-1.01,-0.76l0.63,-1.12l-0.05,-0.46l-1.05,-1.22l-0.53,-3.58l0.97,-0.92l-0.42,-4.02l1.21,-6.04l1.53,-1.49l-0.75,-3.06l-0.01,-2.68l1.79,-1.91l0.05,-2.76l1.43,-3.06l0.01,-2.77l-0.69,-0.77l-1.09,-4.84l1.48,-2.87l-0.19,-2.93l0.85,-2.48l1.59,-2.58l1.73,-1.72l0.05,-0.51l-0.61,-0.89l0.45,-0.89l-0.07,-4.37l2.71,-1.48l0.86,-2.84l-0.22,-0.73l1.77,-2.07l2.9,0.58ZM256.68,580.89l-1.95,0.18l-1.42,-1.53l-3.82,-0.12l-0.0,-7.37l1.57,3.7l3.26,2.57l3.18,1.01l-0.81,1.56Z" data-code="AR" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M705.79,484.09l0.27,0.04l0.18,-0.47l-0.49,-1.51l0.92,1.16l0.45,0.15l0.28,-0.39l-0.09,-1.61l-1.99,-3.77l1.09,-3.43l-0.24,-1.62l0.34,-0.64l0.38,1.08l0.43,-0.19l0.99,-1.75l1.91,-0.85l1.29,-1.18l1.81,-0.93l0.95,-0.17l0.93,0.27l1.92,-0.97l1.46,-0.29l1.03,-0.82l1.44,0.04l2.78,-0.86l1.36,-1.18l0.71,-1.48l1.41,-1.28l0.3,-2.63l1.27,-1.61l0.78,1.67l0.54,0.19l1.07,-0.52l0.15,-0.59l-0.73,-1.02l0.45,-0.73l0.78,0.4l0.58,-0.3l0.28,-1.84l1.87,-2.17l1.12,-0.39l0.28,-0.58l0.62,0.17l0.5,-0.36l0.03,-0.38l1.87,-0.58l1.65,1.06l1.35,1.49l3.4,0.39l0.44,-0.54l-0.46,-1.24l1.05,-1.82l1.04,-0.62l0.14,-0.55l-0.25,-0.41l0.88,-1.19l1.31,-0.78l1.31,0.27l2.1,-0.48l0.31,-0.4l-0.05,-1.31l-0.92,-0.78l1.48,0.56l1.41,1.08l2.11,0.65l0.81,-0.21l1.4,0.71l1.69,-0.67l0.8,0.19l0.64,-0.33l0.71,0.78l-1.33,1.96l-0.71,0.07l-0.35,0.51l0.24,0.87l-1.52,2.38l0.12,1.06l2.15,1.66l1.97,0.86l3.04,2.4l1.97,0.66l0.54,0.89l2.72,0.87l1.84,-1.12l2.07,-6.05l-0.43,-3.63l0.3,-1.75l0.47,-0.87l-0.32,-0.69l1.09,-3.31l0.46,-0.47l0.4,0.71l0.17,1.52l0.65,0.53l0.15,1.04l0.85,1.22l0.12,2.41l0.9,2.03l0.57,0.18l1.3,-0.79l1.69,1.73l-0.2,1.09l0.53,2.23l0.39,1.32l0.68,0.49l0.6,1.99l-0.2,1.51l0.81,1.79l2.87,1.56l3.14,2.21l-0.12,0.78l1.38,1.62l0.95,2.84l0.58,0.22l0.71,-0.42l0.8,0.92l0.61,0.01l0.46,2.48l4.82,4.87l0.66,2.1l-0.07,3.44l1.15,2.31l-0.13,2.37l-1.1,3.88l0.04,1.73l-0.48,2.02l-1.05,2.56l-1.9,1.57l-1.73,3.77l-2.38,6.57l-0.24,3.08l-1.15,0.88l-2.86,0.16l-2.31,1.3l-2.5,2.46l-1.81,-1.24l-1.29,-0.49l0.31,-1.32l-0.55,-0.46l-1.5,0.69l-2.01,2.12l-7.1,-2.39l-1.49,-1.79l-1.13,-4.06l-1.45,-1.37l-1.84,-0.28l0.58,-1.28l-0.61,-2.26l-0.73,-0.1l-1.14,1.96l-0.94,0.24l0.6,-0.77l0.44,-1.84l0.99,-1.67l-0.2,-2.22l-0.28,-0.35l-0.43,0.13l-2.0,2.51l-1.51,1.0l-0.93,2.15l-1.35,-0.87l-0.01,-1.63l-1.57,-2.18l-1.11,-0.96l0.27,-0.39l-0.13,-0.58l-3.21,-1.8l-1.84,-0.13l-2.55,-1.44l-4.58,0.3l-6.02,2.02l-2.54,-0.14l-2.62,1.5l-2.13,0.67l-1.49,2.78l-3.48,0.33l-2.3,-0.54l-3.48,0.46l-1.6,1.58l-0.81,-0.03l-2.36,1.75l-3.24,-0.11l-3.72,-2.38l0.04,-1.18l1.19,-0.49l0.48,-0.93l0.21,-3.17l-0.28,-1.75l-1.34,-3.02l-0.39,-1.56l0.06,-1.8l-0.96,-1.79l-0.17,-1.0l-1.02,-1.04l-0.29,-2.09l-1.15,-1.85ZM784.91,527.24l2.67,1.14l3.23,-1.06l1.08,0.16l0.16,3.5l-0.85,1.25l-0.18,1.86l-0.27,-0.29l-0.62,0.04l-1.56,2.15l-1.66,-0.2l-1.41,-2.68l-0.37,-2.29l-1.4,-2.82l0.04,-0.96l1.14,0.2Z" data-code="AU" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M462.92,275.34l0.01,2.75l-1.06,0.01l-0.34,0.61l0.39,0.64l-1.07,2.55l-2.0,0.08l-1.34,0.81l-5.27,-1.14l-0.48,-1.1l-0.47,-0.23l-2.47,0.64l-0.42,0.58l-2.45,-0.51l-0.75,-0.44l0.44,-1.16l1.11,0.9l0.63,-0.17l0.25,-0.69l1.91,0.14l1.87,-0.66l0.97,0.09l0.68,0.66l0.65,-0.15l0.25,-0.83l-0.31,-2.16l0.82,-0.52l0.68,-1.35l1.49,0.98l0.52,-0.07l1.34,-1.47l0.61,-0.2l1.79,1.07l1.3,-0.12l0.74,0.46Z" data-code="AT" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M623.36,335.51l-1.27,1.12l-0.97,2.68l0.21,0.5l8.04,4.05l3.43,0.39l1.57,1.44l4.92,0.91l2.18,-0.04l0.38,-0.3l0.29,-1.28l-0.32,-1.72l0.15,-0.92l0.82,-0.32l0.44,2.59l2.28,1.07l1.78,-0.4l4.14,0.1l0.38,-0.36l0.18,-1.73l-0.53,-0.69l1.4,-0.31l2.25,-2.09l2.69,-1.7l1.92,0.64l1.8,-1.03l0.8,1.22l-0.69,0.98l0.26,0.63l2.42,0.38l0.09,0.52l-0.83,0.77l0.13,1.14l-1.53,-0.3l-3.24,1.94l-0.12,1.84l-1.32,2.23l-0.17,1.44l-0.93,1.89l-1.63,-0.52l-0.52,0.37l-0.09,2.72l-0.56,1.13l0.2,0.85l-0.53,0.28l-1.18,-3.85l-1.08,-0.27l-0.38,0.31l-0.24,1.03l-0.66,-0.68l0.55,-1.12l1.21,-0.35l1.15,-2.33l-0.23,-0.56l-1.58,-0.49l-4.33,-0.29l-0.19,-1.63l-0.35,-0.35l-1.11,-0.13l-1.91,-1.16l-0.57,0.17l-0.88,1.89l0.11,0.48l1.38,1.12l-1.11,0.73l-0.69,1.14l0.18,0.55l1.24,0.59l-0.32,1.59l0.85,2.01l0.36,2.08l-0.22,0.62l-4.58,0.54l-0.33,0.42l0.13,1.86l-1.18,1.39l-3.65,1.85l-2.79,3.1l-4.32,3.33l-0.18,1.29l-4.65,1.82l-0.77,2.19l0.64,5.37l-1.06,2.51l-0.01,3.97l-1.24,0.28l-1.14,1.94l0.39,0.85l-1.69,0.53l-1.04,1.84l-0.65,0.47l-2.06,-2.06l-2.1,-6.05l-2.2,-3.67l-1.05,-4.8l-2.29,-3.61l-1.76,-8.34l0.01,-3.18l-0.49,-2.59l-0.55,-0.29l-3.53,1.56l-1.52,-0.28l-2.87,-2.86l0.86,-0.7l0.08,-0.54l-0.74,-1.06l-2.68,-2.13l1.26,-1.38l5.33,0.01l0.39,-0.48l-0.5,-2.37l-1.42,-1.51l-0.27,-2.01l-1.44,-1.26l2.33,-2.5l3.05,0.07l2.62,-2.99l1.6,-2.96l2.4,-2.88l0.06,-2.16l1.98,-1.58l-0.01,-0.64l-1.93,-1.4l-0.82,-1.91l-0.81,-2.4l0.91,-0.97l3.58,0.7l2.93,-0.45l2.32,-2.35l2.31,3.07l-0.24,2.31l0.99,1.68l-0.05,0.92l-1.34,-0.3l-0.48,0.47l0.7,3.26l2.61,2.09l3.02,1.77Z" data-code="IN" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M495.56,426.32l2.8,-3.13l-0.02,-0.82l-0.64,-1.3l0.68,-0.52l0.14,-1.47l-0.76,-1.25l0.31,-0.11l2.26,0.03l-0.51,2.76l0.76,1.3l0.5,0.12l1.05,-0.53l1.19,-0.12l0.61,0.24l1.43,-0.62l0.1,-0.67l-0.71,-0.62l1.57,-1.7l8.65,4.86l0.32,1.53l3.34,2.33l-1.05,2.81l0.13,1.61l1.63,1.12l-0.6,1.77l-0.01,2.33l1.89,4.05l0.57,0.44l-1.47,1.09l-2.61,0.95l-1.43,-0.04l-1.06,0.77l-2.29,0.36l-2.87,-0.69l-0.83,0.07l-0.64,-0.75l-0.31,-2.8l-1.32,-1.36l-3.25,-0.77l-3.96,-1.59l-1.18,-2.42l-0.32,-1.75l-1.76,-1.49l0.42,-1.05l-0.44,-0.89l0.08,-0.96l-0.46,-0.58l0.06,-0.56Z" data-code="TZ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M539.27,301.57l1.33,0.36l0.44,-0.21l0.4,-0.78l1.11,-1.01l2.3,3.71l1.5,0.55l-1.32,0.17l-0.34,0.33l-0.81,3.49l-0.98,1.01l0.05,1.26l-1.28,-1.27l0.73,-1.34l-0.78,-1.39l-1.51,0.17l-2.32,1.87l-0.04,-1.43l-2.05,-1.48l0.5,-0.74l-0.07,-0.53l-1.07,-0.91l0.33,-0.54l-0.14,-0.55l-1.17,-1.02l1.91,0.73l1.71,0.07l0.37,-0.88l-1.01,-1.48l0.2,-0.14l0.4,0.06l1.63,1.92ZM533.76,306.94l0.63,0.52l0.69,-0.0l0.63,1.35l-0.71,-0.18l-1.25,-1.69Z" data-code="AZ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M405.07,254.34l0.37,2.67l-1.78,3.47l-4.21,2.28l-2.89,-0.5l1.83,-4.09l-1.24,-4.04l4.62,-4.68l0.33,1.5l-0.5,2.21l0.41,0.49l1.45,-0.06l1.61,0.75Z" data-code="IE" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M756.47,417.79l0.69,4.01l2.79,1.78l0.51,-0.1l2.04,-2.59l2.71,-1.43l2.05,-0.0l3.9,1.73l2.46,0.45l0.08,15.16l-1.75,-1.55l-2.54,-0.51l-0.88,0.72l-2.32,0.06l0.69,-1.33l1.45,-0.64l0.23,-0.46l-0.65,-2.74l-1.24,-2.22l-5.04,-2.3l-2.09,-0.23l-3.68,-2.27l-0.55,0.13l-0.65,1.07l-0.52,0.12l-0.55,-1.89l-1.21,-0.78l1.84,-0.62l1.72,0.05l0.39,-0.52l-0.21,-0.66l-0.38,-0.28l-3.45,-0.0l-1.13,-1.48l-2.1,-0.43l-0.52,-0.61l2.69,-0.48l1.28,-0.78l3.66,0.94l0.3,0.71ZM757.91,430.25l-0.62,0.82l-0.1,-0.8l0.59,-1.12l0.13,1.1ZM747.38,422.88l0.34,0.72l-1.22,-0.57l-4.68,-0.1l0.27,-0.62l2.78,-0.09l2.52,0.67ZM741.05,415.14l-0.67,-2.88l0.64,-2.01l0.41,0.86l1.21,0.18l0.16,0.7l-0.1,1.68l-0.84,-0.16l-0.46,0.3l-0.34,1.34ZM739.05,423.4l-0.5,0.45l-1.34,-0.36l-0.17,-0.37l1.73,-0.08l0.27,0.36ZM721.45,414.41l-0.19,1.97l2.24,2.23l0.54,0.02l1.27,-1.07l2.75,-0.5l-0.9,1.21l-2.11,0.93l-0.16,0.6l2.22,3.01l-0.3,1.07l1.36,1.75l-2.26,0.85l-0.28,-0.31l0.12,-1.19l-1.64,-1.34l0.17,-2.24l-0.56,-0.39l-1.67,0.76l-0.23,0.39l0.3,6.18l-1.1,0.25l-0.69,-0.47l0.64,-2.21l-0.39,-2.42l-0.39,-0.34l-0.8,-0.01l-0.58,-1.29l0.98,-1.6l0.35,-1.96l1.32,-3.87ZM728.59,426.17l0.38,0.5l-0.02,1.28l-0.88,0.49l-0.53,-0.48l1.04,-1.79ZM729.04,416.88l0.27,-0.05l-0.02,0.13l-0.24,-0.08ZM721.68,413.95l0.16,-0.32l1.89,-1.65l1.83,0.68l3.16,0.35l2.94,-0.1l2.39,-1.66l-1.73,2.13l-1.66,0.43l-2.41,-0.48l-4.17,0.13l-2.39,0.51ZM730.55,440.42l1.11,-1.94l2.02,-0.82l0.08,0.62l-1.45,1.68l-1.77,0.46ZM728.12,435.8l-0.1,0.38l-3.46,0.66l-2.91,-0.27l-0.0,-0.25l1.54,-0.41l1.66,0.73l1.67,-0.19l1.61,-0.65ZM722.9,440.18l-0.64,0.03l-2.26,-1.21l1.12,-0.24l1.78,1.42ZM716.26,435.69l0.88,0.51l1.28,-0.17l0.2,0.35l-4.65,0.73l0.4,-0.67l1.15,-0.02l0.75,-0.74ZM711.66,423.74l-0.38,-0.16l-2.54,1.01l-1.12,-1.44l-1.69,-0.13l-1.16,-0.75l-3.04,0.77l-1.1,-1.15l-3.31,-0.11l-0.35,-3.05l-1.35,-0.95l-1.11,-1.98l-0.33,-2.06l0.27,-2.14l0.9,-1.01l0.37,1.15l2.09,1.49l1.53,-0.48l1.82,0.08l1.38,-1.19l1.0,-0.18l2.28,0.67l2.26,-0.53l1.52,-3.64l1.01,-0.99l0.78,-2.57l4.1,0.31l-1.11,1.77l0.02,0.46l1.7,2.2l-0.23,1.39l2.07,1.71l-2.33,0.42l-0.88,1.9l0.1,2.05l-2.4,1.9l-0.06,2.45l-0.7,2.79ZM692.58,431.94l0.35,0.26l4.8,0.25l0.78,-0.97l4.17,1.09l1.13,1.69l3.69,0.45l2.14,1.05l-1.8,0.61l-2.77,-1.0l-4.8,-0.12l-5.24,-1.42l-1.84,-0.25l-1.11,0.3l-4.26,-0.97l-0.7,-1.14l-1.59,-0.13l1.18,-1.66l2.74,0.13l2.87,1.13l0.26,0.69ZM685.53,429.08l-2.22,0.04l-2.06,-2.04l-3.15,-2.01l-2.93,-3.52l-3.11,-5.33l-2.2,-2.12l-1.64,-4.06l-2.32,-1.69l-1.27,-2.07l-1.96,-1.5l-2.51,-2.65l-0.11,-0.66l4.81,0.53l2.15,2.38l3.31,2.74l2.35,2.66l2.7,0.17l1.95,1.59l1.54,2.17l1.59,0.95l-0.84,1.71l0.15,0.52l1.44,0.87l0.79,0.1l0.4,1.58l0.87,1.4l1.96,0.39l1.0,1.31l-0.6,3.01l-0.09,3.51Z" data-code="ID" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M493.77,283.66l1.85,0.21l0.66,-0.27l0.1,-0.68l-0.25,-0.87l-0.8,-0.85l-0.34,-1.43l-0.87,-0.71l0.01,-1.37l-1.13,-1.01l-1.16,-0.23l-2.07,-1.18l-1.66,0.37l-0.67,0.55l-0.9,-0.0l-0.86,0.91l-1.69,0.33l-0.76,0.47l-1.18,-0.82l-3.05,-0.42l-0.9,0.48l-0.22,-0.62l-1.16,-0.85l0.86,-1.88l0.25,0.1l0.53,-0.51l-0.57,-1.53l2.08,-2.96l1.38,-0.69l0.26,-1.34l-1.09,-3.02l0.9,-0.18l1.27,-1.02l1.78,-0.08l2.45,0.31l2.87,0.98l1.87,0.08l0.85,0.53l1.06,-0.47l0.78,0.77l2.17,-0.18l0.91,0.35l0.54,-0.34l0.15,-1.9l0.58,-0.67l2.82,-0.06l0.87,-0.86l3.0,-0.22l1.29,1.86l-0.53,0.89l0.21,1.25l0.36,0.33l1.78,0.17l0.93,2.49l3.18,1.38l1.95,-0.52l1.69,1.77l1.39,-0.04l3.36,1.15l0.02,0.75l-0.97,1.91l0.49,2.26l-0.28,0.89l-2.37,0.33l-1.29,1.04l-0.21,1.6l-1.85,0.32l-1.58,1.12l-2.41,0.24l-2.16,1.36l-0.19,0.36l0.32,2.54l1.49,0.93l1.92,-0.16l-0.18,0.47l-2.65,0.61l-3.21,1.92l-0.89,-0.46l0.44,-1.33l-0.24,-0.5l-2.27,-0.86l2.41,-1.32l0.12,-0.62l-0.93,-0.95l-3.62,-0.85l-0.14,-1.08l-0.47,-0.34l-2.32,0.45l-2.91,4.52l-1.19,-0.45l-0.98,0.48l-0.36,-0.21l1.35,-2.93Z" data-code="UA" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M549.32,350.8l-0.76,-0.24l-0.14,-1.72l0.84,-1.35l0.47,0.54l0.04,1.41l-0.45,1.36Z" data-code="QA" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path><path d="M508.58,448.77l-0.34,-2.6l0.51,-2.07l3.55,0.64l2.51,-0.38l1.02,-0.76l1.49,0.01l2.74,-0.99l1.66,-1.21l0.51,9.32l0.41,1.25l-0.68,1.69l-0.93,1.74l-1.5,1.52l-5.16,2.32l-2.78,2.78l-1.02,0.54l-1.71,1.84l-0.98,0.59l-0.35,2.45l1.16,1.99l0.49,2.24l0.43,0.31l-0.06,2.14l-0.39,1.21l0.5,0.73l-0.25,0.78l-0.92,0.86l-5.13,2.47l-1.22,1.39l0.21,1.17l0.59,0.4l-0.11,0.78l-1.22,-0.02l-0.73,-3.1l0.42,-3.19l-1.78,-5.56l2.49,-2.89l0.69,-1.93l0.44,-0.43l0.28,-1.57l-0.39,-0.94l0.59,-3.72l-0.01,-3.32l-1.48,-1.17l-1.2,-0.23l-1.74,-1.18l-1.92,0.0l-0.3,-2.12l7.06,-1.98l1.28,1.1l0.89,-0.1l0.67,0.45l0.1,0.75l-0.51,1.3l0.19,1.83l1.75,1.86l0.65,-0.13l0.71,-1.68l1.17,-0.86l-0.26,-3.51l-1.05,-1.87l-1.04,-0.95Z" data-code="MZ" fill="#daeaee" fill-opacity="1" stroke="#daeaee" stroke-width="0.25" fill-rule="evenodd" class="jvm-region jvm-element"></path></g><g id="jvm-regions-labels-group"></g><g id="jvm-lines-group"><line x1="57.22349334188702" y1="155.4790047303245" x2="184.29092005032567" y2="192.79296603467338" data-index="0" stroke="#808080" stroke-width="1" stroke-linecap="round" animation="true" stroke-dasharray="6 3 6" class="jvm-line"></line><line x1="253.0341465429099" y1="146.81160249037396" x2="184.29092005032567" y2="192.79296603467338" data-index="1" stroke="#808080" stroke-width="1" stroke-linecap="round" animation="true" stroke-dasharray="6 3 6" class="jvm-line"></line><line x1="116.84014682041415" y1="120.78320070089535" x2="184.29092005032567" y2="192.79296603467338" data-index="2" stroke="#808080" stroke-width="1" stroke-linecap="round" animation="true" stroke-dasharray="6 3 6" class="jvm-line"></line><line x1="107.64445766772239" y1="231.928993347997" x2="184.29092005032567" y2="192.79296603467338" data-index="3" stroke="#808080" stroke-width="1" stroke-linecap="round" animation="true" stroke-dasharray="6 3 6" class="jvm-line"></line><line x1="67.07569316262884" y1="181.55210108698543" x2="184.29092005032567" y2="192.79296603467338" data-index="4" stroke="#808080" stroke-width="1" stroke-linecap="round" animation="true" stroke-dasharray="6 3 6" class="jvm-line"></line><line x1="252.2886928546328" y1="182.96763298199443" x2="184.29092005032567" y2="192.79296603467338" data-index="5" stroke="#808080" stroke-width="1" stroke-linecap="round" animation="true" stroke-dasharray="6 3 6" class="jvm-line"></line><line x1="163.59911020489477" y1="147.81230394636265" x2="184.29092005032567" y2="192.79296603467338" data-index="6" stroke="#808080" stroke-width="1" stroke-linecap="round" animation="true" stroke-dasharray="6 3 6" class="jvm-line"></line><line x1="184.6273099647423" y1="167.24915605570988" x2="184.29092005032567" y2="192.79296603467338" data-index="7" stroke="#808080" stroke-width="1" stroke-linecap="round" animation="true" stroke-dasharray="6 3 6" class="jvm-line"></line></g><g id="jvm-markers-group"><circle data-index="0" cx="116.84014682041415" cy="120.78320070089535" r="7" fill="#0c768a" fill-opacity="1" stroke="#FFF" stroke-width="5" stroke-opacity="0.5" class="jvm-marker jvm-element"></circle><circle data-index="1" cx="57.22349334188702" cy="155.4790047303245" r="7" fill="#0c768a" fill-opacity="1" stroke="#FFF" stroke-width="5" stroke-opacity="0.5" class="jvm-marker jvm-element"></circle><circle data-index="2" cx="107.64445766772239" cy="231.928993347997" r="7" fill="#0c768a" fill-opacity="1" stroke="#FFF" stroke-width="5" stroke-opacity="0.5" class="jvm-marker jvm-element"></circle><circle data-index="3" cx="184.29092005032567" cy="192.79296603467338" r="7" fill="#0c768a" fill-opacity="1" stroke="#FFF" stroke-width="5" stroke-opacity="0.5" class="jvm-marker jvm-element"></circle><circle data-index="4" cx="253.0341465429099" cy="146.81160249037396" r="7" fill="#0c768a" fill-opacity="1" stroke="#FFF" stroke-width="5" stroke-opacity="0.5" class="jvm-marker jvm-element"></circle><circle data-index="5" cx="252.2886928546328" cy="182.96763298199443" r="7" fill="#0c768a" fill-opacity="1" stroke="#FFF" stroke-width="5" stroke-opacity="0.5" class="jvm-marker jvm-element"></circle><circle data-index="6" cx="67.07569316262884" cy="181.55210108698543" r="7" fill="#0c768a" fill-opacity="1" stroke="#FFF" stroke-width="5" stroke-opacity="0.5" class="jvm-marker jvm-element"></circle><circle data-index="7" cx="163.59911020489477" cy="147.81230394636265" r="7" fill="#0c768a" fill-opacity="1" stroke="#FFF" stroke-width="5" stroke-opacity="0.5" class="jvm-marker jvm-element"></circle><circle data-index="8" cx="184.6273099647423" cy="167.24915605570988" r="7" fill="#0c768a" fill-opacity="1" stroke="#FFF" stroke-width="5" stroke-opacity="0.5" class="jvm-marker jvm-element" cursor="pointer"></circle></g><g id="jvm-markers-labels-group"></g></svg></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END ROW -->

                <div class="row">
                    <div class="col-xl-7">
                        <div class="row">

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header border-0 align-items-center d-flex pb-0">
                                        <h4 class="card-title mb-0 flex-grow-1">Source of Purchases</h4>
                                        <div>
                                            <div class="dropdown">
                                                <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="fw-semibold">Sort By:</span>
                                                    <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Today</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div id="social-source" class="apex-charts" style="min-height: 225px;"><div id="apexchartsrlcuqe3s" class="apexcharts-canvas apexchartsrlcuqe3s apexcharts-theme-" style="width: 747px; height: 225px;"><svg id="SvgjsSvg2009" width="747" height="225" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"><foreignObject x="0" y="0" width="747" height="225"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"></div><style type="text/css">
                                                            .apexcharts-flip-y {
                                                                transform: scaleY(-1) translateY(-100%);
                                                                transform-origin: top;
                                                                transform-box: fill-box;
                                                            }
                                                            .apexcharts-flip-x {
                                                                transform: scaleX(-1);
                                                                transform-origin: center;
                                                                transform-box: fill-box;
                                                            }
                                                            .apexcharts-legend {
                                                                display: flex;
                                                                overflow: auto;
                                                                padding: 0 10px;
                                                            }
                                                            .apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
                                                                flex-wrap: wrap
                                                            }
                                                            .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
                                                                flex-direction: column;
                                                                bottom: 0;
                                                            }
                                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
                                                                justify-content: flex-start;
                                                            }
                                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                                                justify-content: center;
                                                            }
                                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                                                justify-content: flex-end;
                                                            }
                                                            .apexcharts-legend-series {
                                                                cursor: pointer;
                                                                line-height: normal;
                                                                display: flex;
                                                                align-items: center;
                                                            }
                                                            .apexcharts-legend-text {
                                                                position: relative;
                                                                font-size: 14px;
                                                            }
                                                            .apexcharts-legend-text *, .apexcharts-legend-marker * {
                                                                pointer-events: none;
                                                            }
                                                            .apexcharts-legend-marker {
                                                                position: relative;
                                                                display: flex;
                                                                align-items: center;
                                                                justify-content: center;
                                                                cursor: pointer;
                                                                margin-right: 1px;
                                                            }

                                                            .apexcharts-legend-series.apexcharts-no-click {
                                                                cursor: auto;
                                                            }
                                                            .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
                                                                display: none !important;
                                                            }
                                                            .apexcharts-inactive-legend {
                                                                opacity: 0.45;
                                                            }</style></foreignObject><g id="SvgjsG2011" class="apexcharts-inner apexcharts-graphical" transform="translate(172.5, 10)"><defs id="SvgjsDefs2010"><clipPath id="gridRectMaskrlcuqe3s"><rect id="SvgjsRect2012" width="402" height="592" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectBarMaskrlcuqe3s"><rect id="SvgjsRect2013" width="408" height="598" x="-3" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskrlcuqe3s"><rect id="SvgjsRect2014" width="402" height="592" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskrlcuqe3s"></clipPath><clipPath id="nonForecastMaskrlcuqe3s"></clipPath><filter id="SvgjsFilter2025" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood2026" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood2026Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite2027" in="SvgjsFeFlood2026Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite2027Out"></feComposite><feOffset id="SvgjsFeOffset2028" dx="1" dy="1" result="SvgjsFeOffset2028Out" in="SvgjsFeComposite2027Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur2029" stdDeviation="1 " result="SvgjsFeGaussianBlur2029Out" in="SvgjsFeOffset2028Out"></feGaussianBlur><feMerge id="SvgjsFeMerge2030" result="SvgjsFeMerge2030Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode2031" in="SvgjsFeGaussianBlur2029Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode2032" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend2033" in="SourceGraphic" in2="SvgjsFeMerge2030Out" mode="normal" result="SvgjsFeBlend2033Out"></feBlend></filter><filter id="SvgjsFilter2038" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood2039" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood2039Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite2040" in="SvgjsFeFlood2039Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite2040Out"></feComposite><feOffset id="SvgjsFeOffset2041" dx="1" dy="1" result="SvgjsFeOffset2041Out" in="SvgjsFeComposite2040Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur2042" stdDeviation="1 " result="SvgjsFeGaussianBlur2042Out" in="SvgjsFeOffset2041Out"></feGaussianBlur><feMerge id="SvgjsFeMerge2043" result="SvgjsFeMerge2043Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode2044" in="SvgjsFeGaussianBlur2042Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode2045" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend2046" in="SourceGraphic" in2="SvgjsFeMerge2043Out" mode="normal" result="SvgjsFeBlend2046Out"></feBlend></filter><filter id="SvgjsFilter2051" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood2052" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood2052Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite2053" in="SvgjsFeFlood2052Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite2053Out"></feComposite><feOffset id="SvgjsFeOffset2054" dx="1" dy="1" result="SvgjsFeOffset2054Out" in="SvgjsFeComposite2053Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur2055" stdDeviation="1 " result="SvgjsFeGaussianBlur2055Out" in="SvgjsFeOffset2054Out"></feGaussianBlur><feMerge id="SvgjsFeMerge2056" result="SvgjsFeMerge2056Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode2057" in="SvgjsFeGaussianBlur2055Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode2058" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend2059" in="SourceGraphic" in2="SvgjsFeMerge2056Out" mode="normal" result="SvgjsFeBlend2059Out"></feBlend></filter></defs><g id="SvgjsG2017" class="apexcharts-pie"><g id="SvgjsG2018" transform="translate(0, 0) scale(1)"><circle id="SvgjsCircle2019" r="152.07804878048782" cx="201" cy="201" fill="transparent"></circle><g id="SvgjsG2020" class="apexcharts-slices"><g id="SvgjsG2021" class="apexcharts-series apexcharts-pie-series" seriesName="E-Commerce" rel="1" data:realIndex="0"><path id="SvgjsPath2022" d="M 10.902439024390219 200.99999999999997 A 190.09756097560978 190.09756097560978 0 0 1 193.34554299481022 11.056608493921601 L 194.87643439584818 49.04528679513729 A 152.07804878048782 152.07804878048782 0 0 0 48.92195121951218 200.99999999999997 L 10.902439024390219 200.99999999999997 z " fill="rgba(12,118,138,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="87.6923076923077" data:startAngle="-90" data:strokeWidth="2" data:value="38" data:pathOrig="M 10.902439024390219 200.99999999999997 A 190.09756097560978 190.09756097560978 0 0 1 193.34554299481022 11.056608493921601 L 194.87643439584818 49.04528679513729 A 152.07804878048782 152.07804878048782 0 0 0 48.92195121951218 200.99999999999997 L 10.902439024390219 200.99999999999997 z " stroke="#ffffff"></path></g><g id="SvgjsG2034" class="apexcharts-series apexcharts-pie-series" seriesName="Facebook" rel="2" data:realIndex="1"><path id="SvgjsPath2035" d="M 193.34554299481022 11.056608493921601 A 190.09756097560978 190.09756097560978 0 0 1 352.97211946260705 86.80036079339493 L 322.57769557008567 109.64028863471596 A 152.07804878048782 152.07804878048782 0 0 0 194.87643439584818 49.04528679513729 L 193.34554299481022 11.056608493921601 z " fill="rgba(56,199,134,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="55.38461538461539" data:startAngle="-2.3076923076923066" data:strokeWidth="2" data:value="24" data:pathOrig="M 193.34554299481022 11.056608493921601 A 190.09756097560978 190.09756097560978 0 0 1 352.97211946260705 86.80036079339493 L 322.57769557008567 109.64028863471596 A 152.07804878048782 152.07804878048782 0 0 0 194.87643439584818 49.04528679513729 L 193.34554299481022 11.056608493921601 z " stroke="#ffffff"></path></g><g id="SvgjsG2047" class="apexcharts-series apexcharts-pie-series" seriesName="Instagram" rel="3" data:realIndex="2"><path id="SvgjsPath2048" d="M 352.97211946260705 86.80036079339493 A 190.09756097560978 190.09756097560978 0 0 1 391.0975580802584 200.96682171677807 L 353.0780464642067 200.97345737342246 A 152.07804878048782 152.07804878048782 0 0 0 322.57769557008567 109.64028863471596 L 352.97211946260705 86.80036079339493 z " fill="rgba(218,234,238,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="36.92307692307692" data:startAngle="53.07692307692308" data:strokeWidth="2" data:value="16" data:pathOrig="M 352.97211946260705 86.80036079339493 A 190.09756097560978 190.09756097560978 0 0 1 391.0975580802584 200.96682171677807 L 353.0780464642067 200.97345737342246 A 152.07804878048782 152.07804878048782 0 0 0 322.57769557008567 109.64028863471596 L 352.97211946260705 86.80036079339493 z " stroke="#ffffff"></path></g><g id="SvgjsG2023" class="apexcharts-datalabels"><text id="SvgjsText2024" font-family="Helvetica, Arial, sans-serif" x="77.6110564112702" y="82.48331097247713" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter2025)" style="font-family: Helvetica, Arial, sans-serif;">48.7%</text></g><g id="SvgjsG2036" class="apexcharts-datalabels"><text id="SvgjsText2037" font-family="Helvetica, Arial, sans-serif" x="274.3440692979967" y="46.430648326390525" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter2038)" style="font-family: Helvetica, Arial, sans-serif;">30.8%</text></g><g id="SvgjsG2049" class="apexcharts-datalabels"><text id="SvgjsText2050" font-family="Helvetica, Arial, sans-serif" x="363.28301769957193" y="146.82196806537053" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter2051)" style="font-family: Helvetica, Arial, sans-serif;">20.5%</text></g></g></g></g><line id="SvgjsLine2060" x1="0" y1="0" x2="402" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2061" x1="0" y1="0" x2="402" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG2015" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g><g id="SvgjsG2016" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g></svg><div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-0" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(12, 118, 138);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-1" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(56, 199, 134);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-2" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(218, 234, 238);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                                        <div class="social-content text-center">
                                            <p class="text-uppercase mb-1">Total Sales</p>
                                            <h3 class="mb-0">5,685</h3>
                                        </div>
                                        <p class="text-muted text-center w-75 mx-auto mt-4 mb-0">Magnis dis parturient montes
                                            nascetur ridiculus tincidunt lobortis.</p>
                                        <div class="row gx-4 mt-1">
                                            <div class="col-md-4">
                                                <div class="mt-4">
                                                    <div class="progress" style="height: 7px;">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="85">
                                                        </div>
                                                    </div>
                                                    <p class="text-muted mt-2 pt-2 mb-0 text-uppercase font-size-13 text-truncate">E-Commerce
                                                    </p>
                                                    <h4 class="mt-1 mb-0 font-size-20">52,524</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mt-4">
                                                    <div class="progress" style="height: 7px;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70">
                                                        </div>
                                                    </div>
                                                    <p class="text-muted mt-2 pt-2 mb-0 text-uppercase font-size-13 text-truncate">Facebook
                                                    </p>
                                                    <h4 class="mt-1 mb-0 font-size-20">48,625</h4>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mt-4">
                                                    <div class="progress" style="height: 7px;">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60">
                                                        </div>
                                                    </div>
                                                    <p class="text-muted mt-2 pt-2 mb-0 text-uppercase font-size-13 text-truncate">Instagram
                                                    </p>
                                                    <h4 class="mt-1 mb-0 font-size-20">85,745</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header border-0 align-items-center d-flex pb-0">
                                        <h4 class="card-title mb-0 flex-grow-1">Sales Statistics</h4>
                                        <div>
                                            <div class="dropdown">
                                                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Today<i class="mdi mdi-chevron-down ms-1"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Today</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="mb-0 mt-2">725,800</h4>
                                        <p class="mb-0 mt-2 text-muted">
                                                    <span class="badge badge-soft-success mb-0">
                                                         <i class="ri-arrow-up-line align-middle"></i>
                                                15.72 % </span> vs. previous month</p>

                                        <div class="mt-3 pt-1">
                                            <div class="progress progress-lg rounded-pill px-0">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 26%" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                        <div class="table-responsive mt-3">
                                            <table class="table align-middle table-centered table-nowrap mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Order Status</th>
                                                    <th scope="col">Orders</th>
                                                    <th scope="col">Returns</th>
                                                    <th scope="col">Earnings</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-dark">Product Pending</a>
                                                    </td>
                                                    <td>17,351</td>
                                                    <td>2,123</td>
                                                    <td><span class="badge bg-subtle-primary text-primary font-size-11 ms-1"><i class="mdi mdi-arrow-up"></i> 45.3%</span></td>
                                                </tr><!-- end -->

                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-dark">Product Cancelled</a>
                                                    </td>
                                                    <td>67,356</td>
                                                    <td>3,652</td>
                                                    <td><span class="badge bg-subtle-danger text-danger font-size-11 ms-1"><i class="mdi mdi-arrow-down"></i> 14.6%</span></td>
                                                </tr><!-- end -->


                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-dark">Product Delivered</a>
                                                    </td>
                                                    <td>67,356</td>
                                                    <td>3,652</td>
                                                    <td><span class="badge bg-subtle-primary text-primary font-size-11 ms-1"><i class="mdi mdi-arrow-up"></i> 14.6%</span></td>
                                                </tr><!-- end -->
                                                </tbody><!-- end tbody -->
                                            </table><!-- end table -->
                                        </div>

                                        <div class="text-center mt-4"><a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View More <i class="mdi mdi-arrow-right ms-1"></i></a></div>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-xl-5">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex pb-0">
                                <h4 class="card-title mb-0 flex-grow-1">Top Users</h4>
                                <div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="fw-semibold">Sort By:</span>
                                            <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Yearly</a>
                                            <a class="dropdown-item" href="#">Monthly</a>
                                            <a class="dropdown-item" href="#">Weekly</a>
                                            <a class="dropdown-item" href="#">Today</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-2">
                                <div class="table-responsive simplebar-scrollable-y" data-simplebar="init" style="max-height: 358px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                                                        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                            <tbody>
                                                            <tr>
                                                                <td style="width: 20px;"><img src="assets/images/users/avatar-4.jpg" class="avatar-sm rounded-circle " alt="..."></td>
                                                                <td>
                                                                    <h6 class="font-size-15 mb-1">Glenn Holden</h6>
                                                                    <p class="text-muted mb-0 font-size-14">glennholden@tocly.com</p>
                                                                </td>
                                                                <td class="text-muted"><i class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$250.00</td>
                                                                <td><span class="badge badge-soft-danger font-size-12">Cancel</span></td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <a class="text-muted dropdown-toggle font-size-20" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                            <i class="mdi mdi-dots-vertical"></i>
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="assets/images/users/avatar-5.jpg" class="avatar-sm rounded-circle " alt="..."></td>
                                                                <td>
                                                                    <h6 class="font-size-15 mb-1">Lolita Hamill</h6>
                                                                    <p class="text-muted mb-0 font-size-14">lolitahamill@tocly.com</p>
                                                                </td>
                                                                <td class="text-muted"><i class="mdi mdi-trending-down text-danger font-size-18 align-middle me-1"></i>$110.00</td>
                                                                <td><span class="badge badge-soft-success font-size-12">Success</span></td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <a class="text-muted dropdown-toggle font-size-20" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                            <i class="mdi mdi-dots-vertical"></i>
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="assets/images/users/avatar-6.jpg" class="avatar-sm rounded-circle " alt="..."></td>
                                                                <td>
                                                                    <h6 class="font-size-15 mb-1">Robert Mercer</h6>
                                                                    <p class="text-muted mb-0 font-size-14">robertmercer@tocly.com</p>
                                                                </td>
                                                                <td class="text-muted"><i class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$420.00</td>
                                                                <td><span class="badge badge-soft-info font-size-12">Active</span></td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <a class="text-muted dropdown-toggle font-size-20" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                            <i class="mdi mdi-dots-vertical"></i>
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="assets/images/users/avatar-7.jpg" class="avatar-sm rounded-circle " alt="..."></td>
                                                                <td>
                                                                    <h6 class="font-size-15 mb-1">Marie Kim</h6>
                                                                    <p class="text-muted mb-0 font-size-14">mariekim@tocly.com</p>
                                                                </td>
                                                                <td class="text-muted"><i class="mdi mdi-trending-down text-danger font-size-18 align-middle me-1"></i>$120.00</td>
                                                                <td><span class="badge badge-soft-warning font-size-12">Pending</span></td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <a class="text-muted dropdown-toggle font-size-20" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                            <i class="mdi mdi-dots-vertical"></i>
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="assets/images/users/avatar-8.jpg" class="avatar-sm rounded-circle " alt="..."></td>
                                                                <td>
                                                                    <h6 class="font-size-15 mb-1">Sonya Henshaw</h6>
                                                                    <p class="text-muted mb-0 font-size-14">sonyahenshaw@tocly.com</p>
                                                                </td>
                                                                <td class="text-muted"><i class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$112.00</td>
                                                                <td><span class="badge badge-soft-info font-size-12">Active</span></td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <a class="text-muted dropdown-toggle font-size-20" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                            <i class="mdi mdi-dots-vertical"></i>
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="assets/images/users/avatar-2.jpg" class="avatar-sm rounded-circle " alt="..."></td>
                                                                <td>
                                                                    <h6 class="font-size-15 mb-1">Marie Kim</h6>
                                                                    <p class="text-muted mb-0 font-size-14">marikim@tocly.com</p>
                                                                </td>
                                                                <td class="text-muted"><i class="mdi mdi-trending-down text-danger font-size-18 align-middle me-1"></i>$120.00</td>
                                                                <td><span class="badge badge-soft-success font-size-12">Success</span></td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <a class="text-muted dropdown-toggle font-size-20" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                            <i class="mdi mdi-dots-vertical"></i>
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="assets/images/users/avatar-1.jpg" class="avatar-sm rounded-circle " alt="..."></td>
                                                                <td>
                                                                    <h6 class="font-size-15 mb-1">Sonya Henshaw</h6>
                                                                    <p class="text-muted mb-0 font-size-14">sonyahenshaw@tocly.com</p>
                                                                </td>
                                                                <td class="text-muted"><i class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$112.00</td>
                                                                <td><span class="badge badge-soft-danger font-size-12">Cancel</span></td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <a class="text-muted dropdown-toggle font-size-20" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                            <i class="mdi mdi-dots-vertical"></i>
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div></div></div></div><div class="simplebar-placeholder" style="width: 747px; height: 469px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 273px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div> <!-- enbd table-responsive-->
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END ROW -->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex pb-0">
                                <h4 class="card-title mb-0 flex-grow-1">Latest Transaction</h4>
                                <div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="fw-semibold">Sort By:</span>
                                            <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Yearly</a>
                                            <a class="dropdown-item" href="#">Monthly</a>
                                            <a class="dropdown-item" href="#">Weekly</a>
                                            <a class="dropdown-item" href="#">Today</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-2">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th style="width: 20px;">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck1">
                                                    <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>Order ID</th>
                                            <th>Billing Name</th>
                                            <th>IP Address</th>
                                            <th>Order Date</th>
                                            <th>Total</th>
                                            <th>Payment Method</th>
                                            <th>Payment Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                            <td><img src="assets/images/users/avatar-2.jpg" class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>
                                            <td><p class="mb-0">cs562xf452dd</p></td>
                                            <td>
                                                07 Oct, 2022
                                            </td>
                                            <td>
                                                $400
                                            </td>
                                            <td>
                                                <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                            </td>
                                            <td>
                                                <span class="badge rounded badge-soft-success font-size-12">Completed</span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a href="javascript:void(0);" class="btn btn-success btn-sm"><i class="mdi mdi-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck3">
                                                    <label class="form-check-label" for="customCheck3">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body">#MB2541</a> </td>
                                            <td><img src="assets/images/users/avatar-3.jpg" class="avatar-xs rounded-circle me-2" alt="..."> Jamal Burnett</td>
                                            <td><p class="mb-0">ar252xf658dd</p></td>
                                            <td>
                                                07 Oct, 2022
                                            </td>
                                            <td>
                                                $380
                                            </td>

                                            <td>
                                                <i class="fab fa-cc-visa me-1"></i> Visa
                                            </td>
                                            <td>
                                                <span class="badge rounded badge-soft-danger font-size-12">Cancel</span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a href="javascript:void(0);" class="btn btn-success btn-sm"><i class="mdi mdi-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck4">
                                                    <label class="form-check-label" for="customCheck4">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body">#MB2542</a> </td>
                                            <td><img src="assets/images/users/avatar-4.jpg" class="avatar-xs rounded-circle me-2" alt="..."> Juan Mitchell</td>
                                            <td><p class="mb-0">op632xf223dd</p></td>
                                            <td>
                                                06 Oct, 2022
                                            </td>
                                            <td>
                                                $384
                                            </td>
                                            <td>
                                                <i class="fab fa-cc-paypal me-1"></i> Paypal
                                            </td>
                                            <td>
                                                <span class="badge rounded badge-soft-success font-size-12">Completed</span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a href="javascript:void(0);" class="btn btn-success btn-sm"><i class="mdi mdi-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck5">
                                                    <label class="form-check-label" for="customCheck5">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body">#MB2543</a> </td>
                                            <td><img src="assets/images/users/avatar-5.jpg" class="avatar-xs rounded-circle me-2" alt="..."> Barry Dick</td>
                                            <td><p class="mb-0">ty756xf985dd</p></td>
                                            <td>
                                                05 Oct, 2022
                                            </td>
                                            <td>
                                                $412
                                            </td>
                                            <td>
                                                <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                            </td>
                                            <td>
                                                <span class="badge rounded badge-soft-success font-size-12">Completed</span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a href="javascript:void(0);" class="btn btn-success btn-sm"><i class="mdi mdi-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck6">
                                                    <label class="form-check-label" for="customCheck6">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body">#MB2544</a> </td>
                                            <td><img src="assets/images/users/avatar-6.jpg" class="avatar-xs rounded-circle me-2" alt="..."> Ronald Taylor</td>
                                            <td><p class="mb-0">jf754xf431dd</p></td>
                                            <td>
                                                04 Oct, 2022
                                            </td>
                                            <td>
                                                $404
                                            </td>
                                            <td>
                                                <i class="fab fa-cc-visa me-1"></i> Visa
                                            </td>
                                            <td>
                                                <span class="badge rounded badge-soft-warning font-size-12">Shipping</span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a href="javascript:void(0);" class="btn btn-success btn-sm"><i class="mdi mdi-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck7">
                                                    <label class="form-check-label" for="customCheck7">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body">#MB2545</a> </td>
                                            <td><img src="assets/images/users/avatar-7.jpg" class="avatar-xs rounded-circle me-2" alt="..."> Jacob Hunter</td>
                                            <td><p class="mb-0">fd964xf467dd</p></td>
                                            <td>
                                                04 Oct, 2022
                                            </td>
                                            <td>
                                                $392
                                            </td>
                                            <td>
                                                <i class="fab fa-cc-paypal me-1"></i> Paypal
                                            </td>
                                            <td>
                                                <span class="badge rounded badge-soft-success font-size-12">Completed</span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a href="javascript:void(0);" class="btn btn-success btn-sm"><i class="mdi mdi-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END ROW -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script>2025 © Tocly.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar="init" class="h-100 simplebar-scrollable-y"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                            <div class="rightbar-title d-flex align-items-center px-3 py-4">

                                <h5 class="m-0 me-2">Settings</h5>

                                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                                    <i class="mdi mdi-close noti-icon"></i>
                                </a>
                            </div>

                            <!-- Settings -->
                            <hr class="mt-0">
                            <h6 class="text-center mb-0">Choose Layouts</h6>

                            <div class="p-4">
                                <div class="mb-2">
                                    <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="layout-1">
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked="">
                                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                                </div>

                                <div class="mb-2">
                                    <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="layout-2">
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsstyle="assets/css/bootstrap-dark.min.css" data-appstyle="assets/css/app-dark.min.css">
                                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                                </div>

                                <div class="mb-2">
                                    <img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="layout-3">
                                </div>
                                <div class="form-check form-switch mb-5">
                                    <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch" data-appstyle="assets/css/app-rtl.min.css">
                                    <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                                </div>


                            </div>

                        </div></div></div></div><div class="simplebar-placeholder" style="width: 280px; height: 850px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 775px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<!-- Icon -->
<script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Vector map-->
<script src="assets/libs/jsvectormap/jsvectormap.min.js"></script>
<script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

<script src="assets/js/pages/dashboard.init.js"></script><svg id="SvgjsSvg1165" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1166"></defs><polyline id="SvgjsPolyline1167" points="0,0"></polyline><path id="SvgjsPath1168" d="M0 0 "></path></svg>

<!-- App js -->
<script src="assets/js/app.js"></script>


<div class="jvm-tooltip" style="top: 428.508px; left: 1205.34px;">Russia</div></body>
</html>
