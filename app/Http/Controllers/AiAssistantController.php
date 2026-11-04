<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskAiRequest;
use App\Services\JoinbarengService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class AiAssistantController extends Controller
{
    public function index(): View
    {
        return view('ai.index');
    }

    public function ask(AskAiRequest $request, JoinbarengService $ai): RedirectResponse
    {
        $question = $request->validated('question');

        try {
            $messages = $ai->buildEmployeeContextPrompt($question);
            $answer = $ai->chat($messages);
        } catch (Throwable $e) {
            Log::error('AI assistant failure', ['message' => $e->getMessage()]);
            return back()
                ->withInput()
                ->withErrors(['question' => 'Maaf, AI assistant sedang tidak tersedia. Silakan coba lagi nanti.']);
        }

        return back()
            ->withInput()
            ->with('ai_question', $question)
            ->with('ai_answer', $answer);
    }
}