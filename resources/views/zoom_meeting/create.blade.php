@php
    $settings = Utility::settings();
@endphp
{{ Form::open(['route' => 'zoom-meeting.store', 'id' => 'store-user', 'method' => 'post']) }}
<div class="row">
    <div class="form-group col-md-12">
        {{ Form::label('title', __('Topic'),['class'=>'form-label']) }}
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Meeting Title'), 'required' => 'required']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('courses', __('Courses'),['class'=>'form-label']) }}
        {{ Form::select('id', $courses, null, ['class' => 'form-control select2', 'id' => 'course_id']) }}
    </div>
    <div class="form-group col-md-6">
        <div>
            {{ Form::label('students', __('Student'),['class'=>'form-label']) }}
            <div id="students-div">
                {{Form::select('students[]',[], null, ['class' => 'form-select', 'id' => 'student_id']) }}
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('datetime', __('Start Date / Time'),['class'=>'form-label']) }}
        {{-- {{ Form::text('start_date', null, ['class' => 'form-control date ', 'placeholder' => __('Select Date/Time'), 'required' => 'required']) }} --}}
        {{ Form::text('start_date',null,['class' => 'form-control  date', 'placeholder' => __('Select Date/Time'), 'required' => 'required']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('duration', __('Duration'),['class'=>'form-label']) }}
        {{ Form::number('duration', null, ['class' => 'form-control', 'placeholder' => __('Enter Duration'), 'required' => 'required']) }}
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('password', __('Password ( Optional )'),['class'=>'form-label']) }}
        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Password')]) }}
    </div>
    {{-- @dd((isset($settings['google_calender_enabled']) && $settings['google_calender_enabled'] == 'on')); --}}
    @if (isset($settings['google_calender_enabled']) && $settings['google_calender_enabled'] == 'on')
        <div class="form-group col-md-6">
            {{Form::label('synchronize_type',__('Synchronize in Google Calendar ?'),array('class'=>'form-label')) }}
            <div class=" form-switch">
                <input type="checkbox" class="form-check-input mt-2" name="synchronize_type" id="switch-shadow" value="google_calender">
                <label class="form-check-label" for="switch-shadow"></label>
            </div>
        </div>
    @endif
</div>


<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn btn-primary" id="create-client">
</div>
{{ Form::close() }}

<script type="text/javascript">
    $(document).ready(function() {

        $('.date').daterangepicker({
            "singleDatePicker": true,
            "timePicker": true,
            "locale": {
                "format": 'MM/DD/YYYY H:mm'
            },
            "timePicker24Hour": true,
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format(
                'YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
        getStudents($('#course_id').val());
    });
</script>

