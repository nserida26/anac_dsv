    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand" href="{{url('home')}}">
                    <span class="brand-logo"><img style="border-radius: 50%;" src="{{asset('/app-assets/images/logo_gret.png')}}" /></span>
                        <h2 class="brand-text">GRET</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                
                <li class="nav-item {{ (request()->is('home')) ? 'active' : ''}}"><a class="d-flex align-items-center" href="{{url('home')}}">
                <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span></a>
                </li>
                <li class="nav-item {{ (request()->is('maps')) ? 'active' : ''}}"><a class="d-flex align-items-center" href="{{url('maps')}}">
                
                <i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Carte">Carte</span></a>
                </li>
                <li class="nav-item {{ (request()->is('reportings')) ? 'active' : ''}}"><a class="d-flex align-items-center" href="{{url('reportings')}}"><i data-feather="pie-chart"></i><span class="menu-title text-truncate" data-i18n="Reporting">Reporting</span></a>
                </li>
                <li class=" nav-item {{ (request()->is('imports')) ? 'active' : ''}}"><a class="d-flex align-items-center" href="{{url('imports')}}"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Imports">Imports</span></a>
                </li>              
                <li class="nav-item {{ (request()->is('users')) ? 'active' : ''}}"><a class="d-flex align-items-center" href="{{url('users')}}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Utilisateur">Gestion des utilisateurs</span></a>
                </li>
                <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Paramétrage">Paramétrage</span></a>
                    <ul class="menu-content">
                        <li class=" nav-item {{ (request()->is('communes')) ? 'active' : ''}}"><a class="d-flex align-items-center" href="{{url('communes')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Commune">Commune</span></a>
                        </li>
                        <li class=" nav-item {{ (request()->is('localites')) ? 'active' : ''}}"><a class="d-flex align-items-center" href="{{url('localites')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Localité">Localité</span></a>
                        </li>
                        
                        <li class=" nav-item {{ (request()->is('projets')) ? 'active' : ''}}"><a class="d-flex align-items-center" href="{{url('projets')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Projet">Projet</span></a>
                        </li>
                        <li class=" nav-item {{ (request()->is('intervenants')) ? 'active' : ''}}"><a class="d-flex align-items-center" href="{{url('intervenants')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Intervenant">Intervenant</span></a>
                        </li>
                        <li class=" nav-item {{ (request()->is('bailleurs')) ? 'active' : ''}}"><a class="d-flex align-items-center" href="{{url('bailleurs')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Bailleur">Bailleur</span></a>
                        </li>
                        <li class=" nav-item {{ (request()->is('menages')) ? 'active' : ''}}"><a class="d-flex align-items-center" href="{{url('menages')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Menage">Ménage</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->