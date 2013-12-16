<?php 
    echo $this->Html->script('prospects/prospect_edit_form');
?>


<h2>Datos de Prospecto</h2>
<?php echo $form->create('Prospect', array('action'=>'store_prospect')); ?>
<?php
    echo $form->input('Prospect.id', array(
        'id'    => 'prospect_id','type'  =>'hidden','value' => $prospect['id']
    ));
    echo $form->input('Prospect.id', array(
        'id'    => 'verifySave','type'  =>'hidden','value' => $prospect['save_AS400']
    ));
    echo $form->input('Prospect.id', array(
        'id'    => 'prospPlantel','type'  =>'hidden','value' => $prospect['plantel']
    ));
    echo $form->input('Prospect.id', array(
        'id'    => 'propsEdo','type'  =>'hidden','value' => $prospect['estado']
    ));
?>
<?php                                 
    $db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP","CLICKER","CLICKER");
    $sql = "CALL SCAPAL.TMEDI_LISTA()";
    $stmt = $db->query($sql);
    $optionsPublicidad = array();
    do {
      $rows = $stmt->fetchAll(PDO::FETCH_NUM);
      if($rows){
        foreach($rows as $value){
           //echo '<option value="'.$value[0].'">'.utf8_encode($value[1]).'</option>';        
           $optionsPublicidad[trim($value[0])] = utf8_encode($value[1]);
        }
      }
    }while($stmt->nextRowset());
