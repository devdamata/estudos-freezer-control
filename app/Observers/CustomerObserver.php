<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use App\Enums\PanelTypeEnum;
use App\Mail\NewCustomerMail;
use Illuminate\Support\Facades\Mail;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     */
    public function created(Customer $customer): void
    {
        $password = Str::password(8);

        $user = User::create([
            'name' => $customer->name,
            'email' => $customer->email,
            'panel' => PanelTypeEnum::APP,
            'password' => bcrypt($password),
        ]);

        $customer->user_id = $user->id;
        $customer->saveQuietly();

        Mail::to($customer->email)->send(new NewCustomerMail($customer, $password));

    }


}
