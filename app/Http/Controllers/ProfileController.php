<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

public function update(Request $request)
{
    // Valideer de ingevoerde gegevens
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
    ]);

    // Haal de ingelogde gebruiker op
    $user = Auth::user();

    // Werk de profielgegevens bij
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->save();

    // Flash een succesbericht
    session()->flash('success', 'Profielgegevens bijgewerkt.');

    // Redirect terug naar de profielpagina
    return redirect()->route('home');
}
}

