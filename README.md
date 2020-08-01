
# ====== 组件编号 11 ======
# 异常文件编号
1. 110001 : \Program\Services\Login
1. 110002 : \Program\Middleware\ProgramLogin




# program-laravel-api
laravel 实现的程序员模块中的通用功能 api

# 使用方法
## 1. 路由管理
### 1.1 初始化 program 路由(routes/web.php)
```php
# 添加所有路由
\Program\Assistant::initRoute();
# 添加指定模块路由
\Program\Assistant::initRoute(['login']);
# 添加自定义路由，一般为项目上新路由
\Program\Assistant::registerRoute(function(){
    Route::get('setting', ...);
});
```

## 2. 中间件管理
### 2.1 添加 program 登录中间件(\App\Http\Kernel::$routeMiddleware)
```php
// program 登录中间件
'programLogin' => \Program\Middleware\ProgramLogin::class,
```

