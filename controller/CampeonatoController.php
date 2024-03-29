<?php
    require_once(__ROOT__.'/DAO/CampeonatoDAO.php');
    require_once('UsuarioController.php');

    $usuario = new UsuarioController();
    $usuario->sessao();

    class CampeonatoController{

        private $campeonatoDAO;

        public function __construct(){
            $this->campeonatoDAO = new CampeonatoDAO();
        }

        //Listas
        public function listarId(int $id){
            return $this->campeonatoDAO->listarId($id);
        }

        public function listarCampeonato():array{
            return $this->campeonatoDAO->listarCampeonato();
        }

        public function numeroRodadas(int $equipe,bool $turno):int{
            $rodadas = ($equipe-1);
            if($equipe%2 != 0){
                $rodadas++;
            }
            if($turno){
                $rodadas = $rodadas*2;
            }
            return $rodadas;
        }

        public function condicaoTurno(bool $turno):string{
            $status = 'desligado';
            if($turno)
                $status = 'ligado';
            return $status;
        }

        //Inserir
        public function inserirCampeonato(string $nome, int $nequipe, bool $turno):int{
            return $this->campeonatoDAO->inserirCampeonato($nome,$nequipe,$turno);
        }
        //Modificar
        

        //Deletar (logicamente)

        //Deletar
    }


?>