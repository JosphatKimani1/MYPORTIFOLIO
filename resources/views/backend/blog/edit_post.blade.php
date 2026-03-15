@extends('Admin.admin_dashboard')
@section('Admin')

  <div class="col-md-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">

								<h6 class="card-title">Edit Post</h6>

								<form class="forms-sample" method="POST" action="{{ route('update.post')}}" enctype="multipart/form-data">
                                    @csrf
									<input type="hidden" name="id" value="{{ $post->id }}">
									<div class="row mb-3">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Post Title</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="post_title" value="{{ $post->post_title }}" required>
										</div>
									</div>

									<div class="row mb-3">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Post Tags (CSV) </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="post_tags" value="{{ $post->post_tags }}" required>
										</div>
									</div>

                                    <div class="row mb-3">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Post Description</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="tinymceExample" name="post_description" rows="10">
                                                {{$post->post_description }}
                                            </textarea>
										</div>
									</div>

                                    	<div class="row mb-3">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Post Photo</label>
										<div class="col-sm-9">
										<input class="form-control" name="post_photo" type="file" id="Image">
										</div>
									</div>

                                    <div class="row mb-3">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
										<img id="ShowImage" src="{{ $post->post_photo ? asset($post->post_photo) : asset('uploads/no_image.jpg') }}" alt="" style="width: 90px; height: 90px; border-radius: 10px;">
										</div>
									</div>
								
									
								   
									<button type="submit" class="btn btn-secondary">Update Post</button>
								</form>

							</div>
						</div>
					</div>

                    <script>

                        $(document).ready(function (){
                            $('#Image').on('change', function(e){
                                var reader = new FileReader();
                                reader.onload = function(e){
                                $('#ShowImage').attr('src', e.target.result);
                                }
                                reader.readAsDataURL(e.target.files['0']);
                            });
                                
                             
                        })
                    </script>
@endsection


