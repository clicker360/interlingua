<?php
$fields =array(
    array('id'=>0,'label'=>'Id','model'=>'Prospect','keys'=>array('id'),'join'=>''),
    array('id'=>2,'label'=>'Nombre','model'=>'Prospect','keys'=>array('name'),'join'=>''),
    array('id'=>3,'label'=>'Correo electrónico','model'=>'Prospect','keys'=>array('email'),'join'=>''),
    array('id'=>3,'label'=>'Lugar','model'=>'Place','keys'=>array('name'),'join'=>''),
    array('id'=>3,'label'=>'Origen','model'=>'Prospect','keys'=>array('origin_id'),'join'=>''),
    array('id'=>5,'label'=>'Lada','model'=>'Prospect','keys'=>array('lada'),'join'=>''),
    array('id'=>6,'label'=>'Teléfono','model'=>'Prospect','keys'=>array('phone_number'),'join'=>''),
    array('id'=>6,'label'=>'Celular','model'=>'Prospect','keys'=>array('mobile_number'),'join'=>''),
    array('id'=>6,'label'=>'Plantel','model'=>'Prospect','keys'=>array('plantel'),'join'=>''),
    array('id'=>7,'label'=>'Estado','model'=>'Prospect','keys'=>array('estado'),'join'=>''),
    array('id'=>7,'label'=>'Resultado Examen','model'=>'Prospect','keys'=>array('result_examen'),'join'=>''),
    array('id'=>9,'label'=>'Fecha Registro','model'=>'Prospect','keys'=>array('created'),'join'=>''),
);

?>
<div id="nuevos">
    <?php
    echo 'Hay ' . count($unassigned_prospects) . ' Prospecto(s) sin asignar.';

    if(count($unassigned_prospects) > 0) {
        ?>
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="1" height="1">
          <param name="movie" value="<?php echo $html->url('/flash/alerta.swf')?>" />
          <param name="quality" value="high" />
          <embed src="<?php echo $html->url('/flash/alerta.swf')?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="1" height="1"></embed>
        </object>
        <?php
    }
    ?>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
        <?php $this->Crm->displayHeaders($fields);?>
        <th></th>
    </tr>
    <?php foreach ($unassigned_prospects as $unassigned_prospect){ ?>
        <tr>
            <?php $this->Crm->displayFields($unassigned_prospect,$fields);?>
            <td>
            <?php
            echo $this->Html->image('icons/add.png', array(
                'alt' => 'Editar',
                'url' => '/editar-prospecto/' . $unassigned_prospect['Prospect']['id'],
                ''
            ));
            ?>
        </td>
    </tr>
    <?php } ?>
</table>
