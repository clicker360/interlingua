<?php
echo $this->Html->css('jquery.ui/custom-theme/jquery-ui-1.8.5.custom');
echo $this->Html->script('jquery/ui/js/jquery-ui-1.8.5.custom.min');
echo $this->Html->script('utils/dynamic_combos');
echo $this->Html->script('prospects/search_module');
echo $form->create('');
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" class="table_form">
    <tr>
        <td>ID:</td>
        <td><?php echo $form->input('Prospect.id', array('id' => 'search_prospect_id', 'label' => false, 'type' => 'text')); ?></td>
        <td>Nombre:</td>
        <td><?php echo $form->input('Prospect.name', array('id' => 'search_prospect_name', 'type' => 'text', 'label' => false)); ?></td>
    </tr>    
    <tr>
        <td>Correo:</td>
        <td><?php echo $form->input('Prospect.email', array('id' => 'search_prospect_email', 'type' => 'text', 'label' => false)); ?></td>
         <td>Estado:</td>
        <td><?php echo $form->input('Prospect.estado', array('id' => 'search_prospect_estado', 'type' => 'text', 'label' => false)); ?></td>
    </tr>
    <tr>
        <td>Lada:</td>
        <td><?php echo $form->input('Prospect.lada', array('id' => 'search_prospect_lada', 'type' => 'text', 'label' => false)); ?></td>
        <td>Teléfono:</td>
        <td><?php echo $form->input('Prospect.phone_number', array('id' => 'search_prospect_phone_number', 'type' => 'text', 'label' => false)); ?></td>
    </tr>
    <tr>
        <td>Categoria de status:</td>
        <td>
            <?php
            echo $form->input('Prospect.status_category_id', array('label' => false, 'id' => 'status_category_select', 'options' => $status_categories, 'multiple' => true, 'size' => 4));
            ?>
        </td>
        <td>Status:</td>
        <td><?php echo $form->input('Prospect.status_id', array('label' => false, 'id' => 'status_select', 'multiple' => true, 'size' => 4)); ?></td>
    </tr>
    <tr>
        <td>Usuario:</td>
        <td>
            <?php
            echo $form->input('Prospect.user_id', array('type' => 'select', 'label' => false, 'id' => 'users_select', 'empty' => 'Seleccionar un usuario', 'multiple' => true, 'size' => 4,'options'=>$users));
            ?>
        </td>
        <td>Tipo de Fecha:</td>
        <td>
            <?php
            echo $form->input('Prospect.tipo_fecha', array('id' => 'prospect_tipo_fecha', 'label' => false, 'type' => 'select', 'options' => array('Registro','Asignación','Última Atención'), 'empty' => 'Selecciona un Tipo de Fecha'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Del:</td>
        <td>
            <?php
            echo $form->input('Prospect.from_date', array('type' => 'text', 'label' => false, 'id' => 'from_date', 'class' => 'dateField'));
            ?>
        </td>
        <td>Al:</td>
        <td>
            <?php
            echo $form->input('Prospect.to_date', array('type' => 'text', 'label' => false, 'id' => 'to_date', 'class' => 'dateField'));
            ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2" align="right">
            <input type="button" id="add_prospect_button" value="Agregar Contacto" class="button" />
            <input type="reset" class="button" />&nbsp;
            <?php echo $form->submit('Buscar', array('div' => false, 'id' => 'search_button')); ?>
        </td>
    </tr>

</table>
<?php echo $form->end(); ?>