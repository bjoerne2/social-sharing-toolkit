=== Social Sharing Toolkit ===
Contributors: MarijnRongen
Donate link: http://www.marijnrongen.com/wordpress-plugins/
Tags: Facebook, Like, LinkedIn, Share, Google, Plus, +1, Twitter, Tweet, StumbleUpon, Stumble, Tumblr, Digg, Reddit, MySpace, Hyves, recommend, social, sharing, widget
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: 1.2.5
License: GPLv2 or later

This plugin enables sharing of your content via popular social networks and can convert Twitter names and hashtags to links. Easy & configurable.

== Description ==

The plugin currently supports the following networks:

* Facebook
* Twitter
* Google +1
* LinkedIn
* Tumblr
* StumbleUpon
* Digg
* Reddit
* MySpace
* Hyves (a social network especially popular in the Netherlands). 

You can decide which networks to support on your blog and where the buttons will appear (either above or below the content). You can also choose between different layouts; small without counters, wide with counters or high with counters. Be aware that not every network has a dedicated button for every layout.

Since version 1.2.5 you can also specify a Twitter handle which is then appended to the tweet a visitor sends (like "... via @WordPress").

= Shortcode =

It is also possible to only let the buttons appear where you want by using shortcode. To do this you need to set the button position to the shortcode option and use the shortcode [social_share/] in the content where you would like to display the buttons.

= Widget =

Since version 1.2.0 a widget is included in the toolkit. It will display the same buttons selected in the plugin configuration. 
You can however choose a different button layout for the widget. For example you can have wide buttons below your posts and high buttons in your sidebar. 

= Styling =

The plugin uses a list to position the buttons. You can easily change the css to match your blog style by changing the css file in the plugin directory.

= Using it somewhere else =

If you want to display the buttons outside of your content you can use the following code where you want the buttons to appear:
`<?php
	$social_sharing_toolkit = new MR_Social_Sharing_Toolkit();
	echo $social_sharing_toolkit->create_bookmarks();
?>`

= Automatic Twitter links =

This plugin also includes a configurable & improved version of my earlier Automatic Twitter Links plugin. You can decide if you want to convert Twitter names and/or hashtags to links. 
Twitter names will link to their Twitter profile and hashtags will link to the Twitter search page.

== Installation ==

Upload the Social Sharing Toolkit plugin to the wp-content/plugins/ folder on your website, activate it and use the Social Sharing Toolkit page under Settings to configure your toolkit.

== Screenshots ==

1. Plugin configuration page (before 1.2.5)
2. Without counters (Facebook demands some space)
3. Several wide buttons
4. Several high buttons

== Upgrade Notice ==

= 1.2.5 =

Please update to version 1.2.5 for several bug fixes and enhancements.

= 1.2.0 =
New widget included in version 1.2.0.

= 1.0.1 =

Please update to version 1.0.1 to prevent an unexpected printing of the page title.

== Changelog ==

= 1.2.5 =
* Added title field to widget
* Added field for Twitter handle to attribute tweets to
* Fixed Digg buttons
* Fixed rendering of the list (missing closing tag)
* Reduced size of plugin code

= 1.2.0 =
* Added widget

= 1.0.1 =
* Fixed unexpected printing of the page title 

= 1.0.0 =
* First version