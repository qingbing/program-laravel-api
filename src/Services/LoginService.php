<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Services;


use Program\Models\Dao\DaoUser;
use Zf\Helper\Abstracts\Singleton;
use Zf\Helper\Exceptions\BusinessException;

/**
 * Class LoginService
 * @package Program\Services
 */
class LoginService extends Singleton
{
    /**
     * 用户登录
     *
     * @param $params
     * @return array
     *
     * @throws BusinessException
     */
    public function index($params)
    {
        $user = DaoUser::getByUsername($params['username']);
        if (null === $user) {
            throw new BusinessException("不存在的用户", 110001001);
        }
        if (0 == $user->is_enable) {
            throw new BusinessException("用户不可用", 110001002);
        }
        if (!$user->isPassword($params['password'])) {
            throw new BusinessException("密码无效", 110001003);
        }
        return UserService::getInstance()->generateToken($user->uid);
    }

    /**
     * 用户退出登录，销毁 session
     * @return bool
     */
    public function logout()
    {
        session()->flush();
        return true;
    }
}