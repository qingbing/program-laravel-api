<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Models\Dto;


use Program\Models\Model;

/**
 * 程序员日志
 *
 * Class DtoOperateLog
 * @package Program\Models\Dto
 *
 * @property int $id 自增ID
 * @property string $type 操作类型-用字符串描述
 * @property string $keyword 关键字，用于后期筛选
 * @property string $message 操作消息
 * @property string|null $data 操作的具体内容
 * @property string $op_ip 登录IP
 * @property int $op_uid 用户ID
 * @property string $op_username 用户名
 * @property \Illuminate\Support\Carbon $created_at 创建时间
 */
class DtoProgramOperateLog extends Model
{
    /**
     * 定义日志类型常量
     */
    const TYPE_LOGIN    = 'login';
    const TYPE_PLATFORM = 'platform';
    /**
     * @var array 日志类型
     */
    public static $types = [
        self::TYPE_LOGIN    => '用户登录',
        self::TYPE_PLATFORM => '平台管理',
    ];

    /**
     * @var string 数据表名
     */
    protected $table = 'program_operate_log';
}