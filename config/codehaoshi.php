<?php
return [
    'thirdLogin' => [
        'github' => true,
        'qq' => false
    ],
    'uploadsPath' => [
        'avatar' => 'avatar/',
        'temp' => 'temp/',
        'article' => 'article/',
        'question' => 'question/'
    ],
    'dashboard' => [
        'pagesize' => 20
    ],
    'comments_perpage' => 200,
    'default_avatar' => '/images/header_default.gif',
    // Social Share
    'social_share' => [
        'article_share'    => env('ARTICLE_SHARE') ?: true,
        'discussion_share' => env('DISCUSSION_SHARE') ?: true,
        'sites'            => env('SOCIAL_SHARE_SITES') ?: 'qzone,qq,weibo,wechat,douban,twitter',
        'mobile_sites'     => env('SOCIAL_SHARE_MOBILE_SITES') ?: 'qzone,qq,weibo,wechat,douban,twitter',
    ],
    'notice' => [
        'home_page_article' => 'Record some cool articles.',
        'home_page_question' => 'A hodgepodge of problems.',
        'info_page_article' => 'Good good study.',
        'info_page_question' => 'Day day up.',
    ],
    'description' => 'Loading . . .'


];
