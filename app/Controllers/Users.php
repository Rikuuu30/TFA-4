<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Files\UploadedFile;
use Throwable;

class Users extends BaseController
{
    private UserModel $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function index(): string
    {
        $users = $this->users->orderBy('id', 'ASC')->findAll();

        return view('users/index', [
            'pageTitle'  => 'User Accounts',
            'activePage' => 'users',
            'users'      => $users,
        ]);
    }

    public function new(): string
    {
        return view('users/form', [
            'pageTitle'  => 'Add staff account',
            'activePage' => 'users',
            'user'       => null,
            'formErrors' => session()->getFlashdata('formErrors') ?? [],
            'formAction' => site_url('users'),
        ]);
    }

    public function create()
    {
        $data = $this->userInput();
        $password = (string) $this->request->getPost('password');
        $validationData = $data + ['password' => $password];
        $rules = [
            'username'  => 'required|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]',
            'password'  => 'required|min_length[12]|max_length[255]',
        ];

        if (! $this->validateData($validationData, $rules)) {
            return redirect()->back()->with('formErrors', $this->validator->getErrors());
        }

        $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        $this->users->insert($data + ['created_at' => date('Y-m-d H:i:s')]);

        return redirect()->to(site_url('users'))->with('success', 'Staff account added.');
    }

    public function edit(int $id)
    {
        $user = $this->users->find($id);
        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User not found.');
        }

        return view('users/form', [
            'pageTitle'  => 'Edit staff account',
            'activePage' => 'users',
            'user'       => $user,
            'formErrors' => session()->getFlashdata('formErrors') ?? [],
            'formAction' => site_url('users/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $existing = $this->users->find($id);
        if ($existing === null) {
            return redirect()->to(site_url('users'))->with('error', 'That staff account no longer exists.');
        }

        $data = $this->userInput();
        $password = (string) $this->request->getPost('password');
        $validationData = $data;
        $rules = [
            'username'  => "required|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|max_length[100]',
        ];

        if ($password !== '') {
            $validationData['password'] = $password;
            $rules['password'] = 'min_length[12]|max_length[255]';
        }

        if (! $this->validateData($validationData, $rules)) {
            return redirect()->back()->with('formErrors', $this->validator->getErrors());
        }

        if ($password !== '') {
            $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $file = $this->request->getFile('avatar');
        $hasNewAvatar = $file instanceof UploadedFile && $file->getError() !== UPLOAD_ERR_NO_FILE;
        if ($hasNewAvatar) {
            $avatarRules = [
                'avatar' => 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|ext_in[avatar,jpg,jpeg,png]|max_size[avatar,2048]',
            ];
            if (! $this->validate($avatarRules)) {
                return redirect()->back()->withInput()->with('formErrors', $this->validator->getErrors());
            }
        }

        $newAvatar = null;
        if ($hasNewAvatar) {
            try {
                $newAvatar = $this->createAvatarThumbnail($file);
            } catch (Throwable $exception) {
                log_message('error', 'Avatar processing failed: {message}', ['message' => $exception->getMessage()]);
                return redirect()->back()->withInput()->with('formErrors', ['avatar' => 'The image could not be processed. Please try another JPG or PNG image.']);
            }
        }

        if ($newAvatar !== null) {
            $data['avatar'] = $newAvatar;
        }

        if (! $this->users->update($id, $data)) {
            if ($newAvatar !== null) {
                $this->removeAvatar($newAvatar);
            }
            return redirect()->back()->withInput()->with('formErrors', $this->users->errors() ?: ['username' => 'The staff account could not be updated.']);
        }

        if ($newAvatar !== null && ! empty($existing['avatar'])) {
            $this->removeAvatar($existing['avatar']);
        }

        return redirect()->to(site_url('users'))->with('success', 'Staff account updated.');
    }

    private function userInput(): array
    {
        return [
            'username'  => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];
    }

    private function createAvatarThumbnail(UploadedFile $file): string
    {
        $mime = $file->getMimeType();
        $extension = match ($mime) {
            'image/jpeg', 'image/jpg' => 'jpg',
            'image/png'               => 'png',
            default                   => throw new \RuntimeException('Only JPEG and PNG images are accepted.'),
        };
        $filename = 'avatar_' . bin2hex(random_bytes(16)) . '.' . $extension;
        $directory = FCPATH . 'uploads' . DIRECTORY_SEPARATOR;

        if (! is_dir($directory) && ! mkdir($directory, 0755, true) && ! is_dir($directory)) {
            throw new \RuntimeException('The avatar upload folder could not be created.');
        }

        service('image')->withFile($file->getTempName())->fit(256, 256, 'center')->save($directory . $filename, 85);

        return $filename;
    }

    private function removeAvatar(string $filename): void
    {
        if (preg_match('/\Aavatar_[a-f0-9]{32}\.(?:jpg|png)\z/', $filename) === 1) {
            $path = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . $filename;
            if (is_file($path)) {
                unlink($path);
            }
        }
    }
}
