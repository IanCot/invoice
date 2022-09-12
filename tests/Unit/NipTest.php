<?php

namespace Tests\Unit;

use App\Exceptions\InvalidNipException;
use PHPUnit\Framework\TestCase;
use App\Models\Nip;

class NipTest extends TestCase
{
    /**
     *@dataProvider validNipProvider
     */
    public function test_nip_can_be_created(string $nip,string $expected):void
    {
        $newNip = new Nip($nip);
        $this->assertSame($expected,$newNip->getNip());
    }
    /**
     *@dataProvider invalidNipProvider
     */
    public function test_nip_cannot_be_created_with_invalid_nip(string $nip):void
    {
        $this->expectException(InvalidNipException::class);
        $nip = new Nip($nip);
    }
    /**
     *@dataProvider validNipProvider
     */
    public function test_nip_can_be_created_from_string(string $nip,string $expected):void
    {
        $newNip = Nip::fromString($nip);
        $this->assertSame($expected,$newNip->getNip());
    }
    public function test_nip_can_be_return_formated():void
    {
        $nip = Nip::fromString('7846556299');
        $this->assertSame('784-655-62-99',$nip->getFormated());
    }
    public function validNipProvider():array
    {
        return [
            ['7846556299','7846556299'],
            ['784-655-62-99','7846556299'],
            ['2133912209','2133912209'],
            ['213-391-22-09','2133912209'],
            ['5328906193','5328906193'],
            ['354 066 71 81','3540667181'],
            ['1530614064	','1530614064'],
            ['	1530614064','1530614064'],
            ['	1530614064   ','1530614064'],
        ];
    }
    public function invalidNipProvider():array
    {
        return [
            ['784655629'],
            ['7846556293'],
            ['78465562910'],
            ['784-655-62-90'],
            ['2133912299'],
            ['213-391-22-99'],
            ['5328906195'],
            ['354 066 71 82'],
            ['153061406	']
        ];
    }
}
