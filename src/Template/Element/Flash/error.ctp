<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!--div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 alert alert-danger margintop2px" onclick="this.classList.add('hidden');" role="alert"-->
<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 alert alert-danger margintop2px" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <i class="fa fa-info-circle" aria-hidden="true"></i>
    <span class="sr-only"><?=__('Success');?> :</span>
    <?= $message ?>
</div>