<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Services;


use Helper\AppHelper;
use Zf\Helper\Abstracts\Singleton;
use Zf\Helper\Registry;

/**
 * Class UserService
 * @package Program\Services
 */
class UserService extends Singleton
{
    const JWT_ISS = 'program';
    const JWT_AUD = 'program';

    // 登记的KEY
    const REGISTRY_KEY = 'program.user';

    /**
     * 获取一个新登录token
     *
     * @param int $uid
     * @return array
     */
    public function generateToken($uid)
    {
        $sec   = env('TOKEN_EXPIRE_TIME') ?? 3600;
        $exp   = time() + $sec;
        $token = AppHelper::jwt()->getToken([
            'iss' => self::JWT_ISS, // 发布者
            'aud' => self::JWT_AUD, // 接受者
            'iat' => time(),
            'exp' => time() + (env('TOKEN_EXPIRE_TIME') ?? 3600),
            'jti' => $uid,
        ]);
        return [
            'sec'   => $sec,
            'exp'   => $exp,
            'token' => $token,
        ];
    }

    /**
     * 返回登录用户信息
     *
     * @return mixed|null
     */
    public function info()
    {
        return Registry::get(self::REGISTRY_KEY);
    }

    /**
     * 刷新用户的token
     *
     * @return array
     */
    public function refreshToken()
    {
        $user = Registry::get(self::REGISTRY_KEY);
        return $this->generateToken($user->uid);
    }

    /**
     * 刷新用户的token
     *
     * @return array
     */
    public function menus()
    {
        $json = <<<EDO
[{
      "route": "/index",
      "icon": "el-icon-menu",
      "label": "首页",
      "linkRoutes": [],
      "subItems": [{
          "route": "member",
          "icon": "el-icon-menu",
          "label": "人员管理",
          "linkRoutes": [],
          "subItems": [{
              "route": "/programmer/index",
              "icon": "el-icon-menu",
              "label": "程序员管理",
              "linkRoutes": []
            },
            {
              "route": "/admin/index",
              "icon": "el-icon-menu",
              "label": "管理员管理",
              "linkRoutes": []
            }
          ]
        },
        {
          "route": "/settings",
          "icon": "el-icon-menu",
          "label": "网站设置",
          "linkRoutes": [],
          "subItems": [{
              "route": "/nav/index",
              "icon": "el-icon-menu",
              "label": "导航管理",
              "linkRoutes": []
            },
            {
              "route": "/table-header/index",
              "icon": "el-icon-menu",
              "label": "表头设置",
              "linkRoutes": [
                "/table-header/add",
                "/table-header/edit",
                "/table-header/view"
              ]
            },
            {
              "route": "/form-settings/index",
              "icon": "el-icon-menu",
              "label": "表单配置",
              "linkRoutes": []
            },
            {
              "route": "/tempalte/index",
              "icon": "el-icon-menu",
              "label": "替换模板",
              "linkRoutes": []
            },
            {
              "route": "/protocol/index",
              "icon": "el-icon-menu",
              "label": "协议管理",
              "linkRoutes": []
            }
          ]
        }
      ]
    },
    {
      "route": "/records",
      "icon": "el-icon-menu",
      "label": "网站记录",
      "linkRoutes": [],
      "subItems": [{
        "route": "logs",
        "icon": "el-icon-menu",
        "label": "日志管理",
        "linkRoutes": [],
        "subItems": [{
            "route": "/logs/login",
            "icon": "el-icon-menu",
            "label": "登录日志",
            "linkRoutes": []
          },
          {
            "route": "/logs/operate",
            "icon": "el-icon-menu",
            "label": "操作日志",
            "linkRoutes": []
          }
        ]
      }]
    },
    {
      "route": "/support",
      "icon": "el-icon-menu",
      "label": "关于我们",
      "linkRoutes": [],
      "subItems": [{
          "route": "/about-us",
          "icon": "el-icon-menu",
          "label": "关于我们",
          "linkRoutes": []
        },
        {
          "route": "/contact-us",
          "icon": "el-icon-menu",
          "label": "联系我们",
          "linkRoutes": []
        }
      ]
    }
  ]
EDO;
        return json_decode($json, true);
    }
}