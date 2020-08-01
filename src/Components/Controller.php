<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Components;

use Program\Models\Dao\DaoUser;
use Program\Services\UserService;
use Zf\Helper\Registry;

/**
 * program 模块控制器基类
 *
 * Class Controller
 * @package Program\Components
 */
class Controller extends \Helper\Components\Controller
{
    /**
     * @var DaoUser
     */
    protected $user;

    /**
     * 在操作前执行
     *
     * @param string|null $action
     * @return bool
     */
    protected function beforeAction(string $action = null)
    {
        $this->user = Registry::get(UserService::REGISTRY_KEY);
        return true;
    }
}
