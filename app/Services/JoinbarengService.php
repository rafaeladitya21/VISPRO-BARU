<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class JoinbarengService
{
    public function __construct(
        protected string $apiUrl,
        protected string $apiKey,
        protected string $model,
    ) {
    }

    /**
     * Kirim prompt ke joinbareng AI proxy dan dapatkan jawaban string.
     *
     * @param  array<int, array{role: string, content: string}>  $messages
     */
    public function chat(array $messages, ?string $systemPrompt = null): string
    {
        if (blank($this->apiKey)) {
            throw new RuntimeException('JOINBARENG_API_KEY belum dikonfigurasi di file .env.');
        }

        if ($systemPrompt) {
            array_unshift($messages, ['role' => 'system', 'content' => $systemPrompt]);
        }

        $payload = [
            'model' => $this->model,
            'messages' => $messages,
            'temperature' => 0.7,
        ];

        $response = $this->httpClient()
            ->post($this->apiUrl, $payload);

        if ($response->failed()) {
            Log::error('Joinbareng API error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            throw new RuntimeException('Gagal menghubungi Joinbareng API. Cek log untuk detail.');
        }

        $content = $response->json('choices.0.message.content');

        if (! is_string($content) || blank($content)) {
            throw new RuntimeException('Respons AI kosong atau tidak valid.');
        }

        return $content;
    }

    /**
     * Bangun ringkasan data karyawan yang aman untuk dikirim sebagai konteks AI.
     *
     * @return array<int, array{role: string, content: string}>
     */
    public function buildEmployeeContextPrompt(string $userQuestion): array
    {
        $employees = \App\Models\Employee::query()
            ->select(['id', 'nip', 'nama_lengkap', 'email', 'jabatan', 'departemen', 'tanggal_bergabung'])
            ->orderBy('nama_lengkap')
            ->get();

        $summary = [
            'total_karyawan' => $employees->count(),
            'per_departemen' => $employees->groupBy('departemen')
                ->map(fn ($group) => $group->count())
                ->sortDesc()
                ->all(),
            'per_jabatan' => $employees->groupBy('jabatan')
                ->map(fn ($group) => $group->count())
                ->all(),
            'daftar_singkat' => $employees->take(50)->map(fn ($e) => [
                'nip' => $e->nip,
                'nama' => $e->nama_lengkap,
                'jabatan' => $e->jabatan,
                'departemen' => $e->departemen,
                'bergabung' => optional($e->tanggal_bergabung)->format('Y-m-d'),
            ])->all(),
        ];

        $systemPrompt = "Anda adalah AI Assistant untuk Sistem Informasi Manajemen Karyawan.\n"
            . "Jawablah pertanyaan pengguna HANYA berdasarkan data karyawan yang diberikan di bawah ini dalam format JSON.\n"
            . "Jika informasi yang diminta tidak tersedia di data, jawab dengan sopan bahwa data tidak ditemukan.\n"
            . "Jawab dalam Bahasa Indonesia yang jelas dan ringkas.\n\n"
            . 'Data Karyawan (JSON):' . PHP_EOL . json_encode($summary, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return [
            ['role' => 'user', 'content' => $userQuestion],
        ];
    }

    protected function httpClient(): PendingRequest
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])
            ->timeout(30)
            ->connectTimeout(10)
            ->acceptJson();
    }
}
