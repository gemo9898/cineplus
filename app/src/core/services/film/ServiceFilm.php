<?php
namespace nrv\core\services\film;

use nrv\core\dto\filmDTO;
use nrv\core\repositoryInterfaces\FilmRepositoryInterface;

class ServiceFilm  implements ServiceFilmInterface
{
    private FilmRepositoryInterface $filmRepository;

    public function __construct(FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }    

    public function getFilms(): array
    {
        $films = $this->filmRepository->getFilms();
        $filmsDTO = [];
        foreach ($films as $film) {
            $filmsDTO[] = $film->toDTO();
        }
        return $filmsDTO;
    }
}
