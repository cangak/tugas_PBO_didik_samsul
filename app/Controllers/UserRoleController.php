<?php

class UserRoleController extends Controller
{
    public function index()
    {
        $userRoleModel = $this->model('UserRole');
        $data['title'] = 'Manajemen User Role';
        $data['user_roles'] = $userRoleModel->getAll();
        $this->view('user_roles/index', $data, true);
    }

    public function tambah()
    {
        $userModel = $this->model('User');
        $roleModel = $this->model('Role');

        $data['title'] = 'Tambah User Role';
        $data['users'] = $userModel->getAll();
            $data['users'] = $userModel->getUsersTanpaRole(); 

        $data['roles'] = $roleModel->getAll();

        $this->view('user_roles/tambah', $data, true);
    }

    public function store()
    {
        require_once __DIR__ . '/../Helpers/Flasher.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = (int)($_POST['user_id'] ?? 0);
            $role_id = (int)($_POST['role_id'] ?? 0);

            if ($user_id === 0 || $role_id === 0) {
                Flasher::setFlash('error', 'Gagal', 'User dan Role harus dipilih!');
                header('Location: ' . BASEURL . '/userrole/tambah');
                exit;
            }

            $userRoleModel = $this->model('UserRole');

            // Cegah duplikasi
            if ($userRoleModel->exists($user_id, $role_id)) {
                Flasher::setFlash('error', 'Gagal', 'User sudah memiliki role tersebut!');
                header('Location: ' . BASEURL . '/userrole');
                exit;
            }

            $userRoleModel->tambah([
                'user_id' => $user_id,
                'role_id' => $role_id
            ]);

            Flasher::setFlash('success', 'Berhasil', 'Role berhasil ditambahkan ke user!');
            header('Location: ' . BASEURL . '/userrole');
            exit;
        }
    }

    public function delete($user_id, $role_id)
    {
        require_once __DIR__ . '/../Helpers/Flasher.php';

        $userRoleModel = $this->model('UserRole');
        $userRoleModel->hapus($user_id, $role_id);

        Flasher::setFlash('success', 'Berhasil', 'Role user berhasil dihapus!');
        header('Location: ' . BASEURL . '/userrole');
        exit;
    }
}
