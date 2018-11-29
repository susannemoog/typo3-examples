<?php
declare(strict_types=1);

namespace Examples\Site\Controller;


use Symfony\Component\HttpFoundation\Response;

class SymfonyFrontendController
{
    public function renderPosts(): Response
    {

        return new Response('this is symfony speaking');
    }
}
