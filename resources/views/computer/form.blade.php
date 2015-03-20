<div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
    <div class="col-md-3">
        {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    </div>
    <div class="col-md-9">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'My Computer']) !!}
    </div>
</div>

<div class="form-group {{ ($errors->has('mac')) ? 'has-error' : '' }}">
    <div class="col-md-3">
        {!! Form::label('mac', 'MAC Address', ['class' => 'control-label']) !!}
    </div>
    <div class="col-md-9">
        {!! Form::text('mac', null, ['class' => 'form-control', 'placeholder' => '00:80:41:AE:FD:7E']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {!! Form::label('method', 'WOL Method', ['class' => 'control-label']) !!}
    </div>
    <div class="col-md-9">
        <div class="btn-group btn-group-justified" data-toggle="buttons">
            <label class="btn btn-primary">
                {!! Form::radio('use_broadcast', 1, true, ['data-method' => 'broadcast', 'autocomplete' => 'off']) !!} Broadcast *
            </label>
            <label class="btn btn-primary">
                {!! Form::radio('use_broadcast', 0, false, ['data-method' => 'direct', 'autocomplete' => 'off']) !!} Direct
            </label>
        </div>
    </div>
</div>

<div class="method__container hidden" id="method__container--broadcast">
    <div class="form-group {{ ($errors->has('broadcast')) ? 'has-error' : '' }}">
        <div class="col-md-3">
            {!! Form::label('broadcast', 'Broadcast Address', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9">
            {!! Form::text('broadcast', null, ['class' => 'form-control', 'placeholder' => '192.168.1.255']) !!}
        </div>
    </div>
</div>

<div class="method__container hidden" id="method__container--direct">
    <div class="form-group {{ ($errors->has('ip')) ? 'has-error' : '' }}">
        <div class="col-md-3">
            {!! Form::label('ip', 'IP Address', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9">
            {!! Form::text('ip', null, ['class' => 'form-control', 'placeholder' => '192.168.1.102']) !!}
        </div>
    </div>

    <div class="form-group {{ ($errors->has('subnet')) ? 'has-error' : '' }}">
        <div class="col-md-3">
            {!! Form::label('subnet', 'Subnet Address', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9">
            {!! Form::text('subnet', null, ['class' => 'form-control', 'placeholder' => '255.255.255.0']) !!}
        </div>
    </div>
</div>

<p class="help-block text-right">* recommended</p>

<div class="form-group">
    <div class="col-md-9 col-md-offset-3">
        <a class="btn btn-default btn-wide" href="{{ route('computer.index') }}">Cancel</a>
        {!! Form::submit('Save', ['class' => 'btn btn-primary btn-wide']) !!}
    </div>
</div>


{!! Form::close() !!}

@section('javascript')
<script>
    $(function() {

        $("input[name='use_broadcast']").change(function() {

            var method = $(this).data('method');

            var methodContainer = $("#method__container--" + method);

            $(".method__container").addClass('hidden');

            methodContainer.removeClass('hidden');
        });

        $("input[name='use_broadcast']:checked").click();
    });
</script>
@append