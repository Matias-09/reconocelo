<?php
      class Login_model extends CI_Model {
    	
            public function __construct(){}
        
            /*public function loginReconocelo($loginReconoceloData){
                  $query = $this->db->query("
                        SELECT pp.codPrograma,pp.codEmpresa,pp.codParticipante,pp.Status,pp.Cargo,
                        pp.PrimerNombre,pp.SegundoNombre,pp.ApellidoPaterno,pp.ApellidoMaterno,pp.eMail,
                        pp.SaldoActual,pp.idParticipante,pp.CalleNumero, pp.Colonia, pp.CP,pp.Ciudad,pp.Estado,
                        pp.eMail,pp.Telefono,pp.fhInicioOrden,pp.fhFinOrden,Emp.Visibilidad,pp.pwd
                        FROM Participante AS pp 
                        INNER JOIN Empresa as Emp ON (pp.codPrograma = Emp.CodPrograma and pp.CodEmpresa= Emp.CodEmpresa)
                        WHERE pp.codPrograma = 41 
                        AND pp.loginWeb = '".$loginReconoceloData["usuarioReconocelo"]."' 
                        AND pwd = md5('".$loginReconoceloData["passwordReconocelo"]."')
                        AND pp.Status = 1
                  ");
                  if ($query->num_rows() == 1){
                        return $query->result_array(); 
                  }else{
                        return false;
                  }
            }*/
            public function login($datos){
                  $emp=substr($datos["usuario"],0,5);
                  $part=intval(substr($datos["usuario"],5,3));
                        
                  $query = $this->db->query("
                        SELECT pp.codPrograma,pp.codEmpresa,pp.codParticipante,pp.Status,pp.Cargo,
                        pp.PrimerNombre,pp.SegundoNombre,pp.ApellidoPaterno,pp.ApellidoMaterno,pp.eMail,
                        pp.SaldoActual,pp.idParticipante,pp.CalleNumero, pp.Colonia, pp.CP,pp.Ciudad,pp.Estado,
                        pp.eMail,pp.Telefono,pp.fhInicioOrden,pp.fhFinOrden,Emp.Visibilidad,pp.pwd
                        FROM Participante AS pp 
                        INNER JOIN Empresa as Emp ON (pp.codPrograma = Emp.CodPrograma and pp.CodEmpresa= Emp.CodEmpresa)
                        WHERE pp.codPrograma = 41 
                        AND pp.loginWeb = '".$datos["usuario"]."' 
                        AND pwd = '".$datos["password"]."'
                        AND pp.Status = 1
                  ");
                  if ($query->num_rows() == 1){
                        return $query->result_array(); 
                  }else{
                        return false;
                  }
            }
        
            public function loginMonitor($datos)
            {
                  $emp=substr($datos["usuario"],0,5);
                  $part=intval(substr($datos["usuario"],5,3));
                        
                  $query = $this->db->query("
                        SELECT pp.codPrograma,pp.codEmpresa,pp.codParticipante,pp.Status,pp.Cargo,
                        pp.PrimerNombre,pp.SegundoNombre,pp.ApellidoPaterno,pp.ApellidoMaterno,pp.eMail,
                        pp.SaldoActual,pp.idParticipante,pp.CalleNumero, pp.Colonia, pp.CP,pp.Ciudad,pp.Estado,
                        pp.eMail,pp.Telefono,pp.fhInicioOrden,pp.fhFinOrden,Emp.Visibilidad,pp.pwd
                        FROM Participante AS pp 
                        INNER JOIN Empresa as Emp ON (pp.codPrograma = Emp.CodPrograma and pp.CodEmpresa= Emp.CodEmpresa)
                        WHERE pp.codPrograma = 41 
                        AND pp.loginWeb = '".$datos["usuario"]."' 
                        AND pwd = '".$datos["password"]."' 
                        AND pp.Status = 1
                  ");
                  if ($query->num_rows() == 1){
                        return $query->result_array(); 
                  }else{
                        return false;
                  }
            }
            public function loginMantenimiento($datos){
                  $emp=substr($datos["usuario"],0,5);
                  $part=intval(substr($datos["usuario"],5,3));
                        
                  $query = $this->db->query("
                        SELECT pp.codPrograma,pp.codEmpresa,pp.codParticipante,pp.Status,pp.Cargo,
                        pp.PrimerNombre,pp.SegundoNombre,pp.ApellidoPaterno,pp.ApellidoMaterno,pp.eMail,
                        pp.SaldoActual,pp.idParticipante,pp.CalleNumero, pp.Colonia, pp.CP,pp.Ciudad,pp.Estado,
                        pp.eMail,pp.Telefono,pp.fhInicioOrden,pp.fhFinOrden,Emp.Visibilidad,pp.pwd
                        FROM Participante AS pp 
                        INNER JOIN Empresa as Emp ON (pp.codPrograma = Emp.CodPrograma and pp.CodEmpresa= Emp.CodEmpresa)
                        WHERE pp.codPrograma = 41 
                        AND pp.loginWeb = '".$datos["usuario"]."' 
                        AND pwd = '".$datos["password"]."' 
                        AND pp.Status = 1
                  ");
                  if ($query->num_rows() == 1){
                        return $query->result_array(); 
                  }else{
                        return false;
                  }
            }
            public function updatePassword($loginMantenimientoData){
                  $query = $this->db->query("
                        UPDATE `Participante` SET `pwd`='".$loginMantenimientoData['passwordNew']."'
                        WHERE codPrograma = 41 
                        and idParticipante = '".$this->session->userdata('idPart')."'
                  ");
                  if ($query){
                        return $this->db->insert_id();
                  }else{
                        return false;
                  }
            }
            public function checkPasswordReconocelo($updatePasswordReconoceloData){
                  $query = $this->db->query("
                        SELECT pwd
                        FROM `Participante` 
                        WHERE codPrograma = '".$this->session->userdata('programa')."'
                        AND codEmpresa = '".$this->session->userdata('empresa')."'
                        AND idParticipante = '".$this->session->userdata('idPart')."'
                        AND pwd = md5('".$updatePasswordReconoceloData['passwordOld']."')
                  ");
                  if ($query->num_rows() == 1){
                        return $query->result_array(); 
                  }else{
                        return false;
                  }
            }
            public function updatePasswordReconocelo($updatePasswordReconoceloData){
                  $query = $this->db->query("
                        UPDATE `Participante` 
                        SET `pwd`=md5('".$updatePasswordReconoceloData['passwordNew']."' )
                        WHERE codPrograma ='".$this->session->userdata('programa')."'
                        AND codEmpresa ='".$this->session->userdata('empresa')."'
                        AND  `idParticipante` ='".$this->session->userdata('idPart')."'
                  ");
                  if ($query){
                        return $this->db->insert_id();
                  }else{
                        return false;
                  }
            }
	}
?>