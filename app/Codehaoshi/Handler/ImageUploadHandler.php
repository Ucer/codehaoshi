<?php

namespace Codehaoshi\Handler;

use App\Http\Requests\ImageUploadRequest;
use App\Tools\FileManager\BaseManager;

class ImageUploadHandler
{

    /**
     * @var UploadedFile $file
     */
    protected $file;
    protected $allowed_extensions = ["image/jpeg", "image/png", "image/gif"];

    protected $manger;
    protected $baseManager;

    public function __construct()
    {
        $this->baseManager = new BaseManager();
    }

    public function fileUpload(ImageUploadRequest $request, $img)
    {
        $result = $this->baseManager->storeUploadImgByConfigPath($img, $request->path);
        $res = ['status' => 1, 'msg' => $result['relative_url']];
        return response()->json($res);
    }
}