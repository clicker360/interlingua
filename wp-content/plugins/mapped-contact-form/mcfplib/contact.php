<?php
/**
 * contact.php form backend for mapped contact form pro
 * send an email to destination_email and returns the submitted values to the user 
 */
require('mcfp.php');

$formElements = MCFP::formElements();

$elements = $formElements['formElements'];

$required_values = array();
$optional_values = array();

/* get variables from request (fold)*/
$i = 0;
$j = 0;
foreach($elements as $element)
{
	if ($element['required'])
	{
		$required_values[$i] = $_REQUEST[$element['name']];
		$i++;
	} else {
		$optional_values[$j] = $_REQUEST[$element['name']];
		$j++;
	}
}
/* get variables from request (end)*/
$destination_email = $_REQUEST['destination_email'];

$body = "Sombody submitted:\r\n";
if (!in_array("", $required_values))
{
	/*Send email (fold) */
	$i = 0;
	$j = 0;	
	foreach($elements as $element)
	{

		if ($element['required'])
		{
			$body .= $element['label']. ": ".$required_values[$i] . " \n";
			if ("Email" == $element['label']) {
  		  $sender_email = $required_values[$i];
  		}			
			$i++;
		} else {
			$body .= $element['label']. ": ".$optional_values[$j]. " \n";
			$j++;
		}
	}
	$headers = "From: $sender_email" . "\r\n" . "Reply-To: $sender_email" . "\r\n" . "Return-Path: $sender_email\r\n";
	mail($destination_email, "Email from mapped contact form pro WordPress", $body, $headers);	
	///*Send email (end) */
	
	/*return messgae to the user (fold)*/
	echo("<h1>You will hear from us soon.</h1>");
	echo("<p>This was submitted:</p>");

	$i = 0;
	$j = 0;
	foreach($elements as $element)
	{

		if ($element['required'])
		{
			echo('<p>'.$element['label']. ": ".$required_values[$i].'</p>');
			$i++;
		} else {
			if ($optional_values[$j]) 
			{
				echo('<p>'.$element['label']. ": ".$optional_values[$j].'</p>');
			}
			$j++;
		}
	}
	/*return messgae to the user (end)*/
} else
	//show error message if name, email or message is missing
	echo "Something went wrong. Please try again.";
?>