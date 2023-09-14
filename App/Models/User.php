<?php

namespace App\Models;

class User
{
    private static $table = 'usuario'; /*TABELA DO JEITO QUE ESTA NO BANCO*/

    public static function select(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE idUsuario = :id';
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
        $sql = 'INSERT INTO ' . self::$table . ' (nomeUser, cpf, email, tipoUsuario) VALUES (:nu, :cpf, :em, :tu)';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':nu', $data['nomeUser']);
        $stmt->bindValue(':cpf', $data['cpf']);
        $stmt->bindValue(':em', $data['email']);
        $stmt->bindValue(':tu', $data['tipoUsuario']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 'Usuário(a) inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir usuário(a)!");
        }
    }

    public static function delete(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'DELETE FROM ' . self::$table . ' WHERE idUsuario = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 'Usuário excluído com sucesso!';
        } else {
            throw new \Exception("Falha na tentativa de exclusão de usuário");
        }
    }

    public static function alterar($data)
    {
        //var_dump($data);
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'UPDATE ' . self::$table . ' SET usuario.nomeUser = :nu, usuario.cpf = :cpf, usuario.email = :em, usuario.tipoUsuario = :tu WHERE usuario.idUsuario = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':nu', $data['nomeUser']);
        $stmt->bindValue(':cpf', $data['cpf']);
        $stmt->bindValue(':em', $data['email']);
        $stmt->bindValue(':tu', $data['tipoUsuario']);
        $stmt->bindValue(':id', $data['idUsuario']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 'Usuário alterado com sucesso!';
        } else {
            throw new \Exception("Falha na tentativa de alterar de usuário");
        }
    }
}
