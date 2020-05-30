<?php


namespace L41rx\Layer\Interfaces;


interface FrontendComponent
{
    public function render();
    public function setProperty($key, $value);
    public function getProperty($key);
}
