<div class="nk-header nk-header-fixed is-light">
    <div class="container-lg wide-xl">
        <div class="nk-header-wrap">
            <div class="nk-header-brand">
                <a href="#" class="logo-link">
                    <img class="logo-light logo-img" src="{{ asset('assets/images/newecofleet.png') }}" srcset="{{ asset('assets/images/newecofleet.png') }}" alt="logo">
                    <img class="logo-dark logo-img" src="{{ asset('assets/images/newecofleet.png') }}" srcset="{{ asset('assets/images/newecofleet.png') }}" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu">
                <ul class="nk-menu nk-menu-main">
                    <li class="nk-menu-item">
                        <a href="{{ route('dashbord.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">
                                Tableau de bord
                            </span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.user.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">Administration</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title="" title="">
                            <span class="nk-menu-text">Modules de gestion</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('fleet.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Gestion flotte</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('exploitation.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Exploitation</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('maintenance.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Maintenance</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('docs.vehs.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Docs Administratifs</span>
                                </a>
                            </li><!-- .nk-menu-item -->
                        </ul><!-- .nk-menu-sub -->
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title="" title="">
                            <span class="nk-menu-text">Compte tiers</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('tiers.fleet.vehicle.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Gestion flotte</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('tiers.exploitation.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Exploitation</span>
                                </a>
                            </li><!-- .nk-menu-item -->
                        </ul><!-- .nk-menu-sub -->
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title="" title="">
                            <span class="nk-menu-text">Comptabilité</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('cashbox.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Gestion Caisse</span>
                                </a>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="{{ route('exploitation.customer.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Gestion Clients</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('exploitation.sale.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Facturation dossier</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('exploitation.daily-expense.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Dépense Journaliere</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('exploitation.expense.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Dépense de voyage</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('reporting.salary') }}" class="nk-menu-link">
                            <span class="nk-menu-text">Reporting</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                </ul><!-- .nk-menu -->
            </div><!-- .nk-header-menu -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    {{-- <li class="dropdown notification-dropdown">
                         <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                             <div class="icon-status icon-status-na"><em class="icon ni ni-bell"></em></div>
                         </a>
                         <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                             <div class="dropdown-head">
                                 <span class="sub-title nk-dropdown-title">Notifications</span>
                                 <a href="#">Lire tout</a>
                             </div>
                             <div class="dropdown-body">
                                 <div class="nk-notification">
                                     <div class="nk-notification-item dropdown-inner">
                                         <div class="nk-notification-icon">
                                             <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                         </div>
                                         <div class="nk-notification-content">
                                             <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                             <div class="nk-notification-time">2 hrs ago</div>
                                         </div>
                                     </div>
                                     <div class="nk-notification-item dropdown-inner">
                                         <div class="nk-notification-icon">
                                             <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                         </div>
                                         <div class="nk-notification-content">
                                             <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                             <div class="nk-notification-time">2 hrs ago</div>
                                         </div>
                                     </div>
                                 </div><!-- .nk-notification -->
                             </div><!-- .nk-dropdown-body -->
                             <div class="dropdown-foot center">
                                 <a href="#">Voir tout</a>
                             </div>
                         </div>
                     </li>--}}<!-- .dropdown -->
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle mr-lg-n1" data-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="lead-text">{{ auth()->user()->name }}</span>
                                        <span class="sub-text">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="#"><em class="icon ni ni-setting-alt"></em><span> Paramêtres</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>--}}
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <em class="icon ni ni-signout"></em>
                                            <span>Se deconnecter</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .dropdown -->
                    <li class="d-lg-none">
                        <a href="#" class="toggle nk-quick-nav-icon mr-n1" data-target="respMenu"><em class="icon ni ni-menu"></em></a>
                    </li>
                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
