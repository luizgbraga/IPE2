<?php

class DataProvider {
    function __construct(public $source) {
        $this->source = $source;
    }
}

?>