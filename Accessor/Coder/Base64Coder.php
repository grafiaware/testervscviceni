<?php
/**
 * Description of Base64Coder
 *
 * @author pes2704
 */
class Accessor_Coder_Base64Coder implements Accessor_Coder_CoderInterface {
    public function encode($data) {
        return base64_encode($data);
    }
    
    public function decode($data) {
        return base64_decode($data);
    }
}
