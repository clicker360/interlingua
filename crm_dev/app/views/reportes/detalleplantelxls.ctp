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