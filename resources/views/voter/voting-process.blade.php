<x-master-voter>
    @csrf
    <section id="intro">
        <div class="intro-container">
            <h1 class="mb-4 pb-0"><span>How to Vote?</span></h1>
            <p class="mb-4 pb-0 text-success">Step 1</p>
            <p class="mb-4 pb-0">Navigate to the <i><a href="/election">election</a></i> section from the navigation bar.
            </p>

            <p class="mb-4 pb-0 text-success">Step 2</p>
            <p class="mb-4 pb-0">On that page there will be a form that has a sidebar navigation of various seats that
                are being vied for eg. <i>President</i>, <i>Governor</i>, <i>Senator</i> etc. Select one candidate per
                position.</p>

            <p class="mb-4 pb-0 text-success">Step 3</p>
            <p class="mb-4 pb-0">Confirm that you have selected a candidate for all the available seats in contest.</p>

            <p class="mb-4 pb-0 text-success">Step 4</p>
            <p class="mb-4 pb-0">Press the vote button (<input class="btn btn-outline-success " value="Submit Vote"
                    style="width: 80px" id="btn-submit">) to cast your vote to the selected
                candidates.</p>

            <p class="mb-4 pb-0 text-danger">Please note that once you click the vote button, you cannot undo it!!</p>
        </div>
    </section>
</x-master-voter>
