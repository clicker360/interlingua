<?php
    echo $this->Html->script('jquery-validate/jquery.validate', false);
    echo $this->Html->script('statuses/edit', false);
?>
<div class="clientes form">
    <h2><?php __('Editar Status');?></h2>
    <hr />
    <?php echo $form->create('Status', array( 'action' => 'store_status'));?>
    <table cellspacing="0" cellpadding="5" class="table_form">
            <tr>
                <td>Usuario: </td>
                <td>
                    <?php echo $form->input('Status.id', array('type'=>'hidden', 'class'=>'required')); ?>
                    <?php echo $form->input('Status.name',array('maxLength'=>100,'label'=>false, 'type'=>'text', 'class'=>'required')); ?>
                </td>
            </tr>

            <tr>
                <td>Categoría:</td>
                <td ><?php echo $form->input('Status.status_category_id',array('label'=>false,'options'=>$status_categories,
                    'empty'=>'Selecciona una categoria', 'class'=>'required')); ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $form->submit('Guardar',array('div'=>false)); ?>&nbsp;
                    <?php echo $html->link('Regresar', '/listar-status') ?>
                </td>
            </tr>
    </table>
    <?php echo $form->end();?>
</div>