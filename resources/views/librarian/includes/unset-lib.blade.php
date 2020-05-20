<form method="POST"
      action="{{ route('librarian.unset-lib') }}">
    @method('DELETE')
    @csrf
    <button class="btn btn-outline-light mt-2" type="submit">&#8592; Повернутися до вибору бібліотеки</button>
</form>
