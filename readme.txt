=== Social Sharing Toolkit ===
Contributors: MarijnRongen
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=P8ZVNC57E58FE&lc=NL&item_name=WordPress%20plugins%20by%20Marijn%20Rongen&item_number=Social%20Sharing%20Toolkit&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: Facebook, Like, LinkedIn, Share, Google, Plus, +1, Google+, Twitter, Tweet, Follow, StumbleUpon, Stumble, Tumblr, Delicious, Digg, Reddit, Myspace, Hyves, YouTube, Flickr, Picasa, deaviantART, mail, RSS, feed, connect, recommend, social, sharing, widget, shortcode, page, post, button, counter, icon
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: 2.0.1
License: GPLv2 or later

Easy sharing and connecting on social networks. Display on posts or use widgets or shortcode. Also Twitter name/hashtag to link converter.

== Description ==

= Sharing posts & pages =

The plugin currently supports the following networks for sharing:

* Facebook (like and send buttons)
* Twitter
* Google +1
* LinkedIn
* Tumblr
* StumbleUpon
* Delicious
* Digg
* Reddit
* Myspace
* Hyves

On Tweet buttons you can specify a Twitter handle which is then appended to the tweet a visitor sends (like "... via @WordPress"). An email send button is also included.

You can decide which networks to support on your blog, where the buttons will appear (either above or below the content). Through drag and drop you can easily change the order in which the buttons appear. 

For each button you can choose a different type (not all types are available for each button):

* button
* button with counter on the side
* button with counter on top
* small icon
* small icon with text
* medium icon
* medium icon with text
* large icon

You can also choose the orientation of the buttons: 

* horizontal (buttons are placed side by side)
* vertical (buttons are placed below each other) 

= Shortcode =

It is also possible to only let the buttons appear where you want by using shortcode. To do this you need to set the button position to the shortcode option and use the shortcode [social_share/] in the content where you would like to display the buttons.

= Widget =

The widget has it's own list of buttons with the same possibilities as the list for posts & pages. You can however specify a fixed title and url to use for the buttons in the widget.

= Follow Widget = 

Since version 2.0.0 an extra widget is added with the possibility to provide easy links to your profiles on other social networks.

The networks currently supported for the Follow Widget are:

* Facebook
* Twitter
* Google+
* LinkedIn
* Tumblr
* Myspace
* Hyves
* YouTube
* Flickr
* Picasa
* DeviantArt

A button for an RSS feed is also included. Of course the type, order and orientation of the buttons is also configurable for the Follow Widget. Each button for the Follow Widget supports the following types:

* small icon
* small icon with text
* medium icon
* medium icon with text
* large icon

To use a button you must enter your user id or username for the network. To use the RSS feed button you must enter the full url. 

= Automatic Twitter links =

This plugin also includes a configurable & improved version of my earlier Automatic Twitter Links plugin. You can decide if you want to convert Twitter names and/or hashtags to links. 
Twitter names will link to their Twitter profile and hashtags will link to the Twitter search page.

== Frequently Asked Questions ==

= My excerpts aren't displaying the buttons but some strange text is displayed =

You must disable the option "Include buttons in excerpts", it is enabled by default but some themes use custom excerpts which do not correctly parse the buttons.

= The buttons are not showing on my posts in the loop =

You must enable the option "Include buttons in excerpts", but keep in mind some themes use custom excerpts which do not correctly parse the buttons.

= How do I use display the buttons somewhere else (outside the loop) =

If you want to display the buttons somewhere else on your site you can use the following code where you want the buttons to appear:
`<?php
	$social_sharing_toolkit = new MR_Social_Sharing_Toolkit();
	echo $social_sharing_toolkit->create_bookmarks();
?>`

You can also supply an url and title to use on the buttons:
`	echo $social_sharing_toolkit->create_bookmarks('{YOUR URL}', '{YOUR TITLE}');`

To display the follow buttons somewhere else you can use the following code:
`<?php
	$social_sharing_toolkit = new MR_Social_Sharing_Toolkit();
	echo $social_sharing_toolkit->create_followers();
?>`


== Installation ==

Upload the Social Sharing Toolkit plugin to the `/wp-content/plugins/` folder on your website, activate it and use the 'Social Sharing Toolkit page' under 'Settings' to configure your toolkit.

== Screenshots ==

1. Plugin configuration for posts and pages
2. Plugin configuration for Share Widget
3. Plugin configuration for Follow Widget
4. Automatic Twitter links configuration
5. Some buttons
6. Some other buttons

== Upgrade Notice ==

= 2.0.1 =

Version 2.0.1 is a major update with more possibilities. You will have to reconfigure the plugin because of this (it's gotten much better, I promise).

= 1.3.1 =

Version 1.3.1 includes an option to display buttons in excerpts.

= 1.3.0 =

Please update to version 1.3.0 for several bug fixes and enhancements.

= 1.2.5 =

Please update to version 1.2.5 for several bug fixes and enhancements.

= 1.2.0 =
New widget included in version 1.2.0.

= 1.0.1 =

Please update to version 1.0.1 to prevent an unexpected printing of the page title.

== Changelog ==

= 2.0.0 =
* Added Follow Widget
* Added icon buttons
* Added possibility to control order of buttons
* Added choice between horizontal and vertical button orientation
* Share Widget now has it's own list of buttons
* Added support for Delicious and sending though email
* Several minor fixes

= 1.3.2 =
* Added FAQ to readme
* Enabled "Include buttons in excerpts" option by default
* Fixed minor title issue with tweet, tumblr and myspace buttons

= 1.3.1 =
* Added feature to choose if buttons display in excerpts (doesn't work on some themes)

= 1.3.0 =
* Added feature to display buttons only on posts, only on pages or on posts and pages 
* Improved hashtag to link conversion
* Fixed Facebook language to en_US to prevent width issues
* Fixed excerpt issue
* Fixed some css issues 

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