<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Controllers;


use Helper\Response;
use Program\Components\Controller;
use Program\Services\UserService;

class UserController extends Controller
{
    /**
     * GET
     * 登录用户信息
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function actionInfo()
    {
        $userInfo = $this->user->toArray();
        unset($userInfo['password']);
        return Response::success($userInfo);
    }

    /**
     * GET
     * 登录用户信息
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function actionRefreshToken()
    {
        $res = UserService::getInstance()->refreshToken();
        return Response::success($res);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @todo
     * GET
     * 用户权限菜单
     *
     */
    public function actionMenus()
    {
        $res = UserService::getInstance()->menus();
        return Response::success($res);
    }
}