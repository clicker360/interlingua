<?php 
    //echo $this->element('sql_dump');
?>

<table border="1" cellspacing="0" cellpadding="2px">
    <!--usuarios-->
    <tr>
        <td colspan="2"><?php echo $titulo ?></td>
        <?php foreach ($usuarios as $usuario) {
            echo '<td>' . $usuario['User']['name'] . '</td>';
        } ?>
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

        foreach ($status as $i => $s) {

            if($nameCategorie != $s['Statuses']['status_category_id'] && $l != 0){
                $cntCategories[$antCat] = $l;
                $nameCategorie = $s['Statuses']['status_category_id'];
                $antCat = $s['Statuses']['status_category_id'];
                $l = 1;
                /**/
                echo '<tr>';
                echo '<td><b>Total</b></td>';                
                foreach ($usuarios as $w => $usuario) {
                    echo '<td><b>' . $totalPC[$usuario['User']['id']] . '</b></td>';
                    $arraySum[$usuario['User']['id']][] = $totalPC[$usuario['User']['id']];
                    $totalPCP = $totalPCP + $totalPC[$usuario['User']['id']];
                    $totalPC[$usuario['User']['id']] = 0;
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
                foreach ($usuarios as $usuario) {
                    echo '<td>' . $datos[$usuario['User']['id']][$s['Statuses']['id']][$k] . '</td>';
                    if(!isset($totalPC[$usuario['User']['id']])) $totalPC[$usuario['User']['id']] = 0;
                    $totalPC[$usuario['User']['id']] = $totalPC[$usuario['User']['id']] + $datos[$usuario['User']['id']][$s['Statuses']['id']][$k];
                }
                echo '<td>' . $totalps[$s['Statuses']['id']] . '</td>';
                echo '</tr>';
            }
        }
        echo '<tr>';
        echo '<td><b>Total</b></td>';
        foreach ($usuarios as $usuario) {
            echo '<td><b>' . $totalPC[$usuario['User']['id']] . '</b></td>';
            $arraySum[$usuario['User']['id']][] = $totalPC[$usuario['User']['id']];
            $totalPCP = $totalPCP + $totalPC[$usuario['User']['id']];
            $totalPC[$usuario['User']['id']] = 0;
        }
        echo '<td><b>' . $totalPCP . '</b></td>';
        $totalPCP = 0;
        echo '</tr>';

        //Genera Suma de totales
        echo '<tr>';
        echo '<td></td>';
        echo '<td><strong>Totales</strong></td>';
        $sum = 0;
        $sumTot = 0;
        $arrayPorcentaje = array();
        foreach ($arraySum as $key => $value) {
            foreach ($value as $x => $y) {
                $y = (int)$y;
                $sum = $sum + $y;
            }
            echo "<td><strong>";
            echo $sum;
            echo "</strong></td>";
            $sumTot = $sumTot + $sum;
            $sum = 0;
        }
        echo '<td><b>' . $sumTot . '</b></td>';
        echo '</tr>';

        ksort($arrCategories);
        $cont = 0;
        foreach ($arrCategories as $z => $val) {
            echo '<tr>';
            echo '<td></td>';
            echo '<td><strong>'.$val.'</strong></td>';
            foreach ($arraySum as $key => $value) {
                foreach ($value as $x => $y) {
                    $y = (int)$y;
                    $sum2 = $sum2 + $y;
                }
                $sumTot2 = $sumTot2 + $sum2;
                $sumE = $value[$cont]/$sum2;
                $sumE = $sumE*100;
                $sumE = round($sumE,2);
                echo '<td><strong>'.$sumE.' %</strong></td>';
                $sum2 = 0;
            }
            echo "<br>";
            echo '</tr>';
            $cont++;
        }
    ?>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <form method="post" action="<?php echo $html->url('/reportes/detalleplantelxls/'); ?>">
        <tr><td align="center">
                <?php echo $form->input('Reporte.tipo_fecha', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $data['Reporte']['tipo_fecha'])); ?>
                <?php echo $form->input('Reporte.tipo', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $data['Reporte']['tipo'])); ?>
                <?php echo $form->input('Reporte.fecha_inicial', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $data['Reporte']['fecha_inicial'])); ?>
                <?php echo $form->input('Reporte.fecha_unica', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $data['Reporte']['fecha_unica'])); ?>
                <?php echo $form->input('Reporte.fecha_final', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $data['Reporte']['fecha_final'])); ?>
                <?php echo $form->submit('Exportar a Excel', array('class' => 'button')); ?>
            </td></tr>
    </form>
</table>

