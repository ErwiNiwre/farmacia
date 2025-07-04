<header class="main-header">
    <!-- Section Logo and User -->
    <div class="inside-header">
        <div class="d-flex align-items-center logo-box justify-content-start">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo">
                <!-- logo-->
                <div class="logo-lg">
                    {{-- <span class="light-logo"><img src="../images/logo-dark-text.png" alt="logo"></span>
                    --}}
                    <span class="dark-logo"><img src="{{ asset('images/cmFioriWhite.png') }}" alt="logo"
                            height="45px"></span>
                </div>
            </a>
        </div>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <div class="app-menu">
                <ul class="header-megamenu nav">
                    <li class="btn-group d-lg-inline-flex d-none">
                        &nbsp;
                    </li>
                </ul>
            </div>

            <div class="navbar-custom-menu r-side">
                <ul class="nav navbar-nav">
                    <li class="btn-group nav-item d-lg-inline-flex d-none">
                        <a href="#" data-provide="fullscreen"
                            class="waves-effect waves-light nav-link full-screen btn-warning-light" title="Full Screen">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                    <!-- User Account-->
                    <li class="dropdown user user-menu">
                        <a href="#"
                            class="waves-effect waves-light dropdown-toggle w-auto l-h-12 bg-transparent py-0 no-shadow"
                            data-bs-toggle="dropdown" title="User">
                            <div class="d-flex pt-1">
                                <div class="text-end me-10">
                                    <p class="pt-5 fs-14 mb-0 fw-700 text-primary">{{ $session_name }}</p>
                                    <small class="fs-10 mb-0 text-uppercase text-mute">
                                        @if (Count($session_auth->getRoleNames()) != 0)
                                            @foreach ($session_auth->getRoleNames() as $rolNombre)
                                                {{ $rolNombre }}
                                            @endforeach
                                        @else
                                            {{ __('Super Administrador') }}
                                        @endif
                                    </small>
                                </div>
                                <img src="{!! asset('images/avatar/avatar-1.png') !!}" class="avatar rounded-10 bg-primary-light h-40 w-40"
                                    alt="" />
                            </div>
                        </a>
                        <ul class="dropdown-menu animated flipInX">
                            <li class="user-body">
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    <i class="ti-home text-muted me-2"></i> Inicio
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ti-lock text-muted me-2"></i> Cerrar Sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</header>

