<?php
class RoleController extends Controller
{
    private $roleModel;

    public function __construct()
    {
        $this->roleModel = new Role();
    }

    public function index()
    {
        $data['title'] = 'Manajemen Role';
        $data['roles'] = $this->roleModel->getAll();        
        $this->view('role/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Role';
        $this->view('role/tambah', $data);
    }

    public function store()
    {
        $this->roleModel->store([
            'nama' => $_POST['nama'],
            'deskripsi' => $_POST['deskripsi']
        ]);
            header('Location: ' . BASEURL . '/role');

    }

    public function edit($id)
    {
        $data['title'] = 'Edit Role';
        $data['role'] = $this->roleModel->getById($id);
        $this->view('role/edit', $data);
    }

    public function update($id)
    {
        $this->roleModel->update([
            'id' => $id,
            'nama' => $_POST['nama'],
            'deskripsi' => $_POST['deskripsi']
        ]);
            header('Location: ' . BASEURL . '/role');

    }

    public function delete($id)
    {
        $this->roleModel->delete($id);
            header('Location: ' . BASEURL . '/role');
   }
}
