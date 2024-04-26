<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class UpdateUniquePhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    private $userId;
    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
         // Decrypt each phone number and check for uniqueness
         $isUnique = true;
         foreach (User::where('id', '!=', $this->userId)->get() as $user) {
             try {
                 if (Crypt::decryptString($user->phone_number) === $value) {
                     $isUnique = false;
                     break;
                 }
             } catch (\Exception $e) {
                 // Handling exception if decryption fails, optionally log the error
                 $fail('Error en decriptacion: ' . $e->getMessage());
                 return;
             }
         }

         if (!$isUnique) {
             $fail('Este numero de telefono se esta usando.');
         }
    }
}
