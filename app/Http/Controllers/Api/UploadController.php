<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;
use App\Models\User;
use App\Tools\FileManager\BaseManager;

class UploadController extends Controller
{
    protected $manger;
    protected $baseManager;

    public function __construct()
    {
        $this->baseManager = new BaseManager();
    }

    public function fileUpload(ImageUploadRequest $request)
    {
        if (!$request->hasFile('myfile')) {
            return ajaxReturnError('', '找不到文件');
        }
        $img = $request->file('myfile');
        $result = $this->baseManager->storeUploadImgByConfigPath($img, $request->path);
        $res = ['status' => 1, 'msg' => $result['relative_url']];

        if ($request->path == 'avatar') {
            $user = (new User)->findOrFail($request->id);
            $user->avatar = $result['relative_url'];
            $user->save();
        }
        return response()->json($res);
    }
}
