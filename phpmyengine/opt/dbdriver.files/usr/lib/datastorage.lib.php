<?php
namespace phpMyEngine\Database\Files;

class DataStorage {

    public function connect () {
        return true;
    }

    public function save ( $collection, Array $data ) {
        if (false == (\key_exists ( '_id', $data ))) {
            return false;
        }
        $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( '', 'var/storage' );
        $folder = $rp . $collection;
        if (false === \file_exists ( $folder )) {
            \mkdir ( $folder );
            \chmod ( $folder, 0777 );
        }
        $filename = $folder . '/' . $data['_id'] . '.json';
        $data = \json_encode ( $data );
        return strlen ( $data ) == \file_put_contents ( $filename, $data );
    }

    public function remove ( $collection, $data ) {
        $records = $this->get ( $collection, $data );
        $folder = \phpMyEngine\EngineFileSystem\getRealFilePath ( '', 'var/storage/' . $collection );
        for ($i = 0, $ca = count ( $records ); $i < $ca; $i++) {
            if (isset ( $records[$i]['_id'] )) {
                \unlink ( $folder . '/' . $records[$i]['_id'] . '.json' );
            }
        }
        return true;
    }

    public function get ( $collection, $data, $limit = 0, $offset = 0 ) {
        $folder = \phpMyEngine\EngineFileSystem\getRealFilePath ( '', 'var/storage/' . $collection );
        \chdir ( $folder );
        $filter = '*';
        if (\key_exists ( '_id', $data )) {
            $filter = (string) $data['_id'];
        }
        $files = \glob ( $filter . '.json' );
        if (\count ( $files ) == 0) {
            return false;
        }
        unset ( $data['_id'] );
        $caData = \count ( $data );
        $return = array ();
        for ($i = 0, $ca = \count ( $files ); $i < $ca; $i++) {
            if ($caData == 0) {
                \array_push ( $return, \json_decode ( \file_get_contents ( $folder . $files[$i] ), true ) );
            } else {
                $recordContent = \file_get_contents ( $folder . $files[$i] );
                $record = \json_decode ( $recordContent );
                $dataCoincidence = 0;
                foreach ($record as $key => $value) {
                    if (isset ( $data[$key] )) {
                        $dataCoincidence += $this->checkData ( $data, $key, $value );
                    }
                    if (\is_object ( $record->$key )) {
                        foreach ($value as $subkey => $subvalue) {
                            $dataCoincidence += $this->checkData ( $data[$key], $subkey, $subvalue );
                        }
                    }
                }
                if ($dataCoincidence == $caData) {
                    \array_push ( $return, json_decode ( $recordContent, true ) );
                }
            }
        }
        if ($limit > 0 || $offset > 0) {
            if ($limit == 0) {
                $limitt = null;
            }
            $return = \array_slice ( $return, $offset, $limit );
        }
        return $return;
    }

    private function checkData ( $data, $key, $value ) {
        $dataCoincidence = 0;
        if (\is_array ( $data[$key] )) {
            $op = key ( $data[$key] );
            if ($op == '$gte' && $value >= $data[$key][$op]) {
                $dataCoincidence++;
            }
            if ($op == '$lte' && $value <= $data[$key][$op]) {
                $dataCoincidence++;
            }
            if ($op == '$gt' && $value > $data[$key][$op]) {
                $dataCoincidence++;
            }
            if ($op == '$lt' && $value < $data[$key][$op]) {
                $dataCoincidence++;
            }
            if ($op == '$ne' && $value != $data[$key][$op]) {
                $dataCoincidence++;
            }
            if ($op == '$btw'
                    && \is_array ( $data[$key][$op] )
                    && count ( $data[$key][$op] ) == 2
                    && $value > (int) $data[$key][$op][0]
                    && $value < (int) $data[$key][$op][1]) {
                $dataCoincidence++;
            }
            if (($op == '$in' || $op == '$nin' ) && \is_array ( $data[$key][$op] )) {
                if (\is_array ( $value )) {
                    if (($op == '$in') == (count ( array_intersect ( $value, $data[$key][$op] ) ) > 0)) {
                        $dataCoincidence++;
                    }
                } else {
                    if (($op == '$in') == \in_array ( $value, $data[$key][$op] )) {
                        $dataCoincidence++;
                    }
                }
            }
            if ($op == '$all' && \is_array ( $data[$key][$op] ) && \is_array ( $value )) {
                if (count ( array_intersect ( $value, $data[$key][$op] ) ) == count ( $data[$key][$op] )) {
                    $dataCoincidence++;
                }
            }
        } else if ((\is_array ( $value ) && \in_array ( $data[$key], $value )) || $data[$key] == $value) {
            $dataCoincidence++;
        }
        return $dataCoincidence;
    }

}

