<?php

namespace Pandao\Admin\Modules\Page\Controllers;

use Pandao\Common\Utils\DbUtils;
use Pandao\Admin\Controllers\FormController as CoreFormController;

class FormController extends CoreFormController
{
    public function form($action, $display = '', $autorender = true)
    {
        parent::form($action, $display, false);

        $this->viewData['isNav'] = true;

        if (isset($_POST['add_to_menu'])
            && $_POST['add_to_menu'] == 1
            && ($this->adminContext->addAllowed) 
            && empty($_SESSION['msg_error']) 
            && $this->formModel->itemId > 0) {

            $next_id = null;
            $id_parent_menu = null;
            $id_parent = 0;
            $result_parent = $this->pms_db->prepare("SELECT id FROM `pm_menu` WHERE `item_type` = 'page' AND `id_item` = :id_parent");
            $result_parent->bindParam(':id_parent', $id_parent, \PDO::PARAM_INT);
            
            $result = $this->pms_db->query("SELECT * FROM `pm_page` WHERE `id` = '".$this->formModel->itemId."'");
            foreach ($result as $row) {

                $id_parent = $row['id_parent'];
                if($result_parent->execute() !== false && $this->pms_db->last_row_count() > 0){
                    $row_parent = $result_parent->fetch();
                    $id_parent_menu = $row_parent['id'];
                }

                $data = array();
                $data['id'] = $next_id;
                $data['name'] = $row['name'];
                $data['lang'] = $row['lang'];
                $data['item_type'] = 'page';
                $data['id_item'] = $this->formModel->itemId;
                $data['id_parent'] = $id_parent_menu;
                $data['main'] = 1;
                $data['footer'] = 0;
                $data['checked'] = $this->formModel->checked;

                $result_insert = DbUtils::dbPrepareInsert($this->pms_db, 'pm_menu', $data);
                if($result_insert->execute() !== false) {
                    if(empty($next_id)) $next_id = $this->pms_db->lastInsertId();
                }else
                    break;
            }
        }

        if($this->action == 'add' || $this->action == 'edit') {
        
            $id_item = $this->formModel->itemId;
            if($id_item > 0) $this->refresh($id_item);
        }
        
        if($this->adminContext->addAllowed) {
            $result = $this->pms_db->query("SELECT id FROM `pm_menu` WHERE `item_type` = 'page' AND main = 1 AND `id_item` = ".$this->formModel->itemId);
            if($result !== false && $this->pms_db->last_row_count() == 0) $this->viewData['isNav'] = false;
        }
        
        $this->render('form', 'module', $this->module->name);
    }
}
