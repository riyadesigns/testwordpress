<?php 
/**
 * Register field types for metaboxes
 *
 * @package Zozothemes
 */
 
class ZozoMetaboxFields { 
	
	public function render_fields( $fields ) 
	{
	
		global $post;
		
		foreach ( $fields as $field ) {

			switch ( $field['type'] ) {
			
				case 'tabs_open':					
					echo '<div class="zozo-page-tabs">';
				break;
				
				case 'tabs_close':					
					echo '</div>';
				break;
				
				case 'tabs_list':
					echo '<ul class="zozo-page-tabs-list">';
					if( !empty( $field['tabs'] ) ) {
						foreach( $field['tabs'] as $key => $tab_name ) {
							echo '<li class="tab-item"><a href="#tab-'. esc_attr( $key ) .'">'. esc_attr( $tab_name ) .'</a></li>';
						}
					}
					echo '</ul>';
				break;
				
				case 'tab_open':
					echo '<div id="'. esc_attr( $field['id'] ) .'" class="zozo-page-meta-tab">';
				break;
				
				case 'tab_close':
					echo '</div>';
				break;
			
				case 'title':					
					echo '<h1 class="zozo-field-title">';
					echo esc_attr( $field['name'] );
					echo '</h1>';
					if( isset( $field['desc'] ) && $field['desc'] != '' ) {
						echo '<p class="description">' . $field['desc'] . '</p>';
					}
					echo '<hr>';
					
				break;
				
				case 'sub_title':					
					echo '<h2 class="zozo-field-sub-title">';
					echo esc_attr( $field['name'] );
					echo '</h2>';
					
				break;
				
				case 'button':					
					echo '<a href="#" class="'.$field['id'].' button-primary">';
					echo esc_attr( $field['name'] );
					echo '</a>';
					 
				break;
			
				case 'text':
					$value = get_post_meta($post->ID, $field['id'], true);
					
					echo '<div class="zozo_metabox_field">';
					
						echo '<label for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-text fields">';
						echo '<input type="text" id="' . $field['id'] . '" name="' . $field['id'] . '" value="' . esc_attr( $value ) . '" />';
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
						echo '</div>';
						
					echo '</div>';
					 
				break;
					
				case 'textarea':
					$value = get_post_meta($post->ID, $field['id'], true);
					
					echo '<div class="zozo_metabox_field">';
					
						echo '<label for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-textarea fields">';
						echo '<textarea cols="70" rows="6" id="' . $field['id'] . '" name="' . $field['id'] . '">' . esc_attr( $value ) . '</textarea>';
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
						echo '</div>';
						
					echo '</div>';
					
				break;
					
				case 'images':
				
					$i = 0;
					$selected_value = '';					
					$format = '';
					
					$selected_value = get_post_meta($post->ID, $field['id'], true);
	
					foreach( $field['options'] as $key => $option ) {
						
						 $i++;
	
						 $checked = '';
						 $selected = '';
						 
						 if( $selected_value != '' ) {
							if( '' != checked($selected_value, $key, false)) {
								$checked = checked($selected_value, $key, false);
								$selected = 'zozo-radio-img-selected'; 
							}
						}
						
						$format .= '<span>'; 
						$format .= '<input type="radio" id="zozo-radio-img-' . $field['id'] . $i . '" class="checkbox zozo-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . $field['id'] . '" ' . $checked . ' />';
						$format .= '<div class="zozo-radio-img-label">'. esc_attr( $key ) .'</div>';
						$format .= '<img src="' . esc_url( $option ) . '" alt="'. esc_attr( $key ) .'" class="zozo-radio-img-img '. $selected .'" onClick="document.getElementById(\'zozo-radio-img-'. $field['id'] . $i.'\').checked = true;" />';
						$format .= '</span>';
					
					}
					
					echo '<div class="zozo_metabox_field">';
						
						echo '<label class="radio" for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-images fields">' . $format .'';
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
						echo '</div>';
							
					echo '</div>';
					
				break;
					
				case 'select':
				
					$selected_value = '';
				
					$selected_value = get_post_meta($post->ID, $field['id'], true);
					
					echo '<div class="select_wrapper zozo_metabox_field">';
					
						echo '<label class="select" for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-select fields">';							
						echo '<select class="select-box" name="'.$field['id'].'" id="'. $field['id'] .'">';
						
						if( isset( $field['options'] ) ) {

							foreach( $field['options'] as $select_id => $option ) { 
								//$value = $option;
								
								//if (!is_numeric($select_id))
									$value = $select_id;
									
								echo '<option id="' . $select_id . '" value="'.$value.'" ' . selected($selected_value, $value, false) . ' />'.$option.'</option>';
							}
						
						}
						echo '</select>';
						
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
					
					echo '</div></div>';
					
				break;
				
				case 'multiselect':
				
					$selected_value = '';					
					
					echo '<div class="multiselect_wrapper zozo_metabox_field">';
					
						echo '<label class="multi-select" for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-multiselect fields">';							
						echo '<select multiple="multiple" class="multiselect-box" name="'.$field['id'].'[]" id="'. $field['id'] .'[]">';
						
						if( isset( $field['options'] ) ) { 

							foreach( $field['options'] as $select_id => $option ) { 
															
								if( is_array(get_post_meta($post->ID, $field['id'], true)) && in_array($select_id, get_post_meta($post->ID, $field['id'], true)) ) {
									$selected_value = $select_id;
								}
									
								echo '<option id="' . $select_id . '" value="'.$select_id.'" ' . selected($selected_value, $select_id, false) . ' />'.$option.'</option>';
							}
						
						}
						echo '</select>';
						
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
					
					echo '</div></div>';
					
				break;
				
				case 'chosen':
				
					$selected_value = '';
					
					echo '<div class="chosen_select_wrapper zozo_metabox_field">';
					
						echo '<label class="chosen-select" for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-chosen fields">';							
						echo '<select class="chosen-select" multiple="multiple" style="width:350px;" name="'.$field['id'].'[]" id="'. $field['id'] .'[]">';
						
						echo '<option></option>';
						
						if( isset( $field['options'] ) ) {

							foreach( $field['options'] as $select_id => $option ) { 
							
								if( is_array(get_post_meta($post->ID, $field['id'], true)) && in_array($select_id, get_post_meta($post->ID, $field['id'], true)) ) {
									$selected_value = $select_id;
								}							
									
								echo '<option id="' . $select_id . '" value="'.$select_id.'" ' . selected($selected_value, $select_id, false) . ' >'.$option.'</option>';
							}
						
						}
						echo '</select>';
						
						echo '<input type="hidden" name="'.$field['id'].'[]" id="'.$field['id'].'[]" value="-1" />';
						
						echo '<input type="hidden" class="chosen-order" name="' . $field['hidden_id'] . '" id="' . $field['hidden_id'] . '" value="'.get_post_meta($post->ID, $field['hidden_id'], true).'" />';
						
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
					
					echo '</div></div>';
					
				break;
				
				case 'media':
					$value = get_post_meta($post->ID, $field['id'], true);
				
					echo '<div class="zozo_metabox_field">';
					
						echo '<label for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-upload fields">';						
						echo '<input type="text" class="zozo-meta-upload media_field" id="' . $field['id'] . '" name="' . $field['id'] . '" value="' . esc_attr( $value ) . '" />';
						echo '<button type="button" class="zozo_meta_upload_button btn">'. __( 'Upload', 'mist' ) .'</button>';
						echo '<button type="button" class="zozo_meta_remove_button btn">'. __( 'Remove', 'mist' ) .'</button>';
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
						echo '</div>';
						
					echo '</div>';
					 
				break;
				
				case 'color':
					$value = get_post_meta($post->ID, $field['id'], true);
					
					echo '<div class="zozo_metabox_field">';
					
						echo '<label for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-color fields">';
						echo '<input type="text" class="zozo-meta-color" id="' . $field['id'] . '" name="' . $field['id'] . '" value="' . esc_attr( $value ) . '" />';
						
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
						echo '</div>';
						
					echo '</div>';
		 	
				break;
								
				case 'checkbox':
					
					$value = get_post_meta($post->ID, $field['id'], true);
					if( !$value ) {
						$value = 0;
					}
					
					echo '<div class="zozo_metabox_field">';
					
						echo '<label for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-checkbox fields">';				
						
						echo '<input type="hidden" class="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '" value="0" />';
						echo '<input type="checkbox" class="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '" value="1" '. checked($value, 1, false) .' />';
						
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
						echo '</div>';
						
					echo '</div>';
															
				break;
				
				case 'editor':
					
					$value = get_post_meta($post->ID, $field['id'], true);
					if( ! $value ) {
						$value = '';
					}
					
					echo '<div class="zozo_metabox_field">';
					
						echo '<label for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-editor fields">';
						
						wp_editor( $value, $field['id'], array( 'textarea_rows' => 8 ) );						
						
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
						echo '</div>';
						
					echo '</div>';
															
				break;
				
				case 'iconpicker':
					
					$value = get_post_meta($post->ID, $field['id'], true);
										
					echo '<div class="zozo_metabox_field">';
						
						echo '<label for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-iconpicker fields">';	
							echo '<div class="zozo-iconpicker">';
							foreach( $field['options'] as $select_id => $option ) {
								$class = '';
								if( $value == $select_id ) {
									$class = "selected";
								}
								echo '<i class="fa ' . $select_id . ' icon-tooltip ' . $class . '" data-toggle="tooltip" data-placement="top" data-iconclass="' . $select_id . '" title="' . $select_id . '"></i>';
							}
							echo '</div>';	
							echo '<input type="hidden" class="zozo-form-text zozo-input" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $value . '" />' . "\n";
						
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
						echo '</div>';
					echo '</div>';
					
				break;
				
				case 'lineiconpicker':
					
					$value = get_post_meta($post->ID, $field['id'], true);
									
					echo '<div class="zozo_metabox_field">';
						
						echo '<label for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-iconpicker fields">';	
							echo '<div class="zozo-iconpicker line-icons">';
							foreach( $field['options'] as $select_id => $option ) {
								$class = '';
								if( $value == $select_id ) {
									$class = "selected";
								}
								echo '<i class="simple-icon ' . $select_id . ' icon-tooltip ' . $class . '" data-toggle="tooltip" data-placement="top" data-iconclass="' . $select_id . '" title="' . $select_id . '"></i>';
							}
							echo '</div>';	
							echo '<input type="hidden" class="zozo-form-text zozo-input" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $value . '" />' . "\n";
						
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
						echo '</div>';
					echo '</div>';
					
				break;
								
				case 'icomoonpicker':
					
					$value = get_post_meta($post->ID, $field['id'], true);
									
					echo '<div class="zozo_metabox_field">';
						
						echo '<label for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-iconpicker fields">';	
							echo '<div class="zozo-iconpicker icomoon-icons">';
							foreach( $field['options'] as $select_id => $option ) {
								$class = '';
								if( $value == $select_id ) {
									$class = "selected";
								}
								echo '<i class="' . $select_id . ' icon-tooltip ' . $class . '" data-toggle="tooltip" data-placement="top" data-iconclass="' . $select_id . '" title="' . $option . '"></i>';
							}
							echo '</div>';	
							echo '<input type="hidden" class="zozo-form-text zozo-input" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $value . '" />' . "\n";
						
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
						echo '</div>';
					echo '</div>';					

				break;
				
				case 'slider':
				
					$value = $min = $max = $step = $edit = $slider_data = '';
					
					$value = get_post_meta($post->ID, $field['id'], true);
					
					if(!isset($field['min'])) { $min  = '0'; } else { $min = $field['min']; }
					if(!isset($field['max'])) { $max  = $min + 1; } else { $max = $field['max']; }
					if(!isset($field['step'])) { $step  = '1'; } else { $step = $field['step']; }
										
					$edit = ' readonly="readonly"'; 
					
					if($value == '') {
						$value = $min;
					}
					
					//values
					$slider_data = 'data-id="'.$field['id'].'" data-val="'.$value.'" data-min="'.$min.'" data-max="'.$max.'" data-step="'.$step.'"';
					
					echo '<div class="zozo_metabox_field">';
					
						echo '<label for="' . $field['id'] . '">';
						echo esc_attr( $field['name'] );
						echo '</label>';
						
						echo '<div class="field-sliderui fields">';				
						
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'. $value .'" class="zozo-slider-text" '. $edit .' />';
						echo '<div id="'.$field['id'].'-slider" class="zozo-rangeslider" '. $slider_data .'></div>';
						
						if( isset( $field['desc'] ) && $field['desc'] != '' ) {
							echo '<p class="description">' . $field['desc'] . '</p>';
						}
						echo '</div>';
						
					echo '</div>';
					
				break;
					
			} // End Switch Statement
			
		} // End foreach
	
	}
		
