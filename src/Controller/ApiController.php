<?php declare(strict_types=1);

namespace App\Controller;
use App\Entity\Shop;
use App\Service\ShopwareAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly ShopwareAuthenticator $shopwareAuthenticator
    ) {}

    #[Route('/orders/save', name: 'app.orders.save', methods: 'POST')]
    public function saveOrders(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $shopId = $request->headers->get('shop-id');
        $shop = $entityManager->getRepository(Shop::class)->findOneBy(['shop_id' => $shopId]);
        if (!$shop) {
            $this->createNotFoundException('No Shop found for shop_id ' . $shopId);
        }

        if ($this->shopwareAuthenticator->checkHeaderRequest($request->headers, $shop->getSecret())) {
            $this->logger->info('Success to received orders for Shop ID: ' . $shopId);
            $this->logger->info($request->getContent());
        } else {
            $this->logger->info('Failed to save orders for Shop ID: ' . $shopId);
        }

        return new JsonResponse([]);
    }
}