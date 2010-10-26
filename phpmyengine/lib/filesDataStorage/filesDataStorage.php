<?php

/**
 * filesDataStorage
 *
 * NoSQL file-based database
 *
 * @package filesDataStorage
 * @author Denis xmcdbx Safonov (mcdb@mcdb.ru)
 * @copyright Copyright (c) 2010 Denis xmcdbx Safonov
 * @version 0.0.2.1
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
namespace filesDataStorage;

/**
 *
 * Главный класс для работы filesDataStorage
 *
 * @package filesDataStorage
 * @author Denis xmcdbx Safonov (mcdb@mcdb.ru)
 * @copyright Copyright (c) 2010 Denis xmcdbx Safonov
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
class filesDataStorage {
    const version = '0.0.2.1';
    /**
     * Директория, в которой хранятся файлы хранилща
     *
     * @var string
     * @access private
     */
    private $folder;

    /**
     * Конструктор класса, принимает директорию-хранилище
     *
     * @param string $folder
     * @return bool     Возвращает true в случае, если директория доступна
     *                  и false, если нет
     */
    public function __construct ( $folder = null ) {
        if (null !== $folder) {
            return $this->setDS ( $folder );
        }
    }

    public function __toString () {
        return $this->folder;
    }

    /**
     * Устанавливает путь к хранилищу
     *
     * @param string $folder
     * @return bool     Возвращает true в случае, если директория доступна
     *                  и false, если нет
     * @throws Exception
     */
    public function setDS ( $folder ) {
        if (\substr ( $folder, -1 ) == '/') {
            $folder = \substr ( $folder, 0, -1 );
        }
        if (\file_exists ( $folder ) && \is_writable ( $folder ) && \is_dir ( $folder )) {
            $this->folder = $folder;
            return true;
        } else {
            throw new \Exception ( "Data storage folder not found or not writable" );
        }
        return false;
    }

    /**
     * Выбирает коллекцию
     *
     * @param string $collection
     * @return bool
     */
    public function selectCollection ( $collection ) {
        return new Collection ( $this, $collection );
    }

}

