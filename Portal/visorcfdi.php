<?
define('RutaFTP', "./procesados/", false);

if (isset($_POST['Buscar'])) {
	$resultado = "";

	if (@$_POST['Emisor'] != "" && @$_POST['Receptor'] != "") {
		$resultado = ObtenerCFDi();
		if ($resultado == "") {
			$resultado = '<div class="error">No se encontraron CFDi</div>';
		}
	} else {
		$resultado = '<div class="error">Indique emisor y receptor</div>';
	}
}

function ObtenerCFDi() {
	$emisor = RutaFTP. trim($_POST['Emisor']). "/";
	$receptor = $emisor. trim($_POST['Receptor']). "/";
	
	if (is_dir($emisor) && is_dir($receptor)) {
		$cfdi = array();
		$lista = scandir($receptor);
		foreach($lista as $a) {
			if (is_file($receptor.$a) && substr($a, strlen($a)-4) == ".xml") {
				$xml = simplexml_load_file($receptor.$a);
				$ns = $xml->getNamespaces(true);
				if (@$ns['cfdi'] != "" && @$ns['tfd'] != "") { // para evitar comprobantes mal formados
					$xml->registerXPathNamespace('c', $ns['cfdi']);
					$xml->registerXPathNamespace('t', $ns['tfd']);
					
					$arr = $xml->xpath('//c:Comprobante');
					$fecha = $arr[0]['fecha'];
					$arr = $xml->xpath('//c:Emisor');
					$datos['emisor'] = $arr[0]['rfc'];
					$arr = $xml->xpath('//c:Receptor');
					$datos['receptor'] = $arr[0]['rfc'];
					$arr = $xml->xpath('//t:TimbreFiscalDigital');
					$datos['uuid'] = $arr[0]['UUID'];
					$pdf = str_replace(".xml", ".pdf", $receptor.$a);
					if (!file_exists($pdf)) $pdf = '';
					$datos['xml'] = $receptor.$a;
					$datos['pdf'] = $pdf;

					$cfdi[strtotime($fecha)] = $datos;
					unset($datos);
				}
			}
		}
		if (count($cfdi) > 0) {
			ksort($cfdi);
			$fila = '<tr><td>%s</td><td>%s</td><td>%s</td><td></td><td>%s</td><td>%s</td><td>%s</td></tr>';
			$html = '<table class="tabla"><th>&nbsp;</th><th>&nbsp;</th><th>UUID</th><th>Folio</th><th>RFC Emisor</th><th>RFC Receptor</th><th>Fecha</th>';
			foreach($cfdi as $k => $v) {
				$html .= sprintf($fila, 
					sprintf('<a href="%s" target="_blank">XML</a>', $v['xml']),
					$v['pdf'] == '' ? "": sprintf('<a href="%s" target="_blank">PDF</a>', $v['pdf']),
					$v['uuid'], $v['emisor'], $v['receptor'], date("d/m/Y", $k));
			}
			$html .= '</table>';
			return $html;
		}
	}
	return "";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>SCM CFD - Visor CFDi</title>
	<style type="text/css">
		html { font-family: Arial, Calibri, Verdana; font-size: 10pt; }
		body { margin: 10px; height: 80%; }
		h3 { width: 100%; text-align: center; font-size: 18pt; color: #fff; background-color: #008f8f; margin: 0px; padding-top: 6px; padding-bottom: 6px; }
		input[type="submit"] { height: 26px; width: 75px; }
		.contenido { text-align: center; vertical-align: top; line-height: 40px; }
		.error { display: table; margin: 0 auto; font-size: 8pt; font-weight: bold; color: #d00; }
		.tabla { width: 90%; font-size: 9pt; line-height: 18px; margin: 0 auto; background-color: #bbb; }
		.tabla th { color: #fff; }
		.tabla td { background-color: #fff; }
	</style>
</head>
<body>
	<h3>Visor CFDi</h3>
	<form method="post">
		<div class="contenido">
			<label for="Emisor">RFC Emisor:</label> <input type="text" name="Emisor" value="<? echo @$_POST['Emisor']; ?>" maxlength="15" size="15" />
			<span style="display:inline-table; width:70px"></span>
			<label for="Receptor">RFC Receptor:</label> <input type="text" name="Receptor" value="<? echo @$_POST['Receptor']; ?>" maxlength="15" size="15" />
			<br />
			<input type="submit" name="Buscar" value="Buscar" />
			<div style="height: 15px;"></div>
			<? echo $resultado; ?>
		</div>
	</form>
</body>
</html>