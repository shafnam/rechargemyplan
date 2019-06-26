/** 
 * ===================================================================
 * main js
 *
 * ------------------------------------------------------------------- 
 */ 

$('document').ready(function()
{
	"use strict"; //Defines that JavaScript code should be executed in "strict mode".

	/*----------------------------------------------------*/
	/*	Sticky Navigation
	------------------------------------------------------*/
	$(window).on('scroll', function() {

		var y = $(window).scrollTop(),
		    topBar = $('header');
     
	   if (y > 1) {
	      topBar.addClass('sticky');
	   }
      else {
         topBar.removeClass('sticky');
      }
    
	});

	/*-----------------------------------------------------*/
  	/* Mobile Menu
   	------------------------------------------------------ */  
	var toggleButton = $('.menu-toggle'),
       nav = $('.main-navigation'),
	   subNav = $('.sub-navigation');

	toggleButton.on('click', function(event){
		event.preventDefault();

		toggleButton.toggleClass('is-clicked');
		nav.slideToggle();
		subNav.slideToggle();
	});

  	if (toggleButton.is(':visible')) 
	{
		nav.addClass('mobile');
		subNav.addClass('mobile');
	}

  	$(window).resize(function() {
		if (toggleButton.is(':visible')){
			nav.addClass('mobile');
			subNav.addClass('mobile');
		} 
		else {
			nav.removeClass('mobile');
			subNav.removeClass('mobile');
		} 
  	});

  	$('#main-nav-wrap li a').on("click", function() {   

		if (nav.hasClass('mobile')) {   		
			toggleButton.toggleClass('is-clicked'); 
			nav.fadeOut();   		
		} 
		if (subNav.hasClass('mobile')) {   		
			toggleButton.toggleClass('is-clicked'); 
			subNav.fadeOut();   		
		}		
	});
	  
	/*----------------------------------------------------*/
  	/* Highlight the current section in the navigation bar
  	------------------------------------------------------*/
	var sections = $("section"),
	navigation_links = $("#main-nav-wrap li a");	

	sections.waypoint( {

		handler: function(direction) {

			var active_section;

			active_section = $('section#' + this.element.id);

			if (direction === "up") active_section = active_section.prev();

			var active_link = $('#main-nav-wrap a[href="#' + active_section.attr("id") + '"]');			

		navigation_links.parent().removeClass("current");
			active_link.parent().addClass("current");

		}, 

		offset: '25%'

	});

	/*----------------------------------------------------*/
  	/* Smooth Scrolling
  	------------------------------------------------------*/
  	$('.smoothscroll').on('click', function (e) {
	 	
		e.preventDefault();

	  	var target = this.hash,
	   	$target = $(target);

	   	$('html, body').stop().animate({
		  	'scrollTop': $target.offset().top
	 	}, 800, 'swing', function () {
		 	window.location.hash = target;
	 	});

	});  

	/*----------------------------------------------------*/
	/*  Placeholder Plugin Settings
	------------------------------------------------------*/ 
	$('input, textarea, select').placeholder()  

	/*----------------------------------------------------- */
  	/* Back to top
  	------------------------------------------------------- */ 
	var pxShow = 300; // height on which the button will show
	var fadeInTime = 400; // how slow/fast you want the button to show
	var fadeOutTime = 400; // how slow/fast you want the button to hide
	var scrollSpeed = 300; // how slow/fast you want the button to scroll to top. can be a value, 'slow', 'normal' or 'fast'

	// Show or hide the sticky footer button
	jQuery(window).scroll(function() {

		if (!( $("#header-search").hasClass('is-visible'))) {

			if (jQuery(window).scrollTop() >= pxShow) {
				jQuery("#go-top").fadeIn(fadeInTime);
			} else {
				jQuery("#go-top").fadeOut(fadeOutTime);
			}

		}		

	});		


});