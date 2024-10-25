<?php
namespace nrv\core\dto;

use nrv\core\domain\entities\film\Film;
use nrv\core\dto\DTO;
class filmDTO  extends DTO{
    protected string $id_film;
    protected string $title;
    protected string $director;
    protected string $release_year;
    protected string $category;

    public function __construct(Film $film) {
        $this->id_film = $film->id_film;
        $this->title = $film->getTitle();
        $this->director = $film->getDirector();
        $this->release_year = $film->getReleaseYear();
        $this->category = $film->getCategory();
    }

    public function toEntity(): Film
    {
        return new Film($this->title, $this->director, $this->release_year, $this->category);   
    }
}