<?php ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<form method="post" action="<?php echo $action; ?>" id="graciasForm">
    <input type="hidden" value="<?php echo $gracias; ?>" name="gracias" />
</form>
<script type="text/javascript" >
$(document).ready(function(){
    $("#graciasForm").submit();
})
</script>
