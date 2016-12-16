<?php

namespace M2I\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="M2I\BlogBundle\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur_first_name", type="string", length=255)
     */
    private $auteurFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur_last_name", type="string", length=255)
     */
    private $auteurLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text")
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commentaire", type="datetimetz")
     */
    private $dateCommentaire;

    public function __construct()
    {
      $this->dateCommentaire = new \DateTime;
    }

    /**
     * @ORM\ManyToOne(targetEntity="M2I\BlogBundle\Entity\Article", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set auteurFirstName
     *
     * @param string $auteurFirstName
     * @return Commentaire
     */
    public function setAuteurFirstName($auteurFirstName)
    {
        $this->auteurFirstName = $auteurFirstName;

        return $this;
    }

    /**
     * Get auteurFirstName
     *
     * @return string
     */
    public function getAuteurFirstName()
    {
        return $this->auteurFirstName;
    }

    /**
     * Set auteurLastName
     *
     * @param string $auteurLastName
     * @return Commentaire
     */
    public function setAuteurLastName($auteurLastName)
    {
        $this->auteurLastName = $auteurLastName;

        return $this;
    }

    /**
     * Get auteurLastName
     *
     * @return string
     */
    public function getAuteurLastName()
    {
        return $this->auteurLastName;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set dateCommentaire
     *
     * @param \DateTime $dateCommentaire
     * @return Commentaire
     */
    public function setDateCommentaire($dateCommentaire)
    {
        $this->dateCommentaire = $dateCommentaire;

        return $this;
    }

    /**
     * Get dateCommentaire
     *
     * @return \DateTime
     */
    public function getDateCommentaire()
    {
        return $this->dateCommentaire;
    }

    /**
     * Set article
     *
     * @param \M2I\BlogBundle\Entity\Article $article
     * @return Commentaire
     */
    public function setArticle(\M2I\BlogBundle\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \M2I\BlogBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }
}
