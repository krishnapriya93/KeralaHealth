<footer class="site-footer">
        <div class="pbmit-footer-widget-area">
            <div class="container">
                <div class="row">
                    <div class="pbmit-footer-widget-col-1 col-md-6 col-lg-3">
                        <aside class="widget widget_text">
                            <div class="textwidget">
                                <div class="pbmit-footer-logo">
                                    <img src="{{asset('assets/frontend/images/log-n.png')}}" alt="">
                                </div>
                                <div class="pbmit-footer-text">
                                {{ $mainfootercontactus->contact_sub[0]->title }}<br>
                                {{ strip_tags($mainfootercontactus->contact_sub[0]->address) }}<br>
                                {{ strip_tags($mainfootercontactus->contactphone) }}<br>
                                {{ strip_tags($mainfootercontactus->contactemail) }}<br>
                                </div>
                                <ul class="pbmit-social-links">
                                    <li class="pbmit-social-li pbmit-social-facebook">
                                        <a title="Facebook" href="https://www.facebook.com/" target="_blank" rel="noopener">
                                            <span><i class="pbmit-base-icon-facebook-f"></i></span>
                                        </a>
                                    </li>
                                    <li class="pbmit-social-li pbmit-social-twitter">
                                        <a title="Twitter" href="https://www.twitter.com/" target="_blank" rel="noopener">
                                            <span><i class="pbmit-base-icon-twitter-2"></i></span>
                                        </a>
                                    </li>
                                    <li class="pbmit-social-li pbmit-social-linkedin">
                                        <a title="LinkedIn" href="https://www.linkedin.com/" target="_blank" rel="noopener">
                                            <span><i class="pbmit-base-icon-linkedin-in"></i></span>
                                        </a>
                                    </li>
                                    <li class="pbmit-social-li pbmit-social-instagram">
                                        <a title="Instagram" href="https://www.instagram.com/" target="_blank" rel="noopener">
                                            <span><i class="pbmit-base-icon-instagram"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                   
                    <div class="pbmit-footer-widget-col-2 col-md-6 col-lg-3">
                        <div class="widget">
                            <h2 class="widget-title">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('usefullink') ?? 'Useful Link' }}</h2>
                            <div class="textwidget">
                                <ul>
                                @foreach($Usefullinks as $Usefullink)
                                    @foreach($Usefullink->link_sub as $link_sub)
                                        <li><a href="#">{{$link_sub->title}}</a></li>
                                    @endforeach
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pbmit-footer-widget-col-3 col-md-6 col-lg-3">
                        <div class="widget">
                            <h2 class="widget-title">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('importantlinks') ?? 'Important Links' }}</h2>
                            <div class="pbmit-timelist-wrapper">
                                <ul class="pbmit-timelist-list">
                                    <li><a href="#" class="pbmit-timelist-li-title">Services 1</a></li>
                                    <li><a href="#" class="pbmit-timelist-li-title">Services 1</a></li>
                                    <li><a href="#" class="pbmit-timelist-li-title">Services 1</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pbmit-footer-widget-col-4 col-md-6 col-lg-3">
                        <aside class="widget">
                            <h2 class="widget-title">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('contact') ?? 'Contact' }}</h2>
                            <div class="pbmit-contact-widget-line pbmit-contact-widget-address">
                                Phone: &nbsp;<b>0471 025461</b>
                            </div>
                            <div class="pbmit-contact-widget-line pbmit-contact-widget-address">
                                Address:&nbsp; Sample heath address <br> 2546 kerala
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <div class="pbmit-footer-text-area">
            <div class="container">
                <div class="pbmit-footer-text-inner">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pbmit-footer-copyright-text-area"> Copyright © 2024 <a href="#" style="  color: var(--pbmit-global-color);"><b>C-Dit</b></a> </div>
                        </div>
                        <div class="col-md-6">
                            <ul class="pbmit-footer-menu">
                                <li class="menu-item">
                                    <a href="#">Terms and conditions</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Privacy policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer End -->