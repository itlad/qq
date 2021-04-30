/*
 * This file is part of itlad/qq.
 *
 * Copyright (c) 2021 Itlad.
 * Copyright (c) 2020 YC.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
import { extend } from 'flarum/common/extend'
import app from 'flarum/common/app'
import LogInButtons from 'flarum/forum/components/LogInButtons'
import QQLogInButton from './components/QQLogInButton'

app.initializers.add('itlad-qq', () => {
  extend(LogInButtons.prototype, 'items', function (items) {
    items.add(
      'QQAndH5',
      <QQLogInButton className="Button LogInButton--QQ" icon="fab fa-qq" path="/auth-qq">
        {app.translator.trans('itlad-qq.forum.log_in.with_qq_button')}
      </QQLogInButton>
    );
  });
})
