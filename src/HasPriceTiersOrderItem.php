<?php

namespace MarkGuinn\ExendedPricing;

use SilverShop\Model\Variation\Variation;
use SilverStripe\ORM\DataExtension;

class HasPriceTiersOrderItem extends DataExtension
{
    /**
     * @param float $unitPrice
     */
    public function updateUnitPrice(&$unitPrice)
    {
        $buyable = $this->owner->Buyable();
        if (!$buyable) {
            return;
        }
        $tier = null;

        // Easiest case: the buyable has it's own tiers
        if ($buyable->hasExtension(HasPriceTiers::class)) {
            $tier = $buyable->getTierForQuantity($this->owner->Quantity);
        }

        // Usually, you'd have one set of tiers on the parent product
        // which apply to all variations
        if (!$tier && $buyable instanceof Variation) {
            $prod = $buyable->Product();
            if ($prod && $prod->exists() && $prod->hasExtension(HasPriceTiers::class)) {
                $tier = $prod->getTierForQuantity($this->owner->Quantity);
            }
        }

        // Finally, in some cases (grouped products, primarily) we
        // would want to get the tiers from a parent
        if (!$tier && $buyable->hasMethod('Parent')) {
            $parent = $buyable->Parent();
            if ($parent && $parent->exists() && $parent->hasExtension(HasPriceTiers::class)) {
                //				echo "{$buyable->ID} parent with tiers\n";
                $tier = $parent->getTierForQuantity($this->owner->Quantity);
            }
        }

        // Finally, if we got a tier and it's not the base tier, change the price
        if ($tier && $tier->MinQty > 1) {
            $unitPrice = $tier->calcPrice($unitPrice);
        }
    }


    /**
     * The shop module won't recalculate the unitprice twice in one request (a good thing)
     * But currently the ->add method first adds with a quantity of 1 and then sets the quantity,
     * however the unitprice ends up getting calculated in there while the qty=1 and never
     * recalculated. That's a safe assumption generally but it breaks tier pricing so we
     * have to check here and force it to recalculate.
     */
//	public function onBeforeWrite() {
//		if (
//			ShoppingCart::curr() &&
//			$this->owner->OrderID == ShoppingCart::curr()->ID &&
//			$this->owner->isChanged('Quantity') &&
//			$this->owner->Quantity != 1
//		) {
//			// force unitprice to be recalculated
//			$this->owner->setUnitPrice(0);
//			$this->owner->UnitPrice();
//		}
//	}
}

