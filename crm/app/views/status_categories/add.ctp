<?php
    echo $this->Html->script('jquery-validate/jquery.validate', false);
    echo $this->Html->script('status_categories/add', false);
?>
<div class="clientes form">

    <h2><?php __('Agregar Categoria de Status');?></h2>

    <?php echo $form->create( 'StatusCategory', array( 'action' => 'store_status_category'));?>
    <table cellspacing="0" cellpadding="5" class="table_form">
        <tr>
            <td>Nombre:</td>
            <td>
                <?php echo $form->input('StatusCategory.name',array('maxLength'=>100,'label'=>false, 'type'=>'text', 'class'=>'required')); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php echo $form->submit('Guardar',array('div'=>false)); ?>&nbsp;
                <?php echo $html->link('Regresar','/listar-categorias-status') ?>
            </td>
        </tr>
    </table>
    <?php echo $form->end();?>
</div>
