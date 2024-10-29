<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    @yield('meta-data')

    <title>@yield('page-title')</title>
    <!-- Primary Meta Tags -->
    @if(!empty($course))
        <meta name="title" content="{{(!empty($course->meta_keywords)?$course->meta_keywords:'')}}">
        <meta name="description" content="{{(!empty($course->meta_description)?$course->meta_description:'')}}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{env('APP_URL')}}">
        <meta property="og:title" content="{{(!empty($course->meta_keywords)?$course->meta_keywords:'')}}">
        <meta property="og:description" content="{{(!empty($course->meta_description)?$course->meta_description:'')}}">
        @if(!empty($course->meta_image))
        <meta property="og:image" content="{{\App\Models\Utility::get_file('uploads/meta_image/'.$course->meta_image)}}">
        @endif
        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{env('APP_URL')}}">
        <meta property="twitter:title" content="{{(!empty($course->meta_keywords)?$course->meta_keywords:'')}}">
        <meta property="twitter:description" content="{{(!empty($course->meta_description)?$course->meta_description:'')}}">
        @if(!empty($course->meta_image))
            <meta property="twitter:image" content="{{\App\Models\Utility::get_file('uploads/meta_image/'.$course->meta_image)}}">
        @else
            <meta property="twitter:image" content="{{asset('assets/themes/theme4/images/product-3.jpg')}}">
        @endif
    @endif


    <!-- Preloader -->
    <style>

    </style>
    @if(env('SITE_RTL')=='on')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}">
    @endif
    @stack('css-page')
<!-- Favicon -->
    <link rel="icon" href="{{\App\Models\Utility::get_file('uploads/logo/').(!empty($settings->value)?$settings->value:'favicon.png')}}" type="image/png">
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset('libs/@fancyapps/fancybox/dist/jquery.fancybox.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('libs/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <!-- Quick CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="{{asset('libs/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('libs/animate.css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('libs/swiper/dist/css/swiper.min.css')}}">
    <!-- site CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.3.3.5.css')}}">


    {{-- <link rel="shortcut icon" href="assets/images/favicon.png"> --}}
    @if(!empty($store->store_theme))
        <link rel="stylesheet" href="{{asset('assets/themes/theme4/css/'.$store->store_theme)}}" id="stylesheet">
    @else
        <link rel="stylesheet" href="{{asset('assets/themes/theme4/css/green-blue-style.css')}}" id="stylesheet">
    @endif
    <link rel="stylesheet" href="{{ asset('assets/themes/theme4/css/responsive.css') }}">

    <!-- WISHLIST -->
    {{-- <script>
        $(document).on('click', '.add_to_wishlist', function (e) {
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
                success: function (response) {
                    if (response.status == "Success") {
                        show_toastr('Success', response.success, 'success');
                        if (id_2 == null) {
                            $('.fygyfg_' + id).children().attr('src', '{{asset('assets/img/wishlist.svg')}}');
                        } else {
                            $('.fygyfg_' + id_2).children().attr('src', '{{asset('assets/img/wishlist.svg')}}');
                        }
                        console.log(response.item_count);
                        $('.wishlist_item_count').html(response.item_count);
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function (result) {
                }
            });
        });
    </script> --}}
</head>
