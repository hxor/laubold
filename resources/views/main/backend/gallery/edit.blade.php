@extends('layouts.backend.app')

@section('content')
  <div class="container">

        @include('layouts.backend.partials._bread', ['data' => empty($bread) ? '' : $bread])

        <div class="row">
            <div class="col-sm-8">
                <div class="card-box">
                {!! Form::model($gallery, ['route' => ['admin.gallery.update', $gallery->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                
                   {!! Form::hidden('author', Auth::user()->name) !!}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            {!! Form::label('title', 'Title Gallery') !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('title') }}</small>
                        </div>

                         <div class="form-group text-right m-b-0">
                          <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                            Reset
                          </button>
                          <button class="btn btn-primary waves-effect waves-light" type="submit">
                            Submit
                          </button>
                        </div>
                
                {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- end row -->
  </div>
@endsection
