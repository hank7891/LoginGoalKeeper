<?php

use Gatekeeper\Gatekeeper;

class GatekeeperTest extends \PHPUnit\Framework\TestCase
{
    protected $gateKeeper;

    protected function setUp()
    {
        $this->gateKeeper = new Gatekeeper('0987385482');
    }

    /**
     * 測試 資料審核
     * TODO 待實作
     */
    public function testCheck()
    {
        $gateKeeper = $this->gateKeeper;
        $this->assertEquals('0987385482', $gateKeeper->check());
    }

    /**
     * 測試 檢查綁定號碼格式
     */
    public function testCheckBindingFormat()
    {
        $this->assertEquals(true, Gatekeeper::checkBindingFormat('0987385482'));
    }

    /**
     * 測試 取得檢查碼
     * TODO 待實作
     */
    public function testGetCode()
    {
        $gateKeeper = $this->gateKeeper;
        $this->assertEquals(date('mdH'), $gateKeeper->getCode());
    }

    /**
     * 測試 建立帳號 Secret(密碼值)
     * 產生 14 碼
     */
    public function testCreateSecret()
    {
        $gateKeeper = $this->gateKeeper;
        $secret = $gateKeeper->createSecret();

        $this->assertEquals(14, strlen($secret));
    }

}
