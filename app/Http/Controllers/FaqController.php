<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
        $faqs = Faq::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $faqs
        ]);
    }
    
    public function store(Request $request){
        if (auth()->check()){   
            $incomingFields = $request->validate([
                'question' => 'required',
                'answer' => 'required'
            ]);

            $incomingFields['question'] = strip_tags($incomingFields['question']);
            $incomingFields['answer'] = filter_var($incomingFields['answer']);
            $incomingFields['user_id'] = auth()->id();
            $faq = Faq::create($incomingFields);
            return response()->json([
                'success' => true,
                'message' => 'FAQ berhasil dibuat',
                'data' => $faq
            ]);
        }
    }

    public function update(Faq $faq, Request $request){
        if (auth()->id() == $faq['user_id']){
            $incomingFields = $request->validate([
                'question' => 'required',
                'answer' => 'required'
            ]);

            $incomingFields['question'] = strip_tags($incomingFields['question']);
            $incomingFields['answer'] = strip_tags($incomingFields['answer']);

            $faq->update($incomingFields);
            
            return response()->json([
                'success' => true,
                'message' => 'FAQ berhasil diperbaruit',
                'data' => $faq
            ]);
        }
    }

    public function destroy(Faq $faq){
       if (auth()->id() == $faq['user_id']){
            $faq->delete();

            return response()->json([
                'success' => true,
                'message' => 'FAQ berhasil dihapus',
                'data' => $faq
            ]);
        }
    }

    
}
