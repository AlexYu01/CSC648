<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 *
 * @method \App\Model\Entity\Message[] paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent( 'Paginator' );
        $this->loadModel( 'Media' );
        $this->loadModel( 'Users' );
    }

    public $paginate = [
        'limit' => 15
    ];

    public function receivedMsgs() {
        $user = $this->Auth->user( 'user_id' );

        $messages = $this->Messages->find( 'all' )
                ->where( ['receiver_id' => $user] );
        $messages->select( ['message_id', 'media_id', 'message_content', 'status',
                    'sender_id', 'date', 'm.media_title', 'u.username'] )
                ->join( [
                    'table' => 'media',
                    'alias' => 'm',
                    'type' => 'INNER',
                    'conditions' => 'm.media_id = Messages.media_id'
                ] )
                ->join( [
                    'table' => 'users',
                    'alias' => 'u',
                    'type' => 'INNER',
                    'conditions' => 'u.user_id = Messages.sender_id'
        ] );
        $this->set( 'messages', $this->paginate( $messages ) );
    }

    public function sentMsgs() {
        $user = $this->Auth->user( 'user_id' );

        $messages = $this->Messages->find( 'all' )
                ->where( ['sender_id' => $user] );
        $messages->select( ['message_id', 'media_id', 'message_content', 'status',
                    'receiver_id', 'date', 'm.media_title', 'u.username'] )
                ->join( [
                    'table' => 'media',
                    'alias' => 'm',
                    'type' => 'INNER',
                    'conditions' => 'm.media_id = Messages.media_id'
                ] )
                ->join( [
                    'table' => 'users',
                    'alias' => 'u',
                    'type' => 'INNER',
                    'conditions' => 'u.user_id = Messages.receiver_id'
        ] );
        $this->set( 'messages', $this->paginate( $messages ) );
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*
      public function view($id = null)
      {
      $message = $this->Messages->get($id, [
      'contain' => []
      ]);

      $this->set('message', $message);
      $this->set('_serialize', ['message']);
      }
     * 
     */

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newMsg() {
        $message = $this->Messages->newEntity();
        if ( $this->request->is( 'post' ) ) {
            $message = $this->Messages->patchEntity( $message, $this->request->getData() );
            if ( $this->Messages->save( $message ) ) {
                $media = $this->Media->get($message->media_id);
                $media['sold_count'] += 1;
                $this->Media->save( $media );
                return $this->redirect( $this->referer() );
            }
        }

        $messages = $this->Messages->find( 'all', ['limit' => 200] );
        /*
          $senders = $this->Messages->Senders->find('list', ['limit' => 200]);
          $receivers = $this->Messages->Receivers->find('list', ['limit' => 200]);
          $media = $this->Messages->Media->find('list', ['limit' => 200]);
         * 
         */
        $this->set( compact( 'message', 'messages' ) );
        $this->set( '_serialize', ['message'] );
    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    /*
      public function edit($id = null)
      {
      $message = $this->Messages->get($id, [
      'contain' => []
      ]);
      if ($this->request->is(['patch', 'post', 'put'])) {
      $message = $this->Messages->patchEntity($message, $this->request->getData());
      if ($this->Messages->save($message)) {
      $this->Flash->success(__('The message has been saved.'));

      return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The message could not be saved. Please, try again.'));
      }
      $messages = $this->Messages->find('list', ['limit' => 200]);

      $senders = $this->Messages->Senders->find('list', ['limit' => 200]);
      $receivers = $this->Messages->Receivers->find('list', ['limit' => 200]);
      $media = $this->Messages->Media->find('list', ['limit' => 200]);
      $this->set(compact('message', 'messages', 'senders', 'receivers', 'media'));
      $this->set('_serialize', ['message']);
      }
      /*
      /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete( $id = null ) {
        $this->request->allowMethod( ['post', 'delete'] );
        $message = $this->Messages->get( $id );
        if ( $this->Messages->delete( $message ) ) {
            $this->Flash->success( __( 'The message has been deleted.' ) );
        } else {
            $this->Flash->error( __( 'The message could not be deleted. Please, try again.' ) );
        }

        return $this->redirect( $this->referer() );
    }

    public function read( $id = null ) {
        $this->request->allowMethod( ['post', 'read'] );
        $message = $this->Messages->get( $id );
        $message->status = 1;

        if ( $this->Messages->save( $message ) ) {
            
        } else {
            
        }

        return $this->redirect( $this->referer() );
    }

    public function isAuthorized( $user ) {
        if ( in_array( $this->request->getParam( 'action' ), ['sentMsgs', 'read',
                    'receivedMsgs',
                    'newMsg', 'delete'] ) ) {
            return true;
        }
        parent::isAuthorized( $user );
    }

}
