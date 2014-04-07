	<?php 
    $url_parametros = explode('/',$this->params['url']['url']);
    if(isset($url_parametros[2]) && $url_parametros[2] == 'ASC') {
        $url_orden = 'DESC';
    } else {
        $url_orden = 'ASC';
    }

    $fields =array(
        array('id'=>'0','label'=>'Id','model'=>'Prospect','keys'=>array('id'),'join'=>'','parametros'=>array('0'=>'Prospect.id','1'=>$url_orden)),
        array('id'=>'1','label'=>'Nombre','model'=>'Prospect','keys'=>array('name'),'join'=>'','parametros'=>array('0'=>'Prospect.name','1'=>$url_orden)),
        array('id'=>'2','label'=>'Correo electrónico','model'=>'Prospect','keys'=>array('email'),'join'=>'','parametros'=>array('0'=>'Prospect.email','1'=>$url_orden)),
        array('id'=>'2','label'=>'Lugar','model'=>'Place','keys'=>array('name'),'join'=>'','parametros'=>array('0'=>'Place.name','1'=>$url_orden)),
        array('id'=>'2','label'=>'Origen','model'=>'Prospect','keys'=>array('origin_id'),'join'=>'','parametros'=>array('0'=>'Prospect.origin_id','1'=>$url_orden)),
        array('id'=>'3','label'=>'Lada','model'=>'Prospect','keys'=>array('lada'),'join'=>'','parametros'=>array('0'=>'Prospect.lada','1'=>$url_orden)),
        array('id'=>'4','label'=>'Teléfono','model'=>'Prospect','keys'=>array('phone_number'),'join'=>'','parametros'=>array('0'=>'Prospect.phone_number','1'=>$url_orden)),
        array('id'=>'4','label'=>'Celular','model'=>'Prospect','keys'=>array('mobile_number'),'join'=>'','parametros'=>array('0'=>'Prospect.mobile_number','1'=>$url_orden)),
        array('id'=>'4','label'=>'Plantel','model'=>'Prospect','keys'=>array('plantel'),'join'=>'','parametros'=>array('0'=>'Prospect.plantel','1'=>$url_orden)),
        array('id'=>'5','label'=>'Estado','model'=>'Prospect','keys'=>array('estado'),'join'=>'','parametros'=>array('0'=>'Prospect.estado','1'=>$url_orden)),
        array('id'=>'7','label'=>'Usuario','model'=>'User','keys'=>array('name'),'join'=>'','parametros'=>array('0'=>'User.name','1'=>$url_orden)),
        array('id'=>'10','label'=>'Categoría de Status','model'=>'StatusCategory','keys'=>array('name'),'join'=>''),
        array('id'=>'11','label'=>'Status','model'=>'Status','keys'=>array('name'),'join'=>'','parametros'=>array('0'=>'Status.name','1'=>$url_orden)),
        array('id'=>'12','label'=>'Fecha de Registro','model'=>'Prospect','keys'=>array('created'),'join'=>'','parametros'=>array('0'=>'Prospect.created','1'=>$url_orden)),
        array('id'=>'13','label'=>'Fecha de Asignación','model'=>'Prospect','keys'=>array('assignation_date'),'join'=>'','parametros'=>array('0'=>'Prospect.assignation_date','1'=>$url_orden)),
        array('id'=>'14','label'=>'Fecha de cita','model'=>'Prospect','keys'=>array('fecha_cita'),'join'=>'','parametros'=>array('0'=>'Prospect.fecha_cita','1'=>$url_orden)),
        array('id'=>'14','label'=>'Clave AS 400','model'=>'Prospect','keys'=>array('clave_as_400'),'join'=>'','parametros'=>array('0'=>'Prospect.clave_as_400','1'=>$url_orden)),
    );
    
    echo $form->create('', array('id'=>'AssignedIndexForm'));
    echo $form->hidden('param_1');
    echo $form->hidden('param_2');
?>
    <div id="nuevos">
        <?php
        echo 'Hay ' . $total_assigned_prospects . ' Prospecto(s).';
        ?>
    </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
            <?php $this->Crm->displayHeaders($fields);?>
            <th></th>
        </tr>

        <?php foreach( $assigned_prospects as $assigned_prospect ):?>
            <tr>
                <?php $this->Crm->displayFields($assigned_prospect,$fields);?>
                <td>
                    <?php
                        echo $this->Html->image('icons/folder_table.png', array(
                            'alt' => 'Ver Detalles',
                            'url' => '/detalles-prospecto/'.$assigned_prospect['Prospect']['id'],
                            ''
                        ));
                    ?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <div id="boton_paginator">
        <!-- Shows the page numbers -->
        <?php echo $this->Paginator->numbers(); ?>
        <!-- Shows the next and previous links -->
        <?php echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
        <?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?>
        <!-- prints X of Y, where X is current page and Y is number of pages -->
        <?php echo $this->Paginator->counter(); ?>
    </div>
