<?php 

/*
Plugin Name: UberMenu - Sticky Menu Extension
Plugin URI: http://wpmegamenu.com/sticky
Description: Get your UberMenu stuck.
Version: 1.2.0
Author: Chris Mavricos, SevenSpark
Author URI: http://sevenspark.com
License: http://codecanyon.net/licenses/regular
Copyright 2012-2013  Chris Mavricos, SevenSpark http://sevenspark.com
*/

function ubermenusticky_only_load_after_ubermenu(){
	add_action( 'plugins_loaded' , 'ubermenusticky_init' , 20 );
}
add_action( 'uberMenu_load_dependents', 'ubermenusticky_only_load_after_ubermenu' );

function ubermenusticky_init(){

	global $uberMenu;	
	$settings = $uberMenu->getSettings();

	$sticky_ops = 'sticky_ops';
	$settings->registerPanel( $sticky_ops, 'Sticky Settings' );	
	$settings->addTextInput( $sticky_ops,
			'ubersticky-top-spacing',
			'Top Spacing / Offset',
			'Pixel distance from the top of the top of the window to place the fixed menu.  Should be less than '.
			'or equal to the distance the menu is positioned naturally.',
			0
			);

	$settings->addCheckbox( $sticky_ops,
			'ubersticky-expand-menu-bar',
			'Expand Menu Bar Full Width on Scroll',
			'When the menu is fixed in place, expand the menu bar to fill the entire window.',
			'on'
			);

	

	$settings->addCheckbox( $sticky_ops,
			'ubersticky-clear',
			'Enable Clearfix',
			'If your menu immediately gets stuck to the top of your viewport even before you scroll, '.
				'the most likely issue is that your theme\'s header needs to be properly cleared, as the elements '.
				'may be absolutely positioned.  Enable this option to clear the menu and keep it in place until you scroll.',
			'off'
			);

	$settings->addTextInput( $sticky_ops,
			'ubersticky-center-inner',
			'Center Inner Menu Width',
			'If you enable "Expand Menu Bar Full Width on Scroll", but want the menu items to remain centered, set '.
			'the width of the inner menu bar here (usually 940-960px for an average theme).',
			'940'
			);

	$settings->addColorPicker( $sticky_ops , 
			'ubersticky-background-color' , 
			'Menu Bar Background' , 
			'If you have a transparent menu bar, you may want to set a color for when the menu scrolls.' , 
			false
			);

	$settings->addCheckbox( $sticky_ops,
			'ubersticky-wpadmin-bottom',
			'Move WP Admin Bar to footer',
			'If your menu is stuck at the top of the window, it may get blocked by the WP Admin Bar.  Swap it to the bottom '.
				'of the screen instead',
			'on'
			);

	


	$settings->addSubHeader( $sticky_ops , 'ubersticky-advanced' , 'Advanced Sticky Settings - Use with Caution' );


	$settings->addCheckbox( $sticky_ops,
			'ubersticky-mobile',
			'Stick on Mobile Devices',
			'<span class="spark-infobox spark-infobox-warning" style="display:inline; padding:2px;">Warning: Experimental</span>  Tested in iOS Safari and Android Chrome & '.
				'Stock browsers, this setting will make your menu sticky on mobile devices and attempt to make any hidden content '.
				'accessible via overflow touch scrolling.  Note that the iOS implementation of overflow scrolling seems to be much smoother than Android\'s, which '.
				'can be unreliable at times.  Overall, mobile browser support for fixed-element overflow touch scrolling is still lacking.  Therefore, <strong>use at your own risk.  '.
				'This is an experimental feature and may not work with all sites.</strong>  If not working as expected on your site, simply disable.  New in v1.2.',
			'off'
			);



	$settings->addCheckbox( $sticky_ops,
			'ubersticky-permanent',
			'Always Sticky',
			'Always stick the menu to the top of the page without scrolling.  <span class="spark-infobox spark-infobox-warning" style="display:inline; padding:2px;">Important Notes</span> If you use this option, you will likely want to manually add some padding/margin to your site '.
			'container, and a max-width on the #megaMenu div if you are not expanding the menu full width.  Keep in mind that features like the special '.
			'classes will no longer work as intended since this feature disables the javascript '.
			'component of the extension.  Centering will be controlled through the core UberMenu options, not the Sticky-specific options.  Not recommended for use when <strong>Stick on Mobile Devices</strong> is enabled.',
			'off'
			);


	

	$settings->addTextInput( $sticky_ops,
			'ubersticky-scroll-context',
			'Scroll Context',
			'For 99% of themes you will leave this blank, however, if your scroll pane is an HTML '.
				'element rather than the window, set its selector here - for example "#content"',
			''
			);

	$settings->addCheckbox( $sticky_ops,
			'ubersticky-disable-css',
			'Disable CSS',
			'Enable this option to prevent UberMenu Sticky from inserting CSS in your site head.  If you do this, you\'ll need '.
				'to include this CSS elsewhere in order for UberMenu Sticky to function',
			'off'
			);

	$settings->addTextInput( $sticky_ops,
			'ubersticky-apply-to',
			'Apply Sticky To',
			'Apply UberMenu Sticky only to this post ID (leave blank to apply to all)',
			''
			);


	if( !is_admin() ){
		//Load javascript if not always sticky
		if( !$settings->op( 'ubersticky-permanent' ) ) add_action( 'wp_enqueue_scripts', 'ubermenusticky_loadJS', 501 );
		//Load CSS in head if not disabled
		if( !$settings->op( 'ubersticky-disable-css' ) ) add_filter( 'uberMenu_insertCSS' , 'ubermenusticky_insertCSS' );
	}

}



