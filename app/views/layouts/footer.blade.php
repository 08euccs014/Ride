@section('footer')

<hr/>

<!-- 	<div class="row gap-top-20 compaign-bar" > -->
<!-- 		@for($i = 1; $i < 5; $i++) -->
<!-- 		<div class="col-xs-6 col-md-3"> -->
<!-- 			<div class="thumbnail"> -->
<!-- 				Adveritsements -->
<!-- 			</div> -->
<!-- 		  </div> -->
<!-- 		 @endfor -->
<!-- 	</div> -->

<!-- 	<hr/> -->
	<div class="col-md-12">
		<div class="col-md-4 text-center">
			<p><a href="{{ url('privacy_policies') }}"  target="_blank">Privacy Policies</a></p>
			<p><a href="{{ url('term_and_conditions') }}"  target="_blank">Terms & Conditions</a></p>
		</div>
		<div class="col-md-4 text-center">
			<a href="{{ url('aboutus') }}" target="_blank">Know About Us</a>
		</div>
		<div class="col-md-4 text-center">
			&copy;All Copyright Reservered @joinmyway.net 
		</div>
	</div>
@stop