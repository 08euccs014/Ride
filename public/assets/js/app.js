
var geocoder;
var map;
function initialize() {
  geocoder = new google.maps.Geocoder();
}

function codeAddress(obj, address) {
	geocoder.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	    	return googleAdresses(obj, results[0]);
	    } else {
	    	return googleAdresses(obj, false);
	    }
	    return googleAdresses(obj, false);
  });
}

function googleAdresses(object, result) {
	var addresses = "";
	if(result == false) {
		addresses = "No mathcing address found";
	}
	else {
		for(var i = 0; i < result.address_components.length ; i++) {
			addresses  = addresses + "<div>" + result.address_components[i].long_name + "</div>";
		}
	}
	
	$(object).val(result.formatted_address);
	
	var latitude =  result.geometry.location.lat();
	$(object).parent().children('.google-mapper-lat').val(latitude);
	
	var longitude =  result.geometry.location.lng();
	$(object).parent().children('.google-mapper-lng').val(longitude);
}

function addPlaceListener(object, autocomplete)
{
	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		var place = autocomplete.getPlace();
		if(place.formatted_address != undefined) {
			var address = place.formatted_address;
		} else {
			var address = place.name;
		}

		codeAddress(object ,address);
	});
}


function ajaxRequest(actionUrl, data, method, response, successCallback, errorCallback)
{

    var request = $.ajax({
        url: actionUrl,
        method: method,
        data: data,
        dataType: response
    });

    request.done(function( response ) {

        if(successCallback == undefined) {
           console.log(response);
           return true;
        }

        return successCallback(response);

    });

    request.fail(function( jqXHR, textStatus ) {
        if(errorCallback == undefined) {
            console.log("Request failed: " + textStatus);
            return false;
        }

        return errorCallback(textStatus);
    });
}

function openDialog(actionUrl)
{
    ajaxRequest(actionUrl, {}, 'POST', 'json', function(response){

        if (response.status) {
            $('body').append();
        }

    });
}

function contactRider(actionUrl, riderId)
{
    ajaxRequest(actionUrl, {riderId : riderId}, 'POST', 'json', function(response){

        if (response.status == 1) {
        	$('#riderModal').remove();
            $('body').append(response.content);
            eval(response.js);
        }
        else {
            window.location = response.redirectUrl;
        }

    });
}

function resetFilter()
{
	window.location = window.base_url;
}

function routeUrl(url)
{
	url = window.base_url + url;
	return url;
}

function sendFeedback(obj)
{ 
	$(obj).button('loading');
	var msg = $('#feedback').val();
	var from = $('#from').val();
	var url = routeUrl('/sendfeedback');
	ajaxRequest(url, {feedback : msg, from : from}, 'POST', 'json', function(response){
		if(response.status == 1) {
			$('#sendFeedback').button('reset');
			$('#feedback').val('');
			$('#from').val('');
			alert('Thanks for your feedback');
		}
		else {
			alert('Sorry, there is some error occur.\n\nYour feedback is very important, please mail us directly.\n\nThank You');
			$('#sendFeedback').button('reset');
		}
	}, function(response){
		alert('Sorry, there is some error occur.\n\nYour feedback is very important, please mail us directly.\n\nThank You');
		$('#sendFeedback').button('reset');
	});
	
	return false;
}

function sendContactMsg(obj)
{
	$(obj).button('loading');
	var msg = $('#contactMsg').val();
	var receiverId = $('#receiverId').val();
	var senderId = $('#senderId').val();
	var url = routeUrl('/ajax/rider/send_contact_msg');
	ajaxRequest(url, {msg : msg, receiverId : receiverId, senderId : senderId}, 'POST', 'json', function(response){
		if(response.status == 1) {
			$('#sendContactMsg').button('reset');
			$('#sendContactMsg').parents('.modal-body').html('Your message has been sent.');
		}
		else {
			alert('Sorry, there is some error occur.');
			$('#sendContactMsg').button('reset');
		}
		setTimeout(function(){
			$('#riderModal').modal('hide');
		}, 2000);
	}, function(response){
		alert('Sorry, there is some error occur.');
		$('#sendContactMsg').button('reset');
	});
	
	return false;
}

$(document).ready(function(){
	
    $(function () {
    	  $('[data-toggle="popover"]').popover()
    });
	
	//toggle radio button group
    $('.btn-group[data-toggle="buttons"] label').on('click', function () {
	   	 $('.btn-group[data-toggle="buttons"] label').removeClass('btn-primary');
	   	 $(this).addClass('btn-primary');
  	});

    //initialize the google map api
    initialize();

});