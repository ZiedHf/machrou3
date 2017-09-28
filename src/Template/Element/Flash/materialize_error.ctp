<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="card-alert card red lighten-5 z-depth-2">
    <div class="card-content red-text">
        <p><?= $message ?></p>
    </div>
    <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
