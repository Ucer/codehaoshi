<?php

namespace App\Tools\FileManager;

use Illuminate\Support\Facades\Storage;

class BaseManager
{


    /**
     * @var $disk
     */
    protected $disk;

    /**
     * UpyunManager constructor.
     */
    public function __construct()
    {
        $this->disk = Storage::disk(config('filesystems.default'));

    }

    /**
     * @param $img
     * @return array|bool
     */
    public function storeUploadImgByConfigPath($img, $configPath = 'temp')
    {
        $savePath = config('codehaoshi.uploadsPath.' . $configPath) . date('Y') . '/' . date('m');

        $path = $img->store($savePath, 'public');

        $realPath = env('UPLOAD_PATH', 'uploads') . '/' . $path;
        return [
            'real_path' => $savePath,
            'relative_url' => '/' . $realPath,
            'url' => asset($realPath),
        ];
    }

    public function moveFileTorealPath($tempFile, $realPathDir = 'article')
    {
        if (strstr($tempFile, '/temp/')) {
            $newFile = str_replace('/temp/', '/' . $realPathDir . '/', $tempFile);
            $new_dir = public_path(dirname($newFile));
            if (!is_dir($new_dir)) mkdir($new_dir, 0777, true);
            rename(public_path($tempFile), public_path($newFile));

            return $newFile;
        } else {
            return $tempFile;
        }

    }

}
