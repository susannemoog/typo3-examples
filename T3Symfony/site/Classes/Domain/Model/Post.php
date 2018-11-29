<?php

/*
 * This file is part of the package t3g/blog.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Examples\Site\Domain\Model;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Class Post.
 */
class Post extends \T3G\AgencyPack\Blog\Domain\Model\Post implements \JsonSerializable
{

    /**
     * Specify data which should be serialized to JSON
     *
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $media = null;
        foreach ($this->media as $k => $mediaFile) {
            $media[] = [
                'url' => $mediaFile->getOriginalResource()->getPublicUrl(),
                'type' => $mediaFile->getOriginalResource()->getMimeType()
            ];
        }
        return [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'abstract' => $this->abstract,
            'description' => $this->description,
            'crdate' => $this->crdate ? $this->crdate->format(DATE_ATOM) : null,
            'categories' => $this->categories,
            'commentsActive' => $this->commentsActive,
            'tags' => $this->tags,
            'sharingEnabled' => $this->sharingEnabled,
            'media' => $media,
            'archiveDate' => $this->archiveDate,
            'publishDate' => $this->publishDate,
            'authors' => $this->authors
        ];
    }
}
