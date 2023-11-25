<x-app-worker-layout>
    <x-slot name="pageTitle">
        {{ __('app.categories.new-category') }}
    </x-slot>
    <x-slot name="header">
        {{ __('app.categories.new-category') }}
    </x-slot>
    <div class="flex w-full mt-5">
        <form method="POST" id="add_new_category" class="mt-20 flex flex-col w-full"
            action="{{ route('worker.options.store.new.category') }}">
            @csrf
            <span class="input-label py-2">{{ __('app.categories.write-name-category') }}:</span>
            <input type="text" name="category_name_sr" class="input-style" id="inputText" oninput="convertToCyrillic(this.value)">
    
            <span class="input-label py-2 mt-5">{{ __('app.categories.write-name-category') }} ciril:</span>
            <input type="text" class="input-style" name="category_name_rs_cyrl" id="outputText">

            <button type="submit" class="main-btn mx-auto mt-10">{{ __('app.basic.save') }}</button>
        </form>
    </div>
    <script>
        function convertToCyrillic(inputText) {
            const cyrillicText = convertLatinToCyrillic(inputText);
            document.getElementById('outputText').value = cyrillicText;
        }

        function convertLatinToCyrillic(inputText) {
            const latinToCyrillicMap = {
                'a': 'а', 'b': 'б', 'c': 'ц', 'd': 'д', 'e': 'е', 'f': 'ф', 'g': 'г',
                'h': 'х', 'i': 'и', 'j': 'j', 'k': 'к', 'l': 'л', 'm': 'м', 'n': 'н',
                'o': 'о', 'p': 'п', 'q': 'к', 'r': 'р', 's': 'с', 't': 'т', 'u': 'у',
                'v': 'в', 'w': 'в', 'x': 'кс', 'y': 'y', 'z': 'з',

                'A': 'А', 'B': 'Б', 'C': 'Ц', 'D': 'Д', 'E': 'Е', 'F': 'Ф', 'G': 'Г',
                'H': 'Х', 'I': 'И', 'J': 'J', 'K': 'К', 'L': 'Л', 'M': 'М', 'N': 'Н',
                'O': 'О', 'P': 'П', 'Q': 'К', 'R': 'Р', 'S': 'С', 'T': 'Т', 'U': 'У',
                'V': 'В', 'W': 'В', 'X': 'КС', 'Y': 'Y', 'Z': 'З',
            };

            // Convert each character in the input text
            const cyrillicText = inputText.split('').map(char => {
                // If the character has a mapping, use the Cyrillic equivalent; otherwise, keep the original character
                return latinToCyrillicMap[char] || char;
            }).join('');

            return cyrillicText;
        }
    </script>
</x-app-worker-layout>
