@php
    $setting = App\Models\Utility::settings();
    $userstore = \App\Models\UserStore::where('store_id', $store->id)->first();
    $settings   =\DB::table('settings')->where('name','company_favicon')->where('created_by', $userstore->user_id)->first();
    @endphp
<!DOCTYPE html>
<html lang="en" dir="{{$setting['SITE_RTL'] == 'on'?'rtl':''}}">
    @include('layouts.theme1.shophead')
    @php
        if(!empty(session()->get('lang')))
        {
            $currantLang = session()->get('lang');
        }else{
            $currantLang = $store->lang;
        }
        $languages= Utility::languages();
    @endphp
<body class="loaded">
    @include('layouts.theme1.shopheader')
    <div class="wrapper">
        @yield('content')
    </div>

    <!-- section_enable -->
    @if(!empty($getStoreThemeSetting[6]) && $getStoreThemeSetting[6]['section_enable'] == 'on')
        <footer class="site-footer">
            <div class="container {{($demoStoreThemeSetting['enable_footer_note'] != 'on')?'pt-1':'' }}">
                <div class="footer-row">
                    @if($demoStoreThemeSetting['enable_footer_note'] == 'on')
                        <div class="footer-logo footer-col">
                            <a href="{{route('store.slug',$store->slug)}}">
                                @if(!empty($getStoreThemeSetting[6]['inner-list'][0]['field_default_text']))
                                    <img src="{{asset(Storage::url('uploads/'.$getStoreThemeSetting[6]['inner-list'][0]['field_default_text']))}}" alt="lmsgo-logo">
                                @else
                                    <img src="{{asset(Storage::url('uploads/theme1/footer/lmsgo-logo.svg'))}}" alt="Footer logo">
                                @endif
                            </a>
                        </div>
                        <div class="footer-col footer-link footer-link-1">
                            <div class="footer-widget">
                                <ul>
                                    @for ($i = 0 ;  $i < $getStoreThemeSetting[7]['loop_number'] ; $i++)

                                        @foreach ($getStoreThemeSetting[7]['inner-list'] as $item_key => $item)
                                            @php
                                                if ($item_key == 0) {
                                                    if(!empty($getStoreThemeSetting[7][$item['field_slug']])) {
                                                        $b['name'] = $getStoreThemeSetting[7][$item['field_slug']][$i];
                                                    } else {
                                                        $b['name'] = $item['field_default_text'];
                                                    }
                                                }

                                                if ($item_key == 1) {
                                                    if(!empty($getStoreThemeSetting[7][$item['field_slug']])) {
                                                        $b['link'] = $getStoreThemeSetting[7][$item['field_slug']][$i];
                                                    } else {
                                                        $b['link'] = $item['field_default_text'];
                                                    }
                                                }
                                            @endphp
                                        @endforeach
                                        <li>
                                            <a href="{{$b['link']}}">{{ucfirst($b['name'])}}</a>
                                        </li>

                                    @endfor
                                </ul>
                            </div>
                        </div>
                        <div class="footer-col footer-link footer-link-2 delimiter-top mt-2">
                            <div class="footer-widget">
                                <ul class="share-links">
                                    @for ($i = 0 ;  $i < $getStoreThemeSetting[8]['loop_number'] ; $i++)
                                        @php
                                            $icon = '';
                                            $link = '#';
                                        @endphp
                                        @foreach ($getStoreThemeSetting[8]['inner-list'] as $item_key => $item)
                                            @php
                                                if ($item_key == 0) {
                                                    if(!empty($getStoreThemeSetting[8][$item['field_slug']])) {
                                                        $icon = $getStoreThemeSetting[8][$item['field_slug']][$i];
                                                    } else {
                                                        $icon = $item['field_default_text'];
                                                    }
                                                }

                                                if ($item_key == 1) {
                                                    if(!empty($getStoreThemeSetting[8][$item['field_slug']])) {
                                                        $link = $getStoreThemeSetting[8][$item['field_slug']][$i];
                                                    } else {
                                                        $link = $item['field_default_text'];
                                                    }
                                                }
                                            @endphp
                                        @endforeach
                                        <li>
                                            <a href="{{ $link }}" target="_blank">
                                                {!! $icon !!}
                                            </a>
                                        </li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="footer-bottom">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            {{-- <p>© 2022 My Store. All rights reserved</p> --}}
                            {{-- <p>{{$demoStoreThemeSetting['footer_note']}}</p> --}}
                            <p>{{$store->footer_note}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    @endif

    <!-- Mobile menu start -->
    <div class="mobile-menu-wrapper">
        <div class="menu-close-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                    d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
            </svg>
        </div>
        <div class="mobile-menu-bar">
            <ul>
                <li class="menu-lnk">
                    <a href="{{route('store.slug',$store->slug)}}">{{ __('Home') }}</a>
                </li>
                @if($page_slug_urls->count()>0)
                    @foreach($page_slug_urls as $k=>$page_slug_url)
                        <li class="menu-lnk">
                            @if($page_slug_url->enable_page_header == 'on')
                                <a href="{{env('APP_URL') . '/page/' . $store->slug.'/'.$page_slug_url->slug}}">{{ucfirst($page_slug_url->name)}}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
                @if($store->blog_enable == 'on' && $blog->count()>0)
                    <li class="menu-lnk">
                        <a href="{{route('store.blog',$store->slug)}}">{{ __('Blog') }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <!-- Mobile menu end -->


    <!-- Model Popup Start -->
    <div class="modal fade edit-profile" id="commonModalBlur" role="dialog" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h3 class="modal-title profile-heading" id="modelCommanModelLabel"></h3>
                    <button type="button" class="close" data-dismiss="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
                        <path d="M27.7618 25.0008L49.4275 3.33503C50.1903 2.57224 50.1903 1.33552 49.4275 0.572826C48.6647 -0.189868 47.428 -0.189965 46.6653 0.572826L24.9995 22.2386L3.33381 0.572826C2.57102 -0.189965 1.3343 -0.189965 0.571605 0.572826C-0.191089 1.33562 -0.191186 2.57233 0.571605 3.33503L22.2373 25.0007L0.571605 46.6665C-0.191186 47.4293 -0.191186 48.666 0.571605 49.4287C0.952952 49.81 1.45285 50.0007 1.95275 50.0007C2.45266 50.0007 2.95246 49.81 3.3339 49.4287L24.9995 27.763L46.6652 49.4287C47.0465 49.81 47.5464 50.0007 48.0463 50.0007C48.5462 50.0007 49.046 49.81 49.4275 49.4287C50.1903 48.6659 50.1903 47.4292 49.4275 46.6665L27.7618 25.0008Z" fill="white">
                        </path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- Model Popup End -->

    {!! $demoStoreThemeSetting['storejs'] !!}
    <!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
    <script> app_url = "{{asset('assets/img/')}}" </script>

    <script src="{{ asset('libs/frontjs/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('libs/frontjs/bootstrap/bootstrap.min.js')}}"></script>

    <script src="{{asset('js/slick.min.js')}}" defer="defer"></script>
    <script src="{{ asset('libs/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('js/lmscustom.js')}}"></script>


    <!-- WISHLIST -->
    <script>
        $(document).on('click', '.add_to_wishlist', function (e) {
            // alert('hey');
            e.preventDefault();
            var id = $(this).attr('data-id');
            var id_2 = $(this).attr('data-id-2');
            var _url;
            if (id_2 == null) {
                _url = '{{route('student.addToWishlist',[$store->slug, '__course_id'])}}'.replace('__course_id', id);
            } else {
                _url = '{{route('student.addToWishlist', [$store->slug,'__course_id'])}}'.replace('__course_id', id_2);
            }
            $.ajax({
                type: "POST",
                url: _url,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                context: this,
                success: function (response) {
                    if (response.status == "Success") {
                        show_toastr('Success', response.success, 'success');
                        if (id_2 == null) {
                            $('.fygyfg_' + id).children().attr('src', '{{asset('assets/img/wishlist.svg')}}');
                        } else {
                            $('.fygyfg_' + id_2).children().attr('src', '{{asset('assets/img/wishlist.svg')}}');
                        }
                        // console.log(response.item_count);
                        $('.wishlist_item_count').html(response.item_count);
                        $(this).toggleClass("wishlist_btn");

                    } else {
                        show_toastr('Error', response.error, 'error');
                    }

                },
                error: function (result) {
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '#search_icon', function () {

                //FETCH AND SEARCH
                function fetch_course_data(query = '') {
                    $.ajax({
                        url: "{{ route('store.searchData',[$store->slug,'__query']) }}".replace('__query', query),
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#search_data_div').html(data.table_data);
                            $('#total_records').text(data.total_data);
                        }
                    })
                }
                $(document).on('keyup', '#search_box', function () {
                    var query = $(this).val();
                    /*console.log(query);
                    return false;*/
                    if (query != '') {
                        fetch_course_data(query);
                    } else {
                        $('#search_data_div').html('');
                    }

                });
            });
        });
    </script>
    @php
        $store_settings = \App\Models\Store::where('slug',$store->slug)->first();
    @endphp
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$store_settings->google_analytic}}"></script>

    {!! $store_settings->storejs !!}

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', '{{ $store_settings->google_analytic }}');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{$store_settings->fbpixel_code}}');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=0000&ev=PageView&noscript={{$store_settings->fbpixel_code}}"
    /></noscript>


    @stack('script-page')
    @if($message = Session::get('success'))
        <script>
            show_toastr('{{__('Success')}}', '{{ __($message) }}', 'success');
        </script>
    @endif
    @if($message = Session::get('error'))
        <script>
            show_toastr('{{__('Error')}}', '{{ __($message) }}', 'error');
        </script>
    @endif
    @if (App\Models\Utility::getValByName('enable_cookie') == 'on' && App\Models\Utility::getValByName('cookie_logging') == 'on')
        @include('layouts.cookie_consent')
    @endif
</body>
</html>
