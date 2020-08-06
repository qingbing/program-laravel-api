<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Controllers;


use Common\Models\Dto\DtoPlatform;
use Helper\ResHelper;
use Helper\ValidatorHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Program\Components\Controller;
use Program\Services\PlatformService;
use Zf\Helper\Traits\Models\TLabelEnable;

/**
 * 平台管理
 *
 * Class PlatformController
 * @package Program\Controllers
 */
class PlatformController extends Controller
{
    /**
     * 平台列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Zf\Helper\Exceptions\Exception
     */
    public function actionIndex(Request $request)
    {
        // 参数检查
        $params = ValidatorHelper::getInstance()
            ->addRule('pageNo|页面|1', ['int'])
            ->addRule('pageSize|显示条数|10', ['int'])
            ->addRule('key|平台代码', ['string'])
            ->addRule('id|平台', ['int'])
            ->addRule('is_enable|状态', ['int', 'in:-1,' . implode(',', array_keys(TLabelEnable::enableLabels()))])
            ->make($request->all());
        // 数据处理
        $res = PlatformService::getInstance()->list($params);
        // 数据渲染
        return ResHelper::success($res);
    }

    /**
     * 根据名称模糊搜索
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Zf\Helper\Exceptions\Exception
     */
    public function actionSearchByName(Request $request)
    {
        // 参数检查
        $params = $this->validKeyword($request);
        // 数据处理
        $res = PlatformService::getInstance()->searchByName($params);
        // 数据渲染
        return ResHelper::success($res);
    }

    /**
     * 添加平台
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     * @throws \Zf\Helper\Exceptions\Exception
     */
    public function actionCreate(Request $request)
    {
        // 参数检查
        $params = ValidatorHelper::getInstance()
            ->addRule('key|平台代码', [
                'required',
                Rule::unique(DtoPlatform::tableName(), 'key')
            ])
            ->addRule('name|平台名称', [
                'required',
                Rule::unique(DtoPlatform::tableName(), 'name')
            ])
            ->addRule('description|平台描述', ['required'])
            ->addRule('is_enable|状态', ['required', 'int', 'in:' . implode(',', array_keys(TLabelEnable::enableLabels()))])
            ->addRule('sort_order|排序', ['int', 'min:0'])
            ->make($request->post());
        // 数据处理
        $res = PlatformService::getInstance()->create($params);
        // 数据渲染
        return ResHelper::success($res);
    }

    /**
     * 修改平台
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     * @throws \Zf\Helper\Exceptions\BusinessException
     * @throws \Zf\Helper\Exceptions\Exception
     */
    public function actionEdit(Request $request)
    {
        // 参数检查
        $params = ValidatorHelper::getInstance()
            ->addRule('id|平台ID', ['required', 'int', 'min:1'])
            ->addRule('name|平台名称', [
                'required',
                Rule::unique(DtoPlatform::tableName(), 'name')->ignore($request->get('id'), 'id')
            ])
            ->addRule('description|平台描述', ['required'])
            ->addRule('is_enable|状态', ['required', 'int', 'in:' . implode(',', array_keys(TLabelEnable::enableLabels()))])
            ->addRule('sort_order|排序', ['int', 'min:0'])
            ->make($request->post());
        // 数据处理
        $res = PlatformService::getInstance()->edit($params);
        // 数据渲染
        return ResHelper::success($res);
    }

    /**
     * 切换平台启用状态
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     * @throws \Zf\Helper\Exceptions\BusinessException
     * @throws \Zf\Helper\Exceptions\Exception
     */
    public function actionChangeEnable(Request $request)
    {
        // 参数检查
        $params = ValidatorHelper::getInstance()
            ->addRule('id|平台ID', ['required', 'int', 'min:1'])
            ->make($request->post());
        // 数据处理
        $res = PlatformService::getInstance()->changeEnable($params);
        // 数据渲染
        return ResHelper::success($res);
    }

    /**
     * 获取平台信息
     *
     * @throws \Throwable
     * @throws \Zf\Helper\Exceptions\BusinessException
     * @throws \Zf\Helper\Exceptions\Exception
     */
    public function actionView(Request $request)
    {
        // 参数检查
        $params = ValidatorHelper::getInstance()
            ->addRule('id|平台ID', ['required', 'int', 'min:1'])
            ->make($request->post());
        // 数据处理
        $res = PlatformService::getInstance()->view($params);
        // 数据渲染
        return ResHelper::success($res);
    }
}