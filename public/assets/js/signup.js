$(document).ready(function() {
    $('#signupform').formValidation({
        framework: 'bootstrap',
        // List of fields and their validation rules
        fields: {
            'userdata[email]': {
                validators: {
                    notEmpty: {
                        message: 'Email is required in order to contact you by co-passenger'
                    },
                    emailAddress: {
                        message: 'kindly fill your correct email.'
                    }
                }
            },
            'userdata[firstname]': {
            	validators: {
                    notEmpty: {
                        message: 'The name is required and cannot be empty'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'The name must be more than 3 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'The username can only consist of alphabetical'
                    }
                }
            },
            'userdata[password]': {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    }
                }
            },
			'userdata[gender]' : {
				validators: {
					notEmpty : {
						message: 'Kindly choose one'
					}
				}
			},
			'userdata[ridefrom][loc]' : {
				validators: {
					notEmpty : {
						message: 'Kindly fill your starting location'
					}
				}
			},
			'userdata[rideto][loc]' : {
				validators: {
					notEmpty : {
						message: 'Kindly fill your destination location'
					}
				}
			},
			'termcondition' : {
				validators: {
					notEmpty : {
						message: 'Kindly approve terms & conditions to proceed. Thank You.'
					}
				}
			}
        }
    })
    .on('success.form.fv', function(e) {
        // Prevent form submission
        e.preventDefault();

        var $form = $(e.target),
            fv    = $form.data('formValidation');

        // Use Ajax to submit form data    
        var actionUrl= $('#signupform').attr('action');
        var postData = $('#signupform').serialize();


        ajaxRequest(actionUrl, postData, 'POST', 'json', function(response){
            if(response.status == 1) {
                window.location = response.url;
            }
        }, function(response){alert(response);} );
    });
});