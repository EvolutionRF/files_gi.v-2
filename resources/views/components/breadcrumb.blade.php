<div class="section-header-breadcrumb">
    @foreach ($parents as $parent )
    <div class="breadcrumb-item"><a href="#">{{ $parent['name'] }}</a></div>
    @endforeach
</div>
