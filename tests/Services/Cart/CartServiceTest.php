<?php

/*
 * This file is part of the tbcd/cas project.
 *
 * (c) Thomas Beauchataud <thomas.beauchataud@yahoo.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Author Thomas Beauchataud
 * From 21/10/2024
 */

namespace TBCD\Webshop\Tests\Services\Cart;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use TBCD\Webshop\Services\Cart\CartService;
use TBCD\Webshop\Services\Cart\SessionCartStorage;
use TBCD\Webshop\Tests\FakeCart;
use TBCD\Webshop\Tests\FakeCartFactory;

class CartServiceTest extends TestCase
{

    /**
     * @return void
     */
    public function testGetCart()
    {
        $request = new Request();
        $request->setSession(new Session());

        $requestStack = new RequestStack();
        $requestStack->push($request);

        $cartSessionStorage = new SessionCartStorage($requestStack);
        $cartService = new CartService(new FakeCartFactory(), $cartSessionStorage);

        $cart = $cartService->getCart();
        $this->assertNotNull($cart);
    }

    /**
     * @return void
     */
    public function testSaveCart()
    {
        $request = new Request();
        $request->setSession(new Session());

        $requestStack = new RequestStack();
        $requestStack->push($request);

        $cartSessionStorage = new SessionCartStorage($requestStack);
        $cartService = new CartService(new FakeCartFactory(), $cartSessionStorage);

        $savedCart = $cartService->saveCart(new FakeCart());
        $this->assertNotNull($savedCart);

        $cart = $cartService->getCart();
        $this->assertEquals($savedCart, $cart);
    }

    /**
     * @return void
     */
    public function testDeleteCart()
    {
        $request = new Request();
        $request->setSession(new Session());

        $requestStack = new RequestStack();
        $requestStack->push($request);

        $cartSessionStorage = new SessionCartStorage($requestStack);
        $cartService = new CartService(new FakeCartFactory(), $cartSessionStorage);

        $cart = $cartService->saveCart(new FakeCart());
        $this->assertNotNull($cart);

        $cartService->deleteCart();
        $newCart = $cartService->getCart();
        $this->assertNotSame($newCart, $cart);
    }
}