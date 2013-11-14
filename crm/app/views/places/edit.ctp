<?php
    echo $this->Html->script('jquery-validate/jquery.validate', false);
    echo $this->Html->script('places/edit', false);
?>
<div class="clientes form">

    <h2><?php __('Editar Lugar');?></h2>

    <?php echo $form->create( 'Place', array( 'action' => 'store_place'));?>
    <table cellspacing="0" cellpadding="5" class="table_form">
        <tr>
            <td>Nombre:</td>
            <td>
                <?php echo $form->input('Place.id',array('type'=>'hidden', 'class'=>'required')); ?>
                <?php echo $form->input('Place.name',array('maxLength'=>100,'label'=>false, 'type'=>'text', 'class'=>'required')); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php echo $form->submit('Guardar',array('div'=>false)); ?>&nbsp;
                <?php echo $html->link('Regresar','/listar-lugares') ?>
            </td>
        </tr>
    </table>
    <?php echo $form->end();?>
</div>
