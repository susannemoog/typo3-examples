<?php
declare(strict_types=1);
namespace Psychomieze\T3Symfony\Routing;

use TYPO3\CMS\Core\Routing\Enhancer\RoutingEnhancerInterface;
use TYPO3\CMS\Core\Routing\RouteCollection;

class ByPassEnhancer extends \TYPO3\CMS\Core\Routing\Enhancer\AbstractEnhancer implements RoutingEnhancerInterface
{

    /**
     * @var array
     */
    protected $configuration;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Extends route collection with all routes. Used during URL resolving.
     *
     * @param RouteCollection $collection
     */
    public function enhanceForMatching(RouteCollection $collection): void
    {
        $defaultPageRoute = $collection->get('default');
        $variant = clone $defaultPageRoute;
        $variant->setPath(rtrim($variant->getPath(), '/') . '/' . ltrim($this->configuration['routePath'], '/'));
        $variant->setDefaults($this->configuration['defaults'] ?? []);
        $variant->setRequirements($this->configuration['requirements'] ?? []);
        $variant->addOptions(['_enhancer' => $this]);
        $collection->add('enhancer_' . spl_object_hash($variant), $variant);
    }

    /**
     * Extends route collection with routes that are relevant for given
     * parameters. Used during URL generation.
     *
     * @param RouteCollection $collection
     * @param array $parameters
     */
    public function enhanceForGeneration(RouteCollection $collection, array $parameters): void
    {
        // TODO: Implement enhanceForGeneration() method.
    }
}