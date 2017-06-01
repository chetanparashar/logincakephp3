<?php

/**
 * Description of MenuMaster
 *
 * @author vinay
 *
 */
class MenuTable extends AppModel {

    public $useTable = 'apos_menu';
    //public $primaryKey = 'menucode';

    public function getMenu_old($auth) {
        $conditions = array(); //"status" => 'Y');
        if ($auth["finyeardate"] == ((date('m') > 3) ? date('Y') : date('Y') - 1) . '-04-01') {
            $conditions["finyearaccess"] = array('BOTH', 'CURRENT');
        }
        $menuarr = $this->find("all", array("conditions" => $conditions, "order" => array("parent", "menuaction", "formcode")));
        $parentid = Set::combine($menuarr, '{n}.' . $this->name . '.menuname', '{n}.' . $this->name . '.formcode');
        $menudata = array();
        $Data = array();
        foreach ($menuarr as $row) {
            $row = $row[$this->name];
            $menudata[$row['formcode']]['class'] = "fa fa-hand-o-right";
            $menudata[$row['formcode']]['name'] = $row['menudispname'];
            $row['level'] = isset($parentid[$row['parent']]) ? $row['level'] : 0;
            $parent = empty($row['parent']) ? 0 : (isset($parentid[$row['parent']]) ? $parentid[$row['parent']] : 0);
            $Data[$row['level']][$parent][$row['formcode']] = $row['menuaction'];
        }
        $menuList = array();
        if (isset($Data[0][0])) {
            foreach ($Data[0][0] as $mcode => $maction) {
                if (trim($maction) != "") {
                    $menuList[$mcode] = $maction;
                } else {
                    $tmp = $this->getSubMenu($mcode, 1, $Data);
                    $menuList[$mcode] = $tmp[$mcode];
                }
            }
        }
        return array("menu" => $menuList, "menuData" => $menudata);
    }


    public function getMenu($auth) {
        $conditions = array("status" => true);
        if ($auth["finyeardate"] == ((date('m') > 3) ? date('Y') : date('Y') - 1) . '-04-01') {
            $conditions["finyearaccess"] = array('BOTH', 'CURRENT');
        }
	$conditions["menucode"] = explode(',',$auth['formaccess']);
        $menuarr = $this->find("all", array("conditions" => $conditions, "order" => array("parent", "menuindex")));
//pr($menuarr);exit;
        $menudata = array();
        $Data = array();
        foreach ($menuarr as $row) {
            $row = $row[$this->name];
            $menudata[$row['menucode']]['class'] = $row['menuicon'];
            $menudata[$row['menucode']]['name'] = $row['menuname'];
            $Data[$row['level']][$row['parent']][$row['menucode']] = $row['menuaction'];
        }
        $menuList = array();
        if (isset($Data[0][0])) {
            foreach ($Data[0][0] as $mcode => $maction) {
                if (trim($maction) != "") {
                    $menuList[$mcode] = $maction;
                } else {
                    $tmp = $this->getSubMenu($mcode, 1, $Data);
                    $menuList[$mcode] = $tmp[$mcode];
                }
            }
        }
	
        return array("menu" => $menuList, "menuData" => $menudata);
    }

    function getSubMenu($parent, $level, $Data) {
        $menu = isset($Data[$level][$parent]) ? $Data[$level][$parent] : array();
        $arr = array($parent => '');
        foreach ($menu AS $key => $val) {
            if (trim($val) != '') {
                $arr[$parent][$key] = $val;
            } else {
                $level++;
                $tmp = $this->getSubMenu($key, $level, $Data);
                if (is_array($tmp[$key])) {
                    $arr[$parent][$key] = $tmp[$key];
                }
                $level --;
            }
        }
	//asort($arr);
        return $arr;
    }

}
