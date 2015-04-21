@section('footer')

	<div class="row gap-top-20 compaign-bar" >

	@for($i = 1; $i < 5; $i++)
	<div class="col-xs-6 col-md-3">
		<div class="thumbnail">
			Ad
		</div>
	  </div>
	 @endfor
	</div>
		
	<div>Contact Details</div>
@stop