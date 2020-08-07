<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Controllers;


use Helper\ResHelper;
use Helper\ValidatorHelper;
use Illuminate\Http\Request;
use Program\Components\Controller;
use Program\Services\UserService;
use Program\Sim;

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
        $userInfo = Sim::user()->toArray();
        unset($userInfo['password']);
        return ResHelper::success($userInfo);
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
        return ResHelper::success($res);
    }

    /**
     * 保存用户头像
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     * @throws \Zf\Helper\Exceptions\Exception
     */
    public function actionSaveAvatar(Request $request)
    {
        // 参数检查
        $params = ValidatorHelper::getInstance()
            ->addRule('avatar|头像', ['required', 'string'])
            ->make($request->post());
        // 数据处理
        $res = UserService::getInstance()->saveAvatar($params);
        // 数据渲染
        return ResHelper::success($res, '头像保存成功');
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
        return ResHelper::success($res);
    }
}