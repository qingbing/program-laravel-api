<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Middleware;

use Closure;
use Helper\AppHelper;
use Illuminate\Validation\UnauthorizedException;
use Program\Models\Dao\DaoUser;
use Program\Services\UserService;
use Zf\Helper\Exceptions\BusinessException;
use Zf\Helper\Registry;

/**
 * program 模块登录中间件
 *
 * Class ProgramLogin
 * @package Program\Middleware
 */
class ProgramLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     *
     * @throws BusinessException
     * @throws \Zf\Helper\Exceptions\Exception
     */
    public function handle($request, Closure $next)
    {
        $tokenStr = \Request::header(env('LOGIN_TOKEN') ?? 'Z-TOKEN', null);
        if (null === $tokenStr) {
            throw new UnauthorizedException('请先登录后再访问该页面', 110002001);
        }
        $token = AppHelper::jwt()->verifyToken($tokenStr);
        if (UserService::JWT_ISS !== $token->getClaim('iss')) {
            throw new BusinessException('未知发布者', 110002002);
        }
        if (UserService::JWT_AUD !== $token->getClaim('aud')) {
            throw new BusinessException('接受者不匹配', 110002003);
        }
        // 当前用户信息登记
        $user = DaoUser::getByUid($token->getClaim('jti'));
        if (null === $user) {
            throw new BusinessException('用户不存在', 110002004);
        }
        Registry::set(UserService::REGISTRY_KEY, $user);
        return $next($request);
    }
}