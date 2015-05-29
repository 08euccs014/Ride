@extends('layouts/main')
@section('content')
<div class="row gap-top-20">

    <div class="aboutus gap-bottom-20">
        <div class="aboutus-head">
            <h1>Save Environment, Save Fuel, Save Money</h1>
        </div>
        <div class="aboutus-content">
        	<div class="gap-top-20">
            	<h4><strong>What's the Idea !</strong></h4> 
	            <p>Sharing our regular journey with fellow passengers is beneficial for all.</p>
				<p>It is a pool system in which we share out automobile (whether 2-wheeler or 4-wheeler) with people who have the same need.</p>
				<p>Sharing Automobile = Sharing Cost = Reduction of vehicle on road = Less Traffic = Save Time</p>
			</div>
			<div class="gap-top-20">
				<h4><strong>How it works ?</strong></h4> 
				<p>One person having a car or bike volunteers and choose to become the driver and join this community.</p>
				<p>Riders search the driver and contact them to join the pool.</p>
				<p>Riders usually meet at a designated pick-up location like a shopping centre, parking lot or a park.</p>
				<p>Some group may have more than one pick-up points. It all depends upon the mutual understanding of driver and rider.</p>
			</div>
			<div class="gap-top-20">
				<h4><strong>Basic Calculation ?</strong></h4> 
				<p>Let’s say you travel a distance of 10km every day. Taking an autorikshaw or cab charges you anything between Rs 100 to Rs 200 in a one way trip.</p>
				<p>In a carpool, you share your car with 4 people (let`s say).</p>
				<p>Per head cost reduces to Rs 25-Rs 30</p>			
				<p>Using this pool system regularly may save you Rs. 30,000 to Rs. 60,000 per year.</p>
			</div>

			<div class="gap-top-20">
				<h4><strong>Features</strong></h4> 
				<ul>
					<li>Everything on real time through mobile phone.</li>
					<li>Hassle Free</li>
					<li>Safe and Secure:  Users are 100% verified.</li>
					<li>Every user is verified by their email and phone.</li>
					<li>Female Safety: Female share only with female riders.</li>
				</ul>
			</div>

			<div class="gap-top-20">
				<h4><strong>Note</strong></h4> 
				<ul>
				<li>This system depends entirely on people`s mutual understanding.</li>
				<li>We don`t book cab.</li>
				<li>We simply help a driver meet the riders.</li>
				<li>It is advisable to all users not to go with any driver whom you are not comfortable with.</li>
				<li>We are not responsible for any accident causing, we do not provide any kind of compensation or anything.</li>
				<li>In case any rash or careless driving or you feel the person is not fit for community pool service. Do send us your complaint/feedback at support@joinmyway.net</li>
				</ul>
			</div>
			
			<div class="gap-top-20 clearfix">
				<div class="col-md-6">
					<h4 class="text-center gap-top-20">It’s initiative to make a city clean and green.</h4>
					<h4 class="text-center gap-top-20">Proudly be a Part of this Initiative.</h4>
				</div>
				<div class="col-md-6">
					<h4 class="col-md-11">Feel free to ask about us :)</h4>
					<div class="col-md-11">						
						<input class="form-control" type="email" id="from" value="" placeholder="your email, so we can thank to you"/>
						<div class="gap-top-10">
							<textarea cols="56" rows="9" placeholder="Feedback..." id="feedback"></textarea>
						</div>
					</div>
            		<div class="col-md-11 gap-top-10">
            			<div class="col-md-5 pull-right row">
	            			<button type="button" id="sendFeedback" data-loading-text="Sending ..." class="btn btn-primary btn-block" autocomplete="off"  onclick="sendFeedback(this);">
								Send &nbsp; <i class="glyphicon glyphicon-send"></i>
							</button>
            			</div>
            		</div>
				</div>
			</div>
        </div>
    </div>
</div>
@stop