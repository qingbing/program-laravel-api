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
 * 系统级别类
 *
 * Class SystemController
 * @package Program\Controllers
 */
class SystemController extends Controller
{
    /**
     * @todo
     * POST
     * 清理系统相关缓存
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function actionClearCache()
    {
        return Response::success();
    }
}