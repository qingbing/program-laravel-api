<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Controllers;

use Helper\AppHelper;
use Helper\ResHelper;
use Helper\ValidatorHelper;
use Illuminate\Http\Request;
use Program\Components\Controller;
use Zf\Helper\Traits\Models\TLabelDelete;
use Zf\Helper\Traits\Models\TLabelEnable;
use Zf\Helper\Traits\Models\TLabelForbidden;
use Zf\Helper\Traits\Models\TLabelSex;
use Zf\Helper\Traits\Models\TLabelYesNo;

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
        $token = session()->token();
        return ResHelper::success($token);
    }

    /**
     * GET
     * 获取token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Zf\Helper\Exceptions\Exception
     */
    public function actionQiniuToken(Request $request)
    {
        // 参数检查
        $params = ValidatorHelper::getInstance()
            ->addRule('key|文件名', ['string'])
            ->make($request->query());
        if (isset($params['key']) && !empty($params['key'])) {
            $key = $params['key'];
        } else {
            $key = null;
        }
        $token = AppHelper::qiniu()->getUploadToken(null, $key);
        return ResHelper::success($token);
    }

    /**
     * GET
     * 常用标签显示
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Zf\Helper\Exceptions\Exception
     */
    public function actionLabel(Request $request)
    {
        // 参数检查
        $params = ValidatorHelper::getInstance()
            ->addRule('type|标签类型', [
                'required', 'in:' . implode(',', ['delete', 'forbidden', 'enable', 'sex', 'yesNo'])
            ])
            ->make($request->query());
        // 数据处理
        switch ($params['type']) {
            case 'delete';
                $res = TLabelDelete::deleteLabels();
                break;
            case 'forbidden';
                $res = TLabelForbidden::forbiddenLabels();
                break;
            case 'enable';
                $res = TLabelEnable::enableLabels();
                break;
            case 'sex';
                $res = TLabelSex::sexLabels();
                break;
            case 'yesNo';
                $res = TLabelYesNo::yesNoLabels();
                break;
        }
        return ResHelper::success($res);
    }
}