/**
 * Представляет коллекцию хранилища
 *
 * Имя коллекции может содержать символы латинского алфавита, цифры и знак _
 *
 * @package filesDataStorage
 * @author Denis xmcdbx Safonov (mcdb@mcdb.ru)
 * @copyright Copyright (c) 2010 Denis xmcdbx Safonov
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
class Collection {
    private $filesDS;
    private $collection;
    private $data;

    /**
     * Создаёт "подключение" к коллекции
     *
     * @param filesDataStorage $filesDS     экземпляр класса filesDataStorage
     * @param string $collection    название колекции
     * @return bool
     * @throws Exception
     */
    public function __construct ( filesDataStorage $filesDS, $collection ) {
        $this->filesDS = $filesDS;
        $folder = $filesDS . '/' . $collection . '/';
        if (false === \file_exists ( $folder )) {
            \mkdir ( $folder );
            \chmod ( $folder, 0777 );
        }
        if (\file_exists ( $folder ) && \is_writable ( $folder ) && \is_dir ( $folder )) {
            $this->collection = $folder;
            return true;
        } else {
            throw new \Exception ( "Collection folder not found,can't be created or not writeble" );
        }
        return false;
    }

    /**
     * Производит запись в хранилище
     *
     * @param array $data       данные для записи
     * @return bool
     */
    public function save ( Array $data ) {
        // Если не задан _id - создадим его
        if (false == (\key_exists ( '_id', $data ))) {
            $data['_id'] = \uniqid();
        }
        $filename = $this->collection . '/' . $data['_id'] . '.json';
        $data = \json_encode ( $data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP );
        if (($jsonErr = \json_last_error()) != \JSON_ERROR_NONE) {
            throw new \Exception ( "Error while saving data - {$jsonErr}" );
            return false;
        }
        return strlen ( $data ) == \file_put_contents ( $filename, $data );
    }

    /**
     * Удаляет файлы из хранилища
     *
     * @param array $filter
     * @return null
     */
    public function remove ( $filter ) {
        $records = $this->get ( $filter );
        for ($i = 0, $ca = count ( $records ); $i < $ca; $i++) {
            if (isset ( $records[$i]['_id'] )) {
                if (\file_exists ( $this->collection . '/' . $records[$i]['_id'] . '.json' )) {
                    \unlink ( $this->collection . '/' . $records[$i]['_id'] . '.json' );
                }
            }
        }
        return null;
    }

    /**
     *
     * Делает выборку по фильтру
     *
     * @param QueryFilter,serealized QueryFilter $queryFilter
     * @return array
     * @throws Execpiton
     */
    public function get ( $queryFilter ) {
        if (\is_string ( $queryFilter )) {
            $queryFilter = \unserialize ( \base64_decode ( $queryFilter ) );
            if (!$queryFilter instanceof QueryFilter) {
                throw new \Exception ( 'Bad request' );
                return false;
            }
        }
        $folder = $this->collection;
        \chdir ( $folder );
        $globFilter = null;
        $filterData = $queryFilter->getData ();
        if (\key_exists ( '_id', $filterData )) {
            $globFilter = (string) $filterData['_id'];
        }
        if ($globFilter == null) {
            $globFilter = '*';
        }
        $files = \glob ( $globFilter . '.json' );
        if (\count ( $files ) == 0) {
            return false;
        }
        unset ( $filterData['_id'] );
        foreach ($filterData as $key => $value) {
            if (\is_null ( $value )) {
                unset ( $filterData[$key] );
            }
        }
        $caData = \count ( $filterData );
        $this->data = array ();
        for ($i = 0, $ca = \count ( $files ); $i < $ca; $i++) {
            if ($caData == 0) {
                \array_push ( $this->data, \json_decode ( \file_get_contents ( $folder . $files[$i] ), true ) );
                if (($jsonErr = \json_last_error()) != \JSON_ERROR_NONE) {
                    throw new \Exception ( "Error while getting data - {$jsonErr}" );
                    return false;
                }
            } else {
                $recordContent = \file_get_contents ( $folder . $files[$i] );
                $record = \json_decode ( $recordContent );
                if (($jsonErr = \json_last_error()) != \JSON_ERROR_NONE) {
                    throw new \Exception ( "Error while getting data - {$jsonErr}" );
                    return false;
                }
                $dataCoincidence = 0;
                foreach ($record as $key => $value) {
                    if (isset ( $filterData[$key] )) {
                        $dataCoincidence += $this->checkData ( $filterData, $key, $value );
                    }
                    if (isset ( $filterData[$key] ) && \is_object ( $record->$key )) {
                        foreach ($value as $subkey => $subvalue) {
                            $dataCoincidence += $this->checkData ( (array) $filterData[$key], $subkey, $subvalue );
                        }
                    }
                }
                if ($dataCoincidence == $caData) {
                    \array_push ( $this->data, json_decode ( $recordContent, true ) );
                    if (($jsonErr = \json_last_error()) != \JSON_ERROR_NONE) {
                        throw new \Exception ( "Error while getting data - {$jsonErr}" );
                        return false;
                    }
                }
            }
        }
        // Сортировка выборки
        $this->sort ( $queryFilter );
        // Лимитирование выборки
        $this->limit ( $queryFilter );

        return $this->data;
    }

    /**
     * Вычисляет количество совпадений в выборке и фильтре
     *
     * @param array $filter
     * @param string $key
     * @param string $value
     * @return int  количество совпадений
     * @access private
     */
    private function checkData ( $filter, $key, $value ) {
        $dataCoincidence = 0;
        if (isset ( $filter[$key] )) {
            if (\is_array ( $filter[$key] )) {
                $op = key ( $filter[$key] );
                if ($op == QueryFilter::CMP_GTE && $value >= $filter[$key][$op]) {
                    $dataCoincidence++;
                }
                if ($op == QueryFilter::CMP_LTE && $value <= $filter[$key][$op]) {
                    $dataCoincidence++;
                }
                if ($op == QueryFilter::CMP_GT && $value > $filter[$key][$op]) {
                    $dataCoincidence++;
                }
                if ($op == QueryFilter::CMP_LT && $value < $filter[$key][$op]) {
                    $dataCoincidence++;
                }
                if ($op == QueryFilter::CMP_NOTEQUAL && $value != $filter[$key][$op]) {
                    $dataCoincidence++;
                }
                if ($op == QueryFilter::CMP_BETWEEN
                        && \is_array ( $filter[$key][$op] )
                        && count ( $filter[$key][$op] ) == 2
                        && $value > (int) $filter[$key][$op][0]
                        && $value < (int) $filter[$key][$op][1]) {
                    $dataCoincidence++;
                }
                if (($op == QueryFilter::CMP_IN || $op == QueryFilter::CMP_NOTIN ) && \is_array ( $filter[$key][$op] )) {
                    if (\is_array ( $value )) {
                        if (($op == QueryFilter::CMP_IN) == (count ( array_intersect ( $value, $filter[$key][$op] ) ) > 0)) {
                            $dataCoincidence++;
                        }
                    } else {
                        if (($op == QueryFilter::CMP_IN) == \in_array ( $value, $filter[$key][$op] )) {
                            $dataCoincidence++;
                        }
                    }
                }
                if ($op == QueryFilter::CMP_ALL && \is_array ( $filter[$key][$op] ) && \is_array ( $value )) {
                    if (count ( array_intersect ( $value, $filter[$key][$op] ) ) == count ( $filter[$key][$op] )) {
                        $dataCoincidence++;
                    }
                }
            } else if ((\is_array ( $value ) && \in_array ( $filter[$key], $value )) || $filter[$key] == $value) {
                $dataCoincidence++;
            }
        }
        return $dataCoincidence;
    }

    /**
     *
     * Производит сортировку выборки
     *
     * @param QueryFilter $queryFilter
     * @param array $this->data
     * @return array
     */
    private function sort ( QueryFilter $queryFilter ) {
        if ($queryFilter->getOrderDirection () != 0) {
            if ($queryFilter->getOrderDirection () != $queryFilter::ORDER_RAND) {
                if ($queryFilter->getOrderField () == '_id') {
                    if ($queryFilter->getOrderDirection () == $queryFilter::ORDER_ASC) {
                        sort ( $this->data );
                    }
                    if ($queryFilter->getOrderDirection () == $queryFilter::ORDER_DESC) {
                        rsort ( $this->data );
                    }
                } else {
                    usort ( $this->data, function ($a, $b) use ($queryFilter) {
                                $orderBy = $queryFilter->getOrderField ();
                                if (($pos = \strpos ( $orderBy, '.' ))) {
                                    $orderByParent = \substr ( $orderBy, 0, $pos );
                                    $orderByKinder = \substr ( $orderBy, ++$pos );
                                    unset ( $pos );
                                    $res = strcmp ( $a[$orderByParent][$orderByKinder], $b[$orderByParent][$orderByKinder] );
                                } else {
                                    if (isset ( $a[$orderBy] ) && isset ( $b[$orderBy] )) {
                                        if (\is_numeric ( $a[$orderBy] ) && \is_numeric ( $b[$orderBy] )) {
                                            $res = ($a[$orderBy] < $b[$orderBy]) ? -1 : 1;
                                        } else {
                                            $res = strcmp ( $a[$orderBy], $b[$orderBy] );
                                        }
                                    } else {
                                        $res = 0;
                                    }
                                }
                                if ($queryFilter->getOrderDirection () == $queryFilter::ORDER_DESC) {
                                    return $res * -1;
                                } else {
                                    return $res;
                                }
                            } );
                }
            } else {
                shuffle ( $this->data );
            }
        }
        return $this->data;
    }

    /**
     *
     * Лимитирует выборку
     *
     * @param QueryFilter $queryFilter
     * @return null
     */
    private function limit ( QueryFilter $queryFilter ) {
        if ($queryFilter->getLimit () > 0 || $queryFilter->getOffset () > 0) {
            if ($queryFilter->getLimit () == 0) {
                $limitt = null;
            }
            $this->data = \array_slice ( $this->data, $queryFilter->getOffset (), $queryFilter->getLimit () );
        }
        return null;
    }

}

