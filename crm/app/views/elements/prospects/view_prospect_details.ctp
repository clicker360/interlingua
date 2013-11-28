<?php
    echo $this->Html->script('prospects/view_prospect_details');
    $fields =array(
        array('label'=>'Nombre','model'=>'Prospect','keys'=>'name','editable'=>false),
        array('label'=>'Correo Electrónico','model'=>'Prospect','keys'=>'email','editable'=>false),
        array('label'=>'Lada','model'=>'Prospect','keys'=>'lada','editable'=>false),
        array('label'=>'Teléfono','model'=>'Prospect','keys'=>'phone_number','editable'=>false),
        array('label'=>'Celular','model'=>'Prospect','keys'=>'mobile_number','editable'=>false),
        array('label'=>'Estado','model'=>'Prospect','keys'=>'estado','editable'=>false),
        array('label'=>'Usuario','model'=>'User','keys'=>'name','editable'=>false),
        array('label'=>'Plantel','model'=>'Prospect','keys'=>'plantel','editable'=>false),
        array('label'=>'Medio de contacto','model'=>'Prospect','keys'=>'medio_contacto','editable'=>false),
        array('label'=>'Medio de publicidad','model'=>'Prospect','keys'=>'medio_publicidad','editable'=>false),
        array('label'=>'Fecha de nacimiento','model'=>'Prospect','keys'=>'fecha_nacimiento','editable'=>false),
        array('label'=>'Fecha de cita','model'=>'Prospect','keys'=>'fecha_cita','editable'=>false),
        array('label'=>'ClaveAS400','model'=>'Prospect','keys'=>'clave_as_400','editable'=>false),
        array('label'=>'Fecha Registro','model'=>'Prospect','keys'=>array('created'),'join'=>'','editable'=>false),
        array('label'=>'Fecha de Asignación','model'=>'Prospect','keys'=>array('assignation_date'),'join'=>'','editable'=>false),
        array('label'=>'Fecha de Última Atención','model'=>'Prospect','keys'=>array('Prospect.last_contact_date'),'join'=>'','editable'=>false),
    );
?>

<table class="prospect_details_table">
        <?php echo $this->Crm->columnedFields($prospect,$fields)?>
</table>