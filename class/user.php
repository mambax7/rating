<?php

declare(strict_types=1);

namespace XoopsModules\Rating;

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
class User extends \XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('id', \XOBJ_DTYPE_INT, null, false);
        $this->initVar('rating_id', \XOBJ_DTYPE_INT, null, false);
        $this->initVar('item_id', \XOBJ_DTYPE_INT, null, false);
        $this->initVar('uid', \XOBJ_DTYPE_INT, null, false);
        $this->initVar('rate', \XOBJ_DTYPE_INT, null, false);
        $this->initVar('date', \XOBJ_DTYPE_INT, null, false);
        $this->initVar('ip', \XOBJ_DTYPE_TXTAREA, null, false);
    }
}

