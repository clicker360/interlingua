<?php class CrmHelper extends AppHelper {
    var $helpers = array('Html','Session','Form','Js');
    var $place_alias=array('alias'=>'distribuidor','label'=>'Distribuidor','lowercase'=>'distribuidor');

    function displayHeaders($fields){
        foreach($fields as $field){
            if(isset($field['parametros']) && $field['parametros'] != '') {
                echo $this->Html->tag('th', $this->Form->submit($field['label'], array('div' => false, 'id' => $field['id'], 'onclick'=>'passParams(this);', 'param_1'=>$field['parametros'][0], 'param_2'=>$field['parametros'][1], 'class'=>'assigned_header' )));
            } else {
                echo $this->Html->tag('th',$field['label']);
            }

        }
    }

    function displayFields($data,$fields){
        foreach($fields as $field){
            $values=array();
            foreach($field['keys'] as $key){
                //Se concatenan los valores y se separan con un espacio
                if(strpos($key,'.')) {
                    $values[]=Set::classicExtract($data, $key) . ' ';
                } else {
                    $values[]=(isset($field['model'])) ? $data[$field['model']][$key] . ' ' : '';
                }
            }
            echo $this->Html->tag('td',implode($field['join'],$values));
        }
    }

    function columnedFields($data=array(),$fields=array(),$columns=2){
        $num=1;
        $total=count($fields);
        $result="";
        $partialResult="";
        foreach($fields as $i => $field){
            $partialResult.=$this->Html->tag('td',$field['label'],array('class'=>'table_title_cells'));
            $partialResult.=$this->Html->tag('td',$this->getValue($data,$field));
            if($num==$total) {
                for($i=0;$i<$total%$columns;$i++){
                    $partialResult.=$this->Html->tag('td','').$this->Html->tag('td','');
                }
                $num=$columns;
            }
            if($num%($columns)==0 && $num !=0){
                $result.=$this->Html->tag('tr',$partialResult);
                $partialResult="";
            }
            $num++;
        }
        return $result;
    }

    function getValue($data,$field){
        $result="";
        if($field['editable']){
            if(is_array($field['keys'])){
                $i = 0;
                foreach($field['keys'] as $key){
                    $separatorIndex=strpos($key,'.');
                    if($separatorIndex){
                        $model=substr($key,0,$separatorIndex);
                        $key=substr($key,$separatorIndex+1,strlen($key)-$separatorIndex);
                    }
                    else{
                        $model=$field['model'];
                    }
                    //Si no existe 'Data' se agregan los campos sin información.
                    if(isset($data[$model][$key])){
                        $field['options']['value'] = $data[$model][$key];
                    } else {
                        $field['options']['value'] = '';
                    }
                    if(isset($field['options']['id_array'])){
                        $field['options']['id'] = $field['options']['id_array'][$i];
                        $result.=$this->Form->input($model.'.'.$key, $field['options']);
                    } else {
                        $result.=$this->Form->input($model.'.'.$key, $field['options']);
                    }
                    $i = $i + 1;
                }
            } else{
                //Si no existe 'Data' se agregan los campos sin información.
                if(isset($data[$field['model']][$field['keys']])){
                    $field['options']['value'] = $data[$field['model']][$field['keys']];
                } else {
                    $field['options']['value'] = '';
                }
                $result.=$this->Form->input($field['model'].'.'.$field['keys'],$field['options']);
            }
        } else {
            if(is_array($field['keys'])){
                foreach($field['keys'] as $key){
                    $separatorIndex=strpos($key,'.');
                    if($separatorIndex){
                        $model=substr($key,0,$separatorIndex);
                        $key=substr($key,$separatorIndex+1,(strlen($key)-$separatorIndex));
                    } else {
                        $model=$field['model'];
                    }
                    $result.=$data[$model][$key] . ' ';
                }
            } else {
                $result.=$data[$field['model']][$field['keys']];
            }
        }
        return $result;
    }

    public function js() {
        $crm = array();
        $crm['basePath'] = Router::url('/');
        $crm['params'] = array(
            'controller' => $this->params['controller'],
            'action' => $this->params['action'],
            'named' => $this->params['named'],
        );
        $crm['user']=$this->Session->read('Auth.User');
        return $this->Html->scriptBlock('var Crm = ' . $this->Js->object($crm) . ';');
    }

}
?>