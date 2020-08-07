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
    const MODULE_PLATFORM = 'platform';

    /**
     * @var array 路由模块
     */
    protected static $_routeModules = [
        self::MODULE_PLATFORM,
        'auth',
    ];

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
     * @param array|null $modules
     */
    public static function initRoute(array $modules = null)
    {
        // 普通路由，不需要登录
        Route::group([
            'prefix'    => 'program',
            'namespace' => '\Program\Controllers',
        ], function () {
            Route::get("/token", "PublicController@actionToken");
            Route::get("/qiniu-token", "PublicController@actionQiniuToken");
            Route::get("/label", "PublicController@actionLabel");
            Route::post("/login", "LoginController@actionIndex");
        });
        // 通用路由
        static::registerRoute(function () {
            // 退出登录
            Route::post("/logout", "LoginController@actionLogout");
            // 刷新用户token
            Route::get("/user/refresh-token", "UserController@actionRefreshToken");
            // 保存用户头像
            Route::post("/user/save-avatar", "UserController@actionSaveAvatar");
            // 清理缓存
            Route::post("/system/clear-cache", "SystemController@actionClearCache");
            // 用户信息
            Route::get("/user/info", "UserController@actionInfo");
            // 获取用户菜单权限
            Route::get("/user/menus", "UserController@actionMenus");
        });

        // 加载开启的权限模块
        if (null === $modules) {
            $modules = static::$_routeModules;
        }
        $loadModules = array_intersect(static::$_routeModules, $modules);
        foreach ($loadModules as $m) {
            $methodName = "init{$m}Routes";
            if (is_callable([static::class, $methodName])) {
                call_user_func([static::class, $methodName]);
            }
        }
    }

    /**
     * 注册平台管理路由
     */
    protected static function initPlatformRoutes()
    {
        static::registerRoute(function () {
            Route::get('platform/search-by-name', 'PlatformController@actionSearchByName');
            Route::post('platform/change-enable', 'PlatformController@actionChangeEnable');
            RouteHelper::registerCURLRoute('PlatformController', 'platform', [
                RouteHelper::ROUTE_TYPE_DESTROY
            ]);
        });
    }

    protected static function initAuthRoutes()
    {
//        var_dump(222);
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