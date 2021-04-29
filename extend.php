<?php

/*
 * This file is part of itlad/qq.
 *
 * Copyright (c) 2021 Itlad.
 * Copyright (c) 2020 YC.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Itlad\AuthQQ;

use Flarum\Extend;

return [
  (new Extend\Frontend('forum'))
    ->js(__DIR__ . '/js/dist/forum.js')
    ->css(__DIR__ . '/resources/less/forum.less'),

  (new Extend\Frontend('admin'))
    ->js(__DIR__ . '/js/dist/admin.js')
    ->css(__DIR__ . '/resources/less/admin.less'),

  new Extend\Locales(__DIR__ . '/resources/locale'),

  (new Extend\Routes('forum'))
    ->get('/auth/qq', 'auth.qq', QQAuthController::class),

  (new Extend\Routes('api'))
    ->get('/authh5/qq', 'authh5.qq', QQAuthH5Controller::class),
];
