<?php
include $_SERVER['DOCUMENT_ROOT']."/db/MySQL.class.php";

class InformacaoCurso
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

    public function listarUm()
    {
        $con = new MySQL();
        $sql = "SELECT * FROM InformacaoCurso WHERE titulo='$this->chave'";
        $resultado = $con->consulta($sql);
        $informacao = new InformacaoCurso();
        if (!empty($resultado)) {
            $this->id = $resultado[0]["id"];
            $this->chave = $resultado[0]["chave"];
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
        
        
    public function inserir()
    {
        $con = new MySQL();
        $sql = "INSERT INTO InformacaoCurso (chave, titulo, conteudo) VALUES ('$this->chave', '$this->titulo', '$this->conteudo')";
        $con->executa($sql);
    }
}
