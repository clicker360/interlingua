
<div class="users index">
    <h2><?php __('Status');?></h2>

    <div>
        <?php echo $html->link('Agregar Status','/agregar-status'); ?>
    </div>


    <div>
        <table>
            <tr>
                <th><?php echo $paginator->sort('ID', 'id'); ?></th>
                <th><?php echo $paginator->sort('Nombre', 'name'); ?></th>
                <th><?php echo $paginator->sort('Categoria', 'StatusCategory.name'); ?></th>
                <th><?php echo $paginator->sort('Fecha de creación', 'created'); ?></th>
                <th>Acciones</th>
            </tr>

            <?php foreach($statuses as $status): ?>
                <tr>
                    <td><?php echo $status['Status']['id']; ?> </td>
                    <td><?php echo $status['Status']['name']; ?> </td>
                    <td><?php echo $status['StatusCategory']['name']; ?> </td>
                    <td><?php echo $status['Status']['created']; ?> </td>
                    <td>
                        <?php
                            echo $this->Html->link('Editar', array('controller'=>'statuses', 'action'=>'edit', $status['Status']['id']));
                            echo '  ';
                            echo $html->link(
                                'Eliminar',
                                array('controller'=>'statuses', 'action'=>'delete', $status['Status']['id']),
                                array(),
                                '¿Estás seguro de que quieres eliminar este status?'
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