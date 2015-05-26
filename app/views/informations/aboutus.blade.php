@extends('layouts/main')
@section('content')

<style>

.aboutus {
    overflow: hidden;
    background-color: #D5EAEB;
}
.aboutus-head {
    left: 445px;
    position: absolute;
    top: 95px;
}

.aboutus-content {
    left: 650px;
    position: absolute;
    top: 215px;
}

.aboutus-footer {
    left: 650px;
    position: relative;
    top: -70px;
    border-top: 1px solid #ABABAB;
}


</style>
<div class="row gap-top-20">

    <div class="aboutus">
        <img src="{{ url( 'assets/image/tree.jpg') }}"/>
        <div class="aboutus-head">
            <h1>Save Environment, Save Fuel, Save Money</h1>
        </div>
        <div class="aboutus-content">
            <h4>Write here what we think ..... if we think :P</h4>
        </div>
        <div class="aboutus-footer">
            <h4>Feel free to contact us at <a href="mailto:support@joinmyway.net?subject=Feedback">Support Team</a></h4>
        </div>
    </div>

</div>
@stop