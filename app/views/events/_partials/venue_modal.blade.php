<!-- Venue Modal -->
<div class="modal fade" id="venue-modal" tabindex="-1" role="dialog" aria-labelledby="venueModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Pick a venue</h4>
			</div>
			<div class="modal-body">
				@foreach($htmlRows as $row)
					<div class="row">
						@foreach($row as $model)
							<div class="col-lg-4 col-md-4">
								<div class="thumbnail"
									 data-venue-id="{{ $model->id }}"
									 data-venue-name="{{ $model->name }}"
									 data-venue-description="{{ $model->description }}">
									<img src="http://placehold.it/171x180" alt="placehold.it">
									<div class="caption">
										<h3>{{ $model->name }}</h3>
										<p>{{ $model->description }}</p>
										<p><a href="#" class="btn btn-primary select-venue-button" role="button">Select</a></p>
									</div>
									<!-- /.caption -->
								</div>
								<!-- /.thumbnail -->
							</div>
							<!-- /.column -->
						@endforeach
					</div>
					<!-- /.row -->
				@endforeach
				<div class="clearfix">&nbsp;</div>
			</div>
		</div>
	</div>
</div>