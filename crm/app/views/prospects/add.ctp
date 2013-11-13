<?php
    echo $this->Html->script('jquery-validate/jquery.validate', false);
    echo $this->Html->script('utils/dynamic_combos', false);
    echo $this->Html->script('prospects/add', false);
?>
<script type="text/javascript">
</script>
<div class="clientes form">
    <h2><?php __('Agregar Prospecto');?></h2>
    <?php echo $form->create( 'Prospect', array( 'action' => 'store_prospect'));?>
    <?php
        echo $this->Html->script('prospects/view_prospect_details');
        $fields =array(
            array('label'=>'Nombre','model'=>'Prospect','keys'=>'name','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Correo electrónico','model'=>'Prospect','keys'=>'email','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Lada','model'=>'Prospect','keys'=>'lada','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Teléfono','model'=>'Prospect','keys'=>'phone_number','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Fecha de nacimiento','model'=>'Prospect','keys'=>'fecha_nacimiento','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Plantel','model'=>'Prospect','keys'=>'plantel','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Medio de contacto','model'=>'Prospect','keys'=>'medio_contacto','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Medio de publicidad','model'=>'Prospect','keys'=>'medio_publicidad','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Fecha de cita','model'=>'Prospect','keys'=>'fecha_cita','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
        );
    ?>
    <table class="prospect_details_table">
            <?php echo $this->Crm->columnedFields(array(),$fields)?>
    </table>
    <table cellspacing="0" cellpadding="5" class="table_form">
        <tr>
            <td colspan="2">
                <?php echo $form->input('place_id',array('type'=>'text','value'=>$this->Session->read('Auth.User.place_id'))); ?>
                <?php echo $form->submit('Guardar',array('div'=>false)); ?>&nbsp;
                <?php echo $html->link('Regresar','/') ?>
            </td>
        </tr>
    </table>
    <?php
        echo $form->input('Prospect.origin_id',array('type'=>'hidden','value'=>$origin['Origin']['id'], 'class'=>'required'));
        echo $form->end();
    ?>
</div>
