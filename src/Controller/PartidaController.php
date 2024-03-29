<?php 

declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\DTO\PartidaFormDTO;
use App\Http\Entity\Partida;
use App\Http\Helper\InvalidMessageTrait;
use App\Http\Helper\SuccessMessageTrait;
use App\Http\Service\PartidaService;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PartidaController implements RequestHandlerInterface
{
    use SuccessMessageTrait;
    use InvalidMessageTrait;

    public function __construct(
        private PartidaService $partidaService,
        private Engine $templates
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        
        if($request->getMethod() === 'POST'){
            if(str_contains($request->getServerParams()['PATH_INFO'], '/edit')) {
                $id = filter_var($request->getQueryParams()['id'] ?? 0, FILTER_VALIDATE_INT);
                return $this->update($request, $id);
            }
        }
        
        $error404 = new Error404Controller();
        return $error404->handle($request);
    }

    public function update(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        $oldUrl = $request->getServerParams()['HTTP_REFERER'];
        try {
            $partidaData = new PartidaFormDTO($request->getParsedBody(), id: $id);
            $partida = $this->partidaService->findById($partidaData->id);
            
            $partida->setNumGolCasa($partidaData->numGolCasa);
            $partida->setNumGolVisitante($partidaData->numGolVisitante);
            // $partida = new Partida(
            //     $partida->getCampeonatoId(),
            //     $partida->getTimeCasaId(),
            //     $partida->getTimeVisitanteId(),
            //     $partida->getRodada(),
            //     $partidaData->numGolCasa,
            //     $partidaData->numGolVisitante,
            //     $partida->getId()
            // );

            $result = $this->partidaService->save($partida);
            if(!$result) {
                throw new \RuntimeException(); 
            }

            $this->addSuccessMessage("Partida atualizada com sucesso!");
            
        } catch (\Throwable $th) {
            $this->addErrorMessage($th->getTraceAsString());
        }

        return new Response(302, [
                'Location' => $oldUrl,
                'method' => 'GET',
            ]
        );
    }

}