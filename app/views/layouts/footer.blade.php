@section('footer')

	<hr/>
	<br/>
	<br/>

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
	<div class="col-md-12 gap-bottom-20 black-link">
		<div class="col-md-4 text-center">
			<p><a href="{{ url('privacy_policies') }}"  target="_blank">Privacy Policies</a></p>
			<p><a href="{{ url('term_and_conditions') }}"  target="_blank">Terms & Conditions</a></p>
		</div>
		<div class="col-md-4 text-center">
			<div class="row text-center">
			<a  href="{{ url('aboutus') }}" target="_blank">
				<img src="{{ url('assets/image/msn.svg') }}" height="50px" width="50px"/>
				<p class="gap-top-10"> Know About Us</p>
			</a>
			</div>
		</div>
		<div class="col-md-4 text-center">
			<div class="row">
				<a class="col-md-3 col-md-offset-3" href="http://facebook.com/joinmyway.net" target="_blank"><img src="{{ url('assets/image/facebook.svg') }}" height="50px" width="50px"/></a>
				<a class="col-md-3" href="https://twitter.com/joinmyway" target="_blank"><img src="{{ url('assets/image/twitter.svg') }}" height="50px" width="50px"/></a>
			</div>
			<div class="gap-top-10">&copy;All copyright reserved @joinmyway.net </div>
		</div>
	</div>
@stop