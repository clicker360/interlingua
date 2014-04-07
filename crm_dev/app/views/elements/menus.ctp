<div id="menu1">
    <table style="width:100%">
        <tr>
            <!-- Si se está autenticado, muestra el menú de salir -->
            <?php if($session->check('Auth.User')): ?>

                <td><?php echo $this->Html->link('Prospectos', '/prospectos');?></td>
                <td><?php echo $this->Html->link('Agenda', '/agenda');?></td>
                <?php if($this->Session->read('Auth.User.level')==4){ ?>
                    <!--<td><?php echo $this->Html->link('Lugares', '/listar-lugares');?></td>-->
                    <!--<td><?php echo $this->Html->link('Categorias de Medios', '/listar-categorias-medios');?></td>-->
                    <!--<td><?php echo $this->Html->link('Medios', '/listar-medios');?></td>-->
                    <td><?php echo $this->Html->link('Lugares', '/listar-lugares');?></td>
                    <td><?php echo $this->Html->link('Categorias de Status', '/listar-categorias-status');?></td>
                    <td><?php echo $this->Html->link('Status', '/listar-status');?></td>
                    <td><?php echo $this->Html->link('Origenes', '/listar-origenes');?></td>

                    <!--<td><?php echo $this->Html->link('Origins', '/listar-origins');?></td>-->
                <?php }?>
                <?php if($this->Session->read('Auth.User.level')>1){?>
                    <td><?php echo $this->Html->link('Usuarios', '/listar-usuarios');?></td>
                <?php }?>
                <td><?php echo $this->Html->link('Reportes', '/reportes');?></td>

                <td><?php echo $this->Html->link('Salir', array('controller'=>'users', 'action'=>'logout'));?></td>

            <?php endif; ?>
        </tr>
    </table>
</div>