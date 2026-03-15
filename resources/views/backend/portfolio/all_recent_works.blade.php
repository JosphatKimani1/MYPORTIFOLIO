@extends('Admin.admin_dashboard')
@section('Admin')

   	<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">My Recent Works</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Serial No.</th>
                        <th>Photo</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Sub-Title</th> 
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($works as $key => $work)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><img src="{{ $work->photo ? asset($work->photo) : asset('uploads/no_image.jpg') }}" alt=""></td>
                                <td>{{ Str::title($work->service?->service_title) }}</td>
                                <td>{{ Str::title($work->title) }}</td>
                                <td>{{ Str::title($work->sub_title) }}</td>
                                <td>
                                    <a href="{{ route('edit.work', [$work->id]) }}"  class="btn btn-inverse-light" style="margin-right: 10px;">Edit</a>
                                    <a href="{{ route('delete.work', [$work->id]) }}" id="delete" class="btn btn-inverse-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>
@endsection