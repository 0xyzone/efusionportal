<?php
namespace App\Http\Responses;

class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): \Illuminate\Http\RedirectResponse|\Livewire\Features\SupportRedirects\Redirector
    {
        if($request->user()->hasRole('super_admin')) {
            return redirect()->route("filament.admin.pages.dashboard");
        } else {
            return redirect()->route("filament.app.pages.dashboard");
        }
    }
}