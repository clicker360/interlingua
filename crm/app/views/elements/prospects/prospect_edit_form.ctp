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
        array('id'=>'4','label'=>'Correo electrónico','model'=>'Prospect','keys'=>array('email'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_email')),
        array('id'=>'2','label'=>'Lada','model'=>'Prospect','keys'=>array('lada'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_lada')),
        array('id'=>'3','label'=>'Telefono','model'=>'Prospect','keys'=>array('phone_number'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_phone_number')),
        array('id'=>'3','label'=>'Celular','model'=>'Prospect','keys'=>array('mobile_number'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_mobile_number')),
        array('id'=>'3','label'=>'Plantel','model'=>'Prospect','keys'=>array('plantel'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_plantel')),
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
            echo $form->submit('Guardar'); ?>
            <div id="store_prospect_message"></div>
        </td>
    </tr></table>
<?php 
echo $form->end(); 
?>