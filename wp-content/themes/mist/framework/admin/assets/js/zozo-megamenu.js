/*
 * Zozo Megamenu Framework
 * 
 */

( function( $ ) {

	"use strict";
	
	var zozo_megamenu = {

		menu_item_move: function() {
			$(document).on( 'mouseup', '.menu-item-bar', function( event, ui ) {
				if( ! $(event.target).is('a') ) {
					setTimeout( zozo_megamenu.update_megamenu_fields, 200 );
				}
			});
		},

		update_megamenu_status: function() {

			$(document).on( 'click', '.edit-menu-item-zozo-megamenu-status', function() {
				var parent_menu_item = $( this ).parents( '.menu-item:eq(0)' );

				if( $( this ).is( ':checked' ) ) {
					parent_menu_item.addClass( 'zozo-megamenu-active' );
				} else 	{
					parent_menu_item.removeClass( 'zozo-megamenu-active' );
				}

				zozo_megamenu.update_megamenu_fields();
			});
		},

		update_megamenu_fields: function() {
			var menu_items = $( '.menu-item');

			menu_items.each( function( i ) 	{

				var zozo_megamenu_status = $( '.edit-menu-item-zozo-megamenu-status', this );

				if( ! $(this).is( '.menu-item-depth-0' ) ) {
					var check_against = menu_items.filter( ':eq('+(i-1)+')' );

					if( check_against.is( '.zozo-megamenu-active' ) ) {

						zozo_megamenu_status.attr( 'checked', 'checked' );
						$(this).addClass( 'zozo-megamenu-active' );
					} else {
						zozo_megamenu_status.attr( 'checked', '' );
						$(this).removeClass( 'zozo-megamenu-active' );
					}
				} else {
					if( zozo_megamenu_status.attr( 'checked' ) ) {
						$(this).addClass( 'zozo-megamenu-active' );
					}
				}
			});
		}

	};
	
	$(document).ready(function(){
	
		zozo_megamenu.menu_item_move();
		zozo_megamenu.update_megamenu_status();
		zozo_megamenu.update_megamenu_fields();
		
	});
	
})( jQuery );