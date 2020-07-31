<?php
namespace Model\Repository;

use Model\RowObject\TestovaciRowObject;

use Model\Entity\TestovaciEntity;
use Model\Entity\EntityInterface;
use Model\Entity\Identity\IdentityInterface;
use Model\Entity\Hydrator\EntityHydratorInterface;

use Model\Repository\TestovaciEntityRepositoryInterface;

use Model\Dao\TestovaciTableDaoInterface;
use Model\Entity\Identity\Hydrator\IdentityHydratorInterface;


/**   NENI VUBEC NIJAK HOTOVE
 * 
 * 
 * 
 */
/**
 * Description of TestovaciEntityRepository
 *
 * @author vlse2610
 */
class TestovaciEntityRepository implements TestovaciEntityRepositoryInterface {    
    /**
     * @var TestovaciTableDaoInterface 
     */
    private $dao;
       
    /**
     * @var EntityHydratorInterface 
     */
    private $oneToOneEHydrator;
    private $celeJmenoEHydrator; 
    private $identityHydrator;
    
    private $entities;  //pole
    
    
    public function __construct( TestovaciTableDaoInterface $testovaciTableDao, 
                                 EntityHydratorInterface $oneToOneEHydrator,
                                 EntityHydratorInterface $celeJmenoEHydrator,
                                    
                                 IdentityHydratorInterface $identityHydrator  
            ) {
        $this->dao = $testovaciTableDao;
        $this->oneToOneEHydrator = $oneToOneEHydrator;   
        $this->celeJmenoEHydrator = $celeJmenoEHydrator; 
        $this->identityHydrator = $identityHydrator;
    }
        
    
       
    /**
     * 
     * @param type $identity
     * @return EntityInterface|null
     */
    public function get( IdentityInterface $identity ): ?EntityInterface {     
       
        foreach ($this->entities as $entity) {
            if ($entity->getIdentity()->isEqual($identity)) {
                return $entity;
            }
        }
        //nova entity
        $entity = new TestovaciEntity( );
        $entity->setIdentity($identity);
        
        /* ?? */$rowObject = $this->dao->get($identity->getKeyHash());     ///????????????????????????????identity
        
        $this->oneToOneEHydrator->hydrate($entity, $rowObject);
        $this->celeJmenoEHydrator->hydrate($entity, $rowObject);
        
        $this->entities[] = $entity;
        return $entity;
     //---------------------------------------------------   
//        /* @var $rowObject RowObjectInterface */   
//       $rowObject = new RowObject (); 
//       $this->dao->get(  $this->identityHydrator->extract( $identity, $rowObject ) );              
//       if ($rowObject) {
//           $identity2 = new Identity();
//           $this->identityHydrator->hydrate( $identity2, $rowObject);
//           
//           /* @var $entity TestovaciEntityInterface */
//           $entity = new TestovaciEntity;                               
//           $this->celeJmenoEHydrator->hydrate($entity, $rowObject);
//           $this->oneToOneEHydrator->hydrate($entity, $rowObject );           
//       }
//       else {          }
//                     
//       if  ( $identity->isEqual($identity2)) {           
//       }
//       else {           
//       }     
//       return $entity ;        
    }
    
    
    
    public function add( EntityInterface $entity): void {
        
//        $rowObject = new TestovaciRowObject();
//        $this->oneToOneEHydrator->extract($entity, $rowObject);
//        $this->celeJmenoEHydrator->extract($entity, $rowObject);
//        
//        $this->dao->save($rowObject);
        
    }
    
    
    
    public function remove( IdentityInterface  $identity): void {
        
        ;
    }
    
    
}

