<h2>Contactos Asignados.</h2>
<?php
    echo $this->element('prospects/search_section', array(
        'genders' => $genders,
        'states' => $states,
        'status_categories' => $status_categories,
        'medium_categories' => $medium_categories,
        'places' => $places,
        'origins' => $origins
));
?>
<?php if($this->Session->read('Auth.User.level') >= 3){ ?>
<h2><?php echo $this->Html->link('Descargar XLS',array('action'=>'assigned_prospects_xls_download'),array('style'=>'color:white;')); ?></h2>
<?php } ?>
<div id="spinner" class="ajax-loading cargando" style="display: none;"></div>
<div id="prospectos_asignados">
    <?php
    echo $this->element('prospects/list_assigned_prospects', array('assigned_prospects' => $assigned_prospects));
    ?>
</div>