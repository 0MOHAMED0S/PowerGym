<x-guest-layout>
@section('style')
<link rel="stylesheet" href="{{asset('css/codeVerify.css')}}">
@endsection
    <div id="all">

        <div class="mb-4 text-sm text-gray-600">
            {{ __('code Verify') }}
        </div>

        <form id="codeForm" method="POST" action="{{ route('CheckCodeVerify') }}">
            @csrf

            <!-- Code -->
            <div>
                <x-input-label id="code" for="code" :value="__('Code')" />

                <div>
                    <input name='code[]' class='code-input' required />
                    <input name='code[]' class='code-input' required />
                    <input name='code[]' class='code-input' required />
                    <input name='code[]' class='code-input' required />
                </div>

                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4">
                <x-primary-button type="button" onclick="submitCode()">
                    {{ __('Confirm') }}
                </x-primary-button>
            </div>
        </form>

    </div>

    <script>
        function submitCode() {
            var codeInputs = document.querySelectorAll('.code-input');
            var code = '';
            codeInputs.forEach(function(input) {
                code += input.value;
            });

            // Set the concatenated code value to a hidden input before submitting the form
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'code');
            hiddenInput.setAttribute('value', code);
            document.getElementById('codeForm').appendChild(hiddenInput);

            // Submit the form
            document.getElementById('codeForm').submit();
        }
        const inputElements = [...document.querySelectorAll('input.code-input')]

        inputElements.forEach((ele, index) => {
            ele.addEventListener('keydown', (e) => {
                // if the keycode is backspace & the current field is empty
                // focus the input before the current. Then the event happens
                // which will clear the "before" input box.
                if (e.keyCode === 8 && e.target.value === '') inputElements[Math.max(0, index - 1)].focus()
            })
            ele.addEventListener('input', (e) => {
                // take the first character of the input
                // this actually breaks if you input an emoji like 👨‍👩‍👧‍👦....
                // but I'm willing to overlook insane security code practices.
                const [first, ...rest] = e.target.value
                e.target.value = first ??
                    '' // first will be undefined when backspace was entered, so set the input to ""
                const lastInputBox = index === inputElements.length - 1
                const didInsertContent = first !== undefined
                if (didInsertContent && !lastInputBox) {
                    // continue to input the rest of the string
                    inputElements[index + 1].focus()
                    inputElements[index + 1].value = rest.join('')
                    inputElements[index + 1].dispatchEvent(new Event('input'))
                }
            })
        })


        // mini example on how to pull the data on submit of the form
        function onSubmit(e) {
            e.preventDefault()
            const code = inputElements.map(({
                value
            }) => value).join('')
            console.log(code)
        }
    </script>
</x-guest-layout>

