<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Services;


use Common\Models\Dao\DaoPlatform;
use Helper\DbHelper;
use Program\Components\Service;
use Program\Models\Dto\DtoProgramOperateLog;

/**
 * 平台管理
 *
 * Class PlatformService
 * @package Program\Services
 */
class PlatformService extends Service
{
    /**
     * 构造函数后执行
     */
    protected function init()
    {
        parent::init();
        $this->openLog = true;
        $this->logType = DtoProgramOperateLog::TYPE_PLATFORM;
    }

    /**
     * 列表搜索
     *
     * @param array $params
     * @return array
     */
    public function list($params = [])
    {
        $builder = DaoPlatform::query()
            ->orderBy('sort_order', 'DESC');
        // 代码搜索
        if (isset($params['key']) && !empty($params['key'])) {
            $builder->where('key', '=', $params['key']);
        }
        // id 搜索
        if (isset($params['id']) && !empty($params['id'])) {
            $builder->where('id', '=', $params['id']);
        }
        // 状态搜索
        if (isset($params['is_enable']) && $params['is_enable'] >= 0) {
            $builder->where('is_enable', '=', $params['is_enable']);
        }
        // 分页数据返回
        return DbHelper::paginate($builder, $params);
    }

    /**
     * 通过名称模块搜索
     *
     * @param array $params
     * @return array
     */
    public function searchByName(array $params)
    {
        return DaoPlatform::select([
            'id', 'key', 'name', 'is_enable'
        ])
            ->where('name', 'like', "%{$params['keyword']}%")
            ->limit($params['limit'])
            ->get()
            ->toArray();
    }

    /**
     * 创建平台
     *
     * @param array $params
     * @return mixed
     *
     * @throws \Throwable
     */
    public function create(array $params)
    {
        // 数据准备
        $model = new DaoPlatform();
        $model->setRawAttributes([
            'key'         => $params['key'],
            'name'        => $params['name'],
            'description' => $params['description'],
            'is_enable'   => $params['is_enable'],
            'sort_order'  => $params['sort_order'],
        ]);
        // 入库操作
        return \DB::transaction(function () use ($model) {
            if ($model->save()) {
                $this->logMessage = '添加平台';
                $this->logKeyword = $model->id;
                $this->logData    = $model->getAttributes();
                return $this->success(true);
            } else {
                return $this->throwBusinessException("数据库保存失败");
            }
        });
    }

    /**
     * 修改平台信息
     *
     * @param array $params
     * @return mixed
     *
     * @throws \Throwable
     * @throws \Zf\Helper\Exceptions\BusinessException
     */
    public function edit(array $params)
    {
        // 数据准备
        $model = $this->getModel($params['id']);
        $model->setAttributes([
            'name'        => $params['name'],
            'description' => $params['description'],
            'sort_order'  => $params['sort_order'],
        ]);
        // 入库操作
        return \DB::transaction(function () use ($model) {
            if ($model->save()) {
                $this->logMessage = '修改平台信息';
                $this->logKeyword = $model->id;
                $this->logData    = $model->getAttributes();
                return $this->success(true);
            } else {
                return $this->throwBusinessException("数据库保存失败");
            }
        });
    }

    /**
     * 切换平台启用状态
     *
     * @param array $params
     * @return mixed
     *
     * @throws \Throwable
     * @throws \Zf\Helper\Exceptions\BusinessException
     */
    public function changeEnable(array $params)
    {
        // 数据准备
        $model = $this->getModel($params['id']);

        $model->is_enable = $model->is_enable ? 0 : 1;
        // 入库操作
        return \DB::transaction(function () use ($model) {
            $this->logMessage = '切换平台启用状态';
            $this->logKeyword = $model->id;
            $this->logData    = [
                'is_enable' => $model->is_enable,
            ];
            if ($model->save()) {
                return $this->success(true);
            } else {
                return $this->throwBusinessException("数据库保存失败");
            }
        });
    }

    /**
     * 获取平台信息
     *
     * @param array $params
     * @return mixed
     *
     * @throws \Throwable
     * @throws \Zf\Helper\Exceptions\BusinessException
     */
    public function view(array $params)
    {
        // 数据准备
        $model = $this->getModel($params['id']);
        return $model->getAttributes();
    }

    /**
     * 获取操作模型
     *
     * @param $id
     * @return DaoPlatform|null
     *
     * @throws \Zf\Helper\Exceptions\BusinessException
     */
    protected function getModel(int $id)
    {
        $model = DaoPlatform::find($id);
        if (null === $model) {
            $this->throwBusinessException('平台不存在');
        }
        return $model;
    }
}