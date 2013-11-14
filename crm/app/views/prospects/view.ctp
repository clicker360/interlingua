<h1> Ver Prospecto </h1>
<?php
    echo $this->element('prospects/view_prospect_details', array('prospect'=>$this->data));
?>

<table border="0" style="float:right;">
    <tr>
        <td>
            <input type="hidden" id="prospect_id" value="<?php echo $this->data['Prospect']['id']; ?>" />
            <input type="button" id="edit_prospect_button" value="Editar" />
            <input type="button" id="schedule_event_button" value="Agregar Evento"/>
            <input type="button" id="back_button" value="Regresar" />
        </td>
    </tr>
</table>

<div class="clear"></div>
<br/>

<?php
    echo $this->element('events/events_history', array('events'=>$events ));
?>
