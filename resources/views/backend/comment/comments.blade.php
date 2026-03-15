@extends('Admin.admin_dashboard')
@section('Admin')

   	<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">All Comments </h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Serial No.</th>
                        <th>Post Title</th>
                        <th>User Name</th>
                        <th>User Email</th> 
                        <th>Comment</th> 
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $key => $comment)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{!! Str::wordWrap($comment['post']['post_title'], 40, '<br />') !!}</td>
                                <td>{{ $comment->user_name }}</td>
                                <td>{{ $comment->user_email }}</td>
                                <td>{!! Str::wordWrap($comment->comment, 40, '<br />') !!}</td>
                                <td>
                                    <div class="form-check form-switch mb-2">
									    <input type="checkbox" class="form-check-input" data-comment-id="{{ $comment->id }}" id="status_button" style="transform:scale(1.5)">
									</div>
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

                <script>
                    $(document).on('change', '#status_button', function(){
                        let comment_id = $(this).data('comment-id');
                        let is_checked = $(this).is(':checked');

                        // Send an Ajax request to activate or deactivate a comment

                        $.ajax({
                            url: {{ route('comment.status.update')}},
                            method: "POST",
                            data: {_token:"{{ csrf_token() }}", comment_id:comment_id, status:is_checked ? 1 : 0},
                            dataType: "json",
                            success: function(result){
                                if(result.status == 200){
                                    toastr.success('comment status updated successfully!');
                                }
                            }
                        })
                    });
                </script>
@endsection