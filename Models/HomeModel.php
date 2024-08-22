<?php
class HomeModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
    public function getPlanes(int $estado)
    {
        $sql = "SELECT * FROM planes WHERE estado = $estado";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }
    public function getUsuarios(int $estado)
    {
        $sql = "SELECT nombre, correo,foto, estado FROM usuarios WHERE estado = $estado";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getDatos($table)
    {
        $sql = "SELECT COUNT(id) AS total FROM $table WHERE estado = 1";
        $data = $this->select($sql);
        return $data;
    }
}

?>