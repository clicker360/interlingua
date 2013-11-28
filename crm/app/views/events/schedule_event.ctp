<?php
    echo $this->Html->css('jquery.ui/custom-theme/jquery-ui-1.8.5.custom', false);
    echo $this->Html->script('jquery/ui/js/jquery-ui-1.8.5.custom.min', false);
    echo $this->Html->script('jquery-validate/jquery.validate', false);
    echo $this->Html->script('events/schedule_event', false);
?>

<h1> Agendar Evento </h1>

<?php
    echo $this->element('prospects/view_prospect_details', array('prospect'=>$prospect));
?>
<br/>
<?php echo $form->create('Event',array('id'=>'schedule_event_form','action' => 'store_event'));?>

    <table cellspacing="0" cellpadding="5" class="table_form">
        <tr>
            <td class="table_title_cells">Asunto:</td>
            <td><?php echo $form->input('Event.subject',array('maxLength'=>65,'label'=>false, 'type'=>'text','class'=>'required')); ?></td>
        </tr>
        <tr>
            <td class="table_title_cells">Fecha:</td>
            <td>
                <?php
                    echo $form->input('Event.date',array(
                        'id'    => 'event_date_field',
                        'type'  => 'text',
                        'label' => false,
                        'div'   => false,
                        'class' => 'required dateField'
                   ));
                ?>
            </td>
        </tr>
        <tr>
            <td class="table_title_cells">Hora:</td>
            <td>
                <?php
                    echo $form->input('Event.hours',array(
                        'id'    => 'hours_field',
                        'type'  => 'select',
                        'label' => false,
                        'div'   => false,
                        'class' => 'required'
                   ));
                    echo ' : ';
                    echo $form->input('Event.minutes',array(
                        'id'    => 'minutes_field',
                        'type'  => 'select',
                        'label' => false,
                        'div'   => false,
                        'class' => 'required'
                   ));
                    echo ' ';
                    echo $form->input('Event.meridian',array(
                        'id'    => 'meridian_field',
                        'type'  => 'select',
                        'label' => false,
                        'div'   => false,
                        'class' => 'required',
                        'options' => array( 'am' => 'a.m.', 'pm' => 'p.m.')
                   ));
                ?>
            </td>
        </tr>
        <tr>
            <td class="table_title_cells">¿Realizar ahora?</td>
            <td>
                <?php echo $form->input('Event.now',array('label'=>false,'type'=>'checkbox','div'=>false,'onclick'=>'toggleTime(this);')); ?>
            </td>
        </tr>

        <tr>
            <td class="table_title_cells">Observaciones:</td>
            <td><?php   echo $form->input('Event.comments',array('type'=>'input','label'=>false)); ?></td>
        </tr>

        <tr>
            <td colspan="2" align="left">
                <?php echo $form->submit('Guardar',array('div'=>false,'id'=>'submit')); ?>&nbsp;
                <?php echo $html->link('Regresar','/prospects/view/'.$prospect['Prospect']['id']) ?>
            </td>
        </tr>

    </table>
<?php

    echo $form->input('Event.prospect_id',array('type'=>'hidden','value'=>$prospect['Prospect']['id']));
    echo $form->input('Event.user_id',array('type'=>'hidden','value'=>$prospect['Prospect']['user_id']));
    
    echo $form->end();
?>
<?php
    echo $this->element('events/events_history', array('events'=>$events ));
?>

