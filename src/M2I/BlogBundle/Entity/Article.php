<?php

namespace M2I\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="M2I\BlogBundle\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetimetz")
     */
    private $createDate;

    /**
     * @ORM\OneToOne(targetEntity="M2I\BlogBundle\Entity\Image", cascade={"persist"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="M2I\BlogBundle\Entity\Commentaire", mappedBy="article")
     */
    private $commentaires;

    public function __construct()
    {
        $this->createDate = new \DateTime();
    }

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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return Article
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set image
     *
     * @param \M2I\BlogBundle\Entity\Image $image
     * @return Article
     */
    public function setImage(\M2I\BlogBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \M2I\BlogBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
/*
    public function __construct()
    {
      $this->commentaires =  new ArrayCollection();
    }
*/
    /**
     * Add commentaires
     *
     * @param \M2I\BlogBundle\Entity\Commentaire $commentaires
     * @return Article
     */
    public function addCommentaire(\M2I\BlogBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        // On lie l'annonce a la candidature
        $commentaire->setArticle($this);

        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \M2I\BlogBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\M2I\BlogBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}