	public function zozo_get_sidebar() 
	{
		global $wp_registered_sidebars;
		$sidebar_options[0] = "Default";
       // for( $i=0; $i<1; $i++ ){
            $sidebars = $wp_registered_sidebars;
         
            if(is_array($sidebars) && !empty($sidebars)){
                foreach($sidebars as $sidebar){
                    $sidebar_options[$sidebar['id']] = $sidebar['name'];
                }
            }
       // }
		
		return $sidebar_options;
	}
	
	public function zozo_get_fontawesome()
	{
		// Fontawesome icons list
		$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$fontawesome_path = ZOZOTHEME_URL . '/css/font-awesome.css';
		$subject = wp_remote_retrieve_body( wp_remote_get($fontawesome_path) );
		
		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
		
		$icons = array();
		
		foreach($matches as $match){
			$icons[$match[1]] = $match[2];
		}
				
		return $icons;
	}
	
	public function zozo_get_simplelineicon()
	{
		// Fontawesome icons list
		$pattern = '/\.(icon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$simplelineicons_path = ZOZO_ADMIN_ASSETS . 'css/simple-line-icons.css';
		$subject = wp_remote_retrieve_body( wp_remote_get($simplelineicons_path) );
		
		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
		
		$line_icons = array();
		
		foreach($matches as $match){
			$line_icons[$match[1]] = $match[2];
		}
				
		return $line_icons;
	}
	
	public function zozo_get_taxonomy_term_list($taxonomy, $post_type, $msg) 
	{
		$list_groups = get_categories('taxonomy='.$taxonomy.'&post_type='.$post_type.'');
		$groups_list[0] = $msg;
		if( !empty($list_groups) ) {
			foreach ($list_groups as $groups) {
				$group_name = $groups->name;
				$termid = $groups->term_id;		
				$groups_list[$termid] = $group_name;
			}
		}
	
		if( isset($groups_list) ) {
			return $groups_list;
		}
		
	}
	
	public function zozo_get_posts_list($post_type) 
	{
		$list_posts = get_posts(array('post_type' => $post_type, 'numberposts' => -1));
		$posts_list = array();
		if( !empty($list_posts) ) {
			foreach ($list_posts as $item) {					
				$posts_list[$item->ID] = $item->post_title;
			}
		}
	
		if( isset($posts_list) ) {
			return $posts_list;
		}
		
	}
	
	public function zozo_get_menus() 
	{
		$menu_list = array();
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		$menu_list['default'] = 'Default Menu';
		foreach( $menus as $menu ) {
			$menu_list[$menu->slug] = $menu->name;
		}
		
		return $menu_list;
	
	}
	
