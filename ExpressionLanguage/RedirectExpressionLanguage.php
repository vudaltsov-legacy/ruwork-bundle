<?php

namespace Ruwork\CoreBundle\ExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RedirectExpressionLanguage extends ExpressionLanguage
{
    protected function registerFunctions()
    {
        parent::registerFunctions();

        $this->register('path', function ($route, array $parameters = []) {
            return sprintf('$url_generator->generate(%s, %s)', $route, $parameters);
        }, function (array $variables, $route, array $parameters = []) {
            /** @var UrlGeneratorInterface $urlGenerator */
            $urlGenerator = $variables['url_generator'];

            return $urlGenerator->generate($route, $parameters, UrlGeneratorInterface::ABSOLUTE_URL);
        });
    }
}