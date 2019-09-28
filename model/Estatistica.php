<?php
    require_once('Campeonato.php');
    require_once('Equipe.php');

    class Estatistica{
        private $id;
        private $vitoria;
        private $empate;
        private $derrota;
        private $golpro;
        private $golcontra;
        private $idequipe;
        private $idcampeonato;

        private $campeonato;
        private $equipe;
        
        public function __construct(){
            //$this->campeonato = new Campeonato();
            //$this->equipe = new Equipe();
        }

        //GET
        public function getId():int{
            return $this->id;
        }

        public function getVitoria():int{
            return $this->vitoria;
        }

        public function getEmpate():int{
            return $this->empate;
        }

        public function getDerrota():int{
            return $this->derrota;
        }

        public function getGolPro():int{
            return $this->golpro;
        }

        public function getGolContra():int {
            return $this->golcontra;
        }

        // get - Foregin keys
        public function getIdEquipe():int {
            return $this->idequipe;
        }

        public function getIdCampeonato():int {
            return $this->idcampeonato;
        }

        public function getCampeonato():Campeonato{
            return $this->campeonato;
        }

        public function getEquipe():Equipe{
            return $this->equipe;
        }


        //SET
        public function setId(int $id):void{
            $this->id = $id;
        }

        public function setVitoria(int $vitoria):void{
            $this->vitoria = $vitoria;
        }

        public function setEmpate(int $empate):void{
            $this->empate = $empate;
        }

        public function setDerrota(int $derrota):void{
            $this->derrota = $derrota;
        }

        public function setGolPro(int $golpro):void{
            $this->golpro = $golpro;
        }

        public function setGolContra(int $golcontra):void{
            $this->golcontra = $golcontra;
        }

        // set - foreign keys
        public function setIdCampeonato(int $idcampeonato):void{
            $this->idcampeonato = $idcampeonato;
        } 

        public function setIdEquipe(int $idequipe):void{
            $this->idequipe = $idequipe;
        }
    }

?>