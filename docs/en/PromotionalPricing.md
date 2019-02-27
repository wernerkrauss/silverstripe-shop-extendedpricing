PROMOTIONAL PRICING
===================

Allows you to set promotional discounts on products, variations, and
categories.

- can be applied to categories as well
- can be limited by start and/or end date
- can be absolute price or percentage discount
- can specify whether to display as a sale (i.e. show old price crossed out)

To use, you must add the 'HasPromotionalPricing' extension at
whatever levels you want like so:

```
SilverShop\Page\Product:
  extensions:
    - MarkGuinn\ExendedPricing\HasPromotionalPricing
SilverShop\Model\Variation\Variation:
  extensions:
    - MarkGuinn\ExendedPricing\HasPromotionalPricing
SilverShop\Page\ProductCategory:
  extensions:
    - MarkGuinn\ExendedPricing\HasPromotionalPricing
```

Discounts are then applied on the Pricing tab in the CMS. By default,
discounts do not compound if they are applied at multiple levels (i.e.
a $5 discount on the category and a $4 discount on the product would
only yield $4 discount), but if you wish to change that you can
use the following config setting:

```
MarkGuinn\ExendedPricing\HasPromotionalPricing:
  compound_discounts: true
```

See the examples in templates/Includes for display. You'll probably
need to modify your template.
