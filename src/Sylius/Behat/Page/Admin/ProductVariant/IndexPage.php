<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Behat\Page\Admin\ProductVariant;

use Behat\Mink\Exception\ElementNotFoundException;
use Sylius\Behat\Page\Admin\Crud\IndexPage as BaseIndexPage;
use Sylius\Component\Core\Model\ProductVariantInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class IndexPage extends BaseIndexPage implements IndexPageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOnHandQuantityFor(ProductVariantInterface $productVariant)
    {
        return (int) $this->getElement('onHandQuantity', ['%id%' => $productVariant->getId()])->getText();
    }

    /**
     * {@inheritdoc}
     */
    public function getOnHoldQuantityFor(ProductVariantInterface $productVariant)
    {
        try {
            return (int) $this->getElement('onHoldQuantity', ['%id%' => $productVariant->getId()])->getText();
        } catch (ElementNotFoundException $exception) {
            return 0;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'onHandQuantity' => '.onHand[data-product-variant-id="%id%"]',
            'onHoldQuantity' => '.onHold[data-product-variant-id="%id%"]',
        ]);
    }
}
