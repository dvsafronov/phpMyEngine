<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace phpMyEngine\Modules\Tags;

function getCloud ($mutagen) {
    $myFilter = new \phpMyEngine\Records\Filter();
    $myFilter->status = \phpMyEngine\Records\Record::STATUS_OK;
    $myFilter->fields = array ('tags');
    $myFilter->mutagenType = $mutagen;
    $listTags = $myFilter->getRecords ();
    $tags = null;
    $tagsCount = null;
    for ($i = 0; $i < $listTags->count; $i++) {
        $caTags = count ( $listTags->records[$i]->tags );
        if (is_array ( $listTags->records[$i]->tags ) && $caTags > 0) {
            $tags .= implode ( ",", $listTags->records[$i]->tags ) . ',';
            $tagsCount += $caTags;
        }
    }
    unset ( $myFilter, $listTags );
    $tags = explode ( ',', $tags );
    array_pop ( $tags );
    $maxScore = 0;
    $cloud = array ();
    foreach ($tags as $tag) {
        if (key_exists ( $tag, $cloud )) {
            $cloud[$tag]++;
        } else {
            $cloud[$tag] = 1;
        }
        if ($maxScore < $cloud[$tag]) {
            $maxScore = $cloud[$tag];
        }
    }
    \array_walk ( $cloud, function (&$item, $key, $maxScore) {
                $item = (int) (round ( $item / $maxScore, 1 ) * 100);
                return null;
            }, $maxScore );
    unset ( $tags );
    return $cloud;
}
