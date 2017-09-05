<?php
//http://fontawesome.io/icons/
return [
    'leftMenu' => [
        [
            'name' => '用户管理',
            'style' => 'users',
            'sun' => [
                [
                    'name' => '用户管理',
                    'href' => '/dashboard/user',
                ],
                [
                    'name' => '角色管理',
                    'href' => '/dashboard/role',
                ],
                [
                    'name' => '权限管理',
                    'href' => '/dashboard/permission',
                ],
            ]
        ],

        [
            'name' => '内容管理',
            'style' => 'ils',
            'sun'  => [
                [
                    'name' => '文章分类',
                    'href' => '/dashboard/articleCategory',
                ],
                [
                    'name' => '文章管理',
                    'href' => '/dashboard/article',
                ],
                [
                    'name' => '标签管理',
                    'href' => '/dashboard/tag',
                ]
            ]
        ],


        [
            'name' => '问题管理',
            'style' => 'question',
            'sun'  => [
                [
                    'name' => '问题分类',
                    'href' => '/dashboard/questionCategory',
                ],
                [
                    'name' => '问题管理',
                    'href' => '/dashboard/question',
                ],
            ]
        ],

        [
            'name' => '站点管理',
            'style' => 'gear',
            'sun'  => [
                [
                    'name' => '友情链接',
                    'href' => '/dashboard/links',
                ],
                [
                    'name' => '关于我们',
                    'href' => '/dashboard/abouts',
                ],
            ]
        ]
    ],
];