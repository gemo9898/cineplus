<?php   

namespace nrv\core\repositoryInterfaces;

use nrv\core\domain\entities\film\Film;

interface FilmRepositoryInterface
{
    public function getFilms(): array;

    public function getFilmById(string $id): Film;
}
