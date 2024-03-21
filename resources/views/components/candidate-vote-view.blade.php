<div style="text-align: center;margin-left: 10px;margin-right: 10px">
    <div>
        <img src="{{ asset('storage/' . $candidate->dp) }}" alt="" class="rounded-circle" width="150px"
            height="150px">
        <img src="{{ asset('storage/' . $candidate->party_image) }}" alt="" width="70" height="70"
            class="rounded-circle" style="margin-left: -70px;margin-top: 120px">
    </div>
    <div>
        <input type="radio" name="vote-{{ $candidate->vie_position_id }}" id="vote-{{ $candidate->id }}"
            value="{{ $candidate->id }}">
        <label for="vote-{{ $candidate->id }}">{{ $candidate->first_name }} {{ $candidate->last_name }}</label>
    </div>
</div>
