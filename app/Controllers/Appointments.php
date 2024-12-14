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
        $appointment = $appointmentModel->find($id);

        if ($appointment && $appointment['user_id'] == session()->get('user_id')) {
            $appointmentModel->update($id, ['status' => 'cancelled']);
            session()->setFlashdata('success', 'Appointment cancelled successfully.');
        }

        return redirect()->to('appointments');
    }
} 