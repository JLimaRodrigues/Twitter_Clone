<?php 

namespace App\Models;

use MF\Model\Model;

class Tweet extends Model {

    private $id;
    private $id_usuario;
    private $tweet;
    private $data;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        return $this->$atributo = $valor;
    }

    //salvar 
    public function salvar(){

        $query = 'INSERT INTO tweets(id_usuario, tweet) VALUES (:id_usuario, :tweet)';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':tweet', $this->__get('tweet'));
        $stmt->execute();

        return $this;
    }

    //recuperar
    public function getAll(){

        $query = "
            SELECT 
                t.id, t.id_usuario, u.nome, t.tweet, DATE_FORMAT(t.data, '%d/%m/%Y %H:%i') as data
            FROM 
                tweets as t
            LEFT JOIN usuarios as u on (t.id_usuario = u.id) 
            WHERE 
                id_usuario = :id_usuario
                OR t.id_usuario in (SELECT id_usuario_seguindo FROM usuarios_seguidores WHERE id_usuario = :id_usuario)
            ORDER BY 
                t.data DESC
            ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //recuperar por paginação
    public function getPorPagina($limit, $offset){

        $query = "
            SELECT 
                t.id, t.id_usuario, u.nome, t.tweet, DATE_FORMAT(t.data, '%d/%m/%Y %H:%i') as data
            FROM 
                tweets as t
            LEFT JOIN usuarios as u on (t.id_usuario = u.id) 
            WHERE 
                id_usuario = :id_usuario
                OR t.id_usuario in (SELECT id_usuario_seguindo FROM usuarios_seguidores WHERE id_usuario = :id_usuario)
            ORDER BY 
                t.data DESC
            LIMIT 
                $limit
            OFFSET
                $offset
            ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //recuperar total de tweets
    public function getTotalRegistros(){

        $query = "
            SELECT 
                count(*) as total
            FROM 
                tweets as t
            LEFT JOIN usuarios as u on (t.id_usuario = u.id) 
            WHERE 
                id_usuario = :id_usuario
                OR t.id_usuario in (SELECT id_usuario_seguindo FROM usuarios_seguidores WHERE id_usuario = :id_usuario)
            ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function removerTweet(){

        $query = 'DELETE FROM tweets WHERE id = :id_tweet';

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_tweet', $this->__get('id'));
        $stmt->execute();

        return true;
    }
}

?>