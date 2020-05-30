<?php


namespace L41rx\Layer\Abstracts;


class FrontendComponent implements \L41rx\Layer\Interfaces\FrontendComponent
{
    public function __construct(array $properties)
    {
        foreach ($properties as $key => $value) {
        	if (!property_exists(get_class($this), $key))
        		throw new Exception("Tried to assign non existing front end component key {$key} to ".get_class($this));
        	$this->setProperty($key, $value);
        }
    }

    public function getProperty($key) {
    	return $this->{$key};
    }

    public function setProperty($key, $value) {
    	$this->{$key} = $value;
    }

    public function render() {
        throw new \Exception("Please implement render()");
    }
}