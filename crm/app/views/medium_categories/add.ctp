<?php
    echo $this->Html->script('jquery-validate/jquery.validate', false);
    echo $this->Html->script('medium_categories/add', false);
?>
<div class="clientes form">

    <h2><?php __('Agregar Categoria de Medios');?></h2>

    <?php echo $form->create( 'MediumCategory', array( 'action' => 'store_medium_category'));?>
    <table cellspacing="0" cellpadding="5" class="table_form">
        <tr>
            <td>Nombre:</td>
            <td>
                <?php echo $form->input('MediumCategory.name',array('maxLength'=>100,'label'=>false, 'type'=>'text', 'class'=>'required')); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php echo $form->submit('Guardar',array('div'=>false)); ?>&nbsp;
                <?php echo $html->link('Regresar','/listar-categorias-medios') ?>
            </td>
        </tr>
    </table>
    <?php echo $form->end();?>
</div>
