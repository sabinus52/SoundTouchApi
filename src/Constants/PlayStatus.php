<?php
/**
 * Constantes des statuts du streaming
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Constants;


class PlayStatus
{

    // PLAY_STATUS
    const PLAY_STATE        = 'PLAY_STATE';
    const PAUSE_STATE       = 'PAUSE_STATE';
    const STOP_STATE        = 'STOP_STATE';
    const BUFFERING_STATE   = 'BUFFERING_STATE';

    // SHUFFLE_STATUS
    const SHUFFLE_OFF       = 'SHUFFLE_OFF';
    const SHUFFLE_ON        = 'SHUFFLE_ON';

    // REPEAT_STATUS
    const REPEAT_OFF        = 'REPEAT_OFF';
    const REPEAT_ALL        = 'REPEAT_ALL';
    const REPEAT_ONE        = 'REPEAT_ONE';

}
