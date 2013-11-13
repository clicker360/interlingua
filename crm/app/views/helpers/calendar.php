<?php
class CalendarHelper extends AppHelper
{

    var $months = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    var $daysDesc = array('','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');

    var $helpers = array('Html');

    function getFullYear($year,$detail,$goTo=null,$monthLink=null,$return = false)
    {
        $month="";
        $months="";
        $output = '<table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">';
        for($i=1;$i<13;$i++){
            $month=$this->getMonth($i,$year,$detail,false,$goTo,$monthLink);
            $months.= sprintf($this->Html->tags['tablecell'], " valign=\"top\"", $month);
            if($i%4 == 0)
            {
                $output.= sprintf($this->Html->tags['tablerow'], "", $months);
                $months="";
            }
        }

        $output.= sprintf($this->Html->tags['tablerow'], "", $months);

        $output.='</table>';
        return $this->output($output, $return);
    }

    function getMonth($month,$year,$detail=null,$showDetail = false,$goTo=null,$monthLink=null,$return = false){
        $daysName = array('Dom','Lun','Mar','Mie','Jue','Vie','Sab');
        $semana = "";
        $headers="";
        $rows=0;
        $day=1;
        $date = mktime(0,0,0,$month,1,$year);
        $days = date("t", $date);
        $firstDay = date("w",$date);
        $today = $this->getActualDate();
        $output = '<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="border:solid 1px;height:100%;" class="calendarTable">';
        $displayProperties = ' class="toolBar" colspan="7" style="text-align:center;height:10px;"';
        if(isset($monthLink)){
            $monthLink = $monthLink.'/'.$month.'/'.$year;
            $header=$this->Html->link($this->months[($month-1)]." ".$year,$monthLink);
        }else{
            $header= $this->months[($month-1)]." ".$year;
        }
        $displayMonth = sprintf($this->Html->tags['tablecell'], $displayProperties, $header);
        $output.= sprintf($this->Html->tags['tablerow'], "", $displayMonth);
        $daysLeft=6;

        for($i=0;$i<7;$i++){
            $headers.= sprintf($this->Html->tags['tableheader'], " width=\"14.28%\" style=\"height:10px;\"", $daysName[$i]);
        }
        $output.= sprintf($this->Html->tags['tablerow'], "", $headers);

        for($i=1;$i<=$firstDay;$i++){
            $semana.= sprintf($this->Html->tags['tablecell'], " class='calendarVacio'", "&nbsp;");
        }

        if(!$showDetail){
            for($day = 1; $day <= $days; $day++)
            {
                $resaltado="";
                $renderDate = mktime(0,0,0,$month,$day,$year);
                $location = "";
                if(isset($goTo)){
                    $varEnv= "";
                    $varEnv = $goTo;
                    $varEnv .= (strpos($goTo, '?')) ? "&" : "?";
                    $varEnv	.= 'date='.date('d-m-Y',$renderDate);
                    /*$location=' style="cursor:pointer;" onClick="location.href=\''.$this->Html->url($varEnv).'\'"';*/
                }

                if(!empty($detail)){
                    foreach($detail as $check){
                        $eventDate=strtotime($check['start']);
                        if(date('Ymd',$eventDate)==date('Ymd',$renderDate)){
                            $resaltado="bgcolor='#EEEEEE'";
                        }
                    }
                }

                if( ($day + $firstDay - 1) % 7 == 0 && $day != 1)
                {
                    $output.= sprintf($this->Html->tags['tablerow'], " style=\"height:20px;\"", $semana);
                    $semana="";
                    $rows++;
                    $daysLeft=6;
                }else{
                    $daysLeft--;
                }
                if($today['y']==$year && intval($today['m']) == $month && intval($today['d'])==$day){
                    $semana.= sprintf($this->Html->tags['tablecell'], " style='border:#666666 2px solid;' $resaltado $location valign='top'", $day);
                }else{
                    $semana.= sprintf($this->Html->tags['tablecell'], " $resaltado $location valign='top' class='datosCalendar'", $day);
                }
            }
        }else{
            for($day = 1; $day <= $days; $day++)
            {
                $resaltado="";
                $detalle="";
                $renderDate = mktime(0,0,0,$month,$day,$year);
                if(isset($goTo)){
                    $varEnv= "";
                    $varEnv = $goTo;
                    $varEnv .= (strpos($goTo, '?')) ? "&" : "?";
                    $varEnv	.= 'date='.date('d-m-Y',$renderDate);
                    $dia= $day;
                }
                //$tablaDetalle='<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">';
                $dia = '<div>'.$dia.'</div>';//sprintf($this->Html->tags['tablecell'], " width='10%' valign='top'", $day);
                if(!empty($detail)){
                    foreach($detail as $check){
                        $link = $check['link'];
                        $link .= (strpos($link, '?')) ? "&" : "?";
                        $link .= 'date='.date('d-m-Y',$renderDate);
                        $eventDate=strtotime($check['start']);
                        if(date('Ymd',$eventDate)==date('Ymd',$renderDate)){
                            $detalle.='<div style="background-color:'.$check['background-color'].';margin-top:5px;"> -'.$this->Html->link(date('H:i',strtotime($check['start']))." - ".$check['title'],$link,array('title'=>date('H:i',strtotime($check['start']))." - ".$check['title'], 'class'=>'Tips','style'=>'color:'.$check['color'].';'),false,false)."</div>";
                            //$resaltado="bgcolor='#EEEEEE'";
                        }
                    }
                }
                $dia.= $detalle;
                //$tablaDetalle.= sprintf($this->Html->tags['tablerow'], " ", $dia);
                //$tablaDetalle.='</table>';

                if( ($day + $firstDay - 1) % 7 == 0 && $day != 1)
                {
                    $output.= sprintf($this->Html->tags['tablerow'], " style=\"height:20px;\"", $semana);
                    $semana="";
                    $rows++;
                    $daysLeft=6;
                }else{
                    $daysLeft--;
                }

                if($today['y']==$year && intval($today['m']) == $month && intval($today['d'])==$day){
                    $semana.= sprintf($this->Html->tags['tablecell'], " style='border:#666666 2px solid;' valign='top'", $dia);
                }else{
                    $semana.= sprintf($this->Html->tags['tablecell'], " valign='top' class='datosCalendar'", $dia);
                }
            }
        }


        for($i=0;$i<$daysLeft;$i++){
            $semana.= sprintf($this->Html->tags['tablecell'], " class='calendarVacio'", "&nbsp;");
        }

        $output.= sprintf($this->Html->tags['tablerow'], "  style=\"height:20px;\"", $semana);

        $output.='</table>';

        return $this->output($output, $return);
    }

