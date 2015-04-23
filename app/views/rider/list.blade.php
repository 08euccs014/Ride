<div>
	<ul class="rider-list">
		@foreach($riders as $rider)
		<?php
		$id = $rider->id;
		$rider = rider::getIntance($id);
		$trip = $rider->getTrip(); ?>
		<li class="col-sm-12">
			<div class="col-sm-2">
				<div class="img-container img-circle gap-top-20">
				<img class="" src="{{ url('assets/image/male-passenger.png') }}" />
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
				<button class="btn btn-primary gap-top-45">Contact Me</button>
			</div>
			
		</li>
		@endforeach
	</ul>
</div>