<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */



class Tareas_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get tareas by idTarea
     */
    function get_tareas($idTarea)
    {
        return $this->db->get_where('tarea',array('idTarea'=>$idTarea))->row_array();
    }

    /**
     * Ver detalles de tarea completo
     * @author SAKZEDMK
     */
    function ver_detalles_tarea($idTarea)
    {
      $query="SELECT tarea.*,tipotarea.nombreTipoTarea,tipotarea.descripcionTarea,estado_tarea.idEstado,estado_tarea.nombreEstado,planta.idPlanta,planta.nombrePlanta,planta.nombreCientificoPlanta,CONCAT(creo.first_name,' ',creo.last_name) as Creador, CONCAT(uso.first_name,' ',uso.last_name) as Atendio,umbraculo.idUmbraculo,umbraculo.nombreUmbraculo, tarea.horaAtencion,tarea.active
              FROM tarea
              JOIN umbraculo ON umbraculo.idUmbraculo = tarea.idUmbraculo
              JOIN tipotarea ON tipotarea.idTipoTarea = tarea.idTipoTarea
              JOIN estado_tarea ON estado_tarea.idEstado = tarea.idEstado
              JOIN planta ON planta.idPlanta = tarea.idPlanta
              LEFT OUTER JOIN users creo ON creo.id = tarea.idUserCreador
              LEFT OUTER JOIN users uso ON uso.id = tarea.idUserAtencion

              WHERE idTarea=".$idTarea;
        return $this->db->query($query)->result_array();
    }

    /*
     * Get all tareas
     */
    function get_all_tareas()
    {
        $this->db->order_by('idTarea', 'desc');
        return $this->db->get('tarea')->result_array();
    }


    /**
     * RETORNA EL LISTADO DE LAS TAREAS (CON UN LIMITE DE TRES ELEMENTOS, PARA SU PRESENTACIÓN EN EL "VER UMBRACULO")
     * JUNTO CON EL JOIN DE TODOS LOS CAMPOS RELACIONADOS A UNA TAREA.
     * @param  [type] $idUmbraculo EL UMBRACULO SELECCIONADO SOBRE EL CUAL SE REALIZA LA CONSULTA
     * @return [type]              [description]
     * @author SAKZEDMK
     */
    function obtener_tareas_umbraculo($idUmbraculo)
    {
        $query ="SELECT tt.nombreTipoTarea,et.nombreEstado,t.fechaCreacion,t.fechaComienzo,p.nombrePlanta,t.idTarea, CONCAT(u.first_name,' ',u.last_name) AS creador
                    FROM tarea t
                    JOIN tipotarea tt ON t.idTipoTarea = tt.idTipoTarea
                    JOIN estado_tarea et ON t.idEstado= et.idEstado
                    JOIN users u ON t.idUserCreador = u.id
                    JOIN planta p ON t.idPlanta = p.idPlanta
                    WHERE t.idUmbraculo=".$idUmbraculo." ORDER BY t.fechaCreacion DESC LIMIT 0,3";
        return $this->db->query($query)->result_array();
    }



    function all_estado_tareas()
    {
        $query ="SELECT *
                    FROM estado_tarea";
        return $this->db->query($query)->result_array();
    }

    function get_all_insumo()
    {
        $query ="SELECT *
                    FROM insumo
                    WHERE insumo.cantidad>0 AND insumo.active=1";
        return $this->db->query($query)->result_array();
    }

    function get_tarea_join($idTarea)
    {
        $query ="SELECT tt.nombreTipoTarea,et.nombreEstado,t.fechaCreacion,t.fechaComienzo,p.nombrePlanta,t.idTarea, CONCAT(u.first_name,' ',u.last_name) AS creador,umb.nombreUmbraculo,umb.idUmbraculo,t.observacionEspecialista,t.idEstado
                    FROM tarea t
                    JOIN tipotarea tt ON t.idTipoTarea = tt.idTipoTarea
                    JOIN estado_tarea et ON t.idEstado= et.idEstado
                    JOIN users u ON t.idUserCreador = u.id
                    JOIN planta p ON t.idPlanta = p.idPlanta
                    JOIN umbraculo umb ON t.idUmbraculo = umb.idUmbraculo
                    WHERE t.idTarea=".$idTarea."
                    LIMIT 0,1";

        return $this->db->query($query)->result_array();
    }



    function comprobar_existencia_tarea($id1, $id2, $id3,$id4)
    {
      //consulta de tareas en el umbraculo y en la misma planta con la misma fecha ingresada
      $vector = $this->db->get_where('tarea',array('idUmbraculo'=>$id1,'fechaComienzo'=>$id2,'idPlanta'=>$id3, 'idTipoTarea'=>$id4))->row_array();

      if (  ($vector==null)){
      return false;
      }
      else {
        return true;}
      }

      /**
       * Consultar las tareas para el área de notificaciones
       * @param  [type] $fecha [description]
       * @return [type]        [description]
       */
      function consultar_tareas($fecha)
      {
        $query="SELECT  tipotarea.nombreTipoTarea,tipotarea.descripcionTarea,umbraculo.nombreUmbraculo,tarea.fechaComienzo,tarea.horaComienzo,planta.nombrePlanta,tarea.idUmbraculo,tarea.idTarea,tarea.idEstado
                FROM `tarea`
                JOIN tipotarea ON tipotarea.idTipoTarea = tarea.idTipoTarea
                JOIN umbraculo ON umbraculo.idUmbraculo = tarea.idUmbraculo
                JOIN planta ON planta.idPlanta = tarea.idPlanta
                WHERE tarea.fechaComienzo=('".$fecha."') ";
        return $this->db->query($query)->result_array();
      }
      //agrego nuevo elemento en insumo/tarea
      function add_insumoTarea($idTarea,$idInsumo,$cantidad)
  {
      $query="INSERT INTO `insumo/tarea`(`idInsumo`, `idTarea`, `cantidadUtilizado`) VALUES (".$idInsumo.",".$idTarea.",".$cantidad.")";
      $this->db->query($query);
  }


