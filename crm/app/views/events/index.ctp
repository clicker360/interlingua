<?php
echo $this->Html->script('utils/dynamic_combos', false);
echo $this->Html->script('events/index', false);
?>
<h2><?php __('Agenda'); ?></h2>
<hr />
<?php echo $this->Form->create('', array('type' => 'post', 'url' => array('action' => 'index'), 'id' => 'events_lookup')); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" class="table_form">

<?php if ($this->Session->read('Auth.User.level') <= 2 /*|| $place_alias['alias'] == ''*/) { ?>
    <tr>
        <td class="renglonDatos" width="25%">Usuario</td>
        <td class="renglonDatos" width="25%">
            <?php
            echo $form->input('Event.user_id',
                    array('label' => false,
                        'type' => 'select',
                        'id' => 'users',
                        'empty' => 'Selecciona un usuario',
                        'options' => $users_place));
            ?>
        </td>
<!--
        <td class="renglonDatos" width="25%">
            <?php
            echo $form->input('Event.place_id',
                    array('label' => false,
                        'value' => $this->Session->read('Auth.User.place_id'),
                        'id' => 'place_id',
                        'type' => 'hidden')); ?>
                </td>
-->
                <td class="renglonDatos" width="25%"></td>
            </tr>
<?php } else if ($this->Session->read('Auth.User.level') > 2) { ?>
            <tr>
<!--
                <td class="renglonDatos" width="25%"><?php echo $place_alias['label'] ?></td>
        <td class="renglonDatos" width="25%">
            <?php
            echo $form->input('Event.place_id',
                    array('label' => false,
                        'type' => 'select',
                        'empty' => 'Selecciona un ' . $place_alias['lowercase'],
                        'id' => 'place_id',
                        'options' => $places));
            ?>
        </td>
-->
        <td class="renglonDatos" width="25%">Usuario</td>
        <td class="renglonDatos" width="25%">
            <?php
            echo $form->input('Event.user_id',
                    array('label' => false,
                        'type' => 'select',
                        'empty' => 'Selecciona un usuario',
                        'id' => 'users',
                        'options' => $users_place));
            ?>
        </td>
    </tr>
<?php } ?>
    <tr>
        <td colspan="4" align="right">
            <input type="reset" name="Submit" value="Restablecer" class="button" />&nbsp;
<?php echo $form->submit('Buscar', array('div' => false, 'id' => 'buscar')); ?>
                </td>
            </tr>
        </table>
<?php
        echo $form->input('Event.month',
                array('label' => false,
                    'value' => $month,
                    'type' => 'hidden'));
?>

<?php
        echo $form->input('Event.year',
                array('label' => false,
                    'value' => $year,
                    'type' => 'hidden'));
?>
<?php echo $this->Form->end(); ?>

<div id="spinner" class="ajax-loading" style="display: none;">Cargando...</div>
<div id="calendar"></div>