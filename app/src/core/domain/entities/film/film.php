<?php

namespace nrv\core\domain\entities\film;

use nrv\core\domain\entities\Entity;
use nrv\core\dto\filmDTO;
class Film extends Entity {
    protected string $id_film;
    protected string $title;
    protected string $director;
    protected string $release_year;
    protected string $category;

    public function __construct(string $id_film, string $title, string $director, string $release_year, string $category) {
        
        $this->id_film = $id_film;
        $this->title = $title;
        $this->director = $director;
        $this->release_year = $release_year;
        $this->category = $category;
    }

    // Getters

    public function getTitle() {
        return $this->title;
    }

    public function getDirector() {
        return $this->director;
    }

    public function getReleaseYear() {
        return $this->release_year;
    }

    public function getCategory() {
        return $this->category;
    }

    // Setters
    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDirector($director) {
        $this->director = $director;
    }

    public function setReleaseYear($release_year) {
        $this->release_year = $release_year;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function toDTO() : filmDTO {
        return new filmDTO ($this);
    }
}
