<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JeroenDesloovere\VCard\VCard;
use Stringable;

class VcardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {

        // define vcard
        $vcard = new VCard();

        $name = explode(" ",$user->name);
        // define variables
        $lastname = $name[0];
        if(count($name) > 1){
            $firstname = $name[1];
        }

        $additional = '';
        $prefix = '';
        $suffix = '';

        // add personal data
        $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

        // add work data
        // $vcard->addCompany('Siesqo');
        $vcard->addJobtitle($user->position);
        // $vcard->addRole('Data Protection Officer');
        $vcard->addEmail('info@jeroendesloovere.be');
        // $vcard->addPhoneNumber(1234121212, 'PREF;WORK');
        $vcard->addPhoneNumber($user->telephone, 'WORK');
        // $vcard->addAddress(null, null, 'street', 'worktown', null, 'workpostcode', 'Belgium');
        // $vcard->addLabel('street, worktown, workpostcode Belgium');
        $vcard->addURL($user->site_url);

        $photo = Storage::disk('public')->url($user->profile_photo_path);

        $vcard->addPhoto($photo);

            // return vcard as a string
            //return $vcard->getOutput();

            // return vcard as a download
        return $vcard->download();
    }
}
