<?php
class Denuncia {

    private $conn;
    private $table = "denuncias";

    public function __construct($db){
        $this->conn = $db;
    }

    public function listar($busqueda = '', $estado = '', $pagina = 1, $porPagina = 10){
        $offset = ($pagina - 1) * $porPagina;
        $where = [];
        $params = [];
        
        if (!empty($busqueda)) {
            $where[] = "(titulo LIKE :busqueda OR ciudadano LIKE :busqueda OR ubicacion LIKE :busqueda)";
            $params[':busqueda'] = "%$busqueda%";
        }
        
        if (!empty($estado)) {
            $where[] = "estado = :estado";
            $params[':estado'] = $estado;
        }
        
        $whereClause = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";
        
        $query = "SELECT * FROM $this->table $whereClause ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }
        
        $stmt->bindValue(':limit', $porPagina, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function contar($busqueda = '', $estado = ''){
        $where = [];
        $params = [];
        
        if (!empty($busqueda)) {
            $where[] = "(titulo LIKE :busqueda OR ciudadano LIKE :busqueda OR ubicacion LIKE :busqueda)";
            $params[':busqueda'] = "%$busqueda%";
        }
        
        if (!empty($estado)) {
            $where[] = "estado = :estado";
            $params[':estado'] = $estado;
        }
        
        $whereClause = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";
        
        $query = "SELECT COUNT(*) as total FROM $this->table $whereClause";
        $stmt = $this->conn->prepare($query);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }
        
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function crear($data){
        $sql = "INSERT INTO $this->table(titulo, descripcion, ubicacion, estado, ciudadano, telefono_ciudadano)
                VALUES(:titulo, :descripcion, :ubicacion, :estado, :ciudadano, :telefono_ciudadano)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function obtener($id){
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function actualizar($data){
        $sql = "UPDATE $this->table SET 
                titulo=:titulo,
                descripcion=:descripcion,
                ubicacion=:ubicacion,
                estado=:estado,
                ciudadano=:ciudadano,
                telefono_ciudadano=:telefono_ciudadano
                WHERE id=:id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function eliminar($id){
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id=?");
        return $stmt->execute([$id]);
    }
}
