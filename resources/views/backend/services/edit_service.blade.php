@extends('Admin.admin_dashboard')
@section('Admin')

  <div class="col-md-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">

								<h6 class="card-title">Edit Service</h6>

								<form class="forms-sample" method="POST" action="{{ route('update.service') }}">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
									<div class="row mb-3">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Service Title</label>
										<div class="col-sm-9">

											<input type="text" class="form-control " name="service_title" value="{{ $service->service_title }}">
                                            
										</div>
									</div>

                                    <div class="row mb-3">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Service Description</label>
										<div class="col-sm-9">
                                            
											<textarea class="form-control" name="service_description" rows="3" placeholder="Service Description">
                                                {{ $service->service_description }}">
                                            </textarea>
                                            
										</div>
									</div>

									<button type="submit" class="btn btn-secondary">Update Service</button>
								</form>

							</div>
						</div>
					</div>

                  
@endsection
