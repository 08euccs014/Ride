<div>
	@if( !empty($filters) )
		<div class="alert alert-info row" id="resetFilter">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
			<div class="col-md-10">
				<h4>Showing Results :</h4>
				<p><strong>From -</strong> {{ $filters['ridefrom']['loc'] }}</p>
				<p><strong>To -</strong> {{ $filters['rideto']['loc'] }}</p> 
			</div>
			<div class="col-md-2">
				<button class="btn btn-info" onClick="$('#resetFilter').alert('close'); return false;">
					Reset
				</button>
			</div>
		</div>
	@endif
	@if(!empty($riders))
	<div class="row">
	<ul class="rider-list">
		@foreach($riders as $rider)
		<?php
		$id = $rider->id;
		$rider = rider::getInstance($id);
		$trip = $rider->getTrip(); 

		switch($rider->gender) {
			case 'M' : $image = ($rider->group == 1) ? 'male-passenger' : 'male-rider'; break;
			case 'F' : $image = ($rider->group == 1) ? 'female-passenger' : 'female-rider'; break;
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
			
				<h3 class="rider-name">{{ $rider->firstname }} {{ $rider->lastname }}  (@if($rider->group == 1) passenger @else rider @endif)</h3>
				
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
	</div>
	<div class="row text-center gap-top-10">
		{{ $pagination }}
	</div>
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
