<div>
	@if( !empty($filters) )
		<div class="alert alert-info" id="resetFilter">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
			<h4>Showing Results ::  From - {{ $filters['ridefrom']['loc'] }},  To - {{ $filters['rideto']['loc'] }} </h4>
			<button class="btn btn-info" onClick="$('#resetFilter').alert('close'); return false;">
				Reset
			</button>
				
		</div>
	@endif
	@if(!empty($riders))
	<ul class="rider-list">
		@foreach($riders as $rider)
		<?php
		$id = $rider->id;
		$rider = rider::getInstance($id);
		$trip = $rider->getTrip(); 

		switch($rider->gender) {
			case 'M' : $image = 'male-rider'; break;
			case 'F' : $image = 'female-rider'; break;
			default  : $image = 'male-passenger'; break;
		}

		?>
		<li class="col-sm-12">
			<div class="col-sm-2">
				<div class="img-container img-circle gap-top-20">
				<img class="" src="{{ url('assets/image/'.$image.'.png') }}" />
				</div>
			</div>
			<div class="col-sm-7">
			
				<h3 class="rider-name">{{ $rider->firstname }} {{ $rider->lastname }}</h3>
				
				<div class="gap-top-10">
					<div class="vehicle-details">
						<div class="row">
							<div class="col-sm-2 key">From - </div>
							<div class="col-sm-10 value">{{ $trip->from()->description }}</div>
						</div>
						<div class="row">
							<div class="col-sm-2 key">To - </div>
							<div class="col-sm-10 value">{{ $trip->to()->description }}</div>
						</div>
						{{--<div class="row">--}}
                            {{--<div class="col-sm-2 key">Vehicle Type - </div>--}}
                            {{--<div class="col-sm-10 value">2 wheeler</div>--}}
                        {{--</div>--}}
						{{--<div class="row">--}}
                            {{--<div class="col-sm-2 key">Vehicle Name - </div>--}}
                            {{--<div class="col-sm-10 value"> $rider['vehical'] </div>--}}
                        {{--</div>--}}
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-primary gap-top-45" onClick="contactRider('{{ url('ajax/rider/contact') }}', {{$rider->id}});">Contact Me</button>
			</div>
		</li>
		@endforeach
	</ul>
	@else
	<div class="row">
		<h3 class="text-center">Sorry, there is no users matching your criteria.</h3>
	</div>
	@endif
</div>
<script>
$('#resetFilter').on('closed.bs.alert', function () {
	resetFilter();
})
</script>