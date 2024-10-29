
@extends('layouts.auth')
@php
    use App\Models\Utility;
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $settings = Utility::settings();
    // dd($lang);
    if(empty($lang))
    {
        $lang = Utility::getValByName('default_language');

    }
@endphp
@push('custom-scripts')
    @if(env('RECAPTCHA_MODULE') == 'yes')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endpush
@section('page-title')
    {{__('Login')}}
@endsection

@section('language-bar')
    <li class="nav-item bth-primary">
        <select name="language" id="language" class="btn btn-primary mr-2 my-2 me-2" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            @foreach( Utility::languages() as $language)
                <option @if($lang == $language) selected @endif value="{{ route('verification.notice',$language) }}">{{Str::upper($language)}}</option>
            @endforeach
        </select>
    </li>
@endsection

@section('content')
<div class="card">
    <div class="row align-items-center">
    <div class="col-xl-3">
        <div class="">
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 text-primary">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif
            <div class="text-sm text-gray-600">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>
            <div class="mt-4 flex items-center justify-between">
                <div class="row">
                    <div class="col-auto">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">     {{ __('Resend Verification Email') }}
                            </button>
                        </form>
                    </div>
                    <div class="col-auto">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        <button type="submit" class="btn btn-danger btn-sm">    {{ __('Logout') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 img-card-side">
        <div class="auth-img-content">
            <img src="{{ asset('assets/images/auth/img-auth-3.svg') }}" alt="" class="img-fluid">
            <h3 class="text-white mb-4 mt-5">“Attention is the new currency”</h3>
            <p class="text-white">The more effortless the writing looks, the more effort the writer
                actually put into the process.</p>
        </div>
    </div>
    </div>

</div>
@endsection
