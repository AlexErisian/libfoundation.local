<form method="POST"
      action="{{ route('librarian.unset-lib') }}">
    @method('DELETE')
    @csrf
    <button class="btn btn-secondary mt-2" type="submit"><- Повернутися до вибору бібліотеки</button>
</form>
