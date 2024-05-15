@if (session( $type ))
<div class="alert alert-{{ $type }}">
    {{ session( $type ) }}
</div>
@endif