@extends('layouts.backend.app')


@section('content')
  <div class="container">

        @include('layouts.backend.partials._bread', ['data' => empty($bread) ? '' : $bread])

        <div class="row">
            <div class="col-sm-12">
                <div class="card-box ">
                    <h4 class="m-t-0 header-title"><b>Images</b></h4>
                    <a href="{{ route('admin.image.create', $gallery->id) }}">
                    	<button class="btn btn-primary">Add Images</button>
                    </a>
                    @if (count($gallery->images) == 0)

                    	<table class="table table-striped m-0">
							<thead>
								<tr>
									<th>Id</th>
									<th>File</th>
									<th>Created At</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
						<h4 align="center">Tidak ada foto</h4>
                    @else
						<table class="table table-striped m-0">
							<thead>
								<tr>
									<th>Id</th>
									<th>File</th>
									<th>Created At</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($images as $data)
									<tr>
										<th scope="row">{{ $data->id }}</th>
										<td>
											<a href="{{ $data->image }}" data-lightbox="image-1" data-title="{{ $data->title }}">
												<img height="50" width="50" src="{{ $data->image }}" alt="placeholder+image">
											</a>
										</td>
										<td>{{ $data->created_at }}</td>
										<td>
											{!! Form::open(['method' => 'DELETE', 'route' => ['admin.image.destroy', $data->id]]) !!}
												<button class="btn btn-sm btn-danger">Delete</button>
											{!! Form::close() !!}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
                    @endif

                    <?php echo $images->links(); ?>
                </div>
            </div>
        </div>
        <!-- end row -->
  </div>
@endsection
