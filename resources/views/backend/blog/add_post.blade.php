@extends('Admin.admin_dashboard')
@section('Admin')

  <div class="col-md-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">

								<h6 class="card-title">Add Post</h6>

								<form class="forms-sample" method="POST" action="{{ route('store.post')}}" enctype="multipart/form-data">
                                    @csrf
									
									<div class="row mb-3">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Post Title</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="post_title" placeholder="Post  Title" required>
										</div>
									</div>

									<div class="row mb-3">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Post Tags (CSV) </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="post_tags" placeholder="Texas, Mexico,Florida" required>
										</div>
									</div>

                                    <div class="row mb-3">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Post Description</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="tinymceExample" name="post_description" rows="10"></textarea>
										</div>
									</div>

                                    	<div class="row mb-3">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Post Photo</label>
										<div class="col-sm-9">
										<input class="form-control" name="post_photo" type="file" id="Image" required>
										</div>
									</div>

                                    <div class="row mb-3">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
										<img id="ShowImage" src="{{ asset('uploads/no_image.jpg') }}" alt="" style="width: 90px; height: 90px; border-radius: 10px;">
										</div>
									</div>
								
									
								   
									<button type="submit" class="btn btn-secondary">Add Post</button>
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


