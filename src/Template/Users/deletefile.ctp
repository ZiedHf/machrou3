<?php if($msg === 'deleted'){ ?>
    <div class="alert alert-warning">
        Le fichier <?=$namefile?> a été supprimé.
    </div>
<?php }elseif($msg === 'notdeleted'){ ?>
    <div class="alert alert-warning">
        Le fichier <?=$namefile?> a été supprimé.
    </div>
<?php }elseif($msg === 'notfound'){ ?>
    <div class="alert alert-warning">
        Le fichier <?=$namefile?> n'a été pas trouvé.
    </div>
<?php } ?>

