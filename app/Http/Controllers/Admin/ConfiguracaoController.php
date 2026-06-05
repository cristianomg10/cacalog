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
        $opencageApiKey = Setting::getValue('opencage_api_key', '');
        return view('admin.configuracoes.index', compact('motoboyApiUrl', 'opencageApiKey'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'motoboy_api_url' => 'nullable|string|max:500',
            'opencage_api_key' => 'nullable|string|max:255',
        ]);

        Setting::setValue('motoboy_api_url', $request->motoboy_api_url);
        Setting::setValue('opencage_api_key', $request->opencage_api_key);

        return redirect()->route('admin.configuracoes.index')
            ->with('success', 'Configurações salvas com sucesso!');
    }
}
