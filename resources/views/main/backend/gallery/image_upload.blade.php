@extends('layouts.backend.app')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('back/plugins/dropzone/dropzone.min.css') }}">
@stop

@section('content')
	<div class="container">

        @include('layouts.backend.partials._bread', ['data' => empty($bread) ? '' : $bread])

        <div class="row">
            <div class="col-sm-12">
                <div class="card-box ">
                    <h4 class="m-t-0 header-title"><b>Images</b></h4>
                    {!! Form::open(['method' => 'POST', 'route' => ['admin.image.upload', $gallery->id], 'class' => 'form-horizontal dropzone']) !!}

                    	{!! Form::hidden('gallery_id', $gallery->id) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- end row -->
  </div>
@stop

@section('scripts')
	<script src="{{ asset('back/plugins/dropzone/dropzone.min.js') }}"></script>
@stop
