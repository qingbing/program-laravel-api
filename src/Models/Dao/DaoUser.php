<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Models\Dao;


use Illuminate\Support\Facades\Hash;
use Program\Models\Dto\DtoUser;

/**
 * Class DaoUser
 * @package Program\Models\Dao
 */
class DaoUser extends DtoUser
{
    /**
     * @param $password
     * @return string
     */
    public static function generatePassword(string $password)
    {
        return Hash::make($password);
    }

    /**
     * 密码校验是否正确
     *
     * @param string $password
     * @param string|\Illuminate\Database\Eloquent\Model $hashPassword
     * @return bool
     */
    public static function checkPassword(string $password, $hashPassword): bool
    {
        if ($hashPassword instanceof \Illuminate\Database\Eloquent\Model) {
            $hashPassword = $hashPassword->password;
        }
        return Hash::check($password, $hashPassword);
    }

    /**
     * 判断是否是该用户的密码
     *
     * @param $password
     * @return bool
     */
    public function isPassword($password)
    {
        return self::checkPassword($password, $this->password);
    }

    /**
     * 通过用户ID获取用户
     *
     * @param int $uid
     * @return \Helper\Components\Model[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|DaoUser|null
     */
    public static function getByUid(int $uid)
    {
        return self::find($uid);
    }

    /**
     * 通过用户名获取用户
     *
     * @param string $username
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function getByUsername(string $username)
    {
        return self::where('username', $username)
            ->first();
    }
}