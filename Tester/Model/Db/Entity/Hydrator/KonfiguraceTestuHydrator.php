<?php
namespace Tester\Model\Db\Entity\Hydrator;

use Tester\Model\Db\Entity\KonfiguraceTestuEntity;
use Tester\Model\Db\RowObject\KonfiguraceTestuRow;
use Tester\Model\Db\Repository\KonfiguraceTestuRepositoryInterface;

/**
 * Description of KonfiguraceTestu
 *
 * @author vlse2610
 */
class KonfiguraceTestuHydrator implements KonfiguraceTestuHydratorInterface {
    /**
     *
     * @var KonfiguraceTestuInterface
     */
    public $konfiguraceTestuRepo;

    public function __construct(KonfiguraceTestuRepositoryInterface $konfiguraceTestuRepo) {
        $this->konfiguraceTestuRepo = $konfiguraceTestuRepo;
    }

    
    public function hydrate( KonfiguraceTestuEntity $entity, KonfiguraceTestuRow $rowObject) {
        /* @var $rowObject KonfiguraceTestuRow */
        $entity->setUidKonfiguraceTestu($rowObject->uidKonfiguraceTestu); 
        $entity->setNazevTestu($rowObject->nazevTestu);     //vlastnost
        $entity->setParalelVSsessionSpustitelny($rowObject->paralelVSessionSpustitelny);       
        $entity->setPopisTestu($rowObject->popisTestu);
        $entity->setValid($rowObject->valid);
       
        $entity->setSadaUloh( $this->konfiguraceTestuRepo->get($rowObject->uidNazevSadyFk));   //entitu (objektu) ziskam z repository
        
    }

   
    
    
    public function extract(  KonfiguraceTestuEntity $entity, KonfiguraceTestuRow $rowObject ) {
        
        $rowObject->uidKonfiguraceTestu = $entity->getUidKonfiguraceTestu() ;    
        
        $rowObject->nazevTestu = $entity->getNazevTestu() ;        
        $rowObject->paralelVSsessionSpustitelny = $entity->getParalelVSsessionSpustitelny();
        // ....................
    }
}
