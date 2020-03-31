<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Cake\Routing\Router;

/*
 * CheckNameAdminMiddleware
 *
*/

class CheckRoleAdminMiddleware implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $response = $handler->handle($request);
        // Redirect if user login is not admin
        $auth = $request->getSession()->read('Auth.User');
        if ($auth->role !== 1 && $request->getParam('controller') == 'Account') {
            $request->getSession()->write(MIDDLEWARE_MESSAGE_FLASH, 'Middleware CheckRoleAdmin has push you here !!!');
            header('Location: '. Router::url(['controller' => 'Web', 'action' => 'index']));
            exit();
        }

        return $response;
    }
}
