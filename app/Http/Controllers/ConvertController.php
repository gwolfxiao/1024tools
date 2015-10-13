<?php

namespace App\Http\Controllers;

use Log;
use View;
use Input;
use lessc;
use Exception;

class ConvertController extends Controller
{
    private $base64Encoding = ['UTF-8', 'GB18030', 'GBK', 'GB2312', 'BIG-5', 'ASCII',
        'Windows-1251', 'Windows-1252', 'Windows-1254',
        'ISO-8859-1', 'ISO-8859-2', 'ISO-8859-3', 'ISO-8859-4',
        'ISO-8859-5', 'ISO-8859-6', 'ISO-8859-7', 'ISO-8859-8', 'ISO-8859-9',
        'ISO-8859-10', 'ISO-8859-13', 'ISO-8859-14', 'ISO-8859-15', 'ISO-8859-16',
        'CP51932', 'CP932', 'CP936', 'CP866', 'CP850',
        'CP50220', 'CP50221', 'CP50222', ];

    public function getUrlencode()
    {
        return View::make('convert.urlencode');
    }

    public function postUrlencode()
    {
        $input = Input::only('query', 'type', 'method');
        $rules = array(
            'query' => 'required',
            'type' => 'required|in:decode,encode',
            'method' => 'required|in:urlencode,rawurlencode',
        );
        $this->validate($input, $rules);
        extract($input);
        $result = explode("\n", $query);
        $functionTable = array(
            'urlencode' => array('decode' => 'urldecode', 'encode' => 'urlencode'),
            'rawurlencode' => array('decode' => 'rawurldecode', 'encode' => 'rawurlencode'),
        );
        array_walk($result, function (&$v, $k) use ($type, $method, $functionTable) {
            $v = $functionTable[$method][$type]($v);});

        return $this->success($result);
    }

    public function getXmlJson()
    {
        return View::make('convert.xmljson');
    }

    public function getBase64()
    {
        $query = Input::get('q');
        $encoding = $this->base64Encoding;

        return View::make('convert.base64', compact('query', 'encoding'));
    }

    public function postBase64()
    {
        $data = Input::only('query', 'type', 'encoding');
        $rules = [
            'query' => 'required',
            'type' => 'required|in:decode,encode',
            'encoding' => 'required',
        ];
        $this->validate($data, $rules);
        if (!in_array($data['encoding'], $this->base64Encoding)) {
            return $this->error('encoding unsupported');
        }
        extract($data);
        if ($type == 'encode') {
            try {
                $query = iconv('UTF-8', $encoding, $query);
                $result = base64_encode($query);

                return $this->success($result);
            } catch (Exception $e) {
                return $this->error('查询字符串包含'.$encoding.'编码外的字符，请检查所选编码');
            }
        } else {
            if (preg_match("/^[\w\+\/\=]+$/", $query)) {
                $query = iconv('UTF-8', $encoding, $query);
                $result = base64_decode($query);
                try {
                    $result = iconv($encoding, 'UTF-8', $result);

                    return $this->success($result);
                } catch (Exception $e) {
                    return $this->error('不能解码转换为合法的'.$encoding.'字符串，请检查编码和查询字符串');
                }
            } else {
                return $this->error('格式错误');
            }
        }
    }

    public function getLess()
    {
        return View::make('convert.less');
    }

    public function postLess()
    {
        $query = Input::get('query');
        try {
            $less = new lessc();
            $result = $less->compile($query);
        } catch (Exception $e) {
            Log::error($e);

            return $this->error($e->getMessage());
        }

        return $this->success($result);
    }

    public function getMarkdown()
    {
        return View::make('convert.markdown');
    }

    public function getTimestamp()
    {
        return View::make('convert.timestamp');
    }
}
