<?php
namespace Model\Repository;

use Model\Repository\TestovaciEntityRepositoryInterface;
use Model\Repository\RepositoryAbstract;

use Model\Dao\TestovaciTableDaoInterface;

use \Model\RowObject;

//use Model\Entity\TestovaciEntity;
use Model\Entity\EntityInterface;
use Model\Entity\Identity\IdentityInterface;
use Model\Entity\Hydrator\EntityHydratorInterface;
use Model\Entity\Identity\Hydrator\IdentityHydratorInterface;

use Model\RowObject\Hydrator\RowObjectHydratorInterface;


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
class TestovaciEntityRepository extends RepositoryAbstract implements TestovaciEntityRepositoryInterface {                    
    
//    /**
//     * @var TestovaciTableDaoInterface 
//     */
//    private $dao;       
//    /**
//     * @var EntityHydratorInterface 
//     */
//    private $oneToOneEHydrator;
//    private $celeJmenoEHydrator; 
//    /**
//     *
//     * @var RowObjectHydratorInterface 
//     */
//    private $rowObjectHydrator;
    
    private $identityHydrator;
    
    //private $entities;  //pole
    
    
    public function __construct( TestovaciTableDaoInterface $testovaciTableDao, 
                                 RowObjectHydratorInterface $rowObjectHydrator,
                                 EntityHydratorInterface $oneToOneEHydrator,
                                 EntityHydratorInterface $celeJmenoEHydrator,                                    
                                 IdentityHydratorInterface $identityHydrator  
            ) {
        $this->dao = $testovaciTableDao;              
        
        $this->registerROHydrator( $rowObjectHydrator);
        $this->registerEHydrator( $celeJmenoEHydrator); 
        $this->registerEHydrator( $oneToOneEHydrator); 
        $this->registerROHydrator( $rowObjectHydrator);
        
        $this->identityHydrator = $identityHydrator;               
    }
        
    
    
     /**
     * 
     * @param IdentityInterface $identity
     * @return EntityInterface|null
     */
    public function get ( IdentityInterface $identity ): ?EntityInterface {
        //$index = $id;   //**???**//
        $keyHash = $identity->getKeyHash();    //**???**// //**???**//toto je pole !!!!   ane index
                
        $index = $keyHash ;   //**???**// bacha 
        //-------------
        
        if (!isset($this->collection[$index])) {
            $this->recreateEntity($index, $this->dao); //zarazen do collection z uloziste, pod indexem  $index
        }
        return $this->collection[$index] ?? NULL;
                                
//        
//        foreach ($this->collection as $entity) {
//            if ($entity->getIdentity()->isEqual($identity)) 
//            {    //nalezen v 
//                return $entity;
//            }            
//        }       
        
    }
    
    
     public function getByReference($menuItemIdFk): ?EntityInterface {
        $row = $this->dao->getByFk($menuItemIdFk);
        $index = $this->indexFromRow($row);
        if (!isset($this->collection[$index])) {
            $this->recreateEntity($index, $row);
        }
        return $this->collection[$index] ?? NULL;
    }
    
    

     /**
     * 
     * @param EntityInterface $entity
     * @return void
     */
    public function add( EntityInterface $entity ): void {            
    //public function add(PaperInterface $paper) {
        $index = $this->indexFromEntity($paper);
        $this->addEntity($paper, $index);
    }

     
    /**
     * 
     * @param EntityInterface $entity 
     * @return void
     */
    public function remove( EntityInterface $entity  ): void {            
    //public function remove(PaperInterface $paper) {
        $index = $this->indexFromEntity($paper);
        $this->removeEntity($entity, $index);
    }
    
    
    //------------------------------------------------
    protected function createRowObj() {
        return new RowObject();
    }
    
    protected function createEntity() {
        return new TestovaciEntity();
    }

    protected function identityFromEntity( EntityInterface $testovaciEntity) {
        return $testovaciEntity->getIdentity();
    }

    protected function indexFromRow($row) /*keyHashFromRow*/ {
        return $row['id'];
    }

    
    
    
//    
////-------------------------------------------------------------------------------------------------       
//    /**
//     * 
//     * @param type $identity
//     * @return EntityInterface|null
//     */
//    public function get( IdentityInterface $identity ): ?EntityInterface {     
//       
//        foreach ($this->entities as $entity) {
//            if ($entity->getIdentity()->isEqual($identity)) {
//                return $entity;
//            }
//        }
//        //nova entity
//        $entity = new TestovaciEntity( );
//        $entity->setIdentity($identity);
//        
//        /* ?? */$rowObject = $this->dao->get($identity->getKeyHash());     ///????????????????????????????identity
//        
//        $this->oneToOneEHydrator->hydrate($entity, $rowObject);
//        $this->celeJmenoEHydrator->hydrate($entity, $rowObject);
//        
//        $this->entities[] = $entity;
//        return $entity;
//     //---------------------------------------------------   
////        /* @var $rowObject RowObjectInterface */   
////       $rowObject = new RowObject (); 
////       $this->dao->get(  $this->identityHydrator->extract( $identity, $rowObject ) );              
////       if ($rowObject) {
////           $identity2 = new Identity();
////           $this->identityHydrator->hydrate( $identity2, $rowObject);
////           
////           /* @var $entity TestovaciEntityInterface */
////           $entity = new TestovaciEntity;                               
////           $this->celeJmenoEHydrator->hydrate($entity, $rowObject);
////           $this->oneToOneEHydrator->hydrate($entity, $rowObject );           
////       }
////       else {          }
////                     
////       if  ( $identity->isEqual($identity2)) {           
////       }
////       else {           
////       }     
////       return $entity ;        
//    }
//    
//    
//    
//    public function add( EntityInterface $entity): void {
//        
////        $rowObject = new TestovaciRowObject();
////        $this->oneToOneEHydrator->extract($entity, $rowObject);
////        $this->celeJmenoEHydrator->extract($entity, $rowObject);
////        
////        $this->dao->save($rowObject);
//        
//    }
//    
//    
//    
//    public function remove( EntityInterface $entity ): void {
//        
//        ;
//    }
    
    
}

