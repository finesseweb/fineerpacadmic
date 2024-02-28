<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



define('SS_ACAD_T', 111 << 8);
define('SS_ACAD_M', 112 << 8);
define('SS_ACAD_P', 113 << 8);
define('SS_ACAD_FP', 114 << 8);
define('SS_ACAD_R', 115 << 8);
define('SS_ACAD_A', 116 << 8);
define('SS_ACAD_L', 117 << 8);
define('SS_ACAD_SA', 118 << 8);
define('SS_ACAD_EV', 119 << 8);
define('SS_ACAD_PL', 120 << 8);
define('SS_ACAD_ST', 126 << 8);
define('SS_ACAD_AR', 127 << 8);
define('SS_ALUM_AR', 130 << 8);

global $security_sections, $security_areas;
$security_sections = array(
    //==[ONLY FOR ACADEMIC] ==//
    SS_ACAD_T => ("Academic Transactions"),
    SS_ACAD_M => ("Academic Masters"),
    SS_ACAD_P => ("Academic Participants"),
    SS_ACAD_FP => ("Academic Faculty Portal"),
    SS_ACAD_R => ("Academic Reports"),
    SS_ACAD_A => ("Academic Attendance"),
    SS_ACAD_L => ("Academic LMS"),
    SS_ACAD_SA => ("Academic Seating Arrangment"),
    SS_ACAD_EV => ("Academic Events"),
    SS_ACAD_ST => ("Academic Settings"),
    SS_ACAD_AR => ("Academic Admission Report"),
    SS_ALUM_AR => ("Alumni Report")
);

$security_areas = array();

$security_areas = array(//===[ACADEMIC SETUP]
    //masters
    'SA_ACAD_DEGREE' => array(SS_ACAD_M | 1, ("Degree")),
    'SA_ACAD_CASTE_CATEGORY' => array(SS_ACAD_M | 2, ("Caste Category")),
    'SA_ACAD_CASTE' => array(SS_ACAD_M | 3, ("Caste")),
    'SA_ACAD_UNIVERSITY' => array(SS_ACAD_M | 4, ("University")),
    'SA_ACAD_COLLEGE' => array(SS_ACAD_M | 5, ("College")),
    'SA_ACAD_ACADEMIC_YEAR' => array(SS_ACAD_M | 6, ("Academic Year")),
    'SA_ACAD_DEPARTMENT' => array(SS_ACAD_M | 7, ("Department")),
    'SA_ACAD_PAPER' => array(SS_ACAD_M | 8, ("Paper")),
    
    
        //-----------------------------Academic Access ----------// Acadmic Ends
);

class accessLevel {

    public function __construct() {
        $this->setAccessLevel();
    }

    private function setAccessLevel() {
        global $security_areas;
        $k = $j = 0; //row colour counter
        $ext = $sec = $m = -1;

        foreach ($this->sort_areas($security_areas) as $area => $parms) {

            $newsec = ($parms[0] >> 8) & 0xff;

            $newext = $parms[0] >> 16;
            define($area, $parms[0]);
        }
    }

    private function sort_areas($areas) {
        $old_order = 0;
        foreach ($areas as $key => $area) {
            $areas[$key][] = $old_order++;
        }
        //uasort($areas,'comp_areas');
        return $areas;
    }

    public function setAccess($Action = '', $role_id = 'NA') {
//echo !in_array(constant($Action), $_SESSION['admin_login']['admin_login']->role_set); die;
        try {
            if (empty($Action)) {
                throw new Exception("Action should not be empty in SetAccess Function");
            } else {
                if ((!in_array(constant($Action), $_SESSION['admin_login']['admin_login']->role_set) && count($_SESSION['admin_login']['admin_login']->role_set) != 0)) {

                    throw new Exception("Access Denied By System Administrator");
                }
            }
        } catch (Exception $e) {
            if ($Action == 'SA_ACAD_ADMIT_CARD')
                return true;
            header("Location: /academic/index");
        }
    }

}

?>