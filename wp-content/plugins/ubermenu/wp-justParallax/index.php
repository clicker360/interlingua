<?php
/*
Plugin Name: wp-justParallax
Plugin URI: http://www.martindrost.nl/wp-justParallax
Description: justParallax.js is a lightweight javascript plugin which allows users to make the background of their webpage have a subtle parallax effect.
Version: 2.2
Author: Martin Drost
Author URI: http://www.martindrost.nl/
*/
function addSettings()
{

	$settings = array(target => get_option('jp-target')? get_option('jp-target') : '',
			   speed => get_option('jp-speed')? (int)get_option('jp-speed') : 8,
			   vertical => get_option('jp-vertical') == 'false'? false : true,
			   vertical_inversed => get_option('jp-vertical_inversed')? get_option('jp-vertical_inversed') == 'true' : false,
			   horizontal => get_option('jp-horizontal')? get_option('jp-horizontal') == 'true' : false,
			   horizontal_inversed => get_option('jp-horizontal_inversed')? get_option('jp-horizontal_inversed') == 'true' : false);

	$settings_string = "<script type='text/javascript'>var justParallax_settings = ".json_encode($settings)."</script>";
	echo $settings_string;
}
add_action( 'wp_footer', 'addSettings');

function addScript()
{
	$script_path = plugins_url( 'wp-justParallax.js', __FILE__ );
	wp_enqueue_script('the_js', $script_path);
}
add_action( 'wp_footer', 'addScript');








/*
* Start of options page.
*/

// create custom plugin settings menu
add_action('admin_menu', 'plugin_create_menu');

function plugin_create_menu() {

	//create new top-level menu
	add_menu_page('wp-justParallax Plugin Settings', 'wp-justParallax settings', 'administrator', __FILE__, 'plugin_settings_page');

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'justParallax-settings-group', 'jp-target' );
	register_setting( 'justParallax-settings-group', 'jp-speed' );
	register_setting( 'justParallax-settings-group', 'jp-vertical' );
	register_setting( 'justParallax-settings-group', 'jp-vertical_inversed' );
	register_setting( 'justParallax-settings-group', 'jp-horizontal' );
	register_setting( 'justParallax-settings-group', 'jp-horizontal_inversed' );
}

function plugin_settings_page() 
{
	?>
	<div class="wrap">
	<h2>wp-justParallax settings</h2>

	<form method="post" action="options.php">
	    <?php settings_fields( 'justParallax-settings-group' ); ?>
	    <table class="form-table" style='width:400px;'>
	        <tr>
		        <th scope="row">
		        	target
		        </th>
		        <td>
		        	<input type='text' name='jp-target' value="<?php echo get_option('jp-target')?get_option('jp-target') :'body'?>"/>
		        	<span style='font-size: 10px;color: #B9B9B9;'>
			        	<br>(use '.' to mark classes, use '#' to mark ID's, type the tag to target a tag, split the targets with ',')
			        	<br> example: .wrapper, #slider, body
		        </span>
		        </td>
		        <td>
		        </td>	
	        </tr>
	        <tr>
		        <th scope="row">
		        	speed
		        </th>
		        <td>
		        	<select name='jp-speed'>
		        		<?php
		        			for($i=1,$option=get_option('jp-speed');$i<11;$i++)
		        			{
		        				?>
		        				<option value='<?php echo $i?>' <?php echo $option == $i || !$option && $i == 8 ? 'selected':''?>>
		        					<?php echo $i?>
		        				</option>
		        				<?php
		        			}
		        		?>
		        	</select>
		        </td>
		        <td>
		        </td>	
	        </tr>
	        <tr>
	        	<th>
	        	</th>
	        	<th style='font-weight:bold'>
	        		on
	        	</th>
	        	<th style='font-weight:bold'>
	        		off
	        	</th>
	        </tr>
	        <tr>
		        <?php $vertical = get_option('jp-vertical');?>
		        <th scope="row">
		        	Vertical
		        </th>
		        <td>
		        	<input type="radio"  name="jp-vertical" value=true <?php echo $vertical == 'true' || !$vertical ? 'checked' :''  ?>/>
		        </td>
		        <td>
		        	<input type="radio" name="jp-vertical" value=false  <?php echo $vertical == 'false' ? 'checked' :'' ?>/>
		        </td>
	        </tr>
	        <tr>
		        <?php $vertical_inversed = get_option('jp-vertical_inversed');?>
		        <th scope="row">
		        	Vertical_inversed
		        </th>
		        <td>
		        	<input type="radio"  name="jp-vertical_inversed" value=true <?php echo $vertical_inversed == 'true' ? 'checked' :'' ?>/>
		        </td>
		        <td>
		        	<input type="radio" name="jp-vertical_inversed" value=false  <?php echo $vertical_inversed == 'false' || !$vertical_inversed ? 'checked' :'' ?>/>
		        </td>
	        </tr>
	        <tr>
		        <?php $horizontal = get_option('jp-horizontal');?>
		        <th scope="row">
		        	horizontal
		        </th>
		        <td>
		        	<input type="radio"  name="jp-horizontal" value=true <?php echo $horizontal == 'true' ? 'checked' :'' ?>/>
		        </td>
		        <td>
		        	<input type="radio" name="jp-horizontal" value=false  <?php echo $horizontal == 'false' || !$horizontal ? 'checked' :'' ?>/>
		        </td>
	        </tr>
	        <tr>
		        <?php $horizontal_inversed = get_option('jp-horizontal_inversed');?>
		        <th scope="row">
		        	horizontal_inversed
		        </th>
		        <td>
		        	<input type="radio"  name="jp-horizontal_inversed" value=true <?php echo $horizontal_inversed == 'true' ? 'checked' :'' ?>/>
		        </td>
		        <td>
		        	<input type="radio" name="jp-horizontal_inversed" value=false  <?php echo $horizontal_inversed == 'false' || !$horizontal_inversed ? 'checked' :'' ?>/>
		        </td>
	        </tr>
	    </table>
	    
	    <?php submit_button(); ?>

	</form>
	</div>
	<?php 
} ?>