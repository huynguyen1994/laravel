<?php

namespace App\Services;

use App\Http\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountsService
{
    public function find(ProviderUser $providerUser, $provider)
    {
        $account = User::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();
        return $account ? $account->user : null;
    }

    public function link(User $user, ProviderUser $providerUser, $provider)
    {
        $account = User::where('provider_name', $provider)->where('user_id', $user->id)->exists();
        if ($account) {
            return null;
        } else {
            dd($provider);
            return User::create([
                'name' => $user->name,
                'email' => $user->email,
                'remember_token' => $user->token,
                'social_id' => $user->id,
            ]);
        }
    }
}