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

    public function getFilmById(string $id): Film
    {
        try {
            $query = "SELECT * FROM FILMS WHERE id_film =:id";
            $stmt = $this->pdo->prepare($query);
            $stmt -> execute(['id'=>$id]);
            $film = $stmt->fetch();
            if ($film === false) {
                throw new RepositoryEntityNotFoundException("Film $id no encontrado");
            }
            $film=new Film(
                $film["id_film"],
                $film["title"],
                $film["director"],
                $film["release_year"],
                $film["category"]                
            );
            return $film;
        } catch (\PDOException $e) {
            throw new \Exception("Error PDO al recuperar el film $id". $e->getMessage());
        }
    }

}


