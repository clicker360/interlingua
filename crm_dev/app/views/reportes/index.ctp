<?php
echo $this->Html->script('utils/dynamic_combos', false);
echo $this->Html->script('reportes/filters.js', false);
$level=$this->Session->read('Auth.User.level');
$arrayVal = array();
$arrayVal["true|Todos"] = "Todos";
foreach ($places as $value) {
    foreach ($value as $val) {
        $arrayVal[$val['id']."|".$val['name']] = $val['name'];
    }
}
$fechas = array(
    '1' => 'Hoy',
    '2' => 'Ultimos 7 d&iacute;as',
    '3' => 'Ultimo mes',
    '4' => 'D&iacute;a especifico<tr><td></td><td class="renglonDatos">D&iacute;a especifico:</td>
                <td class="renglonDatos">'.$form->input('Reporte.fecha_unica',array('class'=>'dia_especifico','type'=>'date','label'=>false,'div'=>false, 'minYear'=>(date('Y')-1), 'maxYear'=>(date('Y')+1))).'&nbsp;
                </td>                
              </tr>',
    '5' => 'Rango Especial'
);
$uanombres = array('0 a 7', '8 a 15', '16 a 30', 'Más de 30');

?>

<h2>Reporte de: <?php echo $name; ?></h2>
<table width="100%">
  <tr>
    <td>
        <table border="0" cellspacing="5" cellpadding="0">
          <tr>
              <th colspan="5">Días desde ultima atencion</th>
          </tr>
          <tr>
              <?php foreach ($ultimaat as $ultimaata) { ?>
                  <td style="vertical-align:bottom;height:100px">
                      <div style="height:
                        <?php if ($totalua != 0) {
                            echo round(100 * $ultimaata / $totalua);
                        } else {
                            echo 0;
                        } ?>px;width:20px;background-color:blue"></div>
                  </td>
              <?php } ?>
          </tr>
          <tr>
              <?php for ($i = 0; $i < 4; $i++) { ?>
                  <td>
                      <?php if ($totalua != 0) {
                          echo round(100 * $ultimaat[$i] / $totalua);
                      } else {
                          echo 0;
                      } ?>%
                  </td>
              <?php } ?>
          </tr>
          <tr>
              <?php for ($i = 0; $i < 4; $i++) { ?>
                  <td>
                      <?php echo $uanombres[$i] ?>
                  </td>
              <?php } ?>
          </tr>
        </table>
    </td>


    <td>
        <table border="0" cellspacing="5" cellpadding="0">
          <tr>
              <th colspan="5">Eventos por Status</th>
          </tr>
          <tr>
              <?php $i = 0;
                  foreach ($evnom as $evL) { ?>
                  <td style="vertical-align:bottom;height:100px">
                      <div style="height:<?php
                        if ($totevp[$i] != 0) {
                            echo round(($evs[$i] / $totevp[$i])*10, 2);
                        } else {
                            echo 0;
                        }
                      ?>px;width:20px;background-color:blue"></div>
                  </td>
              <?php $i = $i + 1;
                  } ?>
          </tr>
          <tr>
              <?php $i = 0;
                  foreach($evnom as $evL) { ?>
                  <td>
                      <?php
                      if ($totevp[$i] != 0) {
                          echo round(($evs[$i] / $totevp[$i]), 2);
                      } else {
                          echo 0;
                      }
                      ?>
                  </td>
              <?php $i = $i + 1;
                  } ?>
          </tr>
          <tr>
              <?php foreach ($evnom as $evn) { ?>
                  <td>
                      <?php echo $evn; ?>
                  </td>
              <?php } ?>
          </tr>
      </table>
    </td>
  </tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
  <tr>
      <th colspan="<?php echo count($usuarioss) * 5; ?>">
          <span style="color:blue">Eficiencia De Contactación</span>/
          <span style="color:red">Eficiencia De Cierre</span>/
          <span style="color:green">Eficiencia de Contacto Efectivo</span>/
          <span style="">Número de Prospectos</span>
      </th>
  </tr>
  <tr>
      <?php for ($i = 0; $i < count($usuarioss); $i++) { ?>
          <!-- EFICIENCIA DE CONTRATACIÓN -->
          <td style="vertical-align:bottom;height:100px;width:6px">
              <div style="height:<?php
                  if ($numpr[$i] != 0) {
                      echo round(100 * $efe[$i] / $numpr[$i]);
                  } else {
                      echo 0;
                  }
              ?>px;width:10px;background-color:blue"></div>
          </td>
          <!-- EFICIENCIA DE CIERRE -->
          <td style="vertical-align:bottom;height:100px;width:6px">
              <div style="height:<?php
                   if ($ins[$i] != 0 AND $efe[$i] != 0) {
                       echo round(100 * $ins[$i] / ($efe[$i]+$ins[$i]));
                   } else {
                       echo 0;
                   }
              ?>px;width:10px;background-color:red"></div>
          </td>
          <!-- EFICIENCIA DE CONTACTO EFECTIVO -->
          <td style="vertical-align:bottom;height:100px;width:6px">
              <div style="height:<?php
                   if ($efe[$i] != 0) {
                       echo round(100 * $efee[$i] / $efe[$i]);
                   } else {
                       echo 0;
                   } ?>px;width:10px;background-color:green"></div>
          </td>
          <td><div style="width:10px;"></div></td>
      <?php } ?>
  </tr>
  <tr>
      <?php for ($i = 0; $i < count($usuarioss); $i++) { ?>
          <td colspan="5">
              <!-- EFICIENCIA DE CONTRATACIÓN -->
              <div><?php
                  if ($numpr[$i] != 0) {
                      echo round(100 * $efe[$i] / $numpr[$i]);
                  } else {
                      echo 0;
              } ?>%</div>
              <!-- EFICIENCIA DE CIERRE -->
              <div><?php
                  if ($ins[$i] != 0 AND $efe[$i] != 0) {
                      echo round(100 * $ins[$i] / ($efe[$i]+$ins[$i]));
                  } else {
                      echo 0;
              } ?>%</div>
              <!-- EFICIENCIA DE CONTACTO EFECTIVO -->
              <div><?php
                  if ($efe[$i] != 0) {
                      echo round(100 * $efee[$i] / $efe[$i]);
                  } else {
                      echo 0;
                  }
              ?>%</div>
              <!-- NÚMERO DE PROSPECTOS -->
              <div><?php echo $usuariosp[$i]; ?></div>
          </td>
      <?php } ?>
  </tr>
  <tr>
      <?php foreach ($usuarioss as $usuario) { ?>
          <td colspan="5">
              <?php echo substr($usuario['User']['name'], 0, 8); ?>
          </td>
      <?php } ?>
  </tr>
