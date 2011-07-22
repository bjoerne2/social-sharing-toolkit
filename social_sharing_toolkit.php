<?php
/*
Plugin Name: Social Sharing Toolkit
Plugin URI: http://www.marijnrongen.com/wordpress-plugins/social_sharing_toolkit/
Description: This plugin enables sharing of your content via popular social networks and can also convert Twitter names and hashtags to links. Easy & configurable.
Version: 1.0.0
Author: Marijn Rongen
Author URI: http://www.marijnrongen.com
*/

class MR_Social_Sharing_Toolkit {
	var $options;
	
	function MR_Social_Sharing_Toolkit() {
		$this->get_options();
	}

	function get_options() {
		$this->options = array('share' => 1, 'like' => 1, 'tweet' => 1, 'tumblr' => 1, 'stumble' => 1, 'plus' => 1, 'digg' => 1, 'reddit' => 1, 'myspace' => 1, 'hyves' => 1, 'position' => 'none', 'layout' => 'none', 'linkify_content' => 0, 'linkify_comments' => 0, 'twitter_handles' => 0, 'twitter_hashtags' => 0);
		foreach ($this->options as $key => $val) {
			$this->options[$key] = get_option( $key, $val );
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
	}
	
	function plugin_admin_page() {
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
    	if( isset($_POST['mr_save_options']) && $_POST['mr_save_options'] == 'Y' ) {
       		$this->save_options($_POST);
      		echo '
       		<div class="updated"><p><strong>'.__('settings saved.', 'mr_social_sharing' ).'</strong></p></div>';	
    	}
		echo '
			<div class="wrap">
				<form method="post" action="">
					<input type="hidden" name="mr_save_options" value="Y"/>
					<h2>Social Sharing Toolkit</h2>
					<h3>Configure buttons</h3>
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row">
									<label for="position">Button location</label>
								</th>
								<td>
									<select name="position" id="position">
									<option value="none"';
		if ($this->options['position'] == 'none') { echo ' selected="selected"';}
		echo '>Do not display social bookmarks</option>
										<option value="top"';
		if ($this->options['position'] == 'top') { echo ' selected="selected"';}
		echo '>Display above content</option>
										<option value="bottom"';
		if ($this->options['position'] == 'bottom') { echo ' selected="selected"';}
		echo '>Display below content</option>
									<option value="shortcode"';
		if ($this->options['position'] == 'shortcode') { echo ' selected="selected"';}
		echo '>Let me decide by using shortcode</option>
									</select>';
		if ($this->options['position'] == 'shortcode') { 
			echo '<span class="description"> '.__("Use the shortcode [social_share/] where you want the buttons to appear", 'mr_social_sharing').'</span>';
		}			
		echo '
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label for="layout">Choose a layout</label>
								</th>
								<td>
									<select name="layout" id="layout">
										<option value="none"';
		if ($this->options['layout'] == 'none') { echo ' selected="selected"';}
		echo '>Small buttons without counters</option>
										<option value="horizontal"';
		if ($this->options['layout'] == 'horizontal') { echo ' selected="selected"';}
		echo '>Wider buttons with counters</option>
										<option value="vertical"';
		if ($this->options['layout'] == 'vertical') { echo ' selected="selected"';}
		echo '>Higher buttons with counters</option>
									</select>';
		if ($this->options['layout'] != 'none') { 
			echo '<span class="description"> '.__("Counters may not be available for every network", 'mr_social_sharing').'</span>';
		}
		echo '
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label>Select networks to use</label>
								</th>
								<td>
									<label for="like"><input type="checkbox" name="like" id="like"';
		if ($this->options['like'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> Facebook</label><br/>
									<label for="tweet"><input type="checkbox" name="tweet" id="tweet"';
		if ($this->options['tweet'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> Twitter</label><br/>
									<label for="plus"><input type="checkbox" name="plus" id="plus"';
		if ($this->options['plus'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> Google +1</label><br/>
									<label for="share"><input type="checkbox" name="share" id="share"';
		if ($this->options['share'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> LinkedIn</label><br/>
									<label for="tumblr"><input type="checkbox" name="tumblr" id="tumblr"';
		if ($this->options['tumblr'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> Tumblr</label><span class="description"> '.__("Only available without counters", 'mr_social_sharing').'</span><br/>
									<label for="stumble"><input type="checkbox" name="stumble" id="stumble"';
		if ($this->options['stumble'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> StumbleUpon</label><br/>
									<label for="digg"><input type="checkbox" name="digg" id="digg"';
		if ($this->options['digg'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> Digg</label><br/>
									<label for="reddit"><input type="checkbox" name="reddit" id="reddit"';
		if ($this->options['reddit'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> Reddit</label><br/>
									<label for="myspace"><input type="checkbox" name="myspace" id="myspace"';
		if ($this->options['myspace'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> MySpace</label><span class="description"> '.__("Only available without counters", 'mr_social_sharing').'</span><br/>
									<label for="hyves"><input type="checkbox" name="hyves" id="hyves"';
		if ($this->options['hyves'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> Hyves</label><span class="description"> '.__("Only available with horizontal counters", 'mr_social_sharing').'</span>
								</td>
							</tr>
						</tbody>
					</table>
					<h3>Automatic Twitter links</h3>
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row">
									<label>Select what you want to convert...</label>
								</th>
								<td>
									<label><input type="checkbox" name="twitter_handles" id="twitter_handles"';
		if ($this->options['twitter_handles'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> '.__("Convert Twitter usernames", 'mr_social_sharing').'</label><br/>
									<label><input type="checkbox" name="twitter_hashtags" id="twitter_hashtags"';
		if ($this->options['twitter_hashtags'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> '.__("Convert hashtags", 'mr_social_sharing').'</label>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label>... and where it should be converted</label>
								</th>
								<td>
									<label><input type="checkbox" name="linkify_content" id="linkify_content"';
		if ($this->options['linkify_content'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> '.__("Convert in posts and pages", 'mr_social_sharing').'</label><br/>
									<label><input type="checkbox" name="linkify_comments" id="linkify_comments"';
		if ($this->options['linkify_comments'] == 1) { echo ' checked="checked"';}
		echo ' value="1" /> '.__("Convert in comments", 'mr_social_sharing').'</label>
								</td>
							</tr>
						</tbody>
					</table>
					<p class="submit">
						<input type="submit" name="Submit" class="button-primary" value="'.esc_attr__('Save Changes').'" />
					</p>
				</form>
			</div>';
	}
	
	/* Output functions */
	
	function should_share_content() {
		if ($this->options['position'] == 'none') {
			return false;
		}
		wp_enqueue_style('mr_social_sharing', plugins_url('/style.css', __FILE__));
		if ($this->options['plus'] == 1) {
			wp_enqueue_script('GooglePlus', 'https://apis.google.com/js/plusone.js');
		}
		if ($this->options['tumblr'] == 1) {
			wp_enqueue_script('Tumblr', 'http://platform.tumblr.com/v1/share.js', array(), false, true);
		}
		if ($this->options['digg'] == 1) {
			wp_enqueue_script('digg', 'http://widgets.digg.com/buttons.js');
		}
		if ($this->options['position'] == 'shortcode') {
			return false;
		}
		return true;
	}
	
	function create_bookmarks() {
		$title = the_title();
		$url = get_permalink();
		$class = 'mr_social_sharing_'.$this->options['layout'];
		$bookmarks = '<ul class="mr_social_sharing">
						<!-- Social Sharing Toolkit v1.0.0 | http://www.marijnrongen.com/wordpress-plugins/social_sharing_toolkit/ -->';
		if ($this->options['like'] == 1) {
			$bookmarks .= '
						<li class="'.$class.'">
							<iframe src="http://www.facebook.com/plugins/like.php?href='.$url.'&amp;layout=';
			switch ($this->options['layout']) {
				case 'horizontal':
					$bookmarks .= 'button_count';
					$width = '90px';
					$height = '20px';
					break;
				case 'vertical':
					$bookmarks .= 'box_count';
					$width = '55px';
					$height = '65px';
					break;
				default:
					$bookmarks .= 'standard';
					$width = '225%';
					$height = '35px';
					break;
			}
			$bookmarks .= '&amp;show_faces=false&amp;width='.$width.'&amp;height='.$height.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'; height:'.$height.';" allowTransparency="true"></iframe>
						</li>';
		}
		if ($this->options['tweet'] == 1) {
			$bookmarks .= '
						<li class="'.$class.'">
							<a href="http://twitter.com/share" class="twitter-share-button" data-url="'.$url.'" data-count="';
			switch ($this->options['layout']) {
				case 'horizontal':
					$bookmarks .= 'horizontal';
					break;
				case 'vertical':
					$bookmarks .= 'vertical';
					break;
				default:
					$bookmarks .= 'none';
					break;
			}
			$bookmarks .= '">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
						</li>';
		}
		if ($this->options['plus'] == 1) {
			$bookmarks .= '
						<li class="'.$class.'">
							<g:plusone';
			switch ($this->options['layout']) {
				case 'horizontal':
					$bookmarks .= ' size="medium"';
					break;
				case 'vertical':
					$bookmarks .= ' size="tall"';
					break;
				default:
					$bookmarks .= ' size="medium" count="false"';
					break;
			}
			$bookmarks .= ' href="'.$url.'"></g:plusone>
						</li>';
		}
		if ($this->options['share'] == 1) {
			$bookmarks .= '
						<li class="'.$class.'">
							<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="'.$url.'"';
			switch ($this->options['layout']) {
				case 'horizontal':
					$bookmarks .= ' data-counter="right"';
					break;
				case 'vertical':
					$bookmarks .= ' data-counter="top"';
					break;
				default:
					$bookmarks .= '';
					break;
			}
			$bookmarks .= '></script>
						</li>';	
		}
		if ($this->options['tumblr'] == 1) {
			$bookmarks .= '
						<li class="'.$class.'">
							<a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; ';
			switch ($this->options['layout']) {
				case 'horizontal':
					$bookmarks .= 'width:81px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_1.png\')';
					break;
				case 'vertical':
					$bookmarks .= 'width:61px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_2.png\')';
					break;
				default:
					$bookmarks .= 'width:61px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_2.png\')';
					break;
			}
			$bookmarks .= ' top left no-repeat transparent;">Share on Tumblr</a>
						</li>';
		}
		if ($this->options['stumble'] == 1) {
			$bookmarks .= '
						<li class="'.$class.'">
							<script src="http://www.stumbleupon.com/hostedbadge.php?s=';
			switch ($this->options['layout']) {
				case 'horizontal':
					$bookmarks .= '1';
					break;
				case 'vertical':
					$bookmarks .= '5';
					break;
				default:
					$bookmarks .= '4';
					break;
			}
			$bookmarks .= '&r='.$url.'"></script>
						</li>';	
		}
		if ($this->options['digg'] == 1) {
			$bookmarks .= '
						<li class="'.$class.'">
							<a class="DiggThisButton ';
			switch ($this->options['layout']) {
				case 'horizontal':
					$bookmarks .= 'DiggCompact';
					break;
				case 'vertical':
					$bookmarks .= 'DiggMedium';
					break;
				default:
					$bookmarks .= 'DiggIcon';
					break;
			}			
			$bookmarks .= '" href="http://digg.com/submit?url='.$url.'&amp;title='.$title.'"></a>
						</li>';
		}
		if ($this->options['reddit'] == 1) {
			$bookmarks .= '
						<li class="'.$class.'">';
			switch ($this->options['layout']) {
				case 'horizontal':
					$bookmarks .= '
							<script type="text/javascript">
							  reddit_url = "'.$url.'";
							  reddit_title = "'.$title.'";
							</script>
							<script type="text/javascript" src="http://www.reddit.com/static/button/button1.js"></script>';
					break;
				case 'vertical':
					$bookmarks .= '
							<script type="text/javascript">
							  reddit_url = "'.$url.'";
							  reddit_title = "'.$title.'";
							</script>
							<script type="text/javascript" src="http://www.reddit.com/static/button/button2.js"></script>';
					break;
				default:
					$bookmarks .= '
							<a href="http://www.reddit.com/submit" onclick="window.location = \'http://www.reddit.com/submit?url='.$url.'\'; return false"><img src="http://www.reddit.com/static/spreddit1.gif" alt="submit to reddit" border="0" /></a>';
					break;
			}	
			$bookmarks .= '
						</li>';
		}
		if ($this->options['myspace'] == 1) {
			$bookmarks .= '
						<li class="'.$class.'">
							<a href="javascript:void(window.open(\'http://www.myspace.com/Modules/PostTo/Pages/?u='.$url.'\',\'ptm\',\'height=450,width=550\').focus())">
    							<img src="http://cms.myspacecdn.com/cms//ShareOnMySpace/Myspace_btn_';
    		switch ($this->options['layout']) {
    			case 'horizontal':
    				$bookmarks .= 'ShareOnMyspace';
    				break;
    			default:
    				$bookmarks .= 'Share';
    				break;	
    		}
    		$bookmarks .= '.png" border="0" alt="Share on Myspace" />
							</a>
						</li>';
		}
		if ($this->options['hyves'] == 1) {
			$bookmarks .= '
						<li class="'.$class.'">
							<iframe src="http://www.hyves.nl/respect/button?url='.$url.'&amp;title='.$title.'" style="border: medium none; overflow:hidden; width:150px; height:21px;" scrolling="no" frameborder="0" allowTransparency="true" ></iframe>
						</li>';
		$bookmarks .= '
					</ul>';
		}
		return $bookmarks;	
	}
	
	function share($content) {
		if ($this->options['position'] == 'top') {
			$bookmarks = $this->create_bookmarks();
			$content = $bookmarks.$content;	
		}
		if ($this->options['position'] == 'bottom') {
			$bookmarks = $this->create_bookmarks();
			$content .= $bookmarks;
		}
		return $content;
	}
	
	function share_shortcode() {
		$bookmarks = '';
		if ($this->options['position'] == 'shortcode') {
			$bookmarks = $this->create_bookmarks();
		}
		return $bookmarks;
	}
	
	function should_linkify_content() {
		if ($this->options['linkify_content'] == 1) {
			return true;
		}
		return false;
	}
	
	function should_linkify_comments() {
		if ($this->options['linkify_comments'] == 1) {
			return true;
		}
		return false;
	}
	
	function linkify($content) {
		if ($this->options['twitter_handles'] == 1) {
			$content = preg_replace("/(^|\s)*(@([a-zA-Z0-9-_]{1,15}))(\.*[^|\n|\r|\t|\s|\<|\&]*)/i", "$1<a href=\"http://twitter.com/$3\">$2</a>$4", $content);
		}
		if ($this->options['twitter_hashtags'] == 1) {
			$content = preg_replace("/(^|\s)*((?:(?<!&))#([a-zA-Z0-9]+))([^|\n|\r|\t|\s|\.|\<|\&]*)/i", "$1<a href=\"http://twitter.com/search/$3\">$2</a>$4", $content);
		}
		return $content;
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
/* Register plugin admin page */
add_action('admin_menu', array($MR_Social_Sharing_Toolkit, 'plugin_menu'));