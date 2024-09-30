<?php
declare(strict_types=1);

namespace Alpaca\ItGoesForward\Block\Cart\Additional;

use Magento\Checkout\Block\Cart\Additional\Info as InfoBase;

class Info extends InfoBase
{
    public function getIsItGoesForwardProduct(): bool
    {
        return $this->getItem()->getProduct()->getCustomOption('it_goes_forward') !== null;
    }
}
