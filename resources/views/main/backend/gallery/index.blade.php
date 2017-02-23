@extends('layouts.backend.app')

@section('styles')
    <!-- DataTables -->
    <link href="{{ asset('back/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection


@section('content')
  <div class="container">

        @include('layouts.backend.partials._bread', ['data' => empty($bread) ? '' : $bread])

        <div class="row">
          <div class="col-sm-12">
            <div class="card-box" align='right'>
              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-file-archive-o"></i> Open File Manager
              </a>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <div class="card-box ">
                    <h4 class="m-t-0 header-title"><b>Gallery</b></h4>
                    {{-- <p> <a class="btn btn-default" href="{{ route('admin.gallery.create') }}">Add Gallery</a> </p> --}}
                    {!! $html->table(['class'=>'table table-bordered table-striped']) !!}
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card-box">
                    {!! Form::open(['method' => 'POST', 'route' => 'admin.gallery.store', 'class' => 'form-horizontal']) !!}


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

@section('scripts')
    <script src="{{ asset('back/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    {!! $html->scripts() !!}
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').dataTable();
            $('#lfm').filemanager('file');
        });
    </script>
@endsection
