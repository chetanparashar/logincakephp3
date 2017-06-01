<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Session\DatabaseSession;
//use Cake\Network\Exception\NotFoundException;
use Cake\Core\Exception\Exception;
use Cake\Network\Exception\InvalidCsrfTokenException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    public $ResponseArr = ['error' => FALSE, 'msg' => ''];
    private $authVar = '';

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);        
        $this->loadComponent('Security', ['blackHoleCallback' => "blackhole"]);
       
//        $this->eventManager()->off($this->Csrf);
//        if ($this->request->action == 'salt' && $this->request->isAll(['post', 'ajax'])) {
//            $this->httpApi = 'REST';
//            $this->httpMethods = ['POST'];
//        }
        if ($this->request->action == 'home') {
            $authVar = $this->request->session()->read("Auth.User.AuthToken");
        }
        if (!(strtolower($this->request->controller) == 'users' && in_array($this->request->action, ['login', 'reset', 'salt']))) {

            if (!$this->Auth->user()) {
                $this->logout("Session Expired, Please Login To Continue...");
            }
            $this->validateAuthToken();
        }
    }

    public function beforeRender(Event $event) {
        $this->response->data = $this->ResponseArr;
        $this->set('response', $this->ResponseArr);
        $this->set('_serialize', 'response');
        parent::beforeRender($event);
    }

    public function blackHole($type) {
        $message = (strtolower($type) == "csrf" ? "Session Expired" : (strtolower($type) == "auth" ? "Authentication Failed" : $type));
        $this->logout($message . ", Please Login To Continue.");
    }

    public function validateAuthToken() {
        try {
            $session = $this->request->session();
            if (stripos(env("HTTP_REFERER"), "/login") === FALSE || ($this->request->action = "index" && $this->Auth->user("AuthToken") !== null)) {
                if ($session->check("Auth.User.AuthToken")) {
                    if (empty($authVar))
                        $authVar = empty($this->request->data["AuthVar"]) ? '' : $this->request->data["AuthVar"];
                    $AuthToken = $session->read("Auth.User.AuthToken");
                    if (empty($authVar) || $authVar != $AuthToken) {
                        throw new Exception(__("Authentication Failed, Invalid Token."));
                    }
                } else {
                    throw new Exception(__("Session Expired, Please Login To Continue."));
                }
            }
            $this->ResponseArr["AuthVar"] = md5(uniqid(rand(), true));
            $session->write("Auth.User.AuthToken", $this->ResponseArr["AuthVar"]);
        } catch (\Exception $e) {
            $this->logout($e->getMessage());
        }
    }

    public function login() {
        try {
            if ($this->request->is('post')) {

                $this->request->data['serno'] = $this->request->data['username'];
                unset($this->request->data['username']);
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    throw new Exception(__('Username or password is incorrect'));
                }
            }
            $this->ResponseArr['error'] = FALSE;
            $this->ResponseArr['msg'] = '';
        } catch (\Exception $ex) {
            $this->ResponseArr['error'] = TRUE;
            $this->ResponseArr['msg'] = $ex->getMessage();
        }
        $this->render('/Users/login', 'login');
    }

    public function ngLogin() {
        try {
            if ($this->request->is('post')) {                
                $this->request->data['serno'] = $this->request->data['username'];
                unset($this->request->data['username']);
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);                   
                    $this->ResponseArr = [
                        'error' => 0,
                        'msg' => 'Logged in successfully'
                    ];
                } else {
                    throw new Exception('Something went worng please try again');
                }
            }
        } catch (\Exception $ex) {
            $this->ResponseArr['error'] = 1;
            $this->ResponseArr['msg'] = $ex->getMessage();
        }        
        $this->set('response', $this->ResponseArr);
        $this->set('_serialize', 'response');
    }

    public function logout($message = '') {
        try {
            $session = $this->request->session();
            if ($this->request->action != "logout" && $session->check("Auth.User") === false) {
                throw new Exception(__("Session Expired, Please Login To Continue."));
            }
            if ($this->request->action == "logout") {
                
            }
        } catch (\Exception $ex) {
            $this->ResponseArr['error'] = 1;
            $this->ResponseArr['msg'] = $ex->getMessage();
        }
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->logout();
//        
    }

    public function home() {
        // $this->render( 'index');
    }

//    public function reset() {
//        try {
//            if ($this->request->is('POST') && isset($this->request->data['login'])) {
//                PwSpecialFun::ValidatePram($this->request->data, array('login' => 'AN'));
//                PwSpecialFun::ValidateOptional($this->request->data, array('mno' => 'MNO', 'emailid' => 'EMAIL'));
//                $this->User->resetPassword($this->request->data);
//                $this->logout("Your password reset request has been accepted, You will receive new password on your registered email ID.");
//            }
//        } catch (Exception $ex) {
//            $this->ResponseArr['authMessage'] = $ex->getMessage();
//        }
//        $this->render('/Login/reset_password', 'login');
//    }
//    public function home() {
//        $users = $this->paginate($this->Users);
////
////        $this->set(compact('users'));
////        $this->set('_serialize', ['users']);
//    }
    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
//    public function view($id = null) {
//        $user = $this->Users->get($id, [
//            'contain' => []
//        ]);
//
//        $this->set('user', $user);
//        $this->set('_serialize', ['user']);
//    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
//    public function add() {
//        $user = $this->Users->newEntity();
//        if ($this->request->is('post')) {
//            $user = $this->Users->patchEntity($user, $this->request->getData());
//            if ($this->Users->save($user)) {
//                $this->Flash->success(__('The user has been saved.'));
//
//                return $this->redirect(['action' => 'home']);
//            }
//            $this->Flash->error(__('The user could not be saved. Please, try again.'));
//        }
//        $this->set(compact('user'));
//        $this->set('_serialize', ['user']);
//    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
//    public function edit($id = null) {
//        $user = $this->Users->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $user = $this->Users->patchEntity($user, $this->request->getData());
//            if ($this->Users->save($user)) {
//                $this->Flash->success(__('The user has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The user could not be saved. Please, try again.'));
//        }
//        $this->set(compact('user'));
//        $this->set('_serialize', ['user']);
//    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
//    public function delete($id = null) {
//        $this->request->allowMethod(['post', 'delete']);
//        $user = $this->Users->get($id);
//        if ($this->Users->delete($user)) {
//            $this->Flash->success(__('The user has been deleted.'));
//        } else {
//            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
//        }
//
//        return $this->redirect(['action' => 'index']);
//    }
}
