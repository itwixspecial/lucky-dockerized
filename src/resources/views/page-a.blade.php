<h1>Page A</h1>
<p>Here you can:</p>
<ul>
    <li><a href="#" onclick="event.preventDefault(); document.getElementById('regenerateForm').submit();">Regenerate unique link</a></li>
    <li><a href="#" onclick="event.preventDefault(); document.getElementById('deactivateForm').submit();">Deactivate this unique link</a></li>
    <button onclick="window.location.href='{{ route('imfeelinglucky', ['link' => $uniqueLink->link]) }}'">Imfeelinglucky</button>
    <button onclick="window.location.href='{{ route('history', ['link' => $uniqueLink->link]) }}'">History</button>
</ul>

<form id="deactivateForm" action="{{ route('deactivate.link', ['link' => $uniqueLink->link]) }}" method="POST" style="display: none;">
    @csrf
</form>
<form id="regenerateForm" action="{{ route('regenerate.link', ['link' => $uniqueLink->link]) }}" method="POST" style="display: none;">
    @csrf
</form>

@if (isset($result))
<ul>
    <p>Number: {{ $randomNumber }} </p>
    <p>Result: {{ $result }}</p>
    <p>Amount: {{ $amount }}</p>
</ul>
@endif

@if (isset($history) && $history->count() > 0)
    <h2>Game History</h2>
    <ul>
        @foreach ($history as $play)
            <li>Play result: {{ $play->number }} | {{ $play->result }}, Amount: {{ $play->amount }}</li>
        @endforeach
    </ul>
@elseif(isset($history))
    <p>No game history found.</p>
@endif