<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Program\Controllers;


use Illuminate\Support\Facades\Hash;
use Program\Components\Controller;
use Zf\Helper\Format;
use Zf\Helper\Plugins\Jwt;

class TestController extends Controller
{
    /**
     * POST
     */
    public function store()
    {

    }

    /**
     * GET|POST|HEAD
     */
    public function actionIndex()
    {
//        $xx = DB::table('test')->first();
//        DB::table('test')->insert([
//            'created_at' => -2147483648,
//            'update_at' => 2147483647
//        ]);
        $password = 123456;
        var_dump($str = Hash::make($password));
        var_dump(Hash::check('123456', $str));

//        $password = 1234561;
//        var_dump(Hash::make($password));
//
//        $password = 123456177;
//        var_dump(Hash::make($password));
//
//        $password = "1234561793478593404834784789906479759487dfdsfsdfe5843590496470468798357";
//        var_dump(Hash::make($password));


//        var_dump(Format::datetime($xx->created_at));
//        var_dump(Format::datetime($xx->update_at));

        var_dump(Format::datetime());
//        var_dump(Format::datetime(0));
//        var_dump(Format::datetime(-2778));
//        var_dump(Format::datetime(9999999999));
//        var_dump(Format::datetime(strtotime("1950-05-01")));

        return [];
    }

    /**
     * GET|HEAD
     */
    public function create()
    {

    }

    /**
     * PUT|PATCH
     */
    public function update()
    {

    }

    /**
     * DELETE
     */
    public function destroy()
    {

    }

    /**
     * GET|HEAD
     */
    public function show()
    {

    }

    /**
     * GET|HEAD
     */
    public function edit()
    {
        $jwt = Jwt::getInstance([
            'privateKey' => env('JWT_PRIVATE_KEY'),
            'publicKey'  => env('JWT_PUBLIC_KEY'),
        ]);

        try {
            $token = $jwt->getToken([
                'iss'      => 'backend',
                'aud'      => 'backend',
                'iat'      => time(),
                'exp'      => time() + 30,
                'username' => 'qingbing',
                'uid'      => 11111,
            ]);

            var_dump($token);

            $data = $jwt->verifyToken($token);
            var_dump($data);

        }
        catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }

    }
}