<?php
class EntrenadorModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getEntrenador($estado)
    {
        $sql = "SELECT * FROM entrenador WHERE estado = $estado";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrar($nombre, $apellido, $telefono, $correo, $direccion)
    {
        $verficar = "SELECT * FROM entrenador WHERE nombre = '$nombre'";
        $existe = $this->select($verficar);
        if (empty($existe)) {
            $sql = "INSERT INTO entrenador(nombre, apellido,telefono, correo, direccion) VALUES (?,?,?,?,?)";
            $datos = array($nombre,$apellido,$telefono, $correo, $direccion);
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
    public function modificar($nombre, $apellido, $telefono, $correo, $direccion, $id)
    {
        $sql = "UPDATE entrenador SET nombre = ?, apellido = ?, telefono=?, correo=?, direccion=? WHERE id = ?";
        $datos = array($nombre, $apellido, $telefono, $correo, $direccion, $id);
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
        $sql = "SELECT * FROM entrenador WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accion($estado, $id)
    {
        $sql = "UPDATE entrenador SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}
