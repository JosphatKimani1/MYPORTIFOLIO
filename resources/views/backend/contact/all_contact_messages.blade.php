@extends('Admin.admin_dashboard')
@section('Admin')

   	<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">All Contacts </h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Serial No.</th>
                        <th>Client's Name</th>
                        <th>Email</th>
                        <th>Phone</th> 
                        <th>Service Required</th> 
                        <th>Description</th> 
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($contactMessages as $key => $contact)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ Str::title($contact->first_name) }} {{ Str::title($contact->last_name) }}</td>
                                <td>{{ ($contact->email) }}</td>
                                <td>{{ ($contact->phone) }}</td>
                                <td>{{ Str::title(($contact->service->service_title)) }}</td>
                                <td>{!! Str::wordWrap($contact->description, 20, '<br/>') !!}</td>
                                <td>
                                  
                                    <a href="{{ route('delete.contact', [$contact->id]) }}" id="delete" class="btn btn-inverse-danger">Delete</a>
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