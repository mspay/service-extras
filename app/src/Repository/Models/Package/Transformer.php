<?php

namespace Alroniks\Repository\Models\Package;

use DateTime;

/**
 * Class Transformer
 * @package Alroniks\Repository\Models\Package
 */
class Transformer
{
    /**
     * @param Package $package
     * @return array
     */
    public static function transform(Package $package)
    {
        return [
            'id' => $package->getId(),
            'name' => $package->getName(),
            'version' => $package->getVersion(),
            'release' => 'pl',
            'display_name' => $package->getSignature(),
            'signature' => $package->getSignature(),
            'author' => $package->getAuthor(),
            'license' => $package->getLicense(),
            'description' => ['@cdata' => $package->getDescription()],
            'instructions' => ['@cdata' => $package->getInstructions()],
            'changelog' => ['@cdata' => $package->getChangelog()],
            'createdon' => $package->getCreatedon()->format(DateTime::ISO8601),
            'editedon' => $package->getEditedon()->format(DateTime::ISO8601),
            'releasedon' => $package->getReleasedon()->format(DateTime::ISO8601),
            'screenshot' => $package->getCover(),
            'thumbnail' => $package->getThumb(),
            'minimum_supports' => $package->getMinimum(),
            'breaks_at' => $package->getMaximum() ?: 1000000,
            'supports_db' => $package->getDatabases(),
            'downloads' => $package->getDownloads(),
            'location' => $package->getLocation()
        ];
    }
}
