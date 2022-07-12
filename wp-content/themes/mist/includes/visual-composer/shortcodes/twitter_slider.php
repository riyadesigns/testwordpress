<?php 
/**
 * Twitter Slider shortcode 
 */

if ( ! function_exists( 'zozo_vc_twitter_slider_shortcode' ) ) {
	function zozo_vc_twitter_slider_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'					=> '',
					'css_animation'				=> '',
					'consumer_key' 				=> '',
					'consumer_secret' 			=> '',
					'access_token'				=> '',
					'access_token_secret' 		=> '',
					'screen_name' 				=> '',					
					'twitter_count' 			=> '6',
					'auto_play'					=> 'true',
					'timeout_duration'			=> '5000',
					'infinite_loop' 			=> 'false',
					'navigation' 				=> 'true',
					'pagination' 				=> 'true',
				), $atts 
			) 
		);

		$output = '';
		static $twitter_id = 1;
		
		// Slider Configuration
		$data_attr = '';
		
		$data_attr .= ' data-items="1" ';
		$data_attr .= ' data-slideby="1" ';
		$data_attr .= ' data-items-tablet="1" ';
		$data_attr .= ' data-items-mobile-landscape="1" ';
		$data_attr .= ' data-items-mobile-portrait="1" ';
		$data_attr .= ' data-loop="false" ';
		
		if( isset( $auto_play ) && $auto_play != '' ) {
			$data_attr .= ' data-autoplay="' . $auto_play . '" ';
		}
		if( isset( $timeout_duration ) && $timeout_duration != '' ) {
			$data_attr .= ' data-autoplay-timeout="' . $timeout_duration . '" ';
		}
		if( isset( $pagination ) && $pagination != '' ) {
			$data_attr .= ' data-pagination="' . $pagination . '" ';
		}
		if( isset( $navigation ) && $navigation != '' ) {
			$data_attr .= ' data-navigation="' . $navigation . '" ';
		}
		
		// Classes
		$main_classes = '';
		$main_classes .= zozo_vc_animation( $css_animation );
		$tweets_list = '';
		
		if( $screen_name && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $twitter_count ) {
		
			require_once( ZOZO_CORE_DIR . 'tweet-php/TweetPHP.php');
			
			$TweetPHP = new TweetPHP(array(
				'consumer_key'          => $consumer_key,
				'consumer_secret'       => $consumer_secret,
				'access_token'          => $access_token,
				'access_token_secret'   => $access_token_secret,
				'twitter_screen_name'   => $screen_name,
				'enable_cache'          => true,
				'cachetime'             => 8 * HOUR_IN_SECONDS, // Seconds to cache feed
				'tweets_to_retrieve'    => 20, // How many tweets to fetch
				'tweets_to_display'     => $twitter_count, // Number of tweets to display
				'ignore_replies'        => true, // Ignore @replies
				'ignore_retweets'       => true, // Ignore retweets
				'twitter_style_dates'   => true, // Use twitter style dates e.g. 2 hours ago
				'twitter_date_text'     => array('seconds', 'minutes', 'about', 'hour', 'ago'),
				'date_format'           => '%I:%M %p %b %d%O', // The defult date format e.g. 12:08 PM Jun 12th. See: http://php.net/manual/en/function.strftime.php
				'date_lang'             => get_locale(), // Language for date e.g. 'fr_FR'. See: http://php.net/manual/en/function.setlocale.php
				'twitter_template'      => '{tweets}',
			    'tweet_template'        => '<div class="tweet-list"><span class="status">{tweet}</span> <span class="meta"><a href="{link}">{date}</a></span></div>',
			    'error_template'        => '<div class="tweet-error"><span class="status">Our twitter feed is unavailable right now.</span> <span class="meta"><a href="{link}">Follow us on Twitter</a></span></div>',
			    'debug'                 => false
			));
			
			$tweets_list = $TweetPHP->get_tweet_list();
			
			if( $tweets_list != '' ) {
				$output = '<div class="zozo-twitter-slider-wrapper'.$main_classes.'">';
				$output .= '<div id="zozo-twitter-slider'.$twitter_id.'" class="zozo-owl-carousel owl-carousel twitter-carousel-slider"'.$data_attr.'>';
					$output .= $tweets_list;
				$output .= '</div>';
				$output .= '</div>';
			}
		} else {
            $output .= '<p>' . esc_html__('Please configure twitter options.', 'mist') . '</p>';
        }
		
		$twitter_id++;
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_twitter_slider_shortcode_map' ) ) {
	function zozo_vc_twitter_slider_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Twitter Slider", "mist" ),
				"description"			=> __( "Show your twitter feeds in Slider.", 'mist' ),
				"base"					=> "zozo_vc_twitter_slider",
				"category"				=> __( "Theme Addons", "mist" ),
				"icon"					=> "zozo-vc-icon",
				"params"				=> array(
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Extra Class', "mist" ),
						'param_name'	=> 'classes',
						'value' 		=> '',
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "CSS Animation", "mist" ),
						"param_name"	=> "css_animation",
						"value"			=> array(
							__( "No", "mist" )					=> '',
							__( "Top to bottom", "mist" )			=> "top-to-bottom",
							__( "Bottom to top", "mist" )			=> "bottom-to-top",
							__( "Left to right", "mist" )			=> "left-to-right",
							__( "Right to left", "mist" )			=> "right-to-left",
							__( "Appear from center", "mist" )	=> "appear" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Consumer Key", "mist" ),
						"param_name"	=> "consumer_key",
						"value" 		=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Consumer Secret", "mist" ),
						"param_name"	=> "consumer_secret",
						"value" 		=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Access Token", "mist" ),
						"param_name"	=> "access_token",
						"value" 		=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Access Token Secret", "mist" ),
						"param_name"	=> "access_token_secret",
						"value" 		=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Twitter Screen Name", "mist" ),
						"param_name"	=> "screen_name",
						'admin_label'	=> true,
						"value" 		=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Number of Tweets", "mist" ),
						'admin_label'	=> true,
						"param_name"	=> "twitter_count",
						'admin_label'	=> true,
						"value" 		=> "",
					),
					// Slider
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( "Auto Play", 'mist' ),
						'param_name'	=> "auto_play",
						'admin_label'	=> true,
						'value'			=> array(
							__( 'True', 'mist' )	=> 'true',
							__( 'False', 'mist' )	=> 'false',
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Timeout Duration (in milliseconds)', 'mist' ),
						'param_name'	=> "timeout_duration",
						'value'			=> "5000",
						'dependency'	=> array(
							'element'	=> "auto_play",
							'value'		=> 'true'
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Navigation", "mist" ),
						"param_name"	=> "navigation",
						'admin_label'	=> true,
						"value"			=> array(
							__( "Yes", "mist" )	=> "true",
							__( "No", "mist" )	=> "false" ),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Pagination", "mist" ),
						"param_name"	=> "pagination",
						'admin_label'	=> true,
						"value"			=> array(
							__( "Yes", "mist" )	=> "true",
							__( "No", "mist" )	=> "false" ),
						"group"			=> __( "Slider", "mist" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_twitter_slider_shortcode_map' );