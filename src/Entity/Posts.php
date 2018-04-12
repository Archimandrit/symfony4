<?php

namespace App\Entity;

use App\Helpers\FileHelper;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Posts
{

    const FILE_EXTENSION = ['jpg', 'png', 'jpeg', 'gif', 'bmp'];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $userId;

    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     * @Assert\NotBlank(message="Прикрепите изображение")
     */
    private $image;

    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @ORM\Column(type="integer", options={"default"=0})
     */
    private $likeCount = 0;

    /**
     * @ORM\Column(type="integer", options={"default"=0})
     */
    private $commentCount = 0;

    /**
     * @ORM\Column(type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $updatedAt;
    /**
     * @var Comments[] |PersistentCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="post"))
     */
    private $comments;

    public function getId()
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getLikeCount()
    {
        return $this->likeCount;
    }

    /**
     * @param mixed $likeCount
     */
    public function setLikeCount($likeCount): void
    {
        $this->likeCount = $likeCount;
    }

    /**
     * @return mixed
     */
    public function getCommentCount()
    {
        return $this->commentCount;
    }

    /**
     * @param mixed $commentCount
     */
    public function setCommentCount($commentCount): void
    {
        $this->commentCount = $commentCount;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updateTimestamps()
    {
        $this->setUpdatedAt(new \DateTime());

        if(!$this->getCreatedAt()){
            $this->setCreatedAt(new \DateTime());
        }
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file): void
    {
        $this->file = $file;
    }

    /**
     * @ORM\PrePersist()
     */
    public function uploadFile()
    {
        $file = $this->getFile();
        $filename = $file->getClientOriginalName();
        $file->move(FileHelper::UPLOAD_DIR, $filename);
    }

    /**
     * @return Comments[]|PersistentCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comments[]|PersistentCollection $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }


}
