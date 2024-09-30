<?php
declare(strict_types=1);

namespace Alpaca\ItGoesForward\Model;

use Alpaca\ItGoesForward\Api\ListingsApiInterface;
use Alpaca\ItGoesForward\Service\ApiService;

class ListingsApi implements ListingsApiInterface
{
    /**
     * @param \Alpaca\ItGoesForward\Service\ApiService $apiService
     */
    public function __construct(
        protected ApiService $apiService
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function getListingsBySku(string $sku): array
    {
        $listings = $this->apiService->getListingBySku($sku);

        return array_filter($listings, function (array $listing) {
            return mb_strtolower($listing['status']) === 'available' && $listing['matched'] === false;
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getListingsByProductIds(string $ids): array
    {
        // Convert comma separated string to array
        $ids = array_filter(array_map('trim', explode(",", $ids)));

        if (count($ids) === 1) {
            $listings = $this->apiService->getListingByProductId($ids[0]);
        } else {
            $listings = $this->apiService->getListingsByProductIds($ids);
        }

        return array_filter($listings, function (array $listing) {
            return mb_strtolower($listing['status']) === 'available' && $listing['matched'] === false;
        });
    }
}
