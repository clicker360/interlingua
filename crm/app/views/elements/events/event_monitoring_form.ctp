<?php
echo $this->Html->css('jquery.ui/custom-theme/jquery-ui-1.8.5.custom', false);
echo $this->Html->script('jquery/ui/js/jquery-ui-1.8.5.custom.min', false);
echo $this->Html->script('events/event_monitoring_form');
echo $this->Html->script('events/future_event_form');

if(empty($event['Event']['status_id'])){ ?>
  <?php echo $form->create('Event'); ?>
    <table width="100%">
        <tr>
            <td width="50%"> <h2>Seguimiento de Evento Actual</h2> </td>
            <td width="50%"> <h2>Agendar Evento Futuro</h2> </td>
        </tr>
        <tr>
            <td>
                <table class="common_table">
                    <tr>
                        <td class="table_title_cells">Categoría de Status</td>
                        <td>
                            <?php
                            echo $form->input('Status.status_category_id', array(
                                'id' => 'status_categories_select_seguimiento',
                                'empty' => 'Selecciona una categoria de status',
                                'type' => 'select',
                                'label' => false,
                                'options' => $status_categories,
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="table_title_cells">Status</td>
                        <td>
                            <?php
                            echo $form->input('Event.status_id', array(
                                'id' => 'status_select_seguimiento',
                                'type' => 'select',
                                'label' => false,
                                'empty' => 'Selecciona un status'
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="table_title_cells">Comentarios</td>
                        <td>
                            <?php
                            echo $form->input('Event.comments', array(
                                'id' => 'follow_event_comments',
                                'type' => 'textarea',
                                'label' => false,
                                'value' => $event['Event']['comments']
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <?php echo $form->submit('Guardar'); ?>
                            <div id="follow_event_message"></div>
                        </td>
                    </tr>
                </table>
                <?php
                echo $form->input('Event.id', array(
                    'id' => 'follow_event_id',
                    'type' => 'hidden',
                    'value' => $event['Event']['id']
                ));
                echo $form->input('Event.prospect_id', array(
                    'type' => 'hidden',
                    'value' => $event['Event']['prospect_id'],
                    'id' => 'follow_event_prospect_id'
                ));
                echo $form->input('Event.user_id', array(
                    'type' => 'hidden',
                    'value' => $event['Event']['user_id'],
                    'id' => 'follow_event_user_id'
                ));
                ?>
            </td>
            <td>
                <table class="common_table">
                    <tr>
                        <td class="table_title_cells">Asunto:</td>
                        <td>
                            <?php
                            echo $form->input('EventF.subject', array(
                                'id' => 'future_event_subject',
                                'maxLength' => 65,
                                'label' => false,
                                'type' => 'text',
                                'class' => 'required'
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="table_title_cells">Fecha:</td>
                        <td>
                            <?php
                            echo $form->input('EventF.date', array(
                                'id' => 'event_date_field',
                                'type' => 'text',
                                'label' => false,
                                'div' => false,
                                'class' => 'required dateField'
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="table_title_cells">Hora:</td>
                        <td>
                            <?php
                            echo $form->input('EventF.hours', array(
                                'id' => 'hours_field',
                                'type' => 'select',
                                'label' => false,
                                'div' => false,
                                'class' => 'required'
                            ));
                            echo ' : ';
                            echo $form->input('EventF.minutes', array(
                                'id' => 'minutes_field',
                                'type' => 'select',
                                'label' => false,
                                'div' => false,
                                'class' => 'required'
                            ));
                            echo ' ';
                            echo $form->input('EventF.meridian', array(
                                'id' => 'meridian_field',
                                'type' => 'select',
                                'label' => false,
                                'div' => false,
                                'class' => 'required',
                                'options' => array('am' => 'a.m.', 'pm' => 'p.m.')
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="table_title_cells">Observaciones:</td>
                        <td>
                            <?php
                            echo $form->input('EventF.comments', array(
                                'id' => 'future_comments',
                                'type' => 'input',
                                'label' => false
                            ));
                            ?>
                            <span style="font-weight:bold">NOTA IMPORTANTE</span>
                            : No Agendar Evento Futuro en casos en los que el
                            último Detalle de Status que se asignó en el Evento Actual sea CERRADO.
                            (Inscrito, No interesado, Datos Falsos y Pruebas)

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left">
                            <div id="future_event_message"></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
  <?php echo $form->end(); ?>
<?php } else { ?>
    <table width="100%" border="0" cellspacing="2" cellpadding="0" align="center" style="border: 1px solid #CCCCCC;">
        <tr>
            <td style="font-weight: bold; background: #EEEEEE; height: 20px;" width="25%">Status:</td>
            <td width="25%"><?php echo $status_categories[$event['Status']['status_category_id']]; ?></td>
            <td style="font-weight: bold; background: #EEEEEE; height: 20px;" width="25%">Detalle Status:</td>
            <td width="25%"><?php echo $event['Status']['name']; ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold; background: #EEEEEE; height: 20px;" width="25%">Comentarios:</td>
            <td colspan="3"><?php echo $event['Event']['comments']; ?></td>
        </tr>
        <tr>
            <td colspan="4" style="text-align:center;">
                <?php echo $this->Form->button('Agendar Evento', array('type'=>'button', 'onclick'=>"location.href='" . $this->Html->url('/agendar-evento/'. $event['Event']['prospect_id']) . "';")); ?>
                <div id="store_prospect_message"></div>
            </td>
        </tr>
    </table>
<?php } ?>