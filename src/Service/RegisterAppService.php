<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Shop;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class RegisterAppService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly LoggerInterface        $logger,
        private readonly string                 $shopwareAppUrl,
        private readonly string                 $shopwareAppSecret,
        private readonly string                 $shopwareAppName,
    ) {
    }

    /**
     * App registration
     *
     * @see https://developer.shopware.com/docs/guides/plugins/apps/app-base-guide#registration-request
     * @throws \Exception
     */
    public function register(string $shopId, string $shopUrl, string $query, string $swSignature): array
    {
        if (!$this->checkSwSignature($query, $swSignature)) {
            throw new \InvalidArgumentException('The shopware signature does not matched!');
        }

        $shopSecret = bin2hex(random_bytes(32));
        $this->createShop($shopId, $shopUrl, $shopSecret);

        return [
            'proof' => $this->createProof($shopId, $shopUrl),
            'secret' => bin2hex(random_bytes(32)),
            'confirmation_url' => $this->shopwareAppUrl . '/confirmation',
        ];
    }

    /**
     * The shop will send us the signature code. We have to check if it's correct with the app's secret.
     */
    private function checkSwSignature(string $query, string $swSignature): bool
    {
        $signature = hash_hmac(ShopwareAuthenticator::AUTH_HASH_ALGO, htmlspecialchars_decode($query), $this->shopwareAppSecret);
        if (!hash_equals($signature, $swSignature)) {
            $this->logger->error('Check Shopware signature was failed: ' . $signature . '-' . $swSignature);
            return false;
        }

        return true;
    }

    /**
     * Create Proof code and send it back to Shopware
     */
    public function createProof(string $shopId, string $shopUrl): string
    {
        return \hash_hmac(ShopwareAuthenticator::AUTH_HASH_ALGO, $shopId . $shopUrl . $this->shopwareAppName, $this->shopwareAppSecret);
    }

    private function createShop(string $shopId, string $shopUrl, string $secret): void
    {
        $shop = $this->entityManager->getRepository(Shop::class)->findOneBy(['shop_id' => $shopId]);
        if (!$shop) {
            $shop = new Shop();
        }

        $shop->setShopId($shopId);
        $shop->setUrl($shopUrl);
        $shop->setSecret($secret);

        $this->entityManager->persist($shop);
        $this->entityManager->flush();
    }
}