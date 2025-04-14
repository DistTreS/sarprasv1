<?php

namespace App\Controllers;


use App\Models\UsersModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function index()
    {
        $model = new UsersModel();

        // Ambil keyword pencarian dari input form
        $keyword = $this->request->getGet('search');

        // Jika ada keyword, lakukan pencarian
        if ($keyword) {
            $model->groupStart()
                ->like('full_name', $keyword)
                ->orLike('nip', $keyword)
                ->orLike('jabatan', $keyword)
                ->orLike('role', $keyword)
                ->groupEnd();
        }

        $data['users'] = $model->paginate(10); // Menampilkan 10 data per halaman
        $data['pager'] = $model->pager;

        return view('users/index', $data);
    }

    public function view($id)
    {
        $model = new UsersModel();
        $data['user'] = $model->find($id);

        if (!$data['user']) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan');
        }

        return view('users/view', $data);
    }

    public function create()
    {
        return view('users/tambahuser');
    }

    public function store()
    {
        $model = new UsersModel();

        // Ambil data dari form
        $nip = $this->request->getPost('nip');

        // Cek apakah NIP sudah ada
        $existingUser = $model->where('nip', $nip)->first();
        if ($existingUser) {
            return redirect()->back()->with('error', 'NIP sudah terdaftar, gunakan NIP lain.');
        }

        // Upload gambar jika ada
        $file = $this->request->getFile('profile_img');
        $newName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/', $newName);
        }

        // Simpan user ke database
        $model->insert([
            'full_name'   => $this->request->getPost('full_name'),
            'no_telepon'  => $this->request->getPost('no_telepon'),
            'email'       => $this->request->getPost('email'),
            'alamat'      => $this->request->getPost('alamat'),
            'jabatan'     => $this->request->getPost('jabatan'),
            'nip'         => $nip,
            'username'    => $this->request->getPost('username'),
            'password'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'profile_img' => $newName,
            'role'        => $this->request->getPost('role') ?? 'Pegawai'
        ]);

        return redirect()->to('/users')->with('success', 'User berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $model = new UsersModel();
        $data['user'] = $model->find($id);

        if (!$data['user']) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan');
        }

        return view('users/edit', $data);
    }

    public function update($id)
    {
        $model = new UsersModel();
        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan');
        }

        $nipBaru = $this->request->getPost('nip');

        // Cek apakah NIP sudah ada dan bukan milik user yang sedang diedit
        $existingUser = $model->where('nip', $nipBaru)->where('id !=', $id)->first();
        if ($existingUser) {
            return redirect()->to('/users/edit/' . $id)->with('error', 'NIP sudah digunakan oleh pengguna lain');
        }

        // Cek apakah user mengunggah foto baru
        $file = $this->request->getFile('profile_img');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/', $newName);
        } else {
            $newName = $user['profile_img']; // Gunakan gambar lama jika tidak ada yang diunggah
        }

        // Cek apakah password baru diinputkan
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $password = $user['password']; // Gunakan password lama jika tidak diubah
        }

        // Update data user
        $model->update($id, [
            'full_name'  => $this->request->getPost('full_name'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email'      => $this->request->getPost('email'),
            'alamat'     => $this->request->getPost('alamat'),
            'jabatan'    => $this->request->getPost('jabatan'),
            'nip'        => $nipBaru,
            'username'   => $this->request->getPost('username'),
            'password'   => $password,
            'profile_img' => $newName,
            'role'       => $this->request->getPost('role') ?? 'Pegawai'
        ]);

        return redirect()->to('/users')->with('success', 'Data user berhasil diperbarui');
    }


    public function delete($id)
    {
        $model = new UsersModel();
        $model->delete($id);
        return redirect()->to('/users');
    }
}
