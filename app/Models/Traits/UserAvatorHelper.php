<?php
namespace App\Models\Traits;

use GuzzleHttp\Client;

trait UserAvatorHelper
{
    public function cacheAvatar()
    {

        $uploadAvatarPath = '/'.env('UPLOAD_PATH', 'uploads').'/'.config('codehaoshi.uploadsPath.avatar');
        // Download Image
        $guzzle = new Client();
        $response = $guzzle->get($this->image_url);
        // Get next

        $content_type = explode('/', $response->getHeader('Content-Type')[0]);
        $ext = array_pop($content_type);

        $avatar_name = $this->id . '_' . time() . '.' . $ext;
        $base_path = public_path($uploadAvatarPath);
        $save_path = $base_path. $avatar_name;

        if (!file_exists($base_path)) {
            mkdir($base_path, 0777, true);
        }
        //Save File
        $content = $response->getBody()->getContents();
        file_put_contents($save_path, $content);

        //Delete old file
        if ($this->avatar) {
            @unlink($base_path. $this->avatar);
        }
        //Save to database
        $this->avatar = $uploadAvatarPath.$avatar_name;
        $this->save();
    }
}
