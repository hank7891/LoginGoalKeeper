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
     * 建立隨機 4 碼 + 綁定碼(手機號碼)組成 Secret
     *
     * @return int
     */
    public function createSecret()
    {
        $secret = null;

        $randomIntAry = preg_split('//', random_int('0000', '9999'), -1, PREG_SPLIT_NO_EMPTY);

        $bindingNumberAry = preg_split('//', $this->bindingNumber, -1, PREG_SPLIT_NO_EMPTY);
        krsort($bindingNumberAry);

        $count = 0;
        foreach ($bindingNumberAry as $value) {
            $randomInt = (isset($randomIntAry[$count])) ? $randomIntAry[$count] : '';
            $secret .= $value . $randomInt;
            $count ++;
        }

        return $secret;
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
