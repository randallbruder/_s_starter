/**
 * File site.js.
 *
 */

jQuery(document).ready(function($) {
	
	// Check all links for external URLs
    $('a').each(function() {
		var a = new RegExp('/' + window.location.host + '/');
		if (!a.test(this.href)) {
			$(this).addClass("external-link");
		}
    });
	
});