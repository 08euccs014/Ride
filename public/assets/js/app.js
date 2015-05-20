
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

$('.google-mapper').change(function () {
	var address = $(this).val();  
	codeAddress($(this), address);
});

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

initialize();

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