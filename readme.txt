=== Font Awesome Easy Way ===
Contributors: ljasinskipl 
Tags: font awesome, css, editor
Requires at least: 3.0
Tested up to: 3.8
Stable tag: 0.2.0

Easily insert font awesome 4.0 icons as shortcodes. Coming soon editor plugin and customization options

== Licence ==

Font Files are licenced under SIL OFL 1.1: http://scripts.sil.org/OFL

Font Awesome css code is licenced under MIT licence: http://opensource.org/licenses/mit-license.html

Rest of plugin code is licenced under GPL2 Licence

== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

Just insert [faicon name="iconname"] to insert an icon full list of icons: http://fontawesome.io/icons/

== Changelog ==

= 0.2.0 =
* List shortcodes: `[faul]` and `[fali]` for manual list and `[falist]` for using before and after normal lists. Usage:

`[faul] 
	[fali icon="fa-bug"]elem1[/fali]
	[fali icon="fa-bell"]elem2[/fali]
[/faul]`

and

`[falist icon="fa-heart-o"]
	<ul>
		<li>elem1</li>
		<li>elem2</li>
	</ul>
[/falist]`

*Fixed bug with displaying font awesome version when including css file (to control browser caching)

= 0.1.4 =
* Just git tagging left

= 0.1.3 =
* This deployment script has to start working eventualy

= 0.1.2 =
* Another test. Deployment script

= 0.1.1 =
* Nothing here, just subversion test

= 0.1.0 =
* It works