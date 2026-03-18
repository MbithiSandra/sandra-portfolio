<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'name'     => 'Sandra Mbithi',
            'title'    => 'Business Information Technology Student',
            'location' => 'Nairobi, Kenya',
            'email'    => 'mbithisandra83@gmail.com',
            'phone'    => '+254758561281',
            'linkedin' => 'https://www.linkedin.com/in/sandra-mbithi-032291291',
        ];

        return view('home', $data);
    }

    // Serves the CV as a downloadable PDF
    public function downloadCV()
    {
        $path = storage_path('app/public/cv/sandra_mbithi_cv.pdf');

        // Check the file actually exists before trying to send it
        if (!file_exists($path)) {
            abort(404, 'CV not found.');
        }

        // response()->download() tells the browser to download the file
        // The second argument is the filename the user sees when downloading
        return response()->download($path, 'Sandra-Mbithi-CV.pdf');
    }
}