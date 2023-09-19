<?php

namespace App\Models;

class Projeto
{
    private static $table = 'PROJETO'; /*TABELA DO JEITO QUE ESTA NO BANCO*/

    public static function select(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE idProjeto = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum projeto encontrado!");
        }
    }

    public static function selectAll()
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'SELECT * FROM ' . self::$table;
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum projeto encontrado!");
        }
    }

    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'INSERT INTO ' . self::$table . ' (nomeProjeto, descricaoProjeto, liderProjeto)
        VALUES (:no, :ds, :lid)';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':no', $data['nomeProjeto']);
        $stmt->bindValue(':ds', $data['descricaoProjeto']);
        $stmt->bindValue(':lid', $data['liderProjeto']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 'Projeto inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir projeto!");
        }
    } 

    public static function alterar($data)
    {
        //var_dump($data);
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'UPDATE ' . self::$table . ' SET nomeProjeto = :no, descricaoProjeto = :ds, liderProjeto = :lid WHERE idProjeto = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':no', $data['nomeProjeto']);
        $stmt->bindValue(':ds', $data['descricaoProjeto']);
        $stmt->bindValue(':lid', $data['liderProjeto']);
        $stmt->bindValue(':id', $data['idProjeto']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 'Projeto alterado com sucesso!';
        } else {
            throw new \Exception("Falha na tentativa de alterar o projeto");
        }
    }

    public static function delete(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'DELETE FROM ' . self::$table . ' WHERE idProjeto = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 'Projeto excluído com sucesso!';
        } else {
            throw new \Exception("Falha na tentativa de exclusão do proejto");
        }
    }
}
