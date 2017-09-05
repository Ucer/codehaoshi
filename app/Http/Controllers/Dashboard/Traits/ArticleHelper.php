<?php

namespace App\Http\Controllers\Dashboard\Traits;

use Auth;
use Carbon\Carbon;

trait ArticleHelper
{
    protected function handleArticleDate($data)
    {
        $attribute['is_excellent'] = $attribute['is_hot'] = $attribute['only_owner_can_see'] = $attribute['is_draft'] = 'no';

        $attribute['user_id'] = Auth::id();
        if (strstr($data['attribute'], '1')) $attribute['is_excellent'] = 'yes';
        if (strstr($data['attribute'], '2')) $attribute['is_hot'] = 'yes';
        if (strstr($data['attribute'], '3')) $attribute['only_owner_can_see'] = 'yes';
        if (strstr($data['attribute'], '4')) $attribute['is_draft'] = 'yes';
        $attribute['published_at'] = isset($data['published_at']) ?: Carbon::now();
        $attribute['weight'] = isset($data['weight']) ?: 50;

        return array_merge($data, $attribute);
    }

    protected function handleArticleDateToStr($model)
    {
        $attribute = [];
        if ($model->is_excellent == 'yes') $attribute[] = '1';
        if ($model->is_hot == 'yes') $attribute[] = '2';
        if ($model->only_owner_can_see == 'yes') $attribute[] = '3';
        if ($model->is_draft == 'yes') $attribute[] = '4';
        if (count($attribute) > 0) {
            return implode(',', $attribute);
        } else {
            return '';
        }
    }
}