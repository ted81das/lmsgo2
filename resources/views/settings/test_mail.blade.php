{{-- {{ Form::open(array('route' => array('test.send.mail'))) }}
    <div class="row">

        <div class="form-group col-md-12">
            {{ Form::label('email', __('Email')) }}
            {{ Form::text('email', '', array('class' => 'form-control','required'=>'required')) }}
            @error('email')
            <span class="invalid-email" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="modal-footer text-end">
        <input type="button" value="{{__('Cancel')}}" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
        {{Form::submit(__('Send'),array('class'=>'btn btn-primary'))}}
    </div>
{{ Form::close() }} --}}

<form class="pl-3 pr-3" method="post" action="{{ route('test.send.mail') }}" id="test_email">
    @csrf
    <div class="form-group">
        <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Please enter Email Address') }}" required/>
    </div>
    <div class="form-group">
        <input type="hidden" name="mail_driver" value="{{$data['mail_driver']}}" />
        <input type="hidden" name="mail_host" value="{{$data['mail_host']}}" />
        <input type="hidden" name="mail_port" value="{{$data['mail_port']}}" />
        <input type="hidden" name="mail_username" value="{{$data['mail_username']}}" />
        <input type="hidden" name="mail_password" value="{{$data['mail_password']}}" />
        <input type="hidden" name="mail_encryption" value="{{$data['mail_encryption']}}" />
        <input type="hidden" name="mail_from_address" value="{{$data['mail_from_address']}}" />
        <input type="hidden" name="mail_from_name" value="{{$data['mail_from_name']}}" />
        <div class="modal-footer text-end">
            <button class="btn btn-primary" type="submit">{{ __('Send Test Mail') }}</button>
        </div>
        <label id="email_sending" class="float-left" style="display: none;"><i class="ti ti-clock"></i> {{ __('Sending ...') }} </label>
    </div>
</form>
