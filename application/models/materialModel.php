<?php

defined('BASEPATH') or exit('No direct script access allowed');

class materialModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getMaterialWithMedia($materialID = NULL)
    {
        if ($materialID) {
            $this->db->select('
                ma.*, 
                GROUP_CONCAT(DISTINCT me.mediaID SEPARATOR "|") AS mediaIDs, 
                GROUP_CONCAT(DISTINCT me.mediaName SEPARATOR "|") AS mediaNames, 
                GROUP_CONCAT(DISTINCT me.mediaType SEPARATOR "|") AS mediaTypes, 
            ');
            $this->db->from('material ma');
            $this->db->join('material_has_media mm', 'mm.materialID = ma.materialID', 'left');
            $this->db->join('media me', 'me.mediaID = mm.mediaID', 'left');
            $this->db->group_by('ma.materialID', $materialID);
            $query = $this->db->get();
        } else {
            $this->db->select('
            ma.*, 
            GROUP_CONCAT(DISTINCT me.mediaID SEPARATOR "|") AS mediaIDs, 
            GROUP_CONCAT(DISTINCT me.mediaName SEPARATOR "|") AS mediaNames, 
            GROUP_CONCAT(DISTINCT me.mediaType SEPARATOR "|") AS mediaTypes, 
        ');
            $this->db->from('material ma');
            $this->db->join('material_has_media mm', 'mm.materialID = ma.materialID', 'left');
            $this->db->join('media me', 'me.mediaID = mm.mediaID', 'left');
            $this->db->group_by('ma.materialID');
            $query = $this->db->get();
        }

        return $query;
    }

    public function getMaterialsByModuleID($moduleID)
    {
        $this->db->select('ma.materialID, ma.materialName');
        $this->db->from('material ma');
        $this->db->join('module_has_material mo', 'mo.materialID = ma.materialID', 'left');
        $this->db->where('mo.moduleID', $moduleID);
        $this->db->group_by('ma.materialID');
        $query = $this->db->get();

        return $query;
    }
}


?>