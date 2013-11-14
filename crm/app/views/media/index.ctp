
<div class="users index">
    <h2><?php __('Medios');?></h2>

    <div>
        <?php echo $html->link('Agregar Medio','/agregar-medio'); ?>
    </div>


    <div>
        <table>
            <tr>
                <th><?php echo $paginator->sort('ID', 'id'); ?></th>
                <th><?php echo $paginator->sort('Nombre', 'name'); ?></th>
                <th><?php echo $paginator->sort('Categoria', 'MediumCategory.name'); ?></th>
                <th><?php echo $paginator->sort('Fecha de creación', 'created'); ?></th>
                <th>Acciones</th>
            </tr>

            <?php foreach($media as $medium): ?>
                <tr>
                    <td><?php echo $medium['Medium']['id']; ?> </td>
                    <td><?php echo $medium['Medium']['name']; ?> </td>
                    <td><?php echo $medium['MediumCategory']['name']; ?> </td>
                    <td><?php echo $medium['Medium']['created']; ?> </td>
                    <td>
                        <?php
                            echo $this->Html->link('Editar', array('controller'=>'media', 'action'=>'edit', $medium['Medium']['id']));
                            echo '  ';
                            echo $html->link(
                                'Eliminar',
                                array('controller'=>'media', 'action'=>'delete', $medium['Medium']['id']),
                                array(),
                                '¿Estás seguro de que quieres eliminar este medio?'
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