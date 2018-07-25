<?php

namespace Gatekeeper;

use Exception;

class Gatekeeper
{
    /**
     * 綁定號碼
     * @var
     */
    protected $bindingNumber;

    public function __construct($bindingNumber)
    {
        if (!self::checkBindingFormat($bindingNumber)) {
            throw new Exception("綁定號碼格式錯誤", 1);
        }

        $this->bindingNumber = $bindingNumber;
    }

    /**
     * TODO 待實作
     * @return mixed
     */
    public function check()
    {
        return $this->bindingNumber;
    }

    /**
     * 取得驗證碼 TODO 待實作
     * @return false|string
     */
    public function getCode()
    {
        return date('mdH');
    }

    /**
     * 建立帳號對應 唯一金耀
     *
     * @return int
     */
    public function createSecret()
    {
        return 12345;
    }

    /**
     * 檢測綁定號碼格式
     *
     * @param $testedNumber
     *
     * @return int
     */
    public static function checkBindingFormat($testedNumber)
    {
        $format = '/^0\d{9}$/';

        return (preg_match($format, $testedNumber));
    }
}
