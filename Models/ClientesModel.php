<?php
class ClientesModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }
    public function getClientes($estado)
    {
        $sql = "SELECT * FROM clientes WHERE estado = $estado";
        $data = $this->selectAll($sql);
        return $data;
    }
    //Buscar Para agregar Plan
    public function buscarCliente($valor)
    {
        $sql = "SELECT id, nombre, direccion FROM clientes WHERE nombre LIKE '%" . $valor . "%' AND estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    //Buscar para agregar Pago
    public function buscarPlanCliente($valor)
    {
        $sql = "SELECT c.id, c.nombre, c.estado, d.id AS id_detalle, d.id_cliente, d.id_plan, d.fecha_venc, d.fecha_limite, p.id, p.plan, p.precio_plan FROM clientes c INNER JOIN detalle_planes d ON d.id_cliente = c.id INNER JOIN planes p ON p.id = d.id_plan WHERE c.nombre LIKE '%" . $valor . "%' AND c.estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function buscarPlanes($id)
    {
        $sql = "SELECT d.id, d.id_cliente, d.id_plan, p.id AS id_, p.plan FROM detalle_planes d INNER JOIN planes p ON d.id_plan = p.id WHERE d.id_cliente = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function buscar_planes($valor)
    {
        $sql = "SELECT id, plan, precio_plan FROM planes WHERE plan LIKE '%" . $valor . "%' AND estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarCliente($dni, $nombre, $telefono, $direccion, $id_user)
    {
        $verficar = "SELECT * FROM clientes WHERE dni = '$dni'";
        $existe = $this->select($verficar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO clientes(dni, nombre, telefono, direccion, id_user) VALUES (?,?,?,?,?)";
            $datos = array($dni, $nombre, $telefono, $direccion, $id_user);
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
    public function modificarCliente($dni, $nombre, $telefono ,$direccion, $id)
    {
        $sql = "UPDATE clientes SET dni = ?, nombre = ?, telefono = ? ,direccion = ? WHERE id = ?";
        $datos = array($dni, $nombre, $telefono ,$direccion, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarCli($id)
    {
        $sql = "SELECT * FROM clientes WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionCli($estado, $id)
    {
        $sql = "UPDATE clientes SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function getPagos()
    {
        $sql = "SELECT p.*, c.nombre, pl.plan, pl.precio_plan FROM pagos_planes p INNER JOIN clientes c ON c.id = p.id_cliente INNER JOIN planes pl ON pl.id = p.id_plan";
        $data = $this->selectAll($sql);
        return $data;
    }
    
    public function getPlanCliente()
    {
        $sql = "SELECT d.*, p.plan, p.precio_plan, c.dni, c.nombre FROM detalle_planes d INNER JOIN planes p ON d.id_plan = p.id INNER JOIN clientes c ON d.id_cliente = c.id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function ver($id)
    {
        $sql = "SELECT d.*, p.id AS id_plan, p.plan, p.precio_plan, c.id AS id_cli, c.dni, c.nombre FROM detalle_planes d INNER JOIN planes p ON d.id_plan = p.id INNER JOIN clientes c ON d.id_cliente = c.id WHERE d.id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function getPdf($id)
    {
        $sql = "SELECT d.*, p.id AS id_plan, p.plan, p.precio_plan, c.id AS id_cli, c.dni, c.nombre, c.direccion, dp.id, dp.fecha_venc FROM pagos_planes d INNER JOIN planes p ON d.id_plan = p.id INNER JOIN clientes c ON d.id_cliente = c.id INNER JOIN detalle_planes dp ON dp.id = d.id_detalle WHERE d.id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function getPdfCliente($id)
    {
        $sql = "SELECT d.precio, d.fecha, d.hora, p.plan, c.dni, c.nombre, c.direccion, dp.id, dp.fecha_venc FROM pagos_planes d INNER JOIN planes p ON d.id_plan = p.id INNER JOIN clientes c ON d.id_cliente = c.id INNER JOIN detalle_planes dp ON dp.id = d.id_detalle WHERE d.id_cliente = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarPagoCliente($id_detalle, $id_cli, $id_plan, $precio, $fecha, $hora, $user)
    {
        $sql = "INSERT INTO pagos_planes(id_detalle, id_cliente, id_plan, precio, fecha, hora, id_user) VALUES (?,?,?,?,?,?,?)";
        $datos = array($id_detalle, $id_cli, $id_plan, $precio, $fecha, $hora, $user);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = "error";
        }
        return $res;
    }
    public function ver_pagos($id_cli)
    {
        $sql = "SELECT p.*, c.id AS id_cli, c.nombre, pl.id AS id_plan, pl.plan, pl.precio_plan FROM pagos_planes p INNER JOIN clientes c ON c.id = p.id_cliente INNER JOIN planes pl ON pl.id = p.id_plan WHERE p.id_cliente = $id_cli";
        $data = $this->selectAll($sql);
        return $data;
    }
}
