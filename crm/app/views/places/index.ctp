
<div class="users index">
    <h2><?php __('Lugares');?></h2>

    <div>
        <?php echo $html->link('Agregar Lugar','/agregar-lugar'); ?>
    </div>


    <div>
        <table>
            <tr>
                <th><?php echo $paginator->sort('ID', 'id'); ?></th>
                <th><?php echo $paginator->sort('Nombre', 'name'); ?></th>
                <th><?php echo $paginator->sort('Fecha de creación', 'created'); ?></th>
                <th>Acciones</th>
            </tr>

            <?php foreach($places as $place): ?>
                <tr>
                    <td><?php echo $place['Place']['id']; ?> </td>
                    <td><?php echo $place['Place']['name']; ?> </td>
                    <td><?php echo $place['Place']['created']; ?> </td>
                    <td>
                        <?php
                            echo $this->Html->link('Editar', array('controller'=>'places', 'action'=>'edit', $place['Place']['id']));
                            echo '  ';
                            echo $html->link(
                                'Eliminar',
                                array('controller'=>'places', 'action'=>'delete', $place['Place']['id']),
                                array(),
                                '¿Estás seguro de que quieres eliminar este lugar?'
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