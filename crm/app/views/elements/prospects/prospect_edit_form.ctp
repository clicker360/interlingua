<?php 
    echo $this->Html->script('prospects/prospect_edit_form');
?>


<h2>Datos de Prospecto</h2>
<?php echo $form->create('Prospect', array('action'=>'store_prospect')); ?>
<?php
    echo $form->input('Prospect.id', array(
        'id'    => 'prospect_id','type'  =>'hidden','value' => $prospect['id']
    ));
?>
<?php
    echo $this->Html->script('prospects/view_prospect_details');
    $fields =array(
        array('id'=>'1','label'=>'Nombre','model'=>'Prospect','keys'=>'name','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_name')),
        array('id'=>'1','label'=>'Apellido Paterno','model'=>'Prospect','keys'=>'apellido_paterno','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_ap_paterno')),
        array('id'=>'1','label'=>'Apellido Materno','model'=>'Prospect','keys'=>'apellido_materno','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_ap_materno')),
        array('id'=>'4','label'=>'Correo electrónico','model'=>'Prospect','keys'=>array('email'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_email')),
        array('id'=>'2','label'=>'Lada','model'=>'Prospect','keys'=>array('lada'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_lada')),
        array('id'=>'3','label'=>'Telefono','model'=>'Prospect','keys'=>array('phone_number'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_phone_number')),
        array('id'=>'3','label'=>'Celular','model'=>'Prospect','keys'=>array('mobile_number'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_mobile_number')),
        array('id'=>'1','label'=>'Medio de contacto','model'=>'Prospect','keys'=>'medio_contacto','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_medio_contacto')),
        array('id'=>'1','label'=>'Medio de publicidad','model'=>'Prospect','keys'=>'medio_publicidad','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_medio_publicidad')),
        array('id'=>'1','label'=>'Fecha de nacimiento','model'=>'Prospect','keys'=>'fecha_nacimiento','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_fecha_nacimiento')),
        array('id'=>'1','label'=>'Clave AS400','model'=>'Prospect','keys'=>'clave_as_400','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_as400')),
        array('id'=>'1','label'=>'Fecha de cita','model'=>'Prospect','keys'=>'fecha_cita','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospects_fecha_cita')),
        array('id'=>'3','label'=>'Plantel','model'=>'Prospect','keys'=>array('plantel'),'editable'=>false, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_plantel')),
        array('id'=>'5','label'=>'Estado','model'=>'Prospect','keys'=>'estado','editable'=>false),
        array('id'=>'6','label'=>'Usuario','model'=>'User','keys'=>'name','editable'=>false),
        array('id'=>'12','label'=>'Fecha Registro','model'=>'Prospect','keys'=>array('created'),'join'=>'','editable'=>false),
        array('id'=>'13','label'=>'Fecha de Asignación','model'=>'Prospect','keys'=>array('assignation_date'),'join'=>'','editable'=>false),
        array('id'=>'14','label'=>'Fecha de Última Atención','model'=>'Prospect','keys'=>array('Prospect.last_contact_date'),'join'=>'','editable'=>false)
    );
?>
    <table class="prospect_details_table">
            <?php echo $this->Crm->columnedFields($prospects,$fields)?>
    </table>
    <table width="100%"><tr>
        <td colspan="4" style="text-align:center;">
            <?php 
            echo $form->input('Prospect.origin_id',array('type'=>'hidden','value'=>$prospects['Origin']['id'], 'class'=>'required'));
            echo "<div style='margin-top:15px;margin-bottom:15px;'>";
                echo "<div style='display:inline-block;'>";
                    echo $form->submit('Guardar',array('style' => 'border:0px;color:white;background:#0098AA;padding:5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;font-weight:bold;cursor:pointer;margin-right:5px;')); 
                echo "</div>";?>
                <div id="btn-as400" style='display:inline-block;'></div>
                <div id="store_prospect_message"></div>
            </div>
        </td>
    </tr></table>
<?php 
echo $form->end(); 
?>