<x-guest-layout>
    {{-- Create a form with tailwindcss field username, password, cep, address, city --}}
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('create_user') }}">
            @csrf
            <div>
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>
            <div class="mt-4">
                <x-label for="cep" :value="__('CEP')" />
                <x-input id="cep" class="block mt-1 w-full" type="text" name="cep" :value="old('cep')" required maxlength="8" />
            </div>
            <div class="mt-4">
                <x-label for="address" :value="__('Address')" />
                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" readonly  />
            </div>
            <div class="mt-4">
                <x-label for="number" :value="__('Number')" />
                <x-input id="number" class="block mt-1 w-full" type="number" name="number" :value="old('number')" required />
            </div>
            <div class="mt-4">
                <x-label for="city" :value="__('City')" />
                <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" readonly />
            </div>
            <div class="mt-4">
                <x-label for="state" :value="__('State')" />
                <x-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state')" readonly />
            </div>
            <div class="mt-4">
                <x-label for="complement" :value="__('Complement')" />
                <x-input id="complement" class="block mt-1 w-full" type="text" name="complement" :value="old('complement')" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

<script>
// function to request CEP api when fill cep input
document.getElementById('cep').addEventListener('blur', getCep);

function getCep() {
    var cep = document.getElementById('cep').value;
    var url = 'https://brasilapi.com.br/api/cep/v1/' + cep;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);
                document.getElementById('address').value = data.street;
                document.getElementById('city').value = data.city;
                document.getElementById('state').value = data.state;
            } else {
                alert('CEP não encontrado.');
            }
        }
    };
    xhr.send();
}

// Remove any negative numbers from the input "number" field
document.getElementById("number").addEventListener("keyup", function() {
  this.value = this.value.replace(/[^0-9]/g, "");
});
</script>
