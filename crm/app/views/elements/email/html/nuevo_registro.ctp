<?php  ?>

Se ha generado un nuevo registro, los datos son los siguientes:
<br>
<table>
    <tr><td>Nombre: </td><td><?php echo $prospect['Prospect']['name']; ?></td></tr>
    <tr><td>Correo electrónico: </td><td><?php echo $prospect['Prospect']['email']; ?></td></tr>
    <tr><td>Lada: </td><td><?php echo $prospect['Prospect']['lada']; ?></td></tr>
    <tr><td>Telefono: </td><td><?php echo $prospect['Prospect']['phone_number']; ?></td></tr>
    <tr><td>Código postal: </td><td><?php echo $prospect['Prospect']['area_code']; ?></td></tr>
    <tr><td>Servicio: </td><td><?php echo $prospect['Prospect']['servicio']; ?></td></tr>
</table>
