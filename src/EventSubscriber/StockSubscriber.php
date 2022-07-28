<?php

namespace App\EventSubscriber;

use App\Entity\Emprunt;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManagerInterface;

class StockSubscriber implements EventSubscriberInterface
{
    private  $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
    $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
            return[
                AfterEntityPersistedEvent::class => ['PlusEmp'],
                AfterEntityDeletedEvent::class => ['DelEmp']
            ];
    }

    public function PlusEmp(AfterEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Emprunt)) {
            return;
        }
        $this->MoinStock($entity);
    
    }

    /**
     * @param Emprunt $entity
     */

    public  function MoinStock(Emprunt $entity):void
    {
        $entity->getLivres()->setQteStock($entity->getLivres()->getQteStock()-1);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function DelEmp(AfterEntityDeletedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Emprunt)) {
            return;
        }
        $this->PlusStock($entity);

    }

    /**
     * @param Emprunt $entity
     */

    public  function PlusStock(Emprunt $entity):void
    {
        $entity->getLivres()->setQteStock($entity->getLivres()->getQteStock()+1);
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}