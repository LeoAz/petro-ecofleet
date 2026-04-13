<div>
    <div class="nk-aside" data-content="sidebar" data-toggle-overlay="true" data-toggle-screen="lg" data-toggle-body="true">
        <div class="nk-sidebar-menu" data-simplebar>
            <ul class="nk-menu">
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Parametres</h6>
                </li><!-- .nk-menu-heading -->
                <li class="nk-menu-item">
                    <a href="{{ route('admin.role.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-shield-alert"></em></span>
                        <span class="nk-menu-text">Rôles</span>
                    </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                    <a href="{{ route('admin.user.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                        <span class="nk-menu-text">Utilisateurs</span>
                    </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                    <a href="{{ route('admin.permission.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-alert"></em></span>
                        <span class="nk-menu-text">Permissions</span>
                    </a>
                </li><!-- .nk-menu-item -->
            </ul><!-- .nk-menu -->
        </div><!-- .nk-sidebar-menu -->
        <div class="nk-aside-close">
            <a href="#" class="toggle" data-target="sidebar"><em class="icon ni ni-cross"></em></a>
        </div><!-- .nk-aside-close -->
    </div><!-- .nk-aside -->
</div>
