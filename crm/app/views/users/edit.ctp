<?php
    echo $this->Html->script('jquery-validate/jquery.validate', false);
    echo $this->Html->script('users/edit', false);
?>
<div class="clientes form">
    <h2><?php __('Editar Usuario');?></h2>
    <hr />
    <?php echo $form->create('User', array( 'action' => 'store_user'));?>
    <table cellspacing="0" cellpadding="5" class="table_form">
            <tr>
                <td>Usuario: </td>
                <td>
                    <?php echo $form->input('User.id', array('type'=>'hidden', 'class'=>'required')); ?>
                    <?php echo $form->input('User.username',array('maxLength'=>100,'label'=>false, 'type'=>'text', 'class'=>'required')); ?>
                </td>
            </tr>
            <tr>
                <td>Contrase&ntilde;a:</td>
                <td>
                    <?php echo $form->input('cambiar',array('id'=>'checkbox_cambiar','label'=>'click para cambiar','type'=>'checkbox')); ?>
                    <?php echo $form->input('User.password', array('maxLength' => '20','label'=>false,'disabled'=>'disabled')); ?>
                </td>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td><?php echo $form->input('User.name',array('maxLength' => '30','label'=>false, 'type'=>'text', 'class'=>'required')); ?></td>
            </tr>
            <tr>
                <td>Correo:</td>
                <td><?php echo $form->input('User.email',array('maxLength' => '80','label'=>false, 'type'=>'text', 'class'=>'required email')); ?></td>
            </tr>
            <tr>
                <td>Telefono:</td>
                <td><?php echo $form->input('User.phone_number',array('maxLength' => '30','label'=>false, 'type'=>'text', 'class'=>'required number')); ?></td>
            </tr>
            <tr>
                <td><?php echo $place_alias['label']?>:</td>
                <td ><?php echo $form->input('User.place_id',array('label'=>false,'options'=>$places,'empty'=>'Selecciona un lugar', 'class'=>'required')); ?></td>
            </tr>
            <tr>
                <td>Nivel:</td>
                <td ><?php echo $form->input('User.level',array('label'=>false,'options'=>$levels,'empty'=>'Selecciona un nivel', 'class'=>'required')); ?></td>
            </tr>
            <tr>
                <td>Activo:</td>
                <td><?php echo $form->input('User.active',array('type'=>'checkbox','label'=>false, 'class'=>'required')); ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $form->submit('Guardar',array('div'=>false)); ?>&nbsp;
                    <?php echo $html->link('Regresar', '/listar-usuarios') ?>
                </td>
            </tr>
    </table>
    <?php echo $form->end();?>
</div>