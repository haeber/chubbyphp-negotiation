<?php

declare(strict_types=1);

namespace Chubbyphp\Tests\Negotiation\Unit\Provider;

use Chubbyphp\Negotiation\AcceptLanguageNegotiator;
use Chubbyphp\Negotiation\AcceptNegotiator;
use Chubbyphp\Negotiation\ContentTypeNegotiator;
use Chubbyphp\Negotiation\Provider\NegotiationProvider;
use PHPUnit\Framework\TestCase;
use Pimple\Container;

/**
 * @covers \Chubbyphp\Negotiation\Provider\NegotiationProvider
 *
 * @internal
 */
final class NegotiationProviderTest extends TestCase
{
    public function testAdapter(): void
    {
        error_clear_last();

        new NegotiationProvider();

        $error = error_get_last();

        self::assertNotNull($error);

        self::assertSame(E_USER_DEPRECATED, $error['type']);
        self::assertSame(
            'Use "Chubbyphp\Negotiation\ServiceProvider\NegotiationServiceProvider" instead.',
            $error['message']
        );
    }

    public function testRegister(): void
    {
        $container = new Container();
        $container->register(new NegotiationProvider());

        self::assertTrue(isset($container['negotiator.acceptNegotiator']));
        self::assertTrue(isset($container['negotiator.acceptLanguageNegotiator']));
        self::assertTrue(isset($container['negotiator.contentTypeNegotiator']));
        self::assertTrue(isset($container['negotiator.acceptNegotiator.values']));
        self::assertTrue(isset($container['negotiator.acceptLanguageNegotiator.values']));
        self::assertTrue(isset($container['negotiator.contentTypeNegotiator.values']));

        self::assertInstanceOf(AcceptNegotiator::class, $container['negotiator.acceptNegotiator']);
        self::assertInstanceOf(AcceptLanguageNegotiator::class, $container['negotiator.acceptLanguageNegotiator']);
        self::assertInstanceOf(ContentTypeNegotiator::class, $container['negotiator.contentTypeNegotiator']);
        self::assertEquals([], $container['negotiator.acceptNegotiator.values']);
        self::assertEquals([], $container['negotiator.acceptLanguageNegotiator.values']);
        self::assertEquals([], $container['negotiator.contentTypeNegotiator.values']);
    }
}
