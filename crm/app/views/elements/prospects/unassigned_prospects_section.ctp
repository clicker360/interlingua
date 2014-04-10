<h2>Contactos sin asignar.</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
        <td class="toolBar">
            <?php
            echo $this->Html->image("icons/arrow_refresh.png",
                    array(
                        'alt' => 'Asignar',
                        'class' => 'Tips',
                        'id' => 'refresh_unassigned'
                    ),
                    false);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <div id="prospectos_no_asignados">
                <?php
                echo $this->element('prospects/list_unassigned_prospects',array('unassigned_prospects' => $unassigned_prospects));
                ?>
            </div>
        </td>
    </tr>
</table>