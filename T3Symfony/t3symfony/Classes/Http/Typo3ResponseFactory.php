<?php
declare(strict_types=1);

namespace Psychomieze\T3Symfony\Http;


use Psr\Http\Message\UploadedFileInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Http\ServerRequestFactory;
use TYPO3\CMS\Core\Http\Stream;

class Typo3ResponseFactory extends ServerRequestFactory implements HttpMessageFactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function createRequest(Request $symfonyRequest)
    {
        $server = self::prepareHeaders($symfonyRequest->server->all());
        $headers = $symfonyRequest->headers->all();
        $body = new Stream($symfonyRequest->getContent(true));


        $request = new ServerRequest(
            $server,
            self::normalizeUploadedFiles($this->getFiles($symfonyRequest->files->all())),
            $symfonyRequest->getSchemeAndHttpHost() . $symfonyRequest->getRequestUri(),
            $symfonyRequest->getMethod(),
            $body,
            $headers
        );

        $request = $request
            ->withCookieParams($symfonyRequest->cookies->all())
            ->withQueryParams($symfonyRequest->query->all())
            ->withParsedBody($symfonyRequest->request->all())
            ->withRequestTarget($symfonyRequest->getRequestUri());

        foreach ($symfonyRequest->attributes->all() as $key => $value) {
            $request = $request->withAttribute($key, $value);
        }

        return $request;
    }

    /**
     * Converts Symfony uploaded files array to the PSR one.
     *
     * @param array $uploadedFiles
     * @return array
     */
    private function getFiles(array $uploadedFiles): array
    {
        $files = [];

        foreach ($uploadedFiles as $key => $value) {
            if (null === $value) {
                $files[$key] = new \TYPO3\CMS\Core\Http\UploadedFile(null, 0, UPLOAD_ERR_NO_FILE, null, null);
                continue;
            }
            if ($value instanceof UploadedFile) {
                $files[$key] = self::createUploadedFileFromSymfonyFile($value);
            } else {
                $files[$key] = $this->getFiles($value);
            }
        }

        return $files;
    }

    /**
     * Creates a PSR-7 UploadedFile instance from a Symfony one.
     *
     * @param UploadedFile $symfonyUploadedFile
     * @return UploadedFileInterface
     */
    protected static function createUploadedFileFromSymfonyFile(UploadedFile $symfonyUploadedFile): UploadedFileInterface
    {
        return new \TYPO3\CMS\Core\Http\UploadedFile(
            $symfonyUploadedFile->getRealPath(),
            (int)$symfonyUploadedFile->getSize(),
            $symfonyUploadedFile->getError(),
            $symfonyUploadedFile->getClientOriginalName(),
            $symfonyUploadedFile->getClientMimeType()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createResponse(Response $symfonyResponse)
    {
        if ($symfonyResponse instanceof BinaryFileResponse) {
            $stream = new Stream($symfonyResponse->getFile()->getPathname(), 'r');
        } else {
            $stream = new Stream('php://temp', 'wb+');
            if ($symfonyResponse instanceof StreamedResponse) {
                ob_start(
                    function ($buffer) use ($stream) {
                        $stream->write($buffer);

                        return '';
                    }
                );

                $symfonyResponse->sendContent();
                ob_end_clean();
            } else {
                $stream->write($symfonyResponse->getContent());
            }
        }

        $headers = $symfonyResponse->headers->all();
        if (!isset($headers['Set-Cookie']) && !isset($headers['set-sookie'])) {
            $cookies = $symfonyResponse->headers->getCookies();
            if (!empty($cookies)) {
                $headers['Set-Cookie'] = [];
                foreach ($cookies as $cookie) {
                    $headers['Set-Cookie'][] = $cookie->__toString();
                }
            }
        }

        $response = new \TYPO3\CMS\Core\Http\Response(
            $stream,
            $symfonyResponse->getStatusCode(),
            $headers
        );

        $protocolVersion = $symfonyResponse->getProtocolVersion();
        if ('1.1' !== $protocolVersion) {
            $response = $response->withProtocolVersion($protocolVersion);
        }

        return $response;
    }
}