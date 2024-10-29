@extends('storefront.theme4.user.user')
@section('page-title')
    {{__('My purchased Courses')}} - {{($store->tagline) ?  $store->tagline : config('APP_NAME', ucfirst($store->name))}}
@endsection
@push('css-page')
@endpush
@section('head-title')
    {{__('Welcome').', '.\Illuminate\Support\Facades\Auth::guard('students')->user()->name}}
@endsection
@section('content')
<div class="wrapper">
    <section class="common-banner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="common-banner-content">
                        <a href="{{route('store.slug',$store->slug)}}" class="back-btn">
                            <span class="svg-ic">
                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="5" viewBox="0 0 11 5" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5791 2.28954C10.5791 2.53299 10.3818 2.73035 10.1383 2.73035L1.52698 2.73048L2.5628 3.73673C2.73742 3.90636 2.74146 4.18544 2.57183 4.36005C2.40219 4.53467 2.12312 4.53871 1.9485 4.36908L0.133482 2.60587C0.0480403 2.52287 -0.000171489 2.40882 -0.000171488 2.2897C-0.000171486 2.17058 0.0480403 2.05653 0.133482 1.97353L1.9485 0.210321C2.12312 0.0406877 2.40219 0.044729 2.57183 0.219347C2.74146 0.393966 2.73742 0.673036 2.5628 0.842669L1.52702 1.84888L10.1383 1.84875C10.3817 1.84874 10.5791 2.04609 10.5791 2.28954Z" fill="white"></path>
                                </svg>
                            </span>
                            {{ __('Back to Home') }}
                        </a>
                        <div class="section-title">
                            <h2>{{ __('Courses you purchased') }}</h2>
                        </div>
                        <p>{{ __('Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="padding-top padding-bottom wishlist-section">
        <div class="container">
            <div class="row row-gap">
                @if(!empty($purchased_course) && count($purchased_course) > 0)
                    @foreach($purchased_course as $purchased_course)
                        @if(in_array($purchased_course->id,Auth::guard('students')->user()->purchasedCourse()))
                            <div class="col-lg-4 col-md-6 col-12 product-card">
                                <div class="product-card-inner">
                                    <div class="product-img">
                                        <a href="{{route('store.fullscreen',[$store->slug,Crypt::encrypt($purchased_course->id),''])}}" tabindex="0">
                                            @if(!empty($purchased_course->thumbnail))
                                                <img src="{{asset(Storage::url('uploads/thumbnail/'.$purchased_course->thumbnail))}}" alt="card" class="img-fluid">
                                            @else
                                                <img src="{{asset('assets/themes/theme4/images/product-3.jpg')}}" alt="card" class="img-fluid">
                                                {{-- <img src="{{ asset('assets/themes/theme4/images/product-1.jpg') }}" alt="card"> --}}
                                            @endif
                                        </a>

                                        <div class="subtitle-top d-flex align-items-center justify-content-between">
                                            <span class="badge">{{!empty($purchased_course->category_id)?$purchased_course->category_id->name:''}}</span>
                                            {{-- <span class="badge">{{ !empty($purchased_course->category_id) ? $purchased_course->sub_category : $purchased_course->category_id->name }}</span> --}}

                                            @if(Auth::guard('students')->check())
                                                @if(sizeof($purchased_course->student_wl)>0)
                                                    <a href="#" class="wishlist-btn wishlist_btn add_to_wishlist" data-id="{{$purchased_course->id}}" data-toggle="tooltip" data-placement="bottom" title="{{__('Already in Wishlist')}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z" fill="white"></path>
                                                        </svg>
                                                    </a>
                                                @else
                                                    <a href="#" class="wishlist-btn add_to_wishlist" data-id="{{$purchased_course->id}}" data-toggle="tooltip" data-placement="bottom" title="{{__('Add to Wishlist')}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z" fill="white"></path>
                                                        </svg>
                                                    </a>
                                                @endif
                                            @else
                                                <a href="#" class="wishlist-btnadd_to_wishlist" data-id="{{$purchased_course->id}}" data-toggle="tooltip" title="{{__('Add to Wishlist')}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z" fill="white"></path>
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    @php
                                        $cart = session()->get($slug);
                                        $key = false;
                                    @endphp
                                    @if(!empty($cart['products']))
                                        @foreach($cart['products'] as $k => $value)
                                            @if($purchased_course->id == $value['product_id'])
                                                @php
                                                    $key = $k
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endif

                                    <div class="product-content">
                                        <div class="product-content-top">
                                            <div class="review-rating">
                                                <span class="rating-num">{{$purchased_course->course_rating()}}</span>
                                                <div class="review-star d-flex align-items-center">
                                                    @if($store->enable_rating == 'on')
                                                        @for($i =1;$i<=5;$i++)
                                                            @php
                                                                $icon = 'fa-star';
                                                                $color = '';
                                                                $newVal1 = ($i-0.5);
                                                                // dd($purchased_course->course_rating() );

                                                                if($purchased_course->course_rating() < $i && $purchased_course->course_rating() >= $newVal1)
                                                                {
                                                                    $icon = 'fa-star-half-alt';
                                                                }
                                                                if($purchased_course->course_rating() >= $newVal1)
                                                                {
                                                                    $color = 'text-warning';
                                                                }
                                                            @endphp
                                                            <i class="fas {{$icon .' '. $color}}"></i>
                                                        @endfor
                                                    @endif

                                                </div>
                                                @php
                                                    $tutor_course_count = App\Models\Course::where('store_id', $store->id)->where('created_by', $purchased_course->created_by)->where('status', 'Active')->get();
                                                    $tutor_id           = $tutor_course_count->pluck('created_by')->first();
                                                    $tutor_count_rating = App\Models\Ratting::where('tutor_id', $tutor_id)->where('course_id',$purchased_course->id)->where('slug', $store->slug)->where('rating_view', 'on')->count();
                                                @endphp
                                                <span>({{ $tutor_count_rating }})</span>
                                            </div>
                                            @php
                                                $tutor_course_count = App\Models\Course::where('store_id',$store->id)->where('created_by',$purchased_course->created_by)->where('status','Active')->get();
                                                $tutor_id    = $tutor_course_count->pluck('created_by')->first();
                                                $tutor_count_rating = App\Models\Ratting::where('tutor_id',$tutor_id)->where('course_id',$purchased_course->created_by)->where('slug',$store->slug)->where('rating_view','on')->count();
                                            @endphp
                                            <h4>
                                                <a href="{{route('store.fullscreen',[$store->slug,Crypt::encrypt($purchased_course->id),''])}}" tabindex="0">{{$purchased_course->title}}</a>
                                            </h4>
                                            @if($purchased_course->course_description)
                                                <div class="description">{!! $purchased_course->course_description !!}</div>
                                            @else
                                                <p>{{__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.')}}</p>
                                            @endif
                                            <span></span>
                                        </div>
                                        <div class="product-content-bottom">
                                            <div class="course-detail">
                                                <p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                        <g clip-path="url(#clip0_19_26)">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.89035 0.981725C3.17939 0.981725 0.981725 3.17939 0.981725 5.89035C0.981725 7.16364 1.46654 8.3237 2.26163 9.196C2.67034 8.3076 3.38394 7.61471 4.24934 7.22454C3.75002 6.77528 3.43604 6.12405 3.43604 5.39949C3.43604 4.04401 4.53487 2.94518 5.89035 2.94518C7.24583 2.94518 8.34466 4.04401 8.34466 5.39949C8.34466 6.11254 8.04058 6.75457 7.55502 7.20298C8.43552 7.56901 9.18412 8.23342 9.54281 9.16977C10.3238 8.30051 10.799 7.15092 10.799 5.89035C10.799 3.17939 8.60131 0.981725 5.89035 0.981725ZM9.69387 10.3882C10.9703 9.30774 11.7807 7.69368 11.7807 5.89035C11.7807 2.6372 9.1435 0 5.89035 0C2.6372 0 0 2.6372 0 5.89035C0 7.69366 0.810351 9.30769 2.08677 10.3882C2.12022 10.426 2.15982 10.459 2.20478 10.4855C3.21384 11.2959 4.49547 11.7807 5.89035 11.7807C7.28519 11.7807 8.5668 11.2959 9.57584 10.4856C9.62075 10.4591 9.66038 10.4261 9.69387 10.3882ZM8.74856 9.88145L8.66025 9.61652C8.29993 8.53556 7.14229 7.8538 5.89035 7.8538C4.6233 7.8538 3.49161 8.64647 3.0586 9.83723L3.04038 9.88735C3.84386 10.4613 4.82767 10.799 5.89035 10.799C6.95667 10.799 7.94357 10.459 8.74856 9.88145ZM5.89035 6.87208C6.70364 6.87208 7.36294 6.21278 7.36294 5.39949C7.36294 4.5862 6.70364 3.9269 5.89035 3.9269C5.07706 3.9269 4.41776 4.5862 4.41776 5.39949C4.41776 6.21278 5.07706 6.87208 5.89035 6.87208Z" fill="#8A94A6"></path>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="">
                                                                <rect width="11.7807" height="11.7807" fill="white">
                                                                </rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg> {{$purchased_course->student_count->count()}} &nbsp; <span>{{__('Students')}}</span>
                                                </p>
                                                <p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                        <g clip-path="url(#clip0_19_28)">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.45116 0.161627C5.72754 0.0234357 6.05285 0.0234355 6.32924 0.161627L11.122 2.558C11.8456 2.91979 11.8456 3.95237 11.122 4.31416L10.4238 4.66324L11.122 5.01231C11.8456 5.3741 11.8456 6.40669 11.122 6.76848L10.4238 7.11755L11.122 7.46663C11.8456 7.82842 11.8456 8.861 11.122 9.22279L6.32924 11.6192C6.05286 11.7574 5.72754 11.7574 5.45116 11.6192L0.658407 9.22279C-0.0651723 8.861 -0.0651715 7.82842 0.658406 7.46663L1.35656 7.11755L0.658407 6.76848C-0.0651723 6.40669 -0.0651715 5.3741 0.658406 5.01231L1.35656 4.66324L0.658407 4.31416C-0.0651731 3.95237 -0.0651713 2.91979 0.658407 2.558L5.45116 0.161627ZM2.67882 4.22677C2.67563 4.22513 2.67243 4.22353 2.66921 4.22197L1.09745 3.43608L5.8902 1.03971L10.6829 3.43608L9.1111 4.22201C9.10793 4.22355 9.10479 4.22512 9.10166 4.22673L5.8902 5.83246L2.67882 4.22677ZM2.45416 5.21204L1.09745 5.8904L2.66915 6.67625L2.67888 6.68111L5.8902 8.28677L9.10163 6.68105L9.11112 6.67631L10.6829 5.8904L9.32623 5.21204L6.32924 6.71054C6.05286 6.84873 5.72754 6.84873 5.45116 6.71054L2.45416 5.21204ZM1.09745 8.34471L2.45416 7.66635L5.45116 9.16485C5.72754 9.30304 6.05286 9.30304 6.32924 9.16485L9.32623 7.66635L10.6829 8.34471L5.8902 10.7411L1.09745 8.34471Z" fill="#8A94A6"></path>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="">
                                                                <rect width="11.7807" height="11.7807" fill="white">
                                                                </rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg> {{$purchased_course->chapter_count->count()}} &nbsp; <span>{{__('Chapters')}}
                                                </p>
                                                <p>{{$purchased_course->level}}</p>
                                            </div>
                                            @if(Auth::guard('students')->check())
                                                @if(in_array($purchased_course->id,Auth::guard('students')->user()->purchasedCourse()))
                                                    <a href="{{route('store.fullscreen',[$store->slug,Crypt::encrypt($purchased_course->id),''])}}" class="btn cart-btn">{{ __('Get Started') }}<svg viewBox="0 0 10 5">
                                                        <path d="M2.37755e-08 2.57132C-3.38931e-06 2.7911 0.178166 2.96928 0.397953 2.96928L8.17233 2.9694L7.23718 3.87785C7.07954 4.031 7.07589 4.28295 7.22903 4.44059C7.38218 4.59824 7.63413 4.60189 7.79177 4.44874L9.43039 2.85691C9.50753 2.78197 9.55105 2.679 9.55105 2.57146C9.55105 2.46392 9.50753 2.36095 9.43039 2.28602L7.79177 0.69418C7.63413 0.541034 7.38218 0.544682 7.22903 0.702329C7.07589 0.859976 7.07954 1.11192 7.23718 1.26507L8.1723 2.17349L0.397965 2.17336C0.178179 2.17336 3.46059e-06 2.35153 2.37755e-08 2.57132Z">
                                                        </path>
                                                    </svg></a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
@push('script-page')
@endpush
