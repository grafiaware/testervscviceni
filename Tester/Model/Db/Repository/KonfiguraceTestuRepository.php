<?php
namespace Tester\Model\Db\Repository;

use Tester\Model\Db\Entity\KonfiguraceTestuEntity;
use Tester\Model\Db\Dao\DaoInterface;
use Tester\Model\Db\RowObject\KonfiguraceTestuRow;
use Tester\Model\Db\Entity\Hydrator;


/**
 * Description of KonfiguraceTestu
 *
 * @author vlse2610
 */
class KonfiguraceTestuRepository implements KonfiguraceTestuRepositoryInterface {
    
    private $konfiguraceTestuDao;
    private $hydrator;
    
    public function __construct( DaoInterface $konfiguraceTestuDao, 
                                 Hydrator\KonfiguraceTestuHydratorInterface $hydrator ) {
        $this->konfiguraceTestuDao = $konfiguraceTestuDao;
        $this->hydrator = $hydrator;
    }
    
    
    public function get( $uid ) {
        $konfiguraceTestuEntity = new KonfiguraceTestuEntity();        
        $konfiguraceTestuRowObject = $this->konfiguraceTestuDao->get($uid);   
        
        $this->hydrator->hydrate( $konfiguraceTestuEntity, $konfiguraceTestuRowObject);
                                                // vraci $konfiguraceTestuEntity          
        return $konfiguraceTestuEntity;        
    }
    
}
//( $value, RowObjectInterface $entity, 
//                             ColumnMetadataInterface $columnMetadata, TableMetadataInterface $tableMetaData)
