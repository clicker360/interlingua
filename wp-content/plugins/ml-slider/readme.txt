=== Plugin Name ===
Contributors: matchalabs
Tags: widget,wordpress slider,slideshow,wordpress slideshow,image slider,flexslider,flex slider,nivoslider,nivo slider,responsiveslides,responsive,responsive slides,coinslider,coin slider,slideshow,carousel,responsive slider,vertical slides,ml slider,image rotator,metaslider,meta,ajax,metaslider pro
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CQ84KC4X8YKW8
Requires at least: 3.5
Tested up to: 3.6
Stable tag: 2.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

4 sliders in 1! Choose from Nivo Slider, Flex Slider, Coin Slider or Responsive Slides.

== Description ==

http://www.youtube.com/watch?v=I7IfkV6iLqo

Meta Slider is a flexible, intuitive slideshow administration plugin that lets you choose between 4 jQuery sliders.

* **Nivo Slider** (Responsive, 16 transition effects, 4 themes)
* **Coin Slider** (4 transition effects)
* **Flex Slider 2** (Responsive, 2 transition effects, carousel mode)
* **Responsive Slides** (Responsive, fade effect only, incredibly light weight!)

Features:

* Easy to use **AJAX** powered administration panel
* Built in Widget and Shortcode
* Add unlimited slideshows and slides
* Change settings per slideshow *(speed, theme, hover pause, width, height, easing etc)*
* Fully integrated with the new WordPress 3.5 media manager
* Add captions and URLs to slides
* Captions support HTML
* Drag and drop slide reordering
* Lightweight - only the minimum JavaScript/CSS is outputted to your page
* Intelligent image cropping (Smart Crop)
* Fully localised

Meta Slider has been translated into the following languages:

* French (thanks to fb-graphiklab)
* Spanish (thanks to eltipografico)

Read more and thanks to:

