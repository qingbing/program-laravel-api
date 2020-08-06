<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Components;


use Program\Sim;

/**
 * 程序员模块服务基类
 *
 * Class Service
 * @package Program\Components
 */
class Service extends \Common\Components\Service
{
    /**
     * 构造函数后执行
     */
    protected function init()
    {
        // 保存数据表
        $this->logTable = 'program_operate_log';
        // 登录用户信息
        $user = Sim::user();
        if ($user) {
            $this->logUsername = Sim::user()->username;
            $this->logUid      = Sim::user()->uid;
        }
    }
}