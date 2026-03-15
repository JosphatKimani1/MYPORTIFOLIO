@extends('Admin.admin_dashboard')
@section('Admin')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#varyingModal" >
        Add Education
      </a>
    </ol>
</nav>

   	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">My Education</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Serial No.</th>
                        <th>Title</th>
                        <th>Institution</th>
                        <th>From Year</th>
                        <th>To Year</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($educations as $key => $education)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ Str::title($education->resume_title) }}</td>
                                <td>{{ Str::title($education->institution) }}</td>
                                <td>{{ $education->from_year }}</td>
                                <td>{{ $education->to_year }}</td>
                                <td>
                                    <a href="#" id="{{ $education->id }}" data-bs-toggle="modal" data-bs-target="#EditExperienceModel"  class="btn btn-inverse-light editExp" style="margin-right: 10px;">Edit</a>
                                    <a href="{{ route('delete.experience', [$education->id]) }}" id="delete" class="btn btn-inverse-danger">Delete</a>
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

    {{-- Add Education Model --}}
<div class="modal fade" id="varyingModal" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="varyingModalLabel">Add Education</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="{{ route('store.experience')}}" >
                        @csrf
                        <input type="hidden" name="resume_cat" value="Education">
                        <div class="mb-3">
                          <label for="title" class="form-label">Title:</label>
                          <input type="text" class="form-control" name="resume_title" placeholder="Tax Consultant" required>
                        </div>

                        <div class="mb-3">
                          <label for="organization" class="form-label">Institution:</label>
                          <input type="text" class="form-control" name="institution" placeholder="Westlands, Kenya" required>
                        </div>

                        <div class="mb-3">
                          <label for="from" class="form-label">From Year:</label>
                          <input type="text" class="form-control" name="from_year" placeholder="2022" required>
                        </div>

                        <div class="mb-3">
                          <label for="to" class="form-label">To Year:</label>
                          <input type="text" class="form-control" name="to_year" placeholder="Present" required>
                        </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Add Education</button>
                    </div>
                       
                      </form>
                    </div>
                    
                  </div>
                </div>
</div>

    {{-- Edit Education Model --}}
<div class="modal fade" id="EditExperienceModel" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="varyingModalLabel">Edit Education</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="{{ route('update.experience')}}" >
                        @csrf
                        <input type="hidden" name="resume_cat" value="Education">
                        <input type="hidden" name="exp_id" id="exp_id">
                        <div class="mb-3">
                          <label for="title" class="form-label">Title:</label>
                          <input type="text" class="form-control" name="resume_title" id="resume_title" required>
                        </div>

                        <div class="mb-3">
                          <label for="organization" class="form-label">Institution:</label>
                          <input type="text" class="form-control" name="institution" id="institution" required>
                        </div>

                        <div class="mb-3">
                          <label for="from" class="form-label">From Year:</label>
                          <input type="text" class="form-control" name="from_year" id="from_year" required>
                        </div>

                        <div class="mb-3">
                          <label for="to" class="form-label">To Year:</label>
                          <input type="text" class="form-control" name="to_year" id="to_year" required>
                        </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update Education</button>
                    </div>
                       
                      </form>
                    </div>
                    
                  </div>
                </div>
</div>

<script>
  $(document).on('click', '.editExp', function(e){
    e.preventDefault();
    let id = $(this).attr('id');
    // send edit exp ajax request
    $.ajax({
      url: 'edit-experience/'+id,
      method: 'GET',
      dataType: 'json',
      success: function(result){
        $('#resume_title').val(result.resume_title);
        $('#institution').val(result.institution);
        $('#from_year').val(result.from_year);
        $('#to_year').val(result.to_year);
        $('#exp_id').val(result.id);
        
      }
    });
  });
</script>
@endsection