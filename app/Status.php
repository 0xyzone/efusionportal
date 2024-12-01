<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasLabel
{
    case Pending = 'pending';
    case Reviewing = 'reviewing';
    case Published = 'published';
    case Rejected = 'rejected';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Reviewing => 'Reviewing',
            self::Published => 'Published',
            self::Rejected => 'Rejected',
        };
    }
}
