<?php
namespace phpMyEngine\Picasa;

class Image {
    public $title;
    public $fullWidth, $fullHeight, $fullURL;
    public $thumbWidth, $thumbHeight, $thumbURL;
}

class Album {
    public $id;
    public $title;
    public $count;
    public $cover;
    public $url;
    public $images = array ();
}

class Picasa {
    public $user;
    public $thumbWidth = 144;
    public $fullWidth = 720;
    public $cacheTime = 10;

    public function __construct () {
        return null;
    }

    private function prepareLightweightPicasaAPIv3 () {
        $file = PATH_APPLICATION . '/lib/LightweightPicasaAPIv3/Picasa.php';
        if (file_exists ( $file )) {
            set_include_path ( get_include_path () . ':' . PATH_APPLICATION . '/lib/LightweightPicasaAPIv3' );
            include_once $file;
            return null;
        } else {
            return null;
        }
    }

    public function getImages ( $albumName, $forceReload = false ) {
        $_myCache = \phpMyEngine\Cache\Cache::getInstance ();
        $cacheKey = $this->user . $albumName;

        if (false === ($myImages = $_myCache->getValue ( $cacheKey ))) {
            $this->prepareLightweightPicasaAPIv3 ();
            $myImages = new Album();
            $picasa = new \Picasa();
            $allowedThumbs = array (32, 48, 64, 72, 104, 144, 150, 160);
            $allowedFull = array (94, 110, 128, 200, 220, 288, 320, 400, 512, 576, 640, 720, 800, 912, 1024, 1152, 1280, 1440, 1600);
            if ((int) $this->fullWidth == 0) {
                $this->fullWidth = 640;
            }
            $findNewValue = function(&$value, $array) {
                        $tmp = \array_flip ( $array );
                        $tmp[$value] = 100500;
                        ksort ( $tmp );
                        $tmp = \array_keys ( $tmp );
                        $need = \array_search ( $value, $tmp );
                        if ($value == end ( $tmp )) {
                            $value = prev ( $tmp );
                            return null;
                        }
                        if ($value == reset ( $tmp )) {
                            $value = next ( $tmp );
                            return null;
                        }
                        $value = $tmp[$need + 1] - $value < $value - $tmp[$need - 1] ? $tmp[$need + 1] : $tmp[$need - 1];
                        return null;
                    };
            if (false == \in_array ( $this->fullWidth, $allowedFull )) {
                $findNewValue ( $this->fullWidth, $allowedFull );
            }
            if (false == \in_array ( $this->thumbWidth, $allowedThumbs )) {
                $findNewValue ( $this->thumbWidth, $allowedThumbs );
            }
            try {
                $picasaAlbum = $picasa->getAlbumById ( $this->user, $albumName,
                                null, null, null, null,
                                "{$this->thumbWidth},{$this->fullWidth}" );

                $images = $picasaAlbum->getImages ();
                foreach ($images as $image) {
                    $thumbnails = $image->getThumbnails ();
                    $currentImage = new Image();
                    $currentImage->title = (string) $image->getDescription ();
                    $currentImage->fullWidth = (string) $thumbnails[1]->getWidth ();
                    $currentImage->fullHeight = (string) $thumbnails[1]->getHeight ();
                    $currentImage->fullURL = (string) $thumbnails[1]->getUrl ();
                    $currentImage->thumbWidth = (string) $thumbnails[0]->getWidth ();
                    $currentImage->thumbHeight = (string) $thumbnails[0]->getHeight ();
                    $currentImage->thumbURL = (string) $thumbnails[0]->getUrl ();
                    array_push ( $myImages->images, $currentImage );
                }
                unset ( $currentImage, $images, $picasa );
                $myImages->title = (string) $picasaAlbum->getTitle ();
                $myImages->cover = (string) $picasaAlbum->getIcon ();
                $myImages->count = count ( $myImages->images );
                $myImages->url = $albumName;
                unset ( $picasaAlbum );
                $_myCache->setValue ( $cacheKey,
                        \base64_encode ( \serialize ( $myImages ) ),
                        $this->cacheTime );
            } catch (\Exception $e) {
                return null;
            }
        } else {
            $myImages = unserialize ( \base64_decode ( $myImages ) );
        }
        return $myImages;
    }

    public function getAlbums ( $forceReload = false ) {
        $_myCache = \phpMyEngine\Cache\Cache::getInstance ();
        $cacheKey = 'albumlist_' . $this->user;
        if (false === ($myAlbums = $_myCache->getValue ( $cacheKey ))) {
            $this->prepareLightweightPicasaAPIv3 ();
            $picasa = new \Picasa();
            $albums = $picasa->getAlbumsByUsername ( $this->user )->getAlbums ();
            $myAlbums = array ();
            foreach ($albums as $album) {
                $myAlbum = new Album();

                /* $myAlbum->id = (string) str_replace ( "https://picasaweb.google.com/data/entry/api/user/{$this->user}/albumid/",
                  null, $album->getId () ); */
                $myAlbum->id = (string)$album->getIdnum ();
                $myAlbum->title = (string) $album->getTitle ();
                $myAlbum->cover = (string) $album->getIcon ();
                $myAlbum->url = substr ( $album->getWeblink (),
                        strrpos ( $album->getWeblink (), '/' ) + 1 );
                $myAlbum->count = (int) $album->getNumphotos ();
                $myAlbums[] = $myAlbum;
                unset ( $myAlbum );
            }
            unset ( $picasa, $albums );
            $_myCache->setValue ( $cacheKey,
                    \base64_encode ( \serialize ( $myAlbums ) ),
                    $this->cacheTime );
        } else {
            $myAlbums = unserialize ( \base64_decode ( $myAlbums ) );
        }
        return $myAlbums;
    }

}

