<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'service', 'appointment_date', 'appointment_time', 'notes', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Get appointments for a specific user
    public function getUserAppointments($user_id)
    {
        return $this->where('user_id', $user_id)
                    ->orderBy('appointment_date', 'ASC')
                    ->orderBy('appointment_time', 'ASC')
                    ->findAll();
    }
} 