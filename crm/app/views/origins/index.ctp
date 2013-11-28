<div class="users index">
    <h2><?php __('Origins');?></h2>

    <div>
        <?php echo $html->link('Agregar Origen','/agregar-origen'); ?>
    </div>


    <div>
        <table>
            <tr>
                <th><?php echo $paginator->sort('ID', 'id'); ?></th>
                <th><?php echo $paginator->sort('Nombre', 'name'); ?></th>
                <th><?php echo $paginator->sort('Fecha de creación', 'created'); ?></th>
                <th>Acciones</th>
            </tr>

            <?php foreach($origins as $origin): ?>
                <tr>
                    <td><?php echo $origin['Origin']['id']; ?> </td>
                    <td><?php echo $origin['Origin']['name']; ?> </td>
                    <td><?php echo $origin['Origin']['created']; ?> </td>
                    <td>
                        <?php
                            echo $this->Html->link('Editar', array('controller'=>'origins', 'action'=>'edit', $origin['Origin']['id']));
                            echo '  ';
                            echo $html->link(
                                'Eliminar',
                                array('controller'=>'origins', 'action'=>'delete', $origin['Origin']['id']),
                                array(),
                                '¿Estás seguro de que quieres eliminar este origin?'
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