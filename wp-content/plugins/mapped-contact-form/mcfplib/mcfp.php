<?php
require 'lib/jsmin.php';

class MCFP 
{
	/**
	  * An array of array of formElements
	  * 
	  * Each sub array must hava a name, label, placeholder, a html5 form type and if the value should be required in the form.
	  *
	  * @return array of array $formElements
	  */
	public static function formElements()
	{
		$formElements = array(
						'formElements' => array(
						array('name' => 'name', 'label' => '', 'placeholder' => 'Nombre', 'type' => 'text', 'required' => true), 
						//array('name' => 'street', 'label' => 'Your street', 'placeholder' => 'Enter your street', 'type' => 'text', 'required' => true), 
		                array('name' => 'email', 'label' => '', 'placeholder' => 'Email', 'type' => 'email', 'required' => true),
						array('name' => 'phone','label' => '', 'placeholder' => 'Telefono', 'type' => 'tel', 'required' => false),
						//add more elements here.
						array('name' => 'phone','label' => '', 'placeholder' => 'Celular', 'type' => 'tel', 'required' => false),
					//	array('name' => 'message', 'label' => '', 'placeholder' => 'Comentario', 'type' => 'textarea', 'required' => true)
						)
		);
		return $formElements;
	}
	
	
	/**
	  * Prints the map canvas. Must be called inside the html <body> tag.
      *
      * @param args array - config values of mapped contact form pro
      *
      * args contents:
      * id - string - Css id of the map div.
      * width - string - Width of the map.
      * height - string - Height of the map.
      * mapCenter - array - Latitude and a longitude value of initial Map center. 
      *                     (You can use ../help/index.html to find out the values for a specific place.)
      * mapZoom - int - Initial Map zoom level.
      * listener - string - Use the constants for the listeners defined in this class.
      * locations - array of array - Each location array must have a name, a latitude, longitude, a marker and a email adress. 
      *                              The order of the locations on the map is the same as in the location array.
      *                              (You can use ../help/index.html to find out the values for a specific place.)
	  *                              Use the constants defined in this class to pick the available markers.
      * 
	  */
	public static function returnMap( $args = array() )
	{
		  // get values from the args array (fold)
		  $id = $args['id'];
		  $width = $args['width'];
		  $height = $args['height'];
		  $lat = $args['mapCenter'][0];
		  $lng = $args['mapCenter'][1];
		  $mapZoom = $args['mapZoom'];
		  $listener = $args['listener'];
		  $locations = $args['locations'];
		  // get values from the args array (end)
			
		  // get the form elements
		  $formElements = MCFP::formElements();
		  
		  //javascript for the map (fold)
		  $config = '<script type="text/javascript">';
		  $config .= MCFP::mappedContactForm( $formElements );
		  $config .= " \n ";
		  $config .= MCFP::validation( $formElements );
		  $config .= "\n mappedContactForm.mapCenter = [ $lat,$lng ];";
		  $config .= "mappedContactForm.mapZoom = $mapZoom;";
		  $config .= "mappedContactForm.listener = '$listener';";
		  $config .= "\nmappedContactForm.locations = [ \n";
		  $lastElement = false;
		  $count = 0;		
		  foreach($locations as $string_value)
		  {
			$value = explode(",", str_replace(" ", "", $string_value));
			$count++;
			if ($count == count($locations)){
				$lastElement = true;
			}
			if ($lastElement) {
              $config .= "['".str_replace("_", " ", $value[0])."', $value[1], $value[2], '$value[3]', '$value[4]' ]\n";
			} else {
		  	  $config .= "['".str_replace("_", " ", $value[0])."', $value[1], $value[2], '$value[3]', '$value[4]' ],\n";
			}
		  }
		  $config .= "\n];\n";
		  $config .= "mappedContactForm.pluginsUrl = '". plugins_url('mapped-contact-form') . "'";
		  $config .= "</script>";
		  $js=JSMin::minify($config);
		  //javascript for the map (fold)
		  
		  $map = $js;
		  $map .= "<div id=\"$id\" class=\"map-shadow\" style=\"width: $width; height: $height\"></div>";//the div for the map canvas
		  
		  //print the javascript config and the map div
		  return ($map);
	}
	
	/**
	 * Prints a link to a given location.
	 * 
	 * @param string $locationNumber - Number of the location where the links points to. Start count with zero.
	 * @param string $linkName - The name of the link.
	 */
	public static function printLocationLink($locationNumber, $linkName)
	{
		$link = ' <a href="#" onclick="mappedContactForm.openInfoWindow(mappedContactForm.markers['.$locationNumber.']);return false">'.$linkName.'</a>';
		echo ($link);
	}
	