?>
<?php
    echo $this->Html->script('prospects/view_prospect_details');
    $fields =array(
        array('id'=>'1','label'=>'Nombre','model'=>'Prospect','keys'=>'name','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_name')),
        array('id'=>'1','label'=>'Apellido Paterno','model'=>'Prospect','keys'=>'apellido_paterno','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_ap_paterno')),
        array('id'=>'1','label'=>'Apellido Materno','model'=>'Prospect','keys'=>'apellido_materno','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_ap_materno')),
        array('id'=>'4','label'=>'Correo electrónico','model'=>'Prospect','keys'=>array('email'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_email')),
        array('id'=>'2','label'=>'Lada','model'=>'Prospect','keys'=>array('lada'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_lada')),
        array('id'=>'3','label'=>'Telefono','model'=>'Prospect','keys'=>array('phone_number'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_phone_number')),
        array('id'=>'3','label'=>'Celular','model'=>'Prospect','keys'=>array('mobile_number'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_mobile_number')),
        array('id'=>'1','label'=>'Medio de contacto','model'=>'Prospect','keys'=>'medio_contacto','editable'=>true, 'options'=>array('id' => 'prospect_medio_contacto', 'label' => false, 'type' => 'select', 'options' => array('CHAT'=>'Chat','EMAIL'=>'Email','LLAMADA'=>'Llamada'), 'empty' => 'Selecciona medio de contacto')),
        array('id'=>'1','label'=>'Medio de publicidad','model'=>'Prospect','keys'=>'medio_publicidad','editable'=>true, 'options'=>array('id' => 'prospect_medio_publicidad', 'label' => false, 'type' => 'select', 'options' => $optionsPublicidad, 'empty' => 'Selecciona medio de publicidad')),
        array('id'=>'1','label'=>'Fecha de nacimiento','model'=>'Prospect','keys'=>'fecha_nacimiento','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_fecha_nacimiento')),
        array('id'=>'1','label'=>'Clave AS400','model'=>'Prospect','keys'=>'clave_as_400','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_as400')),
        array('id'=>'1','label'=>'Fecha de cita','model'=>'Prospect','keys'=>'fecha_cita','editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospects_fecha_cita')),
        array('id'=>'3','label'=>'Plantel','model'=>'Prospect','keys'=>array('plantel'),'editable'=>true, 'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_plantel')),
        array('id'=>'5','label'=>'Estado','model'=>'Prospect','keys'=>'estado','editable'=>false,'options'=>array('label'=>false,'type'=>'text','id'=>'prospect_edo')),
        array('id'=>'6','label'=>'Usuario','model'=>'User','keys'=>'name','editable'=>false),
        array('id'=>'12','label'=>'Fecha Registro','model'=>'Prospect','keys'=>array('created'),'join'=>'','editable'=>false),
        array('id'=>'13','label'=>'Fecha de Asignación','model'=>'Prospect','keys'=>array('assignation_date'),'join'=>'','editable'=>false),
        array('id'=>'14','label'=>'Fecha de Última Atención','model'=>'Prospect','keys'=>array('Prospect.last_contact_date'),'join'=>'','editable'=>false)
    );
?>
    <table class="prospect_details_table">
            <?php echo $this->Crm->columnedFields($prospects,$fields)?>
    </table>
    <table width="100%"><tr>
        <td colspan="4" style="text-align:center;">
            <?php 
            echo $form->input('Prospect.origin_id',array('type'=>'hidden','value'=>$prospects['Origin']['id'], 'class'=>'required'));
            echo "<div style='margin-top:15px;margin-bottom:15px;'>";
                echo "<div style='display:inline-block;'>";
                    echo $form->submit('Guardar',array('style' => 'border:0px;color:white;background:#0098AA;padding:5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;font-weight:bold;cursor:pointer;margin-right:5px;')); 
                echo "</div>";?>
                <div id="btn-as400" style='display:inline-block;'></div>
                <div id="store_prospect_message"></div>
                </tbody>
            </div>
        </td>
    </tr></table>
<?php 
echo $form->end(); 
?>

<!-- modal -->
<div id="myModal" class="reveal-modal">
    <h1 style="color:#0098AA;">GUARDAR PROSPECTO EN AS400</h1>
    <form action="#" id="frm_mo" name="frm_mo">
    <table class="common_table">
        <tbody>
            <tr>
                <td  align="left" class="table_title_cells">RFC Letras:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="4" id="frm_rfcletras" name="frm_rfcletras">
                    </div>                        
                </td>
                <td  align="left" class="table_title_cells">RFC Fecha:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="6" id="frm_rfcfecha" name="frm_rfcfecha">
                    </div> 
                </td>
            </tr>
            <tr>
                <td  align="left" class="table_title_cells">RFC Homoclave:</td>
                <td>
                     <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="2" id="frm_rfchomo" name="frm_rfchomo">
                    </div> 
                </td> 
                <td  align="left" class="table_title_cells">RFC Digito:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="1" id="frm_rfcdig" name="frm_rfcdig">
                    </div> 
                </td>
            </tr>
            <tr>
               <td  align="left" class="table_title_cells">Nombre:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="65" id="frm_nombre" name="frm_nombre">
                    </div> 
                </td>
                <td align="left" class="table_title_cells">Apellido Paterno:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="65" id="frm_appat" name="frm_appat">
                    </div> 
                </td>
            </tr>
            <tr>
                <td  align="left" class="table_title_cells">Apellido Materno:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="65" id="frm_apmat" name="frm_apmat">
                    </div> 
                </td>
                <td  align="left" class="table_title_cells">Lada Particular:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="3" id="frm_lada" name="frm_lada">
                    </div> 
                </td>
            </tr>
            <tr>
                <td  align="left" class="table_title_cells">Teléfono Particular:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="10" id="frm_telefono" name="frm_telefono">
                    </div> 
                </td>
                <td  align="left" class="table_title_cells">Lada Oficina:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="3" id="frm_lada_oficina" name="frm_lada_oficina">
                    </div> 
                </td>
            </tr>
            <tr>
                <td  align="left" class="table_title_cells">Teléfono Oficina:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="10" id="frm_telefono_oficina" name="frm_telefono_oficina">
                    </div> 
                </td>
                <td  align="left" class="table_title_cells">Extención Oficina:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="5" id="frm_ext_oficina" name="frm_ext_oficina">
                    </div> 
                </td>
            </tr>
            <tr>
                <td  align="left" class="table_title_cells">Celular:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="10" id="frm_cel" name="frm_cel">
                    </div> 
                </td>
                <td  align="left" class="table_title_cells">Email:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="65" id="frm_email" name="frm_email">
                    </div> 
                </td>
            </tr>
            <tr>
                <td  align="left" class="table_title_cells">Medio de contacto:</td>
                <td>
                    <div class="input text">                            
                        <input type="text" class="tbl_modal" maxlength="30" id="frm_metodo" name="frm_metodo" disabled>
                    </div> 
                </td>
                <td  align="left" class="table_title_cells">Medio de publicidad:</td>
                <td>
                    <div class="input text">                            
                        <input type="text" class="tbl_modal" maxlength="30" id="frm_medio_fls" name="frm_medio_fls" disabled>
                        <input type="hidden" class="tbl_modal" maxlength="30" id="frm_medio" name="frm_medio" disabled>
                    </div> 
                </td>
            </tr>
            <tr>
                <td  align="left" class="table_title_cells">Usuario ID:</td>
                <td>
                    <div class="input text">
                        <input type="text" class="tbl_modal" maxlength="10" id="frm_user_id" name="frm_user_id">
                    </div> 
                </td>
                 <td class="table_title_cells"></td>
                <td>
                    <input type="button" id="savefrmmodal" name="savefrmmodal" value="Guardar" style="border:0px;color:white;background:#0098AA;padding:5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;font-weight:bold;cursor:pointer;margin-right:5px;">
                </td>
            </tr>
        </tbody>
    </table></form><br>
    <div id="msj_error" style="color:#C11A17;font-size:12px;font-weight:bold;display:none;"></div>
    <a class="close-reveal-modal">&#215;</a>
</div>