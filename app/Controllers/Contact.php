<?php

namespace App\Controllers;

use App\Models\ContactModel;

class Contact extends BaseController
{
    public function index()
    {
        return view('contact_form');
    }

    public function submit()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email',
            'message' => 'required|min_length[10]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new ContactModel();
        $model->save([
            'name' => htmlspecialchars($this->request->getPost('name')),
            'email' => htmlspecialchars($this->request->getPost('email')),
            'message' => htmlspecialchars($this->request->getPost('message')),
        ]);

        return view('contact_success');
    }
}
