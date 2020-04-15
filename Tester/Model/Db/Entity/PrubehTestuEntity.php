<?php
namespace Tester\Model\Db\Entity;

use Tester\Model\Session\Entity\SessionTabbedu;



/**
 * Description of PrubehTestu
 *
 * @author vlse2610
 */
class PrubehTestuEntity extends EntityAbstract {
    /**     
     * @var integer
     */
    public  $idPrubehTestu;    
    /**
     *
     * @var KonfiguraceTestuEntity
     */
    public  $konfiguraceTestu;
    /**
     *
     * @var TicketPouzityEntity
     */
    public  $ticketPouzity;
    /**
     *
     * @var SessionTabbedu 
     */
    public  $sessionTabbedu;        
    /**
    * @var \DateTime
    */
    public  $casSpusteni;     
    /**
    * @var \DateTime
    */
    public  $casUkonceni; 
    /** 
     * @var string
     */
    public  $poleNavic;              
    
    //---mimon--------------------------------------------------
     /**
     *
     * @var OdpovedNaOtazkuEntity array of
     */
    public $odpovediNaOtazku;
    
    
    
    
    
    public function getIdPrubehTestu() {
        return $this->idPrubehTestu;
    }

    public function getKonfiguraceTestu(): KonfiguraceTestuEntity {
        return $this->konfiguraceTestu;
    }

    public function getTicketPouzity(): TicketPouzityDao {
        return $this->ticketPouzity;
    }

    public function getSessionTabbedu(): SessionTabbedu {
        return $this->sessionTabbedu;
    }

    public function getCasSpusteni(): \DateTime {
        return $this->casSpusteni;
    }

    public function getCasUkonceni(): \DateTime {
        return $this->casUkonceni;
    }

    public function getPoleNavic() {
        return $this->poleNavic;
    }

    public function getOdpovediNaOtazku(): OdpovedNaOtazkuDao {
        return $this->odpovediNaOtazku;
    }

    public function setIdPrubehTestu($idPrubehTestu) {
        $this->idPrubehTestu = $idPrubehTestu;
        return $this;
    }

    public function setKonfiguraceTestu(KonfiguraceTestuEntity $konfiguraceTestu) {
        $this->konfiguraceTestu = $konfiguraceTestu;
        return $this;
    }

    public function setTicketPouzity(TicketPouzityEntity $ticketPouzity) {
        $this->ticketPouzity = $ticketPouzity;
        return $this;
    }

    public function setSessionTabbedu(SessionTabbedu $sessionTabbedu) {
        $this->sessionTabbedu = $sessionTabbedu;
        return $this;
    }

    public function setCasSpusteni(\DateTime $casSpusteni) {
        $this->casSpusteni = $casSpusteni;
        return $this;
    }

    public function setCasUkonceni(\DateTime $casUkonceni) {
        $this->casUkonceni = $casUkonceni;
        return $this;
    }

    public function setPoleNavic($poleNavic) {
        $this->poleNavic = $poleNavic;
        return $this;
    }

    public function setOdpovediNaOtazku(OdpovedNaOtazkuEntity $odpovediNaOtazku) {
        $this->odpovediNaOtazku = $odpovediNaOtazku;
        return $this;
    }


    
    
//    
//    
//    
//    public function getIdPrubehTestu() {
//        return $this->idPrubehTestu;
//    }
//
//    public function getKonfiguraceTestu(): KonfiguraceTestu {
//        return $this->konfiguraceTestu;
//    }
//
//    public function getTicketPouzity(): TicketPouzity {
//        return $this->ticketPouzity;
//    }
//
//    public function getSessionTabbedu(): SessionTabbedu {
//        return $this->sessionTabbedu;
//    }
//
//    public function getCasSpusteni(): \DateTime {
//        return $this->casSpusteni;
//    }
//
//    public function getCasUkonceni(): \DateTime {
//        return $this->casUkonceni;
//    }
//
//    public function getPoleNavic(): type {
//        return $this->poleNavic;
//    }
//
//    public function getOdpovediNaOtazku(): OdpovedNaOtazku {
//        return $this->odpovediNaOtazku;
//    }
//
//    public function setIdPrubehTestu( $idPrubehTestu) {
//        $this->idPrubehTestu = $idPrubehTestu;
//        return $this;
//    }
//
//    public function setKonfiguraceTestu(KonfiguraceTestu $konfiguraceTestu) {
//        $this->konfiguraceTestu = $konfiguraceTestu;
//        return $this;
//    }
//
//    public function setTicketPouzity( TicketPouzity $ticketPouzity) {
//        $this->ticketPouzity = $ticketPouzity;
//        return $this;
//    }
//
//    public function setSessionTabbedu( SessionTabbedu $sessionTabbedu) {
//        $this->sessionTabbedu = $sessionTabbedu;
//        return $this;
//    }
//
//    public function setCasSpusteni( \DateTime $casSpusteni) {
//        $this->casSpusteni = $casSpusteni;
//        return $this;
//    }
//
//    public function setCasUkonceni( \DateTime $casUkonceni) {
//        $this->casUkonceni = $casUkonceni;
//        return $this;
//    }
//
//    public function setPoleNavic( string  $poleNavic) {
//        $this->poleNavic = $poleNavic;
//        return $this;
//    }
//
//    public function setOdpovediNaOtazku(OdpovedNaOtazku $odpovediNaOtazku) {
//        $this->odpovediNaOtazku = $odpovediNaOtazku;
//        return $this;
//    }
//
//
//    
  
//    public function __construct() {
//        ;
//    }
}

