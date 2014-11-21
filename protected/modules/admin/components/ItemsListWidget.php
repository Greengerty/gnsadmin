<?php
class ItemsListWidget extends CWidget {
    public $parametrs;
    public $items;
    public $columns;
    public $model;
 
    public function run() {
        $this->parametrs['items'] = $this->items;
        $this->parametrs['columns'] = $this->columns;
        $this->parametrs['model'] = $this->model;
        $this->render('itemslist/list', array('parametrs' => $this->parametrs) );
    }
}