	/**
	  * Returns a javascript function that includes the form html for the info windows.
	  * 
	  * @param array formElements
	  * @return string $form 
	  */
  	public static function mappedContactForm( $args ) 
	{
		$formElements = $args['formElements'];
		$form = ' mappedContactForm.infoWindowHtml = function(name, email){ ';
		$form .= "\n";
		$form .= ' var infoWindowHtml = ';
		$form .= ' \'<div id="result"></div> ';
		$form .= '<div id="contact" class="contact">	';
		$form .= '  <form method="post" action="'. plugins_url('/contact.php', __FILE__).'" name="contactform" id="contactform" autocomplete="on">';
		$form .= '    <fieldset>';
		$form .= 	    ' <legend>\' + name + \'</legend>';
		foreach($formElements as $value)
		{
			$form .= MCFP::formElementByType($value);
		}
		$form .= '      <input type="hidden" name="destination_email" value="\' + email + \'">';
		$form .= '  	   <input type="submit" class="submit" id="submit" value="Enviar" />	';
		$form .= '    </fieldset>';
		$form .= '  </form>';
		$form .= '</div>\' ';
		$form .= "\n";
		$form .= ' return infoWindowHtml; ';
		$form .= "\n";
		$form -
		$form .= ' } ';
		return $form;
	}
	
	/**
	  * Returns the form type specific html.
	  * 
	  * @param array formElements
	  * @return string $html 
	  */	
	public static function formElementByType( $args ) 
	{
		// get values from the args array (fold)
		$name = $args['name'];
		$label = $args['label'];
		$placeholder = $args['placeholder'];
		$type = $args['type'];
		$required = $args['required'];
		// get values from the args array (end)
		
		$html = "";
		switch ($type) 
		{
			case "email":
		    $html .= '      <div>';
		    $html .= '        <label for="'.$name.'">'.$label.'</label>';
		    $html .= '        <input name="'.$name.'" type="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$"/>';
		    $html .= '      </div>';
				break;
			case "textarea":
			$html .= '      <div>';
			$html .= '  	     <label for="'.$name.'">'.$label.' </label>\'';
			$html .= " \n + ";
			$html .= '        mappedContactForm.textareaFormField(\''.$name.'\', \''.$placeholder.'\')';
			$html .= " + \n ";
		    $html .= '      \'</div>';
				break;
			default:
			$html .= '      <div>';
			$html .= '        <label for="'.$name.'">'.$label.'</label>';
			$html .= '        <input name="'.$name.'" type="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'" />';
			$html .= '      </div>';
		}
		return $html;
	}

	/**
	  * Returns a javascript function for the form validation.
	  * 
	  * @param array formElements
	  * @return string $validation 
	  */	
	public static function validation( $args )
	{
		$formElements = $args['formElements'];
				
		$validation = "mappedContactForm.validate = function(){ \n";
		$validation .= "	jQuery(function(){ \n";
		$validation .= "      jQuery(\".submit\").live('click', function(){ \n";
		$validation .= "        jQuery(\"#contactform\").validate({ \n";
		$validation .= "	        errorPlacement: function(error, element) { \n";
		$validation .= "	            element.parent().addClass('error'); \n";
		$validation .= "	        }, \n";
		$validation .= "	        rules: { \n";
		foreach($formElements as $value)
		{
			$validation .= MCFP::validationByType($value);
		}
		$validation .= "	        }, \n";
		$validation .= "	        submitHandler: function(contact) { \n";
		$validation .= "	            jQuery(contact).ajaxSubmit({ \n";
		$validation .= "	                target: \"#result\", \n";
		$validation .= "	                success: function() { \n";
		$validation .= "	                    jQuery(\"#contact\").fadeOut('slow', function() { \n";
		$validation .= "	                       // Animation complete. \n";
		$validation .= "	                    }); \n";
		$validation .= "	                } \n";
		$validation .= "	            }); \n";
		$validation .= "	        } \n";
		$validation .= "	    }); \n";
	    $validation .= "	  }); \n";
		$validation .= "	}); \n";
		$validation .= "} \n";
		return $validation;
	}

	/**
	  * Returns the form type specific validation code.
	  * 
	  * @param array formElements
	  * @return string $validation 
	  */
	public static function validationByType( $args )
	{	
		$validation = "";
		// get values from the args array (fold)
		$name = $args['name'];
		$type = $args['type'];
		$required = $args['required'];
		// get values from the args array (end)
		
		if ($required)
		{
			switch ($type) 
			{
				case "email":
				$validation .= $name . ": { \n";
				$validation .= "      required: true, \n";
				$validation .= "      email: true, \n";
				$validation .= "  }, \n";
					break;
				default:
				$validation .= $name .": { \n";
				$validation .= "  	required: true \n";
				$validation .= "  }, \n";
			}
		}
		return $validation;
	}	
}
?>