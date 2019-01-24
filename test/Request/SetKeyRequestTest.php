<?php
/**
 * Test de la class SetKeyRequest
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

use PHPUnit\Framework\TestCase;
use Sabinus\SoundTouch\Request\SetKeyRequest;
use Sabinus\SoundTouch\Constants\Key;


class SetKeyRequestTest extends TestCase
{

    public function testRequest()
    {
        $request = new SetKeyRequest();
        $request->setKey( KEY::MUTE )->setState( SetKeyRequest::PRESS );
        $this->assertSame('<key state="press" sender="Gabbo">MUTE</key>', $request->getPayload());
    }

}
