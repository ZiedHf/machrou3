<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserUrls Controller
 *
 * @property \App\Model\Table\UserUrlsTable $UserUrls
 */
class UserUrlsController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->pageName = 'UserUrls';
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $userUrls = $this->paginate($this->UserUrls);

        $pageName = $this->pageName;
        $this->set(compact('userUrls', 'pageName'));
        $this->set('_serialize', ['userUrls']);
    }

    /**
     * View method
     *
     * @param string|null $id User Url id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userUrl = $this->UserUrls->get($id, [
            'contain' => ['Users']
        ]);

        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('userUrl', $userUrl);
        $this->set('_serialize', ['userUrl']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userUrl = $this->UserUrls->newEntity();
        if ($this->request->is('post')) {
            $userUrl = $this->UserUrls->patchEntity($userUrl, $this->request->data);
            if ($this->UserUrls->save($userUrl)) {
                $this->Flash->success(__('has been saved.', ['Le ', __('url'), '']));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('url'), '']));
            }
        }
        $users = $this->UserUrls->Users->find('list');
        $pageName = $this->pageName;
        $this->set(compact('userUrl', 'users', 'pageName'));
        $this->set('_serialize', ['userUrl']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Url id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userUrl = $this->UserUrls->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userUrl = $this->UserUrls->patchEntity($userUrl, $this->request->data);
            if ($this->UserUrls->save($userUrl)) {
                $this->Flash->success(__('has been saved.', ['Le ', __('url'), '']));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('url'), '']));
            }
        }
        $users = $this->UserUrls->Users->find('list');
        $pageName = $this->pageName;
        $this->set(compact('userUrl', 'users', 'pageName'));
        $this->set('_serialize', ['userUrl']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Url id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userUrl = $this->UserUrls->get($id);
        if ($this->UserUrls->delete($userUrl)) {
            $this->Flash->success(__('has been deleted.', ['Le ', __('url'), '']));
        } else {
            $this->Flash->error(__('could not be deleted. Please, try again.', ['Le ', __('url'), '']));
        }

        return $this->redirect(['action' => 'index']);
    }
}
