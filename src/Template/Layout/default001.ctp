<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Projects management';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?php /*
    echo $this->Html->css('../js/fullcalendar/lib/cupertino/jquery-ui.min.css');
    echo $this->Html->css('../js/fullcalendar/fullcalendar.css');
    echo $this->Html->css('../js/fullcalendar/fullcalendar.print.css', ['media' => 'print']);
    
    echo $this->Html->script('fullcalendar/lib/moment.min.js');
    echo $this->Html->script('fullcalendar/lib/jquery.min.js');
    echo $this->Html->script('fullcalendar/fullcalendar.min.js');*/
    ?>
    
</head>
<body>
        <?= $this->fetch('content') ?>
        <?= $this->HTML->script('script.js') ?>
        <?= $this->fetch('script'); ?>
</body>
</html>
