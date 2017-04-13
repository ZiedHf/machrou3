<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('Name_app', 'Machrou3');
define('Version', '0.9');
define('DOSSIER_RACINE', 'machrou3');
//Project Files
define('PROJECTS_UPLOAD', WWW_ROOT.'uploads'.DS.'projects');
//Taems Files
define('TEAMS_UPLOAD', WWW_ROOT . 'uploads' . DS . 'teams');
//Users Files
define('USERS_UPLOAD', WWW_ROOT . 'uploads' . DS . 'users');
define('USERS_UPLOAD_IMAGES', WWW_ROOT . 'uploads' . DS . 'users' . DS . 'images');
//Clients Files
define('CLIENTS_UPLOAD', WWW_ROOT . 'uploads' . DS . 'clients');
//Key
define('KEY', 'wt1AZEqsd5SDF54fsdERd7sdf546aze4HA');

define ("ACCESSLEVEL", serialize (array (0 => "NoAccess", 1 => "ReadOnly", 2 => "Member No Access", 3 => "Member", 4 => "Editor And Member", 5 => "Manager")));
define ("ACCESSLEVEL_CUSTOMIZE", serialize (array (0 => "NoAccess", 1 => "ReadOnly", 5 => "Manager")));
define ("ACCESSLEVEL_LOW", serialize (array (0 => "NoAccess", 1 => "ReadOnly")));
define ("ACCESSLEVEL_HIGH", serialize (array (2 => "Member No Access", 3 => "Member", 4 => "Editor And Member", 5 => "Manager")));