<?php echo $form->end(); ?>

<script type="text/javascript">
    
    $('#boton_paginator a').click(function(){
        $('.cargando').show();
        $('#prospectos_asignados').hide();
        var index = this.toString();
        index = index.substring((index.length-1),(index.length));
         var search_params = {
            'data[Prospect][id]'                    : $('#search_prospect_id').val(),
            'data[Prospect][name]'                  : $('#search_prospect_name').val(),
            'data[Prospect][email]'                 : $('#search_prospect_email').val(),
            'data[Prospect][gender_id]'             : $('#search_prospect_gender_id').val(),
            'data[Prospect][state_id]'              : $('#states_select').val(),
            'data[Prospect][city_id]'               : $('#cities_select').val(),
            'data[Prospect][medium_category_id][]'  : $('#medium_category_select').val(),
            'data[Prospect][medium_id][]'           : $('#medium_select').val(),
            'data[Prospect][status_category_id][]'  : $('#status_category_select').val(),
            'data[Prospect][status_id][]'           : $('#status_select').val(),
            'data[Prospect][place_id]'              : $('#places_select').val(),
            'data[Prospect][user_id][]'             : $('#users_select').val(),
            'data[Prospect][to_date]'               : $('#to_date').val(),
            'data[Prospect][from_date]'             : $('#from_date').val(),
            'data[Prospect][origin_id]'             : $('#search_prospect_origin_id').val()
        };

        $.post(
            <?php if(isset($this->params['pass'][0])) {?>
                Crm.basePath + 'search-prospects-ajax/<?php echo $this->params['pass'][0]; ?>/<?php echo $this->params['pass'][1]; ?>/page:'+index+'',
            <?php } else { ?>
                Crm.basePath + 'search-prospects-ajax/'+index+'',
            <?php }?>    
            search_params,
            function(data){
                $('.cargando').hide();
                $('#prospectos_asignados').html(data);
                $('#prospectos_asignados').show();
            },
            ''
        );

        return false;
    });
    
    $('#AssignedIndexForm').submit(function(){
        $('.cargando').show();
        $('#prospectos_asignados').hide();
        var search_params = {
            'data[Prospect][id]'                    : $('#search_prospect_id').val(),
            'data[Prospect][name]'                  : $('#search_prospect_name').val(),
            'data[Prospect][email]'                 : $('#search_prospect_email').val(),
            'data[Prospect][lada]'                  : $('#search_prospect_lada').val(),
            'data[Prospect][phone_number]'          : $('#search_prospect_phone_number').val(),
            'data[Prospect][servicio]'              : $('#search_prospect_servicio').val(),
            'data[Prospect][asesor]'                : $('#search_prospect_asesor').val(),
            'data[Prospect][gender_id]'             : $('#search_prospect_gender_id').val(),
            'data[Prospect][state_id]'              : $('#states_select').val(),
            'data[Prospect][city_id]'               : $('#cities_select').val(),
            'data[Prospect][medium_category_id][]'  : $('#medium_category_select').val(),
            'data[Prospect][medium_id][]'           : $('#medium_select').val(),
            'data[Prospect][status_category_id][]'  : $('#status_category_select').val(),
            'data[Prospect][status_id][]'           : $('#status_select').val(),
            'data[Prospect][place_id]'              : $('#places_select').val(),
            'data[Prospect][user_id][]'             : $('#users_select').val(),
            'data[Prospect][to_date]'               : $('#to_date').val(),
            'data[Prospect][from_date]'             : $('#from_date').val(),
            'data[Prospect][origin_id]'             : $('#search_prospect_origin_id').val()
        };


        $.post(
            Crm.basePath+'search-prospects-ajax/' + $('#ProspectParam1').val() + '/' + $('#ProspectParam2').val() + <?php if(isset($this->params['named']['page'])) { ?> '/page:<?php echo $this->params['named']['page']; } else { echo "'";} ?>',
            search_params,
            function(data){
                $('.cargando').hide();
                $('#prospectos_asignados').html(data);
                $('#prospectos_asignados').show();
            },
            ''
        );

        return false;
    });

    function passParams(button) {
        $('#ProspectParam1').val($('#' + button.id).attr('param_1'));
        $('#ProspectParam2').val($('#' + button.id).attr('param_2'));
    }
</script>
