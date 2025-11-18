<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * index: Get all FAQs
     * show: Get a specific FAQ by ID
     * store: Create a new FAQ
     * update: Update an existing FAQ by ID
     * destroy: Delete an FAQ by ID
     */

    public function index()
    {
        $faqs = Faq::get();
        return response()->json([
            "success" => true,
            "data" => $faqs,
        ], 200);
    }

    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $incomingFields['question'] = strip_tags($incomingFields['question']);
        $incomingFields['answer'] = strip_tags($incomingFields['answer']);
        $incomingFields['user_id'] = 1;
        $faq = Faq::create($incomingFields);

        return response()->json([
            "success" => true,
            "data" => $faq,
        ], 201);
    }

    // public function createFAQ(Request $request){
    //     if (auth()->check()){   
    //         $incomingFields = $request->validate([
    //             'question' => 'required',
    //             'answer' => 'required'
    //         ]);

    //         $incomingFields['question'] = strip_tags($incomingFields['question']);
    //         $incomingFields['answer'] = filter_var($incomingFields['answer']);
    //         $incomingFields['user_id'] = auth()->id();
    //         Faq::create($incomingFields);
    //         return Redirect("/dashboard");
    //     }
        
    //     return redirect('/');
    // }

    public function showEditScreen(Faq $faq){
        if (auth()->id() == $faq['user_id']){
            return view('edit-faq', ['faq' => $faq]);
        }
        
        return redirect('/');
    }

    public function updateFAQ(Faq $faq, Request $request){
        if (auth()->id() == $faq['user_id']){
            $incomingFields = $request->validate([
                'question' => 'required',
                'answer' => 'required'
            ]);

            $incomingFields['question'] = strip_tags($incomingFields['question']);
            $incomingFields['answer'] = strip_tags($incomingFields['answer']);

            $faq->update($incomingFields);
            
            return redirect('/dashboard');
        }
        
        return redirect('/');
    }

    public function deleteFAQ(Faq $faq){
       if (auth()->id() == $faq['user_id']){
            $faq->delete();

            return redirect('/dashboard');
        }
        
        return redirect('/');
    }

    
}
