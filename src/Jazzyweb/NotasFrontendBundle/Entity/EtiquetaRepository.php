<?php

namespace Jazzyweb\NotasFrontendBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EtiquetaRepository
 */
class EtiquetaRepository extends EntityRepository {

    public function findByUsuarioOrderedByTexto($username) {
        $query = $this->getEntityManager()->createQuery(
                        "SELECT e FROM Jazzyweb\NotasFrontendBundle\Entity\Etiqueta e
                      JOIN  e.usuario u where u.id = :username ORDER BY e.texto ASC")
                ->setParameters(array('username' => $username));

        return $query->getResult();
    }

    public function findOneByTextoAndUsuario($tag, $user) {
        $query = $this->getEntityManager()->createQuery(
                        "SELECT e FROM Jazzyweb\NotasFrontendBundle\Entity\Etiqueta e JOIN e.usuario u where u.id = :user_id AND e.texto=:texto")
                ->setParameters(array('texto' => $tag, 'user_id' => $user->getId()));

        $result = $query->getResult();

        if (count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

}