<header class="rick-page-header">
    <div class="rick-sibebar-icon me-auto">
        <i class="fa fa-bars fa-lg"></i>
    </div>
    <div class="row row-cols-auto g-3">
        <div class="col">
            <a href="{{ route('admin.license-verification') }}" class="btn btn-outline-success rounded-1">
                <i class="fa-solid fa-key"></i>
                <span class="d-none d-lg-inline ms-1">{{ translate('License Verification') }}</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('admin.system.info.cache') }}" class="btn btn-outline-danger rounded-1 action-confirm">
                <i class="fa-solid fa-broom"></i>
                <span class="d-none d-lg-inline ms-1">{{ translate('Clear Cache') }}</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-dark rounded-1">
                <i class="fa-solid fa-eye"></i>
                <span class="d-none d-lg-inline ms-1">{{ translate('Preview') }}</span>
            </a>
        </div>
    </div>
    <div class="rick-notifications ms-2" data-dropdown-v2>
        <div class="rick-notifications-title">
            <i class="far fa-bell"></i>
            <div class="counter">{{ $navbarNotifications['unread'] > 9 ? '9+' : $navbarNotifications['unread'] }}</div>
        </div>
        <div class="rick-notifications-menu">
            <div class="rick-notifications-header">
                <p class="rick-notifications-header-title mb-0">
                    {{ translate('Notifications') }} ({{ $navbarNotifications['unread'] }})</p>
                @if ($navbarNotifications['unread'] > 0)
                    <div class="ms-auto">
                        <form action="{{ route('admin.notifications.read.all') }}" method="POST">
                            @csrf
                            <button
                                class="rick-notifications-read-button action-confirm">{{ translate('Mark All as Read') }}</button>
                        </form>
                    </div>
                @endif
            </div>
            <div class="rick-notifications-body">
                @forelse ($navbarNotifications['list'] as $navbarNotification)
                    @if ($navbarNotification->link)
                        <a class="rick-notification {{ !$navbarNotification->status ? 'unread' : '' }}"
                            href="{{ route('admin.notifications.view', $navbarNotification->id) }}"
                            {{ $navbarNotification->isLinkTypeExternal() ? 'target=_blank' : '' }}>
                            <div class="rick-notification-image">
                                <img src="{{ $navbarNotification->image }}" alt="{{ $navbarNotification->title }}">
                            </div>
                            <div class="rick-notification-info">
                                <p
                                    class="rick-notification-title mb-0 d-flex justify-content-between align-items-center">
                                    <span>{{ $navbarNotification->title }}</span>
                                    @if (!$navbarNotification->status)
                                        <span class="unread flashit"><i class="fas fa-circle"></i></span>
                                    @endif
                                </p>
                                <p class="rick-notification-text mb-0">
                                    {{ $navbarNotification->created_at->diffforhumans() }}
                                </p>
                            </div>
                        </a>
                    @else
                        <div class="rick-notification {{ !$navbarNotification->status ? 'unread' : '' }}">
                            <div class="rick-notification-image">
                                <img src="{{ $navbarNotification->image }}" alt="{{ $navbarNotification->title }}">
                            </div>
                            <div class="rick-notification-info">
                                <p
                                    class="rick-notification-title mb-0 d-flex justify-content-between align-items-center">
                                    <span>{{ $navbarNotification->title }}</span>
                                    @if (!$navbarNotification->status)
                                        <span class="unread flashit"><i class="fas fa-circle"></i></span>
                                    @endif
                                </p>
                                <p class="rick-notification-text mb-0">
                                    {{ $navbarNotification->created_at->diffforhumans() }}
                                </p>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="empty">
                        <small class="text-muted mb-0">{{ translate('No notifications found') }}</small>
                    </div>
                @endforelse
            </div>
            <a class="rick-notifications-footer" href="{{ route('admin.notifications.index') }}">
                {{ translate('View All') }}
            </a>
        </div>
    </div>
    <div class="rick-user-menu">
        <div class="rick-user" id="dropdownMenuButton" data-bs-toggle="dropdown">
            <div class="rick-user-avatar">
                <img src="{{ authUser()->getAvatar() }}" alt="{{ authUser()->getName() }}" />
            </div>
            <div class="rick-user-info d-none d-md-block">
                <p class="rick-user-title mb-0">{{ authUser()->getName() }}</p>
                <p class="rick-user-text mb-0">{{ authUser()->email }}</p>
            </div>
        </div>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li>
                <a class="dropdown-item" href="{{ route('admin.account.index') }}">
                    <i class="fa-solid fa-user-pen me-1"></i>
                    {{ translate('Account') }}
                </a>
            </li>
            <li>
                <a class="dropdown-item text-danger" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    {{ translate('Logout') }}
                </a>
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </div>
</header>
