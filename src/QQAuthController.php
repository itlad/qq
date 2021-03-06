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

use Exception;
use Flarum\Forum\Auth\Registration;
use Flarum\Forum\Auth\ResponseFactory;
use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class QQAuthController implements RequestHandlerInterface
{
    /**
     * @var ResponseFactory
     */
    protected $response;

    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var UrlGenerator
     */
    protected $url;

    /**
     * @param ResponseFactory $response
     * @param SettingsRepositoryInterface $settings
     * @param UrlGenerator $url
     */
    public function __construct(ResponseFactory $response, SettingsRepositoryInterface $settings, UrlGenerator $url)
    {
        $this->response = $response;
        $this->settings = $settings;
        $this->url      = $url;
    }


    /**
     * @param Request $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function handle(Request  $request): ResponseInterface
    {
        $redirectUri = $this->url->to('forum')->route('auth.qq');
        
        $provider   = new QQ([
            'clientId'          => $this->settings->get('itlad-qq.client_id'),
            'clientSecret'      => $this->settings->get('itlad-qq.client_secret'),
            'redirectUri'       => $redirectUri,
        ]);
      
        $session        = $request->getAttribute('session');
        $queryParams    = $request->getQueryParams();
        $code           = Arr::get($queryParams, 'code');

        if (!$code) {
            $authUrl    = $provider->getAuthorizationUrl();
            $session->put('oauth2state', $provider->getState());
            return new RedirectResponse($authUrl);
        }
        $state          = Arr::get($queryParams, 'state');
        
        
        if (!$state || $state !== $session->get('oauth2state')) {
            $session->remove('oauth2state');
            throw new Exception('Invalid state');
        }
        $token          = $provider->getAccessToken('authorization_code', [
            "code"  => $code,
        ]);
      
        $user           = $provider->fetchOpenid($token);
     
        $userinfo = $provider->fetchUesrInfo($token, $user['openid']);
       
        $userinforesult = array_merge_recursive($user, $userinfo);
        return $this->response->make(
            'QQ',
            $userinforesult["openid"],
            function (Registration $registration) use ($userinforesult) {
                $registration
                    ->suggestEmail("")
                    ->provideAvatar($userinforesult['figureurl_qq_2'])
                    ->suggestUsername($userinforesult["nickname"].str::upper(str::random(4)))
                    ->setPayload($userinforesult);
            }
        );
    }
}
