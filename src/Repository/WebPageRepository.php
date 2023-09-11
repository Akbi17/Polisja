<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\WebPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebPage>
 *
 * @method WebPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method WebPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebPage[]    findAll()
 * @method WebPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebPage::class);
    }

    public function save(WebPage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(WebPage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
