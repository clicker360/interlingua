<?php
    echo $this->Html->script('jquery-validate/jquery.validate', false);
    echo $this->Html->script('media/add', false);
?>
<div class="clientes form">

    <h2><?php __('Agregar Medio');?></h2>

    <?php echo $form->create( 'Medium', array( 'action' => 'store_medium'));?>
    <table cellspacing="0" cellpadding="5" class="table_form">
        <tr>
            <td>Nombre:</td>
            <td>
                <?php echo $form->input('Medium.name',array('maxLength'=>100,'label'=>false, 'type'=>'text', 'class'=>'required')); ?>
            </td>
        </tr>
        <tr>
            <td>Categoria:</td>
            <td ><?php echo $form->input('Medium.medium_category_id',array('label'=>false,'options'=>$medium_categories,
                        'empty'=>'Selecciona una categoria', 'class'=>'required')); ?>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <?php echo $form->submit('Guardar',array('div'=>false)); ?>&nbsp;
                <?php echo $html->link('Regresar','/listar-medios') ?>
            </td>
        </tr>
    </table>
    <?php echo $form->end();?>
</div>
