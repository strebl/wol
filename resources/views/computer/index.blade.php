@extends('layouts.master')

@section('content')

<div class="container">

	<h1>
        My Computers
        <a class="btn btn-primary" href="{{ route('computer.create') }}">
            <span class="fui-plus"></span>
            Add New Computer
        </a>
    </h1>

	<div class="row">
		@if(Session::has('message'))
		<div class="col-md-12">
			<div class="alert alert-info">{{ Session::get('message') }}</div>
		</div>
		@endif
	</div>

    @include('flash::message')

    @unless($computers->count())

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="tile">
                    <h2>Ohh no!</h2>
                    <p class="lead">You have not added any computers yet.</p>
                    <a class="btn btn-inverse" href="{{ route('computer.create') }}">
                        <span class="fui-plus"></span>
                        Add your first computer now!
                    </a>
                </div>
            </div>
        </div>

    @endunless

    @foreach($computers->chunk(3) as $row)

        <div class="row">

        @foreach($row as $computer)

            <div class="col-md-4 computer" data-computer-id="{{ $computer->id }}">
                <div class="tile">
                    <img src="/img/icons/imac.svg" alt="Computer" class="tile-image">
                    <h4>
                        {{ $computer->name }}
                        <span class="fa-stack status-icon-stack">
                            <span class="fa fa-circle-o-notch status-icon status-icon-waiting fa-spin fa-stack-1x status-pulsable-icon"></span>
                            <span class="fa fa-circle-o-notch status-icon status-icon-waiting fa-spin fa-stack-1x"></span>
                        </span>
                    </h4>
                    <div class="btn-group btn-group-justified computer-controls">
                        <a class="btn btn-default btn-xs" href="/computer/{{ $computer->id }}/edit">
                            <span class="fui-gear"></span> Edit
                        </a>
                        <a class="btn btn-default btn-xs computer-delete-button" data-computer-id="{{ $computer->id }}" href="#">
                            <span class="fui-trash"></span> Delete
                        </a>

                    </div>
                    <table class="table table-condensed text-left">
                        <tr>
                            <th>MAC</th>
                            <td class="text-right">{{ $computer->mac }}</td>
                        </tr>
                        <tr>
                            <th>Broadcast</th>
                            <td class="text-right">{{ $computer->broadcast }}</td>
                        </tr>
                        <tr>
                            <th>IP</th>
                            <td class="text-right">{{ $computer->ip }}</td>
                        </tr>
                        <tr>
                            <th>Subnet</th>
                            <td class="text-right">{{ $computer->subnet }}</td>
                        </tr>
                    </table>
                    <a class="btn btn-primary btn-hg btn-block" href="/computer/{{ $computer->id }}/boot">
                        <span class="fui-power"></span> Boot!
                    </a>
                </div>
            </div>

        @endforeach

        </div> <!-- row -->

    @endforeach

</div> <!-- container -->

@stop

@section('javascript')
<script>
    $('.computer-delete-button').click(function() {

        // Get the computer id
        var computerId = $(this).data('computer-id');

        // Declare the Form template
        var form = '{!! Form::open(['route' => ['computer.destroy', '##computer_id##'], 'method' => 'DELETE', 'class' => 'hidden']) !!}{!! Form::close() !!}';

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this computer!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false
        },
        function(){
            // Replace the placeholder with the actual id
            form = form.replace('##computer_id##', computerId);

            // Submit the form
            $(form).submit();
        });
    });

    function resetComputerStatus(computer) {

        computer.find('.status-icon-stack span').removeClass('status-icon-on status-icon-off status-icon-waiting fa-spin fa-circle-o-notch fa-circle fa-pulse');
    }

    function setComputerStatus(computer, classes, pulse) {

        resetComputerStatus(computer);

        computer.find('.status-icon-stack span').addClass(classes);

        if(pulse) {
            computer.find('.status-icon-stack .status-pulsable-icon').addClass('fa-pulse');
        }
    }

    function setComputerStatusOn(computer) {

        setComputerStatus(computer, 'status-icon-on fa-circle', true);
    }

    function setComputerStatusOff(computer) {

        setComputerStatus(computer, 'status-icon-off fa-circle', true);
    }

    function setComputerStatusWaiting(computer) {

        setComputerStatus(computer, 'status-icon-waiting fa-circle-o-notch fa-spin');
    }

    function checkAllComputers() {
        $(".computer").each(function(i, computer) {
            computerId = computer.dataset.computerId;
            $.get( "/computer/" + computerId + "/status", function( data ) {

                switch(data) {
                    case "on":
                        setComputerStatusOn($(computer));
                        break;
                    case "off":
                        setComputerStatusOff($(computer));
                        break;
                    default:
                        setComputerStatusWaiting($(computer));
                        break;
                }

            });
        });
    }

    $(function() {

        checkAllComputers();

        setInterval(function () {
            checkAllComputers();
        }, 10000);
    });
</script>
@endsection