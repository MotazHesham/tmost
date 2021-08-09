<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/user-alerts*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_alert_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userAlert.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('package_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/books*") ? "c-show" : "" }} {{ request()->is("admin/videos*") ? "c-show" : "" }} {{ request()->is("admin/packages*") ? "c-show" : "" }} {{ request()->is("admin/packages-orders*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cubes c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.packageManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('book_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.books.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/books") || request()->is("admin/books/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.book.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('video_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.videos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/videos") || request()->is("admin/videos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-video c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.video.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('package_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.packages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/packages") || request()->is("admin/packages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cube c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.package.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('packages_order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.packages-orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/packages-orders") || request()->is("admin/packages-orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-gift c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.packagesOrder.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('real_estate_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/quotes*") ? "c-show" : "" }} {{ request()->is("admin/real-estate-registrations*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-building c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.realEstateManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('quote_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.quotes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/quotes") || request()->is("admin/quotes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.quote.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('real_estate_registration_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.real-estate-registrations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/real-estate-registrations") || request()->is("admin/real-estate-registrations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.realEstateRegistration.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('refugees_lega_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/refugees-legal-services*") ? "c-show" : "" }} {{ request()->is("admin/refugees-lega-registrations*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-archway c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.refugeesLegaManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('refugees_legal_service_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.refugees-legal-services.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/refugees-legal-services") || request()->is("admin/refugees-legal-services/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-center c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.refugeesLegalService.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('refugees_lega_registration_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.refugees-lega-registrations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/refugees-lega-registrations") || request()->is("admin/refugees-lega-registrations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-child c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.refugeesLegaRegistration.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('consulting_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/consultings*") ? "c-show" : "" }} {{ request()->is("admin/consulting-bookings*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-clipboard-list c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.consultingManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('consulting_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.consultings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/consultings") || request()->is("admin/consultings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-contract c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.consulting.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('consulting_booking_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.consulting-bookings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/consulting-bookings") || request()->is("admin/consulting-bookings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-check-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.consultingBooking.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('seminars_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/seminars*") ? "c-show" : "" }} {{ request()->is("admin/seminars-subscriptions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-award c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.seminarsManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('seminar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.seminars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/seminars") || request()->is("admin/seminars/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-grip-horizontal c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.seminar.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('seminars_subscription_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.seminars-subscriptions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/seminars-subscriptions") || request()->is("admin/seminars-subscriptions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.seminarsSubscription.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('client_managment_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.client-managments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/client-managments") || request()->is("admin/client-managments/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-address-card c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.clientManagment.title') }}
                </a>
            </li>
        @endcan
        @can('code_for_pay_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.code-for-pays.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/code-for-pays") || request()->is("admin/code-for-pays/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-money-bill-wave c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.codeForPay.title') }}
                </a>
            </li>
        @endcan
        @can('blogs_managment_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.blogs-managments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/blogs-managments") || request()->is("admin/blogs-managments/*") ? "c-active" : "" }}">
                    <i class="fa-fw fab fa-blogger c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.blogsManagment.title') }}
                </a>
            </li>
        @endcan
        @can('general_setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/countries*") ? "c-show" : "" }} {{ request()->is("admin/contactuses*") ? "c-show" : "" }} {{ request()->is("admin/settings*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.generalSetting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('country_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.countries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-flag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.country.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('contact_us_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contactuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contactuses") || request()->is("admin/contactuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-contao c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactUs.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('setting_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.settings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.setting.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('content_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/content-categories*") ? "c-show" : "" }} {{ request()->is("admin/content-tags*") ? "c-show" : "" }} {{ request()->is("admin/content-pages*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('content_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_page_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-pages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentPage.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>