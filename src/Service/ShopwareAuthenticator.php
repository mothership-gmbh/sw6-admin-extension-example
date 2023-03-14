<?php declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\HeaderBag;

class ShopwareAuthenticator
{
    public const HTTP_HEADER_LOCATION_ID = 'location-id';
    public const HTTP_HEADER_PRIVILEGES = 'privileges';
    public const HTTP_HEADER_SHOP_ID = 'shop-id';
    public const HTTP_HEADER_SHOP_URL = 'shop-url';
    public const HTTP_HEADER_TIMESTAMP = 'timestamp';
    public const HTTP_HEADER_VERSION = 'sw-version';
    public const HTTP_HEADER_CONTEXT_LANGUAGE = 'sw-context-language';
    public const HTTP_HEADER_USER_LANGUAGE = 'sw-user-language';
    public const HTTP_SHOP_SIGNATURE = 'shopware-shop-signature';

    public const AUTH_HASH_ALGO = 'sha256';

    /**
     * To authenticate by the data on the header request
     *
     * @param HeaderBag $headers The request headers when we called from the shopware app
     * @param string    $secret The secret key when the shop registers
     * @return bool
     */
    public function checkHeaderRequest(HeaderBag $headers, string $secret): bool
    {
        // Do not change the order here, it will be affected on the hash's result
        $headerKeys = [
            self::HTTP_HEADER_LOCATION_ID,
            self::HTTP_HEADER_PRIVILEGES,
            self::HTTP_HEADER_SHOP_ID,
            self::HTTP_HEADER_SHOP_URL,
            self::HTTP_HEADER_TIMESTAMP,
            self::HTTP_HEADER_VERSION,
            self::HTTP_HEADER_CONTEXT_LANGUAGE,
            self::HTTP_HEADER_USER_LANGUAGE,
        ];

        $queries = [];
        foreach ($headerKeys as $headerKey) {
            if (!$headers->has($headerKey)) {
                continue;
            }

            // We have to encode the privileges
            if ($headerKey === self::HTTP_HEADER_PRIVILEGES) {
                $queries[$headerKey] = urlencode($headers->get($headerKey));
                continue;
            }

            $queries[$headerKey] = $headers->get($headerKey);
        }

        $queryString = htmlspecialchars_decode(urldecode(http_build_query($queries)));

        $hmac = \hash_hmac(self::AUTH_HASH_ALGO, $queryString, $secret);

        return \hash_equals($hmac, $headers->get(self::HTTP_SHOP_SIGNATURE));
    }
}