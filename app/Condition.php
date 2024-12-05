<?php

namespace App;

use Filament\Support\Contracts\HasLabel;
enum Condition: string implements HasLabel
{
    case BrandNew = 'brand_new';
    case UsedLikeNew = 'used_like_new';
    case UsedNotNew = 'used_not_new';
    case NeedsRepair = 'needs_repair';
    case Refurbished = 'refurbished';
    case Old = 'old';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::BrandNew => 'Brand New',
            self::UsedLikeNew => 'Used Like New',
            self::UsedNotNew => 'Used Not New',
            self::NeedsRepair => 'Needs Repairing',
            self::Refurbished => 'Refurbished',
            self::Old => 'Old',
        };
    }
}
