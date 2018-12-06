<?php

class Ticket_model extends CI_Model {

    public function __construct() {}
    
    public function Get_Tickets() {
        $query = $this->db->query("
                              
            SELECT a.IdTicket,a.idCanje,p.TipoPregunta,a.mensaje,a.solucion,a.FechaCreacion,
            a.FechaFinalizacion,a.status
            FROM opisa_opisa.Atencion as a inner join opisa_opisa.Preguntas as p on p.idPregunta = a.idPregunta 
            where idParticipante = '".$this->session->userdata('idPart')."' 
            order by a.FechaCreacion desc,a.status "

        );
        if ($query->num_rows() > 0) {

            return $query->result_array();

        } else {

            return false;

        }
    }

    /* funcion para la base de datos del historial ejemplo */
    public function Get_TicketsExample() {
        $query = $this->db->query("
                              
            SELECT IdTicket,idCanje,idParticipante,status,FechaCreacion,Subject
            FROM AtencionTicket 
            WHERE idParticipante = '".$this->session->userdata('idPart')."';

            ");
        if ($query->num_rows() > 0) {

            return $query->result_array();

        } else {

            return false;

        }
    }
    /* fin funcion para la base de datos del historia ejemplo */
    
}
?>