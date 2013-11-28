

<h2>Historial: <div class="nota_historial">NOTA IMPORTANTE: No AGREGAR EVENTO si existen eventos ABIERTOS en el historial</div></h2>

<table class="common_table">
    <?php if( empty($events)): ?>
        <tr>
            <td align="center">No hay historial.</td>
        </tr>
    <?php else: ?>
        <?php foreach($events as $event ): ?>
            <tr>
                <th class="historial_event_title" colspan="2">
                    <?php echo (( empty( $event['Status']['id']) ) ? 'Abierto':'Cerrado').': '.$event['Event']['subject']; ?>
                </th>

                <th align="right" colspan="2">
                    <?php echo strftime("%d-%m-%Y %X",strtotime($event['Event']['date'])); ?>&nbsp;
                </th>
            </tr>
            <tr>
                <td class="historial_event_title_cell">Categoria de Status:</td>
                <td><?php echo @$event['Status']['StatusCategory']['name']; ?></td>

                <td class="historial_event_title_cell">Status:</td>
                <td class="statusName"><?php echo @$event['Status']['name']; ?></td>
            </tr>
            <tr>
                <td class="historial_event_title_cell">Comentarios:</td>
                <td><?php echo $event['Event']['comments']; ?></td>
                <td class="historial_event_title_cell">Usuario:</td>
                <td><?php echo $event['User']['name']; ?></td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php echo $this->Html->link('Consultar','/atender-evento/'.$event['Event']['id']); ?>
                </td>
            </tr>

        <?php endforeach; ?>

    <?php endif; ?>
</table>