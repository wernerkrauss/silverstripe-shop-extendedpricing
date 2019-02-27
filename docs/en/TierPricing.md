TIER PRICING
============

Allows you to see pricing tiers based on how many items a customer purchases.
For example, a shirt could cost $10 normally, but only $8 if one buys 20 or
more.

- Can apply a fixed price or percentage
- Can have global tiers attached to the SiteConfig
- Can have tiers on a parent product which apply to variations

Usage:

```
SilverShop\Page\Product:
  extensions:
    - MarkGuinn\ExendedPricing\HasPriceTiers
SilverShop\Model\Product\OrderItem:
  extensions:
    - MarkGuinn\ExendedPricing\HasPriceTiersOrderItem
SilverShop\Model\Variation\OrderItem:
  extensions:
    - MarkGuinn\ExendedPricing\HasPriceTiersOrderItem
```

If you want to have the option of defining global price tiers, add:

```
SilverStripe\SiteConfig\SiteConfig:
  extensions:
    - MarkGuinn\ExendedPricing\HasPriceTiers
```
