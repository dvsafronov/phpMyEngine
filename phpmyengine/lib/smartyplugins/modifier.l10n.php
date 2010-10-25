<?php

/* function smarty_block_l10n ( $params, $content, $smarty, &$repeat, $template ) {
  if (!$repeat) {
  if (key_exists ( 'file', $params )) {
  $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( $params['file'] . '.mo', 'usr/locale/ru_RU/LC_MESSAGES' );
  $locDir = dirname ( dirname ( dirname ( $rp ) ) );
  \bindtextdomain ( $params['file'], $locDir );
  }
  return dgettext ( $params['file'], $content );
  } else {
  return null;
  }
  } */

function smarty_modifier_l10n ( $text, $domain = 'default' ) {
    return \phpMyEngine\l10n\_ ( $text, $domain );
}
