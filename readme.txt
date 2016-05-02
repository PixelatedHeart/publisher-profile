=== Publisher Profile ===
Contributors: bi0xid, pixelatedheart
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BDUEBSM9QRPDU
Tags: publisher, profile, role
Requires at least: 4.4
Tested up to: 4.5.1
Stable tag: 1.0.15
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

This plugin creates a publisher profile that can publish every post, but cannot edit them.

== Description ==

This plugin creates a publisher profile that can publish every post, but cannot edit them.


== Installation ==

1. Upload the entire `publisher-profile` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.

== Changelog ==

= 1.0.15 =

* Slug is not editable
* Controls for posts and pages only triggers in posts and pages edition


= 1.0.14 =

* Solved another order bug 
* TODO: trigger jQuery per page

= 1.0.13 =

* Solved bug getting rid of the sidebars "Add new" elements

= 1.0.12 =

* Get rid of "Add new" elements for publishers
* Block the edition of post and pages titles for publishers


= 1.0.11 =

* Disabled extra block for publishers - now they can only review and publish

= 1.0.10 =

* Changed name of the profile to avoid conflict with WP 4.5.1
* Names of functions sanitized
* Eliminated deprecated role functions

= 1.0.9 =

* Solved a bug that did not limit the blocking of the visual editor only for publishers

= 1.0.8 =

* Remove HTML editor for publishers
* Force Visual editor for all users

= 1.0.7 =

* Added tinyMCE validation

= 1.0.6 = 

* Removed javascript calls

= 1.0 =

* Initial version
