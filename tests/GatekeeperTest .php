<?php

use Gatekeeper\Gatekeeper;

class GatekeeperTest extends \PHPUnit\Framework\TestCase
{
    public function testCheck()
    {
        $gateKeeper = new Gatekeeper();
        $this->assertEquals(true,$gateKeeper->check());
    }
}
