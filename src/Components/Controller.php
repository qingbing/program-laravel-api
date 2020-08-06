<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Components;

use Program\Models\Dao\DaoUser;
use Program\Sim;

/**
 * program 模块控制器基类
 *
 * Class Controller
 * @package Program\Components
 */
class Controller extends \Common\Components\Controller
{
    /**
     * 在操作前执行
     *
     * @param string|null $action
     * @return bool
     */
    protected function beforeAction(string $action = null)
    {
        return true;
    }
}
