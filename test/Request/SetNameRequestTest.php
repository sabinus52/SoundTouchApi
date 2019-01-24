<?php
/**
 * Test de la class SetNameRequest
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

use PHPUnit\Framework\TestCase;
use Sabinus\SoundTouch\Request\SetNameRequest;
use Sabinus\SoundTouch\Constants\Key;


class SetNameRequestTest extends TestCase
{

    public function testRequest()
    {
        $request = new SetNameRequest();
        $request->setName( 'toto' );
        $this->assertSame('<name>toto</name>', $request->getPayload());
    }

}
