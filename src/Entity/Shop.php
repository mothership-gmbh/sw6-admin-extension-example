<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopRepository::class)]
class Shop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $shop_id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(length: 255)]
    private ?string $secret = null;

    #[ORM\Column]
    private bool $status = false;

    #[ORM\Column(length: 255)]
    private ?string $api_key = null;

    #[ORM\Column(length: 255)]
    private ?string $api_secret_key = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShopId(): ?string
    {
        return $this->shop_id;
    }

    public function setShopId(string $shop_id): self
    {
        $this->shop_id = $shop_id;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getSecret(): ?string
    {
        return $this->secret;
    }

    public function setSecret(string $secret): self
    {
        $this->secret = $secret;

        return $this;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getApiKey(): ?string
    {
        return $this->api_key;
    }

    public function setApiKey(string $apiKey): self
    {
        $this->api_key = $apiKey;

        return $this;
    }

    public function getApiSecret(): ?string
    {
        return $this->api_secret_key;
    }

    public function setApiSecret(string $apiSecretKey): self
    {
        $this->api_secret_key = $apiSecretKey;

        return $this;
    }
}
