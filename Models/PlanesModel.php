<?php
class PlanesModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getPlanes($estado)
    {
        $sql = "SELECT * FROM planes WHERE estado = $estado";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarPlan($plan, $descripcion, $precio_plan, $condicion, $img, $user)
    {
        $verficar = "SELECT * FROM planes WHERE plan = '$plan'";
        $existe = $this->select($verficar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO planes(plan, descripcion, precio_plan, condicion,imagen, id_user) VALUES (?,?,?,?,?,?)";
            $datos = array($plan, $descripcion, $precio_plan, $condicion,$img, $user);
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
    public function modificarPlan($plan, $descripcion, $precio_plan, $condicion, $img, $id)
    {
        $sql = "UPDATE planes SET plan = ?, descripcion = ?, precio_plan = ?,condicion=?, imagen=? WHERE id = ?";
        $datos = array($plan, $descripcion, $precio_plan, $condicion, $img, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarPlan($id)
    {
        $sql = "SELECT * FROM planes WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionPlan($estado, $id)
    {
        $sql = "UPDATE planes SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function registrarPlanCliente($id_cli, $id_plan, $fecha, $hora,$fecha_venc, $fecha_limite, $user)
    {
        $verficar = "SELECT * FROM detalle_planes WHERE id_cliente = $id_cli AND id_plan = $id_plan AND estado = 1";
        $existe = $this->select($verficar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO detalle_planes(id_cliente, id_plan, fecha, hora,fecha_venc, fecha_limite, id_user) VALUES (?,?,?,?,?,?,?)";
            $datos = array($id_cli, $id_plan, $fecha, $hora, $fecha_venc, $fecha_limite, $user);
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
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }
    public function desactivarPlan($estado, $id)
    {
        $sql = "UPDATE detalle_planes SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        }else{
            $res = 'error';
        }
        return $res;
    }
    public function consultarDetalle($id)
    {
        $sql = "SELECT d.*, p.id, p.precio_plan FROM detalle_planes d INNER JOIN planes p ON p.id = d.id_plan WHERE d.id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function registrarPago($fecha_venc, $fecha_limite, $id)
    {
        $sql = "UPDATE detalle_planes SET fecha_venc = ?, fecha_limite=? WHERE id = ?";
        $datos = array($fecha_venc, $fecha_limite, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }
    public function registrarDetallePago($id_detalle, $id_cli, $id_plan, $precio, $fecha, $hora, $id_user)
    {
        $sql = "INSERT INTO pagos_planes (id_detalle, id_cliente, id_plan, precio, fecha, hora, id_user) VALUES (?,?,?,?,?,?,?)";
        $datos = array($id_detalle, $id_cli, $id_plan, $precio, $fecha, $hora, $id_user);
        $data = $this->insertar($sql, $datos);
        if ($data) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }

}
