@extends('Admin.admin_dashboard')
@section('Admin')

   	<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">My Skills </h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Serial No.</th>
                        <th>Icon</th>
                        <th>Technology Name</th>
                        <th>Experience Level</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($allskills as $key => $allskill)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><img src="{{ $allskill->icon ? asset($allskill->icon) : asset('uploads/no_image.jpg') }}" alt=""></td>
                                <td>{{ Str::title($allskill->technology_name) }}</td>
                                <td>{{ $allskill->exp_level }}</td>
                                <td>
                                    <a href="{{ route('edit.skill', [$allskill->id]) }}"  class="btn btn-inverse-light" style="margin-right: 10px;">Edit</a>
                                    <a href="{{ route('delete.skill', [$allskill->id]) }}" id="delete" class="btn btn-inverse-danger">Delete</a>
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