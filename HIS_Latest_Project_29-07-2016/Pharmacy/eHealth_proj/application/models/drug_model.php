<?php

class Drug_Model extends CI_Model {
    
    function __construct(){
         parent::__construct();
    }

    public function updateStatus($pres_id){
        
        $sql = "UPDATE opd_prescription SET prescription_status = '1' WHERE prescription_id =".$pres_id;
        $this->db->query($sql);
        return 'hello';
        
        
                
    }
    
    public function updateAsTbl($DSrNo, $userid, $NewQty){
        //drugQty - qty
        $data = array (            
            'requestedUserID' => $userid,
            'drugQty' => $NewQty
        );
        
        $this->db->where('drug_srno', $DSrNo);
        $this->db->update('', $data);
    }
    
    public function getQty($DSrNo){
        $this->db->select('drugQty');
        $this->db->where('drug_srno', $DSrNo);
        $result = $this->db->get('pharm_asst_stock');
        return $result->row();
        
    }
    
    public function insertAsTbl($data){
        //return $this->db->insert('pharm_asst_stock',$data);
        $this->db->insert('pharm_asst_stock',$data);
    }
    
    public function getDrugName($id){
        $this->db->select('drug_name');
        $this->db->where('drug_srno', $id);
        $query = $this->db->get('pharm_drug');
        return $query->row();
    }
    
    public function getPhamDrugQty($id){
        $this->db->select('drug_quantity');
        $this->db->where('drug_srno', $id);
        $query = $this->db->get('pharm_drug');
        return $query->row();
    }
    
    public function updatePham($id, $qty){
          $data = array (            
            'drug_qantity' => $qty
        );
        
        $this->db->where('drug_srno', $id);
        $this->db->update('pharm_drug', $data);
    }
}