* [http://flexslider.woothemes.com/](http://flexslider.woothemes.com/)
* [http://responsive-slides.viljamis.com/](http://responsive-slides.viljamis.com/)
* [http://workshop.rs/projects/coin-slider/](http://workshop.rs/projects/coin-slider/)
* [http://dev7studios.com/nivo-slider/](http://dev7studios.com/nivo-slider/)

Want More? Get the **Meta Slider Pro** addon pack to add support for:

* Live Theme Editor (new!)
* YouTube slides
* Vimeo slides
* HTML slides
* Animated Layer Slides (new!)
* Dynamic Post Feed Slides (content slider)

Find out more at http://www.metaslider.com

== Installation ==

The easy way:

1. Go to the Plugins Menu in WordPress
1. Search for "Meta Slider"
1. Click 'Install'

The not so easy way:

1. Upload the `ml-slider` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Manage your slideshows using the 'Meta Slider' menu option

== Frequently Asked Questions ==

http://www.metaslider.com/documentation/

= How do I include a slideshow in the header of my site? =

http://www.youtube.com/watch?v=gSsWgd66Jjk

You will need to paste the "Template Include" code into your theme (you can find this in the 'Usage' section underneath the slideshow settings)

* Go to Appearance > Editor in WordPress
* Edit a file called 'header.php' (or similar)
* Find the correct place to add it (for example above or below the logo)
* Paste in the code and save.

If you want to include the slideshow on your homepage only, use this code:

`<?php 
if (is_front_page() || is_home()) {
    echo do_shortcode("[metaslider id=123]"); //replace 123 with slider ID
} 
?>`

== Screenshots ==

1. Meta Slider - for live demos see http://www.metaslider.com/examples/
2. Nivo Slider example
3. Coin Slider example
4. Flex Slider example
5. Carousel Example
6. Administration panel - selecting slides

== Changelog ==

= 2.2.2 =
* Improvement: System check added with option to dismiss messages. Checks made for: role scoper plugin, wp_footer, wordpress version & GD/ImageMagick.

= 2.2.1 =
* Fix: Responsive slides styling in FireFox (reported by and thanks to: dznr418)
* Fix: Flex Slider carousel causing browser to crash in some circumstances

= 2.2 =
* Fix: Paragraph tags being added to output using Nivo Slider

= 2.1.6 =
* Fix: Use the original image file if the slideshow size is the same size as the image file
* Fix: Conflict with Advanced Post Types Order plugin
* Fix: Colorbox conflict when using resizable elements in lightbox
* Improvement: Refresh slides after clicking 'save'
* Improvement: Ensure taxonomy category exists before tagging slide to slideshow
* Fix: Only submit form when submit button is clicked (not all buttons)
* Fix: Coin slider caption width in FireFox
* Improvement: Added hook to adjust carousel image margin

= 2.1.5 =
* Fix: HTML 5 Validation

= 2.1.4 =
* Fix: Widget markup invalid (reported by and thanks to: CarlosCanvas)

= 2.1.3 =
* Fix: User Access Manager Plugin incompatibility issues (reported by and thanks to: eltipografico)

= 2.1.2 =
* Fix: Nivo Slider theme select dropdown (reported by and thanks to: macks)
* Fix: HTML5 Validation fix for inline styles
* Improvement: Title field added to widget (suggested by and thanks to: pa_esp)
* New feature: Spanish language pack (thanks to eltipografico)

= 2.1.1 =
* Fix: PHP version compatibility

= 2.1 =
* New feature: Widget added
* New feature: System check added (checks for required image libraries and WordPress version)
* Fix: Multiple CSS fixes added for popular themes
* Fix: Flex slider shows first slide when JS is disabled
* Improvement: Display warning message when unchecking Print JS and Print CSS options
* Improvement: Coinslider navigation centered

= 2.0.2 =
* Fix: PHP Error when using slides the same size as the slideshow

= 2.0.1 =
* New feature: French language pack (thanks to: fb-graphiklab)
* Fix: Use transparent background on default flexslider theme
* Fix: Set direction to LTR for flexslider viewport (fix for RTL languages)
* Fix: Nivoslider HTML Captions
* Fix: Responsive slides navigation positioning

= 2.0 =
* Fix: Responsive slides navigation styling
* Fix: Update slide order on save
* Fix: Smart crop edge cases
* Fix: Flexslider navigation overflow

= 2.0-betaX =
* Improvement: Error messages exposed in admin is Meta Slider cannot load the slides
* Improvement: Load default settings if original settings are corrupt/incomplete
* Fix: Smart Crop ratio
* Fix: UTF-8 characters in captions (reported by and thanks to: javitopo)
* Fix: JetPack Photo not loading images (reported by and thanks to: Jason)
* Fix: Double slash on jQuery easing path
* Fix: Paragraph tags outputted in JavaScript (reported by and thanks to: CrimsonRaddish)

= 2.0-beta =
* New feature: Preview slideshows in admin control panel
* New feature: 'Easing' options added to flex slider
* New feature: 'Carousel mode' option added for flex slider
* New feature: 'Auto play' option added
* New feature: 'Smart Crop' setting ensures your slideshow size remains consitent regardless of image dimensions
* New feature: 'Center align slideshow' option added for all sliders
* New feature: Coin Slider upgraded to latest version, new options now exposed in Meta Slider
* New feature: Captions now supported by responsive slides
* Improvement: Responsive AJAX powered administration screen
* Improvement: Code refactored
* Improvement: Flex Slider captions now sit over the slide
* Fix: Nivo slider invalid markup (reported by and thanks to: nellyshark)
* Fix: JS && encoding error (reported by and thanks to: neefje)

= 1.3 =
* Renamed to Meta Slider (previously ML Slider)
* Improvement: Admin styling cleaned up
* Improvement: Code refactored
* Improvement: Plugin localised
* Improvement: Template include PHP code now displayed on slider edit page
* Improvement: jQuery tablednd replaced with jQuery sortable for reordering slides
* New feature: Open URL in new window option added
* Improvement: max-width css rule added to slider wrapper
* Fix: UTF-8 support in captions (reported by and thanks to: petergluk)
* Fix: JS && encoding error (reported by and thanks to: neefje)
* Fix: Editors now have permission to use MetaSlider (reported by and thanks to: rritsud)

= 1.2.1 =
* Fix: Number of slides per slideshow limited to WordPress 'blog pages show at most' setting (reported by and thanks to: Kenny)
* Fix: Add warning when BMP file is added to slider (reported by and thanks to: MadBong)
* Fix: Allow images smaller than default thumbnail size to be added to slider (reported by and thanks to: MadBong)

= 1.2 =
* Improvement: Code refactored
* Fix: Unable to assign the same image to more than one slider
* Fix: JavaScript error when jQuery is loaded in page footer
* Improvement: Warning notice when the slider has unsaved changes
* Fix: Captions not being escaped (reported by and thanks to: papabeers)
* Improvement: Add multiple files to slider from Media Browser

= 1.1 =
* Improvement: Code refactored
* Fix: hitting [enter] brings up Media Library
* Improvement: Settings for new sliders now based on the last edited slider
* Improvement: More screenshots added

= 1.0.1 =
* Fix: min version incorrect (should be 3.5)

= 1.0 =
* Initial version

== Upgrade Notice ==