/**
 * Класс фильтра запросов выборки
 *
 * @package filesDataStorage
 * @author Denis xmcdbx Safonov (mcdb@mcdb.ru)
 * @copyright Copyright (c) 2010 Denis xmcdbx Safonov
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 * 
 */
class QueryFilter {
    /*
     * Сортировка по убыванию
     */
    const ORDER_DESC = - 1;
    /*
     * Сортировка по возрастанию
     */
    const ORDER_ASC = 1;
    /*
     * Сортировка по воле случая
     */
    const ORDER_RAND = 2;
    /*
     * Сравнение: больше
     */
    const CMP_GT = '$gt';
    /*
     * Сравнение: меньше
     */
    const CMP_LT = '$lt';
    /*
     * Сравнение: больше или равно
     */
    const CMP_GTE = '$gte';
    /*
     * Сравнение: меньше или равно
     */
    const CMP_LTE = '$lte';
    /*
     * Сравнение: не равно
     */
    const CMP_NOTEQUAL = '$ne';
    /*
     * Сравнение: в массиве
     */
    const CMP_IN = '$in';
    /*
     * Сравнение: не в масиве
     */
    const CMP_NOTIN = '$nin';
    /*
     * Сравнение: в инетрвале
     */
    const CMP_BETWEEN = '$btw';
    /*
     * Сравнение: всё в массиве
     */
    const CMP_ALL = '$all';

