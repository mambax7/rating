<?php

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
class UserHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase|null $db {@link XoopsDatabase}
     */
    public function __construct(\XoopsDatabase $db = null)
    {
        parent::__construct($db, 'rating_user', User::class, 'id', '');
    }

    /**
     * @param $asObject
     * @return array
     */
    public function getRatingUser($asObject = true)
    {
        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('ASC');

        return parent::getAll($criteria, false, $asObject);
    }

    /**
     * @param $Id
     * @param $pageId
     * @return int
     */
    public function getCountRating($Id, $pageId)
    {
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('rating_id', $Id, '='));
        $criteria->add(new \Criteria('item_id', $pageId, '='));

        return parent::getCount($criteria);
    }

    /**
     * @param $id
     * @param $pageId
     * @return mixed
     */
    public function getAverage($id, $pageId)
    {
        $sql    = 'SELECT ROUND(AVG(rate),1) FROM ' . $this->db->prefix('rating_user');
        $sql    .= ' WHERE item_id = ' . (int)$pageId;
        $sql    .= ' AND rating_id = ' . (int)$id;
        $result = $this->db->query($sql);
        [$average] = $this->db->fetchRow($result);

        return $average;
    }

    /**
     * @param $id
     * @param $pageId
     * @return int
     */
    public function getHasVoted($id, $pageId)
    {
        global $xoopsUser;

        if (null != $xoopsUser) {
            $uid    = $xoopsUser->uid();
            $helper = Helper::getInstance();
            //        $uid    = $helper->getUserId();
            //        $ip     = $helper->xoops()->getenv('REMOTE_ADDR');
            $ip = '1:1';

            $criteria = new \CriteriaCompo();
            $criteria->add(new \Criteria('uid', $uid), 'OR');
            $criteria->add(new \Criteria('ip', $ip), 'OR');
            $criteria->add(new \Criteria('item_id', $pageId), 'AND');
            $criteria->add(new \Criteria('rating_id', $id), 'AND');
        }
        return parent::getCount($criteria);
    }
}
