<?php

declare(strict_types=1);
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * rating module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (https://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         rating
 * @since           2.6.0
 * @author          Cointin Maxime (AKA Kraven30)
 */
require_once __DIR__ . '/preloads/autoloader.php';

$moduleDirName = basename(__DIR__);

$modversion                        = [];
$modversion['version']             = '0.3.0';
$modversion['module_status']       = 'Alpha 1';
$modversion['release_date']        = '2021/10/31';
$modversion['name']                = _MI_RATING_NAME;
$modversion['description']         = _MI_RATING_DSC;
$modversion['author']              = 'Kraven30';
$modversion['nickname']            = 'Cointin Maxime';
$modversion['credits']             = 'The XOOPS Project';
$modversion['license']             = 'GNU GPL 2.0';
$modversion['license_url']         = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['official']            = 0;
$modversion['help']                = 'page=help';
$modversion['image']               = 'assets/images/logo.png';
$modversion['dirname']             = $moduleDirName;
$modversion['modicons16']          = 'assets/images/icons/16';
$modversion['modicons32']          = 'assets/images/icons/32';
$modversion['module_website_url']  = 'https://xoops.org/';
$modversion['module_website_name'] = 'XOOPS';
$modversion['min_php']             = '7.2';
$modversion['min_xoops']           = '2.5.10';
$modversion['min_admin']           = '1.2';
$modversion['min_db']              = ['mysql' => '5.5'];
// paypal
$modversion['paypal']                  = [];
$modversion['paypal']['business']      = 'cointin.maxime@gmail.com';
$modversion['paypal']['item_name']     = '';
$modversion['paypal']['amount']        = 0;
$modversion['paypal']['currency_code'] = 'EUR';
// Admin things
$modversion['hasAdmin']    = 1;
$modversion['system_menu'] = 1;
$modversion['adminindex']  = 'admin/index.php';
$modversion['adminmenu']   = 'admin/menu.php';
//Menus
$modversion['hasMain'] = 1;
// Mysql file
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = [
    $moduleDirName . '_' . 'modules',
    $moduleDirName . '_' . 'user',
];

// ------------------- Help files ------------------- //
$modversion['helpsection'] = [
    ['name' => _MI_RATING_OVERVIEW, 'link' => 'page=help'],
    ['name' => _MI_RATING_DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => _MI_RATING_LICENSE, 'link' => 'page=license'],
    ['name' => _MI_RATING_SUPPORT, 'link' => 'page=support'],
];

// ------------------- Templates ------------------- //
$modversion['templates'] = [
    ['file' => 'rating.tpl', 'description' => ''],
    ['file' => 'admin/rating.tpl', 'description' => ''],
];

// JQuery
$modversion['jquery'] = 1;

// Preferences
$modversion['config'][] = [
    'name'        => 'rating_pager',
    'title'       => '_MI_RATING_PAGER',
    'description' => '_MI_RATING_PAGERDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 20,
];
