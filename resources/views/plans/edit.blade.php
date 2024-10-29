{{Form::model($plan, array('route' => array('plans.update', $plan->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
@csrf
@method('put')
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{Form::label('name',__('Name'),array('class'=>'form-label')) }}
            {!! Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'))) !!}
        </div>
    </div>
    @if($plan->price>0)
        <div class="col-md-6">

            <div class="form-group">
                <div class="col-12">
                    {{Form::label('price',__('Price'),array('class'=>'form-label')) }}
                    <div class="input-group">
                        <div class="input-group-text">{{env('CURRENCY_SYMBOL')}}</div>
                        {!! Form::number('price',null,array('class'=>'form-control', 'id'=>'monthly_price','min'=>'0','placeholder'=>__('Enter Price'))) !!}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="form-group col-md-6">
        {{ Form::label('duration', __('Duration')) }}
        {!! Form::select('duration', $arrDuration, null,array('class' => 'form-select','required'=>'required')) !!}
    </div>


    <div class="col-6">
        <div class="form-group">
            {{Form::label('max_stores',__('Maximum stores'),array('class'=>'form-label')) }}
            {!! Form::text('max_stores',null,array('class'=>'form-control','id'=>'max_stores','placeholder'=>__('Enter Max Stores'))) !!}
            <span><small>{{__("Note: '-1' for lifetime")}}</small></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('max_courses',__('Maximum Course Per Store'),array('class'=>'form-label')) }}
            {!! Form::text('max_courses',null,array('class'=>'form-control','id'=>'max_courses','placeholder'=>__('Enter Course Per Store'))) !!}
            <span><small>{{__("Note: '-1' for lifetime")}}</small></span>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            {{Form::label('max_users',__('Maximum Users'),array('class'=>'form-label')) }}
            {!! Form::text('max_users',null,array('class'=>'form-control','id'=>'max_users','placeholder'=>__('Enter Max Users'))) !!}
            <span><small>{{__("Note: '-1' for lifetime")}}</small></span>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-check form-check form-switch custom-control-inline pt-2">
                <input type="checkbox" class="form-check-input" role="switch" name="enable_custdomain" id="enable_custdomain" {{ ($plan['enable_custdomain'] == 'on') ? 'checked=checked' : '' }}>
                <label class="form-check-label" for="enable_custdomain">{{__('Enable Domain')}}</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-check form-check form-switch custom-control-inline pt-2">
                <input type="checkbox" class="form-check-input" role="switch" name="enable_custsubdomain" id="enable_custsubdomain" {{ ($plan['enable_custsubdomain'] == 'on') ? 'checked=checked' : '' }}>
                <label class="form-check-label" for="enable_custsubdomain">{{__('Enable Sub Domain')}}</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-check form-check form-switch custom-control-inline pt-2">
                <input type="checkbox" class="form-check-input" role="switch" name="additional_page" id="additional_page" {{ ($plan['additional_page'] == 'on') ? 'checked=checked' : '' }}>
                <label class="form-check-label" for="additional_page">{{__('Enable Additional Page')}}</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-check form-check form-switch custom-control-inline pt-2">
                <input type="checkbox" class="form-check-input" role="switch" name="blog" id="blog" {{ ($plan['blog'] == 'on') ? 'checked=checked' : '' }}>
                <label class="form-check-label" for="blog">{{__('Enable Blog')}}</label>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            {{Form::label('description',__('Description'),array('class'=>'form-label')) }}
            {!! Form::textarea('description',null,array('class'=>'form-control','id'=>'description','rows'=>3,'placeholder'=>__('Enter Description'))) !!}
        </div>
    </div>
</div>
<div class="form-group text-end">
    <button class="btn btn-primary" type="submit">{{ __('Update Plan') }}</button>
</div>
</form>