//borro elemento en insumo/tarea
function delete_insumoTarea($idTarea,$idInsumo)
{
return $this->db->delete('insumo/tarea',array('idInsumo'=>$idInsumo,'idTarea'=>$idTarea));
}
  /** nueva cantidad **/
  function update_cantidad($idInsumo,$nuevoStock)
  {
    $this->db->where('idInsumo',$idInsumo);
    $query = "UPDATE `insumo` SET `cantidad`=".$nuevoStock." WHERE `insumo`.`idInsumo`=".$idInsumo;
    $this->db->query($query);
  }

  /** existe insumo en tarea **/
  function no_existe_insumo_tarea($idTarea,$idInsumo)
  {
    //consulta de tareas en el umbraculo y en la misma planta con la misma fecha ingresada
    $vector = $this->db->get_where('insumo/tarea',array('idTarea'=>$idTarea,'idInsumo'=>$idInsumo))->row_array();

    if (  ($vector==null)){
    return true;
    }
    else {

      return false;}
    }

      /**
       * Retorna la cantidad de tareas, para el día de la fecha
       * @param  [type] $fecha [description]
       * @return [type]        [description]
       */
      function nro_tareas ($fecha)
      {
        $query="SELECT  tipotarea.nombreTipoTarea,tipotarea.descripcionTarea,umbraculo.nombreUmbraculo,tarea.fechaComienzo,tarea.horaComienzo
                FROM `tarea`
                JOIN tipotarea ON tipotarea.idTipoTarea = tarea.idTipoTarea
                JOIN umbraculo ON umbraculo.idUmbraculo = tarea.idUmbraculo
                WHERE tarea.fechaComienzo=('".$fecha."')";
        return $this->db->query($query)->num_rows();

      }




    /**
     * RETORNA EL LISTADO DE TODAS LAS TAREAS PERTENECIENTES A UM UMBRACULO
     * JUNTO CON EL JOIN DE TODOS LOS CAMPOS RELACIONADOS A UNA TAREA.
     * @param  [type] $idUmbraculo EL UMBRACULO SELECCIONADO SOBRE EL CUAL SE REALIZA LA CONSULTA
     * @author SAKZEDMK
     */
    function listar_tareas_umbraculo($idUmbraculo)
    {
        $query ="SELECT tt.nombreTipoTarea,et.nombreEstado,et.idEstado,t.fechaCreacion,t.fechaComienzo,p.nombrePlanta,t.idTarea, CONCAT(u.first_name,' ',u.last_name) AS creador, t.active
        -- , ua.idUserAtencion
        -- ,CONCAT(ua.first_name,' ',ua.last_name) AS atencion
                    FROM tarea t
                    JOIN tipotarea tt ON t.idTipoTarea = tt.idTipoTarea
                    JOIN estado_tarea et ON t.idEstado= et.idEstado
                    JOIN users u ON t.idUserCreador = u.id
                    -- JOIN users ua ON t.idUserAtencion = ua.id
                    JOIN planta p ON t.idPlanta = p.idPlanta
                    WHERE t.idUmbraculo=".$idUmbraculo." ORDER BY t.fechaCreacion DESC";
        return $this->db->query($query)->result_array();
    }


    function listar_tareas()
    {
        $query ="SELECT tt.nombreTipoTarea,et.nombreEstado,et.idEstado,t.fechaCreacion,t.fechaComienzo,p.nombrePlanta,t.idTarea, CONCAT(u.first_name,' ',u.last_name) AS creador,t.active
        -- , ua.idUserAtencion
        -- ,CONCAT(ua.first_name,' ',ua.last_name) AS atencion
                    FROM tarea t
                    JOIN tipotarea tt ON t.idTipoTarea = tt.idTipoTarea
                    JOIN estado_tarea et ON t.idEstado= et.idEstado
                    JOIN users u ON t.idUserCreador = u.id
                    -- JOIN users ua ON t.idUserAtencion = ua.id
                    JOIN planta p ON t.idPlanta = p.idPlanta
                    ORDER BY t.fechaCreacion DESC";
        return $this->db->query($query)->result_array();
    }

    /* get insumo consulta search */
    function get_all_tarea_search($search)
    {
      $this->db->join('tipotarea','tipotarea.idTipoTarea=tarea.idTipoTarea');
      $this->db->like('nombreInsumo',$search);
      $this->db->or_like('descripcionInsumo',$search);
      $this->db->or_like('cantidad',$search);
      $this->db->or_like('puntoDePedido',$search);
      $query  =   $this->db->get('tarea');
      return $query->result_array();
    }

    function listar_tareas_fecha_prev()
    {
        $query ="SELECT tt.nombreTipoTarea,et.nombreEstado,et.idEstado,t.fechaCreacion,t.fechaComienzo,p.nombrePlanta,t.idTarea, CONCAT(u.first_name,' ',u.last_name) AS creador,t.active
                    FROM tarea t
                    JOIN tipotarea tt ON t.idTipoTarea = tt.idTipoTarea
                    JOIN estado_tarea et ON t.idEstado= et.idEstado
                    JOIN users u ON t.idUserCreador = u.id
                    JOIN planta p ON t.idPlanta = p.idPlanta
                    ORDER BY t.fechaComienzo DESC";


        return $this->db->query($query)->result_array();
    }
    function listar_tareas_activa()
    {
        $query ="SELECT tt.nombreTipoTarea,et.nombreEstado,et.idEstado,t.fechaCreacion,t.fechaComienzo,p.nombrePlanta,t.idTarea, CONCAT(u.first_name,' ',u.last_name) AS creador,t.active
                    FROM tarea t
                    JOIN tipotarea tt ON t.idTipoTarea = tt.idTipoTarea
                    JOIN estado_tarea et ON t.idEstado= et.idEstado
                    JOIN users u ON t.idUserCreador = u.id
                    JOIN planta p ON t.idPlanta = p.idPlanta
                    WHERE  t.active=1";


        return $this->db->query($query)->result_array();
    }

    /**
     * Retorna todos los insumos, que se utilizaron en determinada, tarea, a la cual se le observan los detalles.
     * @param  [type] $idTarea Único paramentro de entrada.
     * @author SAKZEDMK
     */
    function insumos_tarea($idTarea)
    {
      $query= "SELECT `insumo/tarea`.`idTarea`,`insumo/tarea`.`cantidadUtilizado`,insumo.nombreInsumo,insumo.descripcionInsumo,insumo.idInsumo, insumo.cantidad
                FROM `insumo/tarea`
                JOIN insumo ON insumo.idInsumo = `insumo/tarea`.`idInsumo`
                WHERE `insumo/tarea`.`idTarea`=".$idTarea;
      return $this->db->query($query)->result_array();
    }


    /*
     * function to add new tareas
     */
    function add_tareas($params)
    {

        $this->db->insert('tarea',$params);
        //$this->db->query($query);
        return $this->db->insert_id();
    }

    /*
     * function to update tareas
     */
    function update_tareas($idTarea,$params)
    {
        $this->db->where('idTarea',$idTarea);
        return $this->db->update('tarea',$params);
    }


    /*
     * function to delete tareas
     */
    function delete_tareas($idTarea)
    {
        return $this->db->delete('tarea',array('idTarea'=>$idTarea));
    }

    function get_plantas_nombre($idTarea)
{
    $query = "SELECT planta.nombrePlanta FROM `tarea` JOIN planta ON planta.idPlanta = `tarea`.idPlanta WHERE `tarea`.idTarea=".$idTarea;

    return $this->db->query($query)->row_array();
}


