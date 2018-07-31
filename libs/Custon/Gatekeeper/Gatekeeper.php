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
    protected $secret;

    const SECRET_LENGTH = 14;

    public function __construct($bindingNumber)
    {
        if (!self::checkBindingFormat($bindingNumber)) {
            throw new Exception("綁定號碼格式錯誤", 1);
        }

        $this->bindingNumber = $bindingNumber;
    }

    /**
     * 輸入帳號唯一金鑰
     *
     * @param $secret
     *
     * @throws Exception
     */
    public function setSecret($secret)
    {
        if (!$this->checkSetSecret($secret)) {
            throw new Exception("綁定金耀設置錯誤", 1);
        }

        $this->secret = $secret;
    }

    /**
     * 取得帳號唯一金鑰
     *
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }


    /**
     * 確認輸入帳號金鑰正確性
     *
     * @param $secret
     *
     * @return bool
     */
    protected function checkSetSecret($secret)
    {
        if (!$this->chkSecretFormat($secret)) {
            return false;
        }

        if (!$this->isBindingNumberSecret($secret)) {
            return false;
        }

        return true;
    }

    /**
     * 確認金鑰所屬號碼
     *
     * @param $secret
     *
     * @return bool
     */
    protected function isBindingNumberSecret($secret)
    {
        $secretAry = preg_split('//', $secret, -1, PREG_SPLIT_NO_EMPTY);
        unset($secretAry[1]);
        unset($secretAry[3]);
        unset($secretAry[5]);
        unset($secretAry[7]);
        krsort($secretAry);

        if ($this->bindingNumber != implode('', $secretAry)) {
            return false;
        }

        return true;
    }

    /**
     * 確認金鑰格式
     *
     * @param $secret
     *
     * @return bool
     */
    protected function chkSecretFormat($secret)
    {
        $format = '/\d{' . self::SECRET_LENGTH .  '}$/';
        if (!preg_match($format, $secret)) {
            return false;
        }

        return true;
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
     * 建立新的帳號對應 唯一金耀
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
