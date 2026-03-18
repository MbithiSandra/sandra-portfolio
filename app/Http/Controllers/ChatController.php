<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    private string $systemPrompt = "You are Sandra's personal portfolio assistant. You help visitors learn about Sandra Mbithi — a Business Information Technology student at Strathmore University, Nairobi, Kenya. Key facts about Sandra: Currently pursuing BSc Business Information Technology at Strathmore University (2023–present). Maintains First-Class Standing with average Grade A. Recognized twice on the Dean's List. Attended FLOW Undergraduate Engineering Summer School at Polytech Montpellier, France (2025). Holds ISC2 Certificate in Cybersecurity (Moringa School, 2023). Member of AIESEC — Marketing & Sales. Volunteer at PEFA Syokimau School. Technical skills: Java, PHP, Python, HTML, CSS, Assembly, Laravel, MySQL, Git, GitHub, Docker, Data Analysis, Machine Learning concepts, Network Security. Projects: Vehicle Rental Management System (Python OOP), Safaricom Network Management System (MySQL), this portfolio website (Laravel, AI). Languages: English, Swahili (both proficient), Spanish (beginner). Contact: mbithisandra83@gmail.com | +254758561281. LinkedIn: linkedin.com/in/sandra-mbithi-032291291. Instructions: Be friendly, professional, and concise. Only answer questions about Sandra or her work. If asked about hiring or availability, encourage contacting via the portfolio form. Keep responses under 150 words.";

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $userMessage = $request->input('message');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('HUGGINGFACE_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->timeout(30)->post('https://router.huggingface.co/v1/chat/completions', [
            'model'    => 'Qwen/Qwen2.5-7B-Instruct',
            'messages' => [
                ['role' => 'system', 'content' => $this->systemPrompt],
                ['role' => 'user',   'content' => $userMessage],
            ],
            'max_tokens'  => 300,
            'temperature' => 0.7,
        ]);

        if ($response->status() === 503) {
            return response()->json([
                'reply' => 'I am just waking up! Please wait 20 seconds and try again. ☕'
            ]);
        }

        if ($response->failed()) {
            return response()->json([
                'error' => 'Sorry, I could not process your message right now.'
            ], 500);
        }

        // Extract reply using the OpenAI-compatible response format
        $reply = $response->json('choices.0.message.content');

        if (empty($reply)) {
            return response()->json([
                'reply' => 'I did not quite catch that. Could you rephrase your question?'
            ]);
        }

        return response()->json(['reply' => trim($reply)]);
    }
}