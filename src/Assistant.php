<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program;

use Helper\RouteHelper;
use Illuminate\Support\Facades\Route;

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

    /**
     * 初始化 program 路由
     *
     * @param array|null $types
     */
    public static function initRoute(array $types = null)
    {
        // 登录路由
        Route::group([
            'prefix'    => 'program',
            'namespace' => '\Program\Controllers',
        ], function () {
            Route::get("/token", "PublicController@actionToken");
            Route::post("/login", "LoginController@actionIndex");
            Route::post("/logout", "LoginController@actionLogout");
        });

        static::registerRoute(function () {
            Route::post("/system/clear-cache", "SystemController@actionClearCache");
            Route::get("/user/info", "UserController@actionInfo");
            Route::get("/user/refresh-token", "UserController@actionRefreshToken");
            Route::get("/user/menus", "UserController@actionMenus");
            RouteHelper::registerCURLRoute('TestController', 'test');
        });
    }

    /**
     * 注册 program 路由
     *
     * @param callable $callback
     */
    public static function registerRoute(callable $callback)
    {
        Route::group([
            'namespace'  => '\Program\Controllers',
            'prefix'     => 'program',
            'middleware' => 'programLogin'
        ], $callback);
    }
}