    private $orderDirection = self::ORDER_ASC;
    private $orderField = '_id';
    private $limit;
    private $offset;
    private $data = array ();

    public function __toString () {
        return \base64_encode ( \serialize ( $this ) );
    }

    /**
     * Устанавливает порядок сортировки
     *
     * @param int $param    порядок сортировки:
     *                          -1 - по убыванию
     *                           1 - по возрастанию
     *                           2 - по воле случая, звёзд и богов Олимпа
     * @throws Exception
     */
    public function setOrderDirection ( $param ) {
        $param = (int) $param;
// просто люблю такой бред писать,
// кому не нравится, можете заменить на
// $param == 1 || $param == -1 || $param ==2
        if ($param != 0 && $param <= 2 && $param >= -1) {
            $this->orderDirection = $param;
        } else {
            throw new \Exception ( 'Unknown direction' );
        }
        return null;
    }

    /**
     * Устанавливает поле для сортировки
     *
     * @param string $param
     * @return null
     */
    public function setOrderField ( $param ) {
        $param = (string) $param;
        if (strlen ( $param ) > 0) {
            if (\strpos ( $param, '.' )) {
//TODO: разбор подпараметров
            } else {
                $this->orderField = $param;
            }
        } else {
            $this->orderField = '_id';
        }
        return null;
    }

    /**
     * Устанавливает значение смещения
     *
     * @param int $param
     * @return null
     */
    public function setOffset ( $param ) {
        $param = (int) $param;
        if ($param >= 0) {
            $this->offset = $param;
        }
        return null;
    }

    /**
     * Устанавливает ограничение на размер выборки
     *
     * @param int $param
     * @return null
     */
    public function setLimit ( $param ) {
        $param = (int) $param;
        if ($param >= 0) {
            $this->limit = $param;
        }
        return null;
    }

    /**
     * Устанавливает данные для запроса
     *
     * @param array $param
     * @return null
     */
    public function setData ( $param ) {
        if (\is_array ( $param )) {
            $this->data = $param;
        }
        return null;
    }

    /**
     * Возвращает направление сортировки
     *
     * @return int
     */
    public function getOrderDirection () {
        return $this->orderDirection;
    }

    /**
     * Возвращает поле сортировки
     *
     * @return string, array
     */
    public function getOrderField () {
        return $this->orderField;
    }

    /**
     * Возвращает ограничение выборки
     *
     * @return init
     */
    public function getLimit () {
        return $this->limit;
    }

    /**
     * Возвращает смещение выборки
     *
     * @return int
     */
    public function getOffset () {
        return $this->offset;
    }

    /**
     * Возвращает данные фильтра
     *
     * @return array
     */
    public function getData () {
        return $this->data;
    }

    static function compare ( $type, $args ) {
        if (isset ( $type )) {
            $allTypes = array (self::CMP_ALL, self::CMP_BETWEEN, self::CMP_GT, self::CMP_GTE,
                self::CMP_IN, self::CMP_LT, self::CMP_LTE, self::CMP_NOTEQUAL, self::CMP_NOTIN);
            if (!\in_array ( $type, $allTypes )) {
                throw new \Exception ( 'Unknown compare type' );
                return null;
            }
        }
        if (isset ( $args )) {
            switch ($type) {
                case self::CMP_GT:
                case self::CMP_LT:
                case self::CMP_GTE:
                case self::CMP_LTE:
                case self::CMP_NOTEQUAL: {
                        if (\func_num_args () !== 2) {
                            return false;
                        } else {
                            return array ($type => $args);
                        }
                        break;
                    }
                case self::CMP_BETWEEN: {
                        if (\func_num_args () !== 3) {
                            return false;
                        } else {
                            return array ($type => array ($args, \func_get_arg ( 2 )));
                        }
                        break;
                    }
                case self::CMP_IN:
                case self::CMP_NOTIN:
                case self::CMP_BETWEEN:
                case self::CMP_ALL: {
                        if (\func_num_args () !== 2 || false === \is_array ( $args )) {
                            return false;
                        } else {
                            return array ($type => (array) $args);
                        }
                        break;
                    }
            }
        }
        return null;
    }

}