$ubermenusticky_apply = 'undecided';
function ubermenusticky_apply(){

	global $uberMenu, $post, $ubermenusticky_apply;

	if( $ubermenusticky_apply == 'undecided' ){
		$settings = $uberMenu->getSettings();

		if( $settings->op( 'ubersticky-apply-to' ) == '' ||
			( $post && $settings->op( 'ubersticky-apply-to' ) == $post->ID	) ){
			return true;
		}

		return false;
	}
	return $ubermenusticky_apply;
}

function ubermenusticky_loadJS(){

	if( ubermenusticky_apply() ){
		$pluginURL = plugins_url().'/'.str_replace(basename( __FILE__ ),"",plugin_basename( __FILE__ ) );
		wp_enqueue_script( 'sticky-js' , $pluginURL.'ubermenu.sticky.js', array( 'jquery' ), false, true );


		global $uberMenu;
		$settings = $uberMenu->getSettings();

		wp_localize_script( 'sticky-js', 'uberMenuStickySettings', array(
			'expand_menu_bar'	=> $settings->op( 'ubersticky-expand-menu-bar' ),
			'offset'			=> $settings->op( 'ubersticky-top-spacing' ),
			'mobile'			=> $settings->op( 'ubersticky-mobile' ),
			'scroll_context' 	=> $settings->op( 'ubersticky-scroll-context' )
		));
	}
}


function ubermenusticky_insertCSS( $css ){

	if( ubermenusticky_apply() ){

		global $uberMenu;
		$settings = $uberMenu->getSettings();
		$alwaysSticky = $settings->op( 'ubersticky-permanent' );
		$offset = is_numeric( $settings->op( 'ubersticky-top-spacing' ) ) ? $settings->op( 'ubersticky-top-spacing' ) : 0;
		
		$stickyMegaMenu = '#megaMenu.ubermenu-sticky';
		
		if( $alwaysSticky ){
			$stickyMegaMenu = '#megaMenu';
		}

		$css.= "\n\n/**** UberMenu Sticky CSS ****/\n";

		// The actual sticky CSS
		$css.= "{$stickyMegaMenu}{ margin: 0 !important; z-index:1000; position:fixed !important; top: {$offset}px; bottom: auto !important; -webkit-transition:none; -moz-transition:none; transition:none; }\n";
		
		if( !$alwaysSticky ){
			//Special Sticky Classes
			$css.= "#megaMenu ul.megaMenu li.um-sticky-only{ display: none !important; }";
			$css.= "#megaMenu-sticky-wrapper #megaMenu.ubermenu-sticky li.um-sticky-only{ display: block !important; }";
			$css.= "#megaMenu ul.megaMenu li.um-unsticky-only{ display: block !important; }";
			$css.= "#megaMenu-sticky-wrapper #megaMenu.ubermenu-sticky li.um-unsticky-only{ display: none !important; }";

			//Clearfix for themes that use weird headers
			if( $settings->op( 'ubersticky-clear' ) == 'on' ){
				$css.= "\n/* Clearfix */ \n";
				$css.= "#megaMenu-sticky-wrapper{ clear:both; }";
			}

		}

		if( $settings->op( 'ubersticky-mobile' ) ){
			$css.= "\n/* Mobile Sticky */ \n";
			$stickyWrapper = '#megaMenu-sticky-wrapper.uber-sticky-mobile '; //trailing space is important
			if( $alwaysSticky ) $stickyWrapper = ''; //Apply if we're not using
			$css.= "{$stickyWrapper}#megaMenu ul.megaMenu.megaMenuToggleOpen{ overflow-y:scroll !important; -webkit-overflow-scrolling: touch; }";	//  overflow-scrolling: touch;
		}

		//At smaller sizes, make align left, full width!
		if( $settings->op( 'ubersticky-expand-menu-bar' ) ){
			$css.= "\n/* Expand Menu Bar */ \n";
			$css.= "{$stickyMegaMenu}{ left: 0; right:auto; width: 100%; border-radius: 0; }\n";
			
			if( is_numeric( $settings->op( 'ubersticky-center-inner' ) ) ){
				$css.= "/* Center Inner Menu */ \n";
				$css.= "#megaMenu.ubermenu-sticky ul.megaMenu{ padding-left:2px; margin: 0 auto; float:none; max-width: {$settings->op( 'ubersticky-center-inner' )}px; }\n"; //leave selectors as is, use core UM settings instead
				$css.= "#megaMenu.megaMenuHorizontal ul.megaMenu > li:first-child > a{ box-shadow:none; }\n";
			}
		}


		//If UberMenu was supposed to be centered
		if( $settings->op( 'center-menubar' ) ){
			$css.= "/* Center Menubar */\n";
			$css.= "#megaMenu-sticky-wrapper{ margin:0 auto; max-width: 100%; width: {$settings->op( 'wpmega-container-w' )}px; }\n";
		}

		if( ( $bkg_color = $settings->op( 'ubersticky-background-color' ) ) != '' ){
			$css.= "/* Menu Bar Background */\n";
			$css.= "#megaMenu-sticky-wrapper #megaMenu.ubermenu-sticky{ background: #$bkg_color; }\n";
		}

		if( $settings->op( 'ubersticky-wpadmin-bottom' ) && is_user_logged_in() ){
			$css.= "/* Move Admin Bar to bottom */
* html body { margin-top: 0 !important; }
body.admin-bar { margin-top: -28px; padding-bottom: 28px; }
body.wp-admin #footer { padding-bottom: 28px; }
#wpadminbar { top: auto !important; bottom: 0; }
#wpadminbar .quicklinks .ab-sub-wrapper { bottom: 28px; }
#wpadminbar .quicklinks .ab-sub-wrapper ul .ab-sub-wrapper { bottom: -7px; }\n";

		}

		return $css;
	}

	return $css;
}
