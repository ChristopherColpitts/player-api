<?php
class Players_model extends CI_Model {
        //assign model to players dayabase
        public function __construct()
        {
                $this->load->database();
        }
        //grab players by id from database
        public function get_players($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('players');
            return $query->result_array();
        }

        $query = $this->db->get_where('players', array('id' => $id));
        return $query->row_array();
    }

    //grab $data from controller as array of players items
    //and insert into database
    public function set_players($data)
        {
            $this->load->helper('url');
            return $this->db->insert('players', $data);
        }

        //delete players by id from controller from database
        public function delete_players($id = FALSE) {
            $query = $this->db->delete('players', array('id' => $id));
        }
}

