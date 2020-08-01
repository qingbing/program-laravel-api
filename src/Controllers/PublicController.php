<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Controllers;

use Helper\Response;
use Program\Components\Controller;

/**
 * 通用方法请求，不需要任何权限
 *
 * Class PublicController
 * @package Program\Controllers
 */
class PublicController extends Controller
{
    /**
     * GET
     * 获取token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function actionToken()
    {
        return Response::success(session()->token());
    }
}
