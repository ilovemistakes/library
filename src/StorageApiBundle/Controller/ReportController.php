<?php

namespace StorageApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use LibraryStorageBundle\Entity\BookStat;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Report controller.
 *
 * @Route("report")
 */
class ReportController extends ApiController
{
    /**
     * Finds and displays most readed books.
     *
     * @Route("/top_books", name="api_report_top_books")
     * @Method("GET")
     */
    public function reportTopBooksAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $limit = intval($request->get('limit'));
        if(!$limit) $limit = 5;

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('LibraryStorageBundle:Book', 'b', 'book');
        $rsm->addFieldResult('b', 'id', 'id');
        $rsm->addFieldResult('b', 'name', 'name');
        $rsm->addFieldResult('b', 'author', 'author');
        $rsm->addJoinedEntityResult('LibraryStorageBundle:Library', 'l', 'b', 'library');
        $rsm->addFieldResult('l', 'library_id', 'id');
        $rsm->addFieldResult('l', 'library_name', 'name');
        $rsm->addScalarResult('cnt', 'cnt', 'integer');

        $result = $em->createNativeQuery('
                SELECT * FROM
                (
                    SELECT
                        b.*,
                        l.name as library_name,
                        SUM(
                            DATEDIFF(
                                (
                                    SELECT
                                        IFNULL(created, NOW())
                                    FROM record
                                    WHERE
                                        book_id = r.book_id
                                        AND action = "return"
                                        AND r.book_id = book_id
                                        AND created >= r.created
                                        AND id > r.id
                                        ORDER BY created ASC
                                        LIMIT 1
                                ),
                                created
                            )
                        ) AS cnt
                    FROM record r
                    LEFT JOIN book b ON b.id = book_id
                    LEFT JOIN library l ON l.id = b.library_id
                    WHERE action = "take"
                    GROUP BY book_id
                    ORDER BY library_id, cnt DESC
                ) AS t
                GROUP BY t.library_id
                ORDER BY t.cnt DESC
                LIMIT :limit
                ', $rsm)
                ->setParameter('limit', $limit)
                ->getResult();

        $stats = $this->queryResultToBookStats($result);

        return new JsonResponse($this->serialize($stats, 'report'), 200, array(), true);
    }

    /**
     * Finds and displays author's books taken within a date interval statistics.
     *
     * @Route("/author/{name}", name="api_report_author")
     * @Method("GET")
     */
    public function reportAuthorAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $result = $em->createQuery('
                SELECT b AS book, l, COUNT(r.id) AS cnt
                FROM LibraryStorageBundle:Book b
                JOIN b.library l
                JOIN b.records r WITH r.action = :action
                WHERE
                    r.created BETWEEN :from AND :to
                    AND b.author = :author
                GROUP BY b.id
                ')
                ->setParameter('author', $request->get('name'))
                ->setParameter('action', 'take')
                ->setParameter('from', $request->get('from'))
                ->setParameter('to', $request->get('to'))
                ->getResult();

        $stats = $this->queryResultToBookStats($result);

        return new JsonResponse($this->serialize($stats, 'report'), 200, array(), true);
    }

    private function queryResultToBookStats($result) {
        $stats = []; 
        foreach($result as $stat) {
            $s = new BookStat();
            $s->setBook($stat['book']);
            $s->setCount($stat['cnt']);
            $stats[] = $s;
        }

        return $stats;
    }
}
