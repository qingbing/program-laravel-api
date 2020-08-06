<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Models\Dto;


use Program\Models\Model;
use Zf\Helper\Traits\Models\TLabelForbidden;
use Zf\Helper\Traits\Models\TLabelSex;

/**
 * 程序员用户表
 *
 * Class User
 * @package Program\Models\Dto
 *
 * @property int $uid 自增ID
 * @property string $username 邮箱账户
 * @property string $password 密码
 * @property string $nickname 用户昵称
 * @property string $real_name 姓名
 * @property int $sex 性别[0:保密,1:男士,2:女士]
 * @property string $avatar 头像
 * @property string $mobile 手机号码
 * @property string $phone 固定电话
 * @property string $qq QQ
 * @property string $id_card 身份证号
 * @property string|null $birthday 生日
 * @property string $address 联系地址
 * @property string $zip_code 邮政编码
 * @property int $is_enable 用户启用状态
 * @property int $is_super 是否超级程序员
 * @property int $refer_uid 引荐人或添加人UID
 * @property int $login_times 登录次数
 * @property string $last_login_ip 最后登录IP
 * @property string|null $last_login_at 最后登录时间
 * @property string $register_ip 注册或添加IP
 * @property string $register_at 注册或添加时间
 * @property \Illuminate\Support\Carbon $updated_at 最后数据更新时间
 */
class DtoUser extends Model
{
    use TLabelSex, TLabelForbidden;
    /**
     * @var string 数据表名
     */
    protected $table = 'program_user';
    /**
     * 用户创建或注册时间
     * string
     */
    const CREATED_AT = 'register_at';
    /**
     * @var string 主键
     */
    protected $primaryKey = 'uid';
}