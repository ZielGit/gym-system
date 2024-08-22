<?php
class RutinasModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getRutinas($estado)
    {
        $sql = "SELECT * FROM rutinas WHERE estado = $estado";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrar($dia, $descripcion, $user)
    {
        $verficar = "SELECT * FROM rutinas WHERE dia = '$dia'";
        $existe = $this->select($verficar);
        if (empty($existe)) {
            $sql = "INSERT INTO rutinas(dia, descripcion, id_user) VALUES (?,?,?)";
            $datos = array($dia, $descripcion, $user);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function modificar($dia, $descripcion, $id)
    {
        $sql = "UPDATE rutinas SET dia = ?, descripcion = ? WHERE id = ?";
        $datos = array($dia, $descripcion, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editar($id)
    {
        $sql = "SELECT * FROM rutinas WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accion($estado, $id)
    {
        $sql = "UPDATE rutinas SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}
