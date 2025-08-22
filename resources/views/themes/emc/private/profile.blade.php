<x-theme::private-app>
<!-- Twitter-like Profile Header -->
<div class="px-4 py-3 border-b border-gray-200 top-16 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Edit Profile</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Update your profile information</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-gray-100 rounded-full hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                Back to the dashboard
            </a>
        </div>
    </div>
</div>

<!-- Profile Form -->
<div class="p-6">
    @if(session('success'))
        <div class="p-4 mb-6 text-green-700 bg-green-100 border border-green-400 rounded-lg dark:bg-green-900 dark:border-green-600 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        <!-- Profile Photo -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Profile Photo</label>
            <div class="flex items-center gap-4">
                @if($user->profile_photo_path)
                    <img src="{{ Storage::disk('public')->url($user->profile_photo_path) }}" alt="{{ $user->name }}" class="object-cover w-20 h-20 rounded-full">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1e40af&color=fff" alt="{{ $user->name }}" class="w-20 h-20 rounded-full">
                @endif
                <div class="flex-1">
                    <input type="file" name="profile_photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
                    @error('profile_photo')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Basic Information -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Position/Title</label>
                <input type="text" name="position" id="position" value="{{ old('position', $user->position) }}" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                @error('position')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="telephone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                <input type="tel" name="telephone" id="telephone" value="{{ old('telephone', $user->telephone) }}" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                @error('telephone')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                @error('city')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                <select name="country" id="country" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    <option value="">Select a country</option>
                    <option value="Afghanistan" {{ old('country', $user->country) == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                    <option value="Albania" {{ old('country', $user->country) == 'Albania' ? 'selected' : '' }}>Albania</option>
                    <option value="Algeria" {{ old('country', $user->country) == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                    <option value="Andorra" {{ old('country', $user->country) == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                    <option value="Angola" {{ old('country', $user->country) == 'Angola' ? 'selected' : '' }}>Angola</option>
                    <option value="Argentina" {{ old('country', $user->country) == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                    <option value="Armenia" {{ old('country', $user->country) == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                    <option value="Australia" {{ old('country', $user->country) == 'Australia' ? 'selected' : '' }}>Australia</option>
                    <option value="Austria" {{ old('country', $user->country) == 'Austria' ? 'selected' : '' }}>Austria</option>
                    <option value="Azerbaijan" {{ old('country', $user->country) == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                    <option value="Bahamas" {{ old('country', $user->country) == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
                    <option value="Bahrain" {{ old('country', $user->country) == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                    <option value="Bangladesh" {{ old('country', $user->country) == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                    <option value="Barbados" {{ old('country', $user->country) == 'Barbados' ? 'selected' : '' }}>Barbados</option>
                    <option value="Belarus" {{ old('country', $user->country) == 'Belarus' ? 'selected' : '' }}>Belarus</option>
                    <option value="Belgium" {{ old('country', $user->country) == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                    <option value="Belize" {{ old('country', $user->country) == 'Belize' ? 'selected' : '' }}>Belize</option>
                    <option value="Benin" {{ old('country', $user->country) == 'Benin' ? 'selected' : '' }}>Benin</option>
                    <option value="Bhutan" {{ old('country', $user->country) == 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
                    <option value="Bolivia" {{ old('country', $user->country) == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                    <option value="Bosnia and Herzegovina" {{ old('country', $user->country) == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                    <option value="Botswana" {{ old('country', $user->country) == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                    <option value="Brazil" {{ old('country', $user->country) == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                    <option value="Brunei" {{ old('country', $user->country) == 'Brunei' ? 'selected' : '' }}>Brunei</option>
                    <option value="Bulgaria" {{ old('country', $user->country) == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                    <option value="Burkina Faso" {{ old('country', $user->country) == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                    <option value="Burundi" {{ old('country', $user->country) == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                    <option value="Cambodia" {{ old('country', $user->country) == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                    <option value="Cameroon" {{ old('country', $user->country) == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                    <option value="Canada" {{ old('country', $user->country) == 'Canada' ? 'selected' : '' }}>Canada</option>
                    <option value="Cape Verde" {{ old('country', $user->country) == 'Cape Verde' ? 'selected' : '' }}>Cape Verde</option>
                    <option value="Central African Republic" {{ old('country', $user->country) == 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>
                    <option value="Chad" {{ old('country', $user->country) == 'Chad' ? 'selected' : '' }}>Chad</option>
                    <option value="Chile" {{ old('country', $user->country) == 'Chile' ? 'selected' : '' }}>Chile</option>
                    <option value="China" {{ old('country', $user->country) == 'China' ? 'selected' : '' }}>China</option>
                    <option value="Colombia" {{ old('country', $user->country) == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                    <option value="Comoros" {{ old('country', $user->country) == 'Comoros' ? 'selected' : '' }}>Comoros</option>
                    <option value="Congo" {{ old('country', $user->country) == 'Congo' ? 'selected' : '' }}>Congo</option>
                    <option value="Costa Rica" {{ old('country', $user->country) == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                    <option value="Croatia" {{ old('country', $user->country) == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                    <option value="Cuba" {{ old('country', $user->country) == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                    <option value="Cyprus" {{ old('country', $user->country) == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                    <option value="Czech Republic" {{ old('country', $user->country) == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                    <option value="Denmark" {{ old('country', $user->country) == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                    <option value="Djibouti" {{ old('country', $user->country) == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
                    <option value="Dominica" {{ old('country', $user->country) == 'Dominica' ? 'selected' : '' }}>Dominica</option>
                    <option value="Dominican Republic" {{ old('country', $user->country) == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                    <option value="Ecuador" {{ old('country', $user->country) == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                    <option value="Egypt" {{ old('country', $user->country) == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                    <option value="El Salvador" {{ old('country', $user->country) == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                    <option value="Equatorial Guinea" {{ old('country', $user->country) == 'Equatorial Guinea' ? 'selected' : '' }}>Equatorial Guinea</option>
                    <option value="Eritrea" {{ old('country', $user->country) == 'Eritrea' ? 'selected' : '' }}>Eritrea</option>
                    <option value="Estonia" {{ old('country', $user->country) == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                    <option value="Eswatini" {{ old('country', $user->country) == 'Eswatini' ? 'selected' : '' }}>Eswatini</option>
                    <option value="Ethiopia" {{ old('country', $user->country) == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                    <option value="Fiji" {{ old('country', $user->country) == 'Fiji' ? 'selected' : '' }}>Fiji</option>
                    <option value="Finland" {{ old('country', $user->country) == 'Finland' ? 'selected' : '' }}>Finland</option>
                    <option value="France" {{ old('country', $user->country) == 'France' ? 'selected' : '' }}>France</option>
                    <option value="Gabon" {{ old('country', $user->country) == 'Gabon' ? 'selected' : '' }}>Gabon</option>
                    <option value="Gambia" {{ old('country', $user->country) == 'Gambia' ? 'selected' : '' }}>Gambia</option>
                    <option value="Georgia" {{ old('country', $user->country) == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                    <option value="Germany" {{ old('country', $user->country) == 'Germany' ? 'selected' : '' }}>Germany</option>
                    <option value="Ghana" {{ old('country', $user->country) == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                    <option value="Greece" {{ old('country', $user->country) == 'Greece' ? 'selected' : '' }}>Greece</option>
                    <option value="Grenada" {{ old('country', $user->country) == 'Grenada' ? 'selected' : '' }}>Grenada</option>
                    <option value="Guatemala" {{ old('country', $user->country) == 'Guatemala' ? 'selected' : '' }}>Guatemala</option>
                    <option value="Guinea" {{ old('country', $user->country) == 'Guinea' ? 'selected' : '' }}>Guinea</option>
                    <option value="Guinea-Bissau" {{ old('country', $user->country) == 'Guinea-Bissau' ? 'selected' : '' }}>Guinea-Bissau</option>
                    <option value="Guyana" {{ old('country', $user->country) == 'Guyana' ? 'selected' : '' }}>Guyana</option>
                    <option value="Haiti" {{ old('country', $user->country) == 'Haiti' ? 'selected' : '' }}>Haiti</option>
                    <option value="Honduras" {{ old('country', $user->country) == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                    <option value="Hungary" {{ old('country', $user->country) == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                    <option value="Iceland" {{ old('country', $user->country) == 'Iceland' ? 'selected' : '' }}>Iceland</option>
                    <option value="India" {{ old('country', $user->country) == 'India' ? 'selected' : '' }}>India</option>
                    <option value="Indonesia" {{ old('country', $user->country) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                    <option value="Iran" {{ old('country', $user->country) == 'Iran' ? 'selected' : '' }}>Iran</option>
                    <option value="Iraq" {{ old('country', $user->country) == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                    <option value="Ireland" {{ old('country', $user->country) == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                    <option value="Israel" {{ old('country', $user->country) == 'Israel' ? 'selected' : '' }}>Israel</option>
                    <option value="Italy" {{ old('country', $user->country) == 'Italy' ? 'selected' : '' }}>Italy</option>
                    <option value="Jamaica" {{ old('country', $user->country) == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                    <option value="Japan" {{ old('country', $user->country) == 'Japan' ? 'selected' : '' }}>Japan</option>
                    <option value="Jordan" {{ old('country', $user->country) == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                    <option value="Kazakhstan" {{ old('country', $user->country) == 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>
                    <option value="Kenya" {{ old('country', $user->country) == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                    <option value="Kiribati" {{ old('country', $user->country) == 'Kiribati' ? 'selected' : '' }}>Kiribati</option>
                    <option value="Kuwait" {{ old('country', $user->country) == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                    <option value="Kyrgyzstan" {{ old('country', $user->country) == 'Kyrgyzstan' ? 'selected' : '' }}>Kyrgyzstan</option>
                    <option value="Laos" {{ old('country', $user->country) == 'Laos' ? 'selected' : '' }}>Laos</option>
                    <option value="Latvia" {{ old('country', $user->country) == 'Latvia' ? 'selected' : '' }}>Latvia</option>
                    <option value="Lebanon" {{ old('country', $user->country) == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                    <option value="Lesotho" {{ old('country', $user->country) == 'Lesotho' ? 'selected' : '' }}>Lesotho</option>
                    <option value="Liberia" {{ old('country', $user->country) == 'Liberia' ? 'selected' : '' }}>Liberia</option>
                    <option value="Libya" {{ old('country', $user->country) == 'Libya' ? 'selected' : '' }}>Libya</option>
                    <option value="Liechtenstein" {{ old('country', $user->country) == 'Liechtenstein' ? 'selected' : '' }}>Liechtenstein</option>
                    <option value="Lithuania" {{ old('country', $user->country) == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                    <option value="Luxembourg" {{ old('country', $user->country) == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                    <option value="Madagascar" {{ old('country', $user->country) == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                    <option value="Malawi" {{ old('country', $user->country) == 'Malawi' ? 'selected' : '' }}>Malawi</option>
                    <option value="Malaysia" {{ old('country', $user->country) == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                    <option value="Maldives" {{ old('country', $user->country) == 'Maldives' ? 'selected' : '' }}>Maldives</option>
                    <option value="Mali" {{ old('country', $user->country) == 'Mali' ? 'selected' : '' }}>Mali</option>
                    <option value="Malta" {{ old('country', $user->country) == 'Malta' ? 'selected' : '' }}>Malta</option>
                    <option value="Marshall Islands" {{ old('country', $user->country) == 'Marshall Islands' ? 'selected' : '' }}>Marshall Islands</option>
                    <option value="Mauritania" {{ old('country', $user->country) == 'Mauritania' ? 'selected' : '' }}>Mauritania</option>
                    <option value="Mauritius" {{ old('country', $user->country) == 'Mauritius' ? 'selected' : '' }}>Mauritius</option>
                    <option value="Mexico" {{ old('country', $user->country) == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                    <option value="Micronesia" {{ old('country', $user->country) == 'Micronesia' ? 'selected' : '' }}>Micronesia</option>
                    <option value="Moldova" {{ old('country', $user->country) == 'Moldova' ? 'selected' : '' }}>Moldova</option>
                    <option value="Monaco" {{ old('country', $user->country) == 'Monaco' ? 'selected' : '' }}>Monaco</option>
                    <option value="Mongolia" {{ old('country', $user->country) == 'Mongolia' ? 'selected' : '' }}>Mongolia</option>
                    <option value="Montenegro" {{ old('country', $user->country) == 'Montenegro' ? 'selected' : '' }}>Montenegro</option>
                    <option value="Morocco" {{ old('country', $user->country) == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                    <option value="Mozambique" {{ old('country', $user->country) == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
                    <option value="Myanmar" {{ old('country', $user->country) == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                    <option value="Namibia" {{ old('country', $user->country) == 'Namibia' ? 'selected' : '' }}>Namibia</option>
                    <option value="Nauru" {{ old('country', $user->country) == 'Nauru' ? 'selected' : '' }}>Nauru</option>
                    <option value="Nepal" {{ old('country', $user->country) == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                    <option value="Netherlands" {{ old('country', $user->country) == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                    <option value="New Zealand" {{ old('country', $user->country) == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                    <option value="Nicaragua" {{ old('country', $user->country) == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
                    <option value="Niger" {{ old('country', $user->country) == 'Niger' ? 'selected' : '' }}>Niger</option>
                    <option value="Nigeria" {{ old('country', $user->country) == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                    <option value="North Korea" {{ old('country', $user->country) == 'North Korea' ? 'selected' : '' }}>North Korea</option>
                    <option value="North Macedonia" {{ old('country', $user->country) == 'North Macedonia' ? 'selected' : '' }}>North Macedonia</option>
                    <option value="Norway" {{ old('country', $user->country) == 'Norway' ? 'selected' : '' }}>Norway</option>
                    <option value="Oman" {{ old('country', $user->country) == 'Oman' ? 'selected' : '' }}>Oman</option>
                    <option value="Pakistan" {{ old('country', $user->country) == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                    <option value="Palau" {{ old('country', $user->country) == 'Palau' ? 'selected' : '' }}>Palau</option>
                    <option value="Panama" {{ old('country', $user->country) == 'Panama' ? 'selected' : '' }}>Panama</option>
                    <option value="Papua New Guinea" {{ old('country', $user->country) == 'Papua New Guinea' ? 'selected' : '' }}>Papua New Guinea</option>
                    <option value="Paraguay" {{ old('country', $user->country) == 'Paraguay' ? 'selected' : '' }}>Paraguay</option>
                    <option value="Peru" {{ old('country', $user->country) == 'Peru' ? 'selected' : '' }}>Peru</option>
                    <option value="Philippines" {{ old('country', $user->country) == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                    <option value="Poland" {{ old('country', $user->country) == 'Poland' ? 'selected' : '' }}>Poland</option>
                    <option value="Portugal" {{ old('country', $user->country) == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                    <option value="Qatar" {{ old('country', $user->country) == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                    <option value="Romania" {{ old('country', $user->country) == 'Romania' ? 'selected' : '' }}>Romania</option>
                    <option value="Russia" {{ old('country', $user->country) == 'Russia' ? 'selected' : '' }}>Russia</option>
                    <option value="Rwanda" {{ old('country', $user->country) == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                    <option value="Saint Kitts and Nevis" {{ old('country', $user->country) == 'Saint Kitts and Nevis' ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                    <option value="Saint Lucia" {{ old('country', $user->country) == 'Saint Lucia' ? 'selected' : '' }}>Saint Lucia</option>
                    <option value="Saint Vincent and the Grenadines" {{ old('country', $user->country) == 'Saint Vincent and the Grenadines' ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
                    <option value="Samoa" {{ old('country', $user->country) == 'Samoa' ? 'selected' : '' }}>Samoa</option>
                    <option value="San Marino" {{ old('country', $user->country) == 'San Marino' ? 'selected' : '' }}>San Marino</option>
                    <option value="Saudi Arabia" {{ old('country', $user->country) == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                    <option value="Senegal" {{ old('country', $user->country) == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                    <option value="Serbia" {{ old('country', $user->country) == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                    <option value="Seychelles" {{ old('country', $user->country) == 'Seychelles' ? 'selected' : '' }}>Seychelles</option>
                    <option value="Sierra Leone" {{ old('country', $user->country) == 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>
                    <option value="Singapore" {{ old('country', $user->country) == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                    <option value="Slovakia" {{ old('country', $user->country) == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                    <option value="Slovenia" {{ old('country', $user->country) == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
                    <option value="Solomon Islands" {{ old('country', $user->country) == 'Solomon Islands' ? 'selected' : '' }}>Solomon Islands</option>
                    <option value="Somalia" {{ old('country', $user->country) == 'Somalia' ? 'selected' : '' }}>Somalia</option>
                    <option value="South Africa" {{ old('country', $user->country) == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                    <option value="South Korea" {{ old('country', $user->country) == 'South Korea' ? 'selected' : '' }}>South Korea</option>
                    <option value="South Sudan" {{ old('country', $user->country) == 'South Sudan' ? 'selected' : '' }}>South Sudan</option>
                    <option value="Spain" {{ old('country', $user->country) == 'Spain' ? 'selected' : '' }}>Spain</option>
                    <option value="Sri Lanka" {{ old('country', $user->country) == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                    <option value="Sudan" {{ old('country', $user->country) == 'Sudan' ? 'selected' : '' }}>Sudan</option>
                    <option value="Suriname" {{ old('country', $user->country) == 'Suriname' ? 'selected' : '' }}>Suriname</option>
                    <option value="Sweden" {{ old('country', $user->country) == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                    <option value="Switzerland" {{ old('country', $user->country) == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                    <option value="Syria" {{ old('country', $user->country) == 'Syria' ? 'selected' : '' }}>Syria</option>
                    <option value="Taiwan" {{ old('country', $user->country) == 'Taiwan' ? 'selected' : '' }}>Taiwan</option>
                    <option value="Tajikistan" {{ old('country', $user->country) == 'Tajikistan' ? 'selected' : '' }}>Tajikistan</option>
                    <option value="Tanzania" {{ old('country', $user->country) == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                    <option value="Thailand" {{ old('country', $user->country) == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                    <option value="Timor-Leste" {{ old('country', $user->country) == 'Timor-Leste' ? 'selected' : '' }}>Timor-Leste</option>
                    <option value="Togo" {{ old('country', $user->country) == 'Togo' ? 'selected' : '' }}>Togo</option>
                    <option value="Tonga" {{ old('country', $user->country) == 'Tonga' ? 'selected' : '' }}>Tonga</option>
                    <option value="Trinidad and Tobago" {{ old('country', $user->country) == 'Trinidad and Tobago' ? 'selected' : '' }}>Trinidad and Tobago</option>
                    <option value="Tunisia" {{ old('country', $user->country) == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
                    <option value="Turkey" {{ old('country', $user->country) == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                    <option value="Turkmenistan" {{ old('country', $user->country) == 'Turkmenistan' ? 'selected' : '' }}>Turkmenistan</option>
                    <option value="Tuvalu" {{ old('country', $user->country) == 'Tuvalu' ? 'selected' : '' }}>Tuvalu</option>
                    <option value="Uganda" {{ old('country', $user->country) == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                    <option value="Ukraine" {{ old('country', $user->country) == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                    <option value="United Arab Emirates" {{ old('country', $user->country) == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                    <option value="United Kingdom" {{ old('country', $user->country) == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                    <option value="United States" {{ old('country', $user->country) == 'United States' ? 'selected' : '' }}>United States</option>
                    <option value="Uruguay" {{ old('country', $user->country) == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                    <option value="Uzbekistan" {{ old('country', $user->country) == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
                    <option value="Vanuatu" {{ old('country', $user->country) == 'Vanuatu' ? 'selected' : '' }}>Vanuatu</option>
                    <option value="Vatican City" {{ old('country', $user->country) == 'Vatican City' ? 'selected' : '' }}>Vatican City</option>
                    <option value="Venezuela" {{ old('country', $user->country) == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                    <option value="Vietnam" {{ old('country', $user->country) == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                    <option value="Yemen" {{ old('country', $user->country) == 'Yemen' ? 'selected' : '' }}>Yemen</option>
                    <option value="Zambia" {{ old('country', $user->country) == 'Zambia' ? 'selected' : '' }}>Zambia</option>
                    <option value="Zimbabwe" {{ old('country', $user->country) == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
                </select>
                @error('country')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>


        </div>

        <!-- Bio -->
        <div class="space-y-2">
            <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio</label>
            <textarea name="bio" id="bio" rows="4" placeholder="Tell us about yourself..." class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">{{ old('bio', $user->bio) }}</textarea>
            @error('bio')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Social Media Links -->
        <div class="space-y-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Social Media</h3>
            
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <label for="twitter_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Twitter URL</label>
                    <input type="url" name="twitter_url" id="twitter_url" value="{{ old('twitter_url', $user->twitter_url) }}" placeholder="https://twitter.com/username" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    @error('twitter_url')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="facebook_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Facebook URL</label>
                    <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $user->facebook_url) }}" placeholder="https://facebook.com/username" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    @error('facebook_url')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="linkedin_profile_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">LinkedIn URL</label>
                    <input type="url" name="linkedin_profile_url" id="linkedin_profile_url" value="{{ old('linkedin_profile_url', $user->linkedin_profile_url) }}" placeholder="https://linkedin.com/in/username" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    @error('linkedin_profile_url')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="site_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Website</label>
                    <input type="url" name="site_url" id="site_url" value="{{ old('site_url', $user->site_url) }}" placeholder="https://yoursite.com" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    @error('site_url')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 text-sm font-medium text-white transition-colors bg-blue-800 rounded-lg hover:bg-blue-900 dark:bg-blue-700 dark:hover:bg-blue-800">
                Save Changes
            </button>
        </div>
    </form>
</div>
</x-theme::private-app>