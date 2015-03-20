@extends('layouts.master')

@section('content')

    <div class="container">

        @if(Session::has('message'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                </div>
            </div>
        @endif

        @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        @include('partials.errors')
                    </div>
                </div>
        @endif

        <div class="row">
            <div class="col-md-3 col-md-offset-1 text-center">
                <img src="/img/icons/pc.svg" alt="">
                <h4>Edit Computer</h4>
            </div>
            <div class="col-md-7">
                {!! Form::model($computer, ['route' => ['computer.update', $computer->id],'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
                @include('computer.form')
            </div>
        </div>

    </div>

@stop