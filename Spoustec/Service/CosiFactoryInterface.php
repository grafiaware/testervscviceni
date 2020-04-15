<?php
namespace Spoustec\Service;

use Spoustec\Cosi\CosiInterface;
use Spoustec\Cosi\CosiEnum;

/**
 *
 * @author vlse2610
 */
interface CosiFactoryInterface {
    
    /**
     * @return CosiInterface
     */
    public  function create( $target  /*CosiEnum $c*/): CosiInterface;
}
