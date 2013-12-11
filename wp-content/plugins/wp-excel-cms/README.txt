=== WP Excel CMS ===
Contributors: (this should be a list of wordpress.org userids)
Donate link: http://webteilchen.de
Tags: excel, import, wp excel cms, xls, xlsx, json
Requires at least: 3.5.1
Tested up to: 3.6
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple Plugin to import Excel files to Wordpress and use the Data in your theme.
No Database entries are created.


== Description ==

Simple Plugin to import Excel files to Wordpress and use the Data in your theme. No Database entries are created. All file & json based. You can use as many excel files in one page as you want.

For example, if you have a guestlist in excel and you want to show it in a special style on your website, you can easily upload the excel file in your admin interface an then use `wp_excel_cms_get("guestlist");` to get the structured data in your template.

*Example Usage:*
`
$data = wp_excel_cms_get("guestlist");
foreach($guestlist as $guest){
  print_r($guest);             
}
`    
I hope you enjoy this plugin. Give me feedback to improve it.


== Installation ==


= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'wp-excel-import'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `wp-excel-cms.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

= Using FTP =

1. Download `wp-excel-import.zip`
2. Extract the `wp-excel-import` directory to your computer
3. Upload the `wp-excel-import` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard


== Frequently Asked Questions ==



== Screenshots ==

1. Admin Panel screenshot-1.(png)

== Changelog ==

= 1.0 =
* Inital Version

= 1.0.1 =
* Fix: Upload Folder will be created automatically


== Donations ==


