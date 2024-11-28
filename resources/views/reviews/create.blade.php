@extends('auth.layouts')
@section('content')

<div class="container mt-5">
    <h4 class="mb-4">Review Buku</h4>
    <form method="POST" action="{{ route('reviews.store') }}">
        @csrf
        <div class="mb-3">
            <label for="buku_id" class="form-label">Pilih Buku</label>
            <select class="form-control" id="buku_id" name="buku_id" required>
                @foreach ($bukus as $buku)
                    <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="review" class="form-label">Review</label>
            <textarea class="form-control" id="review" name="review" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <div id="tags" class="btn-group" role="group" aria-label="Tags">
                @foreach ($tags as $tag)
                    <input type="checkbox" class="btn-check" id="tag_{{ $tag->id }}" name="tags[]" value="{{ $tag->name }}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit Review</button>
        <a href="{{ url('/buku') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection