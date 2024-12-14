<?php

namespace App\Controllers;

use App\Models\AppointmentModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        $appointmentModel = new AppointmentModel();
        $userModel = new UserModel();

        $data = [
            'title' => 'Admin Dashboard',
            'total_appointments' => $appointmentModel->countAll(),
            'pending_appointments' => $appointmentModel->where('status', 'pending')->countAllResults(),
            'total_users' => $userModel->countAll(),
            'recent_appointments' => $appointmentModel->select('appointments.*, users.name as patient_name')
                                                    ->join('users', 'users.id = appointments.user_id')
                                                    ->orderBy('appointment_date', 'DESC')
                                                    ->orderBy('appointment_time', 'DESC')
                                                    ->limit(5)
                                                    ->find()
        ];

        return view('admin/dashboard', $data);
    }

    public function appointments()
    {
        $appointmentModel = new AppointmentModel();
        
        $data = [
            'title' => 'Manage Appointments',
            'appointments' => $appointmentModel->select('appointments.*, users.name as patient_name, users.email as patient_email')
                                            ->join('users', 'users.id = appointments.user_id')
                                            ->orderBy('appointment_date', 'DESC')
                                            ->orderBy('appointment_time', 'DESC')
                                            ->find()
        ];

        return view('admin/appointments', $data);
    }

    public function updateStatus($id)
    {
        $appointmentModel = new AppointmentModel();
        $status = $this->request->getPost('status');

        $appointmentModel->update($id, ['status' => $status]);
        session()->setFlashdata('success', 'Appointment status updated successfully.');
        
        return redirect()->back();
    }
} 