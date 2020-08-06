<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Services;


use Program\Components\Service;
use Program\Models\Dao\DaoUser;
use Program\Models\Dto\DtoProgramOperateLog;
use Program\Sim;
use Zf\Helper\Exceptions\BusinessException;

/**
 * Class LoginService
 * @package Program\Services
 */
class LoginService extends Service
{
    /**
     * 构造函数后执行
     */
    protected function init()
    {
        parent::init();
        $this->openLog = true;
        $this->logType = DtoProgramOperateLog::TYPE_LOGIN;
    }

    /**
     * 用户登录
     *
     * @param $params
     * @return array
     * @throws BusinessException
     * @throws \Throwable
     */
    public function index(array $params)
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
        return \DB::transaction(function () use ($user) {
            $this->logUid      = $user->uid;
            $this->logUsername = $user->username;
            $this->logKeyword  = $user->uid;
            $this->logMessage  = '登录';

            $res = UserService::getInstance()->generateToken($user->uid);
            return $this->success($res);
        });
    }

    /**
     * 用户退出登录，销毁 session
     * @return bool
     */
    public function logout()
    {
        // 日志记录
        $user              = Sim::user();
        $this->logUid      = $user->uid;
        $this->logUsername = $user->username;
        $this->logKeyword  = $user->uid;
        $this->logMessage  = '退出登录';
        $this->success();
        // 业务处理
        session()->flush();
        session()->regenerate();
        return session()->token();
    }
}