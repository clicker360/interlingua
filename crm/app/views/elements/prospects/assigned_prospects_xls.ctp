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
        array('id'=>'2','label'=>'Celular','model'=>'Prospect','keys'=>array('mobile_number'),'join'=>'','parametros'=>array('0'=>'Prospect.mobile_number','1'=>$url_orden)),
        array('id'=>'2','label'=>'Plantel','model'=>'Prospect','keys'=>array('plantel'),'join'=>'','parametros'=>array('0'=>'Prospect.plantel','1'=>$url_orden)),
        array('id'=>'2','label'=>'Estado','model'=>'Prospect','keys'=>array('estado'),'join'=>'','parametros'=>array('0'=>'Prospect.estado','1'=>$url_orden)),
        array('id'=>'4','label'=>'Usuario','model'=>'User','keys'=>array('name'),'join'=>'','parametros'=>array('0'=>'User.name','1'=>$url_orden)),
        array('id'=>'5','label'=>'Categoría de Status','model'=>'StatusCategory','keys'=>array('name'),'join'=>''),
        array('id'=>'6','label'=>'Status','model'=>'Status','keys'=>array('name'),'join'=>'','parametros'=>array('0'=>'Status.name','1'=>$url_orden)),
        array('id'=>'8','label'=>'Fecha de Registro','model'=>'Prospect','keys'=>array('created'),'join'=>'','parametros'=>array('0'=>'Prospect.created','1'=>$url_orden)),
        array('id'=>'9','label'=>'Fecha de Asignación','model'=>'Prospect','keys'=>array('assignation_date'),'join'=>'','parametros'=>array('0'=>'Prospect.assignation_date','1'=>$url_orden)),
        array('id'=>'10','label'=>'Fecha de Última Atención','model'=>'Prospect','keys'=>array('last_contact_date'),'join'=>'','parametros'=>array('0'=>'Prospect.last_contact_date','1'=>$url_orden)),
    );

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
        <?php foreach($fields as $f){ ?>
            <td><?php echo $f['label']; ?></td>
        <?php }?>
    </tr>

    <?php foreach ($total_assigned_prospects as $assigned_prospect): ?>
    <tr>
        <?php $this->Crm->displayFields($assigned_prospect, $fields); ?>           
    </tr>
    <?php endforeach; ?>
</table>