<?php
/**
 * Class NdsTest
 * @author Tsibikov Vitaliy <tsibikov_vit@mail.ru> <tsibikov.com>
 */

use vitalik74\Nds;

require_once __DIR__ . '/../Nds.php';

class NdsTest extends PHPUnit_Framework_TestCase
{
    public function testAllocationNds()
    {
        $nds = new Nds();
        $this->assertEquals($nds->allocationNds(100), 15.25);
        $this->assertEquals($nds->allocationNds(200), 30.51);
        $this->assertEquals($nds->allocationNds(300, 33), 74.44);
    }

    public function testAllocationSumWithoutNds()
    {
        $nds = new Nds();
        $this->assertEquals($nds->allocationSumWithoutNds(100), 84.75);
        $this->assertEquals($nds->allocationSumWithoutNds(200), 169.49);
        $this->assertEquals($nds->allocationSumWithoutNds(400, 25), 320);
    }

    public function testChargeNds()
    {
        $nds = new Nds();
        $this->assertEquals($nds->chargeNds(100), 18);
        $this->assertEquals($nds->chargeNds(555, 22), 122.1);
        $this->assertEquals($nds->chargeNds(888, 12), 106.56);
    }

    public function testChargeSumWithNds()
    {
        $nds = new Nds();
        $this->assertEquals($nds->chargeSumWithNds(100), 118);
        $this->assertEquals($nds->chargeSumWithNds(158, 19), 188.02);
        $this->assertEquals($nds->chargeSumWithNds(777, 44), 1118.88);
    }
}