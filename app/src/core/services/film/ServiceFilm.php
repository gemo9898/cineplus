<?php
namespace nrv\core\services\film;

use nrv\core\dto\filmDTO;
use nrv\core\repositoryInterfaces\FilmRepositoryInterface;
use nrv\core\repositoryInterfaces\RepositoryEntityNotFoundException;

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

    public function getFilmById(string $id): filmDTO
    {
        try {
            return $this->filmRepository->getFilmById($id)->toDTO();
        } catch (RepositoryEntityNotFoundException $e) {
            throw new ServiceFilmNotFoundException ($e->getMessage());
        }catch (\Exception $e) {
            throw new \Exception($e ->getMessage());
        }
    }
    
}
