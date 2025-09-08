<?php

namespace AwareWallet\Collection;

use PHPUnit\Framework\TestCase;

class ParameterCollectionTest extends TestCase
{

    public function testGetAnExistingKey()
    {
        $collection = new ParameterCollection([ 'param' => 'value' ]);
        $actual = $collection->get('param');
        $this->assertSame('value', $actual);
    }

    public function testGetANonExistingKey()
    {
        $collection = new ParameterCollection();
        $actual = $collection->get('param');
        $this->assertNull($actual);
    }

    public function testGetANewKey()
    {
        $collection = new ParameterCollection();
        $collection->add('param', 'value');
        $actual = $collection->get('param');
        $this->assertSame('value', $actual);
    }

    public function testGetAnUpdatedKey()
    {
        $collection = new ParameterCollection();
        $collection->add('param', 'value');
        $collection->add('param', 'updatedValue');
        $actual = $collection->get('param');
        $this->assertSame('updatedValue', $actual);
    }

}
