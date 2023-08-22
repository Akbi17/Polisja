<?php
declare(strict_types=1);

namespace App\Enum;

class Enum
{
    public const CAR_PATH ='page/car/isActive';
    public const HEALTH_PATH ='page/health/isActive';
    public const BUSINESS_PATH ='page/business/isActive';
    public const PROPERTY_PATH ='page/property/isActive';
    public const CONTACT_PATH ='page/contact/isActive';
    public const CAR ='Auto';
    public const HEALTH ='Życie';
    public const BUSINESS ='Biznes';
    public const PROPERTY ='Nieruchomość';
    public const CONTACT ='Kontakt';

    public function getEnumValues(): array
    {
        return [
            'CAR_PATH' => self::CAR_PATH,
            'HEALTH_PATH' => self::HEALTH_PATH,
            'BUSINESS_PATH' => self::BUSINESS_PATH,
            'PROPERTY_PATH' => self::PROPERTY_PATH,
            'CONTACT_PATH' => self::CONTACT_PATH,
            'CAR' => self::CAR,
            'HEALTH' => self::HEALTH,
            'BUSINESS' => self::BUSINESS,
            'PROPERTY' => self::PROPERTY,
            'CONTACT' => self::CONTACT,
        ];
    }
}
