<?php
namespace Model\Repository;

use Model\Dao\DaoInterface;

use Model\Entity\Hydrator\EntityHydratorInterface;
use Model\Entity\EntityInterface;

use Model\RowObject\RowObjectInterface;
use Model\RowObject\Hydrator\RowObjectHydratorInterface;

use Model\RowData\RowDataInterface;

use Model\Repository\Association\AssociationOneToOneFactory;
use Model\Repository\Association\AssociationOneToManyFactory;
use Model\Repository\Exception\UnableToCreateAssotiatedChildEntity;
use Model\Repository\Exception\UnableRecreateEntityException;
/**
 * Description of RepoAbstract
 *
 *
 */
abstract class RepositoryAbstract implements RepositoryInterface {

    public static $counter;
    protected $count;
    protected $oid;

    protected $collection = [];  //persisted old
    protected $new = [];
    protected $removed = [];

    private $associations = [];

    private $hydratorsEntity = [];
    private $hydratorsRowObject = [];

    
    /**
     * @var TestovaciTableDaoInterface 
     */
    protected $dao;
    

//    /**
//     * @var HydratorInterface array of
//     */
//    protected $hydrator;

    /**
     *
     * @param type $parentPropertyName
     * @param type $parentIdName
     * @param \Model\Repository\RepoAssotiatedOneInterface $repo
     */
    protected function registerOneToOneAssotiation($parentPropertyName, $parentIdName, RepoAssotiatedOneInterface $repo) {
        $this->associations[$parentPropertyName] = new AssociationOneToOneFactory($parentPropertyName, $parentIdName, $repo);
    }

    protected function registerOneToManyAssotiation($parentPropertyName, $parentIdName, RepoAssotiatedManyInterface $repo) {
        $this->associations[$parentPropertyName] = new AssociationOneToManyFactory($parentPropertyName, $parentIdName, $repo);
    }

    protected function addCreatedAssociations(&$row): void {
        foreach ($this->associations as $association) {
            $association->createAssociated($row);
        }
    }

    //---------------------------------------
    protected function registerEHydrator( EntityHydratorInterface $hydrator ) {
        $this->hydratorsEntity[] = $hydrator;
    }
    protected function registerROHydrator( RowObjectHydratorInterface $hydrator ) {
        $this->hydratorsRowObject[] = $hydrator;
    }
    //---------------------------------------
    
    
    
    protected function hydrate(EntityInterface $entity, RowDataInterface $rowData) {                
        $rowObject = $this->createRowObject();
        
        /** @var RowObjectHydratorInterface $hydrator */
        foreach ($this->hydratorsRowObject as $hydrator) {
            $hydrator->hydrate( $rowObject, $rowData );
        }
        
        /** @var EntityHydratorInterface $hydrator */
        foreach ($this->hydratorsEntity as $hydrator) {
            $hydrator->hydrate( $entity, $rowObject);
        }
    }
    

    protected function extract( EntityInterface $entity, RowDataInterface $rowData) {
        $rowObject = $this->createRowObject();
        
        /** @var EntityHydratorInterface $hydrator */
        foreach ($this->hydratorsEntity as $hydrator) {
            $hydrator->extract($entity, $rowObject );
        }
        
        /** @var RowObjectHydratorInterface $hydrator */
        foreach ($this->hydratorsRowObject as $hydrator) {
            $hydrator->extract($rowObject, $rowData );
        }
           
    }
    
    

    /**
     *     
     */
    protected function recreateEntity( $index,  RowDataInterface $rowData): void {
        if ($rowData) {
//            try {
//                $this->addCreatedAssociations($row);
//            } catch (UnableToCreateAssotiatedChildEntity $unex) {
//                throw new UnableRecreateEntityException("Nelze obnovit agregovanou entitu v repository ". get_called_class()." s indexem $index.", 0, $unex);
//            }
                                   
            $entity = $this->createEntity();  // definována v konkrétní třídě - adept na entity managera
            $this->hydrate($entity, $rowData);
                                    
            $entity->setPersisted();
            $this->collection[$index] = $entity;
        }
    }
    
    

    protected function addEntity(EntityInterface $entity, $index=null): void {
        if ($index) {
            $this->collection[$index] = $entity;
        } else {
            $this->new[] = $entity;
        }
    }

    protected function removeEntity(EntityInterface $entity, $index=null): void {
        if ($index) {
            $this->removed[] = $entity;
            unset($this->collection[$index]);
        } else {   // smazání před uložením do db
            foreach ($this->new as $key => $new) {
                if ($new === $entity) {
                    unset($this->new[$key]);
                }
            }
        }
       
    }

    public function flush(): void {
        if ( !($this instanceof RepoReadonlyInterface)) {
            /** @var \Model\Entity\EntityAbstract $entity */
            foreach ($this->collection as $entity) {
                $row = [];
                $this->extract($entity, $row);
                if ($entity->isPersisted()) {
                    $this->dao->update($row);
                } else {
                    throw new \LogicException("V collection je nepersistovaná entita.");
                }
            }
            foreach ($this->new as $entity) {
                $row = [];
                $this->extract($entity, $row);
                $this->dao->insert($row);
            }
            $this->new = []; // při dalším pokusu o find se bude volat recteateEntity, entita se zpětně načte z db (včetně případného autoincrement id a dalších generovaných sloupců)
            foreach ($this->removed as $entity) {
                $row = [];
                $this->extract($entity, $row);
                $this->dao->delete($row);
                $entity->setUnpersisted();
            }
            $this->removed = [];
        } else {
            if ($this->new OR $this->removed) {
                throw new \LogicException("Repo je read only a byly do něj přidány nebo z něj smazány entity.");
            }
        }
    }

    public function __destruct() {
        $this->flush();
    }


}
