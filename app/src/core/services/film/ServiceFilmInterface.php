<?php
namespace nrv\core\services\film;

use nrv\core\dto\filmDTO;

interface ServiceFilmInterface
{
    
    public function getfilms(): array;

    public function getFilmById(string $id): filmDTO;

}
