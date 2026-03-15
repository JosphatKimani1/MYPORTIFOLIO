@extends('Admin.admin_dashboard')
@section('Admin')

   	<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">All Testimonies </h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Serial No.</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Occuoation</th>
                        <th>Testimony</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonies as $key => $testimony)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><img src="{{ $testimony->photo }}" alt=""></td>
                                <td>{{ Str::title($testimony->name) }}</td>
                                <td>{{ $testimony->occupation }}</td>
                                <td>{{ Str::limit($testimony->testimony, 20,) }}</td>
                                <td>
                                    <a href="{{ route('edit.testimony', [$testimony->id]) }}"  class="btn btn-inverse-light" style="margin-right: 10px;">Edit</a>
                                    <a href="{{ route('delete.testimony', [$testimony->id]) }}" id="delete" class="btn btn-inverse-danger">Delete</a>
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