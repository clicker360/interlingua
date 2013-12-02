<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <title><?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->charset('utf-8');
        echo $this->Html->meta('icon');
        echo $this->Html->css(array('style','core','calendario_ui/jquery-ui.calendario.css','reveal/reveal.css'));
        echo $this->Crm->js();
        echo $this->Html->script(array('jquery/lib/jquery-1.4.3.min.js','jquery/ui/js/jquery-ui-1.8.5.custom.min.js','jquery/lib/jMonthCalendar.js','reveal/jquery.reveal.js'));
        echo $scripts_for_layout;
        ?>
    </head>
    <body>
        <div id="header">
        </div>
         <?php if(in_array($this->params['controller'],array('prospects','events'))){ ?>
            <div class="alarma">
                <h2>
                 <?php if($openEvents == array()){ ?>
                    No tienes eventos pendientes</h2>
                 <?php }else{ ?>
                    Tienes <?php echo count($openEvents); ?> eventos pendientes</h2>

                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Evento</th>
                            <th>Prospecto</th>
                            <th>Atender</th>
                        </tr>
                        <?php foreach($openEvents as $k => $e){ ?>
                        <tr>
                            <td><?php echo $e['Event']['id']; ?></td>
                            <td><?php echo $e['Event']['subject']; ?></td>
                            <td><?php echo $e['Prospect']['name']; ?></td>
                            <td><?php echo $this->Html->link('Atender',$this->Html->url('/atender-evento/'.$e['Event']['id'],true)); ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                 <?php } ?>
            </div>
        <?php } ?>
        
       
        <?php echo $this->element('menus'); ?>
        <div id="bienvenida" class="bienvenida">
            <div>Bienvenido <?php echo $this->Session->read('Auth.User.name') ?> <?php echo Date('Y M d H:i');?> </div>
        </div>
        <?php
            if ($session->check('Message.flash')) {
                echo '<div id="flashMessage" class="message">' . $session->flash() . '</div>';
            }
        ?>
        <div id="content">
            <?php echo $content_for_layout; ?>
        </div>
        <div id="footer"></div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>