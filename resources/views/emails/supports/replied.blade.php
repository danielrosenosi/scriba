<x-mail::message>
# Dúvida Respondida

Olá, {{ $reply->support['user']['name'] }}. Estamos felizes em informar que o seu chamado com o assunto **"{{ $reply->support['subject'] }}"** foi respondido.
Obrigado por fazer parte do Scriba!

<x-mail::button :url="route('replies.index', $reply->support_id)">
Ver
</x-mail::button>

Obrigado, {{ config('app.name') }}
</x-mail::message>
