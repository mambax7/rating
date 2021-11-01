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

use Xoops\Core\Database\Connection;

/**
 *
 */
class ModulesHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase|null $db {@link XoopsDatabase}
     */
    public function __construct(\XoopsDatabase $db = null)
    {
        parent::__construct($db, 'rating_modules', Modules::class, 'id', '');
    }

    /**
     * @param $start
     * @param $limit
     * @param $asObject
     * @return array
     */
    public function getRatingModules($start = 0, $limit = 0, $asObject = true)
    {
        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('ASC');
        $criteria->setStart($start);
        $criteria->setLimit($limit);

        return $this->getAll($criteria, false, $asObject);
    }

    /**
     * @param $pageId
     * @param $pageName
     * @param $moduleId
     * @return array
     */
    public function getRatingDisplay($pageId, $pageName, $moduleId)
    {
        $helper = Helper::getInstance();

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('ASC');
        $criteria->add(new \Criteria('display', 1));
        $criteria->add(new \Criteria('status', 1));
        $criteria->add(new \Criteria('mid', $moduleId, '='));
        $criteria->add(new \Criteria('page', $pageName, '='));
        $modulesCount = $this->getCount($criteria, true);
        if ($modulesCount > 0) {
            $modulesArray = $this->getObjects($criteria, true);
            $ret          = [];
            $userHandler  = $helper->getHandler('User');
            foreach (\array_keys($modulesArray) as $i) {
                $ret[$i]['id']             = $modulesArray[$i]->getVar('id');
                $ret[$i]['title']          = $modulesArray[$i]->getVar('title');
                $ret[$i]['stars']          = $modulesArray[$i]->getVar('stars');
                $ret[$i]['total_rating']   = $userHandler->getCountRating($modulesArray[$i]->getVar('id'), $pageId);
                $average_rating            = $userHandler->getAverage($modulesArray[$i]->getVar('id'), $pageId);
                $ret[$i]['average_rating'] = ($average_rating > 0) ? $average_rating : 0;
                $ret[$i]['hasVoted']       = ($userHandler->getHasVoted($modulesArray[$i]->getVar('id'), $pageId) > 0) ? 'true' : 'false';
                $ret[$i]['pageId']         = $pageId;
            }
        }

        //var_dump($ret);
        return $ret;
    }
}
