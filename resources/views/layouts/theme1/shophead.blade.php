<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Lmsgo">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <meta property="twitter:image" content="{{asset('assets/img/card-img.svg')}}">
        @endif
    @endif


    <meta name="description" content="Lmsgo">
    <meta name="keywords" content="Lmsgo">
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <!-- Favicon -->
    <link rel="icon" href="{{\App\Models\Utility::get_file('uploads/logo/').(!empty($settings->value)?$settings->value:'favicon.png')}}" type="image/png">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('libs/@fortawesome/fontawesome-free/css/all.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('./css/main-style.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/moovie.css')}}">

    @if(!empty($store->store_theme))
        <link rel="stylesheet" href="{{asset('assets/css/'.$store->store_theme)}}" id="stylesheet">
    @else
        <link rel="stylesheet" href="{{asset('assets/css/yellow-style.css')}}" id="stylesheet">
    @endif
    <link rel="stylesheet" href="{{asset('./css/responsive.css')}}">

</head>



