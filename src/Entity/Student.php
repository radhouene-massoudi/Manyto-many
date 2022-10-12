<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private ?string $cin = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToMany(targetEntity: Club::class, inversedBy: 'students')]
    #[ORM\JoinTable(name:'student_club')]
    #[ORM\JoinColumn(name: "student_id", referencedColumnName: "cin")]
    #[ORM\InverseJoinColumn(name: "club_id", referencedColumnName: "ref")]
    private Collection $clubs;

    #[ORM\ManyToOne(inversedBy: 'students')]
    private ?Classroom $classrooms = null;

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
    }

    public function getcin()
    {
        return $this->cin;
    }
    public function set(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Club>
     */
    public function getClubs(): Collection
    {
        return $this->clubs;
    }

    public function addClub(Club $club): self
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs->add($club);
        }

        return $this;
    }

    public function removeClub(Club $club): self
    {
        $this->clubs->removeElement($club);

        return $this;
    }

    public function getClassrooms(): ?Classroom
    {
        return $this->classrooms;
    }

    public function setClassrooms(?Classroom $classrooms): self
    {
        $this->classrooms = $classrooms;

        return $this;
    }
}
