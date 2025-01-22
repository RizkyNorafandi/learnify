<?php

defined('BASEPATH') or exit('No direct script access allowed');

class courseModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Fungsi untuk mengambil semua data course
    public function get_courses()
    {
        $query = $this->db->get('course');
        return $query->result();
    }

    // Fungsi untuk mengambil course berdasarkan courseID dan moduleID
    public function getCourses($courseID = NULL) {
        if ($courseID) {
            $this->db->select('
                co.*, 
                GROUP_CONCAT(mo.moduleID SEPARATOR "|") AS moduleIDs,
                GROUP_CONCAT(mo.moduleName SEPARATOR "|") AS moduleNames,
                GROUP_CONCAT(mo.moduleDescription SEPARATOR "|") AS moduleDescriptions
            ');
            $this->db->from('course co');
            $this->db->join('course_has_module cm', 'cm.courseID = co.courseID', 'left');
            $this->db->join('module mo', 'mo.moduleID = cm.moduleID', 'left');
            $this->db->where('co.courseID', $courseID);
            $query = $this->db->get();
        } else {
            $this->db->select('
                co.*, 
                GROUP_CONCAT(DISTINCT mo.moduleID SEPARATOR "|") AS moduleIDs,
                GROUP_CONCAT(DISTINCT mo.moduleName SEPARATOR "|") AS moduleNames,
                GROUP_CONCAT(DISTINCT mo.moduleDescription SEPARATOR "|") AS moduleDescriptions
            ');
            $this->db->from('course co');
            $this->db->join('course_has_module cm', 'cm.courseID = co.courseID', 'left');
            $this->db->join('module mo', 'mo.moduleID = cm.moduleID', 'left');
            $this->db->group_by('co.courseID');
            $query = $this->db->get();
        }
        return $query;
    }
    

    // Fungsi untuk menambahkan course baru
    public function insertCourse($data)
    {
        return $this->db->insert('course', $data);
    }

    // Fungsi untuk memperbarui data course
    public function updateCourse($courseID, $data)
    {
        $this->db->where('CourseID', $courseID);
        return $this->db->update('course', $data);
    }

    public function deleteCourse($courseID)
    {
        $this->db->where('courseID', $courseID);
        return $this->db->delete('course');
    }

    public function insertModule($moduleIDs)
    {
        return $this->db->insert_batch('course_has_module', $moduleIDs);
    }
}
