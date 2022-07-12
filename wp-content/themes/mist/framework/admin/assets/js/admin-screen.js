/*
 * Admin Screen
 * 
 */

( function( $ ) {
	"use strict";
	
	var zozo_admin_screen = {

		install_demos: function() {
			$(document).on( 'click', '.button-install-demo', function(e) {
				e.preventDefault();
				
				var choosed_demo 	= $(this).data('demo-id');
				var woo_demo 		= $(this).data('demo-woo');
				var sidebar 		= $(this).data('demo-sidebar');
				var rev_slider 		= $(this).data('demo-revslider');
				var loading_wrap 	= $('.zozo-preview-' + choosed_demo);
				var requirement 	= $(this).parents('.demo-inner').find('.theme-requirements').data('requirements');
				var security 		= $("#mist_demo_import_nonce").val();
				
				if( choosed_demo !== null ) {
					
					$.confirm({
						theme: 'supervan',
						title: false,
						content: requirement,
						confirmButtonClass: 'btn-success',
    					cancelButtonClass: 'btn-danger',
						confirm: function(){
							loading_wrap.show();
																		
							$('.zozo-importer-notice').hide();
							
							$.ajax({
								type: 'POST',
								url: ajaxurl,
								data: {
									action: 'zozo_import_demo_data',
									demo_type: choosed_demo,
									woo_demo: woo_demo,
									rev_slider: rev_slider,
									nonce: security
								},
								success: function(response){
									if( response && response.indexOf('imported') == -1 ) {
										$('.importer-notice-error').attr('style', 'display:block !important');
									} else {
										$('.importer-notice-success').attr('style', 'display:block !important');
									}
									loading_wrap.hide();
								},
								error: function(){
									$('.importer-notice-error').attr('style', 'display:block !important');
									loading_wrap.hide();
								}
							});
						},
						cancel: function(){}
					});
					
				}
				
			});
		},
		
	};
	
	$(document).ready(function(){
	
		zozo_admin_screen.install_demos();
		
	});
	
})( jQuery );