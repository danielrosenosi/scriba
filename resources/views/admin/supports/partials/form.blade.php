<x-alert/>

@csrf()
<input type="text" autocomplete="off" placeholder="Assunto" name="subject" value="{{ $support->subject ?? old('subject') }}" class="block w-full text-gray-700 bg-white border border-gray-200 rounded-lg md:w-100 py-3 px-4 mb-3 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
<textarea name="body" cols="30" rows="5" placeholder="Descrição" class="block w-full text-gray-700 bg-white border border-gray-200 rounded-lg md:w-100 py-3 px-4 mb-3 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">{{ $support->body ?? old('body') }}</textarea>
<button type="submit" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Enviar</button>