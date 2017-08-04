<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['add', 'logout','facebook']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function userindex() {
        $this->paginate = [
            'contain' => []
        ];
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['Users']
                ]);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {

        // make sure a logged in user cant access registeration
        if ($this->request->session()->read('Auth')) {
            return $this->redirect(['controller' => 'Media', 'action' => 'posts']);
        }

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

            $salt = sha1(substr(str_shuffle(str_repeat("0123456789qwertyuiopasdfghjklzxcvbnm,.;'*&^", 15)), 0, 15));
            $data = $this->request->getData();

            $captcha = $data['g-recaptcha-response'];
            $recaptcha_secret = Configure::read('google_recatpcha_settings.secret_key');
            if (!$captcha) {
                // empty captcha
                $this->Flash->error('Please check the captcha', ['key' => 'captchaEmpty']);
            } else {
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $captcha;
                $response = json_decode(file_get_contents($url));
                if ($response->success == true) {
                    $data['token'] = "";
                    $data['salt'] = $salt;

                    $user = $this->Users->patchEntity($user, $data);
                    if ($this->Users->save($user)) {

                        // login new registered user
                        $authUser = $this->Users->get($user->user_id)->toArray();
                        $this->Auth->setUser($authUser);

                        return $this->redirect($this->Auth->redirectUrl());
                    }
                } else {
                    $this->Flash->error(__('Bots are not allowed'));
                    return $this->redirect(['controller' => 'Homepage', 'action' => 'index']);
                }
            }
        }
        $this->set(compact('user'));
    }

    public function login() {
<<<<<<< HEAD
        $current_time = date('Y-m-d G:i:s', time());
        if ($this->request->is('post')) {
=======
        // make sure a logged in user cant access login page
        if ( $this->request->session()->read( 'Auth' ) ) {
            return $this->redirect( ['controller' => 'Media', 'action' => 'posts'] );
        }
        
        $current_time = date( 'Y-m-d G:i:s', time() );
        if ( $this->request->is( 'post' ) ) {
>>>>>>> 063a7edb2c195bcf483d2d2c20601c14ee3b4dd3
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                // update last_login_date for user
                $query = $this->Users->query();
                $query->update()
                        ->set(['last_login_date' => $current_time])
                        ->where(['user_id' => $this->Auth->user('user_id')])
                        ->execute();

                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
                ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $users = $this->Users->Users->find('list', ['limit' => 200]);
        $this->set(compact('user', 'users'));
        $this->set('_serialize', ['user']);
    }

    public function facebook() {
        $this->autoRender = false;
        $current_time = date('Y-m-d G:i:s', time());
        if ($this->request->is('post')) {
            
            $data = $this->request->getData();
            
            //Check log in credential
            $data['password'] = $data['user_id'].$data['email'];
            $query = $this->Users->find('all',['conditions' => [ 'Users.email' => $data['email'] ]]);
            $result = $query->toArray();
            $query = $query->count();
            $passordMatch = (new DefaultPasswordHasher)->check($data['password'],$result[0]['password']);
            
            
            if($query > 0 && $passordMatch) {
                
                //set log in user
                $authUser = $this->Users->get($result[0]['user_id'])->toArray();
                $this->Auth->setUser($authUser);
                
                // update last_login_date for user
                $query = $this->Users->query();
                $query->update()
                        ->set(['last_login_date' => $current_time, 'token' => $data['token']])
                        ->where(['user_id' => $this->Auth->user('user_id')])
                        ->execute();

                //return $this->redirect($this->Auth->redirectUrl());
            } else {
                $user = $this->Users->newEntity();
                $salt = sha1(substr(str_shuffle(str_repeat("0123456789qwertyuiopasdfghjklzxcvbnm,.;'*&^", 15)), 0, 15));
                $data['username'] = 'facebook-'.$data['name'];
                $password =  $data['user_id'].$data['email'];
                $data['password'] = $password;
                $data['confirmPassword'] = $password;
                $data['salt'] = $salt;
                $user = $this->Users->patchEntity($user, $data);
                    if ($this->Users->save($user)) {
                        // login new registered user
                        $authUser = $this->Users->get($user->user_id)->toArray();
                        $this->Auth->setUser($authUser);
                        //return $this->redirect($this->Auth->redirectUrl());
                    }                 
            }
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user) {
        // All registered users can add articles
        

        return parent::isAuthorized($user);
    }

}
