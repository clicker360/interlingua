<?php 
    echo $this->Html->script('jquery-validate/jquery.validate', false);
    echo $this->Html->script('utils/dynamic_combos', false);
    echo $this->Html->script('prospects/edit', false);
    //debug($this->data);
?>
<h2>Editar Prospecto:</h2>

<?php echo $form->create('Prospect',array('id'=>'edit_prospect_form','action'=>'store_prospect')); ?>

    <?php echo $form->input('Prospect.id', array('type'=>'hidden'));?>
    <?php
        echo $this->Html->script('prospects/view_prospect_details');
        /*if($this->data['Prospect']['test'] == 1){
            foreach($this->data['Test'] as $k => $p){
                if(!in_array($k,array('id','prospect_id')))
                        $test[] =array('label'=>  str_replace('_', ' ', $k),'model'=>'Test','keys'=>$k,'editable'=>false,'options'=>array('type'=>'text', 'label'=>false));
            }
        }else
            $test = array();*/
        $fields =array(
            array('label'=>'Nombre','model'=>'Prospect','keys'=>'name','editable'=>true,'options'=>array('type'=>'text', 'label'=>false)),
            array('label'=>'Correo electrónico','model'=>'Prospect','keys'=>'email','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Lada','model'=>'Prospect','keys'=>'lada','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Teléfono','model'=>'Prospect','keys'=>'phone_number','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Celular','model'=>'Prospect','keys'=>'mobile_number','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Estado','model'=>'Prospect','keys'=>'estado','editable'=>true, 'options'=>array('type'=>'text','label'=>false)),
            array('label'=>'Usuario','model'=>'Prospect','keys'=>'user_id','join'=>'','editable'=>true, 'options'=>array('label'=>false,'options'=>$current_users)),
            array('label'=>'Plantel','model'=>'Prospect','keys'=>'plantel','join'=>'','editable'=>true, 'options'=>array('label'=>false)),
            array('label'=>'Medio de contacto','model'=>'Prospect','keys'=>'medio_contacto','join'=>'','editable'=>true, 'options'=>array('label'=>false)),
            array('label'=>'Medio de publicidad','model'=>'Prospect','keys'=>'medio_publicidad','join'=>'','editable'=>true, 'options'=>array('label'=>false)),
            array('label'=>'Fecha de nacimiento','model'=>'Prospect','keys'=>'fecha_nacimiento','join'=>'','editable'=>true, 'options'=>array('label'=>false)),
            array('label'=>'Fecha de cita','model'=>'Prospect','keys'=>'fecha_cita','join'=>'','editable'=>true, 'options'=>array('label'=>false,'type'=>'text')),
            array('label'=>'Clave AS400','model'=>'Prospect','keys'=>'clave_as_400','join'=>'','editable'=>true, 'options'=>array('label'=>false)),
            array('label'=>'Fecha Registro','model'=>'Prospect','keys'=>array('created'),'join'=>'','editable'=>false),
            array('label'=>'Fecha de Asignación','model'=>'Prospect','keys'=>array('assignation_date'),'join'=>'','editable'=>false),
            array('label'=>'Fecha de Última Atención','model'=>'Prospect','keys'=>array('Prospect.last_contact_date'),'join'=>'','editable'=>false),
            //array('label'=>'','model'=>'','keys'=>'','join'=>'','editable'=>true, 'options'=> array('label'=>false,'type'=>'hidden')),
        );
        //$fields = array_merge($fields,$test);
    ?>
    <table class="prospect_details_table">
            <?php echo $this->Crm->columnedFields($this->data,$fields)?>
    </table>
<?php 
echo $form->input('Prospect.origin_id',array('type'=>'hidden','value'=>$this->data['Origin']['id'], 'class'=>'required'));
echo $form->end('Guardar'); ?>
<?php echo $html->link('Lista Prospectos',array('controller' => 'prospects', 'action' => 'index'));?>