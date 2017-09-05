<?php
use Illuminate\Contracts\Routing\UrlGenerator;

/**
 * Generate a url for the dashboard application.
 *
 * @param  string $path
 * @param  mixed $parameters
 * @param  bool $secure
 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
 */
function dashboardUrl($path = null, $parameters = [], $secure = null)
{
    if (is_null($path)) {
        return app(UrlGenerator::class);
    }
    $path = '/dashboard' . $path;
    return app(UrlGenerator::class)->to($path, $parameters, $secure);
}

/**
 *  Put session to flash.
 * @param string $status
 * @param string $msg
 * @param string $key
 */
function flash($status = 'success', $msg = '操作成功', $key = 'toastrMsg')
{
    session()->flash($key, ['status' => $status, 'msg' => $msg]);
}

/**
 * @param $text
 * @param array $parameters
 * @return mixed
 */
function lang($text, $parameters = [])
{
    return str_replace('codehaoshi.', '', trans('codehaoshi.' . $text, $parameters));
}

/**
 * @param string $url
 * @param int $status
 * @param string $msg
 * @param array $data
 * @return array
 */
function ajaxReturn($url = "", $status = 1, $msg = '操作成功', $data = [])
{
    return ['status' => $status, 'msg' => $msg, 'url' => $url, 'data' => $data];
}

function ajaxReturnError($url = "", $status = 0, $msg = '操作失败', $data = [])
{
    return ['status' => $status, 'msg' => $msg, 'url' => $url, 'data' => $data];
}

/**
 * @param $array
 * @param $all
 * @return string
 */
function roleOrPermissionDataHandle($array, $all)
{
    $str = "";
    $intersect = array_intersect($array, array_column($all, 'id'));
    if (count($all) > 0) {
        foreach ($all as $key => $vo) {
            $intro = "【" . $vo['display_name'] . "】";
            $str .= '{ "id": "' . $vo['id'] . '", "pId":"0", "name":"' . $vo['name'] . $intro . '"';

            if (!empty($array) && in_array($vo['id'], $intersect)) {
                $str .= ' ,"checked":1';
            }

            $str .= '},';
        }
    }
    return "[" . substr($str, 0, -1) . "]";
}


function getCdnDomain()
{
    return config('app.url_static') ?: config('app.url');
}

function getTagWeight($useCount)
{
    $style = 'mini';
    if ($useCount >= 2 && $useCount < 5) {
        $style = 'tiny';
    } elseif ($useCount >= 5 && $useCount < 10) {
        $style = 'small';
    } elseif ($useCount >= 10 && $useCount < 50) {
        $style = 'large';
    } elseif ($useCount >= 50) {
        $style = 'big';
    }
    return $style;
}

function getDateWithSub($date)
{
    $the_time = strtotime($date);
    $now_time = time();
    $show_time = $the_time;

    $dur = $now_time - $show_time;

    if($dur < 60){
        return $dur.'秒前';
    }else if($dur < 3600){
        return floor($dur/60).'分钟前';
    }else if($dur < 86400) {
        return floor($dur/3600).'小时前';
    }else if($dur < 259200) {//3天内
        return floor($dur / 86400) . '天前';
    }else{
        return substr($date,0,-8);
    }
    return substr($date,0,-8);
}