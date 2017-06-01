<?php

namespace App\Controller;

use App\Controller\UsersController;
use Cake\Event\Event;
use Cake\Core\Exception\Exception;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class TransactionController extends UsersController {

    public function topup() {
        try {
            $user = $this->Auth->user();
            $this->ResponseArr['AuthVar'] = $user['AuthToken'];
            $this->ResponseArr['partyname'] = $user['partyname'];
            $this->ResponseArr['serno'] = $user['serno'];
            if($this->request->is('post')&& isset($this->request->data['serno']) && $this->request->data['serno']==""){
                
            }
        } catch (\Exception $ex) {
            $this->ResponseArr['error'] = TRUE;
            $this->ResponseArr['msg'] = $ex->getMessage();
        }
    }

}