function get_umbraculo_nombre($idTarea)
{
    $query = "SELECT umbraculo.nombreUmbraculo FROM `tarea` JOIN umbraculo ON umbraculo.idUmbraculo = `tarea`.idUmbraculo WHERE `tarea`.idTarea=".$idTarea;

    return $this->db->query($query)->row_array();
}

function get_tipotarea_nombre($idTarea)
{
    $query = "SELECT tipotarea.nombreTipoTarea FROM `tarea` JOIN tipotarea ON tipotarea.idTipoTarea = `tarea`.idTipoTarea WHERE `tarea`.idTarea=".$idTarea;

    return $this->db->query($query)->row_array();
}

function get_estadoTarea_nombre($idTarea)
{
    $query = "SELECT estado_tarea.nombreEstado FROM `tarea` JOIN estado_tarea ON estado_tarea.idEstado = `tarea`.idEstado WHERE `tarea`.idTarea=".$idTarea;

    return $this->db->query($query)->row_array();
}

function get_users_nombre($idTarea)
{
    $query = "SELECT users.email FROM `tarea` JOIN users ON users.id = `tarea`.idUserCreador WHERE `tarea`.idTarea=".$idTarea;

    return $this->db->query($query)->row_array();
}

// acctivar o desactivar un estado_tarea
/**
* DESACTIVA una tarea QUE NO ESTÉ SIENDO UTILIZADO.
*/
  function desactivar_tarea($idTarea)
  {
    $query="UPDATE `tarea` SET `active`=0 WHERE idTarea=".$idTarea;
    $this->db->query($query);
  }

/**
* ACTIVA una tarea QUE NO ESTÉ SIENDO UTILIZADO.
*/
    function activar_tarea($idTarea)
    {
      $query="UPDATE `tarea` SET `active`=1 WHERE idTarea=".$idTarea;
      $this->db->query($query);
    }






}
