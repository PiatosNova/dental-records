<?php

namespace App\Controllers;

use App\Models\AppointmentModel;

class Appointments extends BaseController
{
    public function index()
    {
        $appointmentModel = new AppointmentModel();
        $data = [
            'title' => 'My Appointments',
            'appointments' => $appointmentModel->getUserAppointments(session()->get('user_id'))
        ];
        
        return view('appointments/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Book Appointment',
            'services' => [
                'Dental Checkup',
                'Teeth Cleaning',
                'Tooth Extraction',
                'Root Canal',
                'Dental Filling',
                'Teeth Whitening'
            ]
        ];
        
        return view('appointments/create', $data);
    }

    public function store()
    {
        $rules = [
            'service' => 'required',
            'appointment_date' => 'required|valid_date',
            'appointment_time' => 'required',
            'notes' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $appointmentModel = new AppointmentModel();
        $data = [
            'user_id' => session()->get('user_id'),
            'service' => $this->request->getPost('service'),
            'appointment_date' => $this->request->getPost('appointment_date'),
            'appointment_time' => $this->request->getPost('appointment_time'),
            'notes' => $this->request->getPost('notes'),
            'status' => 'pending'
        ];

        $appointmentModel->save($data);
        session()->setFlashdata('success', 'Appointment booked successfully.');
        return redirect()->to('appointments');
    }

    public function cancel($id)
    {
        $appointmentModel = new AppointmentModel();
        $appointment = $appointmentModel->where('user_id', session()->get('user_id'))
                                      ->find($id);

        if (!$appointment) {
            return redirect()->to('appointments')->with('error', 'Appointment not found');
        }

        $appointmentModel->update($id, ['status' => 'cancelled']);
        return redirect()->to('appointments')->with('success', 'Appointment cancelled successfully');
    }

    public function edit($id)
    {
        $appointmentModel = new AppointmentModel();
        $appointment = $appointmentModel->where('user_id', session()->get('user_id'))
                                      ->find($id);

        if (!$appointment) {
            return redirect()->to('appointments')->with('error', 'Appointment not found');
        }

        return view('appointments/edit', [
            'appointment' => $appointment
        ]);
    }

    public function update($id)
    {
        $appointmentModel = new AppointmentModel();
        $appointment = $appointmentModel->where('user_id', session()->get('user_id'))
                                      ->find($id);

        if (!$appointment) {
            return redirect()->to('appointments')->with('error', 'Appointment not found');
        }

        $rules = [
            'service' => 'required',
            'appointment_date' => 'required|valid_date',
            'appointment_time' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $data = [
            'service' => $this->request->getPost('service'),
            'appointment_date' => $this->request->getPost('appointment_date'),
            'appointment_time' => $this->request->getPost('appointment_time')
        ];

        $appointmentModel->update($id, $data);
        return redirect()->to('appointments')->with('success', 'Appointment updated successfully');
    }

    public function delete($id)
    {
        $appointmentModel = new AppointmentModel();
        $appointment = $appointmentModel->where('user_id', session()->get('user_id'))
                                      ->find($id);

        if (!$appointment) {
            return redirect()->to('appointments')->with('error', 'Appointment not found');
        }

        $appointmentModel->delete($id);
        return redirect()->to('appointments')->with('success', 'Appointment deleted successfully');
    }
} 