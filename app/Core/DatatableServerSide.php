<?php

namespace Core;

/**
 * Class DatatableServerSide
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Core
 */
class DatatableServerSide
{
    const CHARSET = 'UTF-8';

    /** @var int $draw */
    protected $draw = 1;

    /** @var int $start */
    protected $start = 0;

    /** @var int $length */
    protected $length = 10;

    /** @var array $order */
    protected $order = array();

    /** @var array $search */
    protected $search = array();

    /** @var array $columns */
    protected $columns = array();

    /** @var array $data */
    protected $data = array();

    /** @var int $recordsTotal */
    protected $recordsTotal = 0;

    /** @var int $recordsTotal */
    protected $recordsFiltered = 0;

    /**
     * @param  string $method
     * @throws \Exception
     */
    public function __construct($method = 'GET')
    {
        $method = '_' . strtoupper($method);

        if(!in_array($method, array('_GET', '_POST'))) {

            throw new \Exception('Method error');
        }

        global ${$method};

        $method = ${$method};

        $this->draw = isset($method['draw']) && 0 !== (int) $method['draw'] ? (int) $method['draw'] : $this->draw;
        $this->start = isset($method['start']) && 0 !== (int) $method['start'] ? (int) $method['start'] : $this->start;
        $this->length = isset($method['length']) && 0 !== (int) $method['length'] ? (int) $method['length'] : $this->length;
        $this->order = isset($method['order']) && is_array($method['order']) ? $method['order'] : $this->order;
        $this->search = isset($method['search']) && is_array($method['search']) ? $method['search'] : $this->search;
        $this->columns = isset($method['columns']) && is_array($method['columns']) ? $method['columns'] : $this->columns;
    }

    /**
     * @param  array    $data
     * @param  callable $callback
     * @return $this
     */
    public function setData(array $data, callable $callback = null)
    {
        if(count($data)) {

            $this->recordsTotal = count($data);

            foreach($data as $item) {

                if(!is_null($callback)) {

                    $item = call_user_func_array($callback, array($item));
                }

                if(isset($this->search['value'])
                    && '' !== (string) $this->search['value']) {

                    $match = false;

                    foreach($item as $value) {

                        if(('true' === (string) $this->search['regex'] && preg_match('#' . preg_quote($this->search['value'], '#') . '#', $value))
                            || ('false' === (string) $this->search['regex'] && strstr($value, $this->search['value']))) {

                            $match = true;
                        }
                    }

                    if(false === $match) {

                        continue;
                    }
                }

                $this->data[] = $item;
            }

            $this->recordsFiltered = count($this->data);


            if(count($this->order)) {

                $sortArgs = array();

                foreach($this->order as $order) {

                    $sortTmp = array();
                    $column = $this->columns[$order['column']]['data'];

                    foreach($this->data as $i=>$item) {

                        $sortTmp[$i] = $item[$column];
                    }

                    $sortArgs[] = $sortTmp;
                    $sortArgs[] = constant('SORT_' . strtoupper($order['dir']));
                }

                if(count($sortArgs)) {

                    $sortArgs[] =& $this->data;

                    call_user_func_array('array_multisort', $sortArgs);
                }
            }

            $this->data = array_slice($this->data, $this->start, $this->length);
        }

        return $this;
    }

    /**
     *
     */
    public function render()
    {
        //header('Content-Type:text/json; charset=' . static::CHARSET);

        echo json_encode(array(
            'draw' => $this->draw + 1,
            'recordsTotal' => $this->recordsTotal,
            'recordsFiltered' => $this->recordsFiltered,
            'data' => $this->data
        ));

        exit;
    }
}