    function getDay($config, $detail=null, $hourLink=null, $return = false){
        $interval=$config['interval'];
        $startHour=strtotime($config['start']);
        $endHour=strtotime($config['end']);
        $hours="";
        $bgcolor="";
        $i=0;
        $h=0;
        $rows=0;

        $output = '<table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">';
        $fecha=$this->getActualDate();
        $titulo = $this->daysDesc[date('N',$startHour)].', '.date('d',$startHour).' de '.$this->months[date('m',$startHour)-1];
        $header = sprintf($this->Html->tags['tableheader'], " colspan='2'", $titulo);
        $output.= sprintf($this->Html->tags['tablerow'], "", $header);
        /* TODO: ////Arreglar eventos empalmados */
        while($startHour<=$endHour){
            $bgcolor=(($i%2)==0)?" bgcolor='#EFEFEF'":"";
            if(isset($hourLink)){
                $varEnv= "";
                $varEnv = $hourLink;
                $varEnv .= (strpos($hourLink, '?')) ? "&" : "?";
                $varEnv	.= 'startDate='.date('d-m-Y H:i',$startHour);
                $hora=sprintf($this->Html->tags['link'], $this->Html->url($varEnv),"", date('H:i',$startHour));
            }else{
                $hora=date('H:i',$startHour);
            }
            $hours= sprintf($this->Html->tags['tablecell'], " align='center' width='10%' style='renglonDatos'".$bgcolor, $hora);
            if(isset($detail)){
                foreach($detail as $event){
                    if(strtotime($event['start'])>=$startHour && strtotime($event['start'])<($startHour+$interval)){
                        $duration=(strtotime($event['end'])-strtotime($event['start']));
                        $rows=round($duration/$interval);
                        $hours.= sprintf($this->Html->tags['tablecell'], " rowspan='$rows' width='90%' style='renglonDatos' bgcolor='".$event['color']."' valign='top'", $this->Html->link("<strong>".date('H:i',strtotime($event['start']))." - ".$event['title']."</strong>",$event['link'],array('title'=>date('H:i',strtotime($event['start']))." - ".date('H:i',strtotime($event['end']))." ".$event['title']." :: ".$event['description'], 'class'=>'Tips'),false,false));
                    }
                }
            }

            if($rows==0){
                    $hours.= sprintf($this->Html->tags['tablecell'], " width='90%' style='renglonDatos'".$bgcolor, "");
            }else{
                    $rows--;
            }


            $output.= sprintf($this->Html->tags['tablerow'], " ", $hours);
            $startHour+=$interval;
            $i++;
        }
        $output.= '</table>';
        return $this->output($output, $return);
    }

