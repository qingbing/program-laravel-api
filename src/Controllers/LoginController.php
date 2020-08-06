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
use Program\Services\LoginService;

/**
 * 用户登录路由
 *
 * Class LoginController
 * @package Program\Controllers
 */
class LoginController extends Controller
{
    /**
     * POST
     * 用户登录
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Zf\Helper\Exceptions\BusinessException
     * @throws \Zf\Helper\Exceptions\Exception
     */
    public function actionIndex(Request $request)
    {
        $params = ValidatorHelper::getInstance()
            ->addRule('username|用户名', ['required', 'email'])
            ->addRule('password|密码', ['required', 'alpha_dash', 'between:6,30'])
            ->make($request->post());
        $res    = LoginService::getInstance()->index($params);
        return ResHelper::success($res, '登录成功');
    }

    /**
     * POST
     * 用户退出登录
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function actionLogout()
    {
        $res = LoginService::getInstance()->logout();
        return ResHelper::success($res, '退出成功');
    }
}
