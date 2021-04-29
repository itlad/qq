/*
 * This file is part of itlad/qq.
 *
 * Copyright (c) 2021 Itlad.
 * Copyright (c) 2020 YC.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
import app from 'flarum/common/app';

app.initializers.add('itlad-qq', () => {
    app.extensionData
        .for('itlad-qq')
        .registerSetting({
            label: app.translator.trans('itlad-qq.admin.qq_settings.client_id_label'),
            setting: 'itlad-qq.client_id',
            type: 'text',
        })
        .registerSetting({
          label: app.translator.trans('itlad-qq.admin.qq_settings.client_secret_label'),
          setting: 'itlad-qq.client_secret',
          type: 'text',
      })
});