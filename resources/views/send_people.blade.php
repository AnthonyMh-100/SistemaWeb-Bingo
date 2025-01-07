<div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow-md border border-gray-200">
    <h1 class="text-2xl font-bold text-blue-600 mb-4">
        ¡Felicitaciones, eres el Ganador del Bingo!
    </h1>
    <p class="text-gray-700 text-lg mb-4">
        Que tal Sr/a. 
        <span class="font-semibold">{{ $people->name }} {{ $people->last_name }}</span>, 
        ha sido el ganador del Bingo 
        <span class="font-semibold">{{ $game->name }}</span>, jugado el 
        <span class="font-semibold">{{ $game->date_start }}</span>.
    </p>
    <p class="text-gray-700 text-lg mb-4">
        Por favor, comuníquese con el organizador del evento para reclamar su premio.
    </p>
    <p class="text-gray-700 text-lg">
        Saludos cordiales,
    </p>
</div>
