<?php

namespace Psychomieze\T3Symfony\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;
use TYPO3\CMS\Core\Core\Environment;

/**
 * Class Kernel
 *
 * @todo site based config?
 * @package Psychomieze\T3Symfony\Symfony
 */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;
    private const CONFIG_EXTS = '.{php,xml,yaml,yml}';
    protected $configPath;

    public function __construct(string $environment, bool $debug)
    {
        parent::__construct($environment, $debug);
        $this->configPath = Environment::getConfigPath() . '/symfony/';
    }

    public function getCacheDir()
    {
        return Environment::getVarPath() . '/cache/symfony/' . $this->environment;
    }

    public function getLogDir()
    {
        return Environment::getVarPath() . '/log/symfony/';
    }

    public function registerBundles()
    {
        $contents = require $this->configPath . 'bundles.php';
        foreach ($contents as $class => $envs) {
            if (isset($envs['all']) || isset($envs[$this->environment])) {
                yield new $class();
            }
        }
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->addResource(new FileResource($this->configPath . 'bundles.php'));
        $container->setParameter('container.dumper.inline_class_loader', true);
        $loader->load($this->configPath . '/{packages}/*' . self::CONFIG_EXTS, 'glob');
        $loader->load($this->configPath . '/{packages}/' . $this->environment . '/**/*' . self::CONFIG_EXTS, 'glob');
        $loader->load($this->configPath . '/{services}' . self::CONFIG_EXTS, 'glob');
        $loader->load($this->configPath . '/{services}_' . $this->environment . self::CONFIG_EXTS, 'glob');
    }

    protected function configureRoutes(RouteCollectionBuilder $routes): void
    {
        $routes->import($this->configPath . '/{routes}/*' . self::CONFIG_EXTS, '/', 'glob');
        $routes->import($this->configPath . '/{routes}/' . $this->environment . '/**/*' . self::CONFIG_EXTS, '/', 'glob');
        $routes->import($this->configPath . '/{routes}' . self::CONFIG_EXTS, '/', 'glob');
    }
}