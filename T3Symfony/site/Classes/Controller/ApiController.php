<?php
declare(strict_types=1);

namespace Examples\Site\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use T3G\AgencyPack\Blog\Domain\Repository\PostRepository;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Example controller using both symfony and extbase
 */
class ApiController
{
    protected $serializer;
    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    private $objectManager;

    public function __construct(SerializerInterface $serializer, ObjectManager $objectManager)
    {
        $this->serializer = $serializer;
        $this->objectManager = $objectManager;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getPosts(): JsonResponse
    {
        $postRepository = $this->objectManager->get(PostRepository::class);
        $posts = $postRepository->findAllByPid(2)->toArray();
        $posts = $this->serializer->serialize($posts, 'json');
        return new JsonResponse($posts, 200, [], true);
    }

    public function getPost(int $uid): JsonResponse
    {
        $postRepository = $this->objectManager->get(PostRepository::class);
        $post = $postRepository->findOneByUid($uid);
        $post = $this->serializer->serialize($post, 'json');
        return new JsonResponse($post, 200, [], true);
    }

}
