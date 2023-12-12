<?php
declare (strict_types=1);

if (!function_exists('halts')) {
    /**
     * 调试变量并且中断输出
     * @param mixed $vars 调试变量或者信息
     */
    function halts(...$vars)
    {
        dumps(...$vars);
        exit;
        //throw new HttpResponseException()
    }
}


if (!function_exists('dumps')) {
    /**
     * 浏览器友好的变量输出
     * @param mixed $vars 要输出的变量
     * @return void
     */
    function dumps(...$vars)
    {
        ob_start();
        var_dump(...$vars);

        $output = ob_get_clean();
        $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);

        if (PHP_SAPI == 'cli') {
            $output = PHP_EOL . $output . PHP_EOL;
        } else {
            if (!extension_loaded('xdebug')) {
                $output = htmlspecialchars($output, ENT_SUBSTITUTE);
            }
            $output = '<pre>' . $output . '</pre>';
        }

        echo $output;
    }
}



if (!function_exists('shows')) {
    /**
     * 显示html居中
     * @param $title
     * @param string $intro
     */
    function shows($title, $intro = '')
    {
        $htmls = [];
        $htmls[] = '<div style="padding: 2rem;font-size: x-large" align="center">';
        $htmls[] = sprintf('<h1>%s</h1>', $title);
        if ($intro) {
            $htmls[] = sprintf('<h4 style="padding: 1rem;color: grey">%s</h4>', $intro);
        }
        $htmls[] = '</div>';
        exit(join("\n", $htmls));
    }
}


if (!function_exists('rests')) {
    /**
     * json 响应
     * @param int $code
     * @param null $data
     * @param null $option
     */
    function rests(int $code, $data = null, $option = null)
    {
        $code = $data === false ? 404 : $code;//halts(func_get_args());
        $msg = is_string($data) ? $data : (is_string($option) ? $option : sprintf('http-%d', $code));
        if ((is_array($data) and isset($data[0])) or (is_array($data) and !sizeof($data))) {
            $data = ['list' => $data];
        } elseif (empty($data) or $data === true or is_string($data)) {
            $data = new \stdClass();//as object
        }
        //http code as same as json code value
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode(['code' => $code, 'msg' => $msg, 'data' => $data, 'rid' => uniqid(sprintf('v202312-%.4f-', microtime(true)))]));
    }
}