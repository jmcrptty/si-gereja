<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumQuestion;
use Illuminate\Support\Facades\Auth;

class ForumUmatController extends Controller
{
    // Halaman untuk umat (lihat pertanyaan yang sudah dijawab + form tanya)
    public function umatIndex(Request $request)
    {
        $search = $request->query('search');

        $questions = ForumQuestion::whereNotNull('answer')
            ->when($search, function ($query, $search) {
                return $query->where('question', 'like', "%{$search}%")
                             ->orWhere('answer', 'like', "%{$search}%");
            })
            ->orderBy('answered_at', 'desc')
            ->paginate(10);

        return view('layouts.forumumat', compact('questions', 'search'));
    }

    // Simpan pertanyaan dari umat
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'question' => 'required|string',
        ]);

        ForumQuestion::create([
            'name' => $request->name,
            'question' => $request->question,
        ]);

        return redirect()->back()->with('success', 'Pertanyaan Anda telah dikirim. Tunggu jawaban dari admin.');
    }

    // Halaman sekretaris (admin) lihat semua pertanyaan (belum & sudah dijawab)
    public function sekretarisIndex()
    {
        $questions = ForumQuestion::latest()->paginate(5);

        return view('layouts.sekretaris.forumumat', compact('questions'));
    }

    // Sekretaris jawab pertanyaan
    public function answer(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        $question = ForumQuestion::findOrFail($id);
        $question->answer = $request->answer;
        $question->answered_at = now();
        $question->save();

        return redirect()->back()->with('success', 'Jawaban berhasil disimpan.');
    }

    // Sekretaris hapus pertanyaan
    public function destroy($id)
    {
        $question = ForumQuestion::findOrFail($id);
        $question->delete();

        return redirect()->back()->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
