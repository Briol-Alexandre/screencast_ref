<?php

namespace App\Http\Controllers;

use App\models\Attendance;
use App\Models\Contact;
use App\Models\Jiri;
use Core\Exceptions\FileNotFoundException;
use Core\Response;
use Core\Validator;

class AttendanceController
{
    private Attendance $attendance;
    public function __construct()
    {
        try {
            $this->attendance = new Attendance(base_path('.env.local.ini'));
        } catch (FileNotFoundException $exception) {
            exit($exception->getMessage());
        }
    }
    public function update(): void
    {
        extract($_REQUEST);
        $this->attendance->setRole(compact('jiri_id', 'contact_id', 'role'));
        Response::redirect('/jiri?id=' . $jiri_id);
    }
    public function destroy(): void
    {
        extract($_REQUEST);
        $this->attendance->delete(compact('contact_id', 'jiri_id'));
        Response::redirect('/jiri?id=' . $jiri_id);
    }
}