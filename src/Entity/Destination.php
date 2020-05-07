<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DestinationRepository")
 */
class Destination
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hotel", mappedBy="destination", orphanRemoval=true)
     */
    private $hotel_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activity", mappedBy="destination")
     */
    private $activity_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Transport", mappedBy="destination")
     */
    private $transports;

    public function __construct()
    {
        $this->hotel_id = new ArrayCollection();
        $this->activity_id = new ArrayCollection();
        $this->transports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Hotel[]
     */
    public function getHotelId(): Collection
    {
        return $this->hotel_id;
    }

    public function addHotelId(Hotel $hotelId): self
    {
        if (!$this->hotel_id->contains($hotelId)) {
            $this->hotel_id[] = $hotelId;
            $hotelId->setDestination($this);
        }

        return $this;
    }

    public function removeHotelId(Hotel $hotelId): self
    {
        if ($this->hotel_id->contains($hotelId)) {
            $this->hotel_id->removeElement($hotelId);
            // set the owning side to null (unless already changed)
            if ($hotelId->getDestination() === $this) {
                $hotelId->setDestination(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivityId(): Collection
    {
        return $this->activity_id;
    }

    public function addActivityId(Activity $activityId): self
    {
        if (!$this->activity_id->contains($activityId)) {
            $this->activity_id[] = $activityId;
            $activityId->setDestination($this);
        }

        return $this;
    }

    public function removeActivityId(Activity $activityId): self
    {
        if ($this->activity_id->contains($activityId)) {
            $this->activity_id->removeElement($activityId);
            // set the owning side to null (unless already changed)
            if ($activityId->getDestination() === $this) {
                $activityId->setDestination(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Transport[]
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    public function addTransport(Transport $transport): self
    {
        if (!$this->transports->contains($transport)) {
            $this->transports[] = $transport;
            $transport->addDestination($this);
        }

        return $this;
    }

    public function removeTransport(Transport $transport): self
    {
        if ($this->transports->contains($transport)) {
            $this->transports->removeElement($transport);
            $transport->removeDestination($this);
        }

        return $this;
    }
}
