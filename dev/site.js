/**
 * File site.js.
 *
 */

jQuery(document).ready(function($) {
	
	/**
	 * Better viewport units that aren't affected by mobile browsers' hiding address bars or desktop browsers' vertical scroll bars
	 * @link https://css-tricks.com/the-trick-to-viewport-units-on-mobile/
	 * @link https://destroytoday.com/blog/100vw-and-the-horizontal-overflow-you-probably-didnt-know-about
	 * 
	 * Usage:
	 * .my-element {
	 * 		height: 100vh; // Fallback for browsers that do not support Custom Properties
	 * 		height: calc(var(--vh, 1vh) * 100);
	 * }
	 *
	 */
	// First we get the viewport height and width and we multiple it by 1% to get a value for a vh unit
	var vh = window.innerHeight * 0.01;
	var vw = $(window).width() * 0.01; // Using $(window).width() ensures the scrollbar isn't included in the --vw value
	
	// Then we set the value in the --vh and --vw custom property to the root of the document
	$("body").get(0).style.setProperty("--vh", vh + "px");
	$("body").get(0).style.setProperty("--vw", vw + "px");
	
	// We listen to the resize event
	$(window).resize(function(){
		var vh = window.innerHeight * 0.01;
		var vw = $(window).width() * 0.01;
		$("body").get(0).style.setProperty("--vh", vh + "px");
		$("body").get(0).style.setProperty("--vw", vw + "px");
	});
	
	
	/**
	 * Check all links for external URLs
	 */
	$('a').each(function() {
		var a = new RegExp('/' + window.location.host + '/');
		if (!a.test(this.href)) {
			// Make all links to other websites open in a new tab
			// and add an external-link class to optionally style external links differently (like with a "external" symbol after the link)
			$(this).addClass("external-link").attr('target','_blank');
		}
	});

});