</table>

<!--FIltros-->
<?php if ($level > 1) {
    echo $form->create('Reporte', array('action' => 'index')); ?>
    <table cellspacing="0" cellpadding="5" class="table_form">
    <?php if ($place_alias['alias']!='' && $level > 2) {
 ?>
        <tr>
            <td><?php echo $place_alias['label']; ?>:</td>
            <td><?php echo $form->input('User.place_id', array('label' => false, 'id' => 'lugar_id', 'options' => $places, 'empty' => 'Selecciona un '.$place_alias['lowercase'])); ?></td>
        </tr>
    <?php }
    else{ echo $form->input('User.place_id', array('type' => 'hidden', 'id' => 'lugar_id','value'=>$this->Session->read('Auth.User.place_id')));} ?>
<?php if ($level >= 2) { ?>
            <tr>
                <td>Usuarios:</td>
                <td><?php echo $form->input('User.id', array('type' => 'select', 'label' => false, 'id' => 'user', 'empty' => 'Selecciona un usuario', 'options' => $usuarios)); ?></td>
            </tr>
    <?php }
?>

</table>
<?php echo $form->end('Ver Reporte');
} ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><h1>Reportes.</h1></td>
	</tr>
    <tr>
	<tr>
    	<td><h2>Reporte Status por Promotor</h2></td>
    </tr>
	<form method="post" action="<?php echo $html->url('/reportes/detalle_plantel/')?>">
            <div style="display:none" ><?php echo $form->input('Reporte.user_id', array('type' => 'select', 'label' => false, 'id' => 'user_reporte_promotor', 'empty' => 'Selecciona un usuario', 'options' => $usuarios,'value' =>(isset($this->data['User']['id']) ? $this->data['User']['id'] : ''))); ?></div>
        <tr>
            <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td class="renglonDatos">
                  <div style="display:inline-block;">
                      <?php echo $form->input('Reporte.tipo_fecha',array('type'=>'radio','label'=>false,'legend'=>false,'options'=>array('1'=>'Fecha Prospecto','2'=>'Fecha Ultima Atenci&oacute;n'),'value'=>'1')); ?>
                  </div>
                  <div style="display:inline-block;margin-left:15px;">
                    Lugar: <?php echo $form->select('lugar', $arrayVal, NULL,array('empty'=>false));?>
                  </div>
                </td>
                <td class="renglonDatos">&nbsp;</td>
                <td class="renglonDatos">&nbsp;</td>
                <td class="renglonDatos">&nbsp;</td>
                <td class="renglonDatos">&nbsp;</td>
              </tr>
              <tr>
                  <td class="renglonDatos" colspan="5">
                <?php echo $form->input('Reporte.tipo',array('type'=>'radio','label'=>false,'legend'=>false,'options'=>$fechas,'value'=>'1','separator'=>'</td></tr><tr><td class="renglonDatos" colspan="5">')); ?>
            </td>
            </tr>
              <tr>
                <td class="renglonDatos"><?php //echo $form->input('Reporte1.tipo',array('type'=>'radio','label'=>false,'legend'=>false,'options'=>array('4'=>'Rango Especial'))); ?></td>
                <td class="renglonDatos">Fecha Inicial:</td>
                <td class="renglonDatos">
                    <?php echo $form->input('Reporte.fecha_inicial',array('class'=>'rango_especial','type'=>'date','label'=>false,'div'=>false, 'minYear'=>(date('Y')-1), 'maxYear'=>(date('Y')+1))); ?>&nbsp;
                </td>
                <td class="renglonDatos">Fecha Final:</td>
                <td class="renglonDatos">
                    <?php echo $form->input('Reporte.fecha_final',array('class'=>'rango_especial','type'=>'date','label'=>false,'div'=>false, 'minYear'=>(date('Y')-1), 'maxYear'=>(date('Y')+1))); ?>&nbsp;
                </td>
              </tr>              
            </table></td>
        </tr>
	<tr><td class="renglonDatos" colspan="5" align="center"><?php echo $form->submit('Enviar',array('class'=>'button')); ?></td></tr>
	</form>
</table>

<script type="text/javascript">
$(document).ready(function(){
    $("#user").change(function(){
       $("#user_reporte_promotor").val($(this).val()); 
    });
});
</script>