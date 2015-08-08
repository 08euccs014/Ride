@section('footer')
	<div class="row">
		<div class="col-md-12 app-footer">
			<div class="col-md-7 text-center">
				<h1>Let's share happy rides</h1>		
				<div class="gap-top-40">
					<a class="col-md-3 col-md-offset-3" href="http://facebook.com/joinmyway.net" target="_blank">
						<i class="fa fa-facebook-square fa-4x"></i>
					</a>
					<a class="col-md-3" href="https://twitter.com/joinmyway" target="_blank">
						<i class="fa fa-twitter-square fa-4x"></i>
					</a>
				</div>
			</div>
			<div class="col-md-5 text-center border-left">
				<h1><a  href="{{ url('aboutus') }}" target="_blank">Know about us</a></h1>		
				<h4>- or -</h4>
				<h4>Email us - support@joinmyway.net</h4>
			</div>
		</div>
		<div class="col-md-12 app-footer-second">
			
			<div class="col-md-6 text-center">
				<h4><a href="{{ url('privacy_policies') }}"  target="_blank">Privacy Policies</a></h4>
				<h4 class="gap-top-20"><a href="{{ url('term_and_conditions') }}"  target="_blank">Terms & Conditions</a></h4>
			</div>
			<div class="col-md-6 text-center">
				<div class="gap-top-10">&copy;All copyright reserved @joinmyway.net </div>
			</div>
		</div>
	</div>
	
	
		
<!-- 	<div class="row gap-top-20 compaign-bar" > -->
<!-- 		@for($i = 1; $i < 5; $i++) -->
<!-- 		<div class="col-xs-6 col-md-3"> -->
<!-- 			<div class="thumbnail"> -->
<!-- 				Adveritsements -->
<!-- 			</div> -->
<!-- 		  </div> -->
<!-- 		 @endfor -->
<!-- 	</div> -->
@stop