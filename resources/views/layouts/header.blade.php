<header class="header-style1 menu_area-light">
    <div class="navbar-default border-bottom border-color-light-white">
        <!--<div class="pq-top-header">-->
        <!--    <div class="container">-->
        <!--        <div class="row align-items-center">-->
        <!--            <div class="col-md-4 p-0">-->
        <!--                <div class="pq-header-contact">-->
        <!--                    <ul>-->
        <!--                        <li>-->
        <!--                            <a href="{{ 'tel:' . $user->contact_no1 ?? '#' }}">-->
        <!--                                <i class="fas fa-phone-alt"></i>-->
        <!--                                <span>{{ $user->contact_no1 ?? '' }}</span>-->
        <!--                            </a>-->
        <!--                        </li>-->
        <!--                        @if (!empty($user->contact_no2))-->
        <!--                            <li>-->
        <!--                                <a href="{{ 'tel:' . $user->contact_no2 ?? '#' }}">-->
        <!--                                    <i class="fas fa-phone-alt"></i>-->
        <!--                                    <span>{{ $user->contact_no2 }}</span>-->
        <!--                                </a>-->
        <!--                            </li>-->
        <!--                        @endif-->
        <!--                    </ul>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-md-4 p-0 ">-->
        <!--                <div class="pq-header-contact ">-->
        <!--                    <ul class="text-center">-->
        <!--                        <li>-->
        <!--                            <a href="mailto:{{ $user->email ?? 'info@example.com' }}">-->
        <!--                                <i class="fas fa-envelope"></i>-->
        <!--                                <span>{{ $user->email ?? 'info@example.com' }}</span>-->
        <!--                            </a>-->
        <!--                        </li>-->
        <!--                    </ul>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-md-4 p-0 text-right">-->
        <!--                <div id="google_translate_element"></div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-12">
                    <div class="menu_area alt-font">
                        <nav class="navbar navbar-expand-lg navbar-light p-0">
                            <div class="navbar-header navbar-header-custom">
                                <a href="{{ url('/') }}" class="navbar-brand">
                                    <img src="{{ $user->company_logo ? asset('storage/' . $user->company_logo) : asset('assets/img/logos/logo.png') }}" alt="MedTech">
                                </a>
                            </div>

                            <div class="navbar-toggler"></div>
                            <ul class="navbar-nav ms-auto" id="nav" style="display:none;">
                                <li><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ url('/about-us') }}">About Us</a>
                                </li>
                                <li><a href="#!">Category</a>
                                    <ul>
                                        @foreach ($menuCategories as $cat)
                                            <li>
                                                <a href="{{ url('/' . $cat->slug) }}">
                                                    {{ $cat->category_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ url('/certifications') }}">Certifications</a>
                                </li>
                                <li><a href="{{ $broucher && $broucher->broucher_pdf ? asset('storage/'. $broucher->broucher_pdf) : '#' }}" 
                                target="{{$broucher && $broucher->broucher_pdf ? '_blank' : '_self' }}">Brochure</a>
                                </li>
                                <li>
                                    <a href="{{ url('/exhibitions') }}">Exhibitions</a>
                                </li>
                                <li>
                                    <a href="{{ url('/blog') }}">Blog</a>
                                </li>
                                <li><a href="{{ url('/contact-us') }}">Contact</a></li>
                            </ul>
                            <div class="google-element6">
                                <div id="google_element"></div>
                            </div>
                            
                            <div class="attr-nav align-items-lg-center ms-lg-auto main-font">
                                <ul>
                                    <li class="search"><a href="#!"><i class="fas fa-search"></i></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-search">
            <div class="container">
                <form class="search-form" action="/search" method="GET" accept-charset="utf-8">
                    <div class="input-group align-items-center">
                        <input type="text" class="search-form_input form-control me-2" name="s" autocomplete="off"
                            placeholder="Search here...">
                        <span class="input-group-addon close-search"><i class="fas fa-times"></i></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>




<script>
  function loadGoogleTranslate() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: 'ar,zh-CN,nl,en,fr,de,hi,it,id,ja,ko,ms,fa,pt,pl,ru,es,th,tr,vi',
    }, 'google_element');
  }
</script>

<script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>






