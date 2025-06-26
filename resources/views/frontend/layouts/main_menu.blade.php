  <!-- Header Main Area -->
  <header class="site-header header-style-2">
      <div class="top-head pbmit-pre-header-wrapper pbmit-bg-color-global">
          <div class="container-fluid">
              <div class="d-flex justify-content-between">
                  <div class="pbmit-pre-header-left">
                      <ul class="pbmit-contact-info">
                          <li><i class="pbmit-base-icon-marker"></i>Kerala Health, Government Secretariat </li>
                          <li><i class="pbmit-base-icon-contact"></i>keralahealth@xxxx.com</li>
                      </ul>
                  </div>
                  <div class="pbmit-pre-header-right">
                      <ul class="pbmit-social-links">
                          <li>
                              <img class="pbmit-sticky-logo" src="{{asset('assets/frontend/images/langmal.svg')}}" alt="keralahealth">

                              @if(isset($sessionbil) && $sessionbil == 2)
                              <button type="button" data-mdb-button-init data-mdb-ripple-init id="languageButton1" class="btn text-white  languageButton" data-mdb-ripple-color="dark" value="1">English</button>
                              @else
                              <button type="button" data-mdb-button-init data-mdb-ripple-init id="languageButton2" class="btn text-white languageButton" data-mdb-ripple-color="dark" value="2">Malayalam</button>
                              @endif
                          </li>
                          <li class="pbmit-social-li pbmit-social-facebook">
                              <a title="Facebook" href="#" target="_blank">
                                  <span><i class="pbmit-base-icon-facebook-f"></i></span>
                              </a>
                          </li>
                          <li class="pbmit-social-li pbmit-social-twitter">
                              <a title="Twitter" href="#" target="_blank">
                                  <span><i class="pbmit-base-icon-twitter-2"></i></span>
                              </a>
                          </li>
                          <li class="pbmit-social-li pbmit-social-linkedin">
                              <a title="LinkedIn" href="#" target="_blank">
                                  <span><i class="pbmit-base-icon-linkedin-in"></i></span>
                              </a>
                          </li>
                          <li class="pbmit-social-li pbmit-social-instagram">
                              <a title="Instagram" href="#" target="_blank">
                                  <span><i class="pbmit-base-icon-instagram"></i></span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <div class="container-fluid headex">
          <div class="pbmit-header-content d-flex justify-content-between align-items-center">
              <div class="pbmit-logo-menuarea d-flex align-items-center">
                  <div class="site-branding">
                      <h1 class="site-title">
                          <a href="{{ route('main.index') }}">
                              <img class="pbmit-sticky-logo" src="{{asset('assets/frontend/images/log-n.png')}}" alt="Kerala health">
                          </a>
                      </h1>
                  </div>
              </div>
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

              <!-- <div class="pbmit-right-box d-flex align-items-center">

                  <div class="pbmit-header-search-btn">
                      <a href="#" title="Search">
                          <i class="pbmit-base-icon-search-1"></i>
                      </a>
                  </div>
                 <div class="pbmit-button-box-second">
                      <a class="pbmit-btn" href="{{ route('loginview')}}">
                          <span class="pbmit-button-content-wrapper">
                              <span class="pbmit-button-icon pbmit-align-icon-right">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="22.76" height="22.76" viewBox="0 0 22.76 22.76">
                                      <title>black-arrow</title>
                                      <path d="M22.34,1A14.67,14.67,0,0,1,12,5.3,14.6,14.6,0,0,1,6.08,4.06,14.68,14.68,0,0,1,1.59,1" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                      <path d="M22.34,1a14.67,14.67,0,0,0,0,20.75" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                      <path d="M22.34,1,1,22.34" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                  </svg>
                              </span>
                              <span class="pbmit-button-text">{{ App\Http\Controllers\FrontendController::getSiteControlLabel('login') ?? 'Login' }} </span>
                          </span>
                      </a>
                  </div> 
              </div> -->
          </div>
      </div>
      <!-- <div class="pbmit-slider-social">
              <a title="Facebook" href="#" target="_blank">
             <span><i class="pbmit-base-icon-facebook-f"></i></span>
          </a>
              <a title="Twitter" href="#" target="_blank">
             <span><i class="pbmit-base-icon-twitter-2"></i></span>
          </a>
              <a title="LinkedIn" href="#" target="_blank">
             <span><i class="pbmit-base-icon-linkedin-in"></i></span>
          </a>
              <a title="Instagram" href="#" target="_blank">
             <span><i class="pbmit-base-icon-instagram"></i></span>
          </a>
          </div> -->


  </header>