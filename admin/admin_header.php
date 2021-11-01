<?php
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

use Xmf\Module\Admin;
use XoopsModules\Rating\{
    Helper,
    Utility
};

require dirname(__DIR__) . '/preloads/autoloader.php';

require dirname(__DIR__, 3) . '/include/cp_header.php';
require_once $GLOBALS['xoops']->path('www/class/xoopsformloader.php');

global $xoTheme;

$moduleDirName = \basename(\dirname(__DIR__));

/** @var \XoopsModules\Rating\Helper $helper */
$helper = Helper::getInstance();
$utility     = new Utility();
$adminObject = \Xmf\Module\Admin::getInstance();

$pathIcon16 = Admin::iconUrl('', '16');
$pathIcon32 = Admin::iconUrl('', '32');
//$pathModIcon32 = $helper->getModule()->getInfo('modicons32');

$myts = \MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof \XoopsTpl)) {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new \XoopsTpl();
}

//Handlers
//$XXXHandler = $helper->getHandler('XXX', $moduleDirName);

// Load language files
xoops_loadLanguage('admin', $moduleDirName);
xoops_loadLanguage('modinfo', $moduleDirName);
xoops_loadLanguage('main', $moduleDirName);
