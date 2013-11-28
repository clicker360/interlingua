<div class="users index">
    <h2><?php __('Categorias Medios');?></h2>

    <div>
        <?php echo $html->link('Agregar Categoria Medio','/agregar-categoria-medio'); ?>
    </div>


    <div>
        <table>
            <tr>
                <th><?php echo $paginator->sort('ID', 'id'); ?></th>
                <th><?php echo $paginator->sort('Nombre', 'name'); ?></th>
                <th><?php echo $paginator->sort('Fecha de creación', 'created'); ?></th>
                <th>Acciones</th>
            </tr>

            <?php foreach($medium_categories as $medium_category): ?>
                <tr>
                    <td><?php echo $medium_category['MediumCategory']['id']; ?> </td>
                    <td><?php echo $medium_category['MediumCategory']['name']; ?> </td>
                    <td><?php echo $medium_category['MediumCategory']['created']; ?> </td>
                    <td>
                        <?php
                            echo $this->Html->link('Editar', array('controller'=>'medium_categories', 'action'=>'edit', $medium_category['MediumCategory']['id']));
                            echo '  ';
                            echo $html->link(
                                'Eliminar',
                                array('controller'=>'medium_categories', 'action'=>'delete', $medium_category['MediumCategory']['id']),
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