<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    private CustomerModel $customers;

    public function __construct()
    {
        $this->customers = new CustomerModel();
    }

    public function index(): string
    {
        $customers = $this->customers->orderBy('id', 'ASC')->findAll();

        return view('customers/index', [
            'pageTitle'  => 'Customer Accounts',
            'activePage' => 'customers',
            'customers'  => $customers,
        ]);
    }

    public function new(): string
    {
        return view('customers/form', [
            'pageTitle'  => 'Add customer',
            'activePage' => 'customers',
            'customer'   => null,
            'formErrors' => session()->getFlashdata('formErrors') ?? [],
            'formAction' => site_url('customers'),
        ]);
    }

    public function create()
    {
        $data = $this->customerInput();
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('formErrors', $this->validator->getErrors());
        }

        $this->customers->insert($data + ['created_at' => date('Y-m-d H:i:s')]);

        return redirect()->to(site_url('customers'))->with('success', 'Customer account added.');
    }

    public function edit(int $id)
    {
        $customer = $this->customers->find($id);
        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound('Customer not found.');
        }

        return view('customers/form', [
            'pageTitle'  => 'Edit customer',
            'activePage' => 'customers',
            'customer'   => $customer,
            'formErrors' => session()->getFlashdata('formErrors') ?? [],
            'formAction' => site_url('customers/' . $id),
        ]);
    }

    public function update(int $id)
    {
        if ($this->customers->find($id) === null) {
            return redirect()->to(site_url('customers'))->with('error', 'That customer account no longer exists.');
        }

        $data = $this->customerInput();
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('formErrors', $this->validator->getErrors());
        }

        $this->customers->update($id, $data);

        return redirect()->to(site_url('customers'))->with('success', 'Customer account updated.');
    }

    private function customerInput(): array
    {
        return [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')) ?: null,
        ];
    }
}
