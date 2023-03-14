<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Shop;
use App\Service\RegisterAppService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    public function __construct(private readonly RegisterAppService $service)
    {
    }

    /**
     * Registration request
     * @see https://developer.shopware.com/docs/guides/plugins/apps/app-base-guide#registration-request
     */
    #[Route('/registration', name: 'app.registration')]
    public function registration(Request $request): JsonResponse
    {
        $appSignature = $_SERVER['HTTP_SHOPWARE_APP_SIGNATURE'];
        $queryString = $_SERVER['QUERY_STRING'];
        $shopId = $request->query->get('shop-id');
        $shopUrl = $request->query->get('shop-url');

        $queries = [];
        parse_str($queryString, $queries);

        try {
            $registerStruct = $this->service->register($shopId, $shopUrl, $queryString, $appSignature);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_FORBIDDEN);
        }

        return new JsonResponse($registerStruct);
    }

    /**
     * Confirmation request
     * @see https://developer.shopware.com/docs/guides/plugins/apps/app-base-guide#confirmation-request
     */
    #[Route('/confirmation', name: 'app.confirmation', methods: 'POST')]
    public function confirmation(Request $request, EntityManagerInterface $entityManager, ): JsonResponse
    {
        $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $shopId = $content['shopId'] ?? null;
        $apiKey = $content['apiKey'] ?? null;
        $secretKey = $content['secretKey'] ?? null;

        if (!$shopId || !$apiKey || !$secretKey) {
            return new JsonResponse([
                'error' => 'Invalid data'
            ], Response::HTTP_FORBIDDEN);
        }

        // Find the shop if it's existing in the DB
        $shop = $entityManager->getRepository(Shop::class)->findOneBy(['shop_id' => $shopId]);
        if (!$shop) {
            throw $this->createNotFoundException('No Shop found for shop_id ' . $shopId);
        }

        // active the shop, save the api key and the api secret
        $shop->setStatus(true);
        $shop->setApiKey($apiKey);
        $shop->setApiSecret($secretKey);

        $entityManager->flush();

        return new JsonResponse([]);
    }
}