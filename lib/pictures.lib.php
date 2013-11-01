<?php
/**
 * Библиотека работы с изображениями: фото, аватарки, галереи.
 *
 * @package phpMyEngine
 * @author Denis Safonov
 * @copyright Copyright (c) 2013
 * @version 2013-08-16 15:41
 *
 */
namespace phpMyEngine\Pictures;

use \phpMyEngine\Config\Config;
use \phpMyEngine\Exception;

/**
 * @const int BAD_MIME_TYPE - Плохой MIME-тип
 */
const BAD_MIME_TYPE = 1;
/**
 * @const int NOT_SAVED - Изображение не сохранено
 */
const NOT_SAVED = 2;
/**
 * @const int IMAGE_TOO_SMALL - Загружаемый файл слишком мал
 */
const IMAGE_TOO_SMALL = 3;
/**
 * @const int IMAGE_TOO_BIG - Загружаемый файл слишком велик
 */
const IMAGE_TOO_BIG = 4;
/**
 * Наносит водяной знак на изображение.
 *
 * TODO: Брать путь к "водяному знаку" из конфига.
 *
 * @author Где-то стырено.
 * @author Denis Safronov
 *
 * @param $file
 * @param int $padding
 * @param int $opacity
 * @return bool
 */
function drawWatermark($file, $padding = 0, $opacity = 1) {
    $_myConfig = Config::getInstance();

    $image = new \Imagick($file);
    $watermark = new \Imagick($_SERVER['DOCUMENT_ROOT'].'/cult-affiche/img/watermark/ca.png');

    // Check if the watermark is bigger than the image
    $image_width = $image->getImageWidth();
    $image_height = $image->getImageHeight();
    $watermark_width = $watermark->getImageWidth();
    $watermark_height = $watermark->getImageHeight();

    if ($image_width < $watermark_width + $padding || $image_height < $watermark_height + $padding) {
        return false;
    }
    // Calculate each position
    $positions = array();
    $positions[] = array(0 + $padding, 0 + $padding);
    $positions[] = array($image_width - $watermark_width - $padding, 0 + $padding);
    $positions[] = array($image_width - $watermark_width - $padding, $image_height - $watermark_height - $padding);
    $positions[] = array(0 + $padding, $image_height - $watermark_height - $padding);
    // Initialization
    $min = null;
    $min_colors = 0;
    // Calculate the number of colors inside each region and retrieve the minimum
    foreach ($positions as $position) {
        $colors = $image->getImageRegion(
            $watermark_width, $watermark_height, $position[0], $position[1])->getImageColors();
        if ($min === null || $colors <= $min_colors) {
            $min = $position;
            $min_colors = $colors;
        }
    }
    // Draw the watermark
    //$watermark->setImageOpacity($opacity);
    $image->compositeImage(
        $watermark, \Imagick::COMPOSITE_OVER, $min[0], $min[1]);
    $image->writeimage();
    $image->destroy();
    $watermark->destroy();
    return true;
}

/**
 * Возвращает основную часть URL к изображению
 * по идентификатору пользователя.
 *
 * @param int $iUserID
 * @return string
 */
function getCommonURLByUserID($iUserID) {
    $_myConfig = Config::getInstance();
    $sPathToSave = '';
    if ($_myConfig->upload->type == 'local') {
        $sPathToSave = $_myConfig->upload->path{1} == '/' ? $_myConfig->upload->path : '//'.$_SERVER['HTTP_HOST'].'/'.$_myConfig->upload->path;
    } else {
        if ($_myConfig->upload->type == 'cloud') {
            $sPathToSave = $_myConfig->upload->url;
        }
    }
    $sPathToSave .= \phpMyEngine\getCreationTimeByID($iUserID,'Y/z');
    return $sPathToSave;
}

/**
 * Возвращает основную часть пути к изображению
 * по идентификатору пользователя.
 *
 * @param int $iUserID
 * @return string
 */

function getCommonPathByUserID($iUserID) {
    $_myConfig = Config::getInstance();
    $sPathToSave = '';
    if ($_myConfig->upload->type == 'local') {
        $sPathToSave = $_myConfig->upload->path{1} == '/' ? $_myConfig->upload->path : $_SERVER['DOCUMENT_ROOT'].'/'.$_myConfig->upload->path;
    }
    $sPathToSave .= \phpMyEngine\getCreationTimeByID($iUserID, 'Y/z');
    return $sPathToSave;
}

/**
 * Сохраняет аватары пользователя.
 *
 * @param int $iUserID - идентификатор пользователя
 * @param string $sOriginalAvatar - путь к оригинальному аватару (например из массива $_FILES)
 * @return string - имя файла, после общей части пути.
 * @throws \phpMyEngine\Exception
 */

