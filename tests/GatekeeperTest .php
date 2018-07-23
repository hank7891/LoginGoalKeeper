<?php

use Gatekeeper\Gatekeeper;

class GatekeeperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * 測試 資料審核
     * TODO 待實作
     */
    public function testCheck()
    {
        $gateKeeper = new Gatekeeper('0987385482');
        $this->assertEquals('0987385482',$gateKeeper->check());
    }

    /**
     * 測試 檢查綁定號碼格式
     */
    public function testCheckBindingFormat()
    {
        $this->assertEquals(true, Gatekeeper::checkBindingFormat('0987385482'));
    }
}
