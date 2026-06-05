<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ConfiguracaoController extends Controller
{
    public function index()
    {
        $motoboyApiUrl = Setting::getValue('motoboy_api_url', '');
        return view('admin.configuracoes.index', compact('motoboyApiUrl'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'motoboy_api_url' => 'nullable|url|max:500',
        ]);

        Setting::setValue('motoboy_api_url', $request->motoboy_api_url);

        return redirect()->route('admin.configuracoes.index')
            ->with('success', 'Configurações salvas com sucesso!');
    }
}
