<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = Alert::with('product')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('alerts.index', compact('alerts'));
    }

    public function resolve(Alert $alert)
    {
        $alert->update(['resolved' => true]);
        return redirect('/alerts')->with('success', 'Alerte résolue');
    }

    public function destroy(Alert $alert)
    {
        $alert->delete();
        return redirect('/alerts')->with('success', 'Alerte supprimée');
    }
}
