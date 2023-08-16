<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCollaborators implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $emailAddresses = explode(',', $value);

            foreach ($emailAddresses as $email) {
                $user = User::where('email', $email)->first();
                if (blank($user)) {
                    $fail("One or more collaborators are invalid.");
                }elseif($user->id === userId()){
                    $fail("You can't add yourself to Collaborators.");
                }
            }

    }
}
