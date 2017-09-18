<?php
include $_SERVER['DOCUMENT_ROOT']."/db/MySQL.class.php";

class InformacaoCurso
{
    private $id;
    private $titulo;
    private $conteudo;
        
    public function __construct($id = null, $titulo = null, $conteudo = null)
    {
        $this->id = $id;
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

    public function listarUm()
    {
        $con = new MySQL();
        $sql = "SELECT * FROM InformacaoCurso WHERE titulo='$this->titulo'";
        $resultado = $con->consulta($sql);
        $informacao = new InformacaoCurso();
        if (!empty($resultado)) {
            $this->id = $resultado[0]["id"];
            $this->titulo = $resultado[0]["titulo"];
            $this->conteudo = $resultado[0]["conteudo"];
            return $informacao;
        } else {
            return false;
        }
    }

    public function listarTodos()
    {
        $con = new MySQL();
        $sql = "SELECT * FROM InformacaoCurso";
        $resultados = $con->consulta($sql);
        if (!empty($resultados)) {
            $informacoes = array();
            foreach ($informacoes as $informacao) {
                $informacao = new InformacaoCurso();
                $informacao->setId($resultado['id']);
                $informacao->setTitulo($resultado['titulo']);
                $informacao->setConteudo($resultado['conteudo']);
                $informacoes[] = $informacao;
            }
            return $informacoes;
        } else {
            return false;
        }
    }
        
        
    public function inserir()
    {
        $con = new MySQL();
        $sql = "INSERT INTO InformacaoCurso (titulo, conteudo) VALUES ('$this->titulo', '$this->conteudo')";
        $con->executa($sql);
    }
}
