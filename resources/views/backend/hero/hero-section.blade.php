@extends('Admin.admin_dashboard')
@section('Admin')

   <div class="col-md-12 stretch-card">
						<div class="card">
							<div class="card-body">
								<h6 class="card-title">Edit Hero Section</h6>
									<form method="POST" action="{{ route('update.hero.section') }}" enctype="multipart/form-data">
                                        @csrf
										<div class="row">
											<div class="col-sm-12">
												<div class="mb-3">
													<label class="form-label"></label>
													<img id="ShowImage" src="{{ $hero->photo ? asset($hero->photo) : asset('uploads/admin/no-img-avatar.png') }}" alt="" style="width: 140px; height: 140px; border-radius: 10px;">
												</div>
											</div><!-- Col -->
											<div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Chose Hero Photo</label>
													<input class="form-control" name="photo" type="file" id="Image">
												</div>
											</div><!-- Col -->
                                             <div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Name</label>
													<input type="text" class="form-control" name="name" value="{{ $hero->name }}">
												</div>
											</div><!-- Col -->
                                               <div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Profession</label>
													<input type="text" class="form-control" name="profession" value="{{ $hero->profession }}">
												</div>
											</div><!-- Col -->
										</div><!-- Row -->


                                           
										<div class="row">
											<div class="col-sm-3">
												<div class="mb-3">
													<label class="form-label">Twitter URL</label>
													<input type="text" class="form-control" name="twitter_url" value="{{ $hero->twitter_url }}">
												</div>
											</div><!-- Col -->
                                            <div class="col-sm-3">
												<div class="mb-3">
													<label class="form-label">Tiktok URL</label>
													<input type="text" class="form-control" name="tiktok_url" value="{{ $hero->tiktok_url }}">
												</div>
											</div><!-- Col -->
                                            <div class="col-sm-3">
												<div class="mb-3">
													<label class="form-label">LinkedIn URL</label>
													<input type="text" class="form-control" name="linkedin_url" value="{{ $hero->linkedin_url }}">
												</div>
											</div><!-- Col -->
                                            <div class="col-sm-3">
												<div class="mb-3">
													<label class="form-label">Github URL</label>
													<input type="text" class="form-control" name="github_url" value="{{ $hero->github_url }}">
												</div>
											</div><!-- Col -->
											
											
										</div><!-- Row -->
										<div class="row">
											<div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Years Of Experience</label>
													<input type="text" class="form-control" name="YOE" value="{{ $hero->YOE }}">
												</div>
											</div><!-- Col -->
                                            <div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Projects Completed</label>
													<input type="text" class="form-control" name="PC" value="{{ $hero->PC }}">
												</div>
											</div><!-- Col -->

                                             <div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Happy Clients</label>
													<input type="text" class="form-control" name="HC" value="{{ $hero->HC }}">
												</div>
											</div><!-- Col -->

                                            <div class="col-sm-12">
												<div class="mb-3">
													<label class="form-label">Upload Resume (CV)</label>
													<input class="form-control" name="resume" type="file">
												</div>
											</div><!-- Col -->
                                             <div class="col-sm-12">
												<div class="mb-3">
													<label class="form-label">Short Description</label>
													<textarea class="form-control" name="Short_description" rows="3">{{ $hero->Short_description }}</textarea>
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
                                        <button type="submit" class="btn btn-primary submit">Update Hero Section</button>
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