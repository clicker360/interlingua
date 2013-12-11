<?php 
    $lugar_id = $this->data['lugar'];
    $lugar_id = explode("|", $lugar_id);
    //print_r($this->data);
    //echo "<br>";
    //print_r($usuarios);
?>

<table border="1" cellspacing="0" cellpadding="2px">
    <!--usuarios-->
    <tr>
        <h2>Lugar : <?php echo $lugar_id[1]?></h2>
    </tr>
    <tr>
        <td colspan="2"><?php echo $titulo ?></td>
        <?php 
            if($lugar_id[0] == "true"){
                foreach ($usuarios as $usuario) {
                    echo '<td>' . $usuario['User']['name'] . '</td>';
                }  
            }else{
                foreach ($usuarios as $usuario) {
                    if ($usuario['User']['place_id']==$lugar_id[0]) {
                        echo '<td>' . $usuario['User']['name'] . '</td>';
                    }
                }
            }
            
        ?>
        <td>Total</td>
    </tr>
    <?php
        $first = 1;
        
        $nameCategorie = '';
        $lasStatus = '';
        $antCat = '';
        $l = 0;
        $m = 0;

        //Total por Categoría Status.
        $totalPC = array();
        //Total Por Categoría Status y todos los Prospectos
        $totalPCP = 0;

        foreach ($status as $s) {
            if($nameCategorie != $s['Statuses']['status_category_id'] && $l != 0){
                $cntCategories[$antCat] = $l;
                $nameCategorie = $s['Statuses']['status_category_id'];
                $antCat = $s['Statuses']['status_category_id'];
                $l = 1;
                /**/
                echo '<tr>';
                echo '<td><b>Total</b></td>';
                if($lugar_id[0] == "true"){
                    foreach ($usuarios as $usuario) {
                        echo '<td><b>' . $totalPC[$usuario['User']['id']] . '</b></td>';
                        $totalPCP = $totalPCP + $totalPC[$usuario['User']['id']];
                        $totalPC[$usuario['User']['id']] = 0;
                    }
                }else{
                    foreach ($usuarios as $usuario) {
                        if ($usuario['User']['place_id']==$lugar_id[0]) {
                            echo '<td><b>' . $totalPC[$usuario['User']['id']] . '</b></td>';
                            $totalPCP = $totalPCP + $totalPC[$usuario['User']['id']];
                            $totalPC[$usuario['User']['id']] = 0;
                        }
                    }
                }
                echo '<td><b>' . $totalPCP . '</b></td>';
                $totalPCP = 0;
                $m = $m + 1;
                echo '</tr>';
                /**/
                $lasStatus = $s['Statuses']['id'];
            }else{
                if($l==0) $nameCategorie = $s['Statuses']['status_category_id'];
                $l += 1;
            }
            for ($k = 0; $k < count($s['Statuses']['status_category_id']); $k++) {
                echo '<tr>';
                if ($first == 1 ) {
                    echo '<td rowspan="' . ($cntCategories[$s['Statuses']['status_category_id']]+1) . '">' . $arrCategories[$s['Statuses']['status_category_id']] . '</td>';
                    $first = $cntCategories[$s['Statuses']['status_category_id']];
                } else {
                    $first = $first - 1;
                }
                echo '<td>' . $s['Statuses']['name'] . '</td>';
                if($lugar_id[0] == "true"){                    
                    foreach ($usuarios as $usuario) {
                        echo '<td>' . $datos[$usuario['User']['id']][$s['Statuses']['id']][$k] . '</td>';
                        if(!isset($totalPC[$usuario['User']['id']])) $totalPC[$usuario['User']['id']] = 0;
                        $totalPC[$usuario['User']['id']] = $totalPC[$usuario['User']['id']] + $datos[$usuario['User']['id']][$s['Statuses']['id']][$k];
                    }
                }else{
                    foreach ($usuarios as $usuario) {
                        if ($usuario['User']['place_id']==$lugar_id[0]) {
                            echo '<td>' . $datos[$usuario['User']['id']][$s['Statuses']['id']][$k] . '</td>';
                            if(!isset($totalPC[$usuario['User']['id']])) $totalPC[$usuario['User']['id']] = 0;
                            $totalPC[$usuario['User']['id']] = $totalPC[$usuario['User']['id']] + $datos[$usuario['User']['id']][$s['Statuses']['id']][$k];
                        }
                    }
                }
                echo '<td>' . $totalps[$s['Statuses']['id']] . '</td>';
                echo '</tr>';
            }
        }
        echo '<tr>';
        echo '<td><b>Total</b></td>';
        if($lugar_id[0] == "true"){                    
            foreach ($usuarios as $usuario) {
                echo '<td><b>' . $totalPC[$usuario['User']['id']] . '</b></td>';
                $totalPCP = $totalPCP + $totalPC[$usuario['User']['id']];
                $totalPC[$usuario['User']['id']] = 0;
            }
        }else{
            foreach ($usuarios as $usuario) {
                if ($usuario['User']['place_id']==$lugar_id[0]) {
                    echo '<td><b>' . $totalPC[$usuario['User']['id']] . '</b></td>';
                    $totalPCP = $totalPCP + $totalPC[$usuario['User']['id']];
                    $totalPC[$usuario['User']['id']] = 0;
                }
            }
        }
        echo '<td><b>' . $totalPCP . '</b></td>';
        $totalPCP = 0;
        echo '</tr>';
    ?>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <form method="post" action="<?php echo $html->url('/reportes/detalleplantelxls/'); ?>">
        <tr><td align="center">
                
                <?php echo $form->input('lugar', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $lugar_id[0]."|".$lugar_id[1])); ?>

                <?php echo $form->input('Reporte.tipo_fecha', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $data['Reporte']['tipo_fecha'])); ?>
                <?php echo $form->input('Reporte.tipo', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $data['Reporte']['tipo'])); ?>
                <?php echo $form->input('Reporte.fecha_inicial', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $data['Reporte']['fecha_inicial'])); ?>
                <?php echo $form->input('Reporte.fecha_unica', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $data['Reporte']['fecha_unica'])); ?>
                <?php echo $form->input('Reporte.fecha_final', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $data['Reporte']['fecha_final'])); ?>
                <?php echo $form->submit('Exportar a Excel', array('class' => 'button')); ?>
            </td></tr>
    </form>
</table>

