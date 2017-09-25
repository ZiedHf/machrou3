<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div id="card-alert" class="card orange lighten-5 z-depth-2">
    <div class="card-content orange-text">
        <p><?= $message ?></p>
    </div>
    <button type="button" class="close orange-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
