<x-master-voter>
    @csrf
    <section id="intro">
        <div class="intro-container wow fadeIn">
            <h1 class="mb-4 pb-0">Welcome To<br><span>{{ env('APP_NAME') }}</span></h1>
            <a href="/voting-process" class="about-btn scrollto">How to Vote?</a>
        </div>
    </section>
</x-master-voter>
