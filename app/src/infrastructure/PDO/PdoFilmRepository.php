<?php
namespace nrv\infrastructure\PDO;

use nrv\core\repositoryInterfaces\FilmRepositoryInterface;
use nrv\core\domain\entities\film\Film;
use nrv\core\repositoryInterfaces\RepositoryEntityNotFoundException;


use PDO;

class PdoFilmRepository implements FilmRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    } 

    // public function getFilms(): array
    // {
    //     $query = "SELECT * FROM films";
    //     $stmt = $this->pdo->query($query);
    //     $films = $stmt->fetchAll();
    //     $filmEntities = [];
    //     foreach ($films as $film) {
    //         $filmEntity = new Film(
    //             $film['title'],
    //              $film['director'], 
    //              $film['release_year'], 
    //              $film['category']
    //         );
    //         $filmEntity->setID($film['id_film']);
    //         $filmEntities[] = $filmEntity;
    //     }
    //     return $filmEntities;
    // }

    public function getfilms(): array
    {
        try {
            $query = "SELECT * FROM films";
            $stmt = $this->pdo->query($query);
            $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($films === false) {
                throw new RepositoryEntityNotFoundException("Aucun film trouvé.");
            }

            $filmsEntities = [];
            foreach ($films as $film) {
            $filmEntity = new Film(
                $film['id_film'],
                $film['title'],
                 $film['director'], 
                 $film['release_year'], 
                 $film['category']
                );
                // $filmEntity->setID($film['id_film']);
                $filmsEntities[] = $filmEntity;
            }

            return $filmsEntities;

        } catch (\PDOException $e) {
            throw new \Exception("Erreur PDO lors de la récupération des films : " . $e->getMessage());
        }
    }

}


