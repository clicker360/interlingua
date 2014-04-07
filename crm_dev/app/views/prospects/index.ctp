<?php
    echo $this->Html->script('prospects/index');
    echo $this->element('prospects/unassigned_prospects_section', array('unassigned_prospects' => $unassigned_prospects));
    echo $this->element('prospects/assigned_prospects_section',   array(
        'assigned_prospects' => $assigned_prospects,
        'genders'            => $genders,
        'states'             => $states,
        'medium_categories'  => $medium_categories,
        'status_categories'  => $status_categories ,
        'places'             => $places,
        'origins'            => $origins
    ));
?>