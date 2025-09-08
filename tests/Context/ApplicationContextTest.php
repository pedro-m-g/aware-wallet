<?php

namespace AwareWallet\Context;

use PHPUnit\Framework\TestCase;
use stdClass;

class ApplicationContextTest extends TestCase
{

    public function testGetAnExistingDependency()
    {
        $context = new ApplicationContext();
        $context->set('test', fn() => 'value');
        $actual = $context->get('test');
        $this->assertSame('value', $actual);
    }

    public function testGetANonExistentDependency()
    {
        $this->expectException(MissingDependencyException::class);
        $context = new ApplicationContext();
        $context->get('test');
    }

    public function testDefineASharedValue()
    {
        $context = new ApplicationContext();
        $context->share('test', fn() => new stdClass());
        $obj1 = $context->get('test');
        $obj2 = $context->get('test');
        $this->assertSame($obj1, $obj2);
    }

    public function testDefineServiceWithDependencies()
    {
        $context = new ApplicationContext();
        $context->set('A', fn($ctx) => '1 + 2 = ' . $ctx->get('B'));
        $context->set('B', fn() => '3');
        $this->assertSame('1 + 2 = 3', $context->get('A'));
        $this->assertSame('3', $context->get('B'));
    }

    public function testDefineSharedValueWithDependencies()
    {
        $context = new ApplicationContext();
        $context->share('A', fn($ctx) => '1 + 2 = ' . $ctx->get('B'));
        $context->share('B', fn() => '3');
        $this->assertSame('1 + 2 = 3', $context->get('A'));
        $this->assertSame('3', $context->get('B'));
    }

}
