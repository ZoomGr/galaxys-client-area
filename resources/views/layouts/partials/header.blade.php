<div class="header">
    @php $new_nots_count = $chat_notification_helper->getNewNotificationsCount()['notification'] @endphp

    <div class="header__wrapper">
        <div class="header__search">
{{--            <form action="#" method="get" class="main-search main-search_light">--}}
{{--                <div class="main-search__element">--}}
{{--                    <div class="main-search__icon">--}}
{{--                        <i class="icon icon-search"></i>--}}
{{--                    </div>--}}
{{--                    <input type="search" placeholder="Search for assets, certificates etc">--}}
{{--                </div>--}}
{{--                <div class="main-search__dropdown">--}}
{{--                    <div class="main-search__dropdown-wrap shadow-xs">--}}
{{--                        <a href="#" class="main-search__link">--}}
{{--                            <i class="icon icon-search"></i>--}}
{{--                            Baccarat--}}
{{--                        </a>--}}
{{--                        <a href="#" class="main-search__link">--}}
{{--                            <i class="icon icon-search"></i>--}}
{{--                            Baccarat assets--}}
{{--                        </a>--}}
{{--                        <a href="#" class="main-search__link">--}}
{{--                            <i class="icon icon-search"></i>--}}
{{--                            Baccarat files--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
        </div>
        <div class="header__action">
            @php //$new_messages_count = $chat_notification_helper->getNewMessagesCount(); @endphp
{{--            <div class="header-badge messages-badge">--}}
{{--                <a href="{{route('users.supports')}}" class="header-badge__wrap round-badge">--}}
{{--                    @if($new_messages_count['messages'] > 0)--}}
{{--                        <div class="header-badge__count">{{$new_messages_count['messages']}}</div>--}}
{{--                    @endif--}}
{{--                    <i class="icon icon-message"></i>--}}
{{--                </a>--}}
{{--            </div>--}}
            <div class="header-badge notifies">
                @php $new_nots_count = $chat_notification_helper->getNewNotificationsCount()['notification'] @endphp
                <div class="header-badge__wrap round-badge">
                    @if($new_nots_count > 0)
                        <div class="header-badge__count">{{$chat_notification_helper->getNewNotificationsCount()['notification']}}</div>
                    @endif
                    <i class="icon icon-bell"></i>
                </div>
                <div class="header-badge__dropdown">
                    <div class="header-badge__dropdown-wrap shadow-sm">
                        <div class="notifies__title text-20 font-semibold">Notifications</div>
                        <div class="notifies__list">
                            @foreach($chat_notification_helper->getLastNotifications() as $notification)
                                    @if($notification->entityData->ed_number_1 == 1)
                                        <a href="{{route('users.notifications')}}" class="notify-item">
                                            <div class="notify-item__icon">
                                                <img src="{{asset('assets/img/info.svg')}}" alt="info">
                                            </div>
                                            <div class="notify-item__body">
                                                <div class="notify-item__text">{{$notification->entityDataLang->edl_title}}</div>
                                                <div class="notify-item__date">
                                                    {{\Carbon\Carbon::parse($notification->entity_update_date ?? $notification->entity_creation_date)->format('M d Y')}} at
                                                    {{\Carbon\Carbon::parse($notification->entity_update_date ?? $notification->entity_creation_date)->format('H:i')}}
                                                </div>
                                            </div>
                                            <div class="notify-item__arrow">
                                                <i class="icon icon-arrow-right"></i>
                                            </div>
                                        </a>
                                    @else
                                        <a href="{{route('users.notifications')}}" class="notify-item">
                                            <div class="notify-item__icon">
                                                <img src="{{asset('assets/img/warning.svg')}}" alt="warning">
                                            </div>
                                            <div class="notify-item__body">
                                                <div class="notify-item__text">{{$notification->entityDataLang->edl_title}}</div>
                                                <div class="notify-item__date">
                                                    {{\Carbon\Carbon::parse($notification->entity_update_date ?? $notification->entity_creation_date)->format('M d Y')}} at
                                                    {{\Carbon\Carbon::parse($notification->entity_update_date ?? $notification->entity_creation_date)->format('H:i')}}
                                                </div>
                                            </div>
                                            <div class="notify-item__arrow">
                                                <i class="icon icon-arrow-right"></i>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__profile">
                <div class="profile">
                    <div class="profile__wrap">
                        <div class="profile__avatar">
                            <img src="{{asset('assets/img/draft/profile.jpg')}}" alt="profile">
                        </div>
                        <div class="profile__arrow">
                            <i class="icon icon-chevron-down"></i>
                        </div>
                    </div>
                    <div class="profile__dropdown">
                        <div class="profile__dropdown-wrap shadow-sm">
                            <a href="{{route('users.favorites')}}" class="profile__link">
                                <i class="icon icon-heart"></i>
                                Favourites
                            </a>
                            <a href="{{route('users.settings')}}" class="profile__link">
                                <i class="icon icon-settings"></i>
                                Settings
                            </a>
                            <a href="{{ route('logout') }}" class="profile__link" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="icon icon-logout"></i>
                                Log out
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sidebar">
    <div class="sidebar__wrapper">
        <div class="sidebar__logo">
            <a href="{{route('home')}}">
                <img src="{{ asset('assets/img/theme/logo.svg')}}" alt="logo">
            </a>
        </div>
        <div class="sidebar__nav">
            <div class="sidebar__nav-wrap">
                <a href="{{route('home')}}" class="sidebar-link font-semibold {{Route::currentRouteName() == 'home' ? 'active' : ''}}">
                    <div class="sidebar-link__icon">
                        <img src="{{ asset('assets/img/theme/home.svg')}}" alt="Home">
                        <img src="{{ asset('assets/img/theme/home-active.svg')}}" alt="Home">
                    </div>
                    <div class="sidebar-link__title">Home</div>
                </a>
                <a href="{{route('games.index')}}" class="sidebar-link font-semibold {{in_array(Route::currentRouteName(), ['games.index', 'games.show']) ? 'active' : ''}}">
                    <div class="sidebar-link__icon">
                        <img src="{{ asset('assets/img/theme/library.svg')}}" alt="Library">
                        <img src="{{ asset('assets/img/theme/library-active.svg')}}" alt="Library">
                    </div>
                    <div class="sidebar-link__title">Game Library</div>
                </a>
                <a href="{{route('medias.index')}}" class="sidebar-link font-semibold {{in_array(Route::currentRouteName(), ['medias.index']) ? 'active' : ''}}">
                    <div class="sidebar-link__icon">
                        <img src="{{ asset('assets/img/theme/media.svg')}}" alt="Media">
                        <img src="{{ asset('assets/img/theme/media-active.svg')}}" alt="Media">
                    </div>
                    <div class="sidebar-link__title">Media Files</div>
                </a>
{{--                <a href="{{route('games.roadmap')}}" class="sidebar-link {{Route::currentRouteName() == 'games.roadmap' ? 'active' : ''}}">--}}
{{--                    <div class="sidebar-link__icon">--}}
{{--                        <img src="{{ asset('assets/img/theme/calendar.svg')}}" alt="Roadmap">--}}
{{--                        <img src="{{ asset('assets/img/theme/calendar-active.svg')}}" alt="Roadmap">--}}
{{--                    </div>--}}
{{--                    <div class="sidebar-link__title">Roadmap</div>--}}
{{--                </a>--}}
{{--                <a href="{{route('compliance.index')}}" class="sidebar-link {{Route::currentRouteName() == 'compliance.index' ? 'active' : ''}}">--}}
{{--                    <div class="sidebar-link__icon">--}}
{{--                        <img src="{{ asset('assets/img/theme/notebook.svg')}}" alt="Compliance">--}}
{{--                        <img src="{{ asset('assets/img/theme/notebook-active.svg')}}" alt="Compliance">--}}
{{--                    </div>--}}
{{--                    <div class="sidebar-link__title">Compliance</div>--}}
{{--                </a>--}}
            </div>
            <div class="sidebar__nav-wrap">
                <a href="{{route('news.index')}}" class="sidebar-link {{in_array(Route::currentRouteName(), ['news.index', 'news.show']) ? 'active' : ''}}">
                    <div class="sidebar-link__icon">
                        <img src="{{ asset('assets/img/theme/doc.svg')}}" alt="News">
                        <img src="{{ asset('assets/img/theme/doc-active.svg')}}" alt="News">
                    </div>
                    <div class="sidebar-link__title">News</div>
                </a>
{{--                <a href="{{route('promos.index')}}" class="sidebar-link {{in_array(Route::currentRouteName(), ['promo.index', 'promo.show']) ? 'active' : ''}}">--}}
{{--                    <div class="sidebar-link__icon">--}}
{{--                        <img src="{{ asset('assets/img/theme/star.svg')}}" alt="Promo">--}}
{{--                        <img src="{{ asset('assets/img/theme/star-active.svg')}}" alt="Promo">--}}
{{--                    </div>--}}
{{--                    <div class="sidebar-link__title">Promo</div>--}}
{{--                </a>--}}
            </div>
        </div>
        <div class="sidebar__info">
            <a href="{{asset('assets/img/Imagine-Live-Integration-Tecnical-Documentation.pdf')}}" download class="text-14 font-medium color-black-10">
                Integration Documentation
            </a>
            <span class="text-14 font-medium color-black-10">
                Support information
            </span>
            <span class="font-semibold color-white">galaxsysmarketing@galaxsys.co</span>
        </div>
    </div>
</div>
