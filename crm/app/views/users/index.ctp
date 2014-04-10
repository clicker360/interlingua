
<div class="users index">
    <h2><?php __('Usuarios');?></h2>

    <div>
        <?php echo $html->link('Agregar Usuario','/agregar-usuario'); ?>
    </div>


    <div>
        <table>
            <tr>
                <th><?php echo $paginator->sort('ID', 'id'); ?></th>
                <th><?php echo $paginator->sort('Nombre', 'name'); ?></th>

                <th><?php echo $paginator->sort('Username', 'username'); ?></th>
                <th><?php echo $paginator->sort('Correo Electrónico','email'); ?></th>
                <th>Teléfono</th>
                <th><?php echo $paginator->sort('Activo', 'active'); ?></th>
                <th><?php echo $paginator->sort('Lugar', 'Place.name'); ?></th>
                <th><?php echo $paginator->sort('Fecha de creación', 'created'); ?></th>
                <th>Acciones</th>
            </tr>

            <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $user['User']['id']; ?> </td>
                    <td><?php echo $user['User']['name']; ?> </td>
                    <td><?php echo $user['User']['username']; ?> </td>
                    <td><?php echo $user['User']['email']; ?> </td>
                    <td><?php echo $user['User']['area_code'].'-'.$user['User']['phone_number']; ?> </td>
                    <td><?php echo $user['User']['active']; ?> </td>
                    <td><?php echo $user['Place']['name']; ?> </td>
                    <td><?php echo $user['User']['created']; ?> </td>
                    <td>
                        <?php
                            echo $this->Html->link('Editar', array('controller'=>'users', 'action'=>'edit', $user['User']['id']));
                            echo '  ';
                            echo $html->link(
                                'Eliminar',
                                array('controller'=>'users', 'action'=>'delete', $user['User']['id']),
                                array(),
                                '¿Estás seguro de que quieres eliminar este usuario?'
                            );
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="paging">
        <?php
            echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));
            echo ' | ';
            echo $paginator->numbers();
            echo ' | ';
            echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class'=>'disabled'));
        ?>
    </div>

</div>