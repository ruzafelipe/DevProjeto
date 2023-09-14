<?php

namespace App\Models;

class Profissional
{
    private static $table = 'PROFISSIONAL'; /*TABELA DO JEITO QUE ESTA NO BANCO*/

    public static function select(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE idProfissional = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
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
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'INSERT INTO ' . self::$table . ' (nome, sobrenome, habilidade1, habilidade2, observacoes, cidade, estado, email)
        VALUES (:no, :sn, :hab1, :hab2, :obs, :cd, :uf, :em)';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':no', $data['nome']);
        $stmt->bindValue(':sn', $data['sobrenome']);
        $stmt->bindValue(':hab1', $data['habilidade1']);
        $stmt->bindValue(':hab2', $data['habilidade2']);
        $stmt->bindValue(':obs', $data['observacoes']);
        $stmt->bindValue(':cd', $data['cidade']);
        $stmt->bindValue(':uf', $data['estado']);
        $stmt->bindValue(':em', $data['email']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 'Profissional inserido(a) com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir usuário(a)!");
        }
    } 

    public static function alterar($data)
    {
        //var_dump($data);
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'UPDATE ' . self::$table . ' SET nome = :no, sobrenome = :sn, habilidade1 = :hab1, habilidade2 = :hab2, observacoes = :obs,
        cidade = :cd, estado = :uf, email = :em WHERE idProfissional = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':no', $data['nome']);
        $stmt->bindValue(':sn', $data['sobrenome']);
        $stmt->bindValue(':hab1', $data['habilidade1']);
        $stmt->bindValue(':hab2', $data['habilidade2']);
        $stmt->bindValue(':obs', $data['observacoes']);
        $stmt->bindValue(':cd', $data['cidade']);
        $stmt->bindValue(':uf', $data['estado']);
        $stmt->bindValue(':em', $data['email']);
        $stmt->bindValue(':id', $data['idProfissional']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 'Profissional alterado(a) com sucesso!';
        } else {
            throw new \Exception("Falha na tentativa de alterar de usuário");
        }
    }

    public static function delete(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'DELETE FROM ' . self::$table . ' WHERE idProfissional = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 'Usuário excluído com sucesso!';
        } else {
            throw new \Exception("Falha na tentativa de exclusão de usuário");
        }
    }
}
