<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="book")
*/
class Book
{
 /**
 * @ORM\Id
 * @ORM\Column(type="integer")
 * @ORM\GeneratedValue(strategy="AUTO")
 */
 protected $id;
 /**
 * @ORM\Column(type="string", length=13)
 */
 protected $isbn;
 /**
 * @ORM\Column(type="string", length=50)
 */
 protected $title;
 /**
 * @ORM\Column(type="text")
 */
 protected $summary;
/**
 * @var \Year
 *
 * @ORM\Column(name="year_born", columnDefinition="YEAR", nullable=false)
 */
protected $publication_year;
/**
 * @ORM\Column(type="date")
 */
protected $issue_date;
/**
 * @ORM\Column(type="datetime")
 */
protected $created_at;
/**
 * @ORM\Column(type="datetime")
 */
protected $updated_at;
/**
 * @ORM\ManyToOne(targetEntity="User", inversedBy="users")
 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
 */
protected $user;
/**
 * @ORM\ManyToMany(targetEntity="Author", inversedBy="book")
 */
protected $authors;

/**
 * Constructor
 */
public function __construct()
{
    $this->authors = new ArrayCollection();
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
     * Set isbn
     *
     * @param string $isbn
     * @return Book
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string 
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Book
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
     * Set summary
     *
     * @param string $summary
     * @return Book
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set publication_year
     *
     * @param string $publicationYear
     * @return Book
     */
    public function setPublicationYear($publicationYear)
    {
        $this->publication_year = $publicationYear;

        return $this;
    }

    /**
     * Get publication_year
     *
     * @return string 
     */
    public function getPublicationYear()
    {
        return $this->publication_year;
    }

    /**
     * Set issue_date
     *
     * @param \DateTime $issueDate
     * @return Book
     */
    public function setIssueDate($issueDate)
    {
        $this->issue_date = $issueDate;

        return $this;
    }

    /**
     * Get issue_date
     *
     * @return \DateTime 
     */
    public function getIssueDate()
    {
        return $this->issue_date;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Book
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param string $updatedAt
     * @return Book
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return string 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Book
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {

        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add authors
     *
     * @param \AppBundle\Entity\Author $authors
     * @return Book
     */
    public function addAuthor(\AppBundle\Entity\Author $authors)
    {
        $this->authors[] = $authors;

        return $this;
    }

    /**
     * Remove authors
     *
     * @param \AppBundle\Entity\Author $authors
     */
    public function removeAuthor(\AppBundle\Entity\Author $authors)
    {
        $this->authors->removeElement($authors);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuthors()
    {
        return $this->authors;
    }
}
