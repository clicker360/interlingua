<?php 
    echo $session->flash('auth');
    echo $form->create('User', array('controller' => 'users', 'action' => 'login'));
?>

<table cellspacing="0" cellpadding="5" class="table_form" align="center" style="width:400px; margin:auto;">
    <tr>
        <td>Usuario:</td>
        <td><?php echo $form->input('User.username',array('type'=>'text','label'=>false)); ?></td>
    </tr>
    <tr>
        <td>Password:</td>
        <td><?php echo $form->input('User.password',array('label'=>false)); ?></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><?php echo $form->submit('Entrar',array('div'=>false)); ?></td>
    </tr>
</table>

<?php echo $form->end(); ?>