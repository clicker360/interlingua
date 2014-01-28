/*
	*	Original script by: Shafiul Azam
	*	ishafiul@gmail.com
	*	Version 3.0
	*	Modified by: Luigi Balzano

	*	Description:
	*	Inserts Countries and/or States as Dropdown List
	*	How to Use:

		In Head section:
		<script type= "text/javascript" src = "countries.js"></script>
		In Body Section:
		Select Country:   <select onchange="print_state('state',this.selectedIndex);" id="country" name ="country"></select>
		<br />
		City/District/State: <select name ="state" id ="state"></select>
		<script language="javascript">print_country("country");</script>	

	*
	*	License: OpenSource, Permission for modificatin Granted, KEEP AUTHOR INFORMATION INTACT
	*	Aurthor's Website: http://shafiul.progmaatic.com
	*
*/

var country_arr = new Array("Aguascalientes", "Campeche", "Coahuila", "Chihuaha", "Distrito Federal", "Estado De Mexico", "Guadalajara", "Guanajuato", "Hidalgo", "Michoacán", "Morelos", "Nuevo Leon", "Puebla", "Queretaro", "Quintana Roo", "San Luis Potosi", "Sinaloa", "Sonora", "Tabasco", "Veracruz", "Yucatan");

s_a = new Array();
s_a[0]="";
s_a[1]="Aguascalientes";
s_a[2]="Campeche|Ciudad del Carmén";
s_a[3]="Torreón Rincón de la Rosita";
s_a[4]="Ciudad Juárez";
s_a[5]="Bosques de las Lomas|Dakota 95-WTC|El Rosario|Fórum Buenavista|Gran Sur|Jardin Balbuena|Linda VistaMiramontes|Parques Polanco|Picacho-Pedregal|Plaza Oriente|Plaza Polánco|Plaza Universidad|Puerta Alameda|Zona Rosa";
s_a[6]="Atizapán|Coacalco|Cuautitlán Izcalli|Ecatepec|Interlomas|Ixtapaluca|Metepec|Nezahualcóyotl|Nicolás Romero|Patio Ecatepec|Satélite|Tecamac|Texcoco|Tlalnepantla|Toluca";
s_a[7]="Guadalajara Av. México|Guadalajara Centro Sur";
s_a[8]="Irapuato";
s_a[9]="Pachuca|Tula|Tulancingo";
s_a[10]="Morelia";
s_a[11]="Cuernavaca";
s_a[12]="Monterrey Chapultepec|Monterrey Linda Vista|Monterrey Sendero";
s_a[13]="Puebla Huexotitla|Puebla la Paz";
s_a[14]="Querétaro";
s_a[15]="Cancún";
s_a[16]="Rio Verde|San Luis Potosí";
s_a[17]="Culiacán";		
s_a[18]="Hermosillo Satélite";
s_a[19]="Villahermosa";
s_a[20]="Orizaba|Poza Rica|Veracruz";
s_a[21]="Mérida Zona Macroplaza|Mérida Zona Dorada";

// <!-- -->

function print_country(country_id){
	// given the id of the <select> tag as function argument, it inserts <option> tags
	var option_str = document.getElementById(country_id);
	option_str.length=0;
	option_str.options[0] = new Option('Selecciona tu Estado','');
	option_str.selectedIndex = 0;
	for (var i=0; i<country_arr.length; i++) {
		//option_str.options[option_str.length] = new Option(country_arr[i],country_arr[i]);
	}
}

function print_state(state_id, state_index){
	/*var option_str = document.getElementById(state_id);
	option_str.length=0;	// Fixed by Julian Woods
	option_str.options[0] = new Option('Selecciona tu Plantel','');
	option_str.selectedIndex = 0;
	var state_arr = s_a[state_index].split("|");
	for (var i=0; i<state_arr.length; i++) {
		option_str.options[option_str.length] = new Option(state_arr[i],state_arr[i]);
	}*/
}   