function saveUserAvatarFiles($iUserID, $sOriginalAvatar) {
    $aSizes = [24, 48, 64, 100];
    $aMimeTypesExt = ['image/jpeg' => '.jpg', 'image/png' => '.png', 'image/gif' => '.gif'];

    $sPathToSave = getCommonPathByUserID($iUserID);

    $sPathAvatars = $sPathToSave.'/a/';

    if (file_exists($sPathAvatars) == false) {
        mkdir($sPathAvatars, 0777, true);
    }

    $sImageType = mime_content_type($sOriginalAvatar);

    if (false === array_key_exists($sImageType, $aMimeTypesExt)) {
        throw new Exception(Exception::TYPE_ERROR, BAD_MIME_TYPE);
    }

    $sPostFix = '_'.uniqid().$aMimeTypesExt[$sImageType];

    $oImage = new \Imagick($sOriginalAvatar);

    if ($oImage->getimagewidth() < max($aSizes) || $oImage->getimageheight() < max($aSizes)) {
        $oImage->destroy();
        throw new Exception(Exception::TYPE_ERROR, IMAGE_TOO_SMALL);
    }
    if ($oImage->getimagewidth() > 4096 || $oImage->getimageheight() > 4096) {
        $oImage->destroy();
        throw new Exception(Exception::TYPE_ERROR, IMAGE_TOO_BIG);
    }

    $iImageRatio = $oImage->getimagewidth() / $oImage->getimageheight();


    $iOldWidth = $oImage->getimagewidth();
    foreach ($aSizes as $iSize) {
        $oNewImage = clone $oImage;
        $iCropX = $iCropY = $iScaleWidth = $iScaleHeight = 0;
        if ($iImageRatio < 1) {
            $iScaleWidth = $iSize;
            $iScaleHeight = ceil($iSize / $iImageRatio);
            $iCropY = ceil(($iScaleHeight - $iScaleWidth) / 2);
        } elseif ($iImageRatio > 1) {
            $iScaleWidth = ceil($iOldWidth / ($iOldWidth / $iSize) * $iImageRatio);
            $iScaleHeight = $iSize;
            $iCropX = ceil(($iScaleWidth - $iScaleHeight) / 2);
        } else {
            $iScaleHeight = $iScaleWidth = $iSize;
        }
        $oNewImage->scaleimage($iScaleWidth, $iScaleHeight, 1);
        if ($iCropX > 0 || $iCropY > 0) {
            $oNewImage->cropimage($iSize, $iSize, $iCropX, $iCropY);
        }
        if (true !== $oNewImage->writeimage($sPathAvatars.'a_'.((string) $iSize).'_'.$iUserID.$sPostFix)) {
            $oNewImage->destroy();
            unset($oNewImage);
            throw new Exception(Exception::TYPE_ERROR, NOT_SAVED);
        }
        $oNewImage->destroy();
        unset($oNewImage);
    }
    $oImage->destroy();
    unlink($sOriginalAvatar);
    return $sPostFix;
}

/**
 * Удаляет аватары пользователя.
 *
 * @param int $iUserID - идентификатор пользователя
 * @param array $aAvatars - массив аватар к удалению (названия файлов, без общего пути)
 * @return null
 */

function deleteUserAvatarFiles($iUserID, $aAvatars) {
    foreach ((array) $aAvatars as $file) {
        if (file_exists(str_replace(getCommonURLByUserID($iUserID), getCommonPathByUserID($iUserID), $file))) {
            unlink(str_replace(getCommonURLByUserID($iUserID), getCommonPathByUserID($iUserID), $file));
        }
    }
    return null;
}

/**
 * Сохраняет фотографию пользователя.
 *
 * @param int $iUserID - идентификатор пользователя
 * @param string $sOriginalPhoto - путь к оригинальному аватару (например из массива $_FILES)
 * @return string - имя файла, после общей части пути.
 * @throws \phpMyEngine\Exception
 */

