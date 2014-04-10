<div class="users index">
    <h2><?php __('Categorias Status');?></h2>

    <div>
        <?php echo $html->link('Agregar Categoria Status','/agregar-categoria-status'); ?>
    </div>


    <div>
        <table>
            <tr>
                <th><?php echo $paginator->sort('ID', 'id'); ?></th>
                <th><?php echo $paginator->sort('Nombre', 'name'); ?></th>
                <th><?php echo $paginator->sort('Fecha de creación', 'created'); ?></th>
                <th>Acciones</th>
            </tr>

            <?php foreach($status_categories as $status_category): ?>
                <tr>
                    <td><?php echo $status_category['StatusCategory']['id']; ?> </td>
                    <td><?php echo $status_category['StatusCategory']['name']; ?> </td>
                    <td><?php echo $status_category['StatusCategory']['created']; ?> </td>
                    <td>
                        <?php
                            echo $this->Html->link('Editar', array('controller'=>'status_categories', 'action'=>'edit', $status_category['StatusCategory']['id']));
                            echo '  ';
                            echo $html->link(
                                'Eliminar',
                                array('controller'=>'status_categories', 'action'=>'delete', $status_category['StatusCategory']['id']),
                                array(),
                                '¿Estás seguro de que quieres eliminar esta categoria?'
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