<?php
    echo $this->Html->script('utils/dynamic_combos', false);

    echo $this->element('prospects/prospect_edit_form', array(
            'prospect'          => $event['Prospect'],
            'current_cities'    => $current_cities,
            'states'            => $states,
            'medium_categories' => $medium_categories,
            'current_media'     => $current_media,
            'genders'           => $genders,
            'origins'           => $origins,
            'current_medium_cat'=> $current_medium_cat
    ));

    echo $this->element('events/event_monitoring_form', array(
        'event'             => $event,
        'status_categories' => $status_categories
    ));

    echo $this->element('events/events_history', array('events' => $events_history ));
?>