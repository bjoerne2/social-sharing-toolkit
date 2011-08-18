<?php
/*
Plugin Name: Social Sharing Toolkit
Plugin URI: http://www.marijnrongen.com/wordpress-plugins/social_sharing_toolkit/
Description: This plugin enables sharing of your content via popular social networks and can also convert Twitter names and hashtags to links. Easy & configurable.
Version: 2.0.3
Author: Marijn Rongen
Author URI: http://www.marijnrongen.com
*/

class MR_Social_Sharing_Toolkit {
	var $options;
	var $types;
	var $share_buttons;
	var $follow_buttons;
	
	function MR_Social_Sharing_Toolkit() {
		/* Declare button types */
		$this->types['none'] = 'Button';
		$this->types['horizontal'] = 'Button + side counter';
		$this->types['vertical'] = 'Button + top counter';
		$this->types['icon_small'] = 'Small icon';
		$this->types['icon_small_text'] = 'Small icon + text';
		$this->types['icon_medium'] = 'Medium icon';
		$this->types['icon_medium_text'] = 'Medium icon + text';
		$this->types['icon_large'] = 'Large icon';
		/* Declare bookmark buttons with options */
		$this->share_buttons['fb_like'] = array('icon' => 'facebook', 'title' => 'Facebook Like', 'types' => array('none', 'horizontal', 'vertical'));
		$this->share_buttons['fb_send'] = array('icon' => 'facebook', 'title' => 'Facebook Send', 'types' => array('none'));
		$this->share_buttons['tw_tweet'] = array('icon' => 'twitter', 'title' => 'Twitter', 'id' => '@', 'types' => array('none', 'horizontal', 'vertical', 'icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->share_buttons['gl_plus'] = array('icon' => 'googleplus', 'title' => 'Google+', 'types' => array('none', 'horizontal', 'vertical'));
		$this->share_buttons['li_share'] = array('icon' => 'linkedin', 'title' => 'LinkedIn', 'types' => array('none', 'icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large', 'horizontal', 'vertical'));
		$this->share_buttons['tu_tumblr'] = array('icon' => 'tumblr', 'title' => 'Tumblr', 'types' => array('none', 'icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->share_buttons['su_stumble'] = array('icon' => 'stumbleupon', 'title' => 'StumbleUpon', 'types' => array('none', 'horizontal', 'vertical', 'icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->share_buttons['dl_delicious'] = array('icon' => 'delicious', 'title' => 'Delicious', 'types' => array('none', 'horizontal', 'vertical', 'icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->share_buttons['dg_digg'] = array('icon' => 'digg', 'title' => 'Digg', 'types' => array('none', 'horizontal', 'vertical', 'icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->share_buttons['rd_reddit'] = array('icon' => 'reddit', 'title' => 'Reddit', 'types' => array('none', 'horizontal', 'vertical', 'icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->share_buttons['ms_myspace'] = array('icon' => 'myspace', 'title' => 'Myspace', 'types' => array('none', 'icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->share_buttons['hv_respect'] = array('icon' => 'hyves', 'title' => 'Hyves Respect', 'types' => array('horizontal'));
		$this->share_buttons['ml_send'] = array('icon' => 'email', 'title' => 'Send email', 'types' => array('none', 'icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		/* Declare follow buttons with options */
		$this->follow_buttons['follow_facebook'] = array('icon' => 'facebook', 'title' => 'Facebook', 'id' => 'id:', 'types' => array('icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->follow_buttons['follow_twitter'] = array('icon' => 'twitter', 'title' => 'Twitter', 'id' => '@', 'types' => array('icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->follow_buttons['follow_plus'] = array('icon' => 'googleplus', 'title' => 'Google+', 'id' => 'id:', 'types' => array('icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->follow_buttons['follow_linked'] = array('icon' => 'linkedin', 'title' => 'LinkedIn', 'id' => 'id:', 'types' => array('icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->follow_buttons['follow_tumblr'] = array('icon' => 'tumblr', 'title' => 'Tumblr', 'id' => 'id:', 'types' => array('icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->follow_buttons['follow_myspace'] = array('icon' => 'myspace', 'title' => 'Myspace', 'id' => 'id:', 'types' => array('icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->follow_buttons['follow_hyves'] = array('icon' => 'hyves', 'title' => 'Hyves', 'id' => 'id:', 'types' => array('icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->follow_buttons['follow_youtube'] = array('icon' => 'youtube', 'title' => 'YouTube', 'id' => 'id:', 'types' => array('icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->follow_buttons['follow_flickr'] = array('icon' => 'flickr', 'title' => 'Flickr', 'id' => 'id:', 'types' => array('icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->follow_buttons['follow_picasa'] = array('icon' => 'picasa', 'title' => 'Picasa', 'id' => 'id:', 'types' => array('icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->follow_buttons['follow_deviant'] = array('icon' => 'deviantart', 'title' => 'deviantArt', 'id' => 'id:', 'types' => array('icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		$this->follow_buttons['follow_rss'] = array('icon' => 'rss', 'title' => 'RSS Feed', 'id' => 'url:', 'types' => array('icon_small', 'icon_small_text', 'icon_medium', 'icon_medium_text', 'icon_large'));
		/* Set defaults and load user options */
		$this->get_options();
	}

	function get_options() {
		foreach ($this->share_buttons as $key => $val) {
			$buttons[$key] = array('enable' => 1, 'type' => $val['types'][0]);
			$widgets[$key] = array('enable' => 1, 'type' => $val['types'][0]);
			$button_order[] = $key;
			$widget_order[] = $key;
		}
		foreach ($this->follow_buttons as $key => $val) {
			$followers[$key] = array('enable' => 1, 'type' => $val['types'][0], 'id' => '');
			$follow_order[] = $key;
		}
		$this->options = array('mr_social_sharing_buttons' => $buttons, 'mr_social_sharing_widget_buttons' => $widgets, 'mr_social_sharing_follow_buttons' => $followers, 'mr_social_sharing_display' => 'span', 'mr_social_sharing_widget_display' => 'span', 'mr_social_sharing_follow_display' => 'span', 'mr_social_sharing_align' => '', 'mr_social_sharing_widget_align' => '', 'mr_social_sharing_follow_align' => '', 'mr_social_sharing_position' => 'none', 'mr_social_sharing_types' => 'both', 'mr_social_sharing_include_excerpts' => 1, 'mr_social_sharing_button_order' => $button_order, 'mr_social_sharing_widget_button_order' => $widget_order, 'mr_social_sharing_follow_button_order' => $follow_order, 'mr_social_sharing_linkify_content' => 0, 'mr_social_sharing_linkify_comments' => 0, 'mr_social_sharing_twitter_handles' => 0, 'mr_social_sharing_twitter_hashtags' => 0, 'mr_social_sharing_js_footer' => 0);
		foreach ($this->options as $key => $val) {
			$this->options[$key] = get_option( $key, $val );
		}
		foreach ($this->share_buttons as $key => $val) {
			if (!array_key_exists($key, $this->options['mr_social_sharing_buttons'])) {
				$this->options['mr_social_sharing_buttons'][$key] = array('enable' => 1, 'type' => $val['types'][0]);
			}
			if (!array_key_exists($key, $this->options['mr_social_sharing_widget_buttons'])) {
				$this->options['mr_social_sharing_widget_buttons'][$key] = array('enable' => 1, 'type' => $val['types'][0]);
			}
			if (!in_array($key, $this->options['mr_social_sharing_button_order'])) {
				$this->options['mr_social_sharing_button_order'][] = $key;
			}
			if (!in_array($key, $this->options['mr_social_sharing_widget_button_order'])) {
				$this->options['mr_social_sharing_widget_button_order'][] = $key;
			}
		}
		foreach ($this->follow_buttons as $key => $val) {
			if (!array_key_exists($key, $this->options['mr_social_sharing_follow_buttons'])) {
				$this->options['mr_social_sharing_follow_buttons'][$key] = array('enable' => 1, 'type' => $val['types'][0], 'id' => '');
			}
			if (!in_array($key, $this->options['mr_social_sharing_follow_button_order'])) {
				$this->options['mr_social_sharing_follow_button_order'][] = $key;
			}
		}
		return $this->options;	
	}
	
	/* Admin functions */
	
	function save_options($new_options) {
		foreach ($this->options as $key => $val) {
			if (array_key_exists($key, $new_options)) {
				update_option( $key, $new_options[$key] );
				$this->options[$key] = $new_options[$key] ;
			} else {
				update_option( $key, 0 );
				$this->options[$key] = 0;	
			}
		}
	}
	
	function plugin_menu() {
		add_options_page('Social Sharing', 'Social Sharing Toolkit', 'manage_options', 'mr_social_sharing', array($this, 'plugin_admin_page'));
		add_filter('plugin_row_meta', array('MR_Social_Sharing_Toolkit', 'plugin_links'),10,2);
		wp_enqueue_style('mr_social_sharing-admin', plugins_url('/admin.css', __FILE__));
		wp_enqueue_script('mr_social_sharing-admin', plugins_url('/admin.js', __FILE__));
		wp_enqueue_script('jquery-ui-sortable');
	}
	
	function plugin_links($links, $file) {
	    if ($file == plugin_basename(__FILE__)) {
	        $links[] = '<a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=P8ZVNC57E58FE&lc=NL&item_name=WordPress%20plugins%20by%20Marijn%20Rongen&item_number=Social%20Sharing%20Toolkit&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted">Donate</a>';
	    }
	    return $links;
	}  
	
	function plugin_admin_page() {
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
    	if( isset($_POST['mr_social_sharing_save_options']) && $_POST['mr_social_sharing_save_options'] == 'Y' ) {
       		$this->save_options($_POST);
      		echo '
       		<div class="updated"><p><strong>'.__('settings saved.', 'mr_social_sharing' ).'</strong></p></div>';	
    	}
		echo '
			<div class="wrap">
				<form method="post" action="">
					<input type="hidden" name="mr_social_sharing_save_options" value="Y"/>
					<h2>Social Sharing Toolkit</h2>
					<p>
						Jump to: <a href="#mr_social_sharing_widget_networks">Posts & pages</a> | <a href="#mr_social_sharing_widget_networks">Share Widget</a> | <a href="#mr_social_sharing_follow_networks">Follow Widget</a> | <a href="#mr_twitter_links">Automatic Twitter links</a><br/>
						<br/>
						<label for="mr_social_sharing_js_footer" class="check"><input type="checkbox" name="mr_social_sharing_js_footer" id="mr_social_sharing_js_footer"';
		if ($this->options['mr_social_sharing_js_footer'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> Load JavaScript in footer</label><br/>
						<span class="description"> '.__("Improves performance but may not work on some themes", 'mr_social_sharing').'</span>
					</p>
					<div class="mr_social_sharing_networks">
						<h3>Posts & pages:</h3>
						<p>
							Check the boxes to display the button on your website. For each button you can select a separate style from the dropdown box. You can change the order of the buttons by dragging them to the desired location in the list. For the tweet button you can also fill in your Twitter username which will then be appended to the tweet (like via @WordPress).
						</p>
						<ul id="mr_social_sharing_networks">';
		foreach ($this->options['mr_social_sharing_button_order'] as $button) {
			echo '
							<li>
								<img src="'.plugins_url('/images/icons_small/'.$this->share_buttons[$button]['icon'].'.png', __FILE__).'" title="'.$this->share_buttons[$button]['title'].'" alt="'.$this->share_buttons[$button]['title'].'"/>
								<label for="mr_social_sharing_'.$button.'"><input type="checkbox" name="mr_social_sharing_buttons['.$button.'][enable]" id="mr_social_sharing_'.$button.'"';
			if ($this->options['mr_social_sharing_buttons'][$button]['enable'] == 1) { echo ' checked="checked"';}
			echo ' value="1" />'.$this->share_buttons[$button]['title'].'</label>
								<img class="right" src="'.plugins_url('/images/move.png', __FILE__).'" title="Change button order" alt="Change button order"/>
								<select name="mr_social_sharing_buttons['.$button.'][type]" id="mr_social_sharing_'.$button.'_type">';
			foreach ($this->share_buttons[$button]['types'] as $type) {
				echo '<option value="'.$type.'"';
				if ($this->options['mr_social_sharing_buttons'][$button]['type'] == $type) { echo ' selected="selected"';}
				echo '>'.$this->types[$type].'</option>';
			}
			if (array_key_exists('id', $this->share_buttons[$button])) {
				echo '
								<input type="text" class="text" name="mr_social_sharing_buttons['.$button.'][id]" id="mr_social_sharing_'.$button.'_id" value="'.$this->options['mr_social_sharing_buttons'][$button]['id'].'"/>
								<label for="mr_social_sharing_'.$button.'_id" class="text">'.$this->share_buttons[$button]['id'].'</label>';
			}
			echo '
								<input type="hidden" name="mr_social_sharing_button_order[]" value="'.$button.'"/>
							</li>';
		}					
		echo '
						</ul>
						<p>
							Choose button orientation horizontal to display the buttons side by side, vertical will place them below each other. You can also select an alignment to better suit your theme.
						</p>
						<label for="mr_social_sharing_display">Button orientation</label>
						<select name="mr_social_sharing_display" id="mr_social_sharing_display">
							<option value="span"';
		if ($this->options['mr_social_sharing_display'] == 'span') { echo ' selected="selected"';}
		echo '>Horizontal</option>
							<option value="div"';
		if ($this->options['mr_social_sharing_display'] == 'div') { echo ' selected="selected"';}
		echo '>Vertical</option>
						</select><br/>
						<label for="mr_social_sharing_align">Button alignment</label>
						<select name="mr_social_sharing_align" id="mr_social_sharing_align">
							<option value=""';
		if ($this->options['mr_social_sharing_align'] == '') { echo ' selected="selected"';}
		echo '>Align to bottom</option>
							<option value="_top"';
		if ($this->options['mr_social_sharing_align'] == '_top') { echo ' selected="selected"';}
		echo '>Align to top</option>
						</select>
						<p>
							Choose where the buttons must be displayed and if the buttons should be displayed on posts, pages or both.
						</p>
						<label for="mr_social_sharing_position">Button location</label>
						<select name="mr_social_sharing_position" id="mr_social_sharing_position">
						<option value="none"';
		if ($this->options['mr_social_sharing_position'] == 'none') { echo ' selected="selected"';}
		echo '>Do not display social bookmarks</option>
										<option value="top"';
		if ($this->options['mr_social_sharing_position'] == 'top') { echo ' selected="selected"';}
		echo '>Display above content</option>
										<option value="bottom"';
		if ($this->options['mr_social_sharing_position'] == 'bottom') { echo ' selected="selected"';}
		echo '>Display below content</option>
									<option value="shortcode"';
		if ($this->options['mr_social_sharing_position'] == 'shortcode') { echo ' selected="selected"';}
		echo '>Let me decide by using shortcode</option>
									</select><br/>';
		if ($this->options['mr_social_sharing_position'] == 'shortcode') { 
			echo '<span class="description"> '.__("Use the shortcode [social_share/] where you want the buttons to appear", 'mr_social_sharing').'</span><br/>';
		}			
		echo '
						<label for="mr_social_sharing_types">Place buttons on</label>
						<select name="mr_social_sharing_types" id="mr_social_sharing_types">
							<option value="both"';
		if ($this->options['mr_social_sharing_types'] == 'both') { echo ' selected="selected"';}
		echo '>On posts and pages</option>
							<option value="posts"';
		if ($this->options['mr_social_sharing_types'] == 'posts') { echo ' selected="selected"';}
		echo '>Only on posts</option>
							<option value="pages"';
		if ($this->options['mr_social_sharing_types'] == 'pages') { echo ' selected="selected"';}
		echo '>Only on pages</option>
						</select>
						<p>
							Uncheck this box if you are having issues displaying the buttons with excerpts (some themes have custom excerpt functions which do not play nice with the plugin).
						</p>
						<label for="mr_social_sharing_include_excerpts" class="check"><input type="checkbox" name="mr_social_sharing_include_excerpts" id="mr_social_sharing_include_excerpts"';
		if ($this->options['mr_social_sharing_include_excerpts'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> Include buttons in excerpts</label>
					</div>
					<p class="submit">
						<input type="submit" name="Submit" class="button-primary" value="'.esc_attr__('Save Changes').'" />
					</p>
					<div class="mr_social_sharing_networks">
						<h3>Share Widget:</h3>
						<p>
							Check the boxes to display the button on Social Sharing Toolkit Share widget. For each button you can select a separate style from the dropdown box. You can change the order of the buttons by dragging them to the desired location in the list. For the tweet button you can also fill in your Twitter username which will then be appended to the tweet (like via @WordPress).<br/>
							<br/>
							For each widget you can enter a fixed url and title for the buttons, to do this <a href="widgets.php">go to the widget configuration page</a>.
						</p>
						<ul id="mr_social_sharing_widget_networks">';
		foreach ($this->options['mr_social_sharing_widget_button_order'] as $button) {
			echo '
							<li>
								<img src="'.plugins_url('/images/icons_small/'.$this->share_buttons[$button]['icon'].'.png', __FILE__).'" title="'.$this->share_buttons[$button]['title'].'" alt="'.$this->share_buttons[$button]['title'].'"/>
								<label for="mr_social_sharing_widget_'.$button.'"><input type="checkbox" name="mr_social_sharing_widget_buttons['.$button.'][enable]" id="mr_social_sharing_widget_'.$button.'"';
			if ($this->options['mr_social_sharing_widget_buttons'][$button]['enable'] == 1) { echo ' checked="checked"';}
			echo ' value="1" />'.$this->share_buttons[$button]['title'].'</label>
								<img class="right" src="'.plugins_url('/images/move.png', __FILE__).'" title="Change button order" alt="Change button order"/>
								<select name="mr_social_sharing_widget_buttons['.$button.'][type]" id="mr_social_sharing_widget_'.$button.'_type">';
			foreach ($this->share_buttons[$button]['types'] as $type) {
				echo '<option value="'.$type.'"';
				if ($this->options['mr_social_sharing_widget_buttons'][$button]['type'] == $type) { echo ' selected="selected"';}
				echo '>'.$this->types[$type].'</option>';
			}
			if (array_key_exists('id', $this->share_buttons[$button])) {
				echo '
								<input type="text" class="text" name="mr_social_sharing_widget_buttons['.$button.'][id]" id="mr_social_sharing_widget_'.$button.'_id" value="'.$this->options['mr_social_sharing_widget_buttons'][$button]['id'].'"/>
								<label for="mr_social_sharing_widget_'.$button.'_id" class="text">'.$this->share_buttons[$button]['id'].'</label>';
			}
			echo '
								<input type="hidden" name="mr_social_sharing_widget_button_order[]" value="'.$button.'"/>
							</li>';
		}					
		echo '
						</ul>
						<p>
							Choose button orientation horizontal to display the buttons side by side, vertical will place them below each other. You can also select an alignment to better suit your theme.
						</p>
						<label for="mr_social_sharing_widget_display">Button orientation</label>
						<select name="mr_social_sharing_widget_display" id="mr_social_sharing_widget_display">
							<option value="span"';
		if ($this->options['mr_social_sharing_widget_display'] == 'span') { echo ' selected="selected"';}
		echo '>Horizontal</option>
							<option value="div"';
		if ($this->options['mr_social_sharing_widget_display'] == 'div') { echo ' selected="selected"';}
		echo '>Vertical</option>
						</select><br/>
						<label for="mr_social_sharing_widget_align">Button alignment</label>
						<select name="mr_social_sharing_widget_align" id="mr_social_widget_sharing_align">
							<option value=""';
		if ($this->options['mr_social_sharing_widget_align'] == '') { echo ' selected="selected"';}
		echo '>Align to bottom</option>
							<option value="_top"';
		if ($this->options['mr_social_sharing_widget_align'] == '_top') { echo ' selected="selected"';}
		echo '>Align to top</option>
						</select>
					</div>
					<p class="submit">
						<input type="submit" name="Submit" class="button-primary" value="'.esc_attr__('Save Changes').'" />
					</p>
					<div class="mr_social_sharing_networks">
						<h3>Follow Widget:</h3>
						<p>
							Check the boxes to display the button on Social Sharing Toolkit Follow widget. For each button you can select a separate style from the dropdown box. You can change the order of the buttons by dragging them to the desired location in the list.<br/>
							<br/>
							For each button you only have to enter your id or username of the network as it appears in the url of your profile page. You will need to enter the complete url for the RSS Feed (including the http:// part) if you wish to display this button.<br/>
							<br/>
							To add the widget to your website <a href="widgets.php">go to the widget configuration page</a>.
						</p>
						<ul id="mr_social_sharing_follow_networks">';
		foreach ($this->options['mr_social_sharing_follow_button_order'] as $button) {
			echo '
							<li>
								<img src="'.plugins_url('/images/icons_small/'.$this->follow_buttons[$button]['icon'].'.png', __FILE__).'" title="'.$this->follow_buttons[$button]['title'].'" alt="'.$this->follow_buttons[$button]['title'].'"/>
								<label for="mr_social_sharing_follow_'.$button.'"><input type="checkbox" name="mr_social_sharing_follow_buttons['.$button.'][enable]" id="mr_social_sharing_follow_'.$button.'"';
			if ($this->options['mr_social_sharing_follow_buttons'][$button]['enable'] == 1) { echo ' checked="checked"';}
			echo ' value="1" />'.$this->follow_buttons[$button]['title'].'</label>
								<img class="right" src="'.plugins_url('/images/move.png', __FILE__).'" title="Change button order" alt="Change button order"/>
								<select name="mr_social_sharing_follow_buttons['.$button.'][type]" id="mr_social_sharing_follow_'.$button.'_type">';
			foreach ($this->follow_buttons[$button]['types'] as $type) {
				echo '<option value="'.$type.'"';
				if ($this->options['mr_social_sharing_follow_buttons'][$button]['type'] == $type) { echo ' selected="selected"';}
				echo '>'.$this->types[$type].'</option>';
			}
			if (array_key_exists('id', $this->follow_buttons[$button])) {
				echo '
								<input type="text" class="text" name="mr_social_sharing_follow_buttons['.$button.'][id]" id="mr_social_sharing_follow_'.$button.'_id" value="'.$this->options['mr_social_sharing_follow_buttons'][$button]['id'].'"/>
								<label for="mr_social_sharing_follow_'.$button.'_id" class="text">'.$this->follow_buttons[$button]['id'].'</label>';
			}
			echo '
								<input type="hidden" name="mr_social_sharing_follow_button_order[]" value="'.$button.'"/>
							</li>';
		}					
		echo '
						</ul>
						<p>
							Choose button orientation horizontal to display the buttons side by side, vertical will place them below each other. You can also select an alignment to better suit your theme.
						</p>
						<label for="mr_social_sharing_follow_display">Button orientation</label>
						<select name="mr_social_sharing_follow_display" id="mr_social_sharing_follow_display">
										<option value="span"';
		if ($this->options['mr_social_sharing_follow_display'] == 'span') { echo ' selected="selected"';}
		echo '>Horizontal</option>
										<option value="div"';
		if ($this->options['mr_social_sharing_follow_display'] == 'div') { echo ' selected="selected"';}
		echo '>Vertical</option>
						</select><br/>
						<label for="mr_social_sharing_follow_align">Button alignment</label>
						<select name="mr_social_sharing_follow_align" id="mr_social_widget_sharing_align">
							<option value=""';
		if ($this->options['mr_social_sharing_follow_align'] == '') { echo ' selected="selected"';}
		echo '>Align to bottom</option>
							<option value="_top"';
		if ($this->options['mr_social_sharing_follow_align'] == '_top') { echo ' selected="selected"';}
		echo '>Align to top</option>
						</select>
					</div>
					<p class="submit">
						<input type="submit" name="Submit" class="button-primary" value="'.esc_attr__('Save Changes').'" />
					</p>
					<div class="mr_social_sharing_networks" id="mr_twitter_links">
						<h3>Automatic Twitter links</h3>
						<p>Select what you want to convert…</p>
						<label for="mr_social_sharing_twitter_handles" class="check"><input type="checkbox" name="mr_social_sharing_twitter_handles" id="mr_social_sharing_twitter_handles"';
		if ($this->options['mr_social_sharing_twitter_handles'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> '.__("Convert Twitter usernames", 'mr_social_sharing').'</label><br/>
						<label for="mr_social_sharing_twitter_hashtags" class="check"><input type="checkbox" name="mr_social_sharing_twitter_hashtags" id="mr_social_sharing_twitter_hashtags"';
		if ($this->options['mr_social_sharing_twitter_hashtags'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> '.__("Convert hashtags", 'mr_social_sharing').'</label>
						<p>... and where it should be converted</p>
						<label for="mr_social_sharing_linkify_content" class="check"><input type="checkbox" name="mr_social_sharing_linkify_content" id="mr_social_sharing_linkify_content"';
		if ($this->options['mr_social_sharing_linkify_content'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> '.__("Convert in posts and pages", 'mr_social_sharing').'</label><br/>
						<label for="mr_social_sharing_linkify_comments" class="check"><input type="checkbox" name="mr_social_sharing_linkify_comments" id="mr_social_sharing_linkify_comments"';
		if ($this->options['mr_social_sharing_linkify_comments'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> '.__("Convert in comments", 'mr_social_sharing').'</label>
					</div>
					<p class="submit">
						<input type="submit" name="Submit" class="button-primary" value="'.esc_attr__('Save Changes').'" />
					</p>
					<div class="mr_social_sharing_networks"> 
						<h3>Thank you for using the Social Sharing Toolkit!</h3>
						<p>
							For questions or requests about this plugin please use the <a href="http://www.marijnrongen.com/wordpress-plugins/social-sharing-toolkit/" target="_blank">official plugin page</a>. 
							If you like the plugin I would appreciate it if you provide a rating of the <a href="http://wordpress.org/extend/plugins/social-sharing-toolkit/" target="_blank">plugin on WordPress.org</a>. If you really like the plugin you can also <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=P8ZVNC57E58FE&lc=NL&item_name=WordPress%20plugins%20by%20Marijn%20Rongen&item_number=Social%20Sharing%20Toolkit&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted" target="_blank">donate here</a>.
						</p>
					</div>
				</form>
			</div>';
	}
	
	/* Output functions */
	
	function should_share_content() {
		wp_enqueue_style('mr_social_sharing', plugins_url('/style.css', __FILE__));
		wp_enqueue_script('mr_social_sharing', plugins_url('script.js', __FILE__), array('jquery'), array(), false, true);
		if ($this->options['mr_social_sharing_buttons']['gl_plus']['enable'] == 1 || $this->options['mr_social_sharing_widget_buttons']['gl_plus']['enable'] == 1) {
			if ($this->options['mr_social_sharing_js_footer'] == 1) {
				wp_enqueue_script('GooglePlus', 'http://apis.google.com/js/plusone.js', array(), false, true);
			} else {
				wp_enqueue_script('GooglePlus', 'http://apis.google.com/js/plusone.js');
			}
		}
		if ($this->options['mr_social_sharing_buttons']['dg_digg']['enable'] == 1 || $this->options['mr_social_sharing_widget_buttons']['dg_digg']['enable'] == 1) {
			if ($this->options['mr_social_sharing_buttons']['dg_digg']['type'] == 'horizontal' || $this->options['mr_social_sharing_buttons']['dg_digg']['type'] == 'vertical' || $this->options['mr_social_sharing_widget_buttons']['dg_digg']['type'] == 'horizontal' || $this->options['mr_social_sharing_widget_buttons']['dg_digg']['type'] == 'vertical') {
				if ($this->options['mr_social_sharing_js_footer'] == 1) {
					wp_enqueue_script('Digg', plugins_url('/digg.js', __FILE__), array(), false, true);
				} else {
					wp_enqueue_script('Digg', plugins_url('/digg.js', __FILE__));
				}
			}
		}
		if ($this->options['mr_social_sharing_buttons']['li_share']['enable'] == 1 || $this->options['mr_social_sharing_widget_buttons']['li_share']['enable'] == 1) {
			if ($this->options['mr_social_sharing_buttons']['li_share']['type'] == 'horizontal' || $this->options['mr_social_sharing_buttons']['li_share']['type'] == 'vertical' || $this->options['mr_social_sharing_buttons']['li_share']['type'] == 'none' || $this->options['mr_social_sharing_widget_buttons']['li_share']['type'] == 'horizontal' || $this->options['mr_social_sharing_widget_buttons']['li_share']['type'] == 'vertical' || $this->options['mr_social_sharing_widget_buttons']['li_share']['type'] == 'none') {
				if ($this->options['mr_social_sharing_js_footer'] == 1) {
					wp_enqueue_script('LinkedIn', 'http://platform.linkedin.com/in.js', array(), false, true);
				} else {
					wp_enqueue_script('LinkedIn', 'http://platform.linkedin.com/in.js');
				}
			}
		}
		if ($this->options['mr_social_sharing_buttons']['fb_send']['enable'] == 1 || $this->options['mr_social_sharing_widget_buttons']['fb_send']['enable'] == 1) {
			if ($this->options['mr_social_sharing_js_footer'] == 1) {
				wp_enqueue_script('FacebookSend', 'http://connect.facebook.net/en_US/all.js#xfbml=1', array(), false, true);
			} else {
				wp_enqueue_script('FacebookSend', 'http://connect.facebook.net/en_US/all.js#xfbml=1');
			}
		}
		if ($this->options['mr_social_sharing_buttons']['tw_tweet']['enable'] == 1 || $this->options['mr_social_sharing_widget_buttons']['tw_tweet']['enable'] == 1) {
			if ($this->options['mr_social_sharing_buttons']['tw_tweet']['type'] == 'horizontal' || $this->options['mr_social_sharing_buttons']['tw_tweet']['type'] == 'vertical' || $this->options['mr_social_sharing_widget_buttons']['tw_tweet']['type'] == 'horizontal' || $this->options['mr_social_sharing_widget_buttons']['tw_tweet']['type'] == 'vertical') {
				if ($this->options['mr_social_sharing_js_footer'] == 1) {
					wp_enqueue_script('Twitter', 'http://platform.twitter.com/widgets.js', array(), false, true);
				} else {
					wp_enqueue_script('Twitter', 'http://platform.twitter.com/widgets.js');
				}
			}
		}
		if ($this->options['mr_social_sharing_position'] == 'none' || $this->options['mr_social_sharing_position'] == 'shortcode') {
			return false;
		} 
		return true;
	}
	
	function create_bookmarks($url = '', $title = '', $type = '') {
		$url = trim($url);
		$title = trim($title);
		$title = html_entity_decode($title, ENT_QUOTES, 'UTF-8');
		if ($url == '') {
			$url = 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];	
		}
		$bookmarks = '
				<!-- Social Sharing Toolkit v2.0.3 | http://www.marijnrongen.com/wordpress-plugins/social_sharing_toolkit/ -->
				<div class="mr_social_sharing_wrapper">';
		foreach ($this->options['mr_social_sharing_'.$type.'button_order'] as $button) {
			if ($this->options['mr_social_sharing_'.$type.'buttons'][$button]['enable'] == 1) {
				$id = array_key_exists('id', $this->options['mr_social_sharing_'.$type.'buttons'][$button]) ? $this->options['mr_social_sharing_'.$type.'buttons'][$button]['id'] : '';
				$bookmarks .= $this->get_bookmark_button($button, $url, $title, $this->options['mr_social_sharing_'.$type.'buttons'][$button]['type'], $this->options['mr_social_sharing_'.$type.'display'], $this->options['mr_social_sharing_'.$type.'align'], $id);
			}
		}		
		$bookmarks .= '
				</div>';
		return $bookmarks;	
	}
	
	function create_followers() {
		$followers = '
				<!-- Social Sharing Toolkit v2.0.3 | http://www.marijnrongen.com/wordpress-plugins/social_sharing_toolkit/ -->
				<div class="mr_social_sharing_wrapper">';
		foreach ($this->options['mr_social_sharing_follow_button_order'] as $button) {
			if ($this->options['mr_social_sharing_follow_buttons'][$button]['enable'] == 1) {
				$id = array_key_exists('id', $this->options['mr_social_sharing_follow_buttons'][$button]) ? $this->options['mr_social_sharing_follow_buttons'][$button]['id'] : '';
				$followers .= $this->get_follow_button($button, $this->options['mr_social_sharing_follow_buttons'][$button]['type'], $this->options['mr_social_sharing_follow_display'], $this->options['mr_social_sharing_follow_align'], $id);
			}
		}		
		$followers .= '
				</div>';
		return $followers;
	}
	
	function get_bookmark_button($button, $url, $title, $type, $display = 'span', $align = '', $id = '') {
		$button = 'get_'.$button;
		$retval = '<'.$display.' class="mr_social_sharing'.$align.'">'.$this->$button($url, $title, $type, $id).'</'.$display.'>';
		return $retval;
	}
	
	function get_follow_button($button, $type, $display = 'span', $align = '', $id = '') {
		$button = 'get_'.$button;
		$retval = '<'.$display.' class="mr_social_sharing'.$align.'">'.$this->$button($type, $id).'</'.$display.'>';
		return $retval;
	}
	
	function get_fb_like($url, $title, $type, $id) {
		$retval = '<iframe src="https://www.facebook.com/plugins/like.php?locale=en_US&amp;href='.urlencode($url).'&amp;layout=';
		switch ($type) {
			case 'horizontal':
				$retval .= 'button_count';
				$width = '90px';
				$height = '20px';
				break;
			case 'vertical':
				$retval .= 'box_count';
				$width = '55px';
				$height = '65px';
				break;
			default:
				$retval .= 'standard';
				$width = 'auto';
				$height = '24px';
				break;
		}
		$retval .= '&amp;show_faces=false&amp;width='.$width.'&amp;height='.$height.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'; height:'.$height.';" allowTransparency="true"></iframe>';
		return $retval;
	}
	
	function get_fb_send($url, $title, $type, $id) {
		$retval = '<div id="fb-root"></div><fb:send href="'.$url.'" font=""></fb:send>';
		return $retval;			
	}
	
	function get_tw_tweet($url, $title, $type, $id) {
		switch ($type) {
			case 'horizontal':
				$retval = '<a href="http://twitter.com/share" class="twitter-share-button" data-url="'.$url.'" data-count="horizontal"';
				if ($id != '') {
					$retval .= ' data-via="'.$id.'"';
				}
				$retval .= ' data-text="'.$title.'">Tweet</a>';
				break;
			case 'vertical':
				$retval = '<a href="http://twitter.com/share" class="twitter-share-button" data-url="'.$url.'" data-count="vertical"';
				if ($id != '') {
					$retval .= ' data-via="'.$id.'"';
				}
				$retval .= ' data-text="'.$title.'">Tweet</a>';
				break;
			default:
				$url = 'http://twitter.com/share?url='.urlencode($url).'&amp;text='.urlencode($title);
				if ($id != '') {
					$url .= '&amp;via='.$id;
				}
				$title = 'Share on Twitter';
				$text = 'Share on Twitter';
				$icon = 'twitter';
				$retval = $this->get_icon($type, $url, $title, $text, $icon, true);
				break;
		}		
		return $retval;
	}
	
	function get_gl_plus($url, $title, $type, $id) {
		$retval = '<g:plusone';
		switch ($type) {
			case 'horizontal':
				$retval .= ' size="medium"';
				break;
			case 'vertical':
				$retval .= ' size="tall"';
				break;
			default:
				$retval .= ' size="medium" count="false"';
				break;
		}
		$retval .= ' href="'.$url.'"></g:plusone>';
		return $retval;
	}
	
	function get_li_share($url, $title, $type, $id) {
		switch ($type) {
			case 'horizontal':
				$retval = '<script type="IN/Share" data-url="'.$url.'" data-counter="right"></script>';
				break;
			case 'vertical':
				$retval = '<script type="IN/Share" data-url="'.$url.'" data-counter="top"></script>';
				break;
			case 'none':
				$retval = '<script type="IN/Share" data-url="'.$url.'"></script>';
				break;
			default:
				$url = 'http://www.linkedin.com/shareArticle?mini=true&amp;url='.urlencode($url).'&amp;title='.urlencode($title);
				$title = 'Share on LinkedIn';
				$text = 'Share on LinkedIn';
				$icon = 'linkedin';
				$retval = $this->get_icon($type, $url, $title, $text, $icon, true);
				break;
		}
		return $retval;
	}
	
	function get_tu_tumblr($url, $title, $type, $id) {
		$url = 'http://www.tumblr.com/share/link?url='.urlencode($url).'&amp;name='.urlencode($title);
		$title = 'Share on Tumblr';
		$text = 'Share on Tumblr';
		$icon = 'tumblr';
		return $this->get_icon($type, $url, $title, $text, $icon, true);
	}
	
	function get_su_stumble($url, $title, $type, $id) {
		switch ($type) {
			case 'horizontal':
				$retval = '<script src="http://www.stumbleupon.com/hostedbadge.php?s=1&amp;r='.urlencode($url).'"></script>';
				break;
			case 'vertical':
				$retval = '<script src="http://www.stumbleupon.com/hostedbadge.php?s=5&amp;r='.urlencode($url).'"></script>';
				break;
			default:
				$url = 'http://www.stumbleupon.com/submit?url='.urlencode($url).'&amp;title='.urlencode($title);
				$title = 'Submit to StumbleUpon';
				$text = 'Submit to StumbleUpon';
				$icon = 'stumbleupon';
				$retval = $this->get_icon($type, $url, $title, $text, $icon, true);
				break;
		}
		return $retval;
	}
	
	function get_dl_delicious($url, $title, $type, $id) {		
		switch ($type) {
			case 'horizontal':
				$hash = md5($url);
				$retval = '<div class="delicious_horizontal"><span class="delicious_hash">'.$hash.'</span><a class="mr_social_sharing_popup_link" href="http://del.icio.us/post?v=4&amp;noui&amp;jump=close&amp;url='.urlencode($url).'&amp;title='.urlencode($title).'" target="_blank"></a></div>'; 
				break;
			case 'vertical':
				$hash = md5($url);
				$retval = '<div class="delicious_vertical"><span class="delicious_hash">'.$hash.'</span><a class="mr_social_sharing_popup_link" href="http://del.icio.us/post?v=4&amp;noui&amp;jump=close&amp;url='.urlencode($url).'&amp;title='.urlencode($title).'" target="_blank"></a></div>'; 
				break;
			default:
				$url = 'http://del.icio.us/post?url='.urlencode($url).'&amp;title='.urlencode($title);
				$title = 'Save on Delicious';
				$text = 'Save on Delicious';
				$icon = 'delicious';
				$retval = $this->get_icon($type, $url, $title, $text, $icon, true);
				break;
		}
		return $retval;			
	}
	
	function get_dg_digg($url, $title, $type, $id) {
		switch ($type) {
			case 'horizontal':
				$retval = '<a class="DiggThisButton DiggCompact" href="http://digg.com/submit?url='.urlencode($url).'&amp;title='.urlencode($title).'"></a>';
				break;
			case 'vertical':
				$retval = '<a class="DiggThisButton DiggMedium" href="http://digg.com/submit?url='.urlencode($url).'&amp;title='.urlencode($title).'"></a>';
				break;
			default:
				$url = 'http://digg.com/submit?url='.urlencode($url).'&amp;title='.urlencode($title);
				$title = 'Digg This';
				$text = 'Digg This';
				$icon = 'digg';
				$retval = $this->get_icon($type, $url, $title, $text, $icon, true);
				break;
		}			
		return $retval;
	}
	
	function get_rd_reddit($url, $title, $type, $id) {
		switch ($type) {
			case 'horizontal':
				$retval = '<script type="text/javascript">
							  reddit_url = "'.$url.'";
							  reddit_title = "'.$title.'";
							</script>
							<script type="text/javascript" src="http://www.reddit.com/static/button/button1.js"></script>';
				break;
			case 'vertical':
				$retval = '<script type="text/javascript">
							  reddit_url = "'.$url.'";
							  reddit_title = "'.$title.'";
							</script><script type="text/javascript" src="http://www.reddit.com/static/button/button2.js"></script>';
				break;
			default:
				$url = 'http://www.reddit.com/submit?url='.urlencode($url);
				$title = 'Submit to reddit';
				$text = 'Submit to reddit';
				$icon = 'reddit';
				$retval = $this->get_icon($type, $url, $title, $text, $icon, true);
				break;
		}
		return $retval;
	}
	
	function get_ms_myspace($url, $title, $type, $id) {
		$url = 'http://www.myspace.com/Modules/PostTo/Pages/?t='.urlencode($title).'&amp;u='.urlencode($url);
		$title = 'Share on Myspace';
		$text = 'Share on Myspace';
		$icon = 'myspace';
		return $this->get_icon($type, $url, $title, $text, $icon, true);
	}
	
	function get_hv_respect($url, $title, $type, $id) {
		$retval = '<iframe src="http://www.hyves.nl/respect/button?url='.urlencode($url).'&amp;title='.urlencode($title).'" style="border: medium none; overflow:hidden; width:150px; height:21px;" scrolling="no" frameborder="0" allowTransparency="true" ></iframe>';
		return $retval;
	}
	
	function get_ml_send($url, $title, $type, $id) {	
		$url = 'mailto:?subject='.$title.'&amp;body='.$url;
		$title = 'Share via email';
		$text = 'Share via email';
		$icon = 'email';
		return $this->get_icon($type, $url, $title, $text, $icon);		
	}
	
	function get_follow_facebook($type, $id) {
		$url = 'http://www.facebook.com/'.$id;
		$title = 'Friend me on Facebook';
		$text = 'Facebook';
		$icon = 'facebook';
		return $this->get_icon($type, $url, $title, $text, $icon);
	}
	
	function get_follow_twitter($type, $id) {
		$url = 'http://twitter.com/'.$id;
		$title = 'Follow me on Twitter';
		$text = 'Twitter';
		$icon = 'twitter';
		return $this->get_icon($type, $url, $title, $text, $icon);
	}
	
	function get_follow_plus($type, $id) {
		$url = 'http://plus.google.com/'.$id;
		$title = 'Add me to your circles';
		$text = 'Google+';
		$icon = 'googleplus';
		return $this->get_icon($type, $url, $title, $text, $icon);
	}
	
	function get_follow_linked($type, $id) {
		$url = 'http://www.linkedin.com/in/'.$id;
		$title = 'Connect to me on LinkedIn';
		$text = 'LinkedIn';
		$icon = 'linkedin';
		return $this->get_icon($type, $url, $title, $text, $icon);
	}
	
	function get_follow_tumblr($type, $id) {
		$url = 'http://'.$id.'.tumblr.com';
		$title = 'Follow me on Tumblr';
		$text = 'Tumblr';
		$icon = 'tumblr';
		return $this->get_icon($type, $url, $title, $text, $icon);
	}
	
	function get_follow_myspace($type, $id) {
		$url = 'http://www.myspace.com/'.$id;
		$title = 'Friend me on Myspace';
		$text = 'Myspace';
		$icon = 'myspace';
		return $this->get_icon($type, $url, $title, $text, $icon);
	}
	
	function get_follow_hyves($type, $id) {
		$url = 'http://'.$id.'.hyves.nl';
		$title = 'Friend me on Hyves';
		$text = 'Hyves';
		$icon = 'hyves';
		return $this->get_icon($type, $url, $title, $text, $icon);
	}
	
	function get_follow_youtube($type, $id) {
		$url = 'http://www.youtube.com/user/'.$id;
		$title = 'Watch me on YouTube';
		$text = 'YouTube';
		$icon = 'youtube';
		return $this->get_icon($type, $url, $title, $text, $icon);
	}
	
	function get_follow_flickr($type, $id) {
		$url = 'http://www.flickr.com/photos/'.$id;
		$title = 'My photostream on Flickr';
		$text = 'Flickr';
		$icon = 'flickr';
		return $this->get_icon($type, $url, $title, $text, $icon);
	}
	
	function get_follow_picasa($type, $id) {
		$url = 'http://picasaweb.google.com/'.$id;
		$title = 'My Picasa Web Albums';
		$text = 'Picasa';
		$icon = 'picasa';
		return $this->get_icon($type, $url, $title, $text, $icon);
	}
	
	function get_follow_deviant($type, $id) {
		$url = 'http://'.$id.'.deviantart.com/';
		$title = 'My deviantArt';
		$text = 'deviantArt';
		$icon = 'deviantart';
		return $this->get_icon($type, $url, $title, $text, $icon);
	}
	
	function get_follow_rss($type, $id) {
		$url = $id;
		$title = 'RSS Feed';
		$text = 'RSS Feed';
		$icon = 'rss';
		return $this->get_icon($type, $url, $title, $text, $icon);
	}
	
	function get_icon($type, $url, $title, $text, $icon, $popup = false) {
		if ($icon != 'email') {
			$url .= '" target="_blank';
		}
		if ($popup) {
			$url .= '" class="mr_social_sharing_popup_link';	
		}
		switch ($type) {
			case 'none':
				$retval = '<a href="'.$url.'"><img src="'.plugins_url('/images/buttons/'.$icon.'.png', __FILE__).'" alt="'.$title.'" title="'.$title.'"/></a>';
				break;
			case 'icon_small':
				$retval = '<a href="'.$url.'"><img src="'.plugins_url('/images/icons_small/'.$icon.'.png', __FILE__).'" alt="'.$title.'" title="'.$title.'"/></a>';
				break;
			case 'icon_small_text':
				$retval = '<a href="'.$url.'"><img src="'.plugins_url('/images/icons_small/'.$icon.'.png', __FILE__).'" alt="'.$title.'" title="'.$title.'"/><span class="mr_small_icon">'.$text.'</span></a>';
				break;
			case 'icon_medium':
				$retval = '<a href="'.$url.'"><img src="'.plugins_url('/images/icons_medium/'.$icon.'.png', __FILE__).'" alt="'.$title.'" title="'.$title.'"/></a>';
				break;
			case 'icon_medium_text':
				$retval = '<a href="'.$url.'"><img src="'.plugins_url('/images/icons_medium/'.$icon.'.png', __FILE__).'" alt="'.$title.'" title="'.$title.'"/><span class="mr_medium_icon">'.$text.'</span></a>';
				break;
			case 'icon_large':
				$retval = '<a href="'.$url.'"><img src="'.plugins_url('/images/icons_large/'.$icon.'.png', __FILE__).'" alt="'.$title.'" title="'.$title.'"/></a>';
				break;
			default:
				$retval = '<a href="'.$url.'"><img src="'.plugins_url('/images/icons_small/'.$icon.'.png', __FILE__).'" alt="'.$title.'" title="'.$title.'"/></a>';
				break;
		}		
		return $retval;	
	}
	
	function share($content) {
		$type = get_post_type().'s';
		if (($this->options['mr_social_sharing_types'] == $type || $this->options['mr_social_sharing_types'] == 'both') && (($type != 'pages' && (is_single() || $this->options['mr_social_sharing_include_excerpts'] == 1)) || $type == 'pages' && !is_single())) {
			if ($this->options['mr_social_sharing_position'] == 'top') {
				$bookmarks = $this->create_bookmarks(get_permalink(), the_title('','',false));
				$content = $bookmarks.$content;	
			}
			if ($this->options['mr_social_sharing_position'] == 'bottom') {
				$bookmarks = $this->create_bookmarks(get_permalink(), the_title('','',false));
				$content .= $bookmarks;
			}
		}
		return $content;
	}
	
	function share_shortcode() {
		$bookmarks = '';
		if ($this->options['mr_social_sharing_position'] == 'shortcode' && (is_single() || $this->options['mr_social_sharing_include_excerpts'] == 1)) {
			$bookmarks = $this->create_bookmarks(get_permalink(), the_title('','',false));
		}
		return $bookmarks;
	}
	
	function should_linkify_content() {
		if ($this->options['mr_social_sharing_linkify_content'] == 1) {
			return true;
		}
		return false;
	}
	
	function should_linkify_comments() {
		if ($this->options['mr_social_sharing_linkify_comments'] == 1) {
			return true;
		}
		return false;
	}
	
	function linkify($content) {
		if ($this->options['mr_social_sharing_twitter_handles'] == 1) {
			$content = preg_replace("/(^|\s)*(@([a-zA-Z0-9-_]{1,15}))(\.*[^|\n|\r|\t|\s|\<|\&]*)/i", "$1<a href=\"http://twitter.com/$3\">$2</a>$4", $content);
		}
		if ($this->options['mr_social_sharing_twitter_hashtags'] == 1) {
			$content = preg_replace("/(^|\s)*((?:(?<!&))#([a-zA-Z0-9]+^[-|;]))([^|\n|\r|\t|\s|\.|\<|\&]*)/i", "$1<a href=\"http://twitter.com/search/$3\">$2</a>$4", $content);
		}
		return $content;
	}
}
class MR_Social_Sharing_Toolkit_Widget extends WP_Widget {
	function MR_Social_Sharing_Toolkit_Widget() {
		$widget_ops = array( 'classname' => 'MR_Social_Sharing_Toolkit_Widget', 'description' => '' );
		$control_ops = array( 'id_base' => 'mr-social-sharing-toolkit-widget' );
		$this->WP_Widget( 'mr-social-sharing-toolkit-widget', 'Social Sharing Toolkit Share Widget', $widget_ops, $control_ops );
	}

	function widget ( $args, $instance) {
		extract( $args );
		$MR_Social_Sharing_Toolkit = new MR_Social_Sharing_Toolkit();
		$widget_title = empty($instance['widget_title']) ? '' : $instance['widget_title'];
		$url = empty($instance['fixed_url']) ? '' : $instance['fixed_url'];
		$title = empty($instance['fixed_title']) ? wp_title('', false) : $instance['fixed_title'];
		$bookmarks = $MR_Social_Sharing_Toolkit->create_bookmarks($url, $title, 'widget_');	
		echo $before_widget;
		if ($widget_title != '') {
			echo $before_title . $widget_title . $after_title;
		}
		echo $bookmarks;
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['widget_title'] = $new_instance['widget_title'];
		$instance['fixed_title'] = $new_instance['fixed_title'];
		$instance['fixed_url'] = $new_instance['fixed_url'];
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array( 'widget_title' => '', 'fixed_title' => '', 'fixed_url' => ''));
		echo '			
		<p>
			<label for="'.$this->get_field_id( 'widget_title' ).'">Title:</label>
			<input class="widefat" id="'.$this->get_field_id( 'widget_title' ).'" name="'.$this->get_field_name( 'widget_title' ).'" value="'.$instance['widget_title'].'" />
		</p>	
		<p>
			<label for="'.$this->get_field_id( 'fixed_title' ).'">Title:</label>
			<input class="widefat" id="'.$this->get_field_id( 'fixed_title' ).'" name="'.$this->get_field_name( 'fixed_title' ).'" value="'.$instance['fixed_title'].'" />
		</p>
		<p>
			<label for="'.$this->get_field_id( 'fixed_url' ).'">Url:</label>
			<input class="widefat" id="'.$this->get_field_id( 'fixed_url' ).'" name="'.$this->get_field_name( 'fixed_url' ).'" value="'.$instance['fixed_url'].'" />
		</p>
		<p>
			Further configuration is done via the <a href="options-general.php?page=mr_social_sharing#mr_social_sharing_widget_networks">plugin admin screen</a>.
		</p>';
	}
}
class MR_Social_Sharing_Toolkit_Follow_Widget extends WP_Widget {
	function MR_Social_Sharing_Toolkit_Follow_Widget() {
		$widget_ops = array( 'classname' => 'MR_Social_Sharing_Toolkit_Follow_Widget', 'description' => '' );
		$control_ops = array( 'id_base' => 'mr-social-sharing-toolkit-follow-widget' );
		$this->WP_Widget( 'mr-social-sharing-toolkit-follow-widget', 'Social Sharing Toolkit Follow Widget', $widget_ops, $control_ops );
	}

	function widget ( $args, $instance) {
		extract( $args );
		$MR_Social_Sharing_Toolkit = new MR_Social_Sharing_Toolkit();
		$widget_title = empty($instance['widget_title']) ? '' : $instance['widget_title'];
		$followers = $MR_Social_Sharing_Toolkit->create_followers();	
		echo $before_widget;
		if ($widget_title != '') {
			echo $before_title . $widget_title . $after_title;
		}
		echo $followers;
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['widget_title'] = $new_instance['widget_title'];
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array( 'widget_title' => ''));
		echo '			
		<p>
			<label for="'.$this->get_field_id( 'widget_title' ).'">Title:</label>
			<input class="widefat" id="'.$this->get_field_id( 'widget_title' ).'" name="'.$this->get_field_name( 'widget_title' ).'" value="'.$instance['widget_title'].'" />
		</p>
		<p>
			Further configuration is done via the <a href="options-general.php?page=mr_social_sharing#mr_social_sharing_follow_networks">plugin admin screen</a>.
		</p>';
	}	
}
$MR_Social_Sharing_Toolkit = new MR_Social_Sharing_Toolkit();
if ($MR_Social_Sharing_Toolkit->should_linkify_content()) {
	add_filter('the_content', array($MR_Social_Sharing_Toolkit, 'linkify'));
}
if ($MR_Social_Sharing_Toolkit->should_linkify_comments()) {
	add_filter('comment_text', array($MR_Social_Sharing_Toolkit, 'linkify'));
}
if ($MR_Social_Sharing_Toolkit->should_share_content()) {
	add_filter( 'the_content', array($MR_Social_Sharing_Toolkit, 'share'));
}
add_shortcode('social_share', array($MR_Social_Sharing_Toolkit, 'share_shortcode'));
/* Register widgets */
add_action('widgets_init', create_function('', 'return register_widget("MR_Social_Sharing_Toolkit_Widget");'));
add_action('widgets_init', create_function('', 'return register_widget("MR_Social_Sharing_Toolkit_Follow_Widget");'));
/* Register plugin admin page */
add_action('admin_menu', array($MR_Social_Sharing_Toolkit, 'plugin_menu'));