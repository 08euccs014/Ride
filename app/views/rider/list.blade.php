<div>
	<ul class="rider-list">
		@foreach($riders as $rider)
		<li class="col-sm-12">
			<div class="col-sm-2">
				<div class="img-container img-circle">
				<img class="" src="{{ url('assets/image/male-passenger.png') }}" />
				</div>
			</div>
			<div class="col-sm-7">
			
				<h3 class="rider-name">{{ $rider['name'] }}</h3>
				
				<div class="row gap-top-10">
					<div class="col-md-6 vehicle-details">
						<div class="row">
							<div class="col-sm-6 key">Vehicle Type - </div>
							<div class="col-sm-6 value">2 wheeler</div>
						</div>
						<div class="row">
							<div class="col-sm-6 key">Vehicle Name - </div> 
							<div class="col-sm-6 value">{{ $rider['vehical'] }}</div>
						</div> 
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-primary gap-top-45">Contact Me</button>
			</div>
			
		</li>
		@endforeach
	</ul>
</div>