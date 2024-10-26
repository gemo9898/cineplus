<?php

namespace nrv\application\actions;

use nrv\core\services\film\ServiceFilmInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use nrv\application\renderer\JsonRenderer;
use nrv\core\services\film\ServiceFilmNotFoundException;
use nrv\core\repositoryInterfaces\FilmRepositoryInterface;



class getFilmByIdAction extends AbstractAction
{
    private ServiceFilmInterface  $servicefilm;


    public function __construct(ServiceFilmInterface $servicefilm)
    {
        $this->servicefilm = $servicefilm;
        
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $id = (string) $args['id'];

        try {
            $filmDto = $this->servicefilm->getFilmById($id);
                $filmsResponse= [
                    'self' => "/films/{$filmDto->id_film}",
                    'title' => $filmDto->title,
                    'director' => $filmDto ->director,
                    'release year' => $filmDto->release_year,
                    'category' => $filmDto->category                    
                ];
            
            return JsonRenderer::render($rs, 200, ['films' => $filmsResponse]);

        } catch (ServiceFilmNotFoundException $e) {
            return JsonRenderer::render($rs, 404, ['error' => $e->getMessage()]);
        }
    }
}