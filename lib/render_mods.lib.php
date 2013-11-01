<?php

namespace phpMyEngine\Render\Mods;

function sitelinkMod($data) {
    return '/'.$data;
}

function l10nMod($data, $domain = 'default') {
    return \phpMyEngine\l10n\_($data, $domain);
}

function cutMod($data, $href = null, $text = "...&rarr;") {
    if (false !== ($cutpos = \strpos($data, '[!-CUT-!]'))) {
        $data = \substr($data, 0, $cutpos);
        $data .= "<a href=\"{$href}\">{$text}</a>";
    }
    return $data;
}

function cutcutMod($data) {
    return \str_replace('[!-CUT-!]', null, $data);
}

function cplinkMod($link) {
    $_myConfig = \phpMyEngine\Config\Config::getInstance();
    if ($link == '/') {
        $link = $_myConfig->engine->controlPanel->URI.'/';
    } else {
        $link = $_myConfig->engine->controlPanel->URI.'/'.$link;
    }
    return $link;
}

function bbcodeMod($cont) {
    if (\extension_loaded('bbcode')) {
        $arrayBBCode = array(
            '' => array('type' => BBCODE_TYPE_ROOT, 'childs' => '!i'),
            'i' => array('type' => BBCODE_TYPE_NOARG, 'open_tag' => '<i>',
                'close_tag' => '</i>', 'childs' => 'b'),
            'url' => array('type' => BBCODE_TYPE_OPTARG,
                'open_tag' => '<a href="{PARAM}">', 'close_tag' => '</a>',
                'default_arg' => '{CONTENT}',
                'childs' => 'b,i'),
            'img' => array('type' => BBCODE_TYPE_NOARG,
                'open_tag' => '<img src="', 'close_tag' => '" />',
                'childs' => ''),
            'b' => array('type' => BBCODE_TYPE_NOARG, 'open_tag' => '<b>',
                'close_tag' => '</b>'),
            'h1' => array('type' => BBCODE_TYPE_NOARG, 'open_tag' => '<h3>',
                'close_tag' => '</h3>'),
        );
        $BBHandler = bbcode_create($arrayBBCode);
        return bbcode_parse($BBHandler, $cont);
    } else {
        \phpMyEngine\logError("BBCode PHP-extension is not loaded");
    }
    return $cont;
}

function escapeMod($cont) {
    return htmlspecialchars($cont);
}

function nl2brMod($cont) {
    return nl2br($cont);
}

function numToWordMod($num, $words) {

    $num = $num % 100;

    if ($num > 19) {
        $num = $num % 10;
    }

    switch ($num) {

        case 1:
        {
            return ($words[0]);
        }

        case 2:
        case 3:
        case 4:
        {
            return ($words[1]);
        }

        default:
            {
            return ($words[2]);
            }

    }

}

function timestampMod($time) {
    $result = $time;
    $curTime = time();
    $input = $output = [];
    $input['date'] = date('Ymd', $time);
    $input['time'] = date('H:i', $time);

    if (($diff = $curTime - $time) < 10801) {
        if ($diff == 0) {
            $result = 'только что';
        } else {
            if ($diff < 60 && $diff > 0) {
                $result = ($diff > 1 ? $diff : '').' '.numToWordMod($diff, ['секунду', 'секунды', 'секунд']).' назад';
            } else {
                if ($diff == 60) {
                    $result = 'минуту назад';
                } else {
                    if ($diff < 3600) {
                        $result = ceil($diff / 60);
                        $result = ($result > 1 ? $result : '').' '.numToWordMod($result, ['минуту', 'минуты', 'минут']).' назад';
                    } else {
                        if ($diff > 3600) {
                            $h = floor($diff / 3600);
                            $m = floor(($diff - (3600 * $h)) / 60);
                            $result = $h.' '.numToWordMod($h, ['час', 'часа', 'часов']);
                            if ($m > 0) {
                                $result .= ' '.$m.' '.numToWordMod($m, ['минуту', 'минуты', 'минут']);
                            }
                            $result .= ' назад';
                        }
                    }
                }
            }
        }
    } else {
        $today = date('Ymd', $curTime);
        $yesterday = date('Ymd', strtotime('yesterday', $curTime));

        $output['date'] = $input['date'] == $today
            ? 'сегодня'
            : ($input['date'] == $yesterday ? 'вчера' : date('d.m.Y', $time));

        $result = $output['date'].' в '.$input['time'];
    }
    return $result;
}