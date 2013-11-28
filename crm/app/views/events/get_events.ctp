<?php ?>
<table width="100%" border="0" cellspacing="2" cellpadding="0">
        <tr>
                <td width="200" scope="col" valign="top"><?php echo $calendar->getMonth($pMonth,$pYear,@$pDetail,false,'#','/agenda'); ?></td>
                <td>&nbsp;</td>
                <td width="200" scope="col" valign="top"><?php echo $calendar->getMonth($nMonth,$nYear,@$nDetail,false,'#','/agenda'); ?></td>
        </tr>
        <tr>
                <td scope="col" valign="top" colspan="3" style="height:400px;"><?php echo $calendar->getMonth($month,$year,@$detail,true,'#'); ?></td>
            </tr>
</table>