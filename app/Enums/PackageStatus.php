<?php

namespace App\Enums;

enum PackageStatus: string
{
    case Demarre = 'demarre';
    case EnDouane = 'en_douane';
    case EnTransit = 'en_transit';
    case ReglementFinal = 'reglement_final';
    case Livre = 'livre';

    public function label(): string
    {
        return app()->getLocale() === 'hr' ? $this->labelHr() : $this->labelFr();
    }

    private function labelFr(): string
    {
        return match ($this) {
            self::Demarre => 'Démarré',
            self::EnDouane => 'En douane',
            self::EnTransit => 'En transit',
            self::ReglementFinal => 'Règlement final',
            self::Livre => 'Livré',
        };
    }

    private function labelHr(): string
    {
        return match ($this) {
            self::Demarre => 'Pokrenuto',
            self::EnDouane => 'Carinjenje',
            self::EnTransit => 'U tranzitu',
            self::ReglementFinal => 'Konačno plaćanje',
            self::Livre => 'Isporučeno',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn (self $status) => ['value' => $status->value, 'label' => $status->label()],
            self::cases()
        );
    }
}
