<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program;

use Zf\Helper\Registry;

/**
 * 简化操作类
 *
 * Class Sim
 * @package Program
 */
class Sim
{
    /**
     * 登录用户 key
     */
    const REGISTRY_LOGIN_USER = 'program.user';

    /**
     * @return \Program\Models\Dao\DaoUser|null
     */
    public static function user()
    {
        return Registry::get(static::REGISTRY_LOGIN_USER);
    }
}