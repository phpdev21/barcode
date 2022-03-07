/**
 * Common function of the JS used throughout the Admin Web
 */

/**
 * Function to display the success message for the Success operations
 */
function show_FlashMessage(message, type, title) {
  	// remove all the other messages
  	PNotify.removeAll();

  	// check the type of the flash message and set by default to success
  	if(typeof type == 'undefined')
  	{
  		type = 'success';
  	}

  	// check title is specified or not
  	if(typeof title == 'undefined' && type == 'success')
  	{
  		title = 'Success';
  	}

  	// check title is specified or not
  	if(typeof title == 'undefined' && type == 'error')
  	{
  		title = 'Error';
  	}

  	// check title is specified or not
  	if(typeof title == 'undefined' && type == 'warning')
  	{
  		title = 'Warning!';
  	}

  	// make the new message
  	new PNotify({
  		type: type,
  		title: title,
  		text: message,
  		delay: 2000
  	});
}

function scrollTop(){
  $('html, body').animate({
       scrollTop: ($('.page-breadcrumb').offset().top - 300)
  }, 2000); 
}
/**
 * Start the loader on the particular element
 */
function startLoader(element) {
	// check if the element is not specified
	if(typeof element == 'undefined') {
		element = "body";
	}

	// set the wait me loader
	$(element).waitMe({
		effect : 'win8',
		text : 'Please Wait..',
		bg : 'rgba(255,255,255,0.7)',
		//color : 'rgb(66,35,53)',
		color : 'black',
		sizeW : '20px',
		sizeH : '20px',
		source : ''
	});
}

/**
 * Start the loader on the particular element
 */
function stopLoader(element) {
  // check if the element is not specified
  if(typeof element == 'undefined') {
    element = 'body';
  }

  // close the loader
  $(element).waitMe("hide");
}
$(document).on('click','.eye-icon',function(){
  var x = $(this).siblings('input').attr('type');
  if (x === "password") {
    $(this).siblings('input').attr('type',"text");
    $(this).empty().html('<i class="glyphicon glyphicon-eye-open"></i>');
  } else {
    $(this).siblings('input').attr('type',"password");
    $(this).empty().html('<i class="glyphicon glyphicon-eye-close"></i>');
  }
});