	// Add Post Options fields
	public function render_post_fields() 
	{
		$prefix = 'zozo_';
		$url =  ZOZO_ADMIN_ASSETS . 'images/';
		
		$tabs_names = array(
			'post' 				=> __( 'Post', 'mist' ),
			'page' 				=> __( 'Page', 'mist' ),
			'slider' 			=> __( 'Slider', 'mist' ),
			'header'			=> __( 'Header', 'mist' ),
			'footer'			=> __( 'Footer', 'mist' ),
			'sidebar' 			=> __( 'Sidebar', 'mist' ),
			'pagetitlebar' 		=> __( 'Page Title Bar', 'mist' ),
			'background' 		=> __( 'Background', 'mist' ),
		);
		
		$fields = array(
		
			array(
				'type'		=> 'tabs_open'
			),
			
			array(
				'tabs'		=> $tabs_names,
				'type'		=> 'tabs_list',
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-post',
			),
			
			array(
				'name'		=> __( 'Video Embed Code', 'mist' ),
				'id'		=> $prefix . 'single_video_code',
				'desc'		=> 'Insert Youtube or Vimeo embed code. Videos will show only for Video Post Format.',
				'type'		=> 'textarea'
			),
			
			array(
				'name'		=> __( 'Audio Embed Code', 'mist' ),
				'id'		=> $prefix . 'single_audio_code',
				'desc'		=> 'Insert audio embed code. Audios will show only for Audio Post Format.',
				'type'		=> 'textarea'
			),
			
			array(
				'name'		=> __( 'External Link URL', 'mist' ),
				'id'		=> $prefix . 'external_link_url',
				'desc'		=> 'Insert External Link URL if Post Format is Link.',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Gallery Images', 'mist' ),
				'id'		=> $prefix . 'gallery_images_type',
				'desc'		=> __('Choose to show images as slider or carousel only for Gallery Post Format.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'slider' 	=> 'Slider',
								'carousel' 	=> 'Carousel'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Show Social Sharing', 'mist' ),
				'id'		=> $prefix . 'show_social_sharing',
				'desc'		=> __('Choose to show or hide the social sharing.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'show' 		=> 'Show',
								'hide' 		=> 'Hide'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Show Author Info', 'mist' ),
				'id'		=> $prefix . 'show_author_info',
				'desc'		=> __('Choose to show or hide the author info.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'show' 		=> 'Show',
								'hide' 		=> 'Hide'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Show Comments', 'mist' ),
				'id'		=> $prefix . 'show_comments',
				'desc'		=> __('Choose to show or hide comments.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'show' 		=> 'Show',
								'hide' 		=> 'Hide'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Show Related Posts', 'mist' ),
				'id'		=> $prefix . 'show_related_posts',
				'desc'		=> __('Choose to show or hide related posts.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'show' 		=> 'Show',
								'hide' 		=> 'Hide'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Show Previous/Next Pagination', 'mist' ),
				'id'		=> $prefix . 'show_post_navigation',
				'desc'		=> __('Choose to show or hide post navigation.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'show' 		=> 'Show',
								'hide' 		=> 'Hide'
							),
				'type'		=> 'select'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-page',
			),
			
			array(
				'name'		=> __( 'Page Layout', 'mist' ),
				'id'		=> $prefix . 'theme_layout',
				'options' 	=> array(
							'fullwidth' 	=> $url . 'layouts/full-width.jpg',
							'boxed' 		=> $url . 'layouts/boxed.jpg',
							'wide' 			=> $url . 'layouts/wide.jpg',
							),
				'type'		=> 'images',
			),
		
			array(
				'name'		=> __( 'Column Layouts', 'mist' ),
				'id'		=> $prefix . 'layout',
				'options' 	=> array(
							'one-col' 			=> $url . 'one-col.png',
							'two-col-right' 	=> $url . 'two-col-right.png',
							'two-col-left' 		=> $url . 'two-col-left.png',
							'three-col-middle' 	=> $url . 'three-col-middle.png',
							'three-col-right' 	=> $url . 'three-col-right.png',
							'three-col-left' 	=> $url . 'three-col-left.png'
							),
				'type'		=> 'images',
			),
			
			array(
				'name'		=> __( 'Page Content Top Padding', 'mist' ),
				'id'		=> $prefix . 'page_top_padding',
				'desc'		=> __('Enter page top content padding. In pixels ex: 30px. Leave empty for default value.', 'mist'),
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Page Content Bottom Padding', 'mist' ),
				'id'		=> $prefix . 'page_bottom_padding',
				'desc'		=> __('Enter page bottom content padding. In pixels ex: 30px. Leave empty for default value.', 'mist'),
				'type'		=> 'text'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-slider',
			),
			
			array(
				'name'		=> __( 'Slider Position', 'mist' ),
				'id'		=> $prefix . 'slider_position',
				'desc'		=> __('Select if the slider shows below or above the header.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'below' 	=> 'Below Header',
								'above' 	=> 'Above Header'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Revolution Slider Shortcode', 'mist' ),
				'id'		=> $prefix . 'revolutionslider',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-header',
			),
			
			array(
				'name'		=> __( 'Display Header', 'mist' ),
				'id'		=> $prefix . 'show_header',
				'desc'		=> __('Choose to show or hide the header.', 'mist'),
				'options' 	=> array(
								'yes' 	=> 'Yes',
								'no' 	=> 'No'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Display Header Top Bar', 'mist' ),
				'id'		=> $prefix . 'show_header_top_bar',
				'desc'		=> __('Choose to show or hide the header top bar.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'yes' 		=> 'Yes',
								'no' 		=> 'No'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Header Layout', 'mist' ),
				'id'		=> $prefix . 'header_layout',
				'desc'		=> __('Choose header layout.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'fullwidth'	=> 'Full Width',
								'boxed'		=> 'Boxed'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Header Transparency', 'mist' ),
				'id'		=> $prefix . 'header_transparency',
				'desc'		=> __('Choose header Transparency.', 'mist'),
				'options' 	=> array(
								'default' 			=> 'Default',
								'no-transparent'	=> 'No Transparency',
								'transparent'		=> 'Transparent',
								'semi-transparent'	=> 'Semi Transparent',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Main Navigation Menu', 'mist' ),
				'id'		=> $prefix . 'custom_nav_menu',
				'desc'		=> __('Choose which menu displays on this page.', 'mist'),
				'options' 	=> $this->zozo_get_menus(),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Background Image', 'mist' ),
				'id'		=> $prefix . 'header_bg_image',
				'desc'		=> '',
				'type'		=> 'media'
			),
			
			array(
				'name'		=> __( 'Background Color', 'mist' ),
				'id'		=> $prefix . 'header_bg_color',
				'desc'		=> '',
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Background Color Opacity', 'mist' ),
				'id'		=> $prefix . 'header_bg_opacity',
				'desc'		=> '',
				'min'		=> '0',
				'max' 		=> '1',
				'step' 		=> '0.1',
				'type'		=> 'slider',
			),
			
			array(
				'name'		=> __( 'Background Repeat', 'mist' ),
				'id'		=> $prefix . 'header_bg_repeat',
				'desc'		=> '',
				'options' 	=> array(
								'' 			=> 'Default',
								'repeat'	=> 'Repeat',
								'repeat-x'	=> 'Repeat-x',
								'repeat-y'	=> 'Repeat-y',
								'no-repeat' => 'No Repeat'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Background Attachment', 'mist' ),
				'id'		=> $prefix . 'header_bg_attachment',
				'desc'		=> '',
				'options' 	=> array(
								'' 			=> 'Default',
								'scroll'	=> 'Scroll',
								'fixed'		=> 'Fixed',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Background Position', 'mist' ),
				'id'		=> $prefix . 'header_bg_postion',
				'desc'		=> '',
				'options' 	=> array(
								'' 				=> 'Default',
								'left top' 		=> 'Left Top',
								'left center' 	=> 'Left Center',
								'left bottom' 	=> 'Left Bottom',
								'center top' 	=> 'Center Top',
								'center center' => 'Center Center',
								'center bottom' => 'Center Bottom',
								'right top' 	=> 'Right Top',
								'right center' 	=> 'Right Center',
								'right bottom' 	=> 'Right Bottom',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( '100% Scale Background Image', 'mist' ),				
				'id'		=> $prefix . 'header_bg_full',
				'desc'		=> '',
				'std' 		=> 0,				
				'type'		=> 'checkbox'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-footer',
			),
			
			array(
				'name'		=> __( 'Display Footer Widget Area', 'mist' ),				
				'id'		=> $prefix . 'show_footer_widgets',
				'desc'		=> __('Choose to show or hide the footer widget area.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'yes' 		=> 'Yes',
								'no' 		=> 'No'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Display Footer Menu', 'mist' ),				
				'id'		=> $prefix . 'show_footer_menu',
				'desc'		=> __('Choose to show or hide the footer menu.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'yes' 		=> 'Yes',
								'no' 		=> 'No'
							),
				'type'		=> 'select'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-sidebar',
			),
			
			array(
				'name'		=> __( 'Select Sidebar 1', 'mist' ),				
				'id'		=> $prefix . 'primary_sidebar',
				'desc'		=> 'Primary Sidebar works on two column & three column layouts',
				'options' 	=> $this->zozo_get_sidebar(),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Select Sidebar 2', 'mist' ),				
				'id'		=> $prefix . 'secondary_sidebar',
				'desc'		=> 'Secondary Sidebar works only on three column layouts',
				'options' 	=> $this->zozo_get_sidebar(),
				'type'		=> 'select'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-pagetitlebar',
			),
						
			array(
				'name'		=> __( 'Hide Page Title Bar', 'mist' ),
				'id'		=> $prefix . 'hide_page_title_bar',
				'desc'		=> '',
				'options' 	=> array(
								'no' 	=> 'No',
								'yes' 	=> 'Yes',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Hide Page Title', 'mist' ),
				'id'		=> $prefix . 'hide_page_title',
				'desc'		=> '',
				'options' 	=> array(
								'no' 	=> 'No',
								'yes' 	=> 'Yes',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Title Bar Type', 'mist' ),				
				'id'		=> $prefix . 'page_title_type',
				'desc'		=> '',
				'options' 	=> array(
								'default' 	=> 'Default',
								'mini' 		=> 'Mini',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Title Bar Skin', 'mist' ),				
				'id'		=> $prefix . 'page_title_skin',
				'desc'		=> '',
				'options' 	=> array(
								'default' 	=> 'Default',
								'dark' 		=> 'Dark',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Title Alignment', 'mist' ),				
				'id'		=> $prefix . 'page_title_align',
				'desc'		=> '',
				'options' 	=> array(
								'default' 	=> 'Default',
								'left' 		=> 'Left',				
								'right' 	=> 'Right',
								'center' 	=> 'Center'						
							),
				'type'		=> 'select'
			),
									
			array(
				'name'		=> __( 'Breadcrumbs', 'mist' ),
				'id'		=> $prefix . 'display_breadcrumbs',
				'desc'		=> '',
				'options' 	=> array(
								'default' 	=> 'Default',
								'show' 		=> 'Show',
								'hide' 		=> 'Hide',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Show Page Slogan', 'mist' ),
				'id'		=> $prefix . 'show_page_slogan',
				'desc'		=> '',
				'options' 	=> array(
								'yes' 	=> 'Yes',
								'no' 	=> 'No'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Slogan', 'mist' ),
				'id'		=> $prefix . 'page_slogan',
				'desc'		=> 'Include All HTML tags.',
				'type'		=> 'textarea'
			),
			
			array(
				'name'		=> __( 'Page Title Bar Height', 'mist' ),
				'id'		=> $prefix . 'page_title_height',
				'desc'		=> __('Enter the height of the page title bar. In pixels ex: 120px.', 'mist'),
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Page Title Bar Mobile Height', 'mist' ),
				'id'		=> $prefix . 'page_title_mobile_height',
				'desc'		=> __('Enter the height of the page title bar on mobile. In pixels ex: 120px.', 'mist'),
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Title Color', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_title_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Slogan Color', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_slogan_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Breadcrumbs Color', 'mist' ),				
				'id'		=> $prefix . 'page_breadcrumbs_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Border Color', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_border_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Background Image', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_bg',
				'desc'		=> '',				
				'type'		=> 'media'
			),
			
			array(
				'name'		=> __( 'Background Color', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_bg_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Background Repeat', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_bg_repeat',
				'desc'		=> '',
				'options' 	=> array(	
								'repeat'	=> 'Repeat',
								'repeat-x'	=> 'Repeat-x',
								'repeat-y'	=> 'Repeat-y',
								'no-repeat' => 'No Repeat'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Background Position', 'mist' ),
				'id'		=> $prefix . 'page_title_bar_bg_position',
				'desc'		=> '',
				'options' 	=> array(
								'left top' 		=> 'Left Top',
								'left center' 	=> 'Left Center',
								'left bottom' 	=> 'Left Bottom',
								'center top' 	=> 'Center Top',
								'center center' => 'Center Center',
								'center bottom' => 'Center Bottom',
								'right top' 	=> 'Right Top',
								'right center' 	=> 'Right Center',
								'right bottom' 	=> 'Right Bottom',
							),
				'type'		=> 'select'
			),
						
			array(
				'name'		=> __( 'Parallax Background Image', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_bg_parallax',
				'desc'		=> '',
				'options' 	=> array(
								'no' 		=> 'No',
								'yes' 		=> 'Yes',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( '100% Scale Background Image', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_bg_full',
				'desc'		=> '',
				'std' 		=> 0,				
				'type'		=> 'checkbox'
			),
			
			array(
				'name'		=> __( 'Enable Video Background ?', 'mist' ),				
				'id'		=> $prefix . 'page_title_video_bg',
				'desc'		=> '',
				'std' 		=> 0,				
				'type'		=> 'checkbox'
			),
			
			array(
				'name'		=> __( 'Video ID', 'mist' ),
				'id'		=> $prefix . 'page_title_video_id',
				'desc'		=> __('Enter the youtube ID to play video in background. Ex: AzpU0WF6yPE', 'mist'),
				'type'		=> 'text'
			),
			
			array(
				'type'		=> 'tab_close'
			),			
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-background',
			),
			
			array(
				'name'		=> __( 'Page Background Image', 'mist' ),				
				'id'		=> $prefix . 'page_bg_image',
				'desc'		=> '',				
				'type'		=> 'media'
			),
			
			array(
				'name'		=> __( 'Page Background Repeat', 'mist' ),				
				'id'		=> $prefix . 'page_bg_repeat',
				'desc'		=> '',
				'options' 	=> array(
								'' 			=> 'Default',
								'repeat'	=> 'Repeat',
								'repeat-x'	=> 'Repeat-x',
								'repeat-y'	=> 'Repeat-y',
								'no-repeat' => 'No Repeat'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Background Attachment', 'mist' ),				
				'id'		=> $prefix . 'page_bg_attachment',
				'desc'		=> '',
				'options' 	=> array(
								'' 			=> 'Default',
								'scroll'	=> 'Scroll',
								'fixed'		=> 'Fixed', 
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Background Position', 'mist' ),
				'id'		=> $prefix . 'page_bg_position',
				'desc'		=> '',
				'options' 	=> array(
								'' 				=> 'Default',
								'left top' 		=> 'Left Top',
								'left center' 	=> 'Left Center',
								'left bottom' 	=> 'Left Bottom',
								'center top' 	=> 'Center Top',
								'center center' => 'Center Center',
								'center bottom' => 'Center Bottom',
								'right top' 	=> 'Right Top',
								'right center' 	=> 'Right Center',
								'right bottom' 	=> 'Right Bottom',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Background Color', 'mist' ),				
				'id'		=> $prefix . 'page_bg_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Background Color Opacity', 'mist' ),				
				'id'		=> $prefix . 'page_bg_opacity',
				'desc'		=> '',
				'min'		=> '0',
				'max' 		=> '1',
				'step' 		=> '0.1',
				'type'		=> 'slider',
			),
			
			array(
				'name'		=> __( '100% Scale Background Image', 'mist' ),				
				'id'		=> $prefix . 'page_bg_full',
				'desc'		=> '',
				'std' 		=> 0,				
				'type'		=> 'checkbox'
			),
								
			array(
				'name'		=> __( 'Boxed Mode Options', 'mist' ),
				'type'		=> 'sub_title'
			),
			
			array(
				'name'		=> __( 'Body Background Image', 'mist' ),				
				'id'		=> $prefix . 'body_bg_image',
				'desc'		=> '',				
				'type'		=> 'media'
			),
			
			array(
				'name'		=> __( 'Body Background Repeat', 'mist' ),				
				'id'		=> $prefix . 'body_bg_repeat',
				'desc'		=> '',
				'options' 	=> array(
								'' 			=> 'Default',
								'repeat'	=> 'Repeat',
								'repeat-x'	=> 'Repeat-x',
								'repeat-y'	=> 'Repeat-y',
								'no-repeat' => 'No Repeat'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Body Background Attachment', 'mist' ),				
				'id'		=> $prefix . 'body_bg_attachment',
				'desc'		=> '',
				'options' 	=> array(
								'' 			=> 'Default',
								'scroll'	=> 'Scroll',
								'fixed'		=> 'Fixed',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Body Background Position', 'mist' ),
				'id'		=> $prefix . 'body_bg_position',
				'desc'		=> '',
				'options' 	=> array(
								'' 				=> 'Default',
								'left top' 		=> 'Left Top',
								'left center' 	=> 'Left Center',
								'left bottom' 	=> 'Left Bottom',
								'center top' 	=> 'Center Top',
								'center center' => 'Center Center',
								'center bottom' => 'Center Bottom',
								'right top' 	=> 'Right Top',
								'right center' 	=> 'Right Center',
								'right bottom' 	=> 'Right Bottom',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Body Background Color', 'mist' ),				
				'id'		=> $prefix . 'body_bg_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Background Color Opacity', 'mist' ),				
				'id'		=> $prefix . 'body_bg_opacity',
				'desc'		=> '',
				'min'		=> '0',
				'max' 		=> '1',
				'step' 		=> '0.1',
				'type'		=> 'slider',
			),
			
			array(
				'name'		=> __( '100% Scale Background Image', 'mist' ),				
				'id'		=> $prefix . 'body_bg_full',
				'desc'		=> '',
				'std' 		=> 0,				
				'type'		=> 'checkbox'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tabs_close'
			),
			
			
        );
		
		return $fields;
	
	}
	
	// Add Page Options fields
	public function render_page_fields() 
	{
		$prefix = 'zozo_';
		$url =  ZOZO_ADMIN_ASSETS . 'images/';
				
		$tabs_names = array(
			'page' 				=> __( 'Page', 'mist' ),
			'slider' 			=> __( 'Slider', 'mist' ),
			'header'			=> __( 'Header', 'mist' ),
			'footer'			=> __( 'Footer', 'mist' ),
			'sidebar' 			=> __( 'Sidebar', 'mist' ),
			'pagetitlebar' 		=> __( 'Page Title Bar', 'mist' ),
			'background' 		=> __( 'Background', 'mist' ),
			'onepage' 			=> __( 'One Page', 'mist' ),
		);
		
		$fields = array(
		
			array(
				'type'		=> 'tabs_open'
			),
			
			array(
				'tabs'		=> $tabs_names,
				'type'		=> 'tabs_list',
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-page',
			),
			
			array(
				'name'		=> __( 'Page Layout', 'mist' ),
				'id'		=> $prefix . 'theme_layout',
				'options' 	=> array(
							'fullwidth' 	=> $url . 'layouts/full-width.jpg',
							'boxed' 		=> $url . 'layouts/boxed.jpg',
							'wide' 			=> $url . 'layouts/wide.jpg',
							),
				'type'		=> 'images',
			),
		
			array(
				'name'		=> __( 'Column Layouts', 'mist' ),
				'id'		=> $prefix . 'layout',
				'options' 	=> array(
							'one-col' 			=> $url . 'one-col.png',
							'two-col-right' 	=> $url . 'two-col-right.png',
							'two-col-left' 		=> $url . 'two-col-left.png',
							'three-col-middle' 	=> $url . 'three-col-middle.png',
							'three-col-right' 	=> $url . 'three-col-right.png',
							'three-col-left' 	=> $url . 'three-col-left.png'
							),
				'type'		=> 'images',
			),
			
			array(
				'name'		=> __( 'Page Content Top Padding', 'mist' ),
				'id'		=> $prefix . 'page_top_padding',
				'desc'		=> __('Enter page top content padding. In pixels ex: 30px. Leave empty for default value.', 'mist'),
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Page Content Bottom Padding', 'mist' ),
				'id'		=> $prefix . 'page_bottom_padding',
				'desc'		=> __('Enter page bottom content padding. In pixels ex: 30px. Leave empty for default value.', 'mist'),
				'type'		=> 'text'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-slider',
			),
			
			array(
				'name'		=> __( 'Slider Position', 'mist' ),				
				'id'		=> $prefix . 'slider_position',
				'desc'		=> __('Select if the slider shows below or above the header.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'below' 	=> 'Below Header',
								'above' 	=> 'Above Header'
							),
				'type'		=> 'select'
			),
			
						
			array(
				'name'		=> __( 'Revolution Slider Shortcode', 'mist' ),
				'id'		=> $prefix . 'revolutionslider',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-header',
			),
			
			array(
				'name'		=> __( 'Display Header', 'mist' ),				
				'id'		=> $prefix . 'show_header',
				'desc'		=> __('Choose to show or hide the header.', 'mist'),
				'options' 	=> array(
								'yes' 	=> 'Yes',
								'no' 	=> 'No'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Display Header Top Bar', 'mist' ),				
				'id'		=> $prefix . 'show_header_top_bar',
				'desc'		=> __('Choose to show or hide the header top bar.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'yes' 		=> 'Yes',
								'no' 		=> 'No'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Display Header Sliding Bar', 'mist' ),				
				'id'		=> $prefix . 'show_header_sliding_bar',
				'desc'		=> __('Choose to show or hide the header sliding bar.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'yes' 		=> 'Yes',
								'no' 		=> 'No'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Display Mini Cart', 'mist' ),				
				'id'		=> $prefix . 'show_header_mini_cart',
				'desc'		=> __('Choose to show or hide the header mini cart.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'yes' 		=> 'Yes',
								'no' 		=> 'No'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Header Layout', 'mist' ),				
				'id'		=> $prefix . 'header_layout',
				'desc'		=> __('Choose header layout.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'fullwidth'	=> 'Full Width',
								'boxed'		=> 'Boxed'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Header Type', 'mist' ),				
				'id'		=> $prefix . 'header_type',
				'desc'		=> __('Choose header type.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'header-1'	=> 'Simple Header',
								'header-2'	=> 'Header Right Logo',
								'header-3'	=> 'Header Center Logo',
								'header-4'	=> 'Header Fullwidth Menu',
								'header-5'	=> 'Header Fullwidth Menu 2',
								'header-6'	=> 'Header Fullwidth Menu 3',
								'header-7'	=> 'Header Centered Logo',
								'header-8'	=> 'Header Centered Logo 2',
								'header-11'	=> 'Header Style 9',
								'header-12'	=> 'Header Style 10',
								'header-9'	=> 'Toggle Header',
								'header-10'	=> 'Vertical Header',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Header Position', 'mist' ),				
				'id'		=> $prefix . 'header_toggle_position',
				'desc'		=> __('Choose header toggle position. Only works on Toggle Header and Vertical Header type.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'left'		=> 'Left',
								'right'		=> 'Right',								
							),
				'type'		=> 'select'
			),			
			
			array(
				'name'		=> __( 'Header Transparency', 'mist' ),				
				'id'		=> $prefix . 'header_transparency',
				'desc'		=> __('Choose header transparency.', 'mist'),
				'options' 	=> array(
								'default' 			=> 'Default',
								'no-transparent'	=> 'No Transparency',
								'transparent'		=> 'Transparent',
								'semi-transparent'	=> 'Semi Transparent',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Header Skin', 'mist' ),				
				'id'		=> $prefix . 'header_skin',
				'desc'		=> __('Choose header skin.', 'mist'),
				'options' 	=> array(
								'default' 		=> 'Default',
								'light'			=> 'Light',
								'dark'			=> 'Dark',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Main Navigation Menu', 'mist' ),				
				'id'		=> $prefix . 'custom_nav_menu',
				'desc'		=> __('Choose which menu displays on this page.', 'mist'),
				'options' 	=> $this->zozo_get_menus(),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Background Image', 'mist' ),				
				'id'		=> $prefix . 'header_bg_image',
				'desc'		=> '',				
				'type'		=> 'media'
			),
			
			array(
				'name'		=> __( 'Background Color', 'mist' ),				
				'id'		=> $prefix . 'header_bg_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Background Color Opacity', 'mist' ),				
				'id'		=> $prefix . 'header_bg_opacity',
				'desc'		=> '',
				'min'		=> '0',
				'max' 		=> '1',
				'step' 		=> '0.1',
				'type'		=> 'slider',
			),
			
			array(
				'name'		=> __( 'Background Repeat', 'mist' ),				
				'id'		=> $prefix . 'header_bg_repeat',
				'desc'		=> '',
				'options' 	=> array(
								'' 			=> 'Default',
								'repeat'	=> 'Repeat',
								'repeat-x'	=> 'Repeat-x',
								'repeat-y'	=> 'Repeat-y',
								'no-repeat' => 'No Repeat'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Background Attachment', 'mist' ),
				'id'		=> $prefix . 'header_bg_attachment',
				'desc'		=> '',
				'options' 	=> array(
								'' 			=> 'Default',
								'scroll'	=> 'Scroll',
								'fixed'		=> 'Fixed',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Background Position', 'mist' ),
				'id'		=> $prefix . 'header_bg_postion',
				'desc'		=> '',
				'options' 	=> array(
								'' 				=> 'Default',
								'left top' 		=> 'Left Top',
								'left center' 	=> 'Left Center',
								'left bottom' 	=> 'Left Bottom',
								'center top' 	=> 'Center Top',
								'center center' => 'Center Center',
								'center bottom' => 'Center Bottom',
								'right top' 	=> 'Right Top',
								'right center' 	=> 'Right Center',
								'right bottom' 	=> 'Right Bottom',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( '100% Scale Background Image', 'mist' ),				
				'id'		=> $prefix . 'header_bg_full',
				'desc'		=> '',
				'std' 		=> 0,				
				'type'		=> 'checkbox'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-footer',
			),
			
			array(
				'name'		=> __( 'Display Footer Widget Area', 'mist' ),				
				'id'		=> $prefix . 'show_footer_widgets',
				'desc'		=> __('Choose to show or hide the footer widget area.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'yes' 		=> 'Yes',
								'no' 		=> 'No'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Display Footer Menu', 'mist' ),				
				'id'		=> $prefix . 'show_footer_menu',
				'desc'		=> __('Choose to show or hide the footer menu.', 'mist'),
				'options' 	=> array(
								'default' 	=> 'Default',
								'yes' 		=> 'Yes',
								'no' 		=> 'No'
							),
				'type'		=> 'select'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-sidebar',
			),
			
			array(
				'name'		=> __( 'Select Sidebar 1', 'mist' ),				
				'id'		=> $prefix . 'primary_sidebar',
				'desc'		=> 'Primary Sidebar works on two column & three column layouts',
				'options' 	=> $this->zozo_get_sidebar(),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Select Sidebar 2', 'mist' ),				
				'id'		=> $prefix . 'secondary_sidebar',
				'desc'		=> 'Secondary Sidebar works only on three column layouts',
				'options' 	=> $this->zozo_get_sidebar(),
				'type'		=> 'select'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-pagetitlebar',
			),
						
			array(
				'name'		=> __( 'Hide Page Title Bar', 'mist' ),
				'id'		=> $prefix . 'hide_page_title_bar',
				'desc'		=> '',
				'options' 	=> array(
								'no' 	=> 'No',
								'yes' 	=> 'Yes',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Hide Page Title', 'mist' ),
				'id'		=> $prefix . 'hide_page_title',
				'desc'		=> '',
				'options' 	=> array(
								'no' 	=> 'No',
								'yes' 	=> 'Yes',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Title Bar Type', 'mist' ),				
				'id'		=> $prefix . 'page_title_type',
				'desc'		=> '',
				'options' 	=> array(
								'default' 	=> 'Default',
								'mini' 		=> 'Mini',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Title Bar Skin', 'mist' ),				
				'id'		=> $prefix . 'page_title_skin',
				'desc'		=> '',
				'options' 	=> array(
								'default' 	=> 'Default',
								'dark' 		=> 'Dark',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Title Alignment', 'mist' ),				
				'id'		=> $prefix . 'page_title_align',
				'desc'		=> '',
				'options' 	=> array(
								'default' 	=> 'Default',
								'left' 		=> 'Left',				
								'right' 	=> 'Right',
								'center' 	=> 'Center'						
							),
				'type'		=> 'select'
			),
									
			array(
				'name'		=> __( 'Breadcrumbs', 'mist' ),
				'id'		=> $prefix . 'display_breadcrumbs',
				'desc'		=> '',
				'options' 	=> array(
								'default' 	=> 'Default',
								'show' 		=> 'Show',
								'hide' 		=> 'Hide',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Show Page Slogan', 'mist' ),
				'id'		=> $prefix . 'show_page_slogan',
				'desc'		=> '',
				'options' 	=> array(
								'yes' 	=> 'Yes',
								'no' 	=> 'No'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Slogan', 'mist' ),
				'id'		=> $prefix . 'page_slogan',
				'desc'		=> 'Include All HTML tags.',
				'type'		=> 'textarea'
			),
			
			array(
				'name'		=> __( 'Page Title Bar Height', 'mist' ),
				'id'		=> $prefix . 'page_title_height',
				'desc'		=> __('Enter the height of the page title bar. In pixels ex: 120px.', 'mist'),
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Page Title Bar Mobile Height', 'mist' ),
				'id'		=> $prefix . 'page_title_mobile_height',
				'desc'		=> __('Enter the height of the page title bar on mobile. In pixels ex: 120px.', 'mist'),
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Title Color', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_title_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Slogan Color', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_slogan_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Breadcrumbs Color', 'mist' ),				
				'id'		=> $prefix . 'page_breadcrumbs_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Border Color', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_border_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Background Image', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_bg',
				'desc'		=> '',				
				'type'		=> 'media'
			),
			
			array(
				'name'		=> __( 'Background Color', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_bg_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Background Repeat', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_bg_repeat',
				'desc'		=> '',
				'options' 	=> array(	
								'repeat'	=> 'Repeat',
								'repeat-x'	=> 'Repeat-x',
								'repeat-y'	=> 'Repeat-y',
								'no-repeat' => 'No Repeat'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Background Position', 'mist' ),
				'id'		=> $prefix . 'page_title_bar_bg_position',
				'desc'		=> '',
				'options' 	=> array(
								'left top' 		=> 'Left Top',
								'left center' 	=> 'Left Center',
								'left bottom' 	=> 'Left Bottom',
								'center top' 	=> 'Center Top',
								'center center' => 'Center Center',
								'center bottom' => 'Center Bottom',
								'right top' 	=> 'Right Top',
								'right center' 	=> 'Right Center',
								'right bottom' 	=> 'Right Bottom',
							),
				'type'		=> 'select'
			),
						
			array(
				'name'		=> __( 'Parallax Background Image', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_bg_parallax',
				'desc'		=> '',
				'options' 	=> array(
								'no' 		=> 'No',
								'yes' 		=> 'Yes',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( '100% Scale Background Image', 'mist' ),				
				'id'		=> $prefix . 'page_title_bar_bg_full',
				'desc'		=> '',
				'std' 		=> 0,				
				'type'		=> 'checkbox'
			),
			
			array(
				'name'		=> __( 'Enable Video Background ?', 'mist' ),				
				'id'		=> $prefix . 'page_title_video_bg',
				'desc'		=> '',
				'std' 		=> 0,				
				'type'		=> 'checkbox'
			),
			
			array(
				'name'		=> __( 'Video ID', 'mist' ),
				'id'		=> $prefix . 'page_title_video_id',
				'desc'		=> __('Enter the youtube ID to play video in background. Ex: AzpU0WF6yPE', 'mist'),
				'type'		=> 'text'
			),
			
			array(
				'type'		=> 'tab_close'
			),			
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-background',
			),
			
			array(
				'name'		=> __( 'Page Background Image', 'mist' ),				
				'id'		=> $prefix . 'page_bg_image',
				'desc'		=> '',				
				'type'		=> 'media'
			),
			
			array(
				'name'		=> __( 'Page Background Repeat', 'mist' ),				
				'id'		=> $prefix . 'page_bg_repeat',
				'desc'		=> '',
				'options' 	=> array(
								'' 			=> 'Default',
								'repeat'	=> 'Repeat',
								'repeat-x'	=> 'Repeat-x',
								'repeat-y'	=> 'Repeat-y',
								'no-repeat' => 'No Repeat'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Background Attachment', 'mist' ),				
				'id'		=> $prefix . 'page_bg_attachment',
				'desc'		=> '',
				'options' 	=> array(
								'' 			=> 'Default',
								'scroll'	=> 'Scroll',
								'fixed'		=> 'Fixed', 
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Background Position', 'mist' ),
				'id'		=> $prefix . 'page_bg_position',
				'desc'		=> '',
				'options' 	=> array(
								'' 				=> 'Default',
								'left top' 		=> 'Left Top',
								'left center' 	=> 'Left Center',
								'left bottom' 	=> 'Left Bottom',
								'center top' 	=> 'Center Top',
								'center center' => 'Center Center',
								'center bottom' => 'Center Bottom',
								'right top' 	=> 'Right Top',
								'right center' 	=> 'Right Center',
								'right bottom' 	=> 'Right Bottom',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Page Background Color', 'mist' ),				
				'id'		=> $prefix . 'page_bg_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Background Color Opacity', 'mist' ),				
				'id'		=> $prefix . 'page_bg_opacity',
				'desc'		=> '',
				'min'		=> '0',
				'max' 		=> '1',
				'step' 		=> '0.1',
				'type'		=> 'slider',
			),
			
			array(
				'name'		=> __( '100% Scale Background Image', 'mist' ),				
				'id'		=> $prefix . 'page_bg_full',
				'desc'		=> '',
				'std' 		=> 0,				
				'type'		=> 'checkbox'
			),
								
			array(
				'name'		=> __( 'Boxed Mode Options', 'mist' ),
				'type'		=> 'sub_title'
			),
			
			array(
				'name'		=> __( 'Body Background Image', 'mist' ),				
				'id'		=> $prefix . 'body_bg_image',
				'desc'		=> '',				
				'type'		=> 'media'
			),
			
			array(
				'name'		=> __( 'Body Background Repeat', 'mist' ),				
				'id'		=> $prefix . 'body_bg_repeat',
				'desc'		=> '',
				'options' 	=> array(
								'' 			=> 'Default',
								'repeat'	=> 'Repeat',
								'repeat-x'	=> 'Repeat-x',
								'repeat-y'	=> 'Repeat-y',
								'no-repeat' => 'No Repeat'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Body Background Attachment', 'mist' ),				
				'id'		=> $prefix . 'body_bg_attachment',
				'desc'		=> '',
				'options' 	=> array(
								'' 			=> 'Default',
								'scroll'	=> 'Scroll',
								'fixed'		=> 'Fixed',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Body Background Position', 'mist' ),
				'id'		=> $prefix . 'body_bg_position',
				'desc'		=> '',
				'options' 	=> array(
								'' 				=> 'Default',
								'left top' 		=> 'Left Top',
								'left center' 	=> 'Left Center',
								'left bottom' 	=> 'Left Bottom',
								'center top' 	=> 'Center Top',
								'center center' => 'Center Center',
								'center bottom' => 'Center Bottom',
								'right top' 	=> 'Right Top',
								'right center' 	=> 'Right Center',
								'right bottom' 	=> 'Right Bottom',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Body Background Color', 'mist' ),				
				'id'		=> $prefix . 'body_bg_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Background Color Opacity', 'mist' ),				
				'id'		=> $prefix . 'body_bg_opacity',
				'desc'		=> '',
				'min'		=> '0',
				'max' 		=> '1',
				'step' 		=> '0.1',
				'type'		=> 'slider',
			),
			
			array(
				'name'		=> __( '100% Scale Background Image', 'mist' ),				
				'id'		=> $prefix . 'body_bg_full',
				'desc'		=> '',
				'std' 		=> 0,				
				'type'		=> 'checkbox'
			),
			
			array(
				'type'		=> 'tab_close'
			),			
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-onepage',
			),
			
			array(
				'name'		=> '',
				'type'		=> 'title',
				'desc'		=> 'Parallax settings are only affecting pages which are sections on the parallax page.',
			),
			
			array(
				'name'		=> __( 'Section Header', 'mist' ),				
				'id'		=> $prefix . 'section_header_status',
				'desc'		=> '',
				'options' 	=> array(
								'show' 	=> 'Show',
								'hide' 	=> 'Hide'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Section Title', 'mist' ),
				'id'		=> $prefix . 'section_title',
				'desc'		=> 'Include HTML tags but not allowed heading tags (H1, H2, H3, H4, H5, H6).',	
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Section Slogan', 'mist' ),
				'id'		=> $prefix . 'section_slogan',
				'desc'		=> 'Include All HTML tags.',
				'type'		=> 'textarea'
			),
						
			array(
				'name'		=> __( 'Section Padding Top', 'mist' ),
				'id'		=> $prefix . 'section_padding_top',
				'desc'		=> 'Enter padding top. Ex: 40px.',	
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Section Padding Bottom', 'mist' ),
				'id'		=> $prefix . 'section_padding_bottom',
				'desc'		=> 'Enter padding bottom. Ex: 40px.',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Section Header Padding Bottom', 'mist' ),
				'id'		=> $prefix . 'section_header_padding',
				'desc'		=> 'Enter header padding bottom. Ex: 20px.',	
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Section Title Color', 'mist' ),				
				'id'		=> $prefix . 'section_title_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Section Slogan Color', 'mist' ),				
				'id'		=> $prefix . 'section_slogan_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Section Text Color', 'mist' ),				
				'id'		=> $prefix . 'section_text_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Section Content Heading Tags Color', 'mist' ),				
				'id'		=> $prefix . 'section_content_heading_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Section Background Color', 'mist' ),				
				'id'		=> $prefix . 'section_bg_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
						
			array(
				'name'		=> __( 'Parallax Mode', 'mist' ),				
				'id'		=> $prefix . 'parallax_status',
				'desc'		=> '',
				'options' 	=> array(
								'no' 	=> 'No',
								'yes' 	=> 'Yes'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Parallax Background Image', 'mist' ),
				'id'		=> $prefix . 'parallax_bg_image',
				'desc'		=> '',
				'type'		=> 'media'
			),
			
			array(
				'name'		=> __( 'Background Repeat', 'mist' ),
				'id'		=> $prefix . 'parallax_bg_repeat',
				'desc'		=> '',
				'options' 	=> array(
								''			=> 'Select',
								'repeat'	=> 'Repeat',
								'repeat-x'	=> 'Repeat-x',
								'repeat-y'	=> 'Repeat-y',
								'no-repeat' => 'No Repeat'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Background Attachment', 'mist' ),
				'id'		=> $prefix . 'parallax_bg_attachment',
				'desc'		=> '',
				'options' 	=> array(
								''			=> 'Select',
								'fixed'		=> 'Fixed', 
								'scroll'	=> 'Scroll'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Background Position', 'mist' ),
				'id'		=> $prefix . 'parallax_bg_postion',
				'desc'		=> '',
				'options' 	=> array(
				                ''				=> 'Select',
								'left top' 		=> 'Left Top',
								'left center' 	=> 'Left Center',
								'left bottom' 	=> 'Left Bottom',
								'center top' 	=> 'Center Top',
								'center center' => 'Center Center',
								'center bottom' => 'Center Bottom',
								'right top' 	=> 'Right Top',
								'right center' 	=> 'Right Center',
								'right bottom' 	=> 'Right Bottom',
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Background Size', 'mist' ),				
				'id'		=> $prefix . 'parallax_bg_size',
				'desc'		=> '',
				'options' 	=> array(
				                ''		=> 'Select',
								'auto' 	=> 'Auto',
								'cover'	=> 'Cover'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Overlay', 'mist' ),				
				'id'		=> $prefix . 'parallax_bg_overlay',
				'desc'		=> '',
				'options' 	=> array(
								'no' 	=> 'No',
								'yes' 	=> 'Yes'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Overlay Pattern', 'mist' ),				
				'id'		=> $prefix . 'overlay_pattern_status',
				'desc'		=> '',
				'options' 	=> array(
								'no' 	=> 'No',
								'yes' 	=> 'Yes'
							),
				'type'		=> 'select'
			),
			
			array(
				'name'		=> __( 'Overlay Pattern Style', 'mist' ),
				'id'		=> $prefix . 'overlay_pattern_style',
				'options' 	=> array(
								'pattern-1' 	=> $url . 'patterns/pattern-1.png',
								'pattern-2' 	=> $url . 'patterns/pattern-2.png',
								'pattern-3' 	=> $url . 'patterns/pattern-3.png',
								'pattern-4' 	=> $url . 'patterns/pattern-4.png',
								'pattern-5' 	=> $url . 'patterns/pattern-5.png',								
							),
				'type'		=> 'images',
			),
			
			array(
				'name'		=> __( 'Section Overlay Color', 'mist' ),				
				'id'		=> $prefix . 'section_overlay_color',
				'desc'		=> '',				
				'type'		=> 'color'
			),
			
			array(
				'name'		=> __( 'Overlay Color Opacity', 'mist' ),				
				'id'		=> $prefix . 'overlay_color_opacity',
				'desc'		=> '',
				'min'		=> '0',
				'max' 		=> '1',
				'step' 		=> '0.1',
				'type'		=> 'slider',
			),
			
			array(
				'name'		=> __( 'Parallax Additional Sections', 'mist' ),
				'type'		=> 'sub_title'
			),
			
			array(
				'name'		=> __( 'Additional Sections', 'mist' ),				
				'id'		=> $prefix . 'parallax_additional_sections',
				'hidden_id'	=> $prefix . 'parallax_additional_sections_order',
				'desc'		=> 'You can optionally add some other sections in parallax without adding section in a menu. Choosed sections will show below to this current section in choosen order.',
				'options' 	=> $this->zozo_get_posts_list('page'),
				'type'		=> 'chosen'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tabs_close'
			),
			
        );
		
		return $fields;
	
	}
		
	// Add Testimonial Options fields
	public function render_testimonial_fields() 
	{
		$prefix = 'zozo_';
		$url =  ZOZO_ADMIN_ASSETS . 'images/';
		
		$fields = array(
		
			array(
				'name'		=> __( 'Author Info', 'mist' ),
				'type'		=> 'title'
			),
			
			array(
				'name'		=> __( 'Author Designation', 'mist' ),				
				'id'		=> $prefix . 'author_designation',
				'desc'		=> 'Enter author designation.',
				'type'		=> 'text'
			),
									
			array(
				'name'		=> __( 'Company Name', 'mist' ),				
				'id'		=> $prefix . 'author_company_name',
				'desc'		=> 'Enter author company name.',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Company URL', 'mist' ),
				'id'		=> $prefix . 'author_company_url',
				'desc'		=> 'Enter author company website URL.',
				'type'		=> 'text'
			),
			
        );
		
		return $fields;
	
	}
	
	// Portfolio Option Fields
	public function render_portfolio_fields() 
	{
	
		global $post;
		
		$field_prefix = "zozoportfolio_options";
		
		$output = '';
		
		$output .= '<div class="zozo-page-tabs">';
		
		$output .= '<ul class="zozo-page-tabs-list">';
		$output .= '<li class="tab-item"><a href="#tab-info">Info</a></li>';
		$output .= '<li class="tab-item"><a href="#tab-slider">Slider</a></li>';
		$output .= '</ul>';
		
		$output .= '<div id="tab-info" class="zozo-page-meta-tab">';
		
			$custom_text = get_post_meta($post->ID, 'zozo_portfolio_custom_text', true);
		
			$output .= '<div class="zozo_metabox_field">';
				
				$output .= '<label for="zozo_portfolio_custom_text">';
				$output .= __( 'Custom Text', 'mist' );
				$output .= '</label>';
				
				$output .= '<div class="field-text fields">';
				$output .= '<input type="text" id="zozo_portfolio_custom_text" name="zozo_portfolio_custom_text" value="' . esc_attr( $custom_text ) . '" />';
				$output .= '</div>';
				
			$output .= '</div>';
		
			$date_value = get_post_meta($post->ID, 'zozo_portfolio_date', true);
		
			$output .= '<div class="zozo_metabox_field">';
				
				$output .= '<label for="zozo_portfolio_date">';
				$output .= __( 'Portfolio Date', 'mist' );
				$output .= '</label>';
				
				$output .= '<div class="field-text fields">';
				$output .= '<input type="text" id="zozo_portfolio_date" name="zozo_portfolio_date" value="' . esc_attr( $date_value ) . '" />';			
				$output .= '</div>';
				
			$output .= '</div>';
		
			$client_value = get_post_meta($post->ID, 'zozo_portfolio_client', true);
			
			$output .= '<div class="zozo_metabox_field">';
			
				$output .= '<label for="zozo_portfolio_client">';
				$output .= __( 'Client Name', 'mist' );
				$output .= '</label>';
				
				$output .= '<div class="field-text fields">';
				$output .= '<input type="text" id="zozo_portfolio_client" name="zozo_portfolio_client" value="' . esc_attr( $client_value ) . '" />';			
				$output .= '</div>';
				
			$output .= '</div>';
			
			$button_text = get_post_meta($post->ID, 'zozo_portfolio_button_text', true);
		
			$output .= '<div class="zozo_metabox_field">';
				
				$output .= '<label for="zozo_portfolio_button_text">';
				$output .= __( 'Button Text', 'mist' );
				$output .= '</label>';
				
				$output .= '<div class="field-text fields">';
				$output .= '<input type="text" id="zozo_portfolio_button_text" name="zozo_portfolio_button_text" value="' . esc_attr( $button_text ) . '" />';
				$output .= '</div>';
				
			$output .= '</div>';
			
			$button_url = get_post_meta($post->ID, 'zozo_portfolio_button_url', true);
		
			$output .= '<div class="zozo_metabox_field">';
				
				$output .= '<label for="zozo_portfolio_button_url">';
				$output .= __( 'Button URL', 'mist' );
				$output .= '</label>';
				
				$output .= '<div class="field-text fields">';
				$output .= '<input type="text" id="zozo_portfolio_button_url" name="zozo_portfolio_button_url" value="' . esc_attr( $button_url ) . '" />';
				$output .= '</div>';
				
			$output .= '</div>';
		
			$sharing_value = get_post_meta($post->ID, 'zozo_portfolio_share', true);
			if( !$sharing_value ) {
				$sharing_value = 0;
			}
			
			$output .= '<div class="zozo_metabox_field">';
			
				$output .= '<label for="zozo_portfolio_share">';
				$output .= __( 'Enable Social Share', 'mist' );
				$output .= '</label>';
				
				$output .= '<div class="field-checkbox fields">';
				$output .= '<input type="hidden" class="checkbox" name="zozo_portfolio_share" id="zozo_portfolio_share" value="0" />';
				$output .= '<input type="checkbox" class="checkbox" name="zozo_portfolio_share" id="zozo_portfolio_share" value="1" '. checked($sharing_value, 1, false) .' />';
				$output .= '</div>';
				
			$output .= '</div>';
			
		$output .= '</div>';
		
		$output .= '<div id="tab-slider" class="zozo-page-meta-tab">';
		
			$output .= '<div class="clone-portfolio-row">';
			
			// Output Saved Portfolio fields
			$zozo_port_val = get_post_meta($post->ID, 'zozoportfolio_options', true);
			$options_count = get_post_meta($post->ID, 'zozo_portfolio_section_count', true);
			
			for( $opt=1; $opt<=$options_count; $opt++ ) {
			
				// Cloned Div
				$output .= '<div class="portfolio-section cloned">';
				
				// Portfolio Image/Video Title
				$output .= '<div class="zozo_metabox_field">';
					$output .= '<label>';
					$output .= __( 'Image Title', 'mist' );
					$output .= '</label>';
					$output .= '<div class="field-text re-fields">';
					$output .= '<input type="text" id="' . $field_prefix . '[portfolio_item_title]['.$opt.']" name="' . $field_prefix . '[portfolio_item_title]['.$opt.']" value="'.$zozo_port_val['portfolio_item_title'][$opt].'" />';
					$output .= '</div>';
				$output .= '</div>';
				
				// Portfolio Images
				$output .= '<div class="zozo_metabox_field">';
					$output .= '<label>';
					$output .= __( 'Image', 'mist' );
					$output .= '</label>';
					$output .= '<div class="field-upload re-fields">';
					$output .= '<input type="text" class="zozo-meta-upload media_field" id="' . $field_prefix . '[portfolio_image]['.$opt.']" name="' . $field_prefix . '[portfolio_image]['.$opt.']" value="'.$zozo_port_val['portfolio_image'][$opt].'" />';
					$output .= '<button type="button" class="zozo_meta_upload_button btn">'. __( 'Upload', 'mist' ) .'</button>';
					$output .= '<button type="button" class="zozo_meta_remove_button btn">'. __( 'Remove', 'mist' ) .'</button>';			
					$output .= '</div>';
				$output .= '</div>';
				
				// Portfolio Video Type
				$selected_value = '';
				$selected_value = $zozo_port_val['portfolio_video_type'][$opt];
				$output .= '<div class="select_wrapper zozo_metabox_field">';
					$output .= '<label>';
					$output .= __( 'Video Type', 'mist' );
					$output .= '</label>';
					$output .= '<div class="field-select re-fields">';
					$output .= '<select class="select-box" name="' . $field_prefix . '[portfolio_video_type]['.$opt.']" id="' . $field_prefix . '[portfolio_video_type]['.$opt.']">'; 			
					$output .= '<option id="0" value="0" />None</option>';
					$field['options'] = array(
										'youtube'	=> 'Youtube',
										'vimeo'		=> 'Vimeo'									
									);
		
					foreach( $field['options'] as $select_id => $option ) { 
						$value = $option;
						
						if (!is_numeric($select_id))
							$value = $select_id;
							
						$output .= '<option id="' . $select_id . '" value="'.$value.'" ' . selected($selected_value, $value, false) . ' />'.$option.'</option>';
					}
					$output .= '</select>';	
				$output .= '</div></div>';
				
				// Portfolio Video
				$output .= '<div class="zozo_metabox_field">';
					$output .= '<label>';
					$output .= __( 'Video ID', 'mist' );
					$output .= '</label>';
					$output .= '<div class="field-text re-fields">';				
					$output .= '<input type="text" id="' . $field_prefix . '[portfolio_video]['.$opt.']" name="' . $field_prefix . '[portfolio_video]['.$opt.']" value="'.$zozo_port_val['portfolio_video'][$opt].'" />';
					$output .= '</div>';
				$output .= '</div>';
				
				// Remove Column
				$output .= '<a href="#" class="zozo_portfolio_clone_section_remove btn">'. __( 'Remove Options', 'mist' ) .'</a>';
	
				$output .= '</div>';
				
				//$i++;
			}
			
			// Clone Copy Hidden Div
			$output .= '<div class="portfolio-section repeatable">';
			
			// Portfolio Image/Video Title
			$output .= '<div class="zozo_metabox_field">';
				$output .= '<label>';
				$output .= __( 'Image Title', 'mist' );
				$output .= '</label>';
				$output .= '<div class="field-text re-fields">';
				$output .= '<input type="text" id="' . $field_prefix . '[portfolio_item_title][%r]" name="' . $field_prefix . '[portfolio_item_title][%r]" value="" />';
				$output .= '</div>';
			$output .= '</div>';
		
			// Portfolio Images
			$output .= '<div class="zozo_metabox_field">';
				$output .= '<label>';
				$output .= __( 'Image', 'mist' );
				$output .= '</label>';
				$output .= '<div class="field-upload re-fields">';
				$output .= '<input type="text" class="zozo-meta-upload media_field" id="' . $field_prefix . '[portfolio_image][%r]" name="' . $field_prefix . '[portfolio_image][%r]" value="" />';
				$output .= '<button type="button" class="zozo_meta_upload_button btn">'. __( 'Upload', 'mist' ) .'</button>';
				$output .= '<button type="button" class="zozo_meta_remove_button btn">'. __( 'Remove', 'mist' ) .'</button>';		
				$output .= '</div>';
			$output .= '</div>';
			
			// Portfolio Video Type
			$output .= '<div class="select_wrapper zozo_metabox_field">';
				$output .= '<label>';
				$output .= __( 'Video Type', 'mist' );
				$output .= '</label>';
				$output .= '<div class="field-select re-fields">';
				$output .= '<select class="select-box" name="' . $field_prefix . '[portfolio_video_type][%r]" id="' . $field_prefix . '[portfolio_video_type][%r]">';
				$output .= '<option id="0" value="0" />None</option>';
				$field['options'] = array(
									'youtube'	=> 'Youtube',
									'vimeo'		=> 'Vimeo'
								);
	
				foreach( $field['options'] as $select_id => $option ) { 
					$value = $option;
					
					if (!is_numeric($select_id))
						$value = $select_id;
						
					$output .= '<option id="' . $select_id . '" value="'.$value.'" />'.$option.'</option>';
				}
				$output .= '</select>';	
			$output .= '</div></div>';
			
			// Portfolio Video
			$output .= '<div class="zozo_metabox_field">';
				$output .= '<label>';
				$output .= __( 'Video ID', 'mist' );
				$output .= '</label>';
				$output .= '<div class="field-text re-fields">';
				$output .= '<input type="text" id="' . $field_prefix . '[portfolio_video][%r]" name="' . $field_prefix . '[portfolio_video][%r]" value="" />';
				$output .= '</div>';
			$output .= '</div>';
			
			// Remove Column
			$output .= '<a href="#" class="zozo_portfolio_clone_section_remove btn">'. __( 'Remove Options', 'mist' ) .'</a>';
	
			$output .= '</div>';
			$output .= '<a href="#" class="zozo_portfolio_clone_section_add btn">'. __( 'Add New Options', 'mist' ) .'</a>';
			$output .= '<input type="hidden" name="zozo_portfolio_section_count" id="zozo_portfolio_section_count" value="'.$options_count.'" />';
			$output .= '</div>';
		$output .= '</div>';
		
		$output .= '</div>';
		
		echo wp_kses( $output, zozo_expanded_allowed_tags() );
	
	}
	
	// Team Member Option Fields
	public function render_team_fields() 
	{
		$prefix = 'zozo_';
		
		$tabs_names = array(
			'info' 				=> __( 'Info', 'mist' ),
			'social' 			=> __( 'Social', 'mist' ),
		);
		
		$fields = array(
		
			array(
				'type'		=> 'tabs_open'
			),
			
			array(
				'tabs'		=> $tabs_names,
				'type'		=> 'tabs_list',
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-info',
			),
		
			array(
				'name'		=> __( 'Member Name', 'mist' ),
				'id'		=> $prefix . 'member_name',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			
			array(
				'name'		=> __( 'Member Designation', 'mist' ),
				'id'		=> $prefix . 'member_designation',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Member Overview', 'mist' ),
				'id'		=> $prefix . 'member_description',
				'desc'		=> '',
				'type'		=> 'editor'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tab_open',
				'id'		=> 'tab-social',
			),
			
			array(
				'name'		=> __( 'Email Address', 'mist' ),
				'id'		=> $prefix . 'member_email',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Facebook Link', 'mist' ),
				'id'		=> $prefix . 'member_facebook',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Twitter Link', 'mist' ),
				'id'		=> $prefix . 'member_twitter',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Linkedin Link', 'mist' ),
				'id'		=> $prefix . 'member_linkedin',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Pinterest Link', 'mist' ),
				'id'		=> $prefix . 'member_pinterest',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Dribbble Link', 'mist' ),
				'id'		=> $prefix . 'member_dribbble',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Skype Link', 'mist' ),
				'id'		=> $prefix . 'member_skype',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Yahoo Link', 'mist' ),
				'id'		=> $prefix . 'member_yahoo',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Youtube Link', 'mist' ),
				'id'		=> $prefix . 'member_youtube',
				'desc'		=> '',
				'type'		=> 'text'
			),
			
			array(
				'name'		=> __( 'Link Target', 'mist' ),
				'id'		=> $prefix . 'member_link_target',
				'desc'		=> '',
				'options' 	=> array(
								'_self' 	=> 'Open in same window',
								'_blank'	=> 'Open in new window'								
							),
				'type'		=> 'select'
			),
			
			array(
				'type'		=> 'tab_close'
			),
			
			array(
				'type'		=> 'tabs_close'
			),
			
        );
		
		return $fields;
	
	}
	
}