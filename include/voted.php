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

use Xmf\Request;

require dirname(__DIR__, 3) . '/mainfile.php';

require dirname(__DIR__) . '/preloads/autoloader.php';

defined('XOOPS_ROOT_PATH') || exit('Restricted access');

global $xoopsUser;

if (Request::hasVar('action', 'POST')) {
    if ('rating' === htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8')) {
        $helper = \XoopsModules\Rating\Helper::getInstance();
        if ($xoopsUser) {
            $obj = $helper->getHandler('User')->create();
            echo $idBox;
            $obj->setVar('rating_id', Request::getInt('idBox', 0, 'REQUEST'));
            $obj->setVar('item_id', Request::getInt('pageId', 0, 'REQUEST'));
            $obj->setVar('uid', $xoopsUser->getVar('uid'));
            $obj->setVar('rate', (float)$_REQUEST['rate']);
            $obj->setVar('date', time());
            //        $obj->setVar('ip', $helper->xoops()->getenv('REMOTE_ADDR'));
            $obj->setVar('ip', '1:1:');

            $success = (true === $helper->getHandler('User')->insert($obj)) ? true : false;
            if ($success) {
                echo $_REQUEST['pageId'];
            } else {
                echo 0;
            }
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