    function getActualDate(){
        $today['d']=date('d');
        $today['m']=date('m');
        $today['y']=date('Y');
        $today['Mes']=$this->months[intval(date('m'))-1];
        //$today['date']=date('Y').date('m').date('d');
        return $today;
    }

    function hourOptionTag($tagName, $value = null, $format24Hours = false, $beginHour='0', $addHours='23', $selected = null, $selectAttr = null, $optionAttr = null, $showEmpty = true) {
        if (empty($selected) && ($this->Html->tagValue($tagName))) {
            if ($format24Hours) {
                $selected = date('H', strtotime($this->Html->tagValue($tagName)));
            } else {
                $selected = date('g', strtotime($this->Html->tagValue($tagName)));
            }
        }
        if ($format24Hours) {
            $hourValue = empty($selected) ? ($showEmpty ? NULL : date('H')) : $selected;
        } else {
            $hourValue = empty($selected) ? ($showEmpty ? NULL : date('g')) : $selected;
            if (isset($selected) && intval($hourValue) == 0 && !$showEmpty) {
                $hourValue = 12;
            }
        }

        if ($format24Hours) {
            $hours = array('00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23');
        } else {
            $hours = array('01' => '1', '02' => '2', '03' => '3', '04' => '4', '05' => '5', '06' => '6', '07' => '7', '08' => '8', '09' => '9', '10' => '10', '11' => '11', '12' => '12');
        }

        $h=0;
        foreach($hours as $key => $value){
            if($h>=$beginHour && $h<=($beginHour+$addHours)){
                $newHours[$key]=$value;
            }
            $h++;
        }

        $option = $this->Html->selectTag($tagName . "_hour", $newHours, $hourValue, $selectAttr, $optionAttr, $showEmpty);
        return $option;
    }

    function minuteOptionTag($tagName, $value = null, $interval = 1, $selected = null, $selectAttr = null, $optionAttr = null, $showEmpty = true) {
        if (empty($selected) && ($this->Html->tagValue($tagName))) {
            $selected = date('i', strtotime($this->Html->tagValue($tagName)));
        }
        $minValue = empty($selected) ? ($showEmpty ? NULL : date('i')) : $selected;

        $mins[sprintf('%02d', 0)] = sprintf('%02d', 0);
        for($minCount = 1; $minCount < 60; $minCount++) {
            if(($minCount%$interval)==0){
                $mins[sprintf('%02d', $minCount)] = sprintf('%02d', $minCount);
            }
        }
        $option = $this->Html->selectTag($tagName . "_min", $mins, $minValue, $selectAttr, $optionAttr, $showEmpty);
        return $option;
    }
}
?>
