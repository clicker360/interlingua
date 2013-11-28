<?php
    echo $this->Html->script('jquery-validate/jquery.validate', false);
    echo $this->Html->script('origins/edit', false);
?>
<div class="clientes form">

    <h2><?php __('Editar Origin');?></h2>

    <?php echo $form->create( 'Origin', array( 'action' => 'store_origin'));?>
    <table cellspacing="0" cellpadding="5" class="table_form">
        <tr>
            <td>Nombre:</td>
            <td>
                <?php echo $form->input('Origin.id',array('type'=>'hidden', 'class'=>'required')); ?>
                <?php echo $form->input('Origin.name',array('maxLength'=>100,'label'=>false, 'type'=>'text', 'class'=>'required')); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php echo $form->submit('Guardar',array('div'=>false)); ?>&nbsp;
                <?php echo $html->link('Regresar','/listar-origenes') ?>
            </td>
        </tr>
    </table>
    <?php echo $form->end();?>
</div>
