(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
	var eventer = window[eventMethod];
	var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

	eventer(messageEvent,function(e) {
		try {
			var event = JSON.parse(e.data);
		}catch(e){

		}

		console.log(event);

		if(event.event == 'resize'){
			document.getElementById('frame').style.height = event.height + 'px';
		}

		if(event.event == 'select_account'){
			document.getElementById('planfy_account_id').value = event.account.id || event.account.account_id;
			document.getElementById('planfy_account_url').value = event.account.url;
			document.getElementById('planfy_account_name').value = event.account.name;
			document.getElementById('planfy_install_form').submit();
		}
	},false);

})( jQuery );
