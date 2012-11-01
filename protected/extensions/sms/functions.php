<?php

    function _d($var, $label=null, $echo=true) {
        // format the label
        $label = ($label===null) ? '' : rtrim($label) . ' ';

        // var_dump the variable into a buffer and keep the output
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // neaten the newlines and indents
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        if (PHP_SAPI == 'cli') {
            $output = PHP_EOL . $label
                    . PHP_EOL . $output
                    . PHP_EOL;
        } else {
            if(!extension_loaded('xdebug'))
                $output = htmlspecialchars($output, ENT_QUOTES);
            $output = '<pre>'. $label. $output. '</pre>';
        }
        if ($echo)
            echo($output);
        return $output;
    }

    function arr($arr, $arr_key, $default_value=null) {
        if (is_array($arr) && isset($arr[$arr_key])) return $arr[$arr_key];
        return $default_value;
    }
    
