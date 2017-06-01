<?php
$token = $this->request->session()->read('Auth.User.AuthToken') ;
//$LayoutData = AuthComponent::user("layoutData");
$LayoutData = [
    "menu" => ["1" => "users/home", /*"2" =>["3" => "/home", "4" => ["5" => "/home", "6" => ["7" => "/home", "8" => "/home"]]]*/
                "2"=>'transaction/topup']
    ,"menuData" => ["1" => ["class" => "glyphicon glyphicon-home", "name" => "Home"], 
		    "2" => ["class" => "glyphicon glyphicon-piggy-bank ", "name" => "Topup"],
    		   // "2" => ["class" => "fa fa-cog", "name" => "Multilevel"],
		    //"3" => ["class" => "fa fa-hand-o-right", "name" => "Level 1_1"],
		 //   "4" => ["class" => "fa fa-hand-o-right", "name" => "Level 1_2"], 
		  //  "5" => ["class" => "fa fa-hand-o-right", "name" => "Level 2_1"], 
		  //  "6" => ["class" => "fa fa-hand-o-right", "name" => "Level 2_2"],
		  //  "7" => ["class" => "fa fa-hand-o-right", "name" => "Level 3_1"],
		  //  "8" => ["class" => "fa fa-hand-o-right", "name" => "Level 3_2"]
    ]];
$menu = isset($LayoutData["menu"]) ? $LayoutData["menu"] : array();
$menuList = isset($LayoutData["menuData"]) ? $LayoutData["menuData"] : array();
echo '<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">';
echo '<ul class="sidebar-menu">';
foreach ($menu as $key => $val) {
    if (is_array($val)) {
        echo '<li class="treeview"><a href="#" onclick="return false;"><i class="' . $menuList[$key]['class'] . '"></i> <span>' . $menuList[$key]['name'] . '</span><i class="fa fa-angle-left pull-right"></i></a>';
        listItems($val, $menuList, $this->Form);
        echo "</li>";
    } else if (trim($val) != '') {
        $tmp = explode("/", $val);
        $contr = $tmp[0];
        $tmp = isset($tmp[1]) ? explode('?', $tmp[1]) : array('index');
        $act = $tmp[0];
        $hfields = explode('&', "AuthVar=" . $token . (isset($tmp[1]) ? ("&" . $tmp[1]) : ""));
        echo '<li>';
        echo $this->Form->create($act, array('method' => 'post', 'target' => '_self', 'url' => array("controller" => $contr, "action" => $act), 'name' => "menu_frm_" . $key, 'id' => "menu_frm_" . $key));

        foreach ($hfields as $kv) {
            list($n, $d) = explode('=', $kv);
            echo $this->Form->hidden($n, array('value' => $d));
        }
        echo $this->Form->end();
        echo '<a href="#" onclick="$(\'#loaderDiv\').show();document.' . "menu_frm_" . $key . '.submit();"><i class="' . $menuList[$key]['class'] . '"></i> <span>' . $menuList[$key]['name'] . '</span></a></li>';
    }
}
echo "</ul>";
echo '</section>
    <!-- /.sidebar -->
</aside>';

function listItems($val, $menuList, $form) {
$token = $this->request->session()->read('Auth.User.AuthToken') ;
    if (is_array($val)) {
        echo '<ul class="treeview-menu">';
        foreach ($val AS $k => $v) {
            if (is_array($v)) {
                echo '<li><a href="#" onclick="return false;"><i class="' . $menuList[$k]['class'] . '"></i>' . $menuList[$k]['name'] . '<i class="fa fa-angle-left pull-right"></i></a>';
                listItems($v, $menuList, $form);
                echo "</li>";
            } else {
                $tmp = explode("/", $v);
                $contr = $tmp[0];
                $tmp = isset($tmp[1]) ? explode('?', $tmp[1]) : array('index');
                $act = $tmp[0];
                $hfields = explode('&', "AuthVar=" . $token . (isset($tmp[1]) ? ("&" . $tmp[1]) : ""));
                echo '<li>';
                echo $form->create($act, array('method' => 'post', 'target' => '_self', 'url' => array("controller" => $contr, "action" => $act), 'name' => "menu_frm_" . $k, 'id' => "menu_frm_" . $k));
                foreach ($hfields as $kv) {
                    list($n, $d) = explode('=', $kv);
                    echo $form->hidden($n, array('value' => $d));
                }
                echo $form->end();
                echo '<a href="#" onclick="$(\'#loaderDiv\').show();document.' . "menu_frm_" . $k . '.submit();"><i class="' . $menuList[$k]['class'] . '"></i> <span>' . $menuList[$k]['name'] . '</span></a></li>';
            }
        }
        echo "</ul>";
    }
}
