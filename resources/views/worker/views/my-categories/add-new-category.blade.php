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
            <input type="text" class="input-style" name="category_name_rs_cyrl" id="outputText" >

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
                'NJ': 'Њ', 'LJ': 'Љ', 'DJ': 'Ђ', 'Nj': 'Њ', 'Lj': 'Љ', 'Dj': 'Ђ', 'nj': 'њ', 'lj': 'љ', 'dj': 'ђ', 'č': 'ч', 'š': 'ш', 'Č': 'Ч', 'Š': 'Ш', 'ć': 'ћ', 'Ć': 'Ћ', 'ž': 'ж', 'Ž': 'Ж', 'đ': 'ђ', 'Đ': 'Ђ','x': 'кс',

                'a': 'а', 'b': 'б', 'c': 'ц', 'd': 'д', 'e': 'е', 'f': 'ф', 'g': 'г',
                'h': 'х', 'i': 'и', 'j': 'j', 'k': 'к', 'l': 'л', 'm': 'м', 'n': 'н',
                'o': 'о', 'p': 'п', 'r': 'р', 's': 'с', 't': 'т', 'u': 'у',
                'v': 'в', 'w': 'в', 'y': 'y', 'z': 'з',

                'A': 'А', 'B': 'Б', 'C': 'Ц', 'D': 'Д', 'E': 'Е', 'F': 'Ф', 'G': 'Г',
                'H': 'Х', 'I': 'И', 'J': 'J', 'K': 'К', 'L': 'Л', 'M': 'М', 'N': 'Н',
                'O': 'О', 'P': 'П', 'R': 'Р', 'S': 'С', 'T': 'Т', 'U': 'У',
                'V': 'В', 'W': 'В', 'X': 'КС', 'Y': 'Y', 'Z': 'З',
            };

            const cyrillicText = inputText.replace(/NJ|LJ|DJ|Nj|Lj|Dj|nj|lj|dj|č|š|Č|Š|ć|Ć|ž|Ž|đ|Đ|x|a|b|c|d|e|f|g|h|i|j|k|l|m|n|o|p|r|s|t|u|v|w|y|z|A|B|C|D|E|F|G|H|I|J|K|L|M|N|O|P|R|S|T|U|V|W|X|Y|Z/g, match => latinToCyrillicMap[match]);

            return cyrillicText;
        }
    </script>
</x-app-worker-layout>
