<?php
declare(strict_types=1);

namespace Psychomieze\T3Symfony\Http;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psychomieze\T3Symfony\Symfony\Kernel;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Page\PageRepository;

class Middleware implements MiddlewareInterface
{

    /**
     * Process an incoming server request and return a response, optionally delegating
     * response creation to a handler.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $context = GeneralUtility::makeInstance(Context::class);
        // set basic page settings to be able to use TYPO3 API properly
        $GLOBALS['TSFE']->sys_page = GeneralUtility::makeInstance(PageRepository::class, $context);
        $symfonyRequest = (new HttpFoundationFactory())->createRequest($request);
        $applicationContext = GeneralUtility::getApplicationContext();
        if ($applicationContext->isTesting()) {
            $env = 'test';
        } elseif ($applicationContext->isDevelopment()) {
            $env = 'dev';
        } else {
            $env = 'prod';
        }
        $debug = (bool)($GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] ?? ('prod' !== $env));
        $kernel = new Kernel($env, $debug);
        $response = $kernel->handle($symfonyRequest);
        return (new Typo3ResponseFactory())->createResponse($response);
    }
}