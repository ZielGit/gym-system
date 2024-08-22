<?php
class UsuariosModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario($usuario, $clave)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave' AND estado = 1";
        $data = $this->select($sql);
        return $data;
    }
    public function getUsuarios($estado)
    {
        $sql = "SELECT * FROM usuarios WHERE estado = $estado";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarUsuario($usuario, $nombre, $correo, $telefono, $clave, $rol)
    {
        $vericar = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $existe = $this->select($vericar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO usuarios(usuario, nombre, correo, telefono, clave, rol) VALUES (?,?,?,?,?,?)";
            $datos = array($usuario, $nombre, $correo, $telefono, $clave, $rol);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            }else{
                $res = "error";
            }
        }else{
            $res = "existe";
        }
        return $res;
    }
    public function modificarUsuario($usuario, $nombre, $correo, $telefono, $rol, $id)
    {
        $sql = "UPDATE usuarios SET usuario = ?, nombre = ?, correo=?, telefono=?, rol=? WHERE id = ?";
        $datos = array($usuario, $nombre, $correo, $telefono, $rol, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarUser($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function getPass($clave, $id)
    {
        $sql = "SELECT * FROM usuarios WHERE clave = '$clave' AND id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionUser($estado, $id)
    {
        $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function modificarPass($clave, $id)
    {
        $sql = "UPDATE usuarios SET clave = ? WHERE id = ?";
        $datos = array($clave, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function modificarDato($usuario, $nombre, $correo, $id)
    {
        $sql = "UPDATE usuarios SET usuario=?, nombre=?, correo=? WHERE id=?";
        $datos = array($usuario, $nombre, $correo, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 1;
        }else{
            $res = 0;
        }
        return $res;
    }
}
?>