<nav class="main-nav" role="navigation">

    <!-- Mobile menu toggle button (hamburger/x icon) -->
    <input id="main-menu-state" type="checkbox" />
    <label class="main-menu-btn" for="main-menu-state">
        <span class="main-menu-btn-icon"></span> Toggle main menu visibility
    </label>

    <!-- Sample menu definition -->
    <ul id="main-menu" class="sm sm-blue">
        <li>
            <a href="{{ route('roles.index') }}">
                <i data-feather="settings"></i>Roles
            </a>
        </li>
        <li>
            <a href="{{ route('productos.index') }}">
                <i class="fa fa-fw fa-shopping-basket"></i>Productos
            </a>
        </li>
        <li>
            <a href="{{ route('compras.index') }}">
                <i class="fa fa-fw fa-shopping-bag"></i>Compras
            </a>
        </li>
        <li>
            <a href="{{ route('ventas.index') }}">
                <i class="fa fa-fw fa-shopping-cart"></i>Ventas
            </a>
        </li>
        <li>
            <a href="{{ route('laboratorioServicios.index') }}">
                <i class="fa fa-fw fa-stethoscope"></i>Laboratorio
            </a>
        </li>
        {{-- 
        <li>
            <a href="{{ route('patients.index') }}">
                <i data-feather="users"></i>Pacientes
            </a>
        </li>
        <li>
            <a href="{{ route('services.index') }}">
                <i class="fa fa-fw fa-file-archive-o"></i>Servicios
            </a>
        </li>
        <li>
            <a href="{{ route('attentions.index') }}">
                <i class="fa fa-fw fa-file-archive-o"></i>Atención Paciente
            </a>
        </li>
        <li>
            <a href="{{ route('tellers.index') }}">
                <i class="fa fa-fw fa-money"></i>Cajas
            </a>
        </li>
        <li>
            <a href="{{ route('purchases.index') }}">
                <i class="fa fa-fw fa-shopping-cart"></i>Compras
            </a>
        </li>
        <li>
            <a href="{{ route('purchases.index') }}">
                <i class="fa fa-fw fa-shopping-cart"></i>Reportes
            </a>
        </li> --}}
        {{-- <li><a href="#"><i data-feather="activity"></i>Doctors</a>
            <ul>
                <li><a href="doctor_list.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Doctor list</a></li>
                <li><a href="doctors.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Doctor Details</a></li>
            </ul>
        </li>
        <li><a href="#"><i data-feather="layers"></i>Apps</a>
            <ul>
                <li><a href="extra_calendar.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Calendar</a></li>
                <li><a href="contact_app.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Contact List</a></li>
                <li><a href="contact_app_chat.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Chat</a></li>
                <li><a href="extra_taskboard.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Todo</a></li>
                <li><a href="mailbox.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Mailbox</a></li>
            </ul>
        </li>
        <li><a href="#"><i data-feather="layout"></i>Widgets</a>
            <ul>
                <li><a href="widgets_blog.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Blog</a></li>
                <li><a href="widgets_chart.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Chart</a></li>
                <li><a href="widgets_list.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>List</a></li>
                <li><a href="widgets_social.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Social</a></li>
                <li><a href="widgets_statistic.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Statistic</a></li>
                <li><a href="widgets_weather.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Weather</a></li>
                <li><a href="widgets.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Widgets</a></li>
                <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Modals</a>
                    <ul>
                        <li><a href="component_modals.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Modals</a></li>
                        <li><a href="component_sweatalert.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Sweet Alert</a></li>
                        <li><a href="component_notification.html"><i class="icon-Commit"><span
                                        class="path1"></span><span class="path2"></span></i>Toastr</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Maps</a>
                    <ul>
                        <li><a href="map_google.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Google Map</a></li>
                        <li><a href="map_vector.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Vector Map</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#"><i data-feather="lock"></i>Login &amp; Error</a>
            <ul>
                <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Authentication</a>
                    <ul>
                        <li><a href="auth_login.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Login</a></li>
                        <li><a href="auth_register.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Register</a></li>
                        <li><a href="auth_lockscreen.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Lockscreen</a></li>
                        <li><a href="auth_user_pass.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Recover password</a>
                        </li>
                    </ul>
                </li>
                <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Miscellaneous</a>
                    <ul>
                        <li><a href="error_404.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Error 404</a></li>
                        <li><a href="error_500.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Error 500</a></li>
                        <li><a href="error_maintenance.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Maintenance</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#"><i data-feather="edit"></i>UI</a>
            <ul>
                <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Utilities</a>
                    <ul>
                        <li><a href="ui_grid.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Grid System</a></li>
                        <li><a href="ui_badges.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Badges</a></li>
                        <li><a href="ui_border_utilities.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Border</a></li>
                        <li><a href="ui_buttons.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Buttons</a></li>
                        <li><a href="ui_color_utilities.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Color</a></li>
                        <li><a href="ui_dropdown.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Dropdown</a></li>
                        <li><a href="ui_dropdown_grid.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Dropdown Grid</a>
                        </li>
                        <li><a href="ui_progress_bars.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Progress Bars</a>
                        </li>
                        <li><a href="ui_ribbons.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Ribbons</a></li>
                        <li><a href="ui_sliders.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Sliders</a></li>
                        <li><a href="ui_typography.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Typography</a></li>
                        <li><a href="ui_tab.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Tabs</a></li>
                        <li><a href="ui_timeline.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Timeline</a></li>
                        <li><a href="ui_timeline_horizontal.html"><i class="icon-Commit"><span
                                        class="path1"></span><span class="path2"></span></i>Horizontal
                                Timeline</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Card</a>
                    <ul>
                        <li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>User Card</a></li>
                        <li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Advanced Card</a></li>
                        <li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Basic Card</a></li>
                        <li><a href="box_color.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Card Color</a></li>
                        <li><a href="box_group.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Card Group</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Icons</a>
                    <ul>
                        <li><a href="icons_fontawesome.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Font Awesome</a>
                        </li>
                        <li><a href="icons_glyphicons.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Glyphicons</a></li>
                        <li><a href="icons_material.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Material Icons</a>
                        </li>
                        <li><a href="icons_themify.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Themify Icons</a></li>
                        <li><a href="icons_simpleline.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Simple Line
                                Icons</a></li>
                        <li><a href="icons_cryptocoins.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Cryptocoins
                                Icons</a></li>
                        <li><a href="icons_flag.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Flag Icons</a></li>
                        <li><a href="icons_weather.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Weather Icons</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Components</a>
                    <ul>
                        <li><a href="component_bootstrap_switch.html"><i class="icon-Commit"><span
                                        class="path1"></span><span class="path2"></span></i>Bootstrap Switch</a>
                        </li>
                        <li><a href="component_date_paginator.html"><i class="icon-Commit"><span
                                        class="path1"></span><span class="path2"></span></i>Date Paginator</a>
                        </li>
                        <li><a href="component_media_advanced.html"><i class="icon-Commit"><span
                                        class="path1"></span><span class="path2"></span></i>Advanced Medias</a>
                        </li>
                        <li><a href="component_rangeslider.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Range Slider</a>
                        </li>
                        <li><a href="component_rating.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Ratings</a></li>
                        <li><a href="component_animations.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Animations</a></li>
                        <li><a href="extension_fullscreen.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Fullscreen</a></li>
                        <li><a href="extension_pace.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Pace</a></li>
                        <li><a href="component_nestable.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Nestable</a></li>
                        <li><a href="component_portlet_draggable.html"><i class="icon-Commit"><span
                                        class="path1"></span><span class="path2"></span></i>Draggable
                                Portlets</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#"><i data-feather="file-text"></i>Forms & Table</a>
            <ul>
                <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Forms</a>
                    <ul>
                        <li><a href="forms_advanced.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Form Elements</a>
                        </li>
                        <li><a href="forms_general.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Form Layout</a></li>
                        <li><a href="forms_wizard.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Form Wizard</a></li>
                        <li><a href="forms_validation.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Form Validation</a>
                        </li>
                        <li><a href="forms_mask.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Formatter</a></li>
                        <li><a href="forms_xeditable.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Xeditable Editor</a>
                        </li>
                        <li><a href="forms_dropzone.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Dropzone</a></li>
                        <li><a href="forms_code_editor.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Code Editor</a></li>
                        <li><a href="forms_editors.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Editor</a></li>
                        <li><a href="forms_editor_markdown.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Markdown</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Tables</a>
                    <ul>
                        <li><a href="tables_simple.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Simple tables</a></li>
                        <li><a href="tables_data.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Data tables</a></li>
                        <li><a href="tables_editable.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Editable Tables</a>
                        </li>
                        <li><a href="tables_color.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Table Color</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#"><i data-feather="pie-chart"></i>Charts</a>
            <ul>
                <li><a href="charts_chartjs.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>ChartJS</a></li>
                <li><a href="charts_flot.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Flot</a></li>
                <li><a href="charts_inline.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Inline charts</a></li>
                <li><a href="charts_morris.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Morris</a></li>
                <li><a href="charts_peity.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Peity</a></li>
                <li><a href="charts_chartist.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Chartist</a></li>
                <li><a href="charts_c3_axis.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Axis Chart</a></li>
                <li><a href="charts_c3_bar.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Bar Chart</a></li>
                <li><a href="charts_c3_data.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Data Chart</a></li>
                <li><a href="charts_c3_line.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Line Chart</a></li>
                <li><a href="charts_echarts_basic.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Basic Charts</a></li>
                <li><a href="charts_echarts_bar.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Bar Chart</a></li>
                <li><a href="charts_echarts_pie_doughnut.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Pie & Doughnut Chart</a>
                </li>
            </ul>
        </li>
        <li><a href="#"><i data-feather="folder"></i>Pages</a>
            <ul>
                <li><a href="invoice.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Invoice</a></li>
                <li><a href="invoicelist.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Invoice List</a></li>
                <li><a href="extra_app_ticket.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Support Ticket</a></li>
                <li><a href="extra_profile.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>User Profile</a></li>
                <li><a href="contact_userlist_grid.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Userlist Grid</a></li>
                <li><a href="contact_userlist.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Userlist</a></li>
                <li><a href="sample_faq.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>FAQs</a></li>
                <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Extra
                        Pages</a>
                    <ul>
                        <li><a href="sample_blank.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Blank</a></li>
                        <li><a href="sample_coming_soon.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Coming Soon</a></li>
                        <li><a href="sample_custom_scroll.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Custom Scrolls</a>
                        </li>
                        <li><a href="sample_gallery.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Gallery</a></li>
                        <li><a href="sample_lightbox.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Lightbox Popup</a>
                        </li>
                        <li><a href="sample_pricing.html"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i>Pricing</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#"><i data-feather="shopping-bag"></i>Ecommerce</a>
            <ul>
                <li><a href="ecommerce_products.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Products</a></li>
                <li><a href="ecommerce_cart.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Products Cart</a></li>
                <li><a href="ecommerce_products_edit.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Products Edit</a></li>
                <li><a href="ecommerce_details.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Product Details</a></li>
                <li><a href="ecommerce_orders.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Product Orders</a></li>
                <li><a href="ecommerce_checkout.html"><i class="icon-Commit"><span class="path1"></span><span
                                class="path2"></span></i>Products Checkout</a></li>
            </ul>
        </li>
        <li><a href="email_index.html"><i data-feather="mail"></i>Emails</a></li> --}}
    </ul>
</nav>
