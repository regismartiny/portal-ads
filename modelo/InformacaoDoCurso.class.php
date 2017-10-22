<?php
include_once $_SERVER['DOCUMENT_ROOT']."/db/MySQL.class.php";

class InformacaoDoCurso
{
    private $id;
    private $chave;
    private $titulo;
    private $conteudo;
        
    public function __construct($id = null, $chave = null, $titulo = null, $conteudo = null)
    {
        $this->id = $id;
        $this->chave = $chave;
        $this->titulo = $titulo;
        $this->conteudo = $conteudo;
    }
        
    public function getId()
    {
        return $this->id;
    }
        
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getChave()
    {
        return $this->chave;
    }
        
    public function setChave($chave)
    {
        $this->chave = $chave;
    }
        
    public function getTitulo()
    {
        return $this->titulo;
    }
        
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
        
    public function getConteudo()
    {
        return $this->conteudo;
    }
        
    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
    }

    public function listarPorId() {
        $con = new MySQL();
        $sql = "SELECT * FROM InformacaoDoCurso WHERE id='$this->id'";
        $resultado = $con->consulta($sql);
        if (!empty($resultado)) {
            $this->id = $resultado[0]["id"];
            $this->chave = $resultado[0]["chave"];
            $this->titulo = $resultado[0]["titulo"];
            $this->conteudo = $resultado[0]["conteudo"];
            return true;
        } else {
            return false;
        }
    }

    public function listarPorChave() {
        $con = new MySQL();
        $sql = "SELECT * FROM InformacaoDoCurso WHERE chave LIKE '$this->chave'";
        $resultado = $con->consulta($sql);
        if (!empty($resultado)) {
            $this->id = $resultado[0]["id"];
            $this->chave = $resultado[0]["chave"];
            $this->titulo = $resultado[0]["titulo"];
            $this->conteudo = $resultado[0]["conteudo"];
            return true;
        } else {
            return false;
        }
    }

    public function listarTodos() {
        $con = new MySQL();
        $sql = "SELECT * FROM InformacaoDoCurso";
        $resultados = $con->consulta($sql);
        if (!empty($resultados)) {
            $informacoes = array();
            foreach ($informacoes as $informacao) {
                $informacao = new InformacaoDoCurso();
                $informacao->setId($resultado['id']);
                $informacao->setChave($resultado['chave']);
                $informacao->setTitulo($resultado['titulo']);
                $informacao->setConteudo($resultado['conteudo']);
                $informacoes[] = $informacao;
            }
            return $informacoes;
        } else {
            return false;
        }
    }
        
        
    public function inserir() {
        $con = new MySQL();
        $sql = "INSERT INTO InformacaoDoCurso (chave, titulo, conteudo) VALUES ('$this->chave', '$this->titulo', '$this->conteudo')";
        return $con->executa($sql) > 0;
    }
}
