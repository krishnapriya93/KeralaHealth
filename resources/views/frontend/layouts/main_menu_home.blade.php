<div class="d-flex justify-content-between align-items-center">
    <div class="site-navigation">
        <nav class="main-menu navbar-expand-xl navbar-light">
            <div class="navbar-header">
                <!-- Toggle Button -->
                <button class="navbar-toggler" type="button">
                    <i class="pbmit-base-icon-menu-1"></i>
                </button>
            </div>
            <div class="pbmit-mobile-menu-bg"></div>

            <div class="collapse navbar-collapse clearfix show" id="pbmit-menu">
                <div class="pbmit-menu-wrap">
                    <span class="closepanel">
                        <svg class="qodef-svg--close qodef-m" xmlns="http://www.w3.org/2000/svg" width="20.163" height="20.163" viewBox="0 0 26.163 26.163">
                            <rect width="36" height="1" transform="translate(0.707) rotate(45)"></rect>
                            <rect width="36" height="1" transform="translate(0 25.456) rotate(-45)"></rect>
                        </svg>
                    </span>

                    {{-- menu list --}}
                    {{--
                        11. hashtag just hashid
                        12. url target blank
                        13. file  download
                        14. article article detail
                        15. form   
                        16. route routename
                        17. submenu
                    --}}

                    <ul class="navigation clearfix">
                        <!-- //////////////////Dynamic main menu////////////////////// -->
                        @foreach ($mainsubmenu as $menuitem)
                        @foreach ($menuitem['mainmenu_sub'] as $maindata)
                        @if($menuitem->menulinktype_id == 11)
                        {{-- hashtag --}}
                        <li><a class="nav-link scrollto" href="#{{ $menuitem->menulinktype_data }}"><span><i class="{{ $menuitem->iconclass ?? '' }}"></i> &nbsp; {{ $maindata->title }}</span></a></li>
                        @elseif($menuitem->menulinktype_id == 12)
                        {{-- url --}}
                        <li><a class="nav-link" href="{{ $menuitem->menulinktype_data }}" target="_blank"><span><i class="{{ $menuitem->iconclass ?? '' }}"></i> &nbsp; {{ $maindata->title }}</span></a></li>
                        @elseif($menuitem->menulinktype_id == 13)
                        {{-- file --}}
                        <li><a class="nav-link" href="{{ asset('uploads/Mainmenu/'.$menuitem->menulinktype_data) }}" target="_blank"><span><i class="{{ $menuitem->iconclass ?? '' }}"></i> &nbsp; {{ $maindata->title }}</span></a></li>
                        @elseif($menuitem->menulinktype_id == 14)
                        {{-- article --}}
                        @php $enarticletype_id = \Crypt::encryptString($menuitem->articletype_id) @endphp
                        <li><a class="nav-link" href="{{ route('main.mainarticleview' , $enarticletype_id) }}"><span><i class="{{ $menuitem->iconclass ?? '' }}"></i> &nbsp; {{ $maindata->title }}</span></a></li>
                        @elseif($menuitem->menulinktype_id == 16)
                        {{-- route --}}
                        <li><a class="nav-link" href="{{ url($menuitem->menulinktype_data) }}"><span><i class="{{ $menuitem->iconclass ?? '' }}"></i> &nbsp; {{ $maindata->title }}</span></a></li>
                        @elseif($menuitem->menulinktype_id == 17)
                        {{-- submenu --}}
                        <li class="dropdown menu-z-index-fix"><a href="#"><span><i class="{{ $menuitem->iconclass ?? '' }}"></i> {{ $maindata->title }}</span> <i class="bi bi-chevron-down"></i></a>
                            <ul class="menu-z-index-fix">

                                @foreach ($menuitem['sub_menu'] as $subdata)
                                @foreach ($subdata['submenusub'] as $subitem)
                                @if($subdata->menulinktype_id == 14)
                                {{-- article --}}
                                @php $enarticletype_id = \Crypt::encryptString($subdata->articletype_id) @endphp
                                <li><a href="{{ route('main.mainarticleview' , $enarticletype_id) }}">{{ $subitem->title }} </a></li>
                                @elseif($subdata->menulinktype_id == 12)
                                <li><a href="{{ $subdata->menulinktype_data }}" target="_blank">{{ $subitem->title }}</a></li>
                                @elseif($subdata->menulinktype_id == 13)
                                <li><a href="{{ asset('uploads/Submenu/'.$subdata->menulinktype_data) }}" target="_blank">{{ $subitem->title }}</a></li>
                                @elseif($subdata->menulinktype_id == 16)
                                {{-- route --}}
                                <li><a href="{{ url($subdata->menulinktype_data) }}">{{ $subitem->title }}</a></li>


                                @endif

                                @endforeach
                                @endforeach
                                {{-- <li><a href="#">Link</a></li> --}}
                            </ul>
                        </li>
                        @endif


                        @endforeach
                        @endforeach
                        <!-- //////////////////////////////////////// -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>