function saveUserPhotoFiles($iUserID, $sOriginalPhoto) {
    $aSizes = [200, 640];
    $aMimeTypesExt = ['image/jpeg' => '.jpg', 'image/png' => '.png'];

    $sPathToSave = getCommonPathByUserID($iUserID);

    $sPathPhotos = $sPathToSave.'/f/';
    if (file_exists($sPathPhotos) == false) {
        mkdir($sPathPhotos, 0777, true);
    }

    $sImageType = mime_content_type($sOriginalPhoto);

    if (false === array_key_exists($sImageType, $aMimeTypesExt)) {
        throw new Exception(Exception::TYPE_ERROR, BAD_MIME_TYPE);
    }

    $sPostFix = '_'.uniqid().$aMimeTypesExt[$sImageType];

    $oImage = new \Imagick($sOriginalPhoto);

    if ($oImage->getimagewidth() < max($aSizes) || $oImage->getimageheight() < max($aSizes)) {
        $oImage->destroy();
        throw new Exception(Exception::TYPE_ERROR, IMAGE_TOO_SMALL);
    }
    if ($oImage->getimagewidth() > 4096 || $oImage->getimageheight() > 4096) {
        $oImage->destroy();
        throw new Exception(Exception::TYPE_ERROR, IMAGE_TOO_BIG);
    }

    $iOldWidth = $oImage->getimagewidth();


    foreach ($aSizes as $iSize) {
        $oNewImage = clone $oImage;
        $iScaleHeight = $oNewImage->getimageheight() / ($iOldWidth / $iSize);
        $oNewImage->scaleimage($iSize, $iScaleHeight, 1);
        if (true !== $oNewImage->writeimage($sPathPhotos.'f_'.((string) $iSize).'_'.$iUserID.$sPostFix)) {
            $oNewImage->destroy();
            unset($oNewImage);
            throw new Exception(Exception::TYPE_ERROR, NOT_SAVED);
        }
        $oNewImage->destroy();
        unset($oNewImage);
    }

    $oImage->destroy();
    unlink($sOriginalPhoto);

    drawWatermark($sPathPhotos.'f_640_'.$iUserID.$sPostFix);

    return $sPostFix;
}

/**
 * Удаляет фотографии пользователя.
 *
 * @param int $iUserID - идентификатор пользователя
 * @param array $aPhotos - массив фото к удалению (названия файлов, без общего пути)
 * @return null
 */
function deleteUserPhotoFiles($iUserID, $aPhotos) {
    foreach ((array) $aPhotos as $file) {
        if (file_exists(str_replace(getCommonURLByUserID($iUserID), getCommonPathByUserID($iUserID), $file))) {
            unlink(str_replace(getCommonURLByUserID($iUserID), getCommonPathByUserID($iUserID), $file));
        }
    }
    return null;
}

/**
 * @param $iID
 * @param $mutagen
 * @param $picType
 * @param null $size
 * @return string
 */
function getPicturePathByID($iID, $mutagen, $picType, $size = null) {
    $_myConfig = Config::getInstance();
    $sPathToSave = '';
    if ($_myConfig->upload->type == 'local') {
        $sPathToSave = $_myConfig->upload->path{1} == '/'
            ? $_myConfig->upload->path
            : $_SERVER['DOCUMENT_ROOT'].'/'.$_myConfig->upload->path;
    }
    $picType = $picType{0};
    $sPathToSave .= \phpMyEngine\getCreationTimeByID($iID, 'Y/z').'/'.$mutagen.'/'.$picType;
    if ($size) {
        $sPathToSave .= '/'.$picType.'_'.$size.'_'.$iID;
    }
    return $sPathToSave;
}

/**
 * @param $iID
 * @param $mutagen
 * @param $picType
 * @param null $size
 * @return string
 */
function getPictureURLByID($iID, $mutagen, $picType, $size = null) {
    $_myConfig = Config::getInstance();
    $sPathToSave = '';
    if ($_myConfig->upload->type == 'local') {
        $sPathToSave = $_myConfig->upload->path{1} == '/' ? $_myConfig->upload->path : '//'.$_SERVER['HTTP_HOST'].'/'.$_myConfig->upload->path;
    } else {
        if ($_myConfig->upload->type == 'cloud') {
            $sPathToSave = $_myConfig->upload->url;
        }
    }
    $picType = $picType{0};
    $sPathToSave .= \phpMyEngine\getCreationTimeByID($iID, 'Y/z').'/'.$mutagen.'/'.$picType;
    if ($size) {
        $sPathToSave .= '/'.$picType.'_'.$size.'_'.$iID;
    }
    return $sPathToSave;
}

/**
 * Возвращает массив пустых аватар.
 *
 * TODO: Перенести в конфиг!
 *
 * @return array - пустные аватары, [{размер} => {путь}]
 */
function getEmptyAvatar() {
    return [24 => '/cult-affiche/img/empty/avatar_100.png',
        48 => '/cult-affiche/img/empty/avatar_100.png',
        64 => '/cult-affiche/img/empty/avatar_100.png',
        100 => '/cult-affiche/img/empty/avatar_100.png',
        200 => '/cult-affiche/img/empty/avatar_100.png'
    ];
}
