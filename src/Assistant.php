<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program;

/**
 * program 模块助手类
 *
 * Class Assistant
 * @package Program
 */
class Assistant
{
    /**
     * 获取模块的 base 目录
     *
     * @return string
     */
    public static function baseBath()
    {
        static $_path;
        if (null === $_path) {
            $_path = dirname(__FILE__);
        }
        return $_path;
    }

    public static function registerRoute()
    {

    }
}