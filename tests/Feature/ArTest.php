<?php


namespace Tests\Feature;
use Tests\TestCase;

class ArTest extends TestCase
{

    /**
     * My test implementation
     */
    public function testCapacityIsLicensed(){
        $this->browser->visit('/ar');

        $this->visit('/ar/offers');
        $this->visit('/ar/services');
        $this->visit('/ar/servicePage/Training');
    }
}
