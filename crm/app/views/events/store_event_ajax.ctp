<?php
echo $this->Html->script('events/store_event_ajax');
?>

<?php if( isset($store_future_event_message) ): ?>
    <span style="color:red;">No se pudo guardar, éste Status requiere de agendar un evento a futuro.</span>
<?php else: ?>
    <?php if( isset($store_event_message) ): ?>
        <span style="color:red;">Este prospecto tiene un evento abierto. No puede agendar un evento nuevo hasta que cierre el actual.</span>
    <?php else: ?>
        <?php if( $success ): ?>
            <input type="hidden" value="<?php echo $prospect_id; ?>" id="prospect_id_select"/>
            <h2>Evento guardado exitosamente</h2>
            <script type="text/javascript">redirectEvent();</script>
        <?php else: ?>
            <h2>Hubo un error, intente nuevamente.</h2>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>