/*================ 
CARRIERS PAGE
=================*/

$(document).ready(function($){
	/*================ PHONE NUMBER INPUT MASK =================*/
	
	/*$("#pNumber").mask("(999) 999-9999");
	$("#cPNumber").mask("(999) 999-9999");*/

	$('input[name="phone_number"]').mask('(000) 000-0000');
	$('input[name="confirm_phone_number"]').mask('(000) 000-0000');

	$( "#cPNumber" ).keyup(function() {
		var pNumber = $("#pNumber").val();
		var cPNumber = $("#cPNumber").val();
		if (pNumber != cPNumber) {
			//alert("Passwords do not match.");
			$("#pno-message").html("Phone Number doesn't match");
			$('#addRecharge').prop('disabled', 'disabled');
			return false;
		}
		$("#pno-message").html("");
		$('#addRecharge').prop('disabled', false);  
		return true;
		//alert("Passwords do not match.");
	});

	/*================ RESET MODAL FORMS WHEN CLOSING =================*/
	$('#rechargeModal').on('hidden.bs.modal', function (e) {
		$(this)
		  .find("input,textarea,select")
			 .val('')
			 .end()
		  .find("input[type=checkbox], input[type=radio]")
			 .prop("checked", "")
			 .end();
	});
});


/*================ 
CARTS PAGE
=================*/

/*================  RESPONSIVE TABLE ================*/
$(document).ready(function(){
	$('.js-table-data td').each(function(){
	  var tdIndex = $(this).index();
	  if ($('tr').find('th').eq(tdIndex).attr('data-label')) {
		var thText = $('tr').find('th').eq(tdIndex).data('label');
	  } else {
		var thText = $('tr').find('th').eq(tdIndex).text();
	  }
	  $(this).attr('data-label', thText + '');
	});
});

$(document).ready(function(){
	var link = $("#to-toggle");
	$("#toggle").on("change", function() {
		if(this.checked) {
			link.attr("href", link.data("href"));
			$('#to-toggle').removeClass("disabled");
		} else {
			link.removeAttr("href");
			$('#to-toggle').addClass("disabled");
		}
	});
});

$(document).ready(function(){
	$("#successMessageAddToCart").delay(2000).slideUp(800);
	$("#successMessageCart").delay(2000).slideUp(800);
	$("#successMessageDeleteCart").delay(2000).slideUp(800);	
});

/*================ 
ACCOUNTS PAGE
=================*/

$(document).ready(function(){
	$('input[name="customer_phone_number"]').mask('(000) 000-0000');
});



/*================ SHOW ITEM MODAL BOX IF USER LOGGED IN =================*/

/*================ SHOW ORDER SIM PAGE WHEN USER CLICKS ON ORDER SIM IMAGE IF USER LOGGED IN =================*/

/*================ REGISTRATION FORM =================*/

/*================ LOGIN FORM WHEN IMAGE IS CLICKED =================*/

/*================ LOGIN FORM WHEN HEADER LINK IS CLICKED =================*/

//logout function

/* contact_form validation */

/* forget pw validation*/

/*================ RESET PASSWORD FORM =================*/

/*================ ORDER SIM FORM =================*/

/*================ SIM SHIPPING DETAILS FORM =================*/

/*================ MY ACCOUNT FORM =================*/

/*================  EMPTY CART FUNCTION ================*/

/* Disable Right Click / Copy / Paste in your Website */

$('document').ready(function()
{

	/*var isNS = (navigator.appName == "Netscape") ? 1 : 0;
	  if(navigator.appName == "Netscape")
	     document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);
	  function mischandler(){
	   return false;
	 }
	  function mousehandler(e){
	     var myevent = (isNS) ? e : event;
	     var eventbutton = (isNS) ? myevent.which : myevent.button;
	    if((eventbutton==2)||(eventbutton==3)) return false;
	 }
	 document.oncontextmenu = mischandler;
	 document.onmousedown = mousehandler;
	 document.onmouseup = mousehandler;
	function killCopy(e){
	    return false
	}
	function reEnable(){
	    return true
	}
	document.onselectstart = new Function ("return false")
	if (window.sidebar){
	    document.onmousedown=killCopy
	    document.onclick=reEnable
	}*/
	
	
	//disable textbox copy paste
	/*$('#email').bind("cut copy paste",function(e) {
	     e.preventDefault();
	 });*/
	
});