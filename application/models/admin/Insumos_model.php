<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Insumos_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get insumo by idInsumo
     */
    function get_insumo($idInsumo)
    {
        return $this->db->get_where('insumo',array('idInsumo'=>$idInsumo))->row_array();
    }

    /*
     * Get all insumo
     */
    function get_all_insumo()
    {
        $this->db->order_by('idInsumo', 'asc');
        return $this->db->get('insumo')->result_array();
    }

    /*
     * function to add new insumo
     */
    function add_insumo($params)
    {
        $this->db->insert('insumo',$params);
        return $this->db->insert_id();
    }

    /*
     * function to update insumo
     */
    function update_insumo($idInsumo,$params)
    {
        $this->db->where('idInsumo',$idInsumo);
        return $this->db->update('insumo',$params);
    }

    function update_stock_insumo($idInsumo,$params)
    {
        $this->db->where('idInsumo',$idInsumo);
        return $this->db->update('insumo',$params);

    }

    /**
    * DESACTIVAR UN INSUMO QUE NO ESTÉ SIENDO UTILIZADO.
    */
      function desactivar_insumo($idInsumo)
      {
        $query="UPDATE `insumo` SET `active`=0 WHERE idInsumo=".$idInsumo;
        $this->db->query($query);
      }

    /**
    * ACTIVAR UN INSUMO QUE NO ESTÉ SIENDO UTILIZADO.
    */
        function activar_insumo($idInsumo)
        {
          $query="UPDATE `insumo` SET `active`=1 WHERE idInsumo=".$idInsumo;
          $this->db->query($query);
        }

    /*
     * function to delete insumo
     */
    function delete_insumo($idInsumo)
    {
        return $this->db->delete('insumo',array('idInsumo'=>$idInsumo));
    }

    function agregar_insumo_tarea($idInsumo,$idTarea,$cantidad)
    {
      $query="INSERT INTO `insumo/tarea` (`idInsumo`, `idTarea`, `cantidadUtilizado`) VALUES ('".$idInsumo."', '".$idTarea."', '".$cantidad."')";
      $this->db->query($query);
    }

    /**
     * @return [type]           Listado de insumos faltos de stock, por debajo del punto de pedido o, igual al punto de pedido
     * @author SAKZEDMK
     */
    function insumos_faltos ()
    {
      $query = "SELECT * 
                FROM insumo 
                WHERE insumo.cantidad <= insumo.puntoDePedido";
      return $this->db->query($query)->result_array();
    }

    /**
     * @return [type]           Cantidad insumos faltos de stock, por debajo del punto de pedido o, igual al punto de pedido
     * @author SAKZEDMK
     */
    function insumos_cantidad ()
    {
      $query = "SELECT * 
                FROM insumo 
                WHERE insumo.cantidad <= insumo.puntoDePedido";
      return $this->db->query($query)->num_rows();
    }


}
