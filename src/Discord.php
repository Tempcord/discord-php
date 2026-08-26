<?php

declare(strict_types=1);

namespace CyberWolf\Discord;

use Composer\InstalledVersions;
use Discord\Http\DriverInterface;
use Discord\Http\Drivers\React;
use Discord\Http\Http;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use CyberWolf\Discord\Bitwise\Bitwise;
use CyberWolf\Discord\Buffer\BufferInterface;
use CyberWolf\Discord\Buffer\Passthrough;
use CyberWolf\Discord\Enums\TokenType;
use CyberWolf\Discord\Exceptions\Extension\ExtensionNotFoundException;
use CyberWolf\Discord\Extension\Extension;
use CyberWolf\Discord\Gateway\Connection;
use CyberWolf\Discord\Rest\Rest;
use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;

class Discord
{
    private LoopInterface $loop;
    private DataMapper $mapper;
    private Http $http;

    public Rest $rest;
    public Connection $gateway;

    private array $extensions;

    public function __construct(
        private string $token,
        private LoggerInterface $logger = new NullLogger(),
        ?LoopInterface $loop = null,
        ?DataMapper $dataMapper = null,
    ) {
        $this->logger->info('Fenrir initialized. Discriminators > usernames');

        $this->loop = $loop ?? Loop::get();

        $this->mapper = $dataMapper ?? new DataMapper(new NullLogger());
    }

    /**
     * @param Bitwise<\CyberWolf\Discord\Enums\Intent> $intents
     */
    public function withGateway(
        Bitwise $intents,
        int $timeout = 10,
        BufferInterface $buffer = new Passthrough(),
    ): static {
        $this->gateway = new Connection(
            $this->loop,
            $this->token,
            $intents,
            $this->mapper,
            new Websocket($timeout, $this->logger, [$this->token => '::token::'], $buffer),
            $this->logger,
        );

        return $this;
    }

    public function withRest(
        ?DriverInterface $driver = null,
        TokenType $tokenType = TokenType::BOT,
    ): static {
        $driver ??= new React(
            $this->loop
        );

        $this->http = new Http(
            $tokenType->value . ' ' . $this->token,
            $this->loop,
            $this->logger,
            $driver
        );

        $this->rest = new Rest($this->http, $this->mapper, $this->logger);

        return $this;
    }

    public static function getDebugInfo(): array
    {
        try {
            $version = InstalledVersions::getVersion('exan/fenrir');
        } catch (\OutOfBoundsException) {
            $version = 'Unknown';
        }

        return [
            'fenrir_version' => $version,
            'php_version' => PHP_VERSION,
            'bits' => 8 * PHP_INT_SIZE,
            'uname' => php_uname(),
            'os' => PHP_OS,
            'os_family' => PHP_OS_FAMILY,
        ];
    }

    /**
     * @template E
     *
     * @param class-string<E>
     * @return E
     *
     * @throws ExtensionNotFoundException
     */
    public function getExtension(string $id): Extension
    {
        if (!$this->hasExtension($id)) {
            throw new ExtensionNotFoundException(sprintf('Extension %s not found', $id));
        }

        return $this->extensions[$id];
    }

    public function hasExtension(string $id): bool
    {
        return isset($this->extensions[$id]);
    }

    public function registerExtension(Extension $extension): void
    {
        $extension->initialize($this);

        $this->extensions[get_class($extension)] = $extension;
    }
}
