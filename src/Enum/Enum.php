<?php
declare(strict_types=1);

namespace App\Enum;

class Enum
{
    public const CAR_PATH            = 'page/car/isActive';
    public const HEALTH_PATH         = 'page/health/isActive';
    public const BUSINESS_PATH       = 'page/business/isActive';
    public const PROPERTY_PATH       = 'page/property/isActive';
    public const CONTACT_PATH        = 'page/contact/isActive';
    public const CAR                 = 'Auto';
    public const HEALTH              = 'Życie';
    public const BUSINESS            = 'Biznes';
    public const PROPERTY            = 'Nieruchomość';
    public const CONTACT             = 'Kontakt';
    public const TURN_ON             = 'Włącz';
    public const TURN_OFF            = 'Wyłącz';
    public const CONTACT_NUMBER      = 'Number';
    public const E_MAIL              = 'E-mail';
    public const CONTACT_NUMBER_PATH = 'polisja/contact/phonenumber';
    public const E_MAIL_PATH         = 'polisja/contact/mail';

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
            'TURN_ON' => self::TURN_ON,
            'TURN_OFF' => self::TURN_OFF,
            'CONTACT_NUMBER_PATH' => self::CONTACT_NUMBER_PATH,
            'E_MAIL_PATH' => self::E_MAIL_PATH,
        ];
    }

    public static function getPagesValue(): array
    {
        return [
            'CAR_PATH' => self::CAR_PATH,
            'HEALTH_PATH' => self::HEALTH_PATH,
            'BUSINESS_PATH' => self::BUSINESS_PATH,
            'PROPERTY_PATH' => self::PROPERTY_PATH,
            'CONTACT_PATH' => self::CONTACT_PATH,
            'CONTACT_NUMBER_PATH' => self::CONTACT_NUMBER_PATH,
            'E_MAIL_PATH' => self::E_MAIL_PATH,
        ];
    }
}
