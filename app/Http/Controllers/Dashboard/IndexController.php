<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use DB;

class IndexController extends Controller
{

    public function __construct()
    {
        $this->user = new User();
        $this->role = new Role();
//        $this->permission = new Permission();
    }

    public function index()
    {
//        dd(Config::get('dashboardMenu.leftMenu'));
        return view('dashboard.index.index', ['menu_list' => Config::get('dashboardMenu.leftMenu')]);
    }

    public function welcome()
    {
        return view('dashboard.index.welcome');
    }

    /*修改某个表的一个字段值公共方法*/
    public function commonStatusHandle(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $table = $data['table'];
        $column = $data['column'];
        $value = $data['value'];

        $rs = DB::table($table)->where(['id' => $id])->update([$column => $value]);
        if ($rs) return ajaxReturn();
        return ajaxReturnError();
    }

    public function test($model)
    {
        $res = $this->$model->saveFunction();
        dd($res);
    }
}
