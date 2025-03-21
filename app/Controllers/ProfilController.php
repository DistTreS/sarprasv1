<?php

namespace App\Controllers;

use App\Models\UsersModel;

class ProfilController extends BaseController
{
    public function profile()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userModel = new UsersModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/dashboard')->with('error', 'User tidak ditemukan.');
        }

        return view('pages/profile', ['user' => $user]);
    }

    public function profilePegawai()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userModel = new UsersModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/dashboard/pegawai')->with('error', 'User tidak ditemukan.');
        }

        return view('pages/profilepegawai', ['user' => $user]);
    }

    public function editProfile()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userModel = new UsersModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/dashboard')->with('error', 'User tidak ditemukan.');
        }

        return view('pages/editprofile', ['user' => $user]);
    }

    public function editProfilePegawai()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userModel = new UsersModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/dashboard/pegawai')->with('error', 'User tidak ditemukan.');
        }

        return view('pages/editprofilepegawai', ['user' => $user]);
    }


    public function update()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/profil')->with('error', 'Anda harus login.');
        }

        $userModel = new UsersModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/profil')->with('error', 'User tidak ditemukan.');
        }

        $nipBaru = $this->request->getPost('nip');
        $existingUser = $userModel->where('nip', $nipBaru)->where('id !=', $userId)->first();
        if ($existingUser) {
            return redirect()->to('/profile/edit/')->with('error', 'NIP sudah digunakan oleh pengguna lain');
        }

        // Cek apakah user mengunggah foto baru
        $file = $this->request->getFile('profile_img');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/', $newName);
        } else {
            $newName = $user['profile_img']; // Gunakan gambar lama jika tidak ada yang diunggah
        }

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $password = $user['password']; // Gunakan password lama jika tidak diubah
        }

        $updatedData = [
            'full_name'  => $this->request->getPost('full_name'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email'      => $this->request->getPost('email'),
            'alamat'     => $this->request->getPost('alamat'),
            'jabatan'    => $this->request->getPost('jabatan'),
            'nip'        => $nipBaru,
            'username'   => $this->request->getPost('username'),
            'password'   => $password,
            'profile_img' => $newName,
        ];

        $userModel->update($userId, $updatedData);

        return redirect()->to('/profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePegawai()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/profil/pegawai')->with('error', 'Anda harus login.');
        }

        $userModel = new UsersModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/profil/pegawai')->with('error', 'User tidak ditemukan.');
        }

        $nipBaru = $this->request->getPost('nip');
        $existingUser = $userModel->where('nip', $nipBaru)->where('id !=', $userId)->first();
        if ($existingUser) {
            return redirect()->to('/profilepegawai/edit/')->with('error', 'NIP sudah digunakan oleh pengguna lain');
        }

        // Cek apakah user mengunggah foto baru
        $file = $this->request->getFile('profile_img');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/', $newName);
        } else {
            $newName = $user['profile_img']; // Gunakan gambar lama jika tidak ada yang diunggah
        }

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $password = $user['password']; // Gunakan password lama jika tidak diubah
        }

        $updatedData = [
            'full_name'  => $this->request->getPost('full_name'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email'      => $this->request->getPost('email'),
            'alamat'     => $this->request->getPost('alamat'),
            'jabatan'    => $this->request->getPost('jabatan'),
            'nip'        => $nipBaru,
            'username'   => $this->request->getPost('username'),
            'password'   => $password,
            'profile_img' => $newName,
        ];

        $userModel->update($userId, $updatedData);

        return redirect()->to('/profil/pegawai')->with('success', 'Profil berhasil diperbarui.');
    }
}
