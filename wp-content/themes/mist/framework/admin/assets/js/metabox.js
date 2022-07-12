jQuery.noConflict();
jQuery(document).ready(function($){

	$('.zozo-radio-img-img').click(function(){
		$(this).parent().parent().find('.zozo-radio-img-img').removeClass('zozo-radio-img-selected');
		$(this).addClass('zozo-radio-img-selected');
	});
	
	$('.zozo-radio-img-label, .zozo-radio-img-radio').hide();
	$('.zozo-radio-img-img').show();
	
	$('.zozo-meta-color').wpColorPicker();
	
	$('select.chosen-select').select2({placeholder: "Select Options", allowClear: true});
	var filters = new Array();
	$(".chosen-select").on("change", function(e) {
		if( filters.length === 0 ) {
			var filters_string = $(this).parent().find('.chosen-order').val();
			if( filters_string != '' ) {
				var filters_array = filters_string.split(',');				
				filters = new Array();	
				$.each(filters_array, function(i) {
					if( filters_array[i] != '' ) {						
						filters.push(filters_array[i]);	
					}
				});
			} else if( filters_string === null ) {
				filters = new Array();
			}			
			$(this).parent().find('.chosen-order').val('');			
		}
		
		if( e.val === null ) {
			$(this).parent().find('.chosen-order').val('');
			filters = new Array();
		}
				
		if( typeof e.added != "undefined" ) {
			var add_id = e.added.id;			
			filters.push(add_id);			
		}
		
		if( typeof e.removed != "undefined" ) {		
			var remove_id = e.removed.id;			
			var found = $.inArray(remove_id, filters);			
			if (found >= 0) {
				// Element was found, remove it.
				filters.splice(found, 1);
			}
		}
		
		$(this).parent().find('.chosen-order').val(filters);
		
	});
	
	$(".chosen-select").on("select2-removing", function(e) { 
		
		if( filters.length === 0 ) {
			var filters_string = $(this).parent().find('.chosen-order').val();
			if( filters_string != '' ) {
				var filters_array = filters_string.split(',');	
				filters = new Array();
				$.each(filters_array, function(i) {
					if( filters_array[i] != '' ) {						
						filters.push(filters_array[i]);						
					}
				});
			} else if( filters_string === null ) {
				filters = new Array();
			}
			$(this).parent().find('.chosen-order').val('');
		}
	});
	
	$(".chosen-select").on("select2-removed", function(e) {		
		
		var remove_id = e.choice.id;
		
		var found = $.inArray(remove_id, filters);		
		if (found >= 0) {
			// Element was found, remove it.
			filters.splice(found, 1);
		}
		$(this).parent().find('.chosen-order').val(filters);
	});
		
	// Uploader
	// Only show remove button when needed
	$('.zozo-meta-upload').each(function() {
		if ( ! $(this).val() ) {
			$(this).parent('.field-upload').find('.zozo_meta_remove_button').hide();
		}
	});

	// Uploading files
	var file_frame, upload_btn;

	$(document).on( 'click', '.zozo_meta_upload_button', function( event ){

		event.preventDefault();
		
		upload_btn = $(this);

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select image',
			button: {
				text: 'Upload image',
			},						
			multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();
			
			upload_btn.parent('.field-upload').find('.zozo-meta-upload').val( attachment.url );
			upload_btn.parent('.field-upload').find('.zozo_meta_remove_button').show();
					
		});
		
		// Finally, open the modal.
		if( file_frame ) {
			file_frame.open();
		}
		
	});

	$(document).on( 'click', '.zozo_meta_remove_button', function( event ){	
		$(this).parent('.field-upload').find('.zozo-meta-upload').val('');
		$(this).parent('.field-upload').find('.zozo_meta_remove_button').hide();		
		return false;
	});
	
	// Range Slider	
	$('.zozo-rangeslider').each(function() {
		
		var obj   		= $(this);
		var slider_id   = "#" + obj.data('id');
		var val   		= obj.data('val');
		var min_val		= obj.data('min');
		var max_val		= obj.data('max');
		var step  		= obj.data('step');
		
		//slider init
		obj.slider({
			value: val,
			min: min_val,
			max: max_val,
			step: step,
			range: "min",
			slide: function( event, ui ) {
				$(slider_id).val( ui.value );
			}
		});
		
	});
	
	// Tabs
	$('.zozo-page-tabs').each(function() {
		var obj = $(this);
		obj.tabs();
	});
	
	// Icon Selection
    $('.zozo-iconpicker i').on('click', function( event ) {
			
        event.preventDefault();		
		
		var fontName = $(this).attr('data-iconclass');
		
		 if($(this).hasClass('selected')) {
            $(this).removeClass('selected');
			$(this).parent().parent().find('input').attr('value', '');
        } else {
            $('.zozo-iconpicker i').removeClass('selected');
            $(this).addClass('selected');
			$(this).parent().parent().find('input').attr('value', fontName);
        }
		
		return false;
		        
    });
	
	$(document).on('click', '.zozo_portfolio_clone_section_add', function( event ) {
			event.stopImmediatePropagation();

			var column_template = $(event.target).closest('div.clone-portfolio-row').find('.portfolio-section.repeatable').clone(true);

			column_template.addClass('cloned');
			var column_count = $(this).closest('div.clone-portfolio-row').find('.portfolio-section.cloned').length + 1;
			var old_column_count = column_count - 1;
			
			column_template.find('input, select, textarea').each(function() {
				$(this).attr('name', this.name.replace('%r', column_count));
				if (typeof $(this).attr('id') !== typeof undefined && $(this).attr('id') !== false) {
					$(this).attr('id', this.id.replace('%r', column_count));
				}
				
				$(this).attr('name', this.name.replace(old_column_count, column_count));
				if (typeof $(this).attr('id') !== typeof undefined && $(this).attr('id') !== false) {
					$(this).attr('id', this.id.replace(old_column_count, column_count));
				}
			});
			
			$(this).closest('div.clone-portfolio-row').find('#zozo_portfolio_section_count').attr('value', column_count);
			column_template.insertBefore($(this).closest('div.clone-portfolio-row').find('.portfolio-section.repeatable')).fadeIn("slow");
			column_template.removeClass('repeatable');
			
			return false;
	});	
	
	$('.zozo_portfolio_clone_section_remove').on('click', function( event ) {
			event.preventDefault();
			
			old_column_count = $(this).parent('.cloned').closest('div.clone-portfolio-row').find('#zozo_portfolio_section_count').attr('value');
			$(this).parent('.cloned').closest('div.clone-portfolio-row').find('#zozo_portfolio_section_count').attr('value', old_column_count - 1 );
			$(this).parent('.cloned').remove();
			
			return false;